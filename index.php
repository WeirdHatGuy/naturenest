<?php 

require_once 'header.php';

// Check if the file name is not index.php
if(basename($_SERVER['PHP_SELF']) != 'index.php') {
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
            <a class="navbar-brand" href="index.html">NatureNest</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                  <li class="nav-item"><a class="nav-link-special" href="about.php">About</a></li>
                  <li class="nav-item"><a class="nav-link-special" href="product.php">Products</a></li>
                  <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                  <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
                  <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                  <li class="nav-item"><a class="nav-link" href="user_review.php">User Review</a></li>
                  <li class="nav-item"><a class="nav-link-special" href="contact.php">Contact</a></li>
                </ul>
            </div> 
        </div>
    </nav>
    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            <div class="slider-items" style="background-image: url(images/bg_1.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center">
                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">Welcome to NatureNest</h1>
                            <h2 class="subheading mb-4">Your Source for Fresh Organic Foods</h2>
                            <p><a href="product-single.html" class="btn btn-primary">View Products</a></p>
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
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
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
                                    <a href="product-single.html" class="btn btn-primary add-to-cart">Add to Cart</a>
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
                                    <a href="product-single.html" class="btn btn-primary add-to-cart">Add to Cart</a>
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
                                    <a href="product-single.html" class="btn btn-primary add-to-cart">Add to Cart</a>
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
                                    <a href="product-single.html" class="btn btn-primary add-to-cart">Add to Cart</a>
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
			
