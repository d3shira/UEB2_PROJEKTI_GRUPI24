<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>
<?php 
@include 'staff-navbar.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Staff!!</title>
    <link rel = "stylesheet" href="staff.css">
  

    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <style>
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site, you are our newest staff member!!</h1>
    <p>
        <a href="../reset-password.php" class="add-button">Reset Your Password</a>
        <a href="../logout.php" class="delete-button">Sign Out of Your Account</a>
    </p>
</body>
</html>