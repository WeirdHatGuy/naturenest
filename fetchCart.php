<?php
session_start();

// Define a function to get the cart
function getCart(): array
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return ['items' => $_SESSION['cart'], 'total' => $total];
}

// Send a JSON response with the cart data
echo json_encode(getCart());
?>