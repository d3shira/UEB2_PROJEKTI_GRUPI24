<?php
require_once "../database.php";

// Initialize the session
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    <title>Update Diet</title>
     <!--font awesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../admin/admin-add-diet.css">
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="../admin/navbar-admin.css">
    <link rel="stylesheet" href="../admin/manage-staff.css">

  

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<body>
<?php @include "navbar-admin.php"?>
<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['diet_id']))
    {
        //Get all the details
        $diet_id = $_GET['diet_id'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM tbl_diet WHERE diet_id=$diet_id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Food
        $diet_name= $row2['diet_name'];
        $description = $row2['description'];
        $price = $row2['price'];
        $in_stock = $row2['in_stock'];
        $image_path = $row2['image_path'];

    }
    else
    {
        //Redirect to Manage Food
        header('location:http://localhost/UEB2_PROJEKTI_GRUPI24/staff/staff-manage-diets.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Diet</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Diet name: </td>
                <td>
                    <input type="text" name="diet_name" value="<?php echo $diet_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                    <td>Image Path: </td>
                    <td>
                        <textarea name="image_path" cols="30" rows="5" placeholder="The image path."></textarea>
                    </td>
                </tr>

            <tr>
                <td>In stock: </td>
                <td>
                    <input <?php if($in_stock=="Yes") {echo "checked";} ?> type="radio" name="in_stock" value="Yes"> Yes 
                    <input <?php if($in_stock=="No") {echo "checked";} ?> type="radio" name="in_stock" value="No"> No 
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="diet_id" value="<?php echo $diet_id; ?>">
                    
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $diet_id = $_POST['diet_id'];
                $diet_name = $_POST['diet_name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $image_path = $_POST['image_path'];
           

          
                $in_stock = $_POST['in_stock'];

        

                

                //4. Update the Food in Database
                $sql3 = "UPDATE tbl_diet SET 
                    diet_id = '$diet_id',
                    description = '$description',
                    price = $price,
                    image_path = '$image_path',
                    in_stock = '$in_stock'
                    WHERE diet_id=$diet_id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:update-diet-success.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:staff-manage-diets.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>