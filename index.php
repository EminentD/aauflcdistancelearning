<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to AAU Distance Learning FLC</title>
    <link rel="stylesheet" href="assets/css/body.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <div class="bg-image"></div>
    <div class="container-1st-child">
        <div class="content">
            <h1>Welcome to AAU Distance Learning FLC</h1>
            <p>Your gateway to online education.</p>
            <div class="buttons">
                <button class="login-button"><a href="loginstudent.php">Login As Student </a></button> | <button class="login-button"><a href="adminlogin.php">Login As Admin</a></button>
            </div>
        </div>
    </div>
    <script>
        // JavaScript to hide the preloader and show the content after a delay
        window.addEventListener("load", function () {
            setTimeout(function () {
                document.querySelector(".preloader").style.display = "none";
                document.querySelector(".content").style.display = "block";
            }, 2000); // Adjust the delay (in milliseconds) as needed
        });
    </script>
</body>
</html>
