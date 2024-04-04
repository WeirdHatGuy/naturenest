<?php
$user = $_SESSION['user_id']; // Define $user first

$query = $conn->prepare('SELECT a.address_line1, a.address_line2, a.city, a.region, a.postal_code, ua.is_default FROM address a INNER JOIN user_address ua ON a.id = ua.address_id WHERE ua.user_id = :user');
$query->bindParam(':user', $user); // Now $user is defined, so this works as expected
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row['address_line1'] . ', ' . $row['address_line2'] . ', ' . $row['city'] . ', ' . $row['region'] . ', ' . $row['postal_code'] . ', ' . '</td>';
    echo '<td>' . ($row['is_default'] == 1 ? 'Yes' : 'No') . '</td>';
    echo '<td>';
    echo '<a href="#" class="btn btn-primary btn-sm">Edit</a> ';
    echo '<a href="#" class="btn btn-danger btn-sm">Delete</a>';
    echo '</td>';
    echo '</tr>';
}

?>