<?php
require_once 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to view this page.');
}

$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Tracking</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <?php
    $query = 'SELECT o.id AS order_id, o.order_date, s.name AS shipping_method, os.status AS order_status, o.order_total
    FROM shop_order o
    JOIN shipping_method s ON o.shipping_method = s.id
    JOIN order_status os ON o.order_status = os.id
    WHERE o.user_id = ?
    ORDER BY o.order_date DESC';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $userId, PDO::PARAM_INT); // Corrected line for PDO
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC); // Corrected line for PDO
    
    $stmt->closeCursor(); // Corrected line for PDO
    $conn = null; // Close the database connection
    
    ?>

    <div class="container mt-5">
        <h1>Order Tracking</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Shipping Method</th>
                    <th>Order Status</th>
                    <th>Order Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= date('F j, Y', strtotime($order['order_date'])) ?></td>
                        <td><?= htmlspecialchars($order['shipping_method']) ?></td>
                        <td><?= htmlspecialchars($order['order_status']) ?></td>
                        <td><?= htmlspecialchars($order['order_total']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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