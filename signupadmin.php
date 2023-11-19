<?php
session_start();

// Include the database configuration (assuming you have a separate PHP file for this)
include("aauflcdistancelearning_config.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST["username"]); // Assuming you're using MySQL
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate the password and confirm_password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match. Please try again.";
    } else {
        // Hash the password (use a strong hashing algorithm like bcrypt)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Store the admin's information in the database
        // Make sure to have your database connection established before this point
        $query = "INSERT INTO admin_users (username, password) VALUES ('$username', '$hashed_password')";

        if (mysqli_query($conn, $query)) { // Assuming you're using MySQL
            // Registration successful, redirect to the login page
            header("Location: loginadmin.php");
            exit();
        } else {
            // Error handling for database insertion
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Close the database connection if you opened it at the beginning
mysqli_close($conn); // Assuming you're using MySQL
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Signup</title>
    <link rel="stylesheet" type="text/css" href="assets/css/adminlogin.css">
</head>
<body>
    <div class="container">
        <h2>Admin Signup</h2>
        <form method="POST" action="signupadmin.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <button type="submit">Sign Up</button>
            </div>
        </form>
    </div>
</body>
</html>
