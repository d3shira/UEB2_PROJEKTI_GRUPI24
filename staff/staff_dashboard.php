<?php
require_once "../database.php";
// Initialize the session
session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

// if(isset($_SESSION['update']))
// {
//     echo $_SESSION['update'];
//     unset($_SESSION['update']);
// }

 //1. Get the ID of Selected Staff
 $id=$_SESSION["user_id"];

 //2. Create SQL Query to Get the Details
 $sql = "SELECT tbl_users.*, tbl_staff_profiles.* FROM tbl_users 
        INNER JOIN tbl_staff_profiles 
        ON tbl_users.user_id = tbl_staff_profiles.user_id
        WHERE tbl_users.user_id = $id";

 //Execute the Query
 $res=mysqli_query($conn, $sql);

 //Check whether the query is executed or not
 if($res==true)
 {
     // Check whether the data is available or not
     $count = mysqli_num_rows($res);
     //Check whether we have admin data or not
     if($count==1)
     {
         // Get the Details
         //echo "Staff Available";
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
         //Redirect to Manage Admin Page
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
  

    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
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
    <br><br><br>
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
</body>
</html>