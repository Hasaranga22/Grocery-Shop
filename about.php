<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="about">

      <div class="row">

         <div class="box">
            <img src="images/pr1.jpeg" alt="">
            <h3>why choose us?</h3>
            <p>At Yatawara Grocery Store, we are committed to bringing you the freshest and highest-quality groceries at
               unbeatable prices. We source our products from trusted local farmers and suppliers, ensuring that every
               item is fresh, healthy, and safe for your family. Our convenient online and in-store shopping experience
               makes it easy for you to get all your daily essentials without hassle. With excellent customer service,
               fast delivery, and exclusive deals, Yatawara Grocery Store is your trusted partner for all your grocery needs.
            </p>
            <a href="contact.php" class="btn">contact us</a>
         </div>

         <div class="box">
            <img src="images/pr2.jpg" alt="">
            <h3>what we provide?</h3>
            <p>We offer a wide range of grocery products, including farm-fresh fruits and vegetables, premium-quality
               meat and seafood, dairy products, rice, pulses, and household essentials. Whether you're looking for
               organic produce, Sri Lankan spices, or quick snacks, we’ve got it all. Our carefully curated selection
               ensures that you get the best quality at the best prices. With Yatawara Grocery Store you can shop
               confidently, knowing you're getting the freshest and finest groceries delivered to your doorstep.</p>
            <a href="shop.php" class="btn">our shop</a>
         </div>

      </div>

   </section>

   <section class="reviews">

      <h1 class="title">clients reivews</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/pic-1.jpg" alt="">
            <p>"I love shopping here! The vegetables and fruits are always fresh, and the prices are reasonable. The
               staff is also very friendly and helpful!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Samantha Perera</h3>
         </div>

         <div class="box">
            <img src="images/pic2.jpg" alt="">
            <p>"This shop has everything I need, from fresh produce to imported snacks. The quality is top-notch, and I
               never have to worry about expired products."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Dilan Fernando</h3>
         </div>

         <div class="box">
            <img src="images/pic3.jpg" alt="">
            <p>"Great selection and fair prices, but the checkout process can be a bit slow during peak hours. If they
               improve that, it'll be perfect!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Kavindu Jayasinghe</h3>
         </div>

         <div class="box">
            <img src="images/pic-4.jpg" alt="">
            <p>"The staff is always so welcoming and ready to help. I had an issue with a product, and they replaced it
               immediately. Excellent service!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Roshani Silva</h3>
         </div>

         <div class="box">
            <img src="images/pic-5.jpg" alt="">
            <p>"I like how well-organized this grocery store is. Everything is easy to find, and they always have fresh
               bakery items. Highly recommended!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Anura Wijesinghe</h3>
         </div>

         <div class="box">
            <img src="images/pic-6.jpg" alt="">
            <p>"The staff is always so welcoming and ready to help. I had an issue with a product, and they replaced it
               immediately. Excellent service!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Hashini Ranathunga</h3>
         </div>

      </div>

   </section>









   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>