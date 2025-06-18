<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include('db.php'); 

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user data from session email
$email = $_SESSION['email'];

// Fetch user data from the database
$query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found!";
    exit();
}

// Update user data if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Update user data in the database
    $update_query = "UPDATE users SET name='$name', phone='$phone', address='$address' WHERE email='$email'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: pro.php"); // Redirect to profile page after successful update
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Profile - Homeware Delights</title>
  <style>
    /* Your CSS Styling */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .navbar {
      background-color: rgb(187, 234, 213);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 22px 40px;
      flex-wrap: wrap;
    }

    .logo img {
      height: 65px;
      width: auto;
    }

    .form-container {
      margin: 30px auto;
      width: 80%;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .submit-btn {
      background-color: #61bd83;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .submit-btn:hover {
      background-color: #2e7d32;
    }
  </style>
</head>
<body>

  <!-- Include your Navbar here -->
  <?php include('header.php'); ?>

  <div class="form-container">
    <h1>Edit Profile</h1>
    <form method="POST">
      
      <!-- Name -->
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
      </div>

      <!-- Phone -->
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Address</label>
        <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($user['address']); ?></textarea>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="submit-btn">Update Profile</button>
    </form>
  </div>

  <!-- Include Footer -->
  <?php include('footer.php'); ?>

</body>
</html>
