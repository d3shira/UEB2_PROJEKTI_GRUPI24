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
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <!--<link rel="stylesheet" href="admin/navbar-admin.css">-->
    <link rel="stylesheet" href="test.css">


    <!--<script src="home.js"></script>--> 
    <script src="navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
 

</head>
<body>
    

    <!--HEADER SECTION-->
    <!--me nderru disa icons dhe menu-->
    <header style="text-decoration:none;">
    <a href="staff_dashboard.php" class="logo"><i class="fas fa-utensils"></i>FitYou - Staff Dashboard</a>
    <nav class="navbar">
        <div class="dropdown">
            <a class="dropbtn">Staff</a>
            <div class="dropdown-content">
                <a href="view-client.php">Clients</a>
                <a href="#">Diets</a>
                <a href="#">Orders</a>
                <a href="staff-manage-questions.php">Questions</a>
            </div>
        </div>
        <a class="" href="../home.php">Home</a>
        <a class="" href="../aboutus.php">About Us</a>
        <a class="" href="../menu.php">Diets</a>
        <a class="" href="../blerta.php">Review</a>
        <!-- <a class="" href="order.php">Order</a> -->
        <a class="" href="../faqs.php">FAQs</a> 
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="staff_dashboard.php" class="fa-solid fa-user"></a>
    </div>
</header>

<section>
<!--Search bar-->
<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form>
    </section>

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
