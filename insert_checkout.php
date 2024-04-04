<?php
// Database connection parameters
require_once 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $payment_method = $conn->real_escape_string($_POST['payment']);

    // Query the payment_methods table to get the payment method ID
    $payment_method_query = "SELECT payment_method_id FROM payment_methods WHERE payment_method_name = '$payment_method'";
    $result = $conn->query($payment_method_query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $payment_method_id = $row['payment_method_id'];

        // Insert data into database
        $sql = "INSERT INTO checkout (first_name, last_name, email, address, payment_method_id) VALUES ('$first_name', '$last_name', '$email', '$address', '$payment_method_id')";
        if ($conn->query($sql) === TRUE) {
            header("Location: thank_you.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Payment method not found";
    }
}

// Close connection
$conn->close();
?>
