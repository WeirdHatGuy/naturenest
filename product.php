<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NatureNest</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            <li class="nav-item"><a class="nav-link-special" id="product-link" href="product.php">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
            <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
            <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
            <li class="nav-item"><a class="nav-link-special" href="contact.php">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <h1>Products</h1>
    <div class="row">
        <?php
        require_once 'config.php';

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];

            $productNames = array_column($cart, 'productName');
        }

        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Fetch the result using fetchAll()
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($products as $product) {
            $productName = $product['name'];
            $price = $product['price'];

            $addToCartBtn = '<button class="btn btn-primary add-to-cart" data-product_id="' . $product['product_id'] . '" data-product-name="' . $product['name'] . '" data-price="' . $product['price'] .'">Add to Cart</button>';
            // Check if the product is already in the cart
            if (isset($productNames) && in_array($productName, $productNames)) {
                $addToCartBtn = '<button class="btn btn-primary added-to-cart" data-product_id="' . $product['product_id'] . '" data-product-name="' . $product['name'] . '" data-price="' . $product['price'] .'">Added to Cart</button>';
            }

            echo '<div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product card">
                    <img src="images/product-' . $product['product_id'] . '.jpg" class="card-img-top" alt="' . $productName . '">
                        <div class="card-body text-center">
                            <h5 class="card-title">' . $productName . '</h5>
                            <p class="card-text">$' . $price . '</p>
                            ' . $addToCartBtn . '
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
</div>

<footer class="footer mt-auto py-3 bg-light">
<div class="container">
        <span class="text-muted">Copyright &copy;<script>document.write(new Date().getFullYear());</script> NatureNest</span>
    </div>
</footer>

<script>
    $(document).ready(function () {
        $('.add-to-cart').click(function (e) {
            e.preventDefault();

            const productId = $(this).data('product_id');
            const productName = $(this).data('product-name');
            const price = $(this).data('price');

            // Directly send the product details to the server
            $.ajax({
                url: 'addToCart.php',
                type: 'POST',
                data: {
                    productId: productId,
                    productName: productName,
                    price: price,
                    addToCart: true
                },
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                    // Update the UI by changing the 'Add to Cart' button to 'Added to Cart'
                    const button = $(`button[data-product_id="${productId}"]`);
                    button.text('Added to Cart');
                    button.removeClass('add-to-cart');
                    button.addClass('added-to-cart');

                    // Fetch the updated cart from the server
                    fetchCart();
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error('Error adding to cart:', error);
                }
            });
        });

        function fetchCart() {
            $.ajax({
                url: 'fetchCart.php',
                type: 'GET',
                success: function(response) {
                    const cart = JSON.parse(response);
                    // Update the 'Cart' navbar link with the number of items in the cart
                    const cartLink = $('.navbar .cart-link');
                    cartLink.text('Cart (' + cart.items.length + ')');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching cart:', error);
                }
            });
        }

        // Update the 'Cart' navbar link with the number of items in the cart
        const cartLink = $('.navbar .cart-link');
        cartLink.text('Cart (0)');

        // Fetch the initial cart
        fetchCart();

        // Add event listener for 'Added to Cart' buttons
        $('.added-to-cart').click(function () {
            const productId = $(this).data('product_id');

            // Directly send the product details to the server
            $.ajax({
                url: 'removeFromCart.php',
                type: 'POST',
                data: {
                    productId: productId,
                    removeFromCart: true
                },
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                    // Update the UI by changing the 'Added to Cart' button to 'Add to Cart'
                    const button = $(`button[data-product_id="${productId}"]`);
                    button.text('Add to Cart');
                    button.removeClass('added-to-cart');
                    button.addClass('add-to-cart');

                    // Fetch the updated cart from the server
                    fetchCart();
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error('Error removing from cart:', error);
                }
            });
        });
    });
</script>
</body>
</html>