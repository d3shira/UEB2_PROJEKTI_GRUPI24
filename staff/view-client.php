<?php require_once "../database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clients</title>
   

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="staff-navbar.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="../admin/manage-staff.css">

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<?php @include 'staff-navbar.php'?>
<body>

    <!--HEADER SECTION-->
    <!--me nderru disa icons dhe menu-->
    <header style="text-decoration:none;">
    <a href="#" class="logo"><i class="fas fa-utensils"></i>FitYou - Staff Dashboard</a>
    <nav class="navbar">
        <div class="dropdown">
            <a class="dropbtn">Staff</a>
            <div class="dropdown-content">
                <a href="../admin/admin-manage-clients.php">Clients</a>
                <a href="../admin/admin-manage-diets.php">Diets</a>
                <a href="../admin/admin-manage-orders.php">Orders</a>
            </div>
        </div>
        <a class="" href="../home.php">Home</a>
        <a class="" href="../aboutus.php">About Us</a>
        <a class="" href="../menu.php">Diets</a>
        <a class="" href="../blerta.php">Review</a>
        <!-- <a class="" href="order.php">Order</a> -->
        <a class="" href="../faqs.php">FAQs</a> 
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="admin dashboard.php" class="fa-solid fa-user"></a>
    </div>
</header>
<div>
    <div class="wrapper">
        <h3 style="text-align: left; margin:90px; font-size: 25px; color:#192a56;">View Clients</h3>
    </div>


    <!-- CONTENT SECTION -->
    <br><br><br><br>
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
                <th>Height (cm)</th>
                <th>Weight (kg)</th>
                <th>BMI</th>
                <th>Date created</th>
                <th>Actions</th>
            </tr>

           <?php 
            //Display staff + query to display staff
            $sql = "SELECT u.user_id, u.first_name, u.last_name, u.username, u.email, cp.height, cp.weight, 
            cp.bmi, u.date_time
            FROM tbl_users u
            INNER JOIN tbl_client_profiles cp ON u.user_id = cp.user_id";

            //execyte query
            $res = mysqli_query($conn, $sql);

            //check if query is executed or no
            if($res==TRUE){
                //count rows to check if we have data in database or not
                $count = mysqli_num_rows($res);
                $sn = 1;

                //check number of rows
                if($count>0){
                    //we have data in database
                    //gets all rows from database and stores them in the $rows variable
                    while($rows = mysqli_fetch_assoc($res)){
                        //while loop gets all data from database
                        //while loop runs as long as we have data in database

                        //get individual data
                        $id = $rows['user_id'];
                        $first_name = $rows['first_name'];
                        $last_name = $rows['last_name'];
                        $username = $rows['username'];
                        $email = $rows['email'];
                        $bmi = $rows['bmi'];
                        $height = $rows['height'];
                        $weight = $rows['weight'];
                        $date_time = $rows['date_time'];

                        //display the values in our table
                        ?>
                        <!--html code in between here to display staff-->
                        <tr>
                            <td><?php echo $sn++; ?></td>   <!--numrat me rend 1,2,3..-->
                            <td><?php echo $id?></td>
                            <td><?php echo $first_name; ?></td>
                            <td><?php echo $last_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $height; ?></td>
                            <td><?php echo $weight; ?></td>
                            <td><?php echo $bmi; ?></td>
                            <td><?php echo $date_time; ?></td>
                            <td>
                            <a class="update-button" href="<?php echo 'http://localhost/UEB2_PROJEKTI/admin/update-client.php?user_id=' .$id; ?>">View Client Profile</a>
                            </td>
                        </tr>
                        <?php



                }
            }
            else{
                //we do not have data in database
            }
        }



        ?>
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
    </script>

</body>
</html>