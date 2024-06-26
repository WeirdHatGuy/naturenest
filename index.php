<?php

require_once 'header.php';

// Check if the file name is not index.php
if (basename($_SERVER['PHP_SELF']) != 'index.php') {
    // Redirect to login.php if session variables are not set
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
        header("Location: auth.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>NatureNest</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<nav class=navbar>
    <a class="navbar-brand" href="index.php">NatureNest</a>
    <div id="navbar">
        <ul class="navbar">
        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="product.php">Products</a></li>
                  <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                  <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                  <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                  <li class="nav-item"><a class="nav-link" href="user_review.php">User Review</a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>
    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            <div class="slider-items" style="background-image: url(images/bg_1.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center">
                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2" style="color: black; text-shadow: 2px 2px 4px #808080;">Welcome to NatureNest</h1>
                            <h2 class="subheading mb-4" style="color:#FFFFFF;text-shadow: 2px 2px 4px #808080;">Join us at NatureNest, where sustainability meets taste. Together, we can make a difference, one organic product at a time.</h2>
                            <p><a href="product.php" class="btn btn-primary">View Products</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
                <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Free Shipping</h3>
                            <span>On order over $100</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Always Fresh</h3>
                            <span>Product well package</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-award"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Superior Quality</h3>
                            <span>Quality Products</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Featured Products</span>
                    <h2 class="mb-4">Our Products</h2>
                    <p>At NatureNest, we're not just selling products; we're selling a promise of a healthier, more sustainable future. Our products are grown with care, using only the purest water and the most natural fertilizers, ensuring that every bite you take is a step towards a healthier planet.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-1.jpg" alt="Bell Pepper">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Bell Pepper</a></h5>
                            <p class="card-text">$120.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                <a href="product.php" class="btn btn-success buy-now mx-1">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-2.jpg" alt="Strawberries">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Strawberries</a></h5>
                            <p class="card-text">$120.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                <a href="product.php" class="btn btn-success buy-now mx-1">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-3.jpg" alt="Beans">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Beans</a></h5>
                            <p class="card-text">$120.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                <a href="product.php" class="btn btn-success buy-now mx-1">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-4.jpg" alt="Cabbage">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Cabbage</a></h5>
                            <p class="card-text">$120.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                <a href="product.php" class="btn btn-success buy-now mx-1">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <footer class="ftco-footer ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">NatureNest</h2>
                        <p>Whether you're looking for a fresh, organic salad or a juicy, ripe fruit, NatureNest has got you covered. Our range of products is constantly expanding, thanks to our innovative farming techniques and our dedication to quality.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Menu</h2>
                        <ul class="list-unstyled">
                            <li><a href="product.php" class="py-2 d-block">Shop</a></li>
                            <li><a href="about.php" class="py-2 d-block">About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        All rights reserved <i class="fas fa-heart"></i> by
                        <a href="#" target="_blank">NatureNest</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>