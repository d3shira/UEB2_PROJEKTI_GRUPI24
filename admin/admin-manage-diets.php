<?php
require_once "../database.php";

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='admin'){
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
    <link rel="stylesheet" href="admin-add-diet.css">
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel="stylesheet" href="manage-staff.css">

   <style>
    .tbl-full {
        font-size: 15px;
    }
  
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
<?php @include "navbar-admin.php"?>
<body>
<?php
define('SITEURL', 'http://localhost/UEB2_PROJEKTI/');
?>
<div class="main-content"> 
    
     <div class="tbl-content">

     <a href="admin-add-diet.php" class="update-button" >Add Diet</a>
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
  <table class="tbl-full">
        <tr>
            <th>ID</th>
            <th>Diet Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php 
                        $sql = "SELECT * FROM tbl_diet";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $sn=1;

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                              
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

                                   <a class="btn-secondary" href="update-diet.php?diet_id=<?php echo $diet_id; ?>">Update Diet</a>
                                   <a class="btn-danger" href="delete-diet.php?diet_id=<?php echo $diet_id; ?>">Delete Diet</a>
                                       
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                          
                            echo "<tr> <td colspan='7' class='error'> Diet not Added Yet. </td> </tr>";
                        }

                    ?> 

    </table>
    
    </div>
    </div>
</body>
</html>