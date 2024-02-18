<?php 

    session_start();
    require_once 'config2/db2.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin2.php');

    }
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

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
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- css2 ของ userProfile.html -->
    <link rel="stylesheet" href="css2.css"> 
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .profile-image {
            max-width: 200px;
            border-radius: 50%;
        }

        .user-info {
            margin-top: 20px;
        }

        .appointment-info,
        .appointment-history {
            margin-top: 20px;
        }

        .appointment-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .appointment-table th, .appointment-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .appointment-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
<?php 

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>



    <!-- Header Area -->
		<header class="header" >
			<!-- Topbar -->
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-5 col-12">
							<!-- Contact -->
							
							<!-- End Contact -->
						</div>
						<div class="col-lg-6 col-md-7 col-12">
							<!-- Top Contact -->
							<ul class="top-contact">
								<li><i class="fa fa-phone"></i>+880 1234 56789</li>
								<li><i class="fa fa-envelope"></i><a href="mailto:FanD@gmail.com">FunD@gmail.com</a></li>
							</ul>
							<!-- End Top Contact -->
						</div>
					</div>
				</div>
			</div>
            <!-- End Topbar -->
            <!-- Header Inner -->
			<div class="header-inner">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="index.html"><img src="      img/Fun D Logo2.png " alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-8 col-md-10 col-13">
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
                                                    <li><a href="Service1.php">การดัดฟัน</a></li> <br>
													<li><a href="Service2.php">การขูดหินปูน</a></li> <br>
													<li><a href="Service3.php">การรักษารากฟัน</a></li> <br>
													<li><a href="Service4.php">การถอนฟันรักษาช่องปาก</a></li> <br>
													<li><a href="Service5.php">ทันตกรรมรากเทียม</a></li> <br>
													<li><a href="Service6.php">ทันตกรรมสำหรับเด็ก</a></li> <br>
												
												</ul>


												<li><a href="revio.php">รีวิว<i ></i></a>
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
		<!-- End Header Area -->

        
    </head>
    <body>
        <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>


<div class="student-profile py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                        <h3><?php echo $row['firstname'] . ' ' . $row['lastname']?> </h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><strong class="pr-1">ชื่อ-นามสกุล:</strong><?php echo $row['firstname'] . ' ' . $row['lastname']?> </p>
                        <p class="mb-0"><strong class="pr-1">อีเมล:</strong><?php echo $row['email'] ?> </p>
                        <p class="mb-0"><strong class="pr-1">เบอร์มือถือ:</strong><?php echo $row['phone_number'] ?></p>
                        <p class="mb-0"><strong class="pr-1">เพศ:</strong><?php echo $row['gender'] ?></p>
                        <p class="mb-0"><strong class="pr-1">อายุ:</strong><?php echo $row['age'] ?></p>
                        <p class="mb-0"><strong class="pr-1">สัญชาติ:</strong><?php echo $row['nationality'] ?></p>
                        <p class="mb-0"><strong class="pr-1">ที่อยู่:</strong><?php echo $row['address'] ?></p>
                        <br>
                        <hr class="mt-1 mb-6">
                        <p class="mb-0"><strong class="pr-1">แต้มสะสม:</strong><?php echo $row['Poin'] ?> P</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>ข้อมูลการนัดจองทำฟัน</h3>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">วันที่</th>
                                <td width="2%">:</td>
                                <td>05/01/2024</td>
                            </tr>
                            <tr>
                                <th width="30%">เวลา </th>
                                <td width="2%">:</td>
                                <td>10:00 AM</td>
                            </tr>
                            <tr>
                                <th width="30%">หมายเหตุ</th>
                                <td width="2%">:</td>
                                <td>ตรวจสุขภาพช่องปาก</td>
                            </tr>
                            <tr>
                                <th width="30%">สาขา</th>
                                <td width="2%">:</td>
                                <td>พิษณุโลก</td>
                            </tr>
                            <tr>
                                <th width="30%">ทันตเเพทย์>
                                <td width="2%">:</td>
                                <td>หมอA</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="height: 26px"></div>
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>ประวัติการนัดจอง</h3>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">วันเมื่อวันที่</th>
                                <td width="2%">:</td>
                                <td>05/01/2024</td>
                            </tr>
                            <tr>
                                <th width="30%">เวลา </th>
                                <td width="2%">:</td>
                                <td>10:00 AM</td>
                            </tr>
                            <tr>
                                <th width="30%">หมายเหตุ</th>
                                <td width="2%">:</td>
                                <td>ตรวจสุขภาพช่องปาก</td>
                            </tr>
                            <tr>
                                <th width="30%">สาขา</th>
                                <td width="2%">:</td>
                                <td>พิษณุโลก</td>
                            </tr>
                            <tr>
                                <th width="30%">ทันตเเพทย์>
                                <td width="2%">:</td>
                                <td>หมอA</td>
                            </tr>
                        </table>
                        <!-- Pagination กดเปลี่ยนหน้า -->
                        
                        <ul class="pagination mt-3" >
                            <li class="page-item"><a class="page-link" href="#">ก่อนหน้า</a></li>
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item"><span class="page-link">2</span></li>
                            <li class="page-item"><a class="page-link" href="#">ถัดไป</a></li>
                        </ul>
               
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
</div>
</div>

        
        

</body>
</html>
