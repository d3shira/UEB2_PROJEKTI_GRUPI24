<?php require_once "../database.php"; ?>
<?php 
session_start();
$id = $_GET['user_id'];

$sql = "DELETE FROM tbl_users WHERE user_id = $id";   

$res = mysqli_query($conn, $sql);

 if($res==true)
 {
     $_SESSION['delete'] = "<div class='success'>Client Deleted Successfully.</div>";

     header('location: delete-client-success.php');
    }

 else
 {
 

     $_SESSION['delete'] = "<div class='error'>Failed to Delete Client. Try Again Later.</div>";
     header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-clients.php');
 }




?>