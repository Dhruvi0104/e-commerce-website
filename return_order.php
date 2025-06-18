<?php
session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get order ID from POST
if (isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);
    $email = $_SESSION['email'];

    // Check if the order exists and belongs to the logged-in user
    $order_query = "SELECT * FROM orders WHERE order_id = '$order_id' AND user_email = '$email'";
    $order_result = mysqli_query($conn, $order_query);

    if (mysqli_num_rows($order_result) > 0) {
        // Update the order status to "Return Requested"
        $update_query = "UPDATE orders SET status = 'Return Requested' WHERE order_id = '$order_id' AND user_email = '$email'";

        // Check if query executes successfully
        if (!mysqli_query($conn, $update_query)) {
            // Print the error if update fails
            echo "Error updating order status: " . mysqli_error($conn);
        } else {
            // Success
            echo "Return request submitted successfully!";
            // Redirect after update
            header("Location: order_details.php?order_id=$order_id");
            exit();
        }
    } else {
        echo "Order not found or invalid user.";
    }
} else {
    echo "Invalid request.";
}
?>
