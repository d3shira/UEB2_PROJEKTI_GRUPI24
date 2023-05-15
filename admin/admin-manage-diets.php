<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Diets</title>
     <!--font awesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel="stylesheet" href="manage-staff.css">

  

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<header style="text-decoration:none;">
    <a href="admin dashboard.php" class="logo"><i class="fas fa-utensils"></i> FitYou - Admin Dashboard </a>
    <nav class="navbar">
        <div class="dropdown">
            <a class="dropbtn">Manage Users</a>
            <div class="dropdown-content">
                <a href="admin-manage-staff.php">Manage Staff</a>
                <a href="admin-manage-clients.php">Manage Clients</a>
            </div>
        </div>
        <a class="" href="admin-manage-diets.php">Manage Diets</a>
        <a class="" href="admin-manage-orders.php">Manage Orders</a>
        <a class="" href="admin-manage-questions.php">Manage Questions</a>
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="admin dashboard.php" class="fa-solid fa-user"></a>
    </div>
</header>
<body>
<?php
define('SITEURL', 'http://localhost/UEB2_PROJEKTI/');
?>

    <!-- Button to Add Admin-->
    
 
     <!-- CONTENT SECTION -->
     <div class="tbl-content">

     <a href="<?php echo SITEURL; ?>admin/admin-add-diet.php" class="update-button">Add Diet</a>
      <br><br>
    <table class="tbl-full">
        <tr>
            <th>ID</th>
            <th>Diet Name</th>
            <th>Price</th>
            <th>In Stock</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Diet</a>
                <a class="delete-button" href="#">Delete Diet</a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Diet</a>
                <a class="delete-button" href="#">Delete Diet</a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Diet</a>
                <a class="delete-button" href="#">Delete Diet</a>
            </td>
        </tr>
    </table>
    
    </div>
   
</body>
</html>