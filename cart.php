<?php
require_once 'header.php';
// Check if the user is logged in
if(basename($_SERVER['PHP_SELF'])!= 'cart.php') {
    // Redirect to login.php if session variables are not set
    if (!isset($_SESSION['user_id']) ||!isset($_SESSION['user_name'])) {
        header("Location: auth.php");
        exit();
    }
}

// Get the user's cart
$sql = "SELECT sci.id, sci.product_item_id, sci.qty, pi.price, pi.product_image, p.name
        FROM shopping_cart_item sci
        JOIN shopping_cart sc ON sci.cart_id = sc.id
        JOIN product_item pi ON sci.product_item_id = pi.id
        JOIN product p ON pi.product_id = p.id
        WHERE sc.user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total price
$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['qty'];
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NatureNest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">NatureNest</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
</nav>

<div class="container">
    <h1>Shopping Cart</h1>
    <table class="table">
        <thead>
            <tr data-cart-item-id="<?php echo $item['id']; ?>">
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <?php
                $itemTotal = $item['price'] * $item['qty'];
                $totalPrice += $itemTotal;
                ?>
                <tr>
                    <td>
                        <img src="<?php echo $item['product_image']; ?>" alt="<?php echo $item['name']; ?>" width="100">
                        <?php echo $item['name']; ?>
                    </td>
                    <td><?php echo $item['qty']; ?></td>
                    <td>$<?php echo $item['price']; ?></td>
                    <td>$<?php echo $itemTotal; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th>$<?php echo $totalPrice; ?></th>
                </tr>
        </tfoot>
    </table>
    <form action="checkout.php" method="post"> 
                <input type="submit" 
                       value="Checkout" 
                       class="button" /> 
            </form> 
</div>
 
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
					<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fas fa-heart"></i> by <a href="#" target="_blank">NatureNest</a></p>
				</div>
			</div>
			</div>
			</footer>
</body>
</html>