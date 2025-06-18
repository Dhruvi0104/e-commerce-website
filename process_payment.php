<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];
$total_amount = $_POST['total_amount'] ?? 0;
$payment_method = $_POST['payment_method'] ?? 'COD';

// Check if total amount is valid
if ($total_amount <= 0) {
    echo "Invalid Amount.";
    exit();
}

if ($payment_method === 'COD') {
    header("Location: place_order.php?method=COD&amount=$total_amount");
    exit();
} else {
    $user_result = mysqli_query($conn, "SELECT id, name FROM users WHERE email='$user_email'");
    $user_data = mysqli_fetch_assoc($user_result);
    $user_name = $user_data['name'];

    $razorpay_api_key = "rzp_test_h1wl5Gs5l1lyyM";
    $razorpay_secret_key = "iGdFHaREk5DJbemnEFeqUhWn";

    $api_url = "https://api.razorpay.com/v1/orders";
    $headers = ["Content-Type: application/json"];
    $data = [
        "amount" => $total_amount * 100,  // paise me jaata hai
        "currency" => "INR",
        "payment_capture" => 1
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_USERPWD, "$razorpay_api_key:$razorpay_secret_key");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        // CURL Error
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        exit();
    }

    curl_close($ch);

    $response_data = json_decode($response, true);

    // Debugging Razorpay response (You can remove after test)
    // echo "<pre>"; print_r($response_data); echo "</pre>";

    if (isset($response_data['id'])) {
        $razorpay_order_id = $response_data['id'];

        // Razorpay payment script
        echo "<script src='https://checkout.razorpay.com/v1/checkout.js'></script>
              <script>
                var options = {
                    key: '$razorpay_api_key',
                    amount: " . ($total_amount * 100) . ",
                    currency: 'INR',
                    name: 'Homeware Delights',
                    order_id: '$razorpay_order_id',
                    handler: function (response) {
                        window.location.href = 'place_order.php?method=Online&amount=$total_amount&payment_id=' + response.razorpay_payment_id + '&order_id=' + response.razorpay_order_id;
                    },
                    prefill: {
                        name: '$user_name',
                        email: '$user_email'
                    },
                    theme: {
                        color: '#3399cc'
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
              </script>";
    } else {
        // Razorpay API error
        echo "Failed to create Razorpay order.<br>";
        if (isset($response_data['error'])) {
            echo "Error: " . $response_data['error']['description'];
        }
    }
}
?>
