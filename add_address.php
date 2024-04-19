<?php
// add_address.php

require 'header.php';

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

    $unit = $_POST['unit_number'];
    $street = $_POST['street_number'];
    $line1 = $_POST['address_line1'];
    $line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $code = $_POST['postal_code'];
    $country = $_POST['country'];


    $query->execute();

    $address_id = $conn->lastInsertId();

    $query = $conn->prepare('INSERT INTO user_address (user_id, address_id) VALUES (:user, :address)');
    $query->bindParam(':user', $user);
    $query->bindParam(':address', $address);

    $user = $_SESSION['user_id'];
    $address = $address_id;

    $query->execute();
    header('Location: dashboard.php');
}
?>