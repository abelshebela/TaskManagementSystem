<?php
$host = "localhost"; // Replace with your MySQL server host
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "task_management"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
