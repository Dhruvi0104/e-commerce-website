<?php
$admin_password = "your_admin_password"; // replace with your hardcoded password
session_start();
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header("Location: admin_login.php");
//     exit();
// }

include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Reviews</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background:rgb(195, 225, 217);
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 1100px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
    }
    table th, table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color:rgb(186, 212, 187);
      color: #333;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Product Reviews</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
      
        <th>Product ID</th>
        <th>Rating</th>
        <th>Comment</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $result = mysqli_query($conn, "SELECT * FROM reviews ORDER BY created_at DESC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    

                    <td>{$row['product_id']}</td>
                    <td>{$row['rating']}</td>
                    <td>{$row['comment']}</td>
                    <td>{$row['created_at']}</td>
                  </tr>";
        }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
