<?php
session_start();
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Check if the form was submitted and the required fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    // Get input data and sanitize
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

    // Query to check admin credentials using prepared statement
    $stmt = $conn->prepare("SELECT id, username, password FROM admin_users WHERE username = ?");
    if (!$stmt) {
        // Handle query preparation error
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        // Handle query execution error
        die("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();

    // Check if a match is found and verify the password
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            // Store user information in session
            $_SESSION["admin_username"] = $username;
            $_SESSION["admin_id"] = $row["id"]; // You can add more user-specific information

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        }
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/adminlogin.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="loginadmin.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
