<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

   <div class="container">
      <div class="container-login100">
         <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
               <img src="images/Logo-2.png" alt="IMG">
            </div>

            <form class="login100-form validate-form" action="signin_db2.php" method="post">
               <span class="login100-form-title">เข้าสู่ระบบ</span>
               <?php if(isset($_SESSION['error'])) { ?>
                  <div class="alert alert-danger" role="alert">
                     <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                  </div>
               <?php } ?>
               <?php if(isset($_SESSION['success'])) { ?>
                  <div class="alert alert-success" role="alert">
                     <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                  </div>
               <?php } ?>
               <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" aria-describedby="email">
               </div>
               <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password">
               </div>
               <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
            </form>

            <hr>

            <p>ยังไม่เป็นสมาชิกใช่ไหม คลิ๊กที่นี่เพื่อ <a href="home2.php">สมัครสมาชิก</a></p>
            <p>กลับหน้าหลัก <a href="index3.php">กดที่นี้</a></p>
         </div>
      </div>
   </div>

   <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
   <script src="vendor/bootstrap/js/popper.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
   <script src="vendor/select2/select2.min.js"></script>
   <script src="vendor/tilt/tilt.jquery.min.js"></script>
   <script>
      $('.js-tilt').tilt({
         scale: 1.1
      });
   </script>
</body>
</html>
