<?php
// Start session to access user data
session_start();

// Include database connection
include('db.php');

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Get the user email
$user_email = $_SESSION['user_email'];

// Fetch the last placed order details
$query = "SELECT * FROM orders WHERE user_email = '$user_email' ORDER BY order_id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Fetch the products in the order
$order_details = [];
if ($order) {
    $order_id = $order['order_id'];
    $order_query = "SELECT * FROM order_items WHERE order_id = '$order_id'";
    $order_result = mysqli_query($conn, $order_query);
    
    while ($item = mysqli_fetch_assoc($order_result)) {
        $order_details[] = $item;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 70%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-summary {
            margin-top: 20px;
        }
        .order-summary h3 {
            margin: 0;
        }
        .order-details {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-details table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: rgb(136, 207, 157);
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 30px;
        }
        .button:hover {
            background-color: rgb(118, 183, 137);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order Confirmation</h2>
    
    <?php if ($order) : ?>
        <div class="order-summary">
            <h3>Order #<?php echo $order['order_id']; ?></h3>
            <p><strong>Shipping Address:</strong> <?php echo $order['address']; ?></p>
            <p><strong>Payment Method:</strong> <?php echo $order['payment_method']; ?></p>
            <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
        </div>

        <div class="order-details">
            <h3>Order Details:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_details as $item) : ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>₹<?php echo $item['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="orders.php" class="button">Go to My Orders</a>
    <?php else : ?>
        <p>Your order could not be found. Please contact support.</p>
    <?php endif; ?>
</div>

</body>
</html>
