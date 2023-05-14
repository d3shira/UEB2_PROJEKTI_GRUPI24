<?php 
require_once "../database.php";
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
         ON tbl_users.user_id = tbl_staff_profiles.user_id";

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

         $user_id = $row["user_id"];
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
