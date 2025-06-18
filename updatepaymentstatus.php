<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $transaction_id = $_POST['transaction_id'];
    $paid_at = $_POST['paid_at'];

    // Update payment status in orders table
    $update_query = "UPDATE orders SET payment_status = '$payment_status', transaction_id = '$transaction_id', paid_at = '$paid_at' WHERE order_id = $order_id";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: admin_order.php");
        exit();
    } else {
        echo "Error updating payment status: " . mysqli_error($conn);
    }
}
?>
