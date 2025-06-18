<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    // Redirect to the login page if not logged in as admin
    header("Location: admin_login.php");
    exit();
}

// Fetch orders from the database
$orders_query = mysqli_query($conn, "SELECT * FROM orders");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
            font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f1f1f1;
            color: #333;
            font-weight: bold;
        }
        td {
            background-color: #fff;
            color: #555;
        }
        .order-status-select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 150px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-update {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-update:hover {
            background-color: #45a049;
        }
        .order-card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .order-card img {
            max-width: 120px;
            object-fit: cover;
            margin-right: 20px;
        }
        .order-card .order-details,
        .order-card .order-actions {
            flex: 1;
        }
        .order-details {
            margin-bottom: 20px;
        }
        .order-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .order-actions form {
            display: flex;
            align-items: center;
        }
        .order-actions select {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage Orders</h1>

    <?php while ($order = mysqli_fetch_assoc($orders_query)): ?>
        <div class="order-card">
            <div class="order-details">
                <strong>Order ID:</strong> <?= $order['order_id'] ?><br><br>
                <strong>User Email:</strong> <?= $order['user_email'] ?><br><br>
                <strong>Product Name:</strong> <?= $order['name'] ?><br><br>
                <strong>Quantity:</strong> <?= $order['quantity'] ?><br><br>
                <strong>Status:</strong> <?= $order['status'] ?><br><br>

                <strong>Payment Status:</strong>
                <?php
                echo ($order['payment_status'] == 1) ? 'Paid' : 'Pending';
                ?>
            </div>

            <div class="order-image">
                <?php
                // Assuming the product image is stored in the 'imgs/products' folder
                $product_image = 'imgs/products/' . $order['image']; 
                ?>
                <img src="<?= $product_image ?>" alt="Product Image">
            </div>

            <div class="order-actions">
                <form action="update_status.php" method="POST">
                    <input type="hidden" name="id" value="<?= $order['order_id'] ?>">
                    <select class="order-status-select" name="status">
                        <option value="Placed" <?= ($order['status'] == 'Placed') ? 'selected' : '' ?>>Placed</option>
                        <option value="Shipped" <?= ($order['status'] == 'Shipped') ? 'selected' : '' ?>>Shipped</option>
                        <option value="Delivered" <?= ($order['status'] == 'Delivered') ? 'selected' : '' ?>>Delivered</option>
                    </select>
                    <button class="btn-update" type="submit">Update Status</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<script type="text/javascript">
    // Prevent browser back button
    window.history.forward();
    window.onpopstate = function() {
        window.history.forward();
    };
</script>

</body>
</html>
