<?php

@include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

$discount_applied = false;
$discount_code = '';
$discount_amount = 0;

// Calculate the total amount before applying discount
$select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
$grand_total = 0;

while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
}

// Apply discount after calculating the grand total
// Apply discount after calculating the grand total
if(isset($_POST['apply_discount_btn'])){
   $discount_code = $_POST['discount_code'];
   $discount_amount = applyDiscount($discount_code, $grand_total);
   $discount_applied = ($discount_amount > 0);
   // Recalculate grand total with discount
   $grand_total -= $discount_amount;

   // Store discount amount in session
   session_start();
   $_SESSION['discount_amount'] = $discount_amount;
}

// Function to apply discount based on code
function applyDiscount($code, $totalAmount) {
    // Example: Applying a 10% discount for code '123'
    if ($code == '123') {
        $discountPercentage = 10;
        $discountAmount = ($totalAmount * $discountPercentage) / 100;
        return $discountAmount;
    }
    return 0; // No discount applied by default
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header2.php'; ?>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>฿<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>฿<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
            };
         };
         ?>
         <tr class="table-bottom">
            <td colspan="2">
               <form action="" method="post">
                  <input type="text" name="discount_code" placeholder="Enter Discount Code">
                  <input type="submit" value="Apply" name="apply_discount_btn">
               </form>
            </td>
            <td colspan="2">Discount</td>
            <td>฿<?php echo $discount_applied ? number_format($discount_amount) : '0'; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>
         <tr class="table-bottom">
            <td colspan="3">Grand Total</td>
            <td>฿<?php echo number_format($grand_total); ?></td>
            <td></td>
            <td></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>