<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Start the session (only if it's not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if a student is logged in
if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit();
}

// Check if the student is already enrolled in a program
$student_id = $_SESSION["student_id"];
$enrolledProgramId = null;

// Initialize an error message variable
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the selected program ID from the form (use mysqli_real_escape_string to prevent SQL injection)
    $programId = mysqli_real_escape_string($conn, $_POST["program_id"]);

    if (empty($programId)) {
        $error_message = "Please select a program.";
    } else {
        // Check if the student is already enrolled in a program
        $sql = "SELECT program_id FROM student_programs WHERE student_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare statement failed: " . $conn->error);
        }

        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Student is already enrolled in a program
            $error_message = "You are already enrolled in a program.";
        } else {
            // Student is not enrolled in any program, so enroll them
            $sql = "INSERT INTO student_programs (student_id, program_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Prepare statement failed: " . $conn->error);
            }

            $stmt->bind_param("ii", $student_id, $programId);

            if ($stmt->execute()) {
                // Enrollment successful
                $enrolledProgramId = $programId;

                // Redirect to courses.php with program_id
                header("Location: courses.php?program_id=" . $programId);
                exit();
            } else {
                // Handle database error
                $error_message = "Error enrolling in the program: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

// Query to retrieve the available programs from the "programs" table
$sql = "SELECT program_id, program_name FROM programs";
$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Initialize an array to store the available programs
$availablePrograms = [];

while ($row = $result->fetch_assoc()) {
    $availablePrograms[] = $row;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll in Programs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/Student dashboard.css">
    <link rel="stylesheet" href="assets/css/enroll.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="Dashboard.php">My Dashboard</a>
        <button class="navbar-toggler" id="navbar-toggler">&#9776;</button>
        <div class="navbar-menu" id="navbar-menu">
            <a href="program.php"><i class="fas fa-graduation-cap"></i> Programs</a>
            <a href="#"><i class="fas fa-book"></i> Courses</a>
            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a href="report.php"><i class="fas fa-chart-bar"></i> Report</a>
            <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>

    <div class="navbar-mobile" id="navbar-mobile"></div>

    <div class="content">
        <h2>Enroll in Program</h2>
            <form action="enrollforprogram.php" method="POST">
                <label for="program_id">Select a Program:</label>
                <select id="program_id" name="program_id" required>
                    <?php foreach ($availablePrograms as $program) { ?>
                        <option value="<?php echo htmlspecialchars($program["program_id"]); ?>"><?php echo htmlspecialchars($program["program_name"]); ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Enroll">
            </form>
            <?php if ($enrolledProgramId !== null) { ?>
            <p>You are already enrolled in a program.</p>
        <?php } ?>
        <?php if (!empty($error_message)) { ?>
            <p><?php echo htmlspecialchars($error_message); ?></p>
        <?php } ?>
    </div>
</body>
</html>
