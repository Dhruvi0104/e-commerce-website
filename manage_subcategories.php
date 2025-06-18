<?php
// --- DB CONNECTION ---
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- ADD SUBCATEGORY ---
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $cat_id = $_POST['category_id'];
    if (!empty($name) && !empty($cat_id)) {
        $stmt = $conn->prepare("INSERT INTO subcategories (name, category_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $cat_id);
        $stmt->execute();
    }
}

// --- DELETE SUBCATEGORY ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM subcategories WHERE id = $id");
}

// --- UPDATE SUBCATEGORY ---
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cat_id = $_POST['category_id'];
    if (!empty($name) && !empty($cat_id)) {
        $stmt = $conn->prepare("UPDATE subcategories SET name=?, category_id=? WHERE id=?");
        $stmt->bind_param("sii", $name, $cat_id, $id);
        $stmt->execute();
    }
}

// --- FETCH DATA ---
$subResult = $conn->query("SELECT s.*, c.name AS category_name FROM subcategories s JOIN categories c ON s.category_id = c.id");
$categories = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Subcategories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:rgb(227, 238, 231);
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: rgb(95, 164, 141);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #b3b3b3;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"], select {
            padding: 7px;
            width: 250px;
            margin-bottom: 10px;
        }
        input[type="submit"], a.button {
            background: rgb(132, 206, 158);
            color: white;
            padding: 8px 15px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            border-radius: 3px;
        }
        a.button {
            background: #d9534f;
        }
        .edit-btn {
            background-color: #5bc0de;
        }
    </style>
</head>
<body>
    <h2>Manage Subcategories</h2>

    <!-- Add Subcategory Form -->
    <form method="post">
        <input type="text" name="name" placeholder="Subcategory name" required><br>
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
            <?php endwhile; ?>
        </select><br>
        <input type="submit" name="add" value="Add Subcategory">
    </form>

    <!-- Subcategory Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Subcategory Name</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>

        <?php
        $categories = $conn->query("SELECT * FROM categories"); // refetch for edit
        while ($row = $subResult->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td>
                    <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <input type="text" name="name" value="<?= $row['name']; ?>" required><br>
                            <select name="category_id" required>
                                <?php while ($cat = $categories->fetch_assoc()): ?>
                                    <option value="<?= $cat['id']; ?>" <?= $cat['id'] == $row['category_id'] ? 'selected' : '' ?>>
                                        <?= $cat['name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select><br>
                            <input type="submit" name="update" value="Update">
                        </form>
                    <?php else: ?>
                        <?= $row['name']; ?>
                    <?php endif; ?>
                </td>
                <td><?= $row['category_name']; ?></td>
                <td>
                    <a href="?edit=<?= $row['id']; ?>" class="edit-btn">Edit</a> |
                    <a href="?delete=<?= $row['id']; ?>" class="button" onclick="return confirm('Delete this subcategory?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
