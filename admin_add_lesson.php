<?php
// Include the database configuration
include("aauflcdistancelearning_config.php");

// Handle form submission and database insertion here
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Create a PDO instance using the database configuration
        $pdo = new PDO(
            "mysql:host=localhost;dbname=aauflcdistancelearning",
            "root",
            "aauflcdistance"
        );

        // Set PDO to throw exceptions on errors
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get form data
        $title = $_POST["title"];
        $description = $_POST["description"];
        $content = $_POST["content"];
        $video_url = $_POST["video_url"];
        $zoom_session_link = $_POST["zoom_session_link"]; // New field for Zoom session link
        $zoom_session_password = $_POST["zoom_session_password"]; // New field for Zoom session password

        // Prepare the SQL query
        $sql = "INSERT INTO lessons (title, description, content, video_url, zoom_session_link, zoom_session_password) VALUES (:title, :description, :content, :video_url, :zoom_session_link, :zoom_session_password)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':video_url', $video_url, PDO::PARAM_STR);
        $stmt->bindParam(':zoom_session_link', $zoom_session_link, PDO::PARAM_STR);
        $stmt->bindParam(':zoom_session_password', $zoom_session_password, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Redirect to admin lessons page after successful insertion
        header("Location: success.php?success=1");
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Lesson</title>
    <link rel="stylesheet" href="assets/css/managelessons.css">
</head>
<body>
    <h2>Add New Lesson</h2>

    <form action="admin_add_lesson.php" method="POST">
        <label for="title">Lesson Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea>

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="4" cols="50" required></textarea>

        <label for="video_url">Video URL:</label>
        <input type="text" id="video_url" name="video_url">

       <!-- New field for Zoom session link (admin input) -->
        <label for="zoom_session_link">Zoom Session Link (Admin):</label>
        <input type="text" id="zoom_session_link" name="zoom_session_link">

        <!-- New field for Zoom session password -->
        <label for="zoom_session_password">Zoom Session Password:</label>
        <input type="text" id="zoom_session_password" name="zoom_session_password">

        <input type="submit" value="Add Lesson">
    </form>

    <a href="admin_lessons.php">Back to Admin Lessons</a>
</body>
</html>
