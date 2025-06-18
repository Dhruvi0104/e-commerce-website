<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = intval($_GET['order_id']);

// Get user info
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
$user = mysqli_fetch_assoc($user_query);

// Get order items
$order_items = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = $order_id AND user_email = '$email'");
if (!$order_items || mysqli_num_rows($order_items) == 0) {
    die("No order found.");
}

// Fetch order meta from first row
$order_meta = mysqli_fetch_assoc($order_items);
mysqli_data_seek($order_items, 0);

$grand_total = 0;
?>

<?php include 'header.php'; ?>

<div class="invoice-container">
    <h2>Invoice Summary</h2>

    <p><strong>Address:</strong> <?= $user['address'] ?></p>
    <p><strong>Order Status:</strong> <?= $order_meta['status'] ?></p>

    <table class="invoice-table">
        <tr>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
        <?php while ($item = mysqli_fetch_assoc($order_items)): 
            $total = $item['price'] * $item['quantity'];
            $grand_total += $total;
        ?>
        <tr>
            <td><?= $item['name'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>₹<?= $total ?></td>
        </tr>
        <?php endwhile; ?>
        <tr class="grand-total">
            <td colspan="2" style="text-align:right;"><strong>Total Amount:</strong></td>
            <td><strong>₹<?= $grand_total ?></strong></td>
        </tr>
    </table>
</div>

<?php include 'footer.php'; ?>

<style>
.invoice-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 25px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
}
.invoice-container h2 {
    text-align: center;
    margin-bottom: 20px;
}
.invoice-container p {
    font-size: 16px;
    margin: 5px 0;
}
.invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.invoice-table th, .invoice-table td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    text-align: center;
}
.invoice-table th {
    background-color: #e8f5e9;
}
.grand-total td {
    background-color: #f4fdf4;
    font-size: 18px;
}
</style>
