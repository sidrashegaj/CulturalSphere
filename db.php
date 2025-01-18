<?php
$host = 'localhost';  // XAMPP or WAMP default is localhost
$user = 'root';       // Default username for XAMPP/WAMP is 'root'
$password = '';       // Default password is empty
$database = 'cultural_sphere'; // Your database name

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
