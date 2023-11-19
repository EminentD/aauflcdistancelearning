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

// Retrieve the student's ID from the session
$student_id = $_SESSION["student_id"];

// Check if the form is submitted for updating the profile
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Initialize profile picture URL to an empty string
    $profilePictureURL = "";
    $uploadDir = __DIR__ . "/profile_pictures/";

    // Handle profile picture upload if a new picture is selected
    if (isset($_FILES["newProfilePicture"])) {
        $uploadDir = "profile_pictures/";
        $uploadFile = $uploadDir . basename($_FILES["newProfilePicture"]["name"]);

        // Check if the file upload was successful
        if ($_FILES["newProfilePicture"]["error"] !== UPLOAD_ERR_OK) {
            echo "File upload failed with error code: " . $_FILES["newProfilePicture"]["error"];
            exit();
        }

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["newProfilePicture"]["tmp_name"], $uploadFile)) {
            $profilePictureURL = $uploadFile; // File upload successful, update the profile picture URL
        } else {
            echo "Error moving uploaded file.";
            exit();
        }
    }
    
    // Retrieve and sanitize other updated details
    $newFirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newEmail = $_POST["newEmail"];
    $newStudentLevel = $_POST["newStudentLevel"];
    $newDateOfBirth = isset($_POST["newDateOfBirth"]) ? $_POST["newDateOfBirth"] : "";
    $newStateOfOrigin = isset($_POST["newStateOfOrigin"]) ? $_POST["newStateOfOrigin"] : "";
    $newPhoneNumber = isset($_POST["newPhoneNumber"]) ? $_POST["newPhoneNumber"] : "";
    $newQualifications = isset($_POST["newQualifications"]) ? $_POST["newQualifications"] : "";

    // Check the database connection
    if ($conn === false) {
        echo "Database connection error.";
        exit();
    }

    // Update the student's details in the database
    $updateProfileSql = "UPDATE students SET 
        first_name = ?,
        last_name = ?,
        email = ?,
        student_level = ?,
        date_of_birth = ?, 
        state_of_origin = ?, 
        phone_number = ?, 
        qualifications = ?, 
        profile_picture = ?
        WHERE student_id = ?";

    $updateProfileStmt = $conn->prepare($updateProfileSql);

    if ($updateProfileStmt === false) {
        // Handle database error
        echo "Database error: " . $conn->error;
        exit();
    } else {
        $updateProfileStmt->bind_param("sssssssssi", $newFirstName, $newLastName, $newEmail, $newStudentLevel, $newDateOfBirth, $newStateOfOrigin, $newPhoneNumber, $newQualifications, $profilePictureURL, $student_id);

        if ($updateProfileStmt->execute()) {
            // Profile update successful
            header("Location: profile.php"); // Redirect to the profile page
            exit();
        } else {
            // Profile update failed
            echo "Error updating profile: " . $updateProfileStmt->error;
            exit();
        }
    }
}

// Close the database connection
$conn->close();
?>
