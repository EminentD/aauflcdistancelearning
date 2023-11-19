<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve course information from the form
    $courseName = $_POST["course_name"];
    $courseDescription = $_POST["course_description"];
    $instructorName = $_POST["instructor_name"];
    $programId = $_POST["program_id"]; // Assuming you have a program_id in the form
    
    // SQL query to insert the new course into the "courses" table
    $sql = "INSERT INTO courses (course_name, course_description, instructor_name, program_id)
            VALUES (?, ?, ?, ?)";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare statement failed: " . $conn->error);
    }
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("sssi", $courseName, $courseDescription, $instructorName, $programId);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        // Course added successfully
        echo "Course added successfully!";
    } else {
        // Handle database error
        echo "Error adding course: " . $stmt->error;
    }
    
    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

