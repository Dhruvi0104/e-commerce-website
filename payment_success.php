<?php
session_start();
include 'db.php';

// Get payment details from Razorpay
$payment_id = $_GET['payment_id'] ?? '';
$order_id = $_GET['order_id'] ?? '';
$user_email = $_GET['email'] ?? ($_SESSION['email'] ?? '');

// Safety check
if (empty($user_email)) {
    echo "User not found!";
    exit();
}

$order_date = date("Y-m-d H:i:s");

// Get user name
$user_result = mysqli_query($conn, "SELECT name FROM users WHERE email='$user_email'");
$user_data = mysqli_fetch_assoc($user_result);
$user_name = $user_data['name'] ?? 'Customer';

// Get all cart items
$cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE user_email='$user_email'");

if (mysqli_num_rows($cart_items) > 0) {
    while ($item = mysqli_fetch_assoc($cart_items)) {
        $product_id = $item['product_id'];
        $name = mysqli_real_escape_string($conn, $item['name']);
        $price = $item['price'];
        $quantity = $item['quantity'];
        $image = mysqli_real_escape_string($conn, $item['image']);

        // Insert into orders
        $insert = "INSERT INTO orders (user_email, product_id, name, price, quantity, image, order_date, payment_method, status, razorpay_payment_id, razorpay_order_id)
                   VALUES ('$user_email', $product_id, '$name', $price, $quantity, '$image', '$order_date', 'Online', 'Success', '$payment_id', '$order_id')";
        mysqli_query($conn, $insert);
    }

    // Clear the cart
    mysqli_query($conn, "DELETE FROM cart WHERE user_email='$user_email'");
} else {
    echo "<h2>Your cart is empty!</h2>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            padding: 60px;
            background: #f0fff0;
        }
        .box {
            background: #fff;
            display: inline-block;
            padding: 30px 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h1 {
            color: green;
        }
        p {
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            background: green;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Thank you, <?php echo $user_name; ?>!</h1>
        <p>Your payment was successful.</p>
        <p><strong>Payment ID:</strong> <?php echo $payment_id; ?></p>
        <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
        <a href="index.php">Continue Shopping</a>
    </div>
</body>
</html>
