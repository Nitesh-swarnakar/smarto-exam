<?php
$servername = "localhost";
$username = "root";  // Default XAMPP MySQL user
$password = "";      // Default XAMPP MySQL password (empty)
$dbname = "exam_hall_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>