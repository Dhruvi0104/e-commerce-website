

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
if (!isset($_SESSION['email'])) {
    $_SESSION['email'] = 'testuser@example.com'; // Use an email from your database
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>Shop</title>
    <style>
        .product img {
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }

        #featured>div.row.mx-auto.container>nav>ul>li.page-item.active>a {
            background-color: black;
        }

        #featured>div.row.mx-auto.container>nav>ul>li:nth-child(n):hover>a {
            background-color: rgb(156, 207, 156);
            color: rgb(48, 45, 45);
        }

        .pagination a {
            color: black;

        }
    </style>
</head>

<body>



    <nav class="navbar">
        <div class="logo">
            <img src="./imgs/newlogo.png" alt="Logo" class="mylogo">
        </div>

        <button class="menu-toggle" onclick="toggleMenu()">☰</button>

        <ul class="menu">
            <li><a href="index.php" class="">Home</a></li>
            <li class="dropdown">
                <a href="#" class="active">Shop </a>
                <ul class="dropdown-menu">
                    <li class="sub-dropdown">
                        <a href="shop.php">Cookware </a>
                        <ul class="sub-menu">
                            <li><a href="shopcook1.php">Stainless-Steel</a></li>
                            <li><a href="shopcook2.php">Non-Stick</a></li>
                            <li><a href="shopcook3.php">Pressure-Cooker</a></li>
                        </ul>
                    </li>
                    <li class="sub-dropdown-two"><a href="shop2.php">Dinnerware</a>
                        <ul class="sub-menu-two">
                            <li><a href="shopdinner1.php">Dinner-Sets</a></li>
                            <li><a href="shopdinner2.php">Thali-Sets</a></li>

                        </ul>
                    </li>
                    <li class="sub-dropdown-three"><a href="shop3.php">Kitchen Tools</a>
                        <ul class="sub-menu-three">
                            <li><a href="shopkitchen1.php">Everyday Essentials</a></li>
                            <li><a href="shopkitchen2.php">Cooking Tools</a></li>
                            <li><a href="shopkitchen3.php">Kitchen-Essentials</a></li>
                            <li><a href="shopkitchen4.php">Knives</a></li>
                        </ul>
                    </li>
                    <li class="sub-dropdown-four"><a href="shop4.php">Storage & Serveware</a>
                        <ul class="sub-menu-four">
                            <li><a href="shopstorege1.php">Storage Sets</a></li>
                            <li><a href="shopstorege2.php">Tiffin Box</a></li>
                            <li><a href="shopstorege3.php">Drinkware</a></li>
                        </ul>
                    </li>
                    <li class="sub-dropdown-five"><a href="shop5.php">Home Decor</a>
                        <ul class="sub-menu-five">
                            <li><a href="shophomedecor1.php">Home Decorative accessories</a></li>
                            <li><a href="shophomedecor2.php">vases</a></li>
                            <li><a href="shophomedecor3.php">walls sculpture</a></li>
                            <li><a href="shophomedecor4.php">Spaeciality-Lighting</a></li>
                        </ul>
                    </li>
                    <li class="sub-dropdown-six"><a href="shop6.php">Cleaning Stuff</a>
                        <ul class="sub-menu-six">
                            <li><a href="shopclean1.php">Cleaning Gloves</a></li>
                            <li><a href="shopclean2.php">Cleaning-Brushes</a></li>
                            <li><a href="shopclean3.php">Cleaning Mops</a></li>

                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="login.php">Login</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <div class="icons">
                <img src="./imgs/searchicon.png" alt="Search" class="icon" id="icon2">
                <img src="imgs/cartimg1.png" alt="Shopping Bag" class="icon" id="icon1">
            </div>

        </ul>
    </nav>

    <script>
        function toggleMenu() {
            document.querySelector(".menu").classList.toggle("active");
        }
    </script>



    <section id="featured" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h2>Cookware</h2>
            <hr class="mx-auto">
            <p>Here you can check out our new products with fair price on Homeware Delights</p>
        </div>
        <div class="row mx-auto container">
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cook1 (Custom).jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Non-Stick Cookware</h5>
                <h4 class="p-price">Rs. 999</h4>
                <button class="buy-btn">Buy Now</button>
                <form action="add_to_cart.php" method="GET">
    <input type="hidden" name="product_id" value="25"> <!-- manually set product_id -->
    <button type="submit" class="cart-btn">Add to Cart</button>
</form>
            </div>


            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cook2 (Custom).jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Non-Stick Appam Maker</h5>
                <h4 class="p-price">Rs. 399</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cook3 (Custom).jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Non-Stick Kadhai</h5>
                <h4 class="p-price">Rs. 299</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cook4 (Custom).jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Stainless Steel Hammered Cooker</h5>
                <h4 class="p-price">Rs. 1,599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware1.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Stainless Steel Triply Family cookware</h5>
                <h4 class="p-price">Rs. 9,999</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware3.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">stainless Steel Kadhai/Wok/Fry pen</h5>
                <h4 class="p-price">Rs. 2100</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware2.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Stainless Steel Patila</h5>
                <h4 class="p-price">Rs.1850</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware4.jpg " alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Non-Stick Cookware Set of pan</h5>
                <h4 class="p-price">Rs. 1899</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware5.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Sandwich Base Cookware/Casserole Set</h5>
                <h4 class="p-price">Rs. 699</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware6.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">8-Piece Non-Stick Cookware Set</h5>
                <h4 class="p-price">Rs. 2899</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware7.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Pigeon Aluminium Nonstick Duo Pack Flat Tawa</h5>
                <h4 class="p-price">Rs. 1,499</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware8.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Nonstick Granite Cookware Set with Glass Lid
                </h5>
                <h4 class="p-price">Rs. 2,099</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware9.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Pigeon by Stovekraft Deluxe Aluminium Outer Lid Pressure Cooker
                    without Induction Base, 2 Litres</h5>
                <h4 class="p-price">Rs. 799</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware10.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">KENT Hard Anodised Cooker With Ss Inner Lid | 3 Litre | Suitable For Induction | 5
                    Years Warranty | Black</h5>
                <h4 class="p-price">Rs. 1899</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware11.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Baboies Ceramic Non-Stick Frying Pan With 4 Hole Pancake Pan Fried Egg Burger Pan
                </h5>
                <h4 class="p-price">Rs. 1,099</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/cookware12.jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">SOLARA Non-Stick Dosa Tawa 30 cm, Premium 3 Layer Greblon Nonstick Coating Dosa Tava
                </h5>
                <h4 class="p-price">Rs. 1,199</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <!-- <nav aria-label="...">
                <ul class="pagination mt-5">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> -->

        </div>
    </section>




    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5 ">
            <div class="footer-one col-lg-3 col-md-6 col-12" id="abt">
                <img src="./imgs/newlogo.png" alt="" class="abtlogo">
                <p pt-3>In the childhood memories of every good cook, There's large kitchen a warm stove, a simmering
                    pot
                    and a mom</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h5 class="pb-2">Main Menu</h5>
                <ul class="ext-uppercase list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Cookware</a></li>
                    <li><a href="shop2.php">Dinnerware</a></li>
                    <li><a href="shop3.php">Storage</a></li>
                    <li><a href="shop4.php">Kitchentools</a></li>
                    <li><a href="shop5.php">Home Decor</a></li>
                    <li><a href="shop6.php">Cleaning Stuff</a></li>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h5 class="pb-2">Order Related</h5>
                <ul class="ext-uppercase list-unstyled">
                    <li><a href="">Return & Exchange Policy</a></li>
                    <li><a href="">Refund Policy</a></li>
                    <li><a href="">Track Order</a></li>
                    <li><a href="">Return Product</a></li>
                    <li><a href="">All Products</a></li>
                    <li><a href="">Sales Director</a></li>
                    <li><a href="">Terms & Condition</a></li>
                    <li><a href="">Personalized Home & Kitchenware</a></li>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Contact-Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>A 104 Ground Floor Styagrah Residency, Riddham Plaza,<br>
                        Amar Jawan Circle, Nikol, Ahemedabad</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>7990315539</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>homeware@59gmail.com</p>
                </div>
            </div>
        </div>
        <div class="copyright mt-5">
            <div class="row container mx-auto ">
                <div class="col-lg-4 md-6 col-12 text-nowrap mb-2" id="cpy">
                    <p>Homewaredelights @ 2025. All Rights Reserved</p>
                </div>
                <div class="col-lg-4 md-6 col-12 mb-4" id="social">
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>