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
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">
         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if ($select_orders->rowCount() > 0) {
            while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <div class="box">
                  <p>Placed on: <span><?= $fetch_orders['placed_on']; ?></span></p>
                  <p>Name: <span><?= $fetch_orders['name']; ?></span></p>
                  <p>Number: <span><?= $fetch_orders['number']; ?></span></p>
                  <p>Email: <span><?= $fetch_orders['email']; ?></span></p>
                  <p>Address: <span><?= $fetch_orders['address']; ?></span></p>
                  <p>Payment Method: <span><?= $fetch_orders['method']; ?></span></p>
                  <p>Your Orders: <span><?= $fetch_orders['total_products']; ?></span></p>
                  <p>Total Price: <span>Rs <?= $fetch_orders['total_price']; ?>.00/=</span></p>
                  <p>Payment Status: <span
                        style="color:<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'red' : 'green'; ?>">
                        <?= $fetch_orders['payment_status']; ?></span>
                  </p>

                  <button onclick="showInvoice(<?= $fetch_orders['id']; ?>)">View Invoice</button>
                  <button onclick="downloadInvoice(<?= $fetch_orders['id']; ?>)">Download Invoice</button>
               </div>

               <div id="invoice-<?= $fetch_orders['id']; ?>" class="invoice" style="display:none;">
                  <div class="invoice-header">
                     <h1 id="invoice-title"
                        style="font-size: 32px; font-weight: bold; text-decoration: none; color: #27ae60; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: inline-block; 
                             background: linear-gradient(90deg, #27ae60, #2ecc71); -webkit-background-clip: text; color: transparent; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
                        Yatawara Grocery Store
                     </h1>
                     <h2>Invoice</h2>
                  </div>
                  <div class="invoice-body">
                     <p><strong>Invoice No.:</strong> <?= $fetch_orders['id']; ?></p>
                     <p><strong>Billed To:</strong> <?= $fetch_orders['name']; ?></p>
                     <p><strong>Date:</strong> <?= $fetch_orders['placed_on']; ?></p>
                     <p><strong>Phone:</strong> <?= $fetch_orders['number']; ?></p>
                     <p><strong>Address:</strong> <?= $fetch_orders['address']; ?></p>
                     <table id="invoice-table">
                        <thead>
                           <tr>
                              <th>All Items</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Total</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $product_name = substr($fetch_orders['total_products'], 0, strlen($fetch_orders['total_products']) - 6);
                           $quantity = $fetch_orders['product_quantities'];
                           $total_price = $fetch_orders['total_price'];

                           // Calculate unit price
                           $unit_price = $total_price / $quantity;

                           echo "<tr>
                        <td>{$product_name}</td>
                        <td>{$quantity}</td>
                        <td>Rs {$unit_price}.00/=</td>
                        <td>Rs {$total_price}.00/=</td>
                     </tr>";
                           ?>
                        </tbody>
                     </table>
                     <div class="sect" style="margin-top: 30px;">
                        <p style="text-align: right;"><strong>Subtotal:</strong> Rs <?= $fetch_orders['total_price']; ?>.00/=
                        </p>
                        <p style="text-align: right;"> <strong>Tax (0%):</strong> Rs 0.00/=</p>
                        <p style="text-align: right;"><strong>Total:</strong> Rs <?= $fetch_orders['total_price']; ?>.00/=</p>
                     </div>
                  </div>
                  <div class="invoice-footer">
                     <p style="text-align: left;"><strong>Payment Information:</strong></p>
                     <p style="text-align: left;">Sampath Bank</p>
                     <p style="text-align: left;">Account Name: Saduni Pieris</p>
                     <p style="text-align: left;">Account No.: 123-456-7890</p>
                     <p style="text-align: left;">Pay by: 5 July 2025</p>
                     <p style="text-align: left;">No23, Kandy Road, Kadugannawa</p><br><br>
                     <p style="text-align: center;font-weight:bold">Thank you for shopping with Yatawara Grocery Store</p>
                  </div>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty" style="text-align:center;font-size:15px">No orders placed yet!</p>';
         }
         ?>
      </div>

      <script>
         function showInvoice(orderId) {
            var invoice = document.getElementById('invoice-' + orderId);
            invoice.style.display = 'block';
         }

         function downloadInvoice(orderId) {
            var invoice = document.getElementById('invoice-' + orderId);

            // Inline CSS inserted directly into the script
            var style = "<style>" +
               "body { font-family: Arial, sans-serif; }" +
               "h1, h2 { text-align: center; }" +
               "p { margin: 5px 0 }" +
               "table { width: 100%; border-collapse: collapse; margin-top: 20px; }" +
               "th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }" +
               "th { background-color: #f2f2f2; }" +
               ".invoice-footer { margin-top: 20px; font-size: 14px; text-align: center; }" +
               "</style>";

            var win = window.open('', '', 'width=800,height=600');
            win.document.write('<html><head><title>Invoice</title>' + style + '</head><body>' + invoice.innerHTML + '</body></html>');
            win.document.close();
            win.print();
         }
      </script>


   </section>









   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>