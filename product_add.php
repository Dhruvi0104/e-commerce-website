<?php
// Start session and include DB connection
session_start();
require_once('db.php');

// Add product functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['product_image'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $max_file_size = 5 * 1024 * 1024; // 5MB limit

    // Check if file is a valid image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check === false) {
        $error_msg = "File is not an image.";
    }

    // Check file size
    if ($_FILES["product_image"]["size"] > $max_file_size) {
        $error_msg = "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Move the uploaded file to the target directory
    if (!isset($error_msg) && move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        // Insert product into database
        $query = "INSERT INTO products (name, price, image_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $product_name, $product_price, $target_file);
        $stmt->execute();
        
        // Redirect to admin page after product is added
        header("Location: admin.php?message=Product Added Successfully");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your styles here -->
</head>
<body>
    <div class="add-product-container">
        <h2>Add New Product</h2>
        <?php if (isset($error_msg)) { echo "<p class='error'>$error_msg</p>"; } ?>
        <form action="product_add.php" method="POST" enctype="multipart/form-data">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="product_price">Price</label>
            <input type="number" id="product_price" name="product_price" required>

            <label for="product_image">Product Image</label>
            <input type="file" id="product_image" name="product_image" required>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
