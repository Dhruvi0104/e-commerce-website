<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.css"> -->
    <link rel="stylesheet" href="style.css">


    <script>
        function toggleSearch() {
            var searchBar = document.getElementById("searchBar");
            searchBar.style.display = (searchBar.style.display === "none" || searchBar.style.display === "") ? "block" : "none";
        }
    </script>
    <title>Homewaredelights</title>
</head>

<body>






    <nav class="navbar">
        <div class="logo">
            <img src="imgs/newlogo.png" alt="Logo" class="mylogo">
        </div>

        <button class="menu-toggle" onclick="toggleMenu()">☰</button>

        <ul class="menu">
            <li><a href="index.php" class="active">Home</a></li>
            <li class="dropdown">
                <a href="#">Shop </a>
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
                <div style="position: relative; display: inline-block;"> <img src="./imgs/searchicon.png" alt="Search"
                        class="icon" id="icon2" onclick="toggleSearch()">
                    <input type="text" id="searchBar"  class="search-input" placeholder="Search products..."
                        style="display: none; position: absolute; top: 40px; left: -130px; width: 200px; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <a href="cart.php"><img src="imgs/cartimg1.png" alt="Shopping Bag" class="icon" id="icon1"></a>
            </div>

        </ul>
    </nav>

    <script>
        function toggleMenu() {
            document.querySelector(".menu").classList.toggle("active");
        }
    </script>


    <section id="home">
        <div class="container">
            <h5>NEW ARRAIVALAS</h5>
            <h1><span>Best Price </span>This Year</h1>
            <p>Turning kitchen dreams into flavorful reality <br>with our products.</p>
            <button>Shop Now</button>
        </div>
    </section>


    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img src="./imgs/Products/main1.jpg" alt="" class="img-fluid">
                <div class="details">
                    <h2>Powering Your Home</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>

            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img src="./imgs/Products/main2.jpg" alt="" class="img-fluid">
                <div class="details">
                    <h2>Indulge In Luxury</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>

            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img src="./imgs/Products/main3.jpg" alt="" class="img-fluid">
                <div class="details">
                    <h2>Solution For Every Corner</h2>
                    <button class="text-uppercase">Shop Now</button>
                </div>
            </div>
        </div>
    </section>


    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Featured</h3>
            <hr class="mx-auto">
            <p>Here you can check out our new products with fair price on Homeware Delights</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/featured1 (Custom).jpeg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Chopping Board</h5>
                <h4 class="p-price">Rs. 499</h4>
                <button class="buy-btn">Buy Now</button>
                <form method="POST" action="add_to_cart.php">
  <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>"> <!-- dynamic product ID -->
  <input type="hidden" name="user_email" value="<?php echo $_SESSION['email']; ?>"> <!-- dynamic logged-in user email -->
  <button type="submit">Add to Cart</button>
</form>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/featured2 (Custom).jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">wall Mirror</h5>
                <h4 class="p-price">Rs. 899</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/featured3 (Custom).jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Juicer</h5>
                <h4 class="p-price">Rs. 1,499</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/featured4 (Custom).jpg" alt="" class="img-fluid1">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Wall Frame</h5>
                <h4 class="p-price">Rs. 599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>


    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>MID SEASON'S SALE</h4>
            <h1>Ceramic Collection<br>UP To 20% OFF</h1>
            <button class="text-uppercase">Shop Now</button>
        </div>
    </section>


    <section id="cookware" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Cookware</h3>
            <hr class="mx-auto">
            <p>Here you can check out our new products with fair price on Homeware Delights</p>
        </div>
        <div class="row mx-auto container-fluid">
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
                <h5 class="p-name">Stainless Steal Hammered Cooker</h5>
                <h4 class="p-price">Rs. 1,599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>


    <section id="Dinner" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Dinnerware</h3>
            <hr class="mx-auto">
            <p>Here you can check out our new products with fair price on Homeware Delights</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/dinner1.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Stainless Steal Dinner Set</h5>
                <h4 class="p-price">Rs. 14,999</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/dinner2.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Stainless Steal Thali Set With Gold plated</h5>
                <h4 class="p-price">Rs. 3,999</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/dinner3.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Ceramic Italian Dinner Ware</h5>
                <h4 class="p-price">Rs. 18,499</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/dinner4.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Stainless Steal Dinner Set With Gold Plated</h5>
                <h4 class="p-price">Rs. 15,599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>


    <section id="kitchentool" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Kitchen Tools</h3>
            <hr class="mx-auto">
            <p>Here you can check out our new products with fair price on Homeware Delights</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/kitchen1.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Chopper</h5>
                <h4 class="p-price">Rs. 199</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/kitchen2.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Cutlery Set</h5>
                <h4 class="p-price">Rs. 1,599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/kitchen3.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Popcorn Maker</h5>
                <h4 class="p-price">Rs. 1,099</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/kitchen4.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Knife</h5>
                <h4 class="p-price">Rs. 599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>


    <section id="homedecor" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Home Decor</h3>
            <hr class="mx-auto">
            <p>Here you can check out our new products with fair price on Homeware Delights</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/decor1.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Table Lamp</h5>
                <h4 class="p-price">Rs. 1,199</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/decor2.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Ganesh Idol</h5>
                <h4 class="p-price">Rs. 599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/decor3.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Artificial Plants</h5>
                <h4 class="p-price">Rs. 499</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/decor4.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Wall Hanging</h5>
                <h4 class="p-price">Rs. 999</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>


    <section id="cleaning" class="my-5">
        <div class="container text-center mt-5 py-5">
            <h3>Cleaning Stuff</h3>
            <hr class="mx-auto">
            <p>Here you can check out our new products with fair price on Homeware Delights</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/clean1.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Mini Mop</h5>
                <h4 class="p-price">Rs. 399</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/clean2.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">smartphone Cleaning Kit</h5>
                <h4 class="p-price">Rs. 599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/clean3.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Spin Mop</h5>
                <h4 class="p-price">Rs. 859</h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <div class="product text-center col-lg-3 col-md-4 col-12">
                <img src="./imgs/Products/clean4.jpg" alt="" class="img-fluid1 mb-3">
                <div class="star">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <h5 class="p-name">Spray Mop</h5>
                <h4 class="p-price">Rs. 599</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
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