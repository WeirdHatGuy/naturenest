<?php
session_start();
require_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Attempt to get the user's information from the database
$stmt = $conn->prepare('SELECT id, email_address AS email, phone_number AS phone FROM site_user WHERE id = :id');
$stmt->bindValue(':id', $_SESSION['user_id']);
$stmt->execute();

// Check if the query returned a result
if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Ensure we're fetching an associative array
} else {
    // Handle the case where no user is found
    echo "No user found with the provided ID.";
    exit; // Stop the script
}

// Get the list of countries from the database
$stmt = $conn->prepare('SELECT * FROM country');
$stmt->execute();
$countries = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NatureNest</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
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
        <h1>Profile Information</h1>
        <?php if (is_array($user)): ?>
            <p>Email:
                <?php echo $user['email']; ?>
            </p>
            <p>Phone:
                <?php echo $user['phone']; ?>
            </p>
        <?php else: ?>
            <p>User information could not be retrieved.</p>
        <?php endif; ?>
        <a href="update_profile.php" class="btn btn-primary">Update Profile</a>
    </div>


    <div class="container">
        <h1>Manage Addresses</h1>
        <div class="row">
            <div class="col-md-6">
                <h2>Add Address</h2>
                <form action="add_address.php" method="post">
                    <div class="form-group">
                        <label for="unit_number">Unit Number</label>
                        <input type="text" class="form-control" id="unit_number" name="unit_number">
                    </div>
                    <div class="form-group">
                        <label for="street_number">Street Number</label>
                        <input type="text" class="form-control" id="street_number" name="street_number">
                    </div>
                    <div class="form-group">
                        <label for="address_line1">Address Line 1</label>
                        <input type="text" class="form-control" id="address_line1" name="address_line1" required>
                    </div>
                    <div class="form-group">
                        <label for="address_line2">Address Line 2 (optional)</label>
                        <input type="text" class="form-control" id="address_line2" name="address_line2">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" id="region" name="region" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" class="form-control" name="country" required>
                            <?php foreach ($countries as $country): ?>
                                <option value="<?php echo $country['id']; ?>">
                                    <?php echo $country['country_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Existing Addresses</h2>
                <?php include 'existing_addresses.php'; ?>
            </div>
        </div>
    </div>
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
