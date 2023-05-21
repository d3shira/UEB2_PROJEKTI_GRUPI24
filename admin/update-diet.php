<?php
require_once "../database.php";

// Check if the form is submitted and diet_id is set
if (isset($_POST['submit'], $_GET['diet_id'])) {
    // Process the form data
    $diet_id = $_GET['diet_id'];
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

    // Update the diet in the database
    $sql3 = "UPDATE tbl_diet SET 
        diet_name = ?,
        description = ?,
        price = ?,
        in_stock = ?,
        image_path = ?
        WHERE diet_id = ?";
    $stmt = $conn->prepare($sql3);
    $stmt->bind_param("sssssi", $diet_name, $description, $price, $in_stock, $image_path, $diet_id);
    $result = $stmt->execute();

    // Redirect after processing the form
    if ($result) {
        header("Location: diet-success.php");
        exit();
    } else {
        echo "Failed to update the diet";
        exit();
    }
}

// Check if the diet_id is set
if (isset($_GET['diet_id'])) {
    $diet_id = $_GET['diet_id'];

    // SQL Query to Get the Selected Diet
    $sql2 = "SELECT * FROM tbl_diet WHERE diet_id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $diet_id);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the diet details
        $row = $result->fetch_assoc();
        $diet_name = $row['diet_name'];
        $description = $row['description'];
        $price = $row['price'];
        $in_stock = $row['in_stock'];
        $image_path = $row['image_path'];
    } else {
        // Redirect if diet not found
        header('Location: admin-manage-diets.php');
        exit();
    }
} else {
    // Redirect if diet_id is not set
    header('Location: admin-manage-diets.php');
    exit();
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
    <!-- Scripts -->
    <script src="../navbar.js"></script> 
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
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Diet</h1>
            <br><br>

            <form action="<?php echo $_SERVER['PHP_SELF'] . '?diet_id=' . $diet_id; ?>" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Diet Name: </td>
                        <td><input type="text" name="diet_name" value="<?php echo $diet_name; ?>"></td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td><input type="decimal" name="price" value="<?php echo $price; ?>"></td>
                    </tr>

                    <tr>
                        <td>Image Path: </td>
                        <td><input type="text" name="image_path" value="<?php echo $image_path; ?>"></td>
                    </tr>

                    <tr>
                        <td>In stock: </td>
                        <td>
                            <input type="radio" name="in_stock" value="Yes" <?php if ($in_stock == "Yes") echo 'checked'; ?>> Yes 
                            <input type="radio" name="in_stock" value="No" <?php if ($in_stock == "No") echo 'checked'; ?>> No 
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="diet_id" value="<?php echo $diet_id; ?>">
                            <input type="submit" name="submit" value="Update Diet" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
   
</body>
</html>
