<?php
// Start the session
session_start();

// Include the database configuration
include("aauflcdistancelearning_config.php");

// Check if the student is logged in, if not, redirect to the login page
if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit();
}

// Retrieve student details from the database based on the student ID
$student_id = $_SESSION["student_id"];

// Query to retrieve student details
$sql = "SELECT * FROM students WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch and display student details
    $student = $result->fetch_assoc();
    $studentName = $student["first_name"] . " " . $student["last_name"];
    $email = $student["email"];
    $profilePictureURL = $student["profile_picture_url"];
    $studentLevel = $student["student_level"];
    $dateOfBirth = $student["date_of_birth"];

    // Check if the "address" field exists in the database record
    $address = isset($student["address"]) ? $student["address"] : "N/A";

    // Check if the "qualifications" field exists in the database record
    $qualifications = isset($student["qualifications"]) ? $student["qualifications"] : "N/A";
} else {
    echo "No student found with ID: " . $student_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/profile.css"> 
    <link rel="stylesheet" href="assets/css/Student dashboard.css">
    <style>
        /* CSS for circular profile picture */
        .circular-profile {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="Dashboard.php">My Dashboard</a>
        <i class="fa-light fa-book-open-cover"></i>
        <button class="navbar-toggler" id="navbar-toggler">&#9776;</button>
        <div class="navbar-menu" id="navbar-menu">
            <a href="program.php">Programs</a>
            <a href="courses.php">Courses</a>
            <a href="profile.php">Profile</a>
            <a href="report.php">Report</a>
            <a href="login.php">Logout</a>
        </div>
    </nav>
    <div class="container-2nd-child">
        <br><br><br><br>
        <img src="<?php echo $profilePictureURL ? $profilePictureURL : 'placeholder.jpg'; ?>" alt="Profile Picture" class="circular-profile">
        <p>Full Name: <?php echo $studentName; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Student Level: <?php echo $studentLevel; ?></p>
        <p>Date of Birth: <?php echo $dateOfBirth; ?></p>
        <p>Address: <?php echo $address; ?></p>
        <p>Qualifications: <?php echo $qualifications; ?></p> <!-- Include Qualifications -->
        <p>State of Origin: <?php echo isset($student["state_of_origin"]) ? $student["state_of_origin"] : "N/A"; ?></p>
        <p>Phone Number: <?php echo isset($student["phone_number"]) ? $student["phone_number"] : "N/A"; ?></p>
        <a href="edit_profile.php">Edit Profile</a>
    </div>
</body>
</html>
