<?php
require_once "../database.php";


session_start(); 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='staff'){
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
          
            $_SESSION['delete'] = "<div class='success'>Diet Deleted Successfully.</div>";
            header('location:staff-manage-diets.php');
       
        }
        else
        {
       
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Diet.</div>";
            header('location: staff-manage-diets.php');
        }

        

    }
    else
    {
     
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location: staff-manage-diets.php');
    }

?>