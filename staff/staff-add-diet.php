<?php
require_once "../database.php";

session_start(); 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='staff'){
    header("location: ../login.php");
    exit;
}

$sql2 = "INSERT INTO tbl_diet (diet_name, description, price, in_stock, image_path) VALUES (?, ?, ?, ?, ?)";

if (isset($_POST['submit'])) {
  
    $diet_name = $_POST['diet_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $in_stock = isset($_POST['in_stock']) ? $_POST['in_stock'] : "No";
    $image_path = $_POST['image_path'];

 
    $errors = array();
    if (empty($diet_name)) {
        $errors[] = "Diet Name is required";
    }
    if (empty($description)) {
        $errors[] = "Description is required";
    }
    if (empty($price)) {
        $errors[] = "Price is required";
    }
    if (empty($image_path)) {
        $errors[] = "Image Path is required";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit();
    }

    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("sssss", $diet_name, $description, $price, $in_stock, $image_path);
    $result = $stmt->execute();

  
    if ($result == true) {
        header("Location: diet-success.php");
        exit();
    } else {
        echo "Failed to Insert Diet";
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<head>

</head>
<body>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diets</title>
    <link rel="stylesheet" href="admin-add-diet.css">
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="navbar-admin.css">
     <script src="../navbar.js"></script> 
    <style>

.main-content {
  padding: 100px;
}


.wrapper {
  max-width: 500px;
  margin: 0 auto;
  background-color: #f1f1f1;
  padding: 20px;
}


.wrapper h1 {
  text-align: center;
  margin-bottom: 20px;
}


.wrapper table {
  width: 100%;
  font-size: 18px;
}


.wrapper table td {
  padding: 10px;
}


.wrapper input[type="text"],
.wrapper input[type="number"],
.wrapper textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
}


.wrapper input[type="submit"] {
  display: block;
  margin: 0 auto;
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}


.wrapper input[type="submit"]:hover {
  background-color: #45a049;
}


.wrapper .success,
.wrapper .error {
  margin-top: 10px;
  padding: 10px;
}


.wrapper .success {
  background-color: #d4edda;
  color: #155724;
}


.wrapper .error {
  background-color: #f8d7da;
  color: #721c24;
}
    </style>
   
    
</head>
<body>
<?php @include 'staff-navbar.php' ?>


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
                        <input type="decimal" name="price">
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
                        <input type="submit" name="submit" value="Add Diet" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 
            
            if(isset($_POST['submit']))
            {   
                $diet_name = $_POST['diet_name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
   
                if(isset($_POST['in_stock']))
                {
                    $in_stock = $_POST['in_stock'];
                }
                else
                {
                    $in_stock = "No"; 
                }
                 
                $image_path = $_POST['image_path'];
             
              
                $sql2 = "INSERT INTO tbl_diet (diet_name, description, price, in_stock, image_path) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql2);
                $stmt->bind_param("sssss", $diet_name , $description,$price, $in_stock, $image_path);
                $stmt->execute();
              
    
           }

        ?>


    </div>
</div>

</body>
</html>