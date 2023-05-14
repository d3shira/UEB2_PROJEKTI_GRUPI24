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
    <h3 style="text-align: left; margin:45px; font-size: 25px; color:#192a56;">Update Client</h3>

    <?php 
    //1. Get the ID of Selected Staff
    $id=$_GET['user_id'];

    //2. Create SQL Query to Get the Details
    $sql="SELECT * FROM tbl_users WHERE user_id=$id";

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

            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $username = $row['username'];
            $email = $row['email'];
        }
        else
        {
            //Redirect to Manage Admin PAge
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-clients.php');
        }
    }
    
    
    ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td><label>First Name: </label></td>
                    <td>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Last Name: </label></td>
                    <td>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Username: </label></td>
                    <td>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>E-mail: </label></td>
                    <td>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Client" class="update-button">
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
        $id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];

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
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-clients.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Client.</div>";
            //Redirect to Manage Admin Page
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-clients.php');
        }
    }

?>

</body>
</html>