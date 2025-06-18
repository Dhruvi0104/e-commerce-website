<?php
include 'db.php'; // Make sure your DB connection is here
session_start();

// Add user
if (isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query($conn, "INSERT INTO users (name, email, password, phone, address, created_at) 
        VALUES ('$name', '$email', '$pass', '$phone', '$address', NOW())");
    header("Location: manage_users.php");
    exit();
}

// Update user
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (!empty($_POST['password'])) {
        $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $update = "UPDATE users SET name='$name', email='$email', password='$pass', phone='$phone', address='$address' WHERE id=$id";
    } else {
        $update = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
    }

    mysqli_query($conn, $update);
    header("Location: manage_users.php");
    exit();
}

// Delete user
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: manage_users.php");
    exit();
}

// Fetch users
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");

// Edit user
$edit_user = null;
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$edit_id");
    $edit_user = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 30px;
            background: #f4f6f9;
        }
        .container {
            background: rgb(219, 229, 222);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        table th, table td {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><?= $edit_user ? "Edit User" : "Add New User" ?></h2>
    <form method="POST">
        <?php if ($edit_user): ?>
            <input type="hidden" name="id" value="<?= $edit_user['id'] ?>">
        <?php endif; ?>
        <div class="row mb-3">
            <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Name" value="<?= $edit_user['name'] ?? '' ?>" required></div>
            <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email" value="<?= $edit_user['email'] ?? '' ?>" required></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6"><input type="password" name="password" class="form-control" placeholder="<?= $edit_user ? 'Leave blank to keep current password' : 'Password' ?>"></div>
            <div class="col-md-6"><input type="text" name="phone" class="form-control" placeholder="Phone" value="<?= $edit_user['phone'] ?? '' ?>"></div>
        </div>
        <div class="mb-3"><input type="text" name="address" class="form-control" placeholder="Address" value="<?= $edit_user['address'] ?? '' ?>"></div>
        <button type="submit" name="<?= $edit_user ? 'update_user' : 'add_user' ?>" class="btn btn-<?= $edit_user ? 'primary' : 'success' ?>">
            <?= $edit_user ? 'Update User' : 'Add User' ?>
        </button>
        <?php if ($edit_user): ?>
            <a href="manage_users.php" class="btn btn-secondary ms-2">Cancel</a>
        <?php endif; ?>
    </form>
</div>

<div class="container mt-5">
    <h2>All Users</h2>
    <table class="table table-bordered table-striped table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Registered On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="manage_users.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="manage_users.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
