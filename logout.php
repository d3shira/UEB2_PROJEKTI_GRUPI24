<?php
// Initialize the session
session_start();
 

if (isset($_COOKIE["username"])) {
    setcookie("username", "", time() - 86400, "/");
}
if (isset($_COOKIE["user_type"])) {
    setcookie("user_type", "", time() - 86400, "/");
}
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: login.php");
exit;
?>