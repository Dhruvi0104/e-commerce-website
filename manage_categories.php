<?php
// --- DB CONNECTION ---
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- ADD CATEGORY ---
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    if (!empty($name)) {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }
}

// --- DELETE CATEGORY ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM categories WHERE id = $id");
}

// --- UPDATE CATEGORY ---
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    if (!empty($name)) {
        $stmt = $conn->prepare("UPDATE categories SET name=? WHERE id=?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
    }
}

// --- FETCH CATEGORIES ---
$result = $conn->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:rgb(220, 232, 224);
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: rgb(110, 181, 139);
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
        input[type="text"] {
            padding: 7px;
            width: 250px;
        }
        input[type="submit"], a.button {
            background:  rgb(110, 181, 139);
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
    <h2>Manage Categories</h2>

    <!-- Add Category Form -->
    <form method="post">
        <input type="text" name="name" placeholder="Enter category name" required>
        <input type="submit" name="add" value="Add Category">
    </form>

    <!-- Category Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td>
                    <?php if (isset($_GET['edit']) && $_GET['edit'] == $row['id']): ?>
                        <form method="post">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <input type="text" name="name" value="<?= $row['name']; ?>" required>
                            <input type="submit" name="update" value="Update">
                        </form>
                    <?php else: ?>
                        <?= $row['name']; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?edit=<?= $row['id']; ?>" class="edit-btn">Edit</a> |
                    <a href="?delete=<?= $row['id']; ?>" class="button" onclick="return confirm('Delete this category?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
