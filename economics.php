<?php
include("aauflcdistancelearning_config.php");

$selectedProgram = "Economics";

$sql = "SELECT course_name, course_description, instructor_name FROM courses
        WHERE program_id = (SELECT program_id FROM programs WHERE program_name = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedProgram);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $selectedProgram; ?> Courses</title>
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
    <h2><?php echo $selectedProgram; ?> Courses</h2>
    
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="course-details">
            <h3><?php echo $row["course_name"]; ?></h3>
            <p><?php echo $row["course_description"]; ?></p>
            <p>Instructor: <?php echo $row["instructor_name"]; ?></p>
        </div>
    <?php } ?>

    <!-- Include your HTML layout and styling here -->
</body>
</html>
