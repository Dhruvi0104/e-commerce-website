<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];
$total_amount = $_GET['amount'] ?? 0;
$payment_method = $_GET['method'] ?? 'COD';
$razorpay_payment_id = $_GET['payment_id'] ?? null;
$razorpay_order_id = $_GET['order_id'] ?? null;
$order_date = date("Y-m-d H:i:s");
$status = 'Pending';

// Get user ID
$user_result = mysqli_query($conn, "SELECT id FROM users WHERE email='$user_email'");
$user_data = mysqli_fetch_assoc($user_result);
$user_id = $user_data['id'];

// Get all items from cart
$cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE user_email='$user_email'");

$group_id = uniqid(); // Generate a unique group ID for this order

// Insert each item into the orders table
while ($item = mysqli_fetch_assoc($cart_items)) {
    $product_id = $item['product_id'];
    $name = mysqli_real_escape_string($conn, $item['name']);
    $price = $item['price'];
    $quantity = $item['quantity'];
    $image = $item['image'];

    $query = "INSERT INTO orders (user_email, user_id, total_amount, payment_method, order_date, status, name, price, quantity, product_id, image, group_id";

    if ($payment_method === 'Online' && $razorpay_order_id) {
        $query .= ", razorpay_order_id, payment_id";
    }

    $query .= ") VALUES ('$user_email', '$user_id', '$total_amount', '$payment_method', '$order_date', '$status', '$name', '$price', '$quantity', '$product_id', '$image', '$group_id'";

    if ($payment_method === 'Online' && $razorpay_order_id) {
        $query .= ", '$razorpay_order_id', '$razorpay_payment_id'";
    }

    $query .= ")";

    mysqli_query($conn, $query);
}

// Get the last inserted order ID (to pass to thank_you page)
$order_id = mysqli_insert_id($conn);

// Clear the cart
mysqli_query($conn, "DELETE FROM cart WHERE user_email = '$user_email'");

// Redirect to thank you page with the order ID
header("Location: thank_you.php?order_id=$order_id");
exit();
?>
