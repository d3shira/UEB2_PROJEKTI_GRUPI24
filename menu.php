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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>
<body>
<?php include 'database.php' ?>
<?php include 'navbar.php' ?>

<section class="menu" id="menu">
    <h3 class="sub-heading" style="font-size: 4rem; color:#192a56"> Our menu</h3>
    <h1 class="heading" style="font-size: 3.5rem; color:#192a56">Choose your diet plan!</h1>
    <div class="box-container">
        <?php
        $sql3 = "SELECT * FROM tbl_diet";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                <div class="box" id="dietCards">
    <div class="image">
        <img src="<?php echo $rows['image_path']; ?>" alt="Diet Image">
    </div>
    <div class="heart">
        <a href="favorites.php" class="fas-fa-heart"></a>
        <img src="<?php echo $rows['heart']; ?>" alt="Heart Simbol">
    </div>
    <div class="content">
        <h3><?php echo $rows['diet_name']; ?> Diet</h3>
        <p><?php echo $rows['description']; ?></p>
        <a href="http://localhost/UEB2_PROJEKTI/order.php?diet_id=<?php echo $rows['diet_id']; ?>"
           class="btn" onmouseover="this.style.backgroundColor='#27ae60';"
           onmouseout="this.style.backgroundColor='#192a56';">Order</a>
        <span class="price">$<?php echo $rows['price']; ?></span>
    </div>
</div>


                <?php
            }
        }
        ?>
    </div>
</section>
</body>
</html>
