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

// Fetch all orders for the user
$query = "SELECT * FROM orders WHERE user_email = '$user_email' ORDER BY order_id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
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
        .order-list {
            margin-top: 20px;
        }
        .order-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-list table, th, td {
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
    <h2>My Orders</h2>

    <div class="order-list">
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>₹<?php echo $row['total_price']; ?></td>
                            <td><a href="order_details.php?order_id=<?php echo $row['order_id']; ?>" class="button">View Details</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>You have no orders yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
