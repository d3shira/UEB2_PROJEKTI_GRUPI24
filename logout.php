<?php
session_start();
 

if (isset($_COOKIE["username"])) {
    setcookie("username", "", time() - 86400, "/");
}
if (isset($_COOKIE["user_type"])) {
    setcookie("user_type", "", time() - 86400, "/");
}
$_SESSION = array();
 
session_destroy();
 
header("location: login.php");
exit;
?>