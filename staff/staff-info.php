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

 $id=$_SESSION["user_id"];

 $sql = "SELECT tbl_users.*, tbl_staff_profiles.* FROM tbl_users 
         INNER JOIN tbl_staff_profiles 
         ON tbl_users.user_id = tbl_staff_profiles.user_id";

 $res=mysqli_query($conn, $sql);

 if($res==true)
 {
     $count = mysqli_num_rows($res);

     if($count==1)
     {
         
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

         if ($_SERVER['PHP_SELF'] != '/UEB2_PROJEKTI/staff/staff_dashboard.php') {
             header('location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php');
             exit;
         }
     }
 }

?>
