<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset_password"])) {
    // Validate and sanitize the email address
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Check if the email exists in your database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Generate a unique token and store it in the database for this user
            $token = bin2hex(random_bytes(32));

            // Store the token in the user's record in the database
            $update_query = "UPDATE users SET reset_token = ? WHERE email = ?";
            $update_stmt = $conn->prepare($update_query);

            if ($update_stmt) {
                $update_stmt->bind_param("ss", $token, $email);
                $update_stmt->execute();

                // Send a reset password email with a link to reset.php?token=<token> (you need to implement this)
                // Example:
                $reset_link = "https://aauflcdistancelearning.com/reset.php?token=$token";

                // You can use PHP's mail function or a library like PHPMailer for sending emails

                // Redirect the user to a confirmation page
                header("Location: reset_confirmation.php");
                exit();
            } else {
                $error_message = "Error updating reset token.";
            }
        } else {
            $error_message = "Email address not found.";
        }

        $stmt->close();
    } else {
        $error_message = "Database query failed.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  
    <link rel="stylesheet" href="assets/css/sign up.css">
</head>
<body>
    <div class="container">
        <br><br><br><br>
        <h2>Forgot Password</h2>
        <p>Please enter your email address to reset your password.</p>
        <form method="post" action="resetpassword.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" name="reset_confirmation.php">Reset Password</button>
        </form>
    </div>
</body>
</html>
