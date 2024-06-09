<?php
$servername = "localhost";
$username = "root";
$password = "Ashleytinao26";
$dbname = "auto_parts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
