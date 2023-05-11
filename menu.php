
<!DOCTYPE html>
<html>
    <head>
     <style>
 
         </style>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Diets</title> 
        <link rel="stylesheet" href="menu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    </head>
    <body>
      <?php @include 'navbar.php' ?>
        <section class="menu" id="menu">
           <h3 class="sub-heading" style="font-size: 4rem; color:#192a56"> Our menu</h3>
           <h1 class="heading" style="font-size: 3.5rem; color:#192a56">Choose your diet plan!</h1> 
           <div class="box-container">
             <div class="box" id="dietCards">
                  <div class="image">
                     <img src="images/sq_mediterranean_diet.jpeg" alt="">
                     <a href="#" class="fas far fa-heart"></a>
                  </div>
                 <div class="content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fas fa-star-half-alt"></i>
                    </div>
                    <h3>Medit Diet</h3>
                    <p>The Mediterranean Diet emphasizes whole foods, healthy fats, and seafood while limiting processed foods, red meat, and added sugars fkjghdrkgjekrgnekgnklj.</p>
                    <a href="#" class="btn"  onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                    <span class="price">$12.99</span>
                 </div>
             </div>
             
             <div class="box" id="dietCards">
                <div class="image">
                    <img src="images/sq_zone_diet.jpg" alt="">
                    <a href="#" class="fas far fa-heart"></a>
               </div>
                <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>Zone Diet</h3>
                  <p> The Zone Diet focuses on balancing macronutrients, regulating insulin levels, and promoting weight loss. It involves consuming a specific ratio of carbohydrates, proteins, and fats     </p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
                </div>
              </div>
              <div class="box" id="dietCards">
                <div class="image">
                   <img src="images/sq_paleo_diet.jpg" alt="">
                   <a href="#" class="fas far fa-heart"></a>
                </div>
               <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>Paleo Diet</h3>
                  <p>The Flexitarian Diet promotes plant-based eating while allowing occasional consumption of meat or animal products. It offers a flexible approach to vegetarianism</p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
               </div>
             </div>
             <div class="box" id="dietCards">
                <div class="image">
                   <img src="images/sq_flexitarian_diet.jpg" alt="">
                   <a href="#" class="fas far fa-heart"></a>
                </div>
               <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>Flexitarian Diet</h3>
                  <p>A flexible approach to vegetarianism, this diet promotes plant-based eating while allowing for occasional
                      consumption of meat or animal products. </p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
               </div>
              </div>
              <div class="box" id="dietCards">
                <div class="image">
                   <img src="images/sq_vegan_diet.jpg" alt="">
                   <a href="#" class="fas far fa-heart"></a>
                </div>
               <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>Vegan diet</h3>
                  <p>The Vegan Diet excludes all animal products, including meat, poultry, dairy, eggs, and honey. It emphasizes a wide variety of fruits, vegetables, legumes, grains and nuts.</p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
               </div>
             </div>
             <div class="box" id="dietCards">
                <div class="image">
                   <img src="images/sq_dash_diet.jpg" alt="">
                   <a href="#" class="fas far fa-heart"></a>
                </div>
               <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>Dash Diet</h3>
                  <p>Originally developed to help lower blood pressure, this diet emphasizes whole foods, fruits,
                      vegetables, lean proteins, and whole grains while limiting salt and sugar. </p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
               </div>
              </div>
              <div class="box" id="dietCards">
                <div class="image">
                   <img src="images/sq_pesc_diet.jpg" alt="">
                   <a href="#" class="fas far fa-heart"></a>
                </div>
               <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>Pescatarian Diet</h3>
                  <p>The Pescatarian Diet, rich in fish and seafood, offers a plant-based dietary approach that provides lean protein and essential nutrients while also supporting cardiovascular health and reducing environmental impact. </p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
               </div>
             </div>
             <div class="box" id="dietCards">
                <div class="image">
                   <img src="images/sq_ornish_diet.jpg" alt="">
                   <a href="#" class="fas far fa-heart"></a>
                </div>
               <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>Ornish Diet</h3>
                  <p>
The Ornish Diet emphasizes the consumption of nutrient-dense, plant-based foods while restricting the intake of high-fat and animal-based products, making it a comprehensive approach to improving heart health. </p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
               </div>
             </div>
             <div class="box" id="dietCards">
                <div class="image">
                   <img src="images/sq_mind_diet.jpg" alt="">
                   <a href="#" class="fas far fa-heart"></a>
                </div>
               <div class="content">
                  <div class="stars">
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fas fa-star-half-alt"></i>
                  </div>
                  <h3>MIND Diet</h3>
                  <p>Combining aspects of the Mediterranean and DASH diets, this diet focuses on whole foods and specifically
                      promotes consumption of brain-healthy foods such as berries, nuts, and leafy greens.</p>
                  <a href="#" class="btn"onmouseover="this.style.backgroundColor='#27ae60';" onmouseout="this.style.backgroundColor='#192a56';">Order</a>
                  <span class="price">$12.99</span>
               </div>
             </div>
           </div>
        </section>
</body>
</html>