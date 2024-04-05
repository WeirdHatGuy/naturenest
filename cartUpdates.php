<?php
session_start();
require_once 'config.php';
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$lastEventId = isset($_SERVER['LAST_EVENT_ID']) ? intval($_SERVER['LAST_EVENT_ID']) : 0;

$newData = false;

// Check if the cart has changed
if (isset($_SESSION['cart'])) {
    $newData = true;
}

if ($newData) {
    // Send the updated cart to the client
    echo 'data: ' . json_encode(['cart' => $_SESSION['cart']]) . "\n\n";
    flush();
}

// Keep the connection open for new updates
event_source_set_max_age(30);