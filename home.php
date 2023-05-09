<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
   
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
                        
                        
                        <p style="color:white; font-size:1.4rem ">Improve your mood by eating healthy food!
                        Forget the junk hype and only eat foods that are fresh and ripe
                       Eat fruits plenty, keep your body healthy
                        Eating healthy keeps your heart beating!</p>
                         <!--  <a href="#" class="btn">order now</a>-->

                    </div>
                    <div class="image">
                        <img src="images/deshiraa.jpg" style="width:90%; height:auto;" alt="">
                    </div>
                </div>
                <div class="swiper-slide slide">
                    <div class="content">
                        
                        
                        <p style="color:white; font-size:1.4rem">Check out our diet plans: If you are looking for a structured approach to your diet, 
                            we offer a range of diet plans to suit different goals and lifestyles.
                             Whether you are looking to lose weight, build muscle, or simply improve your overall health,
                              we have a plan for you.</p>
                      <!--  <a href="#" class="btn">order now</a>-->

                    </div>
                    <div class="image">
                        <img src="images/firstImg1.jpg"style="width:90%;height:auto;" alt="">
                    </div>
                </div>
                <div class=" swiper-slide slide">
                    <div class="content">
                       
                        <h3 style="color:white; font-size:2.5rem">Reviews</h3>
                        <p style="color:white; font-size:1.4rem;">Don't just take our word for it - see what our satisfied clients have to say! </p>
                         <!--  <a href="#" class="btn">order now</a>-->

                    </div>
                    <div class="image">
                        <img src="images/img3.jpg" alt="">
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