<?php
session_start(); // Start the session

// Destroy the session to log the user out
session_destroy();

// Redirect to the login page or homepage after logout
header("Location: index.php");
exit();
?>
