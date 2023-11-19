<?php
// Check if the 'success' parameter is set in the URL
$success = isset($_GET['success']) ? $_GET['success'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Success Message</title>
    <link rel="stylesheet" href="assets/css/success.css"> <!-- Add your CSS file here -->
</head>
<body>
    <div class="success-container">
        <?php
        if ($success) {
            // Display the success message
            echo '<h2>Lesson Added Successfully</h2>';
            echo '<p>Your lesson has been added successfully.</p>';
            echo '<a href="admin_add_lesson.php">Back to Admin Lessons</a>';
        } else {
            // Display a different message or redirect if not successful
            echo '<h2>Oops! Something went wrong.</h2>';
            echo '<p>Sorry, there was an error adding the lesson.</p>';
        }
        ?>
    </div>
</body>
</html>
