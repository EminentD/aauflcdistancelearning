<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "aauflcdistance";
$dbname = "aauflcdistancelearning";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to save an admin announcement to the database
function saveAnnouncement($announcementData, $conn) {
    // Add your code to save the announcement to the database
    // $announcementData contains the form inputs submitted by the admin
    // You should validate and sanitize the data before saving it to the database
    $sql = "INSERT INTO admin_announcements (announcement_data) VALUES ('$announcementData')";
    if ($conn->query($sql) === TRUE) {
        return "Announcement saved successfully.";
    } else {
        return "Error: " . $conn->error;
    }
}

$announcementMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["post_announcement"])) {
    $admin_announcement_data = $_POST["admin_announcement_data"];
    $announcementMessage = saveAnnouncement($admin_announcement_data, $conn);

}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Announcements</title>
    <link rel="stylesheet" href="assets/css/report.css">
</head>
<body>
    <h2>Post Announcement</h2>
    <form method="POST" action="">
        <label for="admin_announcement_data">Announcement:</label>
        <textarea id="admin_announcement_data" name="admin_announcement_data" rows="4" cols="50" required></textarea>
        <br>
        <input type="submit" name="post_announcement" value="Post Announcement">
    </form>
</body>
</html>

<?php
$conn->close();
?>
