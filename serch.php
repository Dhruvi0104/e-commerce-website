<?php
include 'db.php';
include 'header.php';

// Capture the search query from the URL
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

// If a search query is present, search for products
if ($search_query) {
    $sql = "SELECT * FROM products WHERE name LIKE '%$search_query%' ORDER BY name";
    $result = mysqli_query($conn, $sql);
}
?>

<section style="padding: 40px 20px; background: #f8f9f5;">
  <h2 style="text-align: center; font-size: 2rem; margin-bottom: 30px; color: #4a4a4a;">Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>

  <?php if ($search_query && mysqli_num_rows($result) > 0) { ?>
    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between;">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div style="flex: 0 1 calc(25% - 15px); box-sizing: border-box;">
          <div style="border: 1px solid #e0e0e0; border-radius: 10px; background: #ffffff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden;">
            <a href="product_details.php?id=<?php echo $row['product_id']; ?>" style="text-decoration: none; color: inherit;">
              <img src="imgs/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width: 100%; height: 300px; object-fit: cover;">
              <div style="padding: 15px;">
                <h3 style="font-size: 1.2rem; margin: 0 0 10px;"><?php echo $row['name']; ?></h3>
                <p style="color: rgb(137, 220, 140); font-weight: bold; margin-bottom: 15px;">₹<?php echo $row['price']; ?></p>
              </div>
            </a>
            <div style="padding: 0 15px 15px 15px;">
              <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <button type="submit" style="width: 100%; padding: 10px; background-color: rgb(136, 207, 157); border: none; color: white; font-size: 1rem; border-radius: 5px; cursor: pointer;">
                  Add to Cart
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } else { ?>
    <p style="text-align: center;">No products found matching your search.</p>
  <?php } ?>
</section>

<?php include 'footer.php'; ?>
