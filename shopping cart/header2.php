<header class="header">

   <div class="flex">

      <a href="products.php" class="logo">FUND CLINIC STORES</a>
      

      <nav class="navbar">
      <a href="../index2.php">กลับหน้าหลัก</a> 
      <a href="cus_status.php">สถานะการสั่งซื้อ</a> 
      <a href="products.php">ดูสินค้า</a> &nbsp;&nbsp;&nbsp;&nbsp;
      </nav>

      <?php

      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="fa fa-shopping-cart"  style="font-size: 30px; color:aliceblue"><span>&nbsp;<?php echo $row_count; ?></span> </a>
      
      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>