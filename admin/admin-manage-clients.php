<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients</title>
   

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
<body>

    <!--HEADER SECTION-->
    <!--me nderru disa icons dhe menu-->
    <header style="text-decoration:none;">
    <a href="admin dashboard.php" class="logo"><i class="fas fa-utensils"></i> FitYou - Admin Panel </a>
    <nav class="navbar">
        <div class="dropdown">
            <a class="dropbtn">Manage Users</a>
            <div class="dropdown-content">
                <a href="admin-manage-staff.php">Manage Staff</a>
                <a href="admin-manage-clients.php">Manage Clients</a>
                <a href="admin-add-staff.php">Add Staff</a>
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


    <!-- CONTENT SECTION -->
    <div class="tbl-content">
    <table class="tbl-full">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>-----</th>
            <th>Date created</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Client</a>
                <a class="delete-button" href="#">Delete Client</a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Client</a>
                <a class="delete-button" href="#">Delete Client</a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Client</a>
                <a class="delete-button" href="#">Delete Client</a>
            </td>
        </tr>
    </table>
    
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