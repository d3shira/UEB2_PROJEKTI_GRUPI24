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
    <title>Manage Staff</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel="stylesheet" href="manage-staff.css">

    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
</head>
<body>
    <header style="text-decoration:none;">
        <a href="admin dashboard.php" class="logo"><i class="fas fa-utensils"></i> FitYou -Admin Dashboard </a>
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
            <h3 style="text-align: left; margin-top:90px; margin-left:90px; margin-right:90px; margin-bottom:45px; font-size: 25px; color:#192a56;">Manage Staff</h3>
        </div>
        <a style="margin-left:150px;" class ="add-button" href="admin-add-staff.php">Add Staff</a>
        <br><br>

        <!-- CONTENT SECTION -->
        <div class="tbl-container">
            <div class="tbl-content">
                <table class="tbl-full">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Profession</th>
                        <th>Date created</th>
                        <th>Actions</th>
                    </tr>
                    <tbody id="staff-table-body"></tbody>
                </table>
            </div>
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

            // Load staff data using AJAX
            window.addEventListener('DOMContentLoaded', () => {
                const staffTableBody = document.getElementById('staff-table-body');

                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'get-staff.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const staffData = JSON.parse(xhr.responseText);
                        let tableHTML = '';

                        staffData.forEach((staff, index) => {
                            const { id, first_name, last_name, username, email, profession, date_time } = staff;

                            tableHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${id}</td>
                                    <td>${first_name}</td>
                                    <td>${last_name}</td>
                                    <td>${username}</td>
                                    <td>${email}</td>
                                    <td>${profession}</td> 
                                    <td>${date_time}</td>
                                    <td>
                                        <a class="update-button" href="http://localhost/UEB2_PROJEKTI/admin/update-staff.php?user_id=${id}">Update Staff</a>
                                        <a class="delete-button" href="http://localhost/UEB2_PROJEKTI/admin/delete-staff.php?user_id=${id}">Delete Staff</a>
                                    </td>
                                </tr>
                            `;
                        });

                        staffTableBody.innerHTML = tableHTML;
                    }
                };
                xhr.send();
            });
        </script>
    </body>
</html>
