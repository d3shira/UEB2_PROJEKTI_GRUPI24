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
    <link rel="stylesheet" href="manage-order.css">

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<header style="text-decoration:none;">
    <a href="admin dashboard.php" class="logo"><i class="fas fa-utensils"></i> FitYou - Admin Panel </a>
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
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="admin dashboard.php" class="fa-solid fa-user"></a>
    </div>
    
</header>
<body>
     <!-- CONTENT SECTION -->
     <div class="tbl-content2">
    <table class="tbl-full2">
        <h1>Meange Order</h1>
        <br /><br /><br />
        <tr>
            <th>Nr.</th>
            <th>Name and surname</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>1.</td>
            <td>Blerta Azemi</td>
            <td>blertaazemi@gmail.com</td>
            <td>
                <a href="#" class="update-button">Update Staff</a>
                <a href="#" class="delete-button">Delete Staff</a>
            </td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Dafina Balaj</td>
            <td>dafinabalaj@gmail.com</td>
            <td>
                <a href="#" class="update-button">Update Staff</a>
                <a href="#" class="delete-button">Delete Staff</a>
            </td>
        </tr>
        <tr>
            <td>1.</td>
            <td>Besmira Berisha</td>
            <td>besmiraberisha@gmail.com</td>
            <td>
                <a href="#" class="update-button">Update Staff</a>
                <a href="#" class="delete-button">Delete Staff</a>
            </td>
        </tr>
        <tr>
            <td>1.</td>
            <td>Deshira Randobrava</td>
            <td>deshirarandobrava@gmail.com</td>
            <td>
                <a href="#" class="update-button">Update Staff</a>
                <a href="#" class="delete-button">Delete Staff</a>
            </td>
        </tr>
        <tr>
            <td>1.</td>
            <td>Dafina Sadiku</td>
            <td>dafinasadiku@gmail.com</td>
            <td>
                <a href="#" class="update-button">Update Staff</a>
                <a href="#" class="delete-button">Delete Staff</a>
            </td>
        </tr>

    </div>
</div>
        
<body>
</body>
</html>