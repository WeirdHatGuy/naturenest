<?php
// update_profile.php

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

// Update user profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = $conn->prepare('UPDATE site_user SET email_address = :email, phone_number = :phone WHERE id = :id');
    $query->bindParam(':email', $email);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':id', $id);

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];

    $query->execute();
}
?>