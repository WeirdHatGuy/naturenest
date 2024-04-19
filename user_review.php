<?php 
require_once 'header.php';

if(basename($_SERVER['PHP_SELF']) != 'user_review.php') {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
        header("Location: auth.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $orderLineId = $_POST['order_line_id']; // Use the selected order line ID

    // Fetch the product item ID from the selected order line
    $sql = "SELECT product_item_id FROM order_line WHERE id = :order_line_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':order_line_id', $orderLineId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $productItemId = $result['product_item_id']; // Get the product item ID

    // The rest of your code remains the same...
    $rating_value = htmlspecialchars($_POST['rating_value']);
    $comment = htmlspecialchars($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO user_review (user_id, ordered_product_id, rating_value, comment) VALUES (:user_id, :ordered_product_id, :rating_value, :comment)");

    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':ordered_product_id', $productItemId);
    $stmt->bindParam(':rating_value', $rating_value);
    $stmt->bindParam(':comment', $comment);

    try {
        if ($stmt->execute()) {
            echo "Review submitted successfully!";
        } else {
            echo "Error submitting review.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }

}
?>
<?php
// Fetch recent orders for the current user
$sql = "SELECT ol.id AS order_line_id, pi.product_id, p.name AS product_name, so.order_date
        FROM shop_order so
        JOIN order_line ol ON so.id = ol.order_id
        JOIN product_item pi ON ol.product_item_id = pi.id
        JOIN product p ON pi.product_id = p.id
        WHERE so.user_id = :user_id AND so.order_status = 4
        ORDER BY so.order_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$recentOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NatureNest User Reviews</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles2.css">
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

    <div class="container">
        <h1 class="text-center mt-5">User Reviews</h1>

    <?php
        // Get the user ID from the session variable
        $user_id = $_SESSION['user_id'];

        // SQL query to fetch user reviews
        $query = "SELECT r.id, r.rating_value, r.comment, p.name AS product_name
        FROM user_review r
        JOIN order_line ol ON r.ordered_product_id = ol.id
        JOIN product_item pi ON ol.product_item_id = pi.id
        JOIN product p ON pi.product_id = p.id
        WHERE r.user_id = ?
        ORDER BY r.id DESC";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>Order id: " . htmlspecialchars($row['id']) . "</td><br>";
            echo "<td>Rating: " . htmlspecialchars($row['rating_value']) . "</td><br>";
            echo "<td>Comment: " . htmlspecialchars($row['comment']) . "</td><br>";
            echo "<td>Product: " . htmlspecialchars($row['product_name']) . "</td><br>";
            echo "</tr><br>";
        }

        // Close the database connection
        $conn = null;
    ?>
    
    </div>
    <div class="container mt-5">
        <h1>Leave a Review</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="order_line_id">Select a Recent Order</label>
                <select class="form-control" id="order_line_id" name="order_line_id" required>
                    <?php foreach ($recentOrders as $order): ?>
                        <option value="<?php echo htmlspecialchars($order['order_line_id']); ?>">
                            <?php echo htmlspecialchars($order['product_name']) . ' - Order Date: ' . htmlspecialchars($order['order_date']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="rating_value">Rating (1-5)</label>
                <input type="number" min="1" max="5" class="form-control" id="rating_value" name="rating_value" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>