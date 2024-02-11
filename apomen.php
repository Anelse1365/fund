<?php 

    session_start();
    require_once 'config2/db2.php';
	?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>การนัดหมอฟัน</title>
    <link rel="stylesheet" href="ww1.css"> <!-- เรียกใช้ไฟล์ CSS -->
    <!-- Favicon -->
    <link rel="icon" href="img/logo5.png">
		
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="css/nice-select.css">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="css/icofont.css">
        <!-- Slicknav -->
		<link rel="stylesheet" href="css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="css/datepicker.css">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="css/animate.min.css">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="css/magnific-popup.css">

        <!-- Medipro CSS -->

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/responsive.css">
		<style>
        /* สไตล์สำหรับหน้าเว็บ */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        /* สไตล์สำหรับ container ที่มี input type time */
        .time-input-container {
            border: 1px solid #ccc;
            padding: 8px;
            width: 200px; /* ปรับขนาดตามต้องการ */
            border-radius: 5px;
        }

        /* สไตล์สำหรับ input type time */
        .time-input-container input[type="time"] {
            border: none; /* ลบเส้นขอบของ input เอาไว้เพราะมีกรอบแล้ว */
            width: 100%;
            padding: 5px;
        }
    </style>
</head>
<body>

<?php 

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<header class="header" >
 </div>
<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-9 col-12">							
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+880 1234 56789</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:FanD@gmail.com">FanD@gmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index2.php"><img src="img/Fun D Logo2.png" alt="#"></a>
								</div>
							<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-9 col-md-11 col-14">
								<!-- Main Menu -->
								<div class="main-menu">
									<nav class="navigation">
										<ul class="nav menu">
										<li class="active"><a href="index2.php">หน้าเเรก</i></a>
												
												</li>
												<li><a href="#">ทันตเเพทย์<i class="icofont-rounded-down"></i></a>
													<ul class="dropdown">
												<li><a href="dOurdoctor.php">ทีมทันตแพทย์</a></li> <br>
												<li><a href="doctorA.php">Doctor A</a></li> <br>
												<li><a href="doctorB.php">Doctor B</a></li> <br>
												<li><a href="doctorC.php">Doctor C</a></li> <br>
												<li><a href="doctorD.php">Doctor D</a></li> <br>
												<li><a href="doctorE.php">Doctor E</a></li> <br>
												<li><a href="doctorF.php">Doctor F</a></li> <br>
										
											</ul>
											
	
												<li><a href="#">บริการ<i class="icofont-rounded-down"></i></a>
													<ul class="dropdown">
														<li><a href="index.php">การดัดฟัน</a></li> <br>
														<li><a href="index.php">การขูดหินปูน</a></li> <br>
														<li><a href="index.php">การรักษารากฟัน</a></li> <br>
														<li><a href="index.php">การถอนฟันรักษาช่องปาก</a></li> <br>
														<li><a href="index.php">ทันตกรรมรากเทียม</a></li> <br>
														<li><a href="index.php">ทันตกรรมสำหรับเด็ก</a></li> <br>
													
													</ul>		
													<li><a href="userReview.php">รีวิว<i ></i></a>
														<ul class="dropdown">
														</ul>
	
	
														<li><a href="productsuser.html">สินค้าFund<i ></i></a>
														<ul class="dropdown">
														
														</ul>
														
												
												
													<li><a href="#">เพิ่มเติม<i class="icofont-rounded-down"></i></a>
														<ul class="dropdown">
													<li>  <a href="user2.php">โปรไฟล์</a></li> 
													<li>  <a href=" receipt.php ">ใบเสร็จการนัดจอง</a></li> 
													<li><a href="logout2.php">ออกจากระบบ</a></li> 
                                                    </ul>
                                                </li>
										</ul>
									</nav>
								</div>
								<!--/ End Main Menu -->
							</div>
							<div class="col-lg-2 col-12">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Header Inner -->
		</header>
<form action = "submitapomen.php" method="post">
		<section>
    <div class="container"> 
        <h1>การนัดหมอฟัน</h1>
        <p>กรุณากรอกข้อมูลเพื่อนัดหมอฟัน</p>  
		<div class="form-group">
    <label for="name"> </label>
    <input type="text" class="form-control" name="patient" value="<?php echo $row['firstname'] . ' ' . $row['lastname']?>" required> 
</div>


<div class="form-group">
    <label for="name"> </label>
    <input type="text" class="form-control" name="email" value="<?php echo $row['email']?>" required> 
</div>

<div class="form-group">
    <label for="name"> เบอร์โทร:</label>
    <input type="text" class="form-control" name="phone_number" value="<?php echo $row['phone_number']?>" required> 
</div>

<div class="form-group">
    <label for="name"> อายุ:</label>
    <input type="text" class="form-control" name="  age   " value="<?php echo $row['age']?>" required> 
</div>

<div class="form-group">
    <label for="name">เพศ: </label>
    <input type="text" class="form-control" name=" gender " value="<?php echo $row['gender']?>" required> 
</div>
<div class="form-group">
    <label for="name"> สัญชาติ:</label>
    <input type="text" class="form-control" name=" nationality  " value="<?php echo $row['nationality']?>" required> 
</div>
	<br>
			<select name="state">
                <option value="" disabled selected>เลือกคลิกนิก</option>
                <option value="พิษณุโลก">พิษณุโลก</option>
                <option value="กำเเพงเพชร">กำเเพงเพชร</option>
               
            </select>
            <br>
            <br>
            <select name ="infomation">
                <option value="" disabled selected>เลือกประเภทการนัด</option>
                <option value="รักษาทันตกรรมทั่วไป">รักษาทันตกรรมทั่วไป</option>
                <option value="ผ่าฟัน">ผ่าฟัน</option>
                <option value="อื่นๆ">บริการอื่นๆ</option>
            </select>
            <br>
			<br>
			<select name = "doctor">
                <option value="" disabled selected>เลือกหมอ</option>
                <option value="หมอA">หมอA</option>
                <option value="หมอB">หมอB</option>
                <option value="หมอC">หมอC</option>
				<option value="หมอD">หมอD</option>
                <option value="หมอE">หมอE</option>
                <option value="หมอF">หมอF</option>
            </select>
			<br>
			<br>
			<input type="date" name="date">
			<div class="time-input-container">
    
			<label for="timeInput">เลือกเวลา:</label>
    <input type="time" id="timeInput" name="timeInput" >
		</div>
            <br>
		

			<button type="submit" name="summit" class="btn btn-primary" href ='receipt.php'>ยืนยัน</button>
            <a href="index2.php" class="btn btn-secondary">กลับหน้าหลัก</a>
            
        </form>
    </div>
</section>
</body>
</html>
