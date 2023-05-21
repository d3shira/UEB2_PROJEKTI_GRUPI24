<?php require_once "../database.php"; ?>

<?php   


session_start(); 


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='staff'){
    header("location: ../login.php");
    exit;
}     
                if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients</title>
   

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="../admin/navbar-admin.css">
    <link rel="stylesheet" href="../admin/manage-order.css">



 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<body>

   
   <?php @include 'staff-navbar.php'?>
    <div class="wrapper">
        <h3 style="text-align: left; margin:90px; font-size: 25px; color:#192a56;">Manage Orders</h3>
    </div>


 
    <br><br>
    <div class="tbl-container">
    <div class="tbl-content">
        <table class="tbl-full">
            <tr>
                <th>Nr</th>
                <th>Order_id</th>
                <th>Diet_id</th>
                <th>User_id</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Quantity</th>
                <th>Total_price</th>
                <th>Order_date</th>
                <th>Status</th>
            </tr>
            
           <?php 
            $sql = "SELECT * FROM tbl_orders";
        

         
            $res = mysqli_query($conn, $sql);

           
            if($res==TRUE){
             
                $count = mysqli_num_rows($res);
                $sn = 1;

               
                if($count>0){
                
                    while($rows = mysqli_fetch_assoc($res)){
                

                        $order_id = $rows['order_id'];
                        $diet_id = $rows['diet_id'];
                        $user_id = $rows['user_id'];
                        $address = $rows['address'];
                        $contact = $rows['contact'];
                        $quantity = $rows['quantity'];
                        $total_price = $rows['total_price'];
                        $order_date = $rows['order_date'];
                        $status = $rows['status'];

                     
                        ?>
                       
                        <tr>
                            <td><?php echo $sn++; ?></td> 
                            <td><?php echo $order_id; ?></td> 
                            <td><?php echo $diet_id; ?></td> 
                            <td><?php echo $user_id; ?></td>                             
                            <td><?php echo $address; ?></td>
                            <td><?php echo $contact; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $total_price; ?></td>
                            <td><?php echo $order_date; ?></td>
                          
                            <td>
                                <?php
                                if($status=="Ordered")
                                {
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="On Delivery")
                                {
                                    echo "<label style='color: purple;'>$status</label>";
                                }
                                elseif($status=="Delivered")
                                {
                                    echo "<label style='color: green;'>$status</label>";
                                }
                                elseif($status=="Cancelled")
                                {
                                    echo "<label style='color: red;'>$status</label>";
                                }
                                ?>
                            </td>
                            <td>
                            <a class="update-button" href="<?php echo 'http://localhost/UEB2_PROJEKTI/staff/update-order.php?order_id=' .$order_id; ?>">Update Order</a>
                            </td>
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