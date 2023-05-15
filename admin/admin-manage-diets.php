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
    <link rel="stylesheet" href="manage-staff.css">

  

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
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
<body>
<?php
define('SITEURL', 'http://localhost/UEB2_PROJEKTI/');
?>

    <!-- Button to Add Admin-->
    
 
     <!-- CONTENT SECTION -->
     <div class="tbl-content">

     <a href="<?php echo SITEURL; ?>admin/admin-add-diet.php" class="update-button">Add Diet</a>
      <br><br>
      <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

<br /><br /><br />

<?php 
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }

    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    if(isset($_SESSION['unauthorize']))
    {
        echo $_SESSION['unauthorize'];
        unset($_SESSION['unauthorize']);
    }

    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }

?>
    <table class="tbl-full">
        <tr>
            <th>ID</th>
            <th>Diet Name</th>
            <th>Price</th>
            <th>In Stock</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Diet</a>
                <a class="delete-button" href="#">Delete Diet</a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Diet</a>
                <a class="delete-button" href="#">Delete Diet</a>
            </td>
        </tr>
        <tr>
            <td>1</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>
                <a class="update-button" href="#">Update Diet</a>
                <a class="delete-button" href="#">Delete Diet</a>
            </td>
        </tr>
        <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM tbl_diet";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $diet_id = $row['id'];
                                $diet_name = $row['title'];
                                $price = $row['price'];
                                $in_stock = $row['in_stock'];
                                $image_path = $row['image_path'];
                                $description = $row['description'];
                            
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td>$<?php echo $price; ?></td>
                                   
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $image_path; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
                        }

                    ?>

    </table>
    
    </div>
   
</body>
</html>