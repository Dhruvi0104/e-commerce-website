<?php
include 'db.php';

$successMsg = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, message) 
            VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        $successMsg = "Message sent successfully!";
    } else {
        $errorMsg = "Something went wrong. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - E-Commerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(174, 205, 183);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.15);
            width: 320px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #444;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 100%;
            background-color:rgb(133, 205, 146);
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #8ef0a3;
            color: black;
        }

        .msg {
            margin-top: 10px;
            font-size: 14px;
            color: green;
        }

        .error {
            color: red;
        }

        a {
            display: block;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Contact Us</h2>
        <form method="POST" action="">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required />
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div class="input-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>

            <button type="submit">Send Message</button>

            <?php if ($successMsg): ?>
                <p class="msg"><?= $successMsg ?></p>
            <?php elseif ($errorMsg): ?>
                <p class="msg error"><?= $errorMsg ?></p>
            <?php endif; ?>
        </form>

        <a href="indexx.php">Back to Home</a>
    </div>
</body>

</html>
