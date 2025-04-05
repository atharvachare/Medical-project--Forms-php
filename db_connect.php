<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";  // Default is empty in XAMPP
$dbname = "hospital_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>