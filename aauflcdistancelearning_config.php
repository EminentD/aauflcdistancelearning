<?php
$servername = "localhost";
$username = "root";
$password = "aauflcdistance";
$dbname = "aauflcdistancelearning";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection and handle errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
