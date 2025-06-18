<?php
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM cart ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart Details - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f5f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: rgb(93, 153, 102);
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ccc;
        }
        th {
            background: rgb(117, 185, 133);
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        img {
            height: 60px;
        }
    </style>
</head>
<body>

<h2>Cart Products</h2>

<table>
    <tr>
        <th>ID</th>
        <th>User Email</th>
        <th>Product</th>
        <th>Image</th>
        <th>Quantity</th>
        <th>Price</th>
        
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['product_id']; ?></td>
            <td><?= $row['user_email']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><img src="imgs/products/<?= $row['image']; ?>"></td>
            <td><?= $row['quantity']; ?></td>
            <td>₹<?= $row['price']; ?></td>
           
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
