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
<?php @include 'navbar.php' ?>
<section class="order" id="order">

<h3 class="sub-heading" style="font-size: 2rem; color:green" > Order Now</h3>
<h1 class="heading" style="font-size: 2.8rem; color:#192a56"> FREE AND FAST</h1>

<form action="">
    <div class="inputBox">
        <div class="input">
            <span>Your name</span>
            <input type="text" placeholder="Enter your name">
        </div>
        <div class="input">
            <span>Your number</span>
            <input type="number" placeholder="Enter your number">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>Your order</span>
            <input type="text" placeholder="Enter food name">
        </div>
        <div class="input">
            <span>Additional food</span>
            <input type="test" placeholder="Extra with food">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>How much</span>
            <input type="number" placeholder="How many orders">
        </div>
        <div class="input">
            <span>Date and time</span>
            <input type="datetime-local">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>Your address</span>
        <textarea name="" placeholder="Enter your address" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="input">
            <span>Additional request</span>
        <textarea name="" placeholder="Enter you message" id="" cols="30" rows="10"></textarea>
        </div>
    </div>

    <input type="submit" value="Order now" class="btn">
</form>

</section>
</body>
</html>