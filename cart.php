<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    </nav>

    <div class="container">
        <h1>Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-items">
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" id="cart-total">
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> NatureNest
            </span>
        </div>
    </footer>

    <script>
        function fetchCart() {
            // ...
            cart.forEach(item => {
                // ...
                const row = `
                    <tr data-product="${item.productId}">
                        <td>${item.productName}</td>
                        <td>$${item.price}</td>
                        <td>${item.quantity}</td>
                        <td>$${(item.price * item.quantity).toFixed(2)}</td>
                        <td><button class="btn btn-danger remove-from-cart" data-product-id="${item.productId}">Remove</button></td>
                    </tr>
                `;
                // ...
            });
            // ...
        }
        function removeFromCart(productId) {
            const xhr = new XMLHttpRequest();

            xhr.open("POST", "removeFromCart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Fetch the product name using the product ID
            fetch('fetchProductName.php?productId=' + productId)
                .then(response => response.text())
                .then(productName => {
                    xhr.send(`productName=${productName}`);
                })
                .catch(error => {
                    console.error('Error fetching product name:', error);
                });

            // ...
        }
    </script>
</body>

</html>