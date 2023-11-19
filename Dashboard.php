<?php
// Start the session (only if it's not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database configuration
include("aauflcdistancelearning_config.php");

// Check if a student is logged in, if not, redirect to the login page
if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit();
}

// Retrieve the student's ID from the session
$student_id = $_SESSION["student_id"];

// Query to retrieve student details
$sql = "SELECT * FROM students WHERE student_id = ?"; // Assuming "student_id" is the correct column name
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch and display student details
    $student = $result->fetch_assoc();
    echo '<h1>Welcome to your Dashboard, ' . $student["first_name"] . ' ' . $student["last_name"] . '</h1>';
    // You can display other student details here as needed
} else {
    echo "No student found with ID: " . $student_id;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/Student dashboard.css">
    </head>
    <body>
        <nav class="navbar">
            <a class="navbar-brand" href="#">My Dashboard</a>
            <button class="navbar-toggler" id="navbar-toggler">&#9776;</button>
            <div class="navbar-menu" id="navbar-menu">
                <a href="program.php"><i class="fas fa-graduation-cap"></i> Programs</a>
                <a href="courses.php"><i class="fas fa-book"></i> Courses</a>
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="student_report.php"><i class="fas fa-chart-bar"></i> Report</a>
                <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>

        </nav>
        
        <div class="navbar-mobile" id="navbar-mobile"></div>
        <!-- Outer flex container -->
        <div class="outer-container">
            <div class="inner-container">
                <a href="enrollforprogram.php"><i class="fas fa-graduation-cap"></i> Enroll for Program</a>
            </div>
            <div class="inner-container">
                <a href="enrollforcourse.php"><i class="fas fa-book"></i> Enroll for Courses</a>
            </div>
            <div class="inner-container">
                <a href="lesson.php"><i class="fas fa-chalkboard-teacher"></i> Lesson</a>
            </div>
            <!-- Float left container -->
            <div class="float-left-container">
                <a href="exercises.php"><i class="fas fa-dumbbell"></i> Exercises</a>
            </div>
        </div>
        <div class="image-container">
            <div class="row">
                <img src="assets/images/lesson.jpg" alt="Image 1">
                <img src="assets/images/report.jpg" alt="Image 2">
            </div> 
            <div class="row">   
                <img src="assets/images/exercises.jpg" alt="Image 3">
                <img src="assets/images/student.jpg" alt="Image 4">
            </div>    
        </div>
        <script>
            // Add event listener to the navbar toggler button
            document.getElementById("navbar-toggler").addEventListener("click", function() {
                var navbarMenu = document.getElementById("navbar-menu");
                var navbarMobile = document.getElementById("navbar-mobile");

                if (navbarMenu.style.display === "flex") {
                    navbarMenu.style.display = "none";
                    navbarMobile.innerHTML = "";
                } else {
                    navbarMenu.style.display = "flex";
                    navbarMobile.innerHTML = navbarMenu.innerHTML;
                }
            });
        </script>    

        <footer>
                <p>&copy; 2023 aauflcdistancelearning. Designed by Eminent All rights reserved.</p>
        </footer>
    </body>
</html>
