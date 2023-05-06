<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="index.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Document</title>
</head>
<body>
<?php @include 'navbar.php' ?>
<section class="order" id="order">

<h3 class="sub-heading">order now</h3>
<h1 class="heading">free and fast</h1>

<form action="">
    <div class="inputBox">
        <div class="input">
            <span>your name</span>
            <input type="text" placeholder="enter your name">
        </div>
        <div class="input">
            <span>your number</span>
            <input type="number" placeholder="enter your number">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>your order</span>
            <input type="text" placeholder="enter food name">
        </div>
        <div class="input">
            <span>additional food</span>
            <input type="test" placeholder="extra with food">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>How much</span>
            <input type="number" placeholder="how many orders">
        </div>
        <div class="input">
            <span>date and time</span>
            <input type="datetime-local">
        </div>
    </div>
    <div class="inputBox">
        <div class="input">
            <span>your address</span>
        <textarea name="" placeholder="enter your address" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="input">
            <span>your message</span>
        <textarea name="" placeholder="enter you message" id="" cols="30" rows="10"></textarea>
        </div>
    </div>

    <input type="submit" value="order now" class="btn">
</form>

</section>
</body>
</html>