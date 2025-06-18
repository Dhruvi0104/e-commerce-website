<?php
// Start session and include DB connection
session_start();
require_once('db.php');

// Pagination setup
$limit = 10; // Items per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total count of products
$query = "SELECT COUNT(*) AS total FROM products";
$result = $conn->query($query);
$total = $result->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);

// Fetch products with limit and offset
$query = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="admin-panel">
        <h2>Product List</h2>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php while ($product = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><img src="<?php echo $product['image_path']; ?>" alt="Product Image" width="50"></td>
                    <td><a href="delete_product.php?id=<?php echo $product['id']; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <a href="admin.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>
    </div>
</body>
</html>
