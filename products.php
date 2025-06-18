<?php
include 'db.php';

// Get selected filter values from GET
$cat_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
$subcat_id = isset($_GET['subcategory_id']) ? $_GET['subcategory_id'] : '';
$price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';

// Build dynamic WHERE clause
$where = "WHERE 1";
if (!empty($cat_id)) {
    $where .= " AND category_id = '$cat_id'";
}
if (!empty($subcat_id)) {
    $where .= " AND subcategory_id = '$subcat_id'";
}
if (!empty($price_range)) {
    $range = explode("-", $price_range);
    $min = (int)$range[0];
    $max = (int)$range[1];
    $where .= " AND price BETWEEN $min AND $max";
}

// Fetch filtered products
$sql = "SELECT * FROM products $where ORDER BY name";
$result = mysqli_query($conn, $sql);
?>

<?php include 'header.php'; ?>

<section style="padding: 40px 20px; background: #f8f9f5;">
  <h2 style="text-align: center; font-size: 2rem; margin-bottom: 30px; color: #4a4a4a;">Products</h2>

  <!-- Filter Form -->
  <form method="GET" action="products.php" class="filter-form">
    <!-- Category Dropdown -->
    <select name="category_id" onchange="this.form.submit()">
      <option value="">All Categories</option>
      <?php
        $cat_res = mysqli_query($conn, "SELECT * FROM categories");
        while ($cat = mysqli_fetch_assoc($cat_res)) {
          $selected = ($cat_id == $cat['id']) ? 'selected' : '';
          echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
        }
      ?>
    </select>

    <!-- Subcategory Dropdown (filtered by selected category) -->
    <select name="subcategory_id">
      <option value="">All Subcategories</option>
      <?php
        if (!empty($cat_id)) {
          $subcat_res = mysqli_query($conn, "SELECT * FROM subcategories WHERE category_id = '$cat_id'");
          while ($subcat = mysqli_fetch_assoc($subcat_res)) {
            $selected = ($subcat_id == $subcat['id']) ? 'selected' : '';
            echo "<option value='{$subcat['id']}' $selected>{$subcat['name']}</option>";
          }
        }
      ?>
    </select>

    <!-- Price Filter -->
    <select name="price_range">
      <option value="">All Prices</option>
      <option value="0-500" <?php if($price_range=="0-500") echo "selected"; ?>>Under ₹500</option>
      <option value="500-1000" <?php if($price_range=="500-1000") echo "selected"; ?>>₹500 - ₹1000</option>
      <option value="1000-2000" <?php if($price_range=="1000-2000") echo "selected"; ?>>₹1000 - ₹2000</option>
      <option value="2000-99999" <?php if($price_range=="2000-99999") echo "selected"; ?>>Above ₹2000</option>
    </select>

    <button type="submit">Filter</button>
  </form>

  <div class="product-grid">
    <?php
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $stock = $row['stock']; // Check stock value for each product
        ?>
        <div class="product-card">
          <div class="product-box">
            <!-- Only image as clickable link -->
            <a href="product_details.php?id=<?php echo $product_id; ?>">
              <img src="imgs/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            </a>
            
            <div class="product-info">
              <!-- Name and price are not clickable anymore -->
              <h3><?php echo $row['name']; ?></h3>
              <p>₹<?php echo $row['price']; ?></p>
            </div>

            <!-- Check stock before showing Add to Cart button -->
            <?php if ($stock > 0): ?>
              <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <button type="submit">Add to Cart</button>
              </form>
            <?php else: ?>
              <div class="out-of-stock">Out of Stock</div>
            <?php endif; ?>
          </div>
        </div>
    <?php }
    } else {
      echo "<p style='text-align:center; width: 100%;'>No products found for the selected filters.</p>";
    }
    ?>
  </div>
</section>

<style>
  /* Responsive Filter Form */
  .filter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    margin-bottom: 30px;
  }

  .filter-form select,
  .filter-form button {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 1rem;
    min-width: 160px;
  }

  .filter-form button {
    background-color: #88cf9d;
    color: white;
    border: none;
    cursor: pointer;
  }

  .filter-form button:hover {
    background-color: #6bb382;
  }

  /* Product Grid */
  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .product-card {
    display: flex;
    flex-direction: column;
  }

  .product-box {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .product-box img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    cursor: pointer;
  }

  .product-info {
    padding: 15px;
  }

  .product-info h3 {
    font-size: 1.1rem;
    margin-bottom: 10px;
    color: #333;
  }

  .product-info p {
    font-weight: bold;
    color: rgb(137, 220, 140);
  }

  .product-box form {
    padding: 0 15px 15px;
  }

  .product-box button {
    width: 100%;
    padding: 10px;
    background-color: rgb(136, 207, 157);
    color: white;
    border: none;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
  }

  .product-box button:hover {
    background-color: rgb(104, 180, 127);
  }

  /* Out of Stock Message Centered */
  .out-of-stock {
    text-align: center;
    color: red;
    font-size: 1.2rem;
    font-weight: bold;
    margin-top: 15px;
  }
</style>

<?php include 'footer.php'; ?>
