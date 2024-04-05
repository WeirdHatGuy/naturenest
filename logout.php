<?php
// logout.php

// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: auth.php"); // Change this to your preferred redirect page
exit();
?>
