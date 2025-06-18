<?php
session_start();

// PHPMailer includes
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Forgot Password - Send Reset Link
    if (isset($_POST['email_reset'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email_reset']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format.'); window.location.href='login.php#forgot-password';</script>";
            exit();
        }

        // Check if email exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) == 0) {
            echo "<script>alert('Email not found in our records.'); window.location.href='login.php#forgot-password';</script>";
            exit();
        }

        // Generate a random reset token
        $token = bin2hex(random_bytes(32));

        // Save token and expiry in database
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token valid for 1 hour
        mysqli_query($conn, "UPDATE users SET reset_token='$token', token_expiry='$expiry' WHERE email='$email'");

        // Send reset link via email
        $reset_link = "http://localhost/newweb/login.php?reset_token=$token";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();  
            $mail->Host = 'smtp.gmail.com';  
            $mail->SMTPAuth = true;
            $mail->Username = 'dhruviahir238@gmail.com'; 
            $mail->Password = 'qkws uyhv fhtf uoyw'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('dhruviahir238@gmail.com', 'Homeware Delights');
            $mail->addAddress($email);
            $mail->Subject = 'Password Reset Link';
            $mail->Body    = "Click the following link to reset your password: $reset_link";

            $mail->send();

            echo "<script>alert('Reset link sent to your email.'); window.location.href='login.php';</script>";
            exit();

        } catch (Exception $e) {
            echo "<script>alert('Error sending reset link.'); window.location.href='login.php#forgot-password';</script>";
        }
    }

    // Reset Password
    elseif (isset($_POST['new_password']) && isset($_POST['reset_token'])) {
        $new_password = $_POST['new_password'];
        $reset_token = $_POST['reset_token'];

        // Check if token is valid
        $check = mysqli_query($conn, "SELECT * FROM users WHERE reset_token='$reset_token' AND token_expiry > NOW()");
        if (mysqli_num_rows($check) == 1) {
            $row = mysqli_fetch_assoc($check);
            $email = $row['email'];

            $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password and clear token
            mysqli_query($conn, "UPDATE users SET password='$new_hashed', reset_token=NULL, token_expiry=NULL WHERE email='$email'");

            echo "<script>alert('Password reset successful!'); window.location.href='login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid or expired reset link.'); window.location.href='login.php';</script>";
            exit();
        }
    }

    // Normal Login
    elseif (isset($_POST['email']) && isset($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            if (password_verify($password, $db_password) || $password === $db_password) {
                session_regenerate_id();
                $_SESSION['email'] = $email;
                header("Location: indexx.php");
                exit();
            } else {
                echo "<script>alert('Incorrect password.'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('Email not found.'); window.location.href='login.php';</script>";
        }
    }
}
?>

<?php include 'header.php'; ?>

<div class="form-container" id="login-form">
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Forgot your password? <a href="javascript:void(0);" onclick="showForgotPassword()">Reset it here</a></p>
    <p>Don't have an account? <a href="registration.php">Register here</a></p>
</div>

<!-- Forgot Password Form -->
<div id="forgot-password" class="form-container" style="display: none;">
    <h2>Forgot Password</h2>
    <form method="POST" action="login.php">
        <input type="email" name="email_reset" placeholder="Enter your registered email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</div>

<!-- Reset Password Form -->
<?php if (isset($_GET['reset_token'])): ?>
<div class="form-container">
    <h2>Reset Password</h2>
    <form method="POST" action="login.php">
        <input type="hidden" name="reset_token" value="<?php echo htmlspecialchars($_GET['reset_token']); ?>">
        <input type="password" name="new_password" placeholder="Enter New Password" required>
        <button type="submit">Reset Password</button>
    </form>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>

<script>
function showForgotPassword() {
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('forgot-password').style.display = 'block';
}
</script>

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
    .form-container input,
    .form-container button {
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
