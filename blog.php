<?php 

session_start();

// Check if the file name is not index.php
if(basename($_SERVER['PHP_SELF']) != 'blog.php') {
    // Redirect to index.php if session variables are not set
    if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
        header("Location: blog.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NatureNest</title>
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.html">NatureNest</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
              <li class="nav-item"><a class="nav-link-special" href="about.html">About</a></li>
              <li class="nav-item"><a class="nav-link-special" href="product-single.html">Products</a></li>
              <li class="nav-item"><a class="nav-link" href="cart.html">Cart</a></li>
              <li class="nav-item"><a class="nav-link" href="checkout.html">Checkout</a></li>
              <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
              <li class="nav-item"><a class="nav-link-special" href="contact.html">Contact</a></li>
            </ul>
          </div>
          
    </nav>

    <div class="container">
        <h1>Welcome to NatureNest's Blog</h1>
        <p></p>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Copyright &copy;<script>document.write(new Date().getFullYear());</script> NatureNest</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

