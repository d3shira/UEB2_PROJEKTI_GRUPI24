<?php require_once("database.php")?>;
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
<section class="order" id="order">

<h3 class="sub-heading" style="font-size: 2rem; color:green" > Order Now</h3>
<h1 class="heading" style="font-size: 2.8rem; color:#192a56"> FREE AND FAST</h1>
<?php 
//CHeck whether food id is set or not
if(isset($_GET['diet_id']))
{
    //Get the Food id and details of the selected food
    $diet_id = $_GET['diet_id'];

    //Get the Details of the Selected Food
    $sql = "SELECT * FROM tbl_diet WHERE id=$diet_id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //Count the rows
    $count = mysqli_num_rows($res);
    //CHeck whether the data is available or not
    if($count==1)
    {
        //WE Have Data
        //Get the Data from Database
        $row = mysqli_fetch_assoc($res);

        $diet_name = $row['diet_name'];
        $price = $row['price'];
        $in_stock = $row['in_stock'];

        $food_found = true; // Set the flag to true since food details are found
    }
    else
    {
        $food_found = false; // Set the flag to false since food details are not found
    }
}
else
{
    $food_found = false; // Set the flag to false since food id is not set
}
?>

<!-- Rest of your HTML code -->

<?php 
if ($food_found) {
    // Display the form for ordering the food
    ?>
    <section class="food-search">
        <div class="container">
            <!-- Your form code here -->
        </div>
    </section>
    <?php
} else {
    // Display a message or perform any other action
    echo "Food not available.";
}
?>

<form action="" method="POST" class="orderForm">
    <fieldset>
    <div class="inputBox">
        <div class="input">
            <span>Your name</span>
            <input type="text" placeholder="Enter your id" name="user_id">
        </div>
        <div class="input">
            <span>Your number</span>
            <input type="number" placeholder="Enter your number" name="contact">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>Your order</span>
            <input type="text" placeholder="Enter food name" name="order_id">
        </div>
        <div class="input">
            <span>Additional food</span>
            <input type="test" placeholder="Extra with food" name="additional_food">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>How much</span>
            <input type="number" placeholder="How many orders" name="quantity">
        </div>
        <div class="input">
            <span>Date and time</span>
            <input type="datetime-local">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>Your address</span>
        <textarea name="" placeholder="Enter your address" id="" cols="30" rows="10" name="address"></textarea>
        </div>
        <div class="input">
            <span>Additional request</span>
        <textarea name="" placeholder="Enter you message" id="" cols="30" rows="10" name="name"></textarea>
        </div>
        <div class="input">
    <span>Diet ID</span>
    <input type="text" placeholder="Enter diet ID" name="diet_id">
</div>
    </div>

<<<<<<< Updated upstream
    <input type="submit" value="Order now" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">
=======
    <input type="submit" value="Order now" class="btn" name="submit">
</fieldset>
>>>>>>> Stashed changes
</form>

<?php
   if(isset($_POST['Order now'])) //sdi a duhet order a submit
   {
    $diet_id = isset($_POST['diet_id']) ? $_POST['diet_id'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$contact = isset($_POST['contact']) ? $_POST['contact'] : '';
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
$total_price = isset($_POST['total_price']) ? $_POST['total_price'] : '';
    $order_date=date("Y-m-d h:i:sa");//order date
    $status="Orderd";//orderd,on delivery,delivered,cancelled 

    //Save the order in database
    $sql2 ="INSERT INTO tbl_order SET 
    diet_id='$diet_id',
    user_id='$user_id',
    address='$address',
    contact='$contact',
    quantity='$quantity',
    total_price='$total_price',
    order_date='$order_date',
    status='$status'
    ";

    echo $sql2; die();
    //Execute the query
    $res2 = mysqli_query($conn, $sql2);

    if ($res2) {
        $_SESSION['order'] = "<div class='success'> Porosia u ruajt me sukses.</div>";
        header('location:'.SITEURL);
        exit;
    } else {
        $_SESSION['order'] = "<div class='error'> Dështoi ruajtja e porosisë.</div>";
        header('location:'.SITEURL);
        exit;
    }
}
    ?>


</section>
</body>
</html>