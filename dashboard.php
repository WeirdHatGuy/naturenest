<?php
session_start();
require_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
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

    <div class="container">
    <h1>Add Payment Method</h1>
    <form id="paymentMethodForm" action="add_payment_method.php" method="post">
        <div class="form-group">
            <label for="payment_type">Payment Type</label>
            <select id="payment_type" class="form-control" name="payment_type_id" required>
                <option value="1">Cash</option>
                <option value="2">Debit Card</option>
                <option value="3">Credit Card</option>
                <option value="4">UPI</option>
            </select>
        </div>
        <div class="form-group">
            <label for="provider">Provider</label>
            <input type="text" class="form-control" id="provider" name="provider">
        </div>
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number">
        </div>
        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date">
        </div>
        <button type="submit" class="btn btn-primary">Add Payment Method</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var paymentTypeSelect = document.getElementById('payment_type');
    var providerInput = document.getElementById('provider');
    var accountNumberInput = document.getElementById('account_number');
    var expiryDateInput = document.getElementById('expiry_date');
    var paymentMethodForm = document.getElementById('paymentMethodForm');

    // Function to update form fields based on payment type
    function updateFormFields() {
        var selectedPaymentType = paymentTypeSelect.value;
        if (selectedPaymentType === '1') { // Cash
            providerInput.disabled = true;
            accountNumberInput.disabled = true;
            expiryDateInput.disabled = true;
        } else {
            providerInput.disabled = false;
            accountNumberInput.disabled = false;
            expiryDateInput.disabled = false;
        }
    }

    // Function to validate form fields before submission
    function validateForm() {
        var selectedPaymentType = paymentTypeSelect.value;
        if (selectedPaymentType !== '1' && (providerInput.value === '' || accountNumberInput.value === '' || expiryDateInput.value === '')) {
            alert('Please fill in all required fields.');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    // Listen for changes to the payment type select field
    paymentTypeSelect.addEventListener('change', updateFormFields);

    // Listen for form submission
    paymentMethodForm.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission
        }
    });

    // Call the function initially to set the correct state
    updateFormFields();
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Target only forms with the 'delete-address-form' class
    var forms = document.querySelectorAll('.delete-address-form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!confirm('Are you sure you want to delete this address?')) {
                event.preventDefault();
            }
        });
    });
});
</script>


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