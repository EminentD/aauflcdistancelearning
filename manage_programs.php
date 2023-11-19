<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_username"])) {
    header("Location: loginadmin.php");
    exit();
}

// Initialize an empty array to store the programs
$programs = [];

// Query to retrieve all programs from the "programs" table
$sql = "SELECT program_name FROM programs";
$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Fetch programs from the result and store them in the array
while ($row = $result->fetch_assoc()) {
    $programs[] = $row["program_name"];
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Manage Programs</title>
    <link rel="stylesheet" type="text/css" href="assets/css/manageprogram.css">
</head>
<body>
    <div class="header">
        <h1>Welcome, <?php echo $_SESSION["admin_username"]; ?></h1>
        <a href="logout.php">Logout</a>
    </div>
    
    <div class="content">
        <h2>Manage Programs</h2>

        <!-- Display available programs -->
        <h3>Available Programs</h3>
        <ul>
            <?php foreach ($programs as $program) { ?>
                <li>
                    <?php echo $program; ?>
                    <!-- Add options to edit or delete programs as needed -->
                </li>
            <?php } ?>
        </ul>

        <!-- Form to add a new program -->
        <h3>Add New Program</h3>
        <form action="add_program.php" method="POST">
            <label for="new_program">Program Name:</label>
            <input type="text" id="new_program" name="new_program" required>
            <input type="submit" value="Add Program">
        </form>
    </div>
    <footer>
        <p>&copy; 2023 aauflcdistancelearning. Designed by Eminent All rights reserved.</p>
    </footer>
</body>
</html>
