<?php
$host = 'localhost';
$dbname = 'naturenest2';
$user = 'root';
$password = '';

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set the PDO fetch mode to associative array
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Set the PDO charset to utf8mb4
    $conn->exec("SET CHARACTER SET utf8mb4");
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>