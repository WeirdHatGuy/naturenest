<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to perform this action.');
}

// Include your database connection script
require_once 'config.php';

// Check if the address ID is provided
if (isset($_POST['address_id'])) {
    $addressId = $_POST['address_id'];

    // Begin transaction
    $conn->beginTransaction();

    try {
        // Prepare a statement to delete the address from the user_address table
        $stmt = $conn->prepare("DELETE FROM user_address WHERE address_id = :address_id AND user_id = :user_id");
        $stmt->bindParam(':address_id', $addressId);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();

        // Prepare a statement to delete the address from the address table
        $stmt = $conn->prepare("DELETE FROM address WHERE id = :address_id");
        $stmt->bindParam(':address_id', $addressId);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect back to the page where the addresses are listed
        header('Location: dashboard.php');
        exit;
    } catch (PDOException $e) {
        // Roll back the transaction if there's an error
        $conn->rollBack();
        echo 'An error occurred: ' . $e->getMessage();
    }
} else {
    echo 'Address ID not provided';
}
?>
