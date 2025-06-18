<?php
require_once('db.php'); // Include database connection

// Hardcoded admin credentials (You can change this)
$username = 'admin';
$password = 'admin123'; // The password should be hashed for security

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the admin user into the database
$query = "INSERT INTO admin_users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $hashed_password);
$stmt->execute();

echo "Admin user added successfully!";
?>
