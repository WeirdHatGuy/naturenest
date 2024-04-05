<?php

session_start();

// Check if the file name is not index.php
if (basename($_SERVER['PHP_SELF']) != 'blog.php') {
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
<<<<<<< HEAD

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">NatureNest</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link-special" href="product-single.html">Products</a></li>
                    <li class="nav-item"><a class="nav-link-special" href="cart.html">Cart</a></li>
                    <li class="nav-item"><a class="nav-link-special" href="contact.html">Contact</a></li>
                    <li class="nav-item"><a class="nav-link-special" href="about.html">About</a></li>
                </ul>
            </div>
        </div>
=======
    
    <link rel="stylesheet" href="css/style.css">
</head>
        <p></p>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
<<<<<<< HEAD
            <span class="text-muted">Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> NatureNest
            </span>
=======
            <span class="text-muted">Copyright &copy;<script>document.write(new Date().getFullYear());</script> NatureNest</span>
>>>>>>> e0b900971b416343437a657404e45f7d81aa4d4b
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<<<<<<< HEAD

</html>
=======
</html>


>>>>>>> e0b900971b416343437a657404e45f7d81aa4d4b
