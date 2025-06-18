<?php
session_start();
include('db.php');

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Profile - Homeware Delights</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
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
    .profile-container {
      margin: 30px auto;
      width: 80%;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .profile-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .profile-header h1 {
      margin: 0;
    }
    .edit-profile-btn {
      background-color: #61bd83;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }
    .edit-profile-btn:hover {
      background-color: #2e7d32;
    }
    .profile-info {
      font-size: 18px;
      line-height: 1.6;
    }
    .profile-info p {
      margin: 5px 0;
    }
    .profile-info strong {
      color: #2e7d32;
    }
  </style>
</head>
<body>

  <?php include('header.php'); ?>

  <div class="profile-container">
    <div class="profile-header">
      <h1>Your Profile</h1>
      <a href="edit_profile.php" class="edit-profile-btn">Edit Profile</a>
    </div>

    <div class="profile-info">
      <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
      <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
    </div>
  </div>

  <?php include('footer.php'); ?>

</body>
</html>
