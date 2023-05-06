<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="home.js"></script> 
   
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
   
<body>
    <!--Home section-->
    <?php @include 'navbar.php' ?>
    <section class="home" id="home">

        <div class="swiper home-slider">
            <div class="swiper-wrapper wrapper">
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>spicy noodles</h3>
                        <p>lorem memsmammdmdfmdfmsdm?</p>
                        <a href="#" class="btn">order now</a>

                    </div>
                    <div class="image">
                        <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg" style="width:90%;height:auto;" alt="">
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>fried chicken</h3>
                        <p>lorem memsmammdmdfmdfmsdm?</p>
                        <a href="#" class="btn">order now</a>

                    </div>
                    <div class="image">
                        <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg" alt="">
                    </div>
                </div>
                <div class=" swiper-slide slide">
                    <div class="content">
                        <span>our special dish</span>
                        <h3>pizza</h3>
                        <p>lorem memsmammdmdfmdfmsdm?</p>
                        <a href="#" class="btn">order now</a>

                    </div>
                    <div class="image">
                        <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
             <div class="swiper-pagination"></div>
        </div>
    </section>
    <?php @include 'footer.php' ?>
    
    <!--skripta per swiper-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
   
  <!-- <script src="home.js"></script>--> 
    <script>
        var swiper = new Swiper(".home-slider", {
          spaceBetween: 30,
          centeredSlides: true,
          autoplay: {
            delay: 7500,
            disableOnInteraction: false,
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
        });
      </script>
    
</body>
</html>