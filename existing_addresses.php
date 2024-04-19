<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to view this page.');
}
$user = $_SESSION['user_id'];

$query = $conn->prepare('SELECT a.address_line1, a.address_line2, a.city, a.region, a.postal_code, ua.address_id FROM address a INNER JOIN user_address ua ON a.id = ua.address_id WHERE ua.user_id = :user');
$query->bindParam(':user', $user);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row['address_line1'] . ', ' . $row['address_line2'] . ', ' . $row['city'] . ', ' . $row['region'] . ', ' . $row['postal_code'] .' '.'</td>';
    echo '<td>';
    echo '<form action="delete_address.php" method="post" class="delete-address-form">';
    echo '<input type="hidden" name="address_id" value="' . $row['address_id'] . '">';
    echo '<button type="submit" class="btn btn-danger btn-sm">Delete</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr><br>';
}

?>