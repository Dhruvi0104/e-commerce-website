<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Homeware Delights</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

    .menu-toggle {
      display: none;
      font-size: 26px;
      background: none;
      border: none;
      cursor: pointer;
    }

    .menu {
      list-style: none;
      display: flex;
      align-items: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .menu li {
      position: relative;
    }

    .menu a {
      text-decoration: none;
      color: #333;
      font-weight: 600;
      padding-bottom: 5px;
      position: relative;
      transition: all 0.3s ease;
    }

    .menu a.active::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -2px;
      height: 3px;
      width: 100%;
      background-color: #1b5e20;
      border-radius: 3px;
    }

    .menu a:hover {
      color: #2e7d32;
    }

    .icons {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .icon {
      width: 28px;
      height: 28px;
      cursor: pointer;
    }

    .user-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      cursor: pointer;
      object-fit: cover;
    }

    .search-input {
      display: none;
      position: absolute;
      top: 40px;
      left: -130px;
      width: 200px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      z-index: 1000;
    }

    @media (max-width: 768px) {
      .menu {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        width: 100%;
        display: none;
        background-color: #d4e9d3;
        padding: 20px;
      }

      .menu.show {
        display: flex;
      }

      .menu-toggle {
        display: block;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <div class="logo">
      <img src="imgs/newlogo.png" alt="Logo" class="mylogo">
    </div>

    <button class="menu-toggle" onclick="toggleMenu()">☰</button>

    <ul class="menu" id="mainMenu">
      <li><a href="indexx.php" class="<?= ($current_page == 'indexx.php') ? 'active' : '' ?>">Home</a></li>
      <li><a href="products.php" class="<?= ($current_page == 'products.php') ? 'active' : '' ?>">Shop</a></li>

      <?php if (isset($_SESSION['email'])): ?>
        <li><a href="logout.php" class="<?= ($current_page == 'logout.php') ? 'active' : '' ?>">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php" class="<?= ($current_page == 'login.php') ? 'active' : '' ?>">Login</a></li>
      <?php endif; ?>

      <li><a href="about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About</a></li>
      <li><a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact</a></li>
      <li><a href="myorders.php" class="<?= ($current_page == 'myorders.php') ? 'active' : '' ?>">My Orders</a></li>

      <div class="icons">
        <form method="GET" action="serch.php" style="display: flex; align-items: center; margin-left: 20px;">
          <input type="text" name="query" placeholder="Search products..." style="padding: 8px; width: 250px; border: 1px solid #ddd; border-radius: 4px;">
          <button type="submit" style="background-color: #61bd83; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;">
            <i class="fa fa-search" style="color: white;"></i>
          </button>
        </form>

        <a href="cart.php"><img src="imgs/cartimg1.png" alt="Cart" class="icon"></a>

        <?php if (isset($_SESSION['email'])): ?>
          <a href="pro.php"><img src="imgs/user.png" alt="Profile" class="user-icon"></a>
        <?php endif; ?>
      </div>
    </ul>
  </nav>

  <script>
    function toggleMenu() {
      const menu = document.getElementById('mainMenu');
      menu.classList.toggle('show');
    }
  </script>

</body>
</html>
