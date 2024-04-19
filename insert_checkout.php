<?php
// Database connection parameters
require_once 'header.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare the payment method query
    $payment_method_query = "SELECT id FROM user_payment_method WHERE user_id = :user_id AND payment_type_id = :provider";
    $stmt = $conn->prepare($payment_method_query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':provider', $_POST['payment']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $payment_method_id = $result['id'];
    } else {
        echo "Error: Payment method not found or not associated with the user.";
        exit;
    }

     // Fetch the user's default address ID
    $userId = $_SESSION['user_id'];
    $sql = "SELECT address_id FROM user_address WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $defaultAddressId = $result['address_id'];

 
     // Fetch the selected shipping method ID
     $shippingMethod = $_POST['shipping_method'];
     $sql = "SELECT id FROM shipping_method WHERE id = :shipping_method";
     $stmt = $conn->prepare($sql);
     $stmt->bindParam(':shipping_method', $shippingMethod);
     $stmt->execute();
     $result = $stmt->fetch(PDO::FETCH_ASSOC);
     $shippingMethodId = $result['id'];

    // Calculate the total order amount by summing the prices of all items in the cart
    $sql = "SELECT sci.product_item_id, sci.qty, pi.price
            FROM shopping_cart_item sci
            JOIN product_item pi ON sci.product_item_id = pi.id
            WHERE sci.cart_id = (SELECT id FROM shopping_cart WHERE user_id = :user_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalOrderAmount = 0;
    foreach ($result as $row) {
        $totalOrderAmount += $row['price'] * $row['qty'];
    }

    // Determine the initial order status. For example, "Pending" when the order is first created.
    $initialOrderStatus = 1; // Assuming 1 represents "Pending" in your order_status table

    // Insert data into the shop_order table using the IDs
    $sql = "INSERT INTO shop_order (user_id, order_date, payment_method_id, shipping_address, shipping_method, order_total, order_status) VALUES (:user_id, NOW(), :payment_method_id, :shipping_address_id, :shipping_method_id, :total_order_amount, :initial_order_status)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':payment_method_id', $payment_method_id);
    $stmt->bindParam(':shipping_address_id', $defaultAddressId); // Use the default address ID here
    $stmt->bindParam(':shipping_method_id', $shippingMethodId); // Use the selected shipping method ID here
    $stmt->bindParam(':total_order_amount', $totalOrderAmount);
    $stmt->bindParam(':initial_order_status', $initialOrderStatus);
    if ($stmt->execute()) {
        $orderId = $conn->lastInsertId();

        // Insert order lines into the order_line table
        $sql = "INSERT INTO order_line (order_id, product_item_id, qty, price) VALUES (:order_id, :product_item_id, :qty, :price)";
        $stmt = $conn->prepare($sql);
        foreach ($result as $row) {
            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':product_item_id', $row['product_item_id']);
            $stmt->bindParam(':qty', $row['qty']);
            $stmt->bindParam(':price', $row['price']);
            $stmt->execute();
        }

        // Set the cart_emptied session variable to true
        $_SESSION['cart_emptied'] = true;

        header("Location: thank_you.php?order_id=$orderId");
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

// Close connection
$conn = null;
?>
