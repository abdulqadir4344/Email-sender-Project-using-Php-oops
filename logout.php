<?php
// Start the session to destroy it
session_start();

// Destroy the session to log the user out
session_unset();
session_destroy();

// Redirect the user to the signup page
header("Location: index.php");
exit();
?>