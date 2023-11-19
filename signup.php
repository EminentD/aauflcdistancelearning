<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = $_POST["username"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    // Insert the new student record into the database
    $sql = "INSERT INTO students (username, first_name, last_name, email, password)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    if ($stmt) { // Check if the statement was prepared successfully
        $stmt->bind_param("sssss", $username, $first_name, $last_name, $email, $password);
        
        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            // Registration failed
            $registrationError = "Registration failed. Please try again.";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Statement preparation failed
        $registrationError = "Registration failed. Please try again.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>AAU Distance Learning FLC Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  
    <link rel="stylesheet" href="assets/css/sign up.css">
</head>
<body>
    <section id="title-header">   
        <div class="title">  
            Ambrose Alli University<br>Foreign Links Campus P. M. B 14, 
            <br>Ife 
            Osun state,
            Nigeria
        <p class="subtitle"> WEB-BASED SYSTEM FOR DISTANCE LEARNING</p> 
        </div>
    </section> 
    <div class="container">
        <h2>Sign Up</h2>
        <form method="post" action="signup.php">
            <div class="form-group">
                <label for="username"><i class="fa fa-user" aria-hidden="true"></i> Username:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <span class="focus-input100"></span>
            </div>
            <div class="form-group">
                <label for="firstname"><i class="fa fa-user" aria-hidden="true"></i> Firstname:</label>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                <span class="focus-input100"></span>
            </div>
            <div class="form-group">
                <label for="lastname"><i class="fa fa-user" aria-hidden="true"></i> Lastname:</label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                <span class="focus-input100"></span>
            </div>
            <div class="form-group">
                <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i> Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <span class="focus-input100"></span>
            </div>
            <div class="form-group">
                <label for="level"><i class="fa fa-envelope" aria-hidden="true"></i> Level:</label>
                <input type="text" id="level" name="level" placeholder="Level" required>
                <span class="focus-input100"></span>
            </div>
            <div class="form-group">
                <label for="password"><i class="fa fa-key" aria-hidden="true"></i> Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="focus-input100"></span>
            </div>
            <div id="error-message" class="error"></div>
            <button type="submit" class="btn-submit">Sign Up</button>
        </form>

    </div>
    <br>
    <footer style="height: 180px;padding: 5px;background-color: #0000FF; color:#fff;">
        <p class=""style="float:left">&copy; Ambrose Alli University Flc Distance learning</p>
        <p class="" style="float:right;font-size:15px;">Designed by Eminent</p>
    </footer>
    <script>
        // JavaScript code for handling form submission via AJAX
        document.getElementById("signup.php").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the form from submitting

            var username = document.getElementById("username").value;
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Perform client-side validation if needed
            if (username.trim() === "" || firstname.trim() === "" || lastname.trim() === "" || email.trim() === "" || password.trim() === "") {
                document.getElementById("error-message").innerText = "Please fill in all the required fields.";
                return;
            }

            var data = {
                username: username,
                firstname: firstname,
                lastname: lastname,
                email: email,
                password: password
            };

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "signup.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            window.location.href = "login.php";
                        } else {
                            document.getElementById("error-message").innerText = response.message;
                        }
                    } else {
                        document.getElementById("error-message").innerText = "An error occurred. Please try again later.";
                    }
                }
            };

            xhr.send("username=" + encodeURIComponent(username) + "&firstname=" + encodeURIComponent(firstname) + "&lastname=" + encodeURIComponent(lastname) + "&email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
        });
    </script>
</body>
</html>
