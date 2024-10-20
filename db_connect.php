<?php
$host = 'localhost';
$db = 'blog_db';
$user = 'root';  // Change to your MySQL username if different
$pass = '';      // Add your password if set

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
