<?php require_once "../database.php"; ?>

<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type'] !== 'admin') {
    header("location: ../login.php");
    exit;
}

if (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

if (isset($_SESSION['update'])) {
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel="stylesheet" href="manage-staff.css">

    <script src="../navbar.js"></script>

</head>

<body>
    <header style="text-decoration:none;">
        <a href="admin dashboard.php" class="logo"><i class="fas fa-utensils"></i> FitYou - Admin Dashboard</a>
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

    <div>
        <div class="wrapper">
            <h3 style="text-align: left; margin-top:90px; margin-left:90px; margin-right:90px; margin-bottom:45px; font-size: 25px; color:#192a56;">Manage Clients</h3>
        </div>

        <br><br>
        <div class="tbl-container">
            <div class="tbl-content">
                <table class="tbl-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Date created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="clients-table-body">
                    
                    </tbody>
                </table>
            </div>
        </div>
                                                       <!--ajax-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: "get-clients.php", 
                    type: "GET",
                    success: function(response) {
                        $(".clients-table-body").html(response);
                    }
                });
            });
        </script>

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
    </div>
</body>

</html>
