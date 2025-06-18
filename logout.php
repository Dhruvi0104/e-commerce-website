<?php
session_start();
session_unset();     // removes all session variables
session_destroy();   // destroys the session

echo "<script>alert('You have been logged out.'); window.location.href='login.php';</script>";
?>
