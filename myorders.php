<?php
session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = mysqli_real_escape_string($conn, $_SESSION['email']);
$orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_email='$email' ORDER BY order_id DESC");

if (!$orders) {
    die("Error in SQL query: " . mysqli_error($conn));
}
?>

<?php include 'header.php'; ?>

<div class="orders-container">
    <h2>My Orders</h2>

    <?php if (mysqli_num_rows($orders) > 0): ?>
    <table>
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($order = mysqli_fetch_assoc($orders)): ?>
        <tr>
            <td>
                <a href="order_details.php?order_id=<?= $order['order_id'] ?>">
                    <img src="imgs/products/<?= $order['image'] ?>" width="60">
                </a>
            </td>
            <td><?= $order['name'] ?></td>
            <td><?= $order['quantity'] ?></td>
            <td>₹<?= $order['price'] ?></td>
            <td>₹<?= $order['price'] * $order['quantity'] ?></td>
            <td><?= $order['order_date'] ?></td>
            <td><?= $order['status'] ?></td> <!-- Display status -->
            <td>
                <?php if ($order['status'] == 'Pending'): ?>
                    <form method="POST" action="cancel_order.php">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <button type="submit" class="cancel-btn">Cancel</button>
                    </form>
                <?php elseif ($order['status'] == 'Delivered'): ?>
                    <form method="POST" action="return_order.php">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <button type="submit" class="return-btn">Return</button>
                    </form>
                <?php else: ?>
                    <span style="color: gray;">N/A</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>You haven't placed any orders yet.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

<style>
.orders-container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 25px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
}
h2 {
    text-align: center;
    margin-bottom: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #ccc;
    text-align: center;
}
th {
    background-color: #f4fdf4;
}
img {
    border-radius: 5px;
}
.cancel-btn, .return-btn {
    padding: 6px 12px;
    background-color: rgb(228, 78, 78);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.cancel-btn:hover, .return-btn:hover {
    background-color: rgb(184, 38, 38);
}
</style>
