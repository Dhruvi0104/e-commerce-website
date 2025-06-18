<?php
// Start session and check if admin is logged in
session_start();
include('db.php');

// Admin login check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Get order_id from URL
$order_id = $_GET['order_id'];

// Fetch the order details
$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$order_result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($order_result);

// Fetch the products in the order
$order_details = [];
if ($order) {
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
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
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
            padding: 10px;
            background-color: rgb(136, 207, 157);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order #<?php echo $order['order_id']; ?> - Details</h2>
    
    <h3>Shipping Address:</h3>
    <p><?php echo $order['address']; ?></p>

    <h3>Payment Method:</h3>
    <p><?php echo $order['payment_method']; ?></p>

    <h3>Status:</h3>
    <p><?php echo $order['status']; ?></p>

    <h3>Products in the Order:</h3>
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
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>₹<?php echo $item['price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin_orders.php" class="button">Back to Orders</a>
</div>

</body>
</html>
