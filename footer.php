<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Footer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    footer {
      background-color:rgb(195, 225, 201);
      color: #2e5d34;
      padding-top: 50px;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 0 20px;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .footer-one {
      flex: 1 1 250px;
    }

    .footer-one h5 {
      font-size: 18px;
      margin-bottom: 15px;
      color: #1f4d2e;
      text-transform: uppercase;
    }

    .footer-one ul {
      list-style: none;
      padding-left: 0;
    }

    .footer-one ul li {
      margin-bottom: 10px;
    }

    .footer-one ul li a {
      color: #2e5d34;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer-one ul li a:hover {
      color: #155a28;
    }

    .abtlogo {
      width: 150px;
      margin-bottom: 15px;
    }

    .footer-one p {
      font-size: 14px;
      line-height: 1.6;
    }

    .copyright {
      border-top: 1px solid #a3c586;
      margin-top: 30px;
      padding: 15px 0;
      text-align: center;
      font-size: 14px;
      color: #215328;
    }

    #social a {
      margin: 0 10px;
      color: #215328;
      font-size: 18px;
      transition: all 0.3s ease;
    }

    #social a:hover {
      color: #0f3c1c;
      transform: scale(1.2);
    }

    @media screen and (max-width: 768px) {
      .footer-one {
        flex: 1 1 100%;
        text-align: center;
      }

      .footer-one ul {
        padding: 0;
      }

      #social {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <!-- Footer -->
  <footer>
    <div class="row container">
      <div class="footer-one" id="abt">
        <img src="./imgs/newlogo.png" alt="Logo" class="abtlogo">
        <p>In the childhood memories of every good cook, there's a large kitchen, a warm stove, a simmering pot, and a mom.</p>
      </div>

      <div class="footer-one">
        <h5>Main Menu</h5>
        <ul>
          <li><a href="indexx.php">Home</a></li>
          <li><a href="indexx.php">Cookware</a></li>
          <li><a href="indexx.php">Dinnerware</a></li>
          <li><a href="indexx.php">Storage</a></li>
          <li><a href="indexx.php">Kitchentools</a></li>
          <li><a href="indexx.php">Home Decor</a></li>
          <li><a href="indexx.php">Cleaning Stuff</a></li>
        </ul>
      </div>

      <div class="footer-one">
        <h5>Order Related</h5>
        <ul>
          <li><a href="#">Return & Exchange Policy</a></li>
          <li><a href="#">Refund Policy</a></li>
          <li><a href="#">Track Order</a></li>
          <li><a href="#">Return Product</a></li>
          <li><a href="#">All Products</a></li>
          <li><a href="#">Sales Director</a></li>
          <li><a href="#">Terms & Condition</a></li>
          <li><a href="#">Personalized Home & Kitchenware</a></li>
        </ul>
      </div>

      <div class="footer-one">
        <h5>Contact Us</h5>
        <div>
          <h6>Address</h6>
          <p>A 104 Ground Floor Styagrah Residency, Riddham Plaza,<br> Amar Jawan Circle, Nikol, Ahemedabad</p>
        </div>
        <div>
          <h6>Phone</h6>
          <p>7990315539</p>
        </div>
        <div>
          <h6>Email</h6>
          <p>homeware1330@gmail.com</p>
        </div>
      </div>
    </div>

    <div class="copyright">
      <div class="container">
        <p>Homewaredelights © 2025. All Rights Reserved</p>
        <div id="social">
          <a href="https://facebook.com/yourpage" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="https://twitter.com/yourprofile" target="_blank"><i class="fab fa-twitter"></i></a>
          <a href="https://instagram.com/homeware_delights_1330" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>
