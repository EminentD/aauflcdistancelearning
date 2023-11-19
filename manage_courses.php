<?php
// Start the session
session_start();

// Include the database configuration
include("aauflcdistancelearning_config.php");

// Fetch available programs for populating the dropdown
$programs = [];
$sql = "SELECT program_id, program_name FROM programs";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <link rel="stylesheet" href="assets/css/managecourses.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION["admin_username"]; ?></h1>
    <h2>Add Course</h2>
    
    <form action="add_courses.php" method="POST">
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required>

        <label for="course_description">Course Description:</label>
        <textarea id="course_description" name="course_description" rows="4" cols="50" required></textarea>

        <label for="instructor_name">Instructor Name:</label>
        <input type="text" id="instructor_name" name="instructor_name" required>

        <label for="program_id">Select Program:</label>
        <select id="program_id" name="program_id" required>
            <?php foreach ($programs as $program) { ?>
                <option value="<?php echo $program["program_id"]; ?>"><?php echo $program["program_name"]; ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Add Course">
    </form>

    <footer>
        <p>&copy; 2023 aauflcdistancelearning. Designed by Eminent All rights reserved.</p>
    </footer>
</body>
</html>
