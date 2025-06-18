<?php
include 'db.php';
include 'header.php';

$searchQuery = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%' ORDER BY RAND() LIMIT 16";
$result = mysqli_query($conn, $sql);
?>

<!-- ✅ Banner Section -->
<section style="position: relative; width: 100%;">
  <img src="imgs/Products/forntimg.jpg" alt="Banner" style="width: 100%; height: 89vh; object-fit: cover;">
  <div style="position: absolute; top: 30%; left: 8%; color: rgb(27, 139, 60); border-radius: 10px;">
    <h1 style="font-size: 2.5rem; margin-bottom: 10px;">Welcome to Homeware Delights</h1>
    <p style="font-size: 1.2rem;">Explore the best kitchen and home products!</p>
  </div>
</section>

<?php if ($searchQuery) { ?>
  <!-- ✅ Search Results -->
  <section class="product-section">
    <h2 class="section-heading">Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
    <div class="product-grid">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="product-card">
          <img src="imgs/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
          <div class="product-info">
            <h3><?php echo $row['name']; ?></h3>
            <p>₹<?php echo $row['price']; ?></p>
            <form method="POST" action="cart.php" onsubmit="return checkLogin()">
              <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
              <input type="hidden" name="quantity" value="1">
              <button type="submit">Add to Cart</button>
            </form>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>
<?php } ?>

<!-- ✅ Featured Products -->
<section class="product-section">
  <h2 class="section-heading">Featured Products</h2>
  <div class="product-grid">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM products ORDER BY RAND() LIMIT 16");
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="product-card">
        <img src="imgs/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        <div class="product-info">
          <h3><?php echo $row['name']; ?></h3>
          <p>₹<?php echo $row['price']; ?></p>
          <form method="POST" action="cart.php" onsubmit="return checkLogin()">
            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
            <input type="hidden" name="quantity" value="1">
            <button type="submit">Add to Cart</button>
          </form>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<!-- ✅ Styles -->
<style>
  .product-section {
    padding: 40px 20px;
    background: rgb(227, 246, 239);
  }

  .section-heading {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 30px;
    color: #4a4a4a;
  }

  .product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .product-card {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    background: #ffffff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: opacity 0.3s ease;
    display: flex;
    flex-direction: column;
  }

  .product-card:hover {
    opacity: 0.9;
  }

  .product-card img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }

  .product-info {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .product-info h3 {
    font-size: 1.1rem;
    margin: 0 0 10px;
    color: #333;
  }

  .product-info p {
    color: rgb(137, 220, 140);
    font-weight: bold;
    margin-bottom: 15px;
  }

  .product-info button {
    width: 100%;
    padding: 10px;
    background-color: #61bd83;
    border: none;
    color: white;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
  }

  .product-info button:hover {
    background-color: #7c9f3b;
  }

  @media (max-width: 768px) {
    .section-heading {
      font-size: 1.6rem;
    }

    .product-grid {
      gap: 30px;
    }

    .product-info h3 {
      font-size: 1rem;
    }

    .product-info button {
      font-size: 0.9rem;
    }
  }

  @media (max-width: 480px) {
    .section-heading {
      font-size: 1.4rem;
    }

    .product-card img {
      height: 200px;
    }

    .product-info h3 {
      font-size: 0.95rem;
    }

    .product-info p {
      font-size: 0.95rem;
    }

    .product-info button {
      font-size: 0.85rem;
      padding: 8px;
    }
  }
</style>

<!-- ✅ JS -->
<script>
  function checkLogin() {
    <?php if (!isset($_SESSION['email'])) { ?>
      alert("Please login to add products to cart.");
      window.location.href = "login.php";
      return false;
    <?php } else { ?>
      return true;
    <?php } ?>
  }
</script>

<?php include 'footer.php'; ?>
