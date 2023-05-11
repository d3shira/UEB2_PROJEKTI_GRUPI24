<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>

<header>
    <a href="#" class="logo"><i class="fas fa-utensils"></i> FitYou - Admin Panel </a>
    <nav class="navbar">
        <a class="" href="admin-manage-users.php">Manage Users</a>
        <a class="" href="admin-manage-diets.php">Manage Diets</a>
        <a class="" href="admin-manage-orders.php">Manage Orders</a>
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="admin dashboard.php" class="fa-solid fa-user"></a>
    </div>
    </header>

<body>

<div class="content">
    <h3>DASHBOARD IN THE PROCESS</h3>
        <p>Dafina balaj trying to fix admin dashboard</p>
    </div>
<script> 
        const navbarLinks = document.querySelectorAll('.navbar a');

        navbarLinks.forEach(navbarLink => {
            navbarLink.addEventListener('click', () => {
            navbarLinks.forEach(navbarLink => {
            navbarLink.classList.remove('active');
            });
            navbarLink.classList.add('active');
            });
        });
    </script>
</body>
</html>