<?php
session_start();


// Check if the admin is logged in
if (!isset($_SESSION["admin_username"])) {
    header("Location: login.php");
    exit();
}

// Include the database configuration
include("aauflcdistancelearning_config.php");

// Example: Retrieve course information from the database
function getCourses() {
    // Replace with your database query
    $courses = [
        ["id" => 1, "title" => "Course 1", "description" => "Description for Course 1"],
        ["id" => 2, "title" => "Course 2", "description" => "Description for Course 2"],
        // Add more courses here
    ];

    return $courses;
}

// Example: Retrieve tasks for a selected course
function getTasksForCourse($courseId) {
    // Replace with your database query to fetch tasks for a specific course
    $tasks = [
        ["id" => 1, "title" => "Task 1", "description" => "Description for Task 1"],
        ["id" => 2, "title" => "Task 2", "description" => "Description for Task 2"],
        // Add more tasks here
    ];

    return $tasks;
}

// Example: Display courses in the admin dashboard
$courses = getCourses();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/admindashboard.css">
</head>
<body>
    <div class="header">
        <h1>Welcome, <?php echo $_SESSION["admin_username"]; ?></h1>
        <a href="loginadmin.php">Logout</a>
    </div>
    
    <div class="content">
        <h2 class="" style="text-align:center">Course Management</h2>
        <a href="manage_courses.php" style="text-align: center;">Create New Course</a>
        
        <h2 class="" style="text-align:center">Components</h2>
        <div class="dashboard-components">
            <div class="component">
                <h3>Lessons</h3>
                <p>Manage and upload course lessons.</p>
                <a href="admin_add_lesson.php">Manage Lessons</a>
            </div>
            <div class="component">
                <h3>Reports</h3>
                <p>Manage and generate course reports.</p>
                <a href="admin_report.php">Manage Reports</a>
            </div>
            <div class="component">
                <h3>Courses</h3>
                <p>Manage and edit existing courses.</p>
                <a href="manage_courses.php">Manage Courses</a>
            </div>
            <div class="component">
                <h3>Programs</h3>
                <p>Manage and create educational programs.</p>
                <a href="manage_programs.php">Manage Programs</a>
            </div>
        </div>
        
        
    </div>
    <footer>
        <p>&copy; 2023 aauflcdistancelearning. Designed by Eminent All rights reserved.</p>
    </footer>
</body>
</html>
