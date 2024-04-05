<?php
// add_address.php

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

// Add address
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = $conn->prepare('INSERT INTO address (unit_number, street_number, address_line1, address_line2, city, region, postal_code, country_id) VALUES (:unit, :street, :line1, :line2, :city, :region, :code, :country)');
    $query->bindParam(':unit', $unit);
    $query->bindParam(':street', $street);
    $query->bindParam(':line1', $line1);
    $query->bindParam(':line2', $line2);
    $query->bindParam(':city', $city);
    $query->bindParam(':region', $region);
    $query->bindParam(':code', $code);
    $query->bindParam(':country', $country);

    $unit = $_POST['unit'];
    $street = $_POST['street'];
    $line1 = $_POST['line1'];
    $line2 = $_POST['line2'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $code = $_POST['code'];
    $country = $_POST['country'];

    $query->execute();

    $address_id = $conn->lastInsertId();

    $query = $conn->prepare('INSERT INTO user_address (user_id, address_id, is_default) VALUES (:user, :address, :default)');
    $query->bindParam(':user', $user);
    $query->bindParam(':address', $address);
    $query->bindParam(':default', $default);

    $user = $_SESSION['user_id'];
    $address = $address_id;
    $default = 1;

    $query->execute();
}
?>