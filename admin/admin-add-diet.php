<?php require_once "../database.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diets</title>
    <link rel="stylesheet" href="admin-add-diet.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>
<body>
<?php @include "navbar-admin.php"?>
<?php
define('SITEURL', 'http://localhost/UEB2_PROJEKTI_GRUPI24/');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Diet  </h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Diet Name: </td>
                    <td>
                        <input type="text" name="diet_name" placeholder="Name of the Diet">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Diet."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
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
                        <input type="radio" name="in_stock" value="Yes"> Yes 
                        <input type="radio" name="in_stock" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 
            
            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $diet_name = $_POST['diet_name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
   

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['in_stock']))
                {
                    $in_stock = $_POST['in_stock'];
                }
                else
                {
                    $in_stock = "No"; //SEtting the Default Value
                }
                 
                $image_path = $_POST['image_path'];
             

                
                //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
              
                $sql2 = "INSERT INTO tbl_diet (diet_name, description, price, in_stock, image_path) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql2);
                $stmt->bind_param("sssss", $diet_name , $description,$price, $in_stock, $image_path);
                $stmt->execute();
              
                //Execute the Query
               

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
             //   if($stmt == true)
             //   {
                    //Data inserted Successfullly
               //     $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                 //   header('location: http://localhost/UEB2_PROJEKTI_GRUPI24/admin/admin-manage-diets.php');
                   
               // }
               // else
               // {
                    //FAiled to Insert Data
                 //   $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
               
                   // header('location: http://localhost/UEB2_PROJEKTI_GRUPI24/admin/admin-manage-diets.php');

               // }

                
            }
         

        ?>


    </div>
</div>

</body>
</html>