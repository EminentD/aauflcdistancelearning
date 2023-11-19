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

// Get the student ID from the session
$studentId = $_SESSION["student_id"];

// Initialize arrays to store enrolled and available courses
$enrolledCourses = [];
$availableCourses = [];

// Query to retrieve the enrolled courses for the student
$sql = "SELECT courses.course_name FROM student_courses
        JOIN courses ON student_courses.course_id = courses.course_id
        WHERE student_courses.student_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare statement failed: " . $conn->error);
}

$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $enrolledCourses[] = $row["course_name"];
}

$stmt->close();

// Query to retrieve all available courses for all programs
$sql = "SELECT courses.course_name, programs.program_name FROM courses
        JOIN programs ON courses.program_id = programs.program_id";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare statement failed: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $programName = $row["program_name"];
    $courseName = $row["course_name"];
    
    if (!isset($availableCourses[$programName])) {
        $availableCourses[$programName] = [];
    }
    
    $availableCourses[$programName][] = $courseName;
}

$stmt->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll in Courses</title>
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
            <a href="courses.php"><i class="fas fa-book"></i> Courses</a>
            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a href="report.php"><i class="fas fa-chart-bar"></i> Report</a>
            <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>

    <div class="navbar-mobile" id="navbar-mobile"></div>
    <div class="content">
        <br><br>
        <h2>Enroll in Courses</h2>

        <form action="enrollforcourse.php" method="POST">
            <label for="course_name">Select a Course:</label>
            <select id="course_name" name="course_name" required>
                <?php foreach ($availableCourses as $programName => $courses) { ?>
                    <optgroup label="<?php echo $programName; ?>">
                        <?php foreach ($courses as $course) { ?>
                            <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                        <?php } ?>
                    </optgroup>
                <?php } ?>
            </select>
            <input type="submit" value="Enroll">
        </form>

        <!-- Display enrolled courses here -->
        <h3>Enrolled Courses:</h3>
        <?php
        if (count($enrolledCourses) > 0) {
            foreach ($enrolledCourses as $enrolledCourse) {
                echo $enrolledCourse . "<br>";
            }
        } else {
            echo "You are not enrolled in any courses.";
        }
        ?>
    </div>
</body>
</html>
