<?php 

    session_start();
    require_once 'config2/db2.php';
	?>



<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="Site keywords here">
	<meta name="description" content="">
	<meta name='copyright' content=''>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title -->
	<title>FunD DoctorA</title>

	<!-- Favicon -->
	<link rel="icon" href="img/logo5.png">

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
		rel="stylesheet">

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

	<!-- ส่วนเสริม Doctor เริ่ม-->
	<link href="css/bootstrap_doctor.css" rel="stylesheet" />
	<link href="css/bootstrap-responsive_doctor.css" rel="stylesheet" />
	<link href="css/prettyPhoto_doctor.css" rel="stylesheet" />
	<link href="css/animate_doctor.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic|Roboto+Condensed:400,300,700"
		rel="stylesheet" />

	<link href="css/style_doctor.css" rel="stylesheet" />
	<link href="assets/color/default.css" rel="stylesheet" />

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- ส่วนเสริม Doctor จบ-->


		<style>
			.nav-link.dropdown-toggle {
				display: flex;
				align-items: center;
			}
		
			.img-profile {
				width: 30px; /* Adjust the width as needed */
				height: 30px; /* Adjust the height as needed */
				margin-right: 5px; /* Adjust the margin as needed for spacing between text and image */
			}


		
			
    .btn btn-primary {
        display: flex;
        justify-content: center;
    }
	.eimoji {
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	margin: auto;
	display: flex;
	justify-content: center;
	align-items: center;
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
$stmt = $conn->query("SELECT * FROM doctors");
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
		
	
		<!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>

                <div class="indicator"> 
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
     
		
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
								<li><i class="fa fa-envelope"></i><a href="mailto:FanD@gmail.com">FanD@gmail.com</a></li>
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
									<a href="index.html"><img src="img/Fun D Logo2.png" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
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
		<!-- End Header Area -->
	

		<body>
			<style>
				#about {
				  margin-top: -50px; /* Adjust the value as needed */
				}

				/* ปรับความสูงของ textarea */
				#review-text textarea {
				width: 100%;
				height: 50px; /* ปรับความสูงตามที่คุณต้องการ */
				resize: vertical;
				}
			  </style>
			  
			<!-- section intro -->
			<!-- <section id="intro">
				<div class="slogan">
				  <div class="icon">
					<i class="icon-beaker icon-10x"></i>
				  </div>
				  <h1>Welcome to <span>our doctor</span></h1>
				  <h2>Information about our doctor</h2>
				</div>
			  </section> -->
			  <!-- end intro -->
			  <!-- Section about -->


              <section id="about" class="section">
                <div class="container">
                  <div class="row">
                    <div class="span12">
                      <div class="heading">
                        <h3><span>Our Doctor</span></h3>
                      </div>
                      <div class="sub-heading">
                        <p>
                          We have a history of doing what our name implies, creating a visual language around the beliefs of the brands we work with.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- หมอพิษณุโลก Start -->
                  <div class="row">
                    <div class="span2">
                      <img src="img/team1.jpg" alt="" class="img-polaroid" />
                      
                      <div class="roles">
                            <a href="doctorA.html"><h5><strong>Doctor A (หมอเอ)</strong></h5></a>
                        <p>
                          ทันตแพทย์ชำนาญการพิเศษ
                        </p>
                        <!-- <ul class="social-profile"> -->
                          <!-- <li><a href="doctorA.html"><i class="icon-folder-open icon-32 icon-circled"></i></a></li>
                          <li><a href="#"><i class="icon-twitter icon-32 icon-circled"></i></a></li>
                          <li><a href="#"><i class="icon-linkedin icon-32 icon-circled"></i></a></li> -->
                        <!-- </ul> -->
                      </div>
                    </div>
                    <div class="span2">
                        <img src="img/team2.jpg" alt="" class="img-polaroid" />
                        <div class="roles">
                            <a href="doctorB.html"><h5><strong>Doctor B (หมอบี)</strong></h5></a>
                          <p>
                            ทันตแพทย์ชำนาญการ
                          </p>
                          <!-- <ul class="social-profile">
                            <li><a href="#"><i class="icon-facebook icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-twitter icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin icon-32 icon-circled"></i></a></li>
                          </ul> -->
                        </div>
                      </div>
                      <div class="span2">
                        <img src="img/team3.jpg" alt="" class="img-polaroid" />
                        <div class="roles">
                            <a href="doctorC.html"><h5><strong>Doctor C (หมอซี)</strong></h5></a>
                          <p>
                            ทันตแพทย์
                          </p>
                          <!-- <ul class="social-profile">
                            <li><a href="#"><i class="icon-facebook icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-twitter icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin icon-32 icon-circled"></i></a></li>
                          </ul> -->
                        </div>
                      </div>
                      <!-- หมอพิษณุโลก End -->
        
                      <!-- หมอกำแพงเพชร Start -->
                      <div class="span2">
                        <img src="img/team4.jpg" alt="" class="img-polaroid" />
                        <div class="roles">
                            <a href="doctorD.html"><h5><strong>Doctor D (หมอดี)</strong></h5></a>
                          <p>
                            ทันตแพทย์ชำนาญการพิเศษ
                          </p>
                          <!-- <ul class="social-profile">
                            <li><a href="#"><i class="icon-facebook icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-twitter icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin icon-32 icon-circled"></i></a></li>
                          </ul> -->
                        </div>
                      </div>
        
                      <div class="span2">
                        <img src="img/team5.jpg" alt="" class="img-polaroid" />
                        <div class="roles">
                            <a href="doctorE.html"><h5><strong>Doctor E (หมออี)</strong></h5></a>
                          <p>
                            ทันตแพทย์ชำนาญการ
                          </p>
                          <!-- <ul class="social-profile">
                            <li><a href="#"><i class="icon-facebook icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-twitter icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin icon-32 icon-circled"></i></a></li>
                          </ul> -->
                        </div>
                    </div>
        
                    <div class="span2">
                        <img src="img/team6.jpg" alt="" class="img-polaroid" />
                        <div class="roles">
                            <a href="doctorF.html"><h5><strong>Doctor F (หมอเอฟ)</strong></h5></a>
                          <p>
                            ทันตแพทย์
                          </p>
                          <!-- <ul class="social-profile">
                            <li><a href="#"><i class="icon-facebook icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-twitter icon-32 icon-circled"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin icon-32 icon-circled"></i></a></li>
                          </ul> -->
                        </div>
                    </div>
                </section>
                <!-- end section about-->


				<div class="container">
        <form action="submit_review.php" method="post" >
            <div class="form-group">
                <label for="doctor_name">เลือกหมอ:</label>
                <select class="form-control" name="doctor_name" required>
				<option value="">โปรดเลือกหมอ</option>
                    <!-- วนลูปแสดงรายชื่อหมอ -->
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['first_name']; ?>"><?php echo $doctor['first_name'] . " " . $doctor['last_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

		

			<div class="form-group">
    <label for="name">ชื่อ:</label>
    <input type="text" class="form-control" name="patient" value="<?php echo $row['firstname'] . ' ' . $row['lastname']?>" required> 
</div>

            <div class="form-group">
                <label for="rating">คะแนน:</label>
                <input type="number" class="form-control" name="rating" min="1" max="10" required>
            </div>

            <div class="form-group">
                <label for="comment">ความคิดเห็น:</label>
                <textarea class="form-control" name="comment" rows="4" required></textarea>
            </div>
			<label for="name">Email:</label>
    <input type="text" class="form-control" name="email" value="<?php echo $row['email']?>" required> 
</div>
			

    <button type="submit" class="btn btn-primary "  onclick="goBack()">ส่งรีวิว</button>
	<script>
	function goBack() {
  	window.history.back();
	}
	</script>
        </form>
    </div>


		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>About Us</h2>
								<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut labore dolore magna.</p>
								<!-- Social -->
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
									<li><a href="#"><i class="icofont-google-plus"></i></a></li>
									<li><a href="#"><i class="icofont-twitter"></i></a></li>
									<li><a href="#"><i class="icofont-vimeo"></i></a></li>
									<li><a href="#"><i class="icofont-pinterest"></i></a></li>
								</ul>
								<!-- End Social -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Quick Links</h2>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Cases</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Other Links</a></li>	
										</ul>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Consuling</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Finance</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Testimonials</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>	
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>เวลาทำการ</h2>
								<p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.</p>
								<ul class="time-sidual">
									<li class="day">วันจันทร์ - วันศุกร์ <span>10.00-20.00</span></li>
									<li class="day">Saturday <span>9.00-18.30</span></li>
									<li class="day">วันเสาร์ - วันอาทิตย์ <span>13.00-19.00</span></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Newsletter</h2>
								<p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
								<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
									<input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Your email address'" required="" type="email">
									<button class="button"><i class="icofont icofont-paper-plane"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright 2018  |  All Rights Reserved by <a href="https://www.wpthemesgrid.com" target="_blank">wpthemesgrid.com</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
		<!--/ End Footer Area -->\
		<!-- jquery Min JS -->
        <script src="js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="js/easing.js"></script>
		<!-- Color JS -->
		<script src="js/colors.js"></script>
		<!-- Popper JS -->
		<script src="js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="js/steller.js"></script>
		<!-- Wow JS -->
		<script src="js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="js/main.js"></script>
		
    </body>
</html>