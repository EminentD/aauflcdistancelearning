<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Start the session (only if it's not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize the first name and last name variables
$student_first_name = ""; // Default to an empty string
$student_last_name = ""; // Default to an empty string

// Check if a student is logged in
if (isset($_SESSION["student_id"])) {
    // Assuming "student_id" is the correct column name in your table
    $student_id = $_SESSION["student_id"];

    // Query to retrieve student details
    $sql = "SELECT first_name, last_name FROM students WHERE student_id = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare statement failed: " . $conn->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("i", $student_id);
    $stmt->execute();

    if ($stmt->error) {
        die("Execute statement failed: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Check if a result was found
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $student_first_name = $row["first_name"];
        $student_last_name = $row["last_name"];
    }

    // Close the statement
    $stmt->close();
}

// Query to retrieve programs from the "programs" table
$sqlPrograms = "SELECT program_name FROM programs";
$resultPrograms = $conn->query($sqlPrograms);

if ($resultPrograms === false) {
    die("Query failed: " . $conn->error);
}

// Initialize an array to store the programs
$programs = [];

while ($rowPrograms = $resultPrograms->fetch_assoc()) {
    $programs[] = $rowPrograms["program_name"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Available Programs</title>
        <link rel="stylesheet" type="text/css" href="assets/css/program.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/Student dashboard.css">
    </head>
    <body>
        <nav class="navbar">
            <a class="navbar-brand" href="Dashboard.php">My Dashboard</a>
            <button class="navbar-toggler" id="navbar-toggler">&#9776;</button>
            <div class="navbar-menu" id="navbar-menu">
                <a href="program.php"><i class="fas fa-graduation-cap"></i> Programs</a>
                <a href="courses.php"><i class="fas fa-book"></i> Courses</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="report.php"><i class="fas fa-chart-bar"></i> Report</a>
                <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>

        </nav>
        
        <div class="navbar-mobile" id="navbar-mobile"></div>

        <br>
        <div class="content">
            <h2>Available Programs</h2>

            <!-- Display available programs -->
            <ul>
                <?php foreach ($programs as $program) { ?>
                    <li><?php echo $program; ?></li>
                <?php } ?>
            </ul>
        </div>
        <br>
        <button style="margin:auto"><a href="enrollforprogram.php">Enroll For Program </a></button>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> aauflcdistancelearning. Designed by Eminent. All rights reserved.</p>
        </footer>
    </body>
</html>
