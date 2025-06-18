<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get the order ID from the URL
$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    echo "Order ID not found.";
    exit();
}

// Fetch the order details for this order ID
$query = "SELECT * FROM orders WHERE order_id = '$order_id' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $order = mysqli_fetch_assoc($result);
} else {
    echo "Order not found.";
    exit();
}

// Fetch user address from users table using session email
$user_email = $_SESSION['email'];
$user_query = "SELECT address FROM users WHERE email = '$user_email' LIMIT 1";
$user_result = mysqli_query($conn, $user_query);

$user_address = '';
if (mysqli_num_rows($user_result) > 0) {
    $user = mysqli_fetch_assoc($user_result);
    $user_address = $user['address'];
}
?>

<?php include 'header.php'; ?>

<div class="thank-you-container">
    <h2>Thank You for Your Order!</h2>
    <!-- <p>Your order ID: <strong><?= $order['order_id'] ?></strong></p> -->
    <p>Order Date: <?= $order['order_date'] ?></p>
    <p>Status: <?= $order['status'] ?></p>
    <p>Delivery Address: <?= htmlspecialchars($user_address) ?></p>

    <h3>Products in Your Order:</h3>
    <table class="order-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all products under the same group_id
            $products = mysqli_query($conn, "SELECT * FROM orders WHERE group_id = '{$order['group_id']}'");
            $grand_total = 0; // Initialize grand total variable
            while ($product = mysqli_fetch_assoc($products)) {
                $total_price = $product['price'] * $product['quantity'];
                $grand_total += $total_price; // Add product total to grand total
                echo "<tr>
                        <td>{$product['name']}</td>
                        <td>{$product['quantity']}</td>
                        <td>₹{$product['price']}</td>
                        <td>₹$total_price</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <h3 class="grand-total">Total Amount: ₹<?= $grand_total ?></h3>

    <div class="thank-you-actions">
        <a href="indexx.php" class="back-home-btn">Go to Home</a>
        <a href="myorders.php" class="view-orders-btn">View All Orders</a>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
    .thank-you-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 25px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }

    .thank-you-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2d6a4f;
    }

    .thank-you-container p {
        font-size: 16px;
        text-align: center;
        margin: 5px 0;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .order-table th,
    .order-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .order-table th {
        background-color: #f4fdf4;
    }

    .grand-total {
        text-align: center;
        font-size: 20px;
        color: #2d6a4f;
        margin-top: 20px;
    }

    .thank-you-actions {
        display: flex;
        justify-content: space-around;
        margin-top: 30px;
    }

    .thank-you-actions a {
        padding: 10px 20px;
        background-color: #2d6a4f;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .thank-you-actions a:hover {
        background-color: #1d4a34;
    }

    .thank-you-actions .back-home-btn {
        background-color: #4caf50;
    }

    .thank-you-actions .back-home-btn:hover {
        background-color: #45a049;
    }

    .thank-you-actions .view-orders-btn {
        background-color: #4caf50;
    }

    .thank-you-actions .view-orders-btn:hover {
        background-color: #45a049;
    }
</style>
