<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Initialize the courses array
$courses = [];

// Start the session (only if it's not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if a student is logged in
if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit();
}

// Get the program ID for the current student
$student_id = $_SESSION["student_id"];
$sql = "SELECT program_id FROM student_programs WHERE student_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare statement failed: " . $conn->error);
}

$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $programId = $row["program_id"];

    // Query to retrieve courses for the specified program
    $sql = "SELECT course_name FROM courses WHERE program_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("i", $programId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $courses[] = $row["course_name"];
    }

    $stmt->close();
} else {
    // Program not found for the student, you can handle this accordingly (e.g., display an error message)
    echo "Program not found for the student";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Courses</title>
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
    <div class="content">
        <br><br>
        <h2>Available Courses</h2>

        <?php if (empty($courses)) { ?>
            <p>No courses available for this program.</p>
        <?php } else { ?>
            <ul>
                <?php foreach ($courses as $course) { ?>
                    <li><?php echo $course; ?></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</body>
</html>
