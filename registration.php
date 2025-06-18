

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Optional: check for duplicate email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('User already exists. Please login.'); window.location.href='login.php';</script>";
        exit();
    }

    // Insert into DB
    $query = "INSERT INTO users (name, email, phone, address, password) VALUES ('$name', '$email', '$phone', '$address', '$password')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Something went wrong.');</script>";
    }
}
?>





<?php include 'header.php'; ?>

<div class="form-container">
    <h2>Register</h2>
    <form method="POST" action="registration.php">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <textarea name="address" placeholder="Address" required></textarea>
        <button type="submit" >Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php include 'footer.php'; ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .form-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .form-container input, .form-container textarea, .form-container button {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .form-container button {
        background-color: #5cb85c;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }
    .form-container button:hover {
        background-color: #4cae4c;
    }
    .form-container p {
        text-align: center;
    }
    .form-container a {
        color: #5cb85c;
        text-decoration: none;
    }
</style>
