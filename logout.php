<?php
session_start();

// Unsetting all the session variables
$_SESSION = array();

// Destroying the session
session_destroy();

// goto login page
header("Location: login.php");
exit();
?>