<?php
session_start();
require_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO user_payment_method (user_id, payment_type_id, provider, account_number, expiry_date, is_default) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bindValue(1, $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->bindValue(2, $_POST['payment_type_id'], PDO::PARAM_INT);
    $stmt->bindValue(3, $_POST['provider'], PDO::PARAM_STR);
    $stmt->bindValue(4, $_POST['account_number'], PDO::PARAM_STR);
    $stmt->bindValue(5, $_POST['expiry_date'], PDO::PARAM_STR);
    $stmt->bindValue(6, isset($_POST['is_default']) ? 1 : 0, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Payment method added successfully.";
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $stmt->errorInfo()[2]; // Use errorInfo() for PDO
    }

    // Close statement
    $stmt = null;
}
?>
