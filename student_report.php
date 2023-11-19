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

// Retrieve admin announcements from the database
$sql = "SELECT * FROM admin_announcements";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Announcements</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/Student dashboard.css">
    <link rel="stylesheet" href="assets/css/report.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="Dashboard.php">My Dashboard</a>
        <button class="navbar-toggler" id="navbar-toggler">&#9776;</button>
        <div class="navbar-menu" id="navbar-menu">
            <a href="program.php"><i class="fas fa-graduation-cap"></i> Programs</a>
            <a href="courses.php"><i class="fas fa-book"></i> Courses</a>
            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a href="report.php"><i class="fas fa-chart-bar"></i> Report</a>
            <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>
    
    <div class="navbar-mobile" id="navbar-mobile"></div>
    <br><br>
    <h2>Announcements</h2>
    <div id="report">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row["announcement_data"] . "</p>";
            }
        } else {
            echo "No announcements available.";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
