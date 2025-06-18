<?php
session_start();
include 'db.php';

// Check admin session
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// Get dynamic stats
$order_result = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM orders");
$product_result = mysqli_query($conn, "SELECT COUNT(*) AS total_products FROM products");
$category_result = mysqli_query($conn, "SELECT COUNT(*) AS total_categories FROM categories");

$total_orders = mysqli_fetch_assoc($order_result)['total_orders'];
$total_products = mysqli_fetch_assoc($product_result)['total_products'];
$total_categories = mysqli_fetch_assoc($category_result)['total_categories'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color:rgb(119, 183, 147);
            padding: 15px;
            color: rgb(57, 112, 81);
            text-align: center;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgb(119, 183, 147);
            height: 100%;
            width: 220px;
            padding-top: 60px;
        }

        .sidebar a {
            display: block;
            color: #ddd;
            padding: 15px 20px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color:rgb(53, 123, 83);
        }

        .main-content {
            margin-left: 220px;
            padding: 40px;
        }

        .dashboard-title {
            font-size: 26px;
            margin-bottom: 30px;
        }

        .card-grid {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            flex: 1;
            min-width: 220px;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin: 0;
            font-size: 22px;
            color: #2d572c;
        }

        .card p {
            font-size: 36px;
            margin-top: 10px;
            font-weight: bold;
            color: #444;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>Admin Dashboard</h2>
    </div>

    <div class="sidebar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="admin_order.php">Manage Orders</a>
        <a href="manage_categories.php">Manage Categories</a>
        <a href="manage_subcategories.php">Manage Subcategories</a>
        <a href="admin_reviews.php">Manage Reviews</a>

        <a href="admin_manage_contacts.php">Manage Contact Messages</a>
        <a href="admin_logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h2 class="dashboard-title">Overview</h2>

        <div class="card-grid">
            <div class="card">
                <h3>Total Orders</h3>
                <p><?= $total_orders ?></p>
            </div>

            <div class="card">
                <h3>Total Products</h3>
                <p><?= $total_products ?></p>
            </div>

            <div class="card">
                <h3>Total Categories</h3>
                <p><?= $total_categories ?></p>
            </div>
        </div>
    </div>

</body>
</html>
