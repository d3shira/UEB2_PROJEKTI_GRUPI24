<?php require_once "../database.php";


session_start(); 


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='admin'){
    header("location: ../login.php");
    exit;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <title>Document</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel="stylesheet" href="admin-manage-orders.php">
    <link rel="stylesheet" href="manage-staff.css">
    <link rel="stylesheet" href="manage-order.css">
    <link rel="stylesheet" href="register-staff.css">

 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<body>


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
<br><br><br>
<div class="wrapper">
    <div class="form-group">
    <h3 style="text-align: left; margin:45px; font-size: 25px; color:#192a56;">Update Order</h3>

    <?php 

    $id=$_GET['order_id'];


    $sql="SELECT * FROM tbl_orders WHERE order_id='$id'";


    $res=mysqli_query($conn, $sql);


    if($res==true)
    {
        
        $count = mysqli_num_rows($res);
 
        if($count==1)
        {
    
            $row=mysqli_fetch_assoc($res);

            $address= $row['address'];
            $contact = $row['contact'];
            $quantity = $row['quantity'];
            $status=$row['status'];
        }
        else
        {
     
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
                    <td><label>Status: </label></td>
                    <td>
                    <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?>value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?>value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?>value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                        </select>
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

    if(isset($_POST['submit']))
    {
        $id = $_POST['order_id'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];


        $sql = "UPDATE tbl_orders
        SET address = '$address',
            contact = '$contact',
            quantity = '$quantity',
            status='$status'
        WHERE order_id = '$id'";


        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update'] = "<div class='success'>Client Updated Successfully.</div>";
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-orders.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to Delete Client.</div>";
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-orders.php');
        }
    }

?>

</body>
</html>