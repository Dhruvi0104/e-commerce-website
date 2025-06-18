<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $update = mysqli_query($conn, "UPDATE orders SET status='Cancelled' WHERE order_id=$order_id");

    if ($update) {
        header("Location: myorders.php");
    } else {
        echo "Something went wrong!";
    }
}
?>
