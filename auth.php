<?php
// auth.php

// Database connection
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'naturenest2';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}

// Register new user
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $query = $conn->prepare('INSERT INTO site_user (email_address, phone_number, password) VALUES (:email, :phone, :password)');
    $query->bindParam(':email', $email);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':password', $password);

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query->execute();
}

// Login user
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $query = $conn->prepare('SELECT * FROM site_user WHERE email_address = :email');
    $query->bindParam(':email', $email);

    $email = $_POST['email'];

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (password_verify($_POST['password'], $result['password'])) {
            session_start();
            $_SESSION['user_id'] = $result['id'];

            // Check if the user already has a cart
            $userId = $_SESSION['user_id'];
            $sql = "SELECT id FROM shopping_cart WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            $cart = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cart) {
                // If the user already has a cart, use its ID
                $_SESSION['cart_id'] = $cart['id'];
            } else {
                // If the user doesn't have a cart, create a new one
                $sql = "INSERT INTO shopping_cart (user_id) VALUES (:user_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':user_id', $userId);
                $stmt->execute();
                $_SESSION['cart_id'] = $conn->lastInsertId();
            }

            header('Location: index.php');
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Login Page | VoidToArt</title>
</head>

<body>
    <div class="container" id="container">
        <!-- Login Form -->
        <div class="form-container sign-in">
            <form action="auth.php" method="post">
                <input type="hidden" name="action" value="login">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <!-- Registration Form -->
        <div class="form-container sign-up">
            <form action="auth.php" method="post">
                <input type="hidden" name="action" value="register">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="phone" placeholder="Phone Number">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <!-- Toggle Container -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of the site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of the site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
