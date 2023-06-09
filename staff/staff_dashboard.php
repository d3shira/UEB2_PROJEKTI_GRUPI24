<?php
require_once "../database.php";

session_start(); 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

 if(isset($_SESSION['update']))
 {
    echo $_SESSION['update'];
     unset($_SESSION['update']);
 }

 $id=$_SESSION["user_id"];

 $sql = "SELECT tbl_users.*, tbl_staff_profiles.* FROM tbl_users 
        INNER JOIN tbl_staff_profiles 
        ON tbl_users.user_id = tbl_staff_profiles.user_id
        WHERE tbl_users.user_id = $id";

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
         $profession = $row["profession"];
     }
     else
     {

         if ($_SERVER['PHP_SELF'] != '/UEB2_PROJEKTI/staff/staff_dashboard.php') {
             header('location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php');
             exit;
         }
     }
 }
?>

<?php 
@include 'staff-navbar.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Staff!!</title>
    <link rel = "stylesheet" href="staff.css">
  

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
    <br><br><br><br><br><br><br><br>
    <h1 class="my-5">Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!!</h1>
    <table>
		<thead>
        <tr>
	        <td>First Name</td>
	        <td><?php echo $first_name; ?></td>
            <td></td>
            <td></td>
            <td>edit</td>
        </tr>
        <tr>
	        <td>Last Name</td>
	        <td><?php echo $last_name; ?></td>
            <td></td>
            <td></td>
            <td><a>edit</a></td>
        </tr>
        <tr>
	        <td>Username</td>
	        <td><?php echo $username; ?></td>
            <td></td>
            <td></td>
            <td><a>edit</a></td>
        </tr>
        <tr>
	        <td>Email</td>
	        <td><?php echo $email; ?></td>
            <td></td>
            <td></td>
            <td><a>edit</a></td>
        </tr>
        <tr>
	        <td>Profession</td>
	        <td><?php echo $profession; ?></td>
            <td></td>
            <td></td>
            <td><a>edit</a></td>
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
    <p>
        <br><br><br>
        <a class="add-button" href="edit-profile.php?user_id=<?php echo $id; ?>">Edit Your Profile</a>
        <a href="../reset-password.php" class="add-button">Reset Your Password</a>
        <a href="../logout.php" class="delete-button">Sign Out of Your Account</a>
    </p>
    <br><br><br><br>
        <h1>Dashboard statistics</h1>
        <br>
        <?php
    
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

</body>
</html>