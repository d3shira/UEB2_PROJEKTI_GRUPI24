<?php require_once("database.php"); session_start();?>;

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="order.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Order</title>
</head>
<body>
<?php define('SITEURL', 'http://localhost/UEB2_PROJEKTI/'); ?>
<?php @include 'navbar.php' ?>
<br> <br>
<br>
<br> <br>
<br>
<section class="order1" id="order1">

<h3 class="sub-heading" style="font-size: 2rem; color:green" > Order Now</h3>
<h1 class="heading" style="font-size: 2.8rem; color:#192a56"> FREE AND FAST</h1>
<?php 

if(isset($_GET['diet_id']))
{
    $diet_id = $_GET['diet_id'];

    $sql = "SELECT * FROM tbl_diet WHERE diet_id='{$diet_id}'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count==1)
    {
        $row = mysqli_fetch_assoc($res);

        $diet_name = $row['diet_name'];
        $price = $row['price'];
        $in_stock = $row['in_stock'];

        $food_found = true; 
    }
    else
    {
        $food_found = false; 
    }
}
else
{
    $food_found = false; 
}
?>


<?php 
if ($food_found) {
   
    ?>
    <section class="food-search">
        <div class="container">
           
        </div>
    </section>
    <?php
} else {
   
    echo "Food not available.";
}
?>
<form action="" method="POST" class="order">
    <div class="order-label1">
<div class="order-label"><b>Full Name</b></div>
<input type="text" name="full-name" placeholder="E.g. Dafina Thapa" class="input-responsive" required>

<div class="order-label"><b>Phone Number</b></div>
<input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

<div class="order-label"><b>Email</b></div>
<input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

<div class="order-label"><b>Quantity</b></div>
<input name="quantity" placeholder="1,2,3..." class="input-responsive" required>

<div class="order-label"><b>Address</b></div>
<textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>



<input type="submit" name="Order" value="Order now" class="btn btn-primary"  onmouseover="this.style.backgroundColor='#27ae60';"
           onmouseout="this.style.backgroundColor='#192a56';">
</fieldset>
</div>

</form>

<?php
require_once("database.php");

if(isset($_POST['Order']))
{
    $diet_id = $_GET['diet_id'];
    $quantity = $_POST['quantity'];

    $sql = "SELECT * FROM tbl_diet WHERE diet_id = '{$diet_id}'";
    

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    
    if($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $user_id=$_SESSION["user_id"]; 
        $diet_name = $row['diet_name'];
        $price = $row['price'];
        $in_stock = $row['in_stock'];
        $total_price = $price * $quantity;
        
        $first_name = $_POST['full-name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        // Përpilojeni për të marrë user_id të klientit
        $status = "Ordered";
        $order_date = date("Y-m-d h:i:sa");
        
        $sql2 = "INSERT INTO tbl_orders (diet_id, user_id, address, contact, quantity, total_price, order_date, status) 
                 VALUES ('{$diet_id}', '{$user_id}', '{$address}', '{$contact}', '{$quantity}', '{$total_price}', '{$order_date}', '{$status}')";
          $res2 = mysqli_query($conn, $sql2);

          if($res2==true)
          {
              $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
          }
          else
          {
              $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
              header('location: http://localhost/UEB2_PROJEKTI/order.php?diet_id=41');
          }

      }
  
    }
?>

</body>
</html>