<?php require_once "../database.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <title>Document</title>

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel="stylesheet" href="manage-staff.css">
    <link rel="stylesheet" href="manage-order.css">
    <link rel="stylesheet" href="register-staff.css">

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<body>

    <!--HEADER SECTION-->
    <!--me nderru disa icons dhe menu-->
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
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="admin dashboard.php" class="fa-solid fa-user"></a>
    </div>
</header>
<br><br><br>
<div class="wrapper">
    <div class="form-group">
    <h3 style="text-align: left; margin:45px; font-size: 25px; color:#192a56;">Update Order</h3>

    <?php 
    //1. Get the ID of Selected Staff
    $id=$_GET['order_id'];

    //2. Create SQL Query to Get the Details
    $sql="SELECT * FROM tbl_orders WHERE order_id=$id";

    //Execute the Query
    $res=mysqli_query($conn, $sql);

    //Check whether the query is executed or not
    if($res==true)
    {
        // Check whether the data is available or not
        $count = mysqli_num_rows($res);
        //Check whether we have admin data or not
        if($count==1)
        {
            // Get the Details
            //echo "Staff Available";
            $row=mysqli_fetch_assoc($res);

            $first_name = $row['address'];
            $last_name = $row['contact'];
            $username = $row['quantity'];
        }
        else
        {
            //Redirect to Manage Admin PAge
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-orders.php');
        }
    }
    
    
    ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td><label>Address:</label></td>
                    <td>
                        <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Contact: </label></td>
                    <td>
                        <input type="text" name="contact" class="form-control" value="<?php echo $contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Quantity: </label></td>
                    <td>
                        <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="order_id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Order" class="update-button">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['order_id'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $quantity = $_POST['quantity'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_users
        INNER JOIN tbl_client_profiles ON tbl_users.user_id = tbl_client_profiles.user_id
        SET tbl_users.first_name = '$first_name',
            tbl_users.last_name = '$last_name',
            tbl_users.username = '$username',
            tbl_users.email = '$email',
            tbl_client_profiles.first_name = '$first_name',
            tbl_client_profiles.last_name = '$last_name'
        WHERE tbl_users.user_id = '$id'";


        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Client Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-orders.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Client.</div>";
            //Redirect to Manage Admin Page
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-orders.php');
        }
    }

?>

</body>
</html>