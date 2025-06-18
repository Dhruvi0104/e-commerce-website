<?php
require_once('db.php'); // Include database connection

if (isset($_GET['id'])) {
    $product_id = $_GET['product_id'];

    // Delete product from database
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    // Redirect back to admin panel
    header("Location: admin.php?message=Product Deleted Successfully");
    exit;
}
?>
