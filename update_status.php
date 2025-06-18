<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Get form data
$order_id = $_POST['id'];
$status = $_POST['status'];

// Update the order status in the database
$update_query = "UPDATE orders SET status='$status' WHERE order_id='$order_id'";

if (mysqli_query($conn, $update_query)) {
    header("Location: admin_order.php");  // Redirect to manage orders page
    exit();
} else {
    echo "Error updating status: " . mysqli_error($conn);
}
?>
