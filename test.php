<?php
$conn = mysqli_connect("host", "root", " ", "naturenest2");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$userId = 1; // replace with actual user ID

$sql = "CALL GetUserAddresses($userId)";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Email: " . $row["email_address"]. " - Address: " . $row["address_line1"]. " " . $row["address_line2"]. ", " . $row["city"]. ", " . $row["region"]. " " . $row["postal_code"]. ", " . $row["country_name"]. "<br>";
    }
} else {
    echo "No addresses found for user";
}

mysqli_close($conn);
?>