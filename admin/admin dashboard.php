<?php
require_once "../database.php";

session_start(); 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='admin'){
    header("location: ../login.php");
    exit;
}

if(isset($_SESSION['update']))
 {
     echo $_SESSION['update'];
     unset($_SESSION['update']);
 }

 $id=$_SESSION["user_id"];

 $sql = "SELECT * FROM tbl_users
        WHERE user_type = 'admin'";

 $res=mysqli_query($conn, $sql);

 if($res==true)
 {
     $count = mysqli_num_rows($res);
     if($count==1)
     {
         $row=mysqli_fetch_assoc($res);

         $id = $row["user_id"];
         $first_name = $row["first_name"];
         $last_name = $row["last_name"];
         $user_type = $row["user_type"];
         $username = $row["username"];
         $email = $row["email"];
     }
     else
     {
         if ($_SERVER['PHP_SELF'] != '/UEB2_PROJEKTI/admin/admin dashboard.php') {
             header('location:http://localhost/UEB2_PROJEKTI/login.php');
             exit;
         }
     }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="navbar-admin.css">
    <link rel = "stylesheet" href="manage-staff.css">
    <link rel="stylesheet" href="staff/staff.css">
    

    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <style>
        table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #4CAF50;
			color: white;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
        body{
            margin-left:5%;
            margin-right:10%;
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
        <a class="" href="admin-manage-questions.php">Manage Questions</a>
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="admin dashboard.php" class="fa-solid fa-user"></a>
    </div>
</header>
<br><br><br><br><br><br><br><br>

        <h1 class="my-5">Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!!</h1>
        <table>
		<thead>
        <tr>
	        <td>First Name</td>
	        <td><?php echo $first_name; ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
	        <td>Last Name</td>
	        <td><?php echo $last_name; ?></td>
            <td></td>
            <td></td>
            <td><a></a></td>
        </tr>
        <tr>
	        <td>Username</td>
	        <td><?php echo $username; ?></td>
            <td></td>
            <td></td>
            <td><a></a></td>
        </tr>
        <tr>
	        <td>Email</td>
	        <td><?php echo $email; ?></td>
            <td></td>
            <td></td>
            <td><a></a></td>
        </tr>
        <tr>
	        <td>User Type</td>
	        <td><?php echo $user_type; ?></td>
            <td></td>
            <td></td>
            <td></td>
    </tr>

		</tbody>
	</table>
    <br>
        <a href="../reset-password.php" class="add-button">Reset Your Password</a>
        <a href="../logout.php" class="delete-button">Sign Out of Your Account</a>

        <br><br><br><br>
        <h1>Dashboard statistics</h1>
        <br>
        <?php
        // get counts
        $client_count_sql = "SELECT COUNT(*) as count FROM tbl_client_profiles";
        $client_count_result = mysqli_query($conn, $client_count_sql);
        $client_count = mysqli_fetch_assoc($client_count_result)['count'];
        
        $staff_count_sql = "SELECT COUNT(*) as count FROM tbl_staff_profiles";
        $staff_count_result = mysqli_query($conn, $staff_count_sql);
        $staff_count = mysqli_fetch_assoc($staff_count_result)['count'];
        
        $order_count_sql = "SELECT COUNT(*) as count FROM tbl_orders";
        $order_count_result = mysqli_query($conn, $order_count_sql);
        $order_count = mysqli_fetch_assoc($order_count_result)['count'];
        
        $diet_count_sql = "SELECT COUNT(*) as count FROM tbl_diet";
        $diet_count_result = mysqli_query($conn, $diet_count_sql);
        $diet_count = mysqli_fetch_assoc($diet_count_result)['count'];
        
        echo "<h2>Client Count: $client_count</h2>";
        echo "<div style='background-color: #FEF36A; height: 30px; width: " . ($client_count * 10) . "px'></div>";
        
        echo "<h2>Staff Count: $staff_count</h2>";
        echo "<div style='background-color: #27ae60; height: 30px; width: " . ($staff_count * 10) . "px'></div>";
        
        echo "<h2>Diet Count: $diet_count</h2>";
        echo "<div style='background-color: #192a56; height: 30px; width: " . ($diet_count * 10) . "px'></div>";

        echo "<h2>Order Count: $order_count</h2>";
        echo "<div style='background-color: #666; height: 30px; width: " . ($order_count * 10) . "px'></div>";
        
        mysqli_close($conn);
        ?>

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

</body>
</html>

