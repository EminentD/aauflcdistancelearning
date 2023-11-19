<?php
// Start the session
session_start();

// Include the database configuration
include("aauflcdistancelearning_config.php");

// Initialize variables
$emailErr = $passwordErr = "";
$email = $password = "";
$loginErr = "";

// Check if the connection to the database is successful
try {
    $conn = new PDO("mysql:host=localhost;dbname=aauflcdistancelearning", "root", "aauflcdistance");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Example query (use prepared statements for security)
    $sql = "SELECT student_id, email, password FROM students WHERE email = ? LIMIT 1";

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
    } catch (PDOException $e) {
        die("Prepare failed: " . $e->getMessage());
    }

    // Check if the SQL statement is prepared successfully
    if (!$stmt) {
        die("Prepare failed: " . print_r($conn->errorInfo(), true));
    }

    // Bind parameters
    try {
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
    } catch (PDOException $e) {
        die("Bind failed: " . $e->getMessage());
    }

    // Execute the statement
    try {
        $stmt->execute();
    } catch (PDOException $e) {
        die("Execute failed: " . $e->getMessage());
    }

    // Get the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Verify the password using password_verify()
        if (password_verify($password, $result["password"])) {
            // Password is correct; set user session data
            $_SESSION["student_id"] = $result["student_id"];

            // Redirect to the dashboard
            header("Location: Dashboard.php");
            exit();
        } else {
            $loginErr = "Invalid email or password.";
        }
    } else {
        $loginErr = "Student not found.";
    }
}

// Close the database connection
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AAU FLC Distance learning Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
            <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
            <link rel="stylesheet"  href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
            <link rel="stylesheet"  href="vendor/animate/animate.css">
        <!--===============================================================================================-->	
            <link rel="stylesheet"  href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
            <link rel="stylesheet"  href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">    
        <link rel="stylesheet" href="assets/css/sign in.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <!--===============================================================================================-->
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <img src="assets/images/aau.png" alt="IMG">
                    <form method="post" action="login.php" id="login-form">
                        <span class="login100-form-title">
                            Student Login
                        </span>
                        <div class="form-group">
                            <label for="email"><i class="fa fa-envelope"></i> Email:</label>
                            <input type="text" name="email" id="email" required>
                            <span class="focus-input100"></span>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fa fa-lock"></i> Password:</label>
                            <input type="password" name="password" id="password" required>
                            <span class="focus-input100"></span>
                        </div>
                        <?php if (!empty($loginErr)): ?>
                            <p style="color: red;"><?php echo $loginErr; ?></p>
                        <?php endif; ?>
                        <button type="submit" class="btn-submit"><i class="fa fa-sign-in"></i> Login</button>
                        <div class="text-center p-t-12">
                            <span class="txt1"><i class="fa fa-question-circle"></i> Forgot</span>
                            <u><a class="txt2" href="forgetpassword.php">Username / Password?</a></u>
                        </div>
                        <br>
                        <div class="text-center p-t-136">
                            <a class="txt2" href="signup.php">
                                Create your Account <i class="fa fa-long-arrow-right m-l-5"></i> <i class="fa fa-user-plus"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
        // Function to validate the login form
        function validateLoginForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var loginErrElement = document.getElementById("login-error");

            // Basic email format validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                loginErrElement.innerText = "Invalid email format.";
                return false;
            }

            // Password should not be empty
            if (password.trim() === "") {
                loginErrElement.innerText = "Please enter a password.";
                return false;
            }

            return true;
        }

        // Attach the form validation to the form submit event
        document.getElementById("login-form").addEventListener("submit", function (event) {
            if (!validateLoginForm()) {
                event.preventDefault(); // Prevent the form from submitting if validation fails
            }
        });
    </script>
    </body>
</html>

