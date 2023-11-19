<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Start the session (only if it's not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the admin is logged in
if (!isset($_SESSION["admin_username"])) {
    header("Location: loginadmin.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the program name is provided
    if (isset($_POST["new_program"])) {
        $newProgramName = $_POST["new_program"];

        // Prepare the SQL statement to insert a new program
        $sql = "INSERT INTO programs (program_name) VALUES (?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters and execute the query
        $stmt->bind_param("s", $newProgramName);

        if ($stmt->execute()) {
            // Insertion successful
            // Redirect to the manage programs page or perform any other desired action
            header("Location: manage_programs.php");
            exit();
        } else {
            // Handle database error
            echo "Error inserting program: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
