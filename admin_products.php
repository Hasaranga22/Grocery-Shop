<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}
;

if (isset($_POST['add_product'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $message[] = 'product name already exist!';
   } else {

      $insert_products = $conn->prepare("INSERT INTO `products`(name, category, details, price, image) VALUES(?,?,?,?,?)");
      $insert_products->execute([$name, $category, $details, $price, $image]);

      if ($insert_products) {
         if ($image_size > 2000000) {
            $message[] = 'image size is too large!';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new product added!';
         }

      }

   }

}
;

if (isset($_GET['delete'])) {

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:admin_products.php');


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <!-- <section class="add-products">
      <h1 class="title">Add New Product</h1>
      <form action="" method="POST" enctype="multipart/form-data">
         <div class="flex">
            <div class="inputBox">
               <input type="text" name="name" class="box" required placeholder="Enter product name">
               <select name="category" class="box" required>
                  <option value="" selected disabled>Select category</option>
                  <option value="vegitables">Vegetables</option>
                  <option value="fruits">Fruits</option>
                  <option value="meat">Meat</option>
                  <option value="biscuit">Biscuit</option>
                  <option value="milkpowder">Milk Powder</option>
                  <option value="bite">Bite</option>
                  <option value="rice">Rice</option>
                  <option value="stationary">Stationary Items</option>
                  <option value="cosmetics">Cosmetic Items</option>
               </select>
            </div>
            <div class="inputBox">
               <input type="number" min="0" name="price" class="box" required placeholder="Enter product price">
               <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
            </div>
         </div>
         <textarea name="details" class="box" required placeholder="Enter product details" cols="30"
            rows="10"></textarea>
         <input type="submit" class="btn" value="Add Product" name="add_product">
      </form>
   </section> -->

   <section class="search-products">
      <h1 class="title">Search Products</h1>
      <form action="" method="GET" class="search-form"
         style="display: flex; align-items: center; gap: 10px; max-width: 600px; margin: 0 auto; padding: 15px; background: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
         <input type="text" name="search" class="box" placeholder="Search by product "
            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
            style="flex: 1; padding: 10px; border: 2px solid #ddd; border-radius: 5px; font-size: 16px; outline: none; transition: border-color 0.3s ease;"
            onfocus="this.style.borderColor='#007bff';" onblur="this.style.borderColor='#ddd';">
         <input type="submit" class="btn" value="Search"
            style="margin-top:-2px ; background: rgb(39, 174, 96); color: #fff; border: none; border-radius: 5px;width:250px; font-size: 16px; cursor: pointer; transition: background 0.3s ease;"
            onmouseover="this.style.background='black';" onmouseout="this.style.background='rgb(39, 174, 96)';">

   </section>

   <section class="show-products">
      <h1 class="title">Products Added</h1>
      <div class="box-container">
         <?php
         $search_query = isset($_GET['search']) ? $_GET['search'] : '';
         $sql = "SELECT * FROM `products` WHERE `name` LIKE :search OR `category` LIKE :search";
         $show_products = $conn->prepare($sql);
         $show_products->execute(['search' => "%$search_query%"]);

         if ($show_products->rowCount() > 0) {
            while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <div class="box">
                  <div class="price">Rs <?= $fetch_products['price']; ?>.00/-</div>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <div class="cat"><?= $fetch_products['category']; ?></div>
                  <div class="details"><?= $fetch_products['details']; ?></div>
                  <div class="flex-btn">
                     <a href="admin_update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
                     <a href="admin_products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn"
                        onclick="return confirm('Delete this product?');">Delete</a>
                  </div>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">No products found!</p>';
         }
         ?>
      </div>
   </section>











   <script src="js/script.js"></script>

</body>

</html>