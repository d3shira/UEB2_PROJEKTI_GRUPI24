<?php
require_once "../database.php";

// Initialize the session
session_start(); 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='staff'){
    header("location: ../login.php");
    exit;
}
?>
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
    <link rel="stylesheet" href="../admin/admin-add-diet.css">
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="../admin/navbar-admin.css">
    <link rel="stylesheet" href="../admin/manage-staff.css">

   <style>
    .btn-secondary {
  display: inline-block;
  padding: 8px 16px;
  background-color: #4CAF50;
  color: #fff;
  text-align: center;
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.btn-danger {
  display: inline-block;
  padding: 8px 16px;
  background-color: #FF0000;
  color: #fff;
  text-align: center;
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.btn-secondary:hover,
.btn-danger:hover {
  background-color: #45a049;
}
   </style>

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<?php @include "staff-navbar.php"?>
<body>
<?php
define('SITEURL', 'http://localhost/UEB2_PROJEKTI_GRUPI24/');
?>
<div class="main-content"> 
    <!-- Button to Add Admin-->
    
 
     <!-- CONTENT SECTION -->
     <div class="tbl-content">

     <a href="admin-add-diet.php" class="update-button">Add Diet</a>
      <br><br>


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
<!--
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
        -->  <table class="tbl-full">
        <tr>
            <th>ID</th>
            <th>Diet Name</th>
            <th>Price</th>
         
            <th>Actions</th>
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
                                $diet_id = $row['diet_id'];
                                $diet_name = $row['diet_name'];
                                $price = $row['price'];
                                $in_stock = $row['in_stock'];
                                $image_path = $row['image_path'];
                                $description = $row['description'];
                            
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $diet_name; ?></td>
                                    <td>$<?php echo $price; ?></td>
                            
                                   <!-- <td><?php echo $description; ?></td> -->
                                  <!-- <td><?php echo $image_path; ?></td>--> 
                                   <td>

                                   <a class="btn-secondary" href="staff-update-diet.php?diet_id=<?php echo $diet_id; ?>">Update Diet</a>
                                   <a class="btn-danger" href="staff-delete-diet.php?diet_id=<?php echo $diet_id; ?>">Delete Diet</a>
                                       
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Diet not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
                        }

                    ?> 

    </table>
    
    </div>
    </div>
</body>
</html>