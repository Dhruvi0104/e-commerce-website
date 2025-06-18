<?php
// Check if session is already started, if not, start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<h2>Invalid Product ID</h2>";
    exit;
}

$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<h2>Product not found</h2>";
    exit;
}

$product = mysqli_fetch_assoc($result);
?>

<?php
// Handle review submission
if (isset($_POST['submit_review'])) {
    $product_id = $_POST['product_id'];
    $user_email = $_SESSION['email'];
    $rating = $_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $insert = "INSERT INTO reviews (product_id, user_email, rating, comment)
               VALUES ('$product_id', '$user_email', '$rating', '$comment')";

    if (mysqli_query($conn, $insert)) {
        echo "<script>alert('Review submitted successfully!'); location.href='product_details.php?id=$product_id';</script>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error submitting review.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?> - Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7f8;
            margin: 0;
            padding: 0;
        }
        .product-container {
            max-width: 1000px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }
        .product-container img {
            width: 400px;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        .details {
            flex: 1;
        }
        .details h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .details p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .details .price {
            font-size: 22px;
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .details form button {
            background-color: rgb(136, 207, 157);
            border: none;
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }
        .details form button:hover {
            background-color: rgb(113, 185, 135);
        }
        /* Responsive styling */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                align-items: center;
            }
            .product-container img {
                width: 100%;
                max-width: 400px;
            }
        }
    </style>
</head>
<body>

<div class="product-container">
    <img src="imgs/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <div class="details">
        <h2><?php echo $product['name']; ?></h2>
        <p class="price">₹<?php echo $product['price']; ?></p>
        <p><strong>Description:</strong> <?php echo $product['description']; ?></p>

        <form method="POST" action="cart.php">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>

<?php
if (isset($_SESSION['email'])) {
?>
  <div style="max-width: 1000px; margin: 30px auto; background: white; padding: 20px; border-radius: 10px;">
    <h3>Leave a Review</h3>
    <form method="POST" action="">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        
        <label>Rating (1-5):</label><br>
        <input type="number" name="rating" min="1" max="5" required><br><br>

        <label>Your Review:</label><br>
        <textarea name="comment" rows="4" cols="60" required></textarea><br><br>

        <button type="submit" name="submit_review" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">Submit Review</button>
    </form>
  </div>
<?php
} else {
    echo "<p style='max-width:1000px; margin: 30px auto; text-align:center;'>Please <a href='login.php'>login</a> to leave a review.</p>";
}
?>

<div style="max-width: 1000px; margin: 30px auto; background: white; padding: 20px; border-radius: 10px;">
  <h3>Customer Reviews</h3>

  <?php
  $reviews_query = "SELECT * FROM reviews WHERE product_id = $product_id ORDER BY created_at DESC";
  $reviews_result = mysqli_query($conn, $reviews_query);

  if (mysqli_num_rows($reviews_result) > 0) {
      while ($review = mysqli_fetch_assoc($reviews_result)) {
  ?>
        <div style="border-bottom: 1px solid #ddd; padding: 15px 0;">
            <strong><?php echo $review['user_email']; ?></strong>
            <p>⭐ Rating: <?php echo $review['rating']; ?>/5</p>
            <p><?php echo $review['comment']; ?></p>
            <small style="color: gray;"><?php echo date("F j, Y, g:i a", strtotime($review['created_at'])); ?></small>
        </div>
  <?php
      }
  } else {
      echo "<p>No reviews yet. Be the first to review!</p>";
  }
  ?>
</div>

</body>
</html>
