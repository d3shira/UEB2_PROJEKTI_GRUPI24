<?php
require_once "../database.php";

// Initialize the session
session_start(); 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='staff'){
    header("location: ../login.php");
    exit;
}
?>

<?php 
    

    //echo "Delete Food Page";

    if(isset($_GET['diet_id'])) //Either use '&&' or 'AND'
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID and Image NAme
        $diet_id = $_GET['diet_id'];
       

        //3. Delete Food from Database
        $sql = "DELETE FROM tbl_diet WHERE diet_id=$diet_id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //4. Redirect to Manage Food with Session Message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Diet Deleted Successfully.</div>";
            header('location:update-diet-success.php');
       
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Diet.</div>";
            header('location: staff-manage-diets.php');
        }

        

    }
    else
    {
        //Redirect to Manage Food Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location: staff-manage-diets.php');
    }

?>