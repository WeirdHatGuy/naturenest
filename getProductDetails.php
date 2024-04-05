<?php
session_start();
require_once 'config.php';

// Get product details from the database
if (isset($_POST['productName'])) {
    $productName = $_POST['productName'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE name = :productName LIMIT 1");
    $stmt->bindParam(':productName', $productName);
    $stmt->execute();
    $product = $stmt->fetch();

    if ($product) {
        echo json_encode($product);
    }
}
?>