<?php require_once "../database.php"; ?>
<?php 
session_start();
//1. Get the value of the id that will be deleted
$id = $_GET['user_id'];

//2.Create SQL query to delete staff member
$sql = "DELETE FROM tbl_users WHERE user_id = $id";    //a prej users a staff?
//execute query
$res = mysqli_query($conn, $sql);
 // Check whether the query executed successfully or not
 if($res==true)
 {
     //Query Executed Successully and Staff Deleted
     //echo "Staff Deleted";
     //Create SEssion Variable to Display Message
     $_SESSION['delete'] = "<div class='success'>Client Deleted Successfully.</div>";
     //Redirect to Manage Staff Page
     header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-clients.php');
    }

 else
 {
     //Failed to Delete Staff
     //echo "Failed to Delete Staff";

     $_SESSION['delete'] = "<div class='error'>Failed to Delete Client. Try Again Later.</div>";
     header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-clients.php');
 }



//3.Redirect to manage staff page with message (succes/error)


?>