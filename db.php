<?php
$host = "localhost";     // XAMPP ke liye localhost
$user = "root";          // default MySQL username
$pass = "";              // default password is empty
$db   = "database";     // tumhara database name
$port="3306";
$conn = new mysqli($host, $user, $pass, $db , $port);

// Connection check
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
}
?>
