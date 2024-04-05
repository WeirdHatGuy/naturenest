<?php
session_start();
require_once 'config.php';

// Get the product information from the AJAX request
$product_id = $_POST['productId'];
$product_name = $_POST['productName'];
$price = floatval($_POST['price']);

// Check if the product is already in the cart
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    $productExists = false;

    foreach ($cart as $item) {
        if ($item['productId'] == $product_id) {
            $productExists = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$productExists) {
        $cart[] = [
            'productId' => $product_id,
            'productName' => $product_name,
            'price' => $price,
            'quantity' => 1
        ];

        // Save the updated cart to the session
        $_SESSION['cart'] = $cart;

        // Send a success response
        echo json_encode(['status' => 'success']);
    }

    // If the product is already in the cart, send a success response
    // (assuming that the product quantity should be increased)
    else {
        echo json_encode(['status' => 'success']);
    }
}

// If the cart is not set, create a new one
else {
    $cart = [
        [
            'productId' => $product_id,
            'productName' => $product_name,
            'price' => $price,
            'quantity' => 1
        ]
    ];

    // Save the cart to the session
    $_SESSION['cart'] = $cart;

    // Send a success response
    echo json_encode(['status' => 'success']);
}
?>