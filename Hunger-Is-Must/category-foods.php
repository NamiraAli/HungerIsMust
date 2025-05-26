<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Delivery Website</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.css">
    <!-- Hover CSS -->
    <link rel="stylesheet" href="css/hover-min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation Section Start -->
    <header class="navbar">
        <nav id="site-top-nav" class="navbar-menu navbar-fixed-top">
            <div class="container">
                <!-- logo -->
                <div class="logo">
                    <a href="index.php" title="Logo">
                        <img src="img/logo.png" alt="Logo" class="img-responsive">
                    </a>
                </div>
                <!-- Main Menu -->
                <div class="menu text-right">
                    <ul>
                        <li><a class="hvr-underline-from-center" href="index.php">Home</a></li>
                        <li><a class="hvr-underline-from-center" href="categories.php">Categories</a></li>
                        <li><a class="hvr-underline-from-center" href="order.php">Order</a></li>
                        <li><a class="hvr-underline-from-center" href="contact.php">Contact</a></li>
                        <li><a class="hvr-underline-from-center" href="login.php">Login</a></li>
                        <li>
                        <a id="shopping-cart" class="shopping-cart"> 
    <i class="fa fa-cart-arrow-down"></i>
    <span class="badge" id="cart-count">0</span>
</a>
<div id="cart-content" class="cart-content">
    <h3 class="text-center">Shopping Cart</h3>
    <table class="cart-table" border="0" id="cart-table">
        <thead>
            <tr>
                <th>Food</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cart-items">
          
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th id="cart-total">$0.00</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <a href="order.php" class="btn-primary">Confirm Order</a>
</div>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navigation Section End -->

    <!-- Food Search Section Start -->
    <section class="food-search text-center">
    <div class="container">
        <?php
            if (isset($_GET['search'])) {
                $search = htmlspecialchars($_GET['search']);
            } else {
                $search = "Food";
            }
        ?>
        <h2 style="background: #44bd32;">
            Foods on <a href="#" class="text-white">"<?php echo $search; ?>"</a>
        </h2>
    </div>
</section>

    <!-- Food Search Section End -->

    <!-- Foods Section Start -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="heading-border"></div>
            <div class="grid-2">
            <div class="food-menu-box">
               <div class="food-menu-img">
                 <img src="img/food/p1.jpg" alt="" class="img-responsive img-curve">
              </div>
        <div class="food-menu-desc">
        <h4>Pizza</h4>
        <p class="food-price">$99.00</p>
        <p class="food-details">A slice of heaven in every bite – where cheese meets cravings!</p>
        <input type="number" class="qty-input" value="1" min="1">
        <button 
            class="btn-primary add-to-cart"
              data-id="1"
            data-name="Pizza"
            data-price="8.00"
            data-img="img/food/p1.jpg">Add To Cart</button>
    </div>
</div>
<div class="food-menu-box">
               <div class="food-menu-img">
                 <img src="img/food/s1.jpg" alt="" class="img-responsive img-curve">
              </div>
        <div class="food-menu-desc">
        <h4>Sandwich</h4>
        <p class="food-price">$8.00</p>
        <p class="food-details">Freshly made, perfectly layered – every sandwich tells a story.</p>
        <input type="number" class="qty-input" value="1" min="1">
        <button 
            class="btn-primary add-to-cart"
              data-id="3"
            data-name="sandwich"
            data-price="8.00"
            data-img="img/food/s1.jpg">Add To Cart</button>
    </div>
</div>
<div class="food-menu-box">
               <div class="food-menu-img">
                 <img src="img/food/b1.jpg" alt="" class="img-responsive img-curve">
              </div>
        <div class="food-menu-desc">
        <h4>Burger</h4>
        <p class="food-price">$8.00</p>
        <p class="food-details">Stacked high, grilled to perfection – the burger your appetite deserves</p>
        <input type="number" class="qty-input" value="1" min="1">
        <button 
            class="btn-primary add-to-cart"
              data-id="2"
            data-name="burger"
            data-price="8.00"
            data-img="img/food/b1.jpg">Add To Cart</button>
    </div>
</div>
<div class="food-menu-box">
               <div class="food-menu-img">
                 <img src="img/food/f1.jpg" alt="" class="img-responsive img-curve">
              </div>
        <div class="food-menu-desc">
        <h4>Fries</h4>
        <p class="food-price">$8.00</p>
        <p class="food-details">Golden. Crispy. Addictive. One bite and you're hooked!</p>
        <input type="number" class="qty-input" value="1" min="1">
        <button 
            class="btn-primary add-to-cart"
              data-id="6"
            data-name="fries"
            data-price="8.00"
            data-img="img/food/f1.jpg">Add To Cart</button>
    </div>
</div>
<div class="food-menu-box">
               <div class="food-menu-img">
                 <img src="img/food/ps1.jpg" alt="" class="img-responsive img-curve">
              </div>
        <div class="food-menu-desc">
        <h4>Pasta</h4>
        <p class="food-price">$8.00</p>
        <p class="food-details">Twirl into flavor – creamy, cheesy, and utterly irresistible pasta.</p>
        <input type="number" class="qty-input" value="1" min="1">
        <button 
            class="btn-primary add-to-cart"
              data-id="5"
            data-name="pasta"
            data-price="8.00"
            data-img="img/food/ps1.jpg">Add To Cart</button>
    </div>
</div>
<div class="food-menu-box">
               <div class="food-menu-img">
                 <img src="img/food/m1.jpg" alt="" class="img-responsive img-curve">
              </div>
        <div class="food-menu-desc">
        <h4>Momos</h4>
        <p class="food-price">$8.00</p>
        <p class="food-details">Little pockets of joy, steamed or fried – taste the love in every momo.</p>
        <input type="number" class="qty-input" value="1" min="1">
        <button 
            class="btn-primary add-to-cart"
              data-id="4"
            data-name="momos"
            data-price="8.00"
            data-img="img/food/m1.jpg">Add To Cart</button>
    </div>
</div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Foods Section End -->

    <!-- Footer Section Start -->
    <section class="footer">
        <div class="container">
            <div class="grid-3">
                <div class="text-center">
                    <h3>About Us</h3><br>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat officia, temporibus expedita dicta eligendi harum architecto fugiat sint, laudantium omnis animi. Voluptas praesentium maiores minima pariatur necessitatibus consequuntur, similique assumenda.</p>
                </div>
                <div class="texr-center">
                    <h3>Site Map</h3><br>
                    <div class="site-links">
                        <a href="categories.php">Categories</a>                       
                        <a href="order.php">Order</a>
                        <a href="contact.php">Contact</a>
                        <a href="login.php">Login</a>
                    </div>
                </div>
                <div class="social-links">
                    <h3>Social Links</h3><br>
                    <div class="social">
                        <ul>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/facebook-new.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/fluency/48/null/instagram-new.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/twitter--v1.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/linkedin-circled--v1.png"/></a></li>
                            <li><a href="#"><img src="https://img.icons8.com/color/48/null/youtube-play.png"/></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Section End -->

    <!-- Copyright Section start -->
    <section class="copyright">
        <div class="container text-center">
            <p>All rights reserved. Design By <a href="#">NAC</a></p>
        </div>
        <a id="back-to-top" class="btn-primary">
            <i class="fa fa-angle-double-up"></i>
        </a>
    </section>
    <!-- Copyright Section End -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Jquery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
</body>
</html>