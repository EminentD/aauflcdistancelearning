<?php
// Start the session (only if it's not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // Create a PDO instance directly with your database credentials
    $pdo = new PDO(
        "mysql:host=localhost;dbname=aauflcdistancelearning",
        "root",
        "aauflcdistance"
    );

    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Include the database configuration
    include("aauflcdistancelearning_config.php");

    // Check if a student is logged in
    if (!isset($_SESSION["student_id"])) {
        header("Location: login.php");
        exit();
    }

    // Initialize an array to store the student's lessons
    $lessons = [];

    // Query to retrieve the student's lessons from the database
    $studentId = $_SESSION["student_id"];
    $sql = "SELECT title, description, content, video_url, zoom_session_link, zoom_session_password FROM lessons";

    // Prepare and execute the query
    $stmt = $pdo->query($sql);

    // Fetch the results and store them in the lessons array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lessons[] = $row;
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Student Lessons</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/Student dashboard.css">
    
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="Dashboard.php">My Dashboard</a>
        <button class="navbar-toggler" id="navbar-toggler">&#9776;</button>
        <div class="navbar-menu" id="navbar-menu">
            <a href="program.php"><i class="fas fa-graduation-cap"></i> Programs</a>
            <a href="#"><i class="fas fa-book"></i> Courses</a>
            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a href="report.php"><i class="fas fa-chart-bar"></i> Report</a>
            <a href="login.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

    </nav>
    
    <div class="navbar-mobile" id="navbar-mobile"></div>
   <br>

    <div class="table-container"> 
        <div class="table-responsive">
            <table>
                <tr>
                    <th data-label="Title">Title</th>
                    <th data-label="Description">Description</th>
                    <th data-label="Content">Content</th>
                    <th data-label="Video URL">Video URL</th>
                    <th data-label="Zoom Session Link">Zoom Session Link</th>
                    <th data-label="Zoom Session Password">Zoom Session Password</th>
                </tr>
                <?php foreach ($lessons as $lesson) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($lesson["title"]); ?></td>
                        <td><?php echo htmlspecialchars($lesson["description"]); ?></td>
                        <td><?php echo htmlspecialchars($lesson["content"]); ?></td>
                        <td><?php echo htmlspecialchars($lesson["video_url"]); ?></td>
                        <td>
                            <?php
                            $zoomSessionLink = $lesson["zoom_session_link"];
                            if (!empty($zoomSessionLink)) {
                                echo '<a href="' . htmlspecialchars($zoomSessionLink) . '" target="_blank">' . htmlspecialchars($zoomSessionLink) . '</a>';
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($lesson["zoom_session_password"]); ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>



</body>
</html>
