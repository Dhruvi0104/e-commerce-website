<?php
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getCategories($conn) {
    return $conn->query("SELECT * FROM categories");
}

function getSubcategories($conn) {
    return $conn->query("SELECT * FROM subcategories");
}

function getCategoryName($conn, $id) {
    $res = $conn->query("SELECT name FROM categories WHERE id=$id");
    return $res->fetch_assoc()['name'] ?? '';
}

function getSubcategoryName($conn, $id) {
    $res = $conn->query("SELECT name FROM subcategories WHERE id=$id");
    return $res->fetch_assoc()['name'] ?? '';
}

// --- ADD PRODUCT ---
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $cat_id = $_POST['category_id'];
    $subcat_id = $_POST['subcategory_id'];
    $image = $_FILES['image']['name'];

    if (!empty($name) && !empty($price) && !empty($stock) && !empty($image)) {
        $path = "imgs/products/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $stmt = $conn->prepare("INSERT INTO products (name, price, stock, category_id, subcategory_id, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdisss", $name, $price, $stock, $cat_id, $subcat_id, $image);
        $stmt->execute();
    }
}

// --- DELETE PRODUCT ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE product_id = $id");
}

// --- UPDATE PRODUCT ---
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $cat_id = $_POST['category_id'];
    $subcat_id = $_POST['subcategory_id'];
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        $path = "imgs/products/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=?, category_id=?, subcategory_id=?, image=? WHERE product_id=?");
        $stmt->bind_param("sdisssi", $name, $price, $stock, $cat_id, $subcat_id, $image, $id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=?, category_id=?, subcategory_id=? WHERE product_id=?");
        $stmt->bind_param("sdissi", $name, $price, $stock, $cat_id, $subcat_id, $id);
    }
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f5f2;
            padding: 20px;
        }
        h2 {
            color: rgb(104, 173, 123);
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        input[type="text"], input[type="number"], select {
            padding: 8px;
            width: 250px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="file"] {
            margin: 10px 0;
        }
        input[type="submit"], a.button {
            background: rgb(124, 212, 164);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        a.button {
            background:rgb(72, 190, 249);
        }
        a.button:hover, input[type="submit"]:hover {
            opacity: 0.8;
        }
        .edit-btn {
            background-color: #5bc0de;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            vertical-align: top;
            text-align: center;
        }
        th {
            background-color: rgb(138, 232, 177);
            color: white;
        }
        td img {
            height: 100px;
        }
        tr:nth-child(even) {
            background-color:rgb(241, 247, 245);
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions a {
            margin: 0 5px;
        }
        footer {
            text-align: center;
            padding: 15px;
            margin-top: 40px;
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>

<h2>Manage Products</h2>

<!-- Add Product Form -->
<form method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br>
    <input type="number" name="stock" placeholder="Stock" required><br>
    <select name="category_id" required>
        <option value="">Select Category</option>
        <?php foreach (getCategories($conn) as $cat): ?>
            <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
        <?php endforeach; ?>
    </select><br>
    <select name="subcategory_id">
        <option value="">Select Subcategory</option>
        <?php foreach (getSubcategories($conn) as $subcat): ?>
            <option value="<?= $subcat['id']; ?>"><?= $subcat['name']; ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="file" name="image" required><br>
    <input type="submit" name="add" value="Add Product">
</form>

<!-- Product Table -->
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Category</th><th>Subcategory</th><th>Image</th><th>Actions</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['product_id']; ?></td>
            <td>
                <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['product_id']): ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $row['product_id']; ?>">
                        <input type="text" name="name" value="<?= $row['name']; ?>" required><br>
                        <input type="number" step="0.01" name="price" value="<?= $row['price']; ?>" required><br>
                        <input type="number" name="stock" value="<?= $row['stock']; ?>" required><br>
                        <select name="category_id" required>
                            <?php foreach (getCategories($conn) as $cat): ?>
                                <option value="<?= $cat['id']; ?>" <?= $cat['id'] == $row['category_id'] ? 'selected' : '' ?>>
                                    <?= $cat['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br>
                        <select name="subcategory_id">
                            <option value="">Select Subcategory</option>
                            <?php foreach (getSubcategories($conn) as $subcat): ?>
                                <option value="<?= $subcat['id']; ?>" <?= $subcat['id'] == $row['subcategory_id'] ? 'selected' : '' ?>>
                                    <?= $subcat['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br>
                        <input type="file" name="image"><br>
                        <input type="submit" name="update" value="Update Product">
                    </form>
                <?php else: ?>
                    <?= $row['name']; ?>
                <?php endif; ?>
            </td>
            <td><?= $row['price']; ?></td>
            <td><?= $row['stock']; ?></td>
            <td><?= getCategoryName($conn, $row['category_id']); ?></td>
            <td><?= getSubcategoryName($conn, $row['subcategory_id']); ?></td>
            <td><img src="imgs/products/<?= $row['image']; ?>"></td>
            <td class="actions">
                <?php if (!isset($_GET['edit']) || $_GET['edit'] != $row['product_id']): ?>
                    <a href="?edit=<?= $row['product_id']; ?>" class="edit-btn">Edit</a> |
                    <a href="?delete=<?= $row['product_id']; ?>" class="button" onclick="return confirm('Delete this product?');">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<footer>
    <p>&copy; 2025 Your Company. All Rights Reserved.</p>
</footer>

</body>
</html>
