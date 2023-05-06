<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Lifestyle Website</title>
    

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="home.css">

    <script src="home.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    

</head>
<body>
    

    <!--HEADER SECTION-->
    <!--me nderru disa icons dhe menu-->
<header>
    <a href="#" class="logo"><i class="fas fa-utensils"></i>FitYou</a>
<nav class="navbar">
  <a href="/home.php" onclick="toggleActiveClass(event, this)">Home</a>
  <a href="/aboutus.php" onclick="toggleActiveClass(event, this)">About Us</a>
  <a href="/menu.php" onclick="toggleActiveClass(event, this)">Diets</a>
  <a href="review.php" onclick="toggleActiveClass(event, this)">Review</a>
  <a href="order.php" onclick="toggleActiveClass(event, this)">Order</a>
  <a href="faq.php" onclick="toggleActiveClass(event, this)">FAQs</a>
</nav>

    
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
        <a href="#" class="fas fa-heart"></a>
        <a href="#" class="fas fa-shopping-cart"></a>
        <a href="#" class="fa-solid fa-user"></a>
        
    </div>
</header>
<!--Search bar-->
<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form>
    </section>

</body>
<script>
function toggleActiveClass(event, element) {
  event.preventDefault(); // prevent the default behavior of the link

  // remove the active class from all links
  var links = document.getElementsByClassName("active");
  for (var i = 0; i < links.length; i++) {
    links[i].classList.remove("active");
  }

  // add the active class to the clicked link
  element.classList.add("active");
}
</script>
</html>
