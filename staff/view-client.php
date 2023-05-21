<?php require_once "../database.php"; 


session_start(); 


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='admin'){
    header("location: ../login.php");
    exit;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clients</title>
   

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="staff-navbar.css">
    <link rel="stylesheet" href="staff.css">
    <link rel="stylesheet" href="../admin/manage-staff.css">

    
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<?php @include 'staff-navbar.php'?>
<body>
<div>
    <div class="wrapper">
        <h3 style="text-align: left; margin:90px; font-size: 25px; color:#192a56;">View Clients</h3>
    </div>


    <br><br><br><br>
    <div class="tbl-container">
    <div class="tbl-content">
        <table class="tbl-full">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Weight (kg)</th>
                <th>Date created</th>
            </tr>

           <?php 
           
            $sql = "SELECT u.user_id, u.first_name, u.last_name, u.username, u.email,  cp.weight, u.date_time
            FROM tbl_users u
            INNER JOIN tbl_client_profiles cp ON u.user_id = cp.user_id";

         
            $res = mysqli_query($conn, $sql);

           
            if($res==TRUE){
               
                $count = mysqli_num_rows($res);
                $sn = 1;

                if($count>0){
                 
                    while($rows = mysqli_fetch_assoc($res)){
                     

                        $id = $rows['user_id'];
                        $first_name = $rows['first_name'];
                        $last_name = $rows['last_name'];
                        $username = $rows['username'];
                        $email = $rows['email'];
                        $weight = $rows['weight'];
                        $date_time = $rows['date_time'];

                    
                        ?>
                    
                        <tr>
                            <td><?php echo $sn++; ?></td> 
                            <td><?php echo $id?></td>
                            <td><?php echo $first_name; ?></td>
                            <td><?php echo $last_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $weight; ?></td>
                            <td><?php echo $date_time; ?></td>
                        </tr>
                        <?php



                }
            }
            else{
               
            }
        }



        ?>
    </table>
    
    </div>
    </div>

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