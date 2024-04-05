<?php 
require_once 'header.php';

// Check if the file name is not index.php
if(basename($_SERVER['PHP_SELF'])!= 'user_review.php') { //appropriate file name
    // Redirect to login.php if session variables are not set
    if (!isset($_SESSION['user_id']) ||!isset($_SESSION['user_name'])) {
        header("Location: auth.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NatureNest User Reviews</title>
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link-special" href="product.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="user_review.php">User Review</a></li>
                    <li class="nav-item"><a class="nav-link-special" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link-special" href="about.php">About</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mt-5">User Reviews</h1>

        <?php
        // Connect to the database
        require_once 'db_connect.php';

        // Get the user ID from the session variable
        $user_id = $_SESSION['user_id'];

        // Get the user's reviews from the database
        $query = "SELECT r.id, r.rating_value, r.comment, p.name AS product_name, o.order_date
          FROM user_review r
          JOIN order_line ol ON r.ordered_product_id = ol.id
          JOIN product_item pi ON ol.product_item_id = pi.id
          JOIN product p ON pi.product_id = p.id
          JOIN shop_order o ON ol.order_id = o.id
          WHERE r.user_id = ?
          ORDER BY o.order_date DESC";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt->bind_result($id, $rating_value, $comment, $product_name, $order_date);
        // Display the user's reviews
        while ($row = $stmt->fetch()) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">'. $row['product_name']. '</h5>';
            echo '<p class="card-text">'. $row['comment']. '</p>';
            echo '<p class'. ($row['rating_value'] == 5? ' text-success' : ''). '">'. $row['rating_value']. ' stars</p>';
            echo '<p class="card-text"><small class="text-muted">'. $row['order_date']. '</small></p>';
            echo '</div>';
            echo '</div>';
        }

        // Close the database connection
        $conn = null;
       ?>

    </div>
    <div class="container mt-5">
        <h1>Leave a Review</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="order_id">Order ID</label>
                <input type="text" class="form-control" id="order_id" name="order_id" required>
            </div>
            <div class="form-group">
                <label for="product_item_id">Product Item ID</label>
                <input type="text" class="form-control" id="product_item_id" name="product_item_id" required>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>