<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "database");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Admin Login Check
if (isset($_POST['admin_login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  if ($username === "admin" && $password === "admin123") {
    $_SESSION['admin'] = true;
    header("Location: admin.php");
    exit();
  } else {
    $login_error = "Invalid username or password!";
  }
}

// Logout
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: admin.php");
  exit();
}

// Category Add
if (isset($_POST['add_category'])) {
  $category_name = $_POST['category_name'];
  $conn->query("INSERT INTO categories (name) VALUES ('$category_name')");
  header("Location: admin.php?section=categories");
  exit();
}

// Delete Category
if (isset($_GET['delete_category'])) {
  $id = $_GET['delete_category'];
  $conn->query("DELETE FROM categories WHERE id=$id");
  header("Location: admin.php?section=categories");
  exit();
}

// Update Category
if (isset($_POST['update_category'])) {
  $id = $_POST['category_id'];
  $category_name = $_POST['category_name'];
  $conn->query("UPDATE categories SET name='$category_name' WHERE id=$id");
  header("Location: admin.php?section=categories");
  exit();
}

// Subcategory and Product Management Code (same as before)
?>

<!-- HTML BELOW -->

<?php if (!isset($_SESSION['admin'])) { ?>
<!-- Login Page -->
<form method="post" class="login-form">
  <h2>Admin Login</h2>
  <input type="text" name="username" placeholder="Username" required />
  <input type="password" name="password" placeholder="Password" required />
  <button type="submit" name="admin_login">Login</button>
  <?php if (isset($login_error)) echo "<p class='error'>$login_error</p>"; ?>
</form>

<?php } else { ?>
<!-- Admin Panel -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f5f5f5;
      color: #333;
    }
    .section { display: none; }
    .active-section { display: block; }
    .sidebar {
      width: 250px;
      background-color: #88b67d;
      padding: 30px;
      color: white;
      position: fixed;
      height: 100vh;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 24px;
    }
    .sidebar-button {
      display: block;
      width: 100%;
      padding: 12px;
      background-color: transparent;
      color: white;
      font-size: 18px;
      border: none;
      text-align: left;
      margin-bottom: 10px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .sidebar-button:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }
    .logout-btn {
      margin-top: 20px;
      background-color: #e74c3c;
      color: white;
    }
    .main-content {
      margin-left: 270px;
      padding: 30px;
      overflow-y: auto;
    }
    .form-input {
      padding: 12px;
      width: 100%;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .form-button {
      padding: 12px;
      background-color: #88b67d;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .form-button:hover {
      background-color: #6b9a5e;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #88b67d;
      color: white;
    }
    td img {
      max-width: 80px;
      height: auto;
    }
    .edit-btn, .delete-btn {
      color: #3498db;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }
    .delete-btn {
      color: #e74c3c;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h2>Admin Panel</h2>
  <button class="sidebar-button" onclick="showSection('dashboard')">Dashboard</button>
  <button class="sidebar-button" onclick="showSection('products')">Products</button>
  <button class="sidebar-button" onclick="showSection('categories')">Categories</button>
  <button class="sidebar-button" onclick="showSection('subcategories')">Subcategories</button>
  <a href="?logout=true" class="sidebar-button logout-btn">Logout</a>
</div>

<div class="main-content">
  <!-- Dashboard, Products, Categories, and Subcategories Sections will go here -->

</div>

<script>
  function showSection(id) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active-section'));
    document.getElementById(id).classList.add('active-section');
  }
</script>
</body>
</html>
<?php } ?>
