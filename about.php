<?php

require_once 'header.php';

// Check if the file name is not index.php
if (basename($_SERVER['PHP_SELF']) != 'about.php') {
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
    <title>NatureNest - Organic Delights</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">NatureNest</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                  <li class="nav-item"><a class="nav-link-special" href="about.php">About</a></li>
                  <li class="nav-item"><a class="nav-link-special" href="product.php">Products</a></li>
                  <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                  <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                  <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                  <li class="nav-item"><a class="nav-link" href="user_review.php">User Review</a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            <div class="slider-item" style="background-image: url(images/bg_2.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center">
                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">Discover Organic Delights</h1>
                            <h2 class="subheading mb-4">Explore the World of Fresh Organic Foods</h2>
                            <p><a href="product.php" class="btn btn-primary">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
        <h2 style='text-align:center;'>About Us</h2>
        <p style="text-align:center;">Welcome to NatureNest, your one-stop destination for the finest in sustainable agriculture. At NatureNest, we believe in nurturing the earth and enriching our lives with the fruits of our labor, all while adhering to the principles of sustainable development. Our mission is to cultivate a world where organic, hydroponic vegetables, fruits, and other natural products are not just a luxury, but a lifestyle choice for everyone.Our commitment to sustainability is at the heart of everything we do. We follow the Sustainable Development Goals (SDGs) closely, ensuring that our practices are not only environmentally friendly but also socially and economically responsible. Our hydroponic farming method allows us to produce high-quality, organic produce in a controlled environment, significantly reducing water usage and carbon footprint compared to traditional farming methods.</p>
            <div class="row no-gutters ftco-services">
                <div class="col-md-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            
                            <h3 class="heading">Free Shipping</h3>
                            <span>On orders over $100</span>
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
                            <span>Product well packaged</span>
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
                    <h2 class="mb-4">Our Organic Selection</h2>
                    <p>Explore our curated selection of fresh, organic products.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-2.jpg" alt="Organic Strawberries">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Organic Strawberries</a></h5>
                            <p class="card-text">$150.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="product.php" class="btn btn-primary add-to-cart">Add to Cart</a>
                                    <a href="product.php" class="btn btn-success buy-now mx-1">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-5.jpg" alt="Organic Tomatoes">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Organic Tomatoes</a></h5>
                            <p class="card-text">$150.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="product.php" class="btn btn-primary add-to-cart">Add to Cart</a>
                                    <a href="product.php" class="btn btn-success buy-now mx-1">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-6.jpg" alt="Organic Broccoli">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Organic Broccoli</a></h5>
                            <p class="card-text">$150.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="product.php" class="btn btn-primary add-to-cart">Add to Cart</a>
                                    <a href="product.php" class="btn btn-success buy-now mx-1">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                        <a href="#" class="img-prod">
                            <img class="card-img-top" src="images/product-7.jpg" alt="Organic Carrots">
                            <div class="overlay"></div>
                        </a>
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="#">Organic Carrots</a></h5>
                            <p class="card-text">$150.00</p>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="product.php" class="btn btn-primary add-to-cart">Add to Cart</a>
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
                    <p>Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> All rights reserved <i
                            class="fas fa-heart"></i> by <a href="#" target="_blank">NatureNest</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
