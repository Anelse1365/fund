<?php

session_start();
require_once 'config.php';


// Check if the user is logged in
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];

    // Query to get user details from the database
    $user_query = $conn->prepare("SELECT email FROM patien WHERE id = ?");
    $user_query->bind_param("i", $user_id);
    $user_query->execute();
    $user_query->store_result();

    // Check if user details are found
    if ($user_query->num_rows > 0) {
        $user_query->bind_result($user_email);
        $user_query->fetch();

        // Add the user's email to the checkout form
        echo '<input type="hidden" name="user_email" value="' . $user_email . '">';
    }
}

if (isset($_POST['order_btn'])) {

    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pin_code = $_POST['pin_code'];
    $total_products = $_POST['total_products'];
    

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
    $price_total = 0;

    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
            $product_price = number_format($product_item['price'] * $product_item['quantity']);
            $price_total += $product_price;
        }
    }
    $total_product = implode(', ', $product_name);

    // Define $pay_image variable to avoid undefined variable warning
    $pay_image = '';
    

    if ($method === 'paypal' || $method === 'credit card') {
        // Check if payment method requires an image upload
        if (isset($_FILES['payment_image']) && $_FILES['payment_image']['error'] === 0) {
            $pay_image = $_FILES['payment_image']['name'];
            $pay_image_tmp_name = $_FILES['payment_image']['tmp_name'];
            $pay_image_folder = 'uploaded_img/' . $pay_image;

            // บันทึกรูปภาพในไดเรกทอรี uploaded_img/
            move_uploaded_file($pay_image_tmp_name, $pay_image_folder);
        }
    }

    $detail_query = mysqli_query($conn, "INSERT INTO `order2` (name, number, email, method, flat, street, city, 
    state, country, pin_code, total_products, pay, total_price, order_status)
    VALUES ('$name','$number','$email','$method','$flat','$street','$city','$state','$country',
    '$pin_code','$total_product','$pay_image','$price_total', '1')") or die(mysqli_error($conn)); // Output the error to help identify the issue

    if ($cart_query && $detail_query) {
        echo "
        <div class='order-message-container'>
        <div class='message-container'>
            <h3>thank you for shopping!</h3>
            <div class='order-detail'>
                <span>" . $total_product . "</span>
                <span class='total'> total : ฿" . $price_total . "/-  </span>
            </div>
            <div class='customer-details'>
                <p> your name : <span>" . $name . "</span> </p>
                <p> your number : <span>" . $number . "</span> </p>
                <p> your email : <span>" . $email . "</span> </p>
                <p> your address : <span>" . $flat . ", " . $street . ", " . $city . ", " . $state . ", " . $country . " - " . $pin_code . "</span> </p>
                <p> your payment mode : <span>" . $method . "</span> </p>
                <p>(*pay when the product arrives*)</p>
            </div>
            <a href='products.php' class='btn'>continue shopping</a>
        </div>
        </div>
        ";
    }
}


?>


<style>
   html{
   font-size: 62%;
   overflow-x: hidden;
}
</style>
<style>
   html{
   font-size: 62%;
   overflow-x: hidden;
}
</style>             

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header2.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post" enctype="multipart/form-data">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : ฿<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>ชื่อนามสกุล</span>
            <input type="text" placeholder="  " name="name" required>
         </div>
         <div class="inputBox">
            <span>เบอร์โทร</span>
            <input type="number" placeholder="xxxxxxxxx" name="number" required>
         </div>
         <div class="inputBox">
    <span>your email</span>
    <input type="email" placeholder=" " name="email" value="<?php echo isset($user_email) ? $user_email : ''; ?>" readonly>
</div>
         <div class="inputBox">
   <span>Payment Method</span>
   <select name="method" onchange="toggleUploadTab(this.value)">
      <option value="cash on delivery" selected>Cash on Delivery</option>
      <option value="credit card">Credit Card</option>
      <option value="paypal">PayPal</option>
   </select>
</div>

         <div class="inputBox">
            <span>บ้านเลขที่</span>
            <input type="text" placeholder=" " name="flat" required>
         </div>
         <div class="inputBox">
            <span>ตำบล</span>
            <input type="text" placeholder=" " name="street" required>
         </div>
         <div class="inputBox">
            <span>อำเภอ</span>
            <input type="text" placeholder=" " name="city" required>
         </div>
         <div class="inputBox">
            <span>จังหวัด</span>
            <input type="text" placeholder=" " name="state" required>
         </div>
         <div class="inputBox">
            <span>ประเทศ</span>
            <input type="text" placeholder=" " name="country" required>
         </div>
         <div class="inputBox">
            <span>รหัสไปรษณีย์</span>
            <input type="text" placeholder=" " name="pin_code" required>
         </div>
         <!-- Add this block inside your form -->
<!-- Add this block inside your form -->
<div class="inputBox" id="uploadTab" style="display: none;">
   <span>สแกน QR โค้ดเพื่อชำระเงิน</span>
   <img id="paymentImagePreview" src="images/qr1.png" alt="" style="max-width: 400px; max-height: 400px; display: none;">
   <br>
   <h3>อัพโหลดหลักฐานการชำระเงิน</h3>

   <input type="file" name="payment_image" id="paymentImageInput" onchange="previewImage()">

</div>

         
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">

   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
<!-- Add this block inside your form -->
<div class="inputBox" id="uploadTab" style="display: none;">
   <span>Upload Image</span>
   <input type="file" name="payment_image" id="paymentImageInput" onchange="previewImage()">
   <img id="paymentImagePreview" src="images/qr1.png" alt="" style="max-width: 400px; max-height: 400px; display: none;">
</div>

<script>
function toggleUploadTab(selectedMethod) {
   var uploadTab = document.getElementById("uploadTab");
   var paymentImagePreview = document.getElementById("paymentImagePreview");

   if (selectedMethod === "paypal" || selectedMethod === "credit card") {
      uploadTab.style.display = "block";
      paymentImagePreview.style.display = "block"; // Show the image
   } else {
      uploadTab.style.display = "none";
      paymentImagePreview.style.display = "none"; // Hide the image
   }
}

function previewImage() {
   var input = document.getElementById("paymentImageInput");
   var preview = document.getElementById("paymentImagePreview");

   if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
         preview.src = e.target.result;
         preview.style.display = "block";
      }

      reader.readAsDataURL(input.files[0]);
   } else {
      preview.style.display = "none";
   }
}
</script>




</html>