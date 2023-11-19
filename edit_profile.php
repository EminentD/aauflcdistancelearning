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
    
    $stateOfOrigin = $student["state_of_origin"]; // Corrected variable name
    $address = isset($student["address"]) ? $student["address"] : "";
    $qualification = isset($student["qualification"]) ? $student["qualification"] : ""; // Added qualification field
    $phoneNumber = isset($student["phone_number"]) ? $student["phone_number"] : ""; // Added phone number field
} else {
    echo "No student found with ID: " . $student_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/profile.css"> 
    <link rel="stylesheet" href="assets/css/Student dashboard.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="Dashboard.php">My Dashboard</a>
        <i class="fa-light fa-book-open-cover"></i>
        <button class="navbar-toggler" id="navbar-toggler">&#9776;</button>
        <div class="navbar-menu" id="navbar-menu">
            <a href="program.php">Programs</a>
            <a href="#">Courses</a>
            <a href="profile.php">Profile</a>
            <a href="report.php">Report</a>
            <a href="login.php">Logout</a>
        </div>
    </nav>
    <div class="container-2nd-child">
        <br><br><br><br>
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <br>
            <div class="form-group"><br>
                <label for="newFirstName">First Name:</label>
                <input type="text" id="newFirstName" name="newFirstName" value="<?php echo $student["first_name"]; ?>" required>
            </div><br>
            <div class="form-group">
                <label for="newLastName">Last Name:</label>
                <input type="text" id="newLastName" name="newLastName" value="<?php echo $student["last_name"]; ?>" required>
            </div><br>
            <div class="form-group">
                <label for="newEmail">Email:</label>
                <input type="email" id="newEmail" name="newEmail" value="<?php echo $student["email"]; ?>" required>
            </div><br>
            <div class="form-group">
                <label for="newStudentLevel">Student Level:</label>
                <input type="text" id="newStudentLevel" name="newStudentLevel" value="<?php echo $studentLevel; ?>" required>
            </div><br>
            <div class="form-group">
                <label for="newDateOfBirth">Date of Birth:</label>
                <input type="date" id="newDateOfBirth" name="newDateOfBirth" value="<?php echo $dateOfBirth; ?>" required>
            </div><br>
            <div class="form-group">
                <label for="newStateOfOrigin">State Of Origin:</label> <!-- Corrected input name -->
                <input type="text" id="newStateOfOrigin" name="newStateOfOrigin" value="<?php echo $stateOfOrigin; ?>">
            </div><br>
            <div class="form-group">
                <label for="newAddress">Address:</label>
                <input type="text" id="newAddress" name="newAddress" value="<?php echo $address; ?>">
            </div><br>
            <div class="form-group">
                <label for="newQualification">Qualification:</label>
                <input type="text" id="newQualification" name="newQualification" value="<?php echo $qualification; ?>">
            </div><br>
            <div class="form-group">
                <label for="newPhoneNumber">Phone Number:</label>
                <input type="text" id="newPhoneNumber" name="newPhoneNumber" value="<?php echo $phoneNumber; ?>">
            </div><br>

            <!-- Add more fields as needed -->
            <button type="submit" class="update-profile-button">Save Changes</button>
        </form>
        <a href="profile.php">Back to Profile</a>
    </div>
</body>
</html>
