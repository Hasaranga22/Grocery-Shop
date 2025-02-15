<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}
;

if (isset($_POST['add_to_wishlist'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_wishlist_numbers->rowCount() > 0) {
      // $message[] = 'already added to wishlist!';
      echo "<script>alert('Item already added to Wishlist);</script>";
   } elseif ($check_cart_numbers->rowCount() > 0) {
      // $message[] = 'already added to cart!';
      echo "<script>alert('Item already added to Wishlist);</script>";
   } else {
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      // $message[] = 'added to wishlist!';
      echo "<script>alert('Item added to Wishlist successfully!');</script>";

   }

}

if (isset($_POST['add_to_cart'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_cart_numbers->rowCount() > 0) {
      // $message[] = 'already added to cart!';
      echo "<script>alert('Item already added to Cart);</script>";
   } else {

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if ($check_wishlist_numbers->rowCount() > 0) {
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      // $message[] = '';
      echo "<script>alert('Item added to cart successfully!');</script>";
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="home-bg">

      <section class="home">

         <div class="content">
            <span>Quality, Convenience, and Savings in Every Aisle!</span>
            <h3>Fresh & Local Groceries Delivered to Your Door!</h3>
            <p>From farm-fresh produce to household essentials, we bring you a wide range of high-quality products at
               the best prices. Shop with confidence and enjoy a convenient, budget-friendly shopping experience!</p>
            <a href="about.php" class="btn">about us</a>
         </div>

      </section>

   </div>

   <section class="home-category">

      <h1 class="title">shop by category</h1>

      <div class="box-container">

         <div class="box">
            <img src="images/cat-1.png" alt="">
            <h3>fruits</h3>
            <p>Fruits are a healthy source of vitamins and minerals, offering a refreshing taste. Common options like
               apples, bananas, and oranges provide health benefits and can be enjoyed as snacks, juices, or in
               desserts.</p>
            <a href="category.php?category=fruits" class="btn">See all Products</a>
         </div>

         <div class="box">
            <img src="images/cat-2.png" alt="">
            <h3>meat</h3>
            <p>Meat is a protein-rich food, including chicken, beef, and pork. It provides essential nutrients like iron
               and zinc and is a tasty addition to dishes like curries, steaks, and barbecues when consumed in
               moderation.

            </p>
            <a href="category.php?category=meat" class="btn">See all Products</a>
         </div>

         <div class="box">
            <img src="images/cat-3.png" alt="">
            <h3>vegitables</h3>
            <p>Vegetables are important for a balanced diet, offering fiber, vitamins, and minerals. Common options like
               carrots, spinach, and tomatoes are versatile and essential for good digestion and overall health.</p>
            <a href="category.php?category=vegitables" class="btn">See all Products</a>
         </div>

         <div class="box">
            <img src="images/cat-4.jpg" alt="">
            <h3>Rice</h3>
            <p>Rice is a staple food in many cultures, providing carbohydrates and energy. It pairs well with many
               dishes and comes in varieties like white, brown, and basmati, making it an essential part of daily meals.

            </p>
            <a href="category.php?category=rice" class="btn">See all Products</a>
         </div>

         <div class="box">
            <img src="images/cat-5.jpg" alt="">
            <h3>Milk Powder</h3>
            <p>Milk powder is a convenient, long-lasting alternative to liquid milk, commonly used in cooking, baking,
               and beverages. It’s rich in calcium and protein, making it a versatile ingredient in many households.</p>
            <a href="category.php?category=milkpowder" class="btn">See all Products</a>
         </div>

         <div class="box">
            <img src="images/cat-6.jpg" alt="">
            <h3>Bites</h3>
            <p>Bites are small,Bites are Spicy flavorful snacks perfect for quick munching. Options like chips, cheese
               bites, and mini
               samosas are ideal for parties or as appetizers, offering convenience and variety.</p>
            <a href="category.php?category=bite" class="btn">See all Products</a>
         </div>

         <div class="box">
            <img src="images/cat-7.jpg" alt="">
            <h3>Stationary Items</h3>
            <p>Our grocery shop offers a variety of stationery essentials, including notebooks, pens, pencils, erasers,
               markers, and more. Whether for school, office, or personal use, you'll find high-quality products to meet
               your.</p>
            <a href="category.php?category=stationary" class="btn">See all Products</a>
         </div>

         <div class="box">
            <img src="images/cat-8.jpeg" alt="">
            <h3>Cosmetics Items</h3>
            <p>Enhance your beauty with our selection of cosmetics, featuring skincare, makeup, and personal care
               products. From face creams and lipsticks to shampoos and perfumes, we provide top brands to keep you
               looking and feeling.</p>
            <a href="category.php?category=cosmetics" class="btn">See all Products</a>
         </div>

      </div>

   </section>

   <section class="products">

      <h1 class="title">latest products</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE `category` = 'biscuit' AND `id` != 50 ORDER BY RAND() LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <form action="" class="box" method="POST">
                  <div class="price">Rs <span><?= $fetch_products['price']; ?>.00</span>/-</div>
                  <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
                  <input type="number" min="1" value="1" name="p_qty" class="qty">
                  <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
                  <input type="submit" value="add to cart" class="btn" name="add_to_cart">
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

   </section>


   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>