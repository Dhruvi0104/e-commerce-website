<?php
session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get order ID from URL
if (!isset($_GET['order_id'])) {
    die("Order ID not specified.");
}

$order_id = intval($_GET['order_id']);
$email = $_SESSION['email'];

// Fetch the order and user details
$query = "
  SELECT 
    o.*, 
    u.address AS user_address, 
    u.name AS user_name, 
    u.email AS user_email 
FROM orders o
JOIN users u ON o.user_email = u.email
WHERE o.order_id = '$order_id' AND o.user_email = '$email'
LIMIT 1
";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Order not found or access denied.");
}

$order = mysqli_fetch_assoc($result);

// Calculate expected delivery date (7 days after the order date)
$order_date = $order['order_date'];
$expected_delivery_date = date('Y-m-d', strtotime($order_date . ' +7 days'));
?>

<?php include 'header.php'; ?>

<div class="order-details-container">
    <h2>Order Details</h2>

    <div class="order-section">
        <h3>Product Information</h3>
        <div class="product-info">
            <img src="imgs/products/<?= $order['image'] ?>" alt="Product Image" width="150">
            <div class="product-details">
                <p><strong>Product:</strong> <?= $order['name'] ?></p>
                <p><strong>Quantity:</strong> <?= $order['quantity'] ?></p>
                <p><strong>Price:</strong> ₹<?= $order['price'] ?></p>
                <p><strong>Total:</strong> ₹<?= $order['price'] * $order['quantity'] ?></p>
            </div>
        </div>
    </div>

    <div class="order-section">
        <h3>Order Status</h3>
        <p><strong>Order Status:</strong> <?= $order['status'] ?></p>
        <p><strong>Order Date:</strong> <?= $order['order_date'] ?></p>
        <p><strong>Expected Delivery Date:</strong> <?= $expected_delivery_date ?></p> <!-- Added expected delivery date -->
    </div>

    <div class="order-section">
        <h3>Shipping Details</h3>
        <div class="shipping-info">
            <p><strong>Name:</strong> <?= $order['user_name'] ?></p>
            <p><strong>Email:</strong> <?= $order['user_email'] ?></p>
            <p><strong>Address:</strong> <?= $order['user_address'] ?? 'Not Available' ?></p>
        </div>
    </div>

    <div class="order-section">
        <h3>Payment Details</h3>
        <p><strong>Payment Method:</strong> <?= $order['payment_method'] ?></p>
        <!-- <p><strong>Payment ID:</strong> <?= $order['payment_id'] ?: 'N/A' ?></p> -->
    </div>

    <!-- Home Button -->
    <div class="home-button">
        <a href="myorders.php">
            <button type="button" class="btn-home">Back to Orders</button>
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
.order-details-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px;
    background: rgb(237, 250, 233);
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 24px;
    color: #333;
}

.order-section {
    margin-bottom: 25px;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
}

.order-section h3 {
    margin-bottom: 15px;
    padding-left: 290px;
    font-size: 20px;
    color: #2d7a49;
}

.order-section p {
    margin: 5px 0;
    font-size: 16px;
    color: #555;
}

.product-info {
    display: flex;
    align-items: center;
}

.product-info img {
    border-radius: 8px;
    margin-right: 20px;
}

.product-details p {
    font-size: 16px;
    padding-left: 60px;
    color: #555;
}

.shipping-info {
    font-size: 16px;
    color: #555;
}

.shipping-info p {
    margin: 8px 0;
}

.home-button {
    text-align: center;
    margin-top: 30px;
}

.btn-home {
    background-color: #2d7a49;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}

.btn-home:hover {
    background-color: #227340;
}
</style>
