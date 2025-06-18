<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];

$query = "SELECT SUM(p.price * c.quantity) AS total_amount 
          FROM cart c
          JOIN products p ON c.product_id = p.product_id
          WHERE c.user_email = '$user_email'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalAmount = $row['total_amount'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .payment-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        .payment-container h2 {
            text-align: center;
            color: #4b5c3b;
            margin-bottom: 25px;
        }
        .payment-container p {
            text-align: center;
            font-size: 18px;
            margin-bottom: 25px;
            color: #444;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-size: 16px;
            color: #333;
        }
        input[type="radio"] {
            margin-right: 8px;
        }
        button {
            background-color: #6b8e23;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #5c7e1f;
        }
        .empty-message {
            text-align: center;
            color: #d9534f;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Complete Your Payment</h2>
        <p>Pay ₹<?php echo number_format($totalAmount, 2); ?></p>
        <?php if ($totalAmount > 0): ?>
            <form method="POST" action="process_payment.php">
                <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
                <label><input type="radio" name="payment_method" value="COD" checked> Cash on Delivery</label>
                <label><input type="radio" name="payment_method" value="Online"> Online Payment (Razorpay)</label>
                <button type="submit">Proceed to Pay</button>
            </form>
        <?php else: ?>
            <p class="empty-message">Your cart is empty. Please add items to proceed.</p>
        <?php endif; ?>
    </div>
</body>
</html>
