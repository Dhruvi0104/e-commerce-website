<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// --- Add to cart logic ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $user_email = $_SESSION['email'] ?? '';
    $product_id = $_POST['product_id'];

    if ($user_email && $product_id) {
        // Fetch product
        $query = "SELECT * FROM products WHERE product_id = $product_id";
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);

        // Fetch user details
        $user_query = mysqli_query($conn, "SELECT * FROM users WHERE email='$user_email'");
        $user = mysqli_fetch_assoc($user_query);

        $user_id = $user['id'] ?? null;
        $username = $user['name'] ?? null; // Change 'name' if your column is different

        if ($product && $user_id && $username) {
            $check = "SELECT * FROM cart WHERE user_email='$user_email' AND product_id=$product_id";
            $exists = mysqli_query($conn, $check);

            if (mysqli_num_rows($exists) > 0) {
                $update = "UPDATE cart SET quantity = quantity + 1 WHERE user_email='$user_email' AND product_id=$product_id";
                mysqli_query($conn, $update);
            } else {
                $insert = "INSERT INTO cart (user_id, username, user_email, product_id, name, price, image, quantity)
                           VALUES ($user_id, '$username', '$user_email', $product_id, '{$product['name']}', {$product['price']}, '{$product['image']}', 1)";
                mysqli_query($conn, $insert);
            }

            echo "<script>alert('Product added to cart!'); window.location.href='cart.php';</script>";
        } else {
            echo "<script>alert('Product or user not found.'); window.location.href='cart.php';</script>";
        }
    } else {
        echo "<script>alert('Please login first.'); window.location.href='login.php';</script>";
    }
}

// --- Remove item from cart ---
if (isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = $remove_id");
    echo "<script>alert('Item removed from cart.'); window.location.href='cart.php';</script>";
}
?>

<?php include 'header.php'; ?>

<div class="form-container">
    <h2>Your Shopping Cart </h2>
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr style="background-color: #e6ffe6;">
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        <?php
        $user_email = $_SESSION['email'] ?? '';
        $total = 0;
        if ($user_email) {
            $query = "SELECT * FROM cart WHERE user_email='$user_email'";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
                echo "
                <tr>
                    <td><img src='imgs/products/{$row['image']}' width='80'></td>
                    <td>{$row['name']}</td>
                    <td>₹{$row['price']}</td>
                    <td>{$row['quantity']}</td>
                    <td>₹$subtotal</td>
                    <td>
                        <form method='POST' action='cart.php'>
                            <input type='hidden' name='remove_id' value='{$row['id']}'>
                            <button type='submit'>Remove</button>
                        </form>
                    </td>
                </tr>";
            }
        }
        ?>
    </table>

    <h3 style="text-align: right; margin-top: 20px;">Total: ₹<?= $total ?></h3>

    <div style="text-align: right; margin-top: 20px;">
        <a href="checkout.php" style="display: inline-block; padding: 10px 20px; background-color: rgb(136, 207, 157); color: white; text-decoration: none; border-radius: 5px;">Proceed to Checkout</a>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
    .form-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #d5f5d5;
    }
    img {
        border-radius: 6px;
    }
    button {
        background-color: #ff4d4d;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #cc0000;
    }
</style>
