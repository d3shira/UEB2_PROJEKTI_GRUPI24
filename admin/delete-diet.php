
<?php
require_once "../database.php";


session_start(); 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='admin'){
    header("location: ../login.php");
    exit;
}
?>

<?php 


    if(isset($_GET['diet_id']))
    {
    
        $diet_id = $_GET['diet_id'];
       

        $sql = "DELETE FROM tbl_diet WHERE diet_id=$diet_id";

        $res = mysqli_query($conn, $sql);

    
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Diet Deleted Successfully.</div>";
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-diets.php');
       
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Diet.</div>";
            header('location:http://localhost/UEB2_PROJEKTI/admin/admin-manage-diets.php');
        }

        

    }
    else
    {
        //Redirect to Manage Food Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:http://localhost/UEB2_PROJEKTI_GRUPI24/admin/admin-manage-diets.php');
    }

?>