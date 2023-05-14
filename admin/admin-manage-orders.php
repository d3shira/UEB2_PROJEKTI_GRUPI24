<?php require_once "../database.php"; ?>
<?php           
                if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
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
<div>
    <div class="wrapper">
        <h3 style="text-align: left; margin:90px; font-size: 25px; color:#192a56;">Manage Orders</h3>
    </div>


    <!-- CONTENT SECTION -->
    <br><br>
    <div class="tbl-container">
    <div class="tbl-content">
        <table class="tbl-full">
            <tr>
                <th>Nr</th>
                <th>Diet_id</th>
                <th>User_id</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Quantity</th>
                <th>Total_price</th>
                <th>Order_date</th>
                <th>Status</th>
                <th>Actions</th>


            </tr>
            
           <?php 
            //Display staff + query to display staff
            $sql = "SELECT * FROM tbl_orders;
            -- FROM tbl_diet u
            -- INNER JOIN tbl_orders cp ON u.diet_id = cp.diet_id";

            //execyte query
            $res = mysqli_query($conn, $sql);

            //check if query is executed or no
            if($res==TRUE){
                //count rows to check if we have data in database or not;
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
                        $diet_id = $rows['diet_id'];
                        $user_id = $rows['user_id'];
                        $address = $rows['address'];
                        $contact = $rows['contact'];
                        $quantity = $rows['quantity'];
                        $total_price = $rows['total_price'];
                        $order_date = $rows['order_date'];
                        $status = $rows['status'];

                        //display the values in our table
                        ?>
                        <!--html code in between here to display staff-->
                        <tr>
                            <td><?php echo $sn++; ?></td> 
                            <td><?php echo $diet_id; ?></td>
                            <td><?php echo $user_id; ?></td>  
                            <td><?php echo $address; ?></td>
                            <td><?php echo $contact; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $total_price; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $status; ?></td>


                            <td>
                            <a class="update-button" href="<?php echo 'http://localhost/UEB2_PROJEKTI/admin/update-client.php?user_id=' .$id; ?>">Update Order</a>
                            <a class="delete-button" href="<?php echo 'http://localhost/UEB2_PROJEKTI/admin/delete-client.php?user_id=' .$id; ?>">Delete Order</a>
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