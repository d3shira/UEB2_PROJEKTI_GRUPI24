
<?php
require_once "../database.php";

// Define the SQL query
$sql2 = "INSERT INTO tbl_diet (diet_name, description, price, in_stock, image_path) VALUES (?, ?, ?, ?, ?)";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Process the form data
    $diet_name = $_POST['diet_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $in_stock = isset($_POST['in_stock']) ? $_POST['in_stock'] : "No";
    $image_path = $_POST['image_path'];

    // Check if any required fields are empty
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

    // If there are any errors, display them and stop execution
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        exit();
    }

    // Create a variable $stmt and assign the result of the prepared statement execution
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("sssss", $diet_name, $description, $price, $in_stock, $image_path);
    $result = $stmt->execute();

    // Redirect after processing the form
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Diet</title>
     <!--font awesome-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="admin-add-diet.css">
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel="stylesheet" href="manage-staff.css">

  

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <style>
        /* CSS for .main-content */
.main-content {
  padding: 100px;
}

/* CSS for .wrapper */
.wrapper {
  max-width: 500px;
  margin: 0 auto;
  background-color: #f1f1f1;
  padding: 20px;
}

/* CSS for .wrapper h1 */
.wrapper h1 {
  text-align: center;
  margin-bottom: 20px;
}

/* CSS for .wrapper table */
.wrapper table {
  width: 100%;
  font-size: 18px;
}

/* CSS for .wrapper table td */
.wrapper table td {
  padding: 10px;
}

/* CSS for .wrapper input[type="text"], .wrapper input[type="number"], .wrapper textarea */
.wrapper input[type="text"],
.wrapper input[type="number"],
.wrapper textarea {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
}

/* CSS for .wrapper input[type="submit"] */
.wrapper input[type="submit"] {
  display: block;
  margin: 0 auto;
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}

/* CSS for .wrapper input[type="submit"]:hover */
.wrapper input[type="submit"]:hover {
  background-color: #45a049;
}

/* CSS for .wrapper .success, .wrapper .error */
.wrapper .success,
.wrapper .error {
  margin-top: 10px;
  padding: 10px;
}

/* CSS for .wrapper .success */
.wrapper .success {
  background-color: #d4edda;
  color: #155724;
}

/* CSS for .wrapper .error */
.wrapper .error {
  background-color: #f8d7da;
  color: #721c24;
}
    </style>
</head>
<body>
<!--HEADER SECTION-->
    <!--me nderru disa icons dhe menu-->
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
        <a href="admin-manage-questions.php">Manage Questions</a>
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="admin dashboard.php" class="fa-solid fa-user"></a>
    </div>
</header>
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
        header('location:http://localhost/UEB2_PROJEKTI_GRUPI24/admin/admin-manage-diets.php');
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
                    <input type="decimal" name="price" value="<?php echo $price; ?>">
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
            
                
            }
        
        ?>

    </div>
</div>

<?php include('../footer.php'); ?>
</body>
</html>