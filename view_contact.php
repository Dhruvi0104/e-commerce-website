<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if user is logged in as admin (you can add admin authentication here)
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Get the message ID from the URL
$message_id = $_GET['id'];

// Fetch the message from the database
$query = "SELECT * FROM contact_messages WHERE id = $message_id";
$result = mysqli_query($conn, $query);
$message = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact Message - Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4CAF50;
        }

        p {
            font-size: 18px;
        }

        .message {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .back-btn {
            display: block;
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>View Contact Message</h2>

        <div class="message">
            <p><strong>Name:</strong> <?= $message['name'] ?></p>
            <p><strong>Email:</strong> <?= $message['email'] ?></p>
            <p><strong>Message:</strong> <?= $message['message'] ?></p>
            <p><strong>Submitted At:</strong> <?= $message['submitted_at'] ?></p>
        </div>

        <a href="admin_manage_contacts.php" class="back-btn">Back to Messages</a>
    </div>
</body>

</html>
