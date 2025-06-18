<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];
$total = 0;

// Fetch cart items
$cart_items = mysqli_query($conn, "SELECT * FROM cart WHERE user_email='$user_email'");
?>

<?php include 'header.php'; ?>

<div class="checkout-container">
    <h2>Checkout</h2>

    <?php
$count = mysqli_num_rows($cart_items);
echo "<p>Items found in cart: $count</p>"; // debug
if ($count > 0): ?>

    <table>
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>

        <?php while ($item = mysqli_fetch_assoc($cart_items)): 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        ?>
        <tr>
            <td><img src="imgs/products/<?= $item['image'] ?>" width="60"></td>
            <td><?= $item['name'] ?></td>
            <td>₹<?= $item['price'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>₹<?= $subtotal ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3 style="text-align: right;">Total: ₹<?= $total ?></h3>

    <form method="POST" action="payment.php">
    <button type="submit" class="place-btn">Proceed to Payment</button>
</form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

<style>
    .checkout-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 25px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #e6ffe6;
    }
    img {
        border-radius: 5px;
    }
    .place-btn {
        padding: 12px 25px;
        background-color: rgb(145, 207, 163);
        color: white;
        border: none;
      
        border-radius: 6px;
        cursor: pointer;
    }
    .place-btn:hover {
        background-color:rgb(72, 147, 97);
    }
</style>
