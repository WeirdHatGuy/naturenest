<?php

require_once 'header.php';

// Check if the file name is not index.php
if(basename($_SERVER['PHP_SELF'])!= 'product.php') {
    // Redirect to login.php if session variables are not set
    if (!isset($_SESSION['user_id']) ||!isset($_SESSION['user_name'])) {
        header("Location: auth.php");
        exit();
    }
}
// Assuming $conn is your PDO connection

// Check if a shopping cart exists for the current user
$sql = "SELECT id FROM shopping_cart WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

// If no cart exists, create one
if (!$cart) {
    $sql = "INSERT INTO shopping_cart (user_id) VALUES (:user_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $cartId = $conn->lastInsertId(); // Get the ID of the newly inserted cart
} else {
    $cartId = $cart['id']; // Use the existing cart ID
}

if (isset($_POST["add_to_cart"])) { 
    // Get the product item ID from the form 
    $product_item_id = $_POST["product_id"]; 
    
    // Get the product quantity from the form 
    $product_quantity = $_POST["quantity"]; 

    // Insert the item into the shopping cart item table
    $sql = "INSERT INTO shopping_cart_item (cart_id, product_item_id, qty) VALUES (:cart_id, :product_item_id, :qty)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cart_id', $cartId);
    $stmt->bindParam(':product_item_id', $product_item_id);
    $stmt->bindParam(':qty', $product_quantity);
    $stmt->execute();

    // Redirect to the cart page
    header("Location: cart.php");
    exit();
}

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
    <h1>Products</h1>
    <div class="row">
        <?php
        $sql = "SELECT p.id, p.category_id, p.name, p.description, p.product_image, pi.qty_in_stock, pi.price FROM product p JOIN product_item pi ON p.id = pi.product_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

            // Fetch the result using fetchAll()
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            $productName = $product['name'];
            $price = $product['price'];
            $qtyInStock = $product['qty_in_stock'];
            $productImage = $product['product_image'];
            $description = $product['description'];

                echo '<div class="col-md-6 col-lg-3 ftco-animate padding-15">
                    <div class="product card">
                    <img src="'. $productImage. '" class="card-img-top" alt="'. $productName. '">
                        <div class="card-body text-center">
                            <h5 class="card-title">'. $productName. '</h5>
                            <p class="card-text">'. $description. '</p>
                            <p class="card-text">₹'. $price. '</p>
                            <p class="card-text">Qty in Stock: '. $qtyInStock. '</p>
                            <!-- Add to Cart Form -->
                            <form method="post" action="product.php">
                            <input type="hidden" name="product_id" value="' . $product['id'] . '">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="" min="0" max="', $product['qty_in_stock'], '">
                            <button type="submit" class="add-to-cart-button" name="add_to_cart" data-product-id="<?php echo $product["id"];">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
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
