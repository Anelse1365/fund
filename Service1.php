<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration_system";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
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
        <title>FanD</title>
		
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
		</style>
		
    </head>
    <body>
	
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
											<li class="active"><a href="#">หน้าเเรก</i></a>
												
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


												<li><a href="userReview.php">รีวิว<i ></i></a>
													<ul class="dropdown">
													</ul>


													<li><a href="productsuser.php">สินค้าFund<i ></i></a>
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
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
		<!-- Mid Area -->
		
		<!-- Start Feautes -->
		<section class="Feautes section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<h2>การดัดฟัน</h2>
							<img src="img/section-img.png" alt="#">
							<p>การจัดฟัน หรือ Orthodontics ประกอบไปด้วยรากศัพท์ภาษากรีก 2 คำ คือ ‘Orthos’ ซึ่งแปลว่า แก้ไข/ให้ตรง ส่วน ‘Dontics’ แปลว่า ฟัน การจัดฟันเป็นทันตกรรมเฉพาะทางแขนงหนึ่ง ที่มุ่งเน้น การวินิจฉัย การป้องกัน และการแก้ไขฟันที่เรียงตัวผิดปกติ รวมถึงปัญหาอื่นๆ เช่น การสบฟัน ตำแหน่งและขนาดของกระดูกขากรรไกร

 

								การดัดฟันมีจุดประสงค์เพื่อการบดเคี้ยวที่มีประสิทธิภาพมากขึ้น ลดฟันสึก รวมทั้งยังทำให้คุณสามารถทำความสะอาดช่องปากได้ดีขึ้น ทำให้ลดโอกาสในการเกิดโรคทางทันตกรรมอื่นๆ และแน่นอนว่ายังช่วยให้คุณมีรอยยิ้มที่สวยงาม ส่งเสริมบุคลิกภาพและความมั่นใจให้กับคุณได้</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<img src="img/nn01.jpg" alt="#" height="480" width="480">
							<br><br>
							<h2>การจัดฟันมีกี่แบบ?</h2>
							<img src="img/section-img.png" alt="#">
							<p>การจัดฟันสามารถแบ่งได้ 2 ประเภทหลัก ดังนี้
                                <br>
								1.การจัดฟันแบบติดเครื่องมือ ได้แก่ ติดเครื่องมือแบบใช้ยาง O-ring เช่น การจัดฟันแบบโลหะ การจัดฟันแบบเซรามิก และการติดเครื่องมือแบบไม่ใช้ยาง (Self-ligating) เช่น การจัดฟันแบบดามอน (Damon)
                                <br>							
								2.การจัดฟันแบบไม่ติดเครื่องมือ เช่น จัดฟันใส Invisalign หรือ ดี-aligner
								<br>
								การเรียนรู้ข้อดีข้อเสียของการจัดฟันในแต่ะละชนิด จะทำให้คุณสามารถตัดสินใจเลือกวิธีการจัดฟันที่เหมาะสมกับ lifestyle และงบประมาณของคุณ วันนี้เรามาเรียนรู้การจัดฟัน และโปรจัดฟันในแต่ละประเภทกันดีกว่า</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<h2>ลักษณะฟันแบบไหนที่ควรจัดฟัน</h2>
							<img src="img/section-img.png" alt="#">
							<p>การจัดฟันสามารถช่วยแก้ไขปัญหาการเรียงตัว และการสบฟันที่ผิดปกติแบบใดได้บ้าง
                                <br>
                                <br>
								1.ฟันซ้อน เอียง หรือ บิด  ปัญหาเหล่านี้เป็นประเด็นหลักที่นำคนไข้เข้ามารับการรักษา หากฟันซ้อนกันมากๆ คุณหมออาจจำเป็นต้อง ถอนฟัน บางซี่ออก มีการตะไบฟัน หรือขยายขากรรไกรเพื่อให้มีพื้นที่ในการเรียงฟัน
								<br>
								2.ฟันห่าง  ปัญหาฟันห่าง สามารถแก้ไขได้ด้วยการจัดฟันเช่นกัน
								<br>
								3.Deep bite หรือ ฟันสบลึก เป็นภาวะที่ฟันบนสบลงมาฟันล่างลึกเกินไป
								<br>
								4.Cross bite หรือ ฟันสบคร่อม เป็นภาวะที่ฟันล่างคร่อมฟันบน
								<br>
								5.Open bite หรือ ฟันสบเปิด เป็นภาวะที่ฟันบนและฟันล่างไม่สามารถสบสัมผัสกันได้ หรือที่เรียกกันว่า ฟันไม่สบกัน</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<h2>สาเหตุที่ทำให้เกิดปัญหาการเรียงตัวของฟัน</h2>
							<img src="img/section-img.png" alt="#">
							<p><strong>1.วิวัฒนาการของมนุษย์</strong></p>
							<p>อาจฟังดูเป็นเรื่องแปลก แต่ถ้าเราย้อนกลับไปเมื่อ 15,000 ปีที่แล้ว จากการศึกษาโครงกระดูกของมนุษย์ เราจะพบว่าบรรพบุรุษของเรานั้นมีฟันที่เรียงตัวดี และแทบไม่มีฟันคุดอยู่เลย ที่เป็นแบบนั้นเพราะขากรรไกรของมนุษย์สมัยก่อนนั้นใหญ่กว่าในปัจจุบัน การปฎิวัติการเกษตร และอุตสาหกรรมทำให้เราปรุงอาหารได้ดีขึ้น มีอุปกรณ์ในการหั่นอาหารเป็นชิ้นเล็กลง ทำให้จำนวนครั้งในการเคี้ยวน้อยลงตามไปด้วย ขนาดของขากรรไกรในมนุษย์จึงหดเล็กลงเรื่อยๆ ทำให้พื้นที่ของฟันน้อยลง แต่จำนวนฟันเท่าเดิม เกิดเป็นการเรียงตัวที่ผิดปกติของฟัน จนต้องลงเอยที่การจัดฟัน</p>
							<br>
							<p><strong>2.ฟันล้ม</strong></p>
							<p>หากคุณเคยถอนฟันมาก่อนและไม่ได้บูรณะทดแทนฟันด้วย รากฟันเทียม สะพานฟัน หรือฟันปลอม ฟันซี่ข้างเคียงก็จะเคลื่อน และล้มเข้ามาในช่องว่างที่เกิดขึ้น</p>
							<br>
							<p><strong>3.โดนฟันคุดดัน</strong></p>
							<p>สาเหตุหนึ่งที่คุณหมอแนะนำให้ถอนฟันคุดออกเพราะ ฟันคุดสามารถดันฟันซี่อื่นให้เอียง หรือขยับมาซ้อนกันได้</p>
							<br>
							<p><strong>4.พฤติกรรมบางอย่าง</strong></p>
							<p>การหย่าขวดนมช้า การดูดนิ้ว ภาวะลิ้นดุนฟัน อาจทำให้การเรียงตัวของฟันผิดปกติ</p>
							
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<img src="img/nn02.jpg" alt="#" height="480" width="480">
							<br><br>
							<h2>ควรจัดฟันดีไหม จัดฟันช่วยแก้ปัญหาอะไรได้บ้าง</h2>
							<img src="img/section-img.png" alt="#">							
							<p>ผู้ป่วยส่วนใหญ่มักคิดว่าการจัดฟันเป็นการแก้ไขปัญหาด้านความสวยงามเพียงอย่างเดียว จริงอยู่ที่การมีฟันทีเรียงตัวสวยนั้น ส่งผลต่อบุคลิกภาพของคุณในทางที่ดีขึ้นได้อย่างแน่นอน แต่สำหรับคุณหมอแล้ว การจัดฟันยังมีประโยชน์ด้านอื่นๆ เพิ่มเติมอีก เช่น</p>
						
							<p>1.ช่วยลดปัญหาทันตกรรมอย่างอื่น เช่น โรคเหงือกอักเสบ หรือ ฟันผุ – ทั้งนี้เนื่องจากฟันที่เรียงตัวเป็นระเบียบนั้นสามารถทำความสะอาดได้ง่าย และทั่วถึงกว่า การจัดฟันจึงช่วยลดปัญหาเหล่านี้ได้</p>
														
							<p>2.ช่วยในการย่อยอาหาร – การสบฟันที่ดีขึ้นสามารถทำให้คุณเคี้ยวอาหารได้ละเอียดกว่า ลดภาระของระบบทางเดินอาหารลง บอกลาอาการท้องอืด ปวดจุกท้อง และลดโอกาสในการเกิดกรดไหลย้อน</p>
												
							<p>3.ลดโอกาสการละลายของกระดูกขากรรไกร – กระดูกขากรรไกรที่ปกติจะได้รับแรงจากฟันที่สบกันเวลาเคี้ยวอาหาร แรงสบฟันจะกระตุ้นการเจริญเติบโตของกระดูกได้</p>
													
							<p>4.ช่วยให้พูดชัดขึ้นได้ – พยัญชนะเช่น ฟ ส ซ หรือตัว S ต้องใช้การออกเสียงผ่านฟัน ซึ่งผู้ที่ฟันเรียงตัวผิดปกติอาจออกเสียงได้ไม่ชัดเจน ซึ่งสามารถแก้ไขได้ด้วยการจัดฟัน</p>

							<p>5.ช่วยลดความอูมของริมฝีปาก – จะยิ่งเห็นชัดเจนในเคสที่มีการถอนฟันร่วมกับการจัดฟัน</p>

							<p>6.เพิ่มความมั่นใจให้กับคุณ – คนไข้ที่จัดฟันเสร็จแล้วมักจะมีความมั่นใจในรอยยิ้มของตัวเอง เป็นเสน่ห์และความสดใสที่ติดตัวคุณไปตลอดชีวิต</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<h2>ข้อดี และ ข้อจำกัดของการจัดฟัน</h2>
							<img src="img/section-img.png" alt="#">							
							<p>ข้อดีในการจัดฟัน</p>
								<p>การจัดฟันมีประโยชน์และข้อดีหลายอย่างดังนี้</p>
								
								<p>1.สุขภาพช่องปากดีขึ้น – ฟันที่เรียงตัวตรง และเป็นระเบียบจะทำให้คุณสามารถรักษาสุขอนามัยของช่องปากได้ดีมากขึ้น และลดความเสี่ยงของโรคเหงือกและฟันผุ</p>
								<p>2.การเคี้ยวและการพูดดีขึ้น – ฟันที่เรียงไม่ตรงอาจมีปัญหาในการสบฟันทำให้ไม่สามารถเคี้ยวอาหารได้ละเอียด หรือมีช่องว่างทำให้ออกเสียงพูดได้ไม่ชัดเจน ซึ่งการจัดฟันสามารถแก้ปัญหาเหล่านี้ได้</p>
								<p>3.ยิ้มสวยมากขึ้น – แน่นอนว่าการจัดฟันสามารถทำให้คุณรู้สึกมั่นใจในรอยยิ้มของตัวเอง</p>
								<p>4.ป้องกันปัญหาทางทันตกรรมในอนาคต – การจัดฟันสามารถแก้ไขฟันที่เก เรียงตัวไม่เหมาะสมซึ่งอาจนำไปสู่ปัญหาทางทันตกรรมที่รุนแรงมากขึ้น เช่น ปวดกราม ปวดหัวเรื้อรัง หรือ ฟันสึก</p>
								<p>5.สุขภาพโดยรวมดีขึ้น – สุขภาพช่องปากมีความเชื่อมโยงอย่างใกล้ชิดกับสุขภาพโดยรวมของคุณ ดังนั้น การปรับปรุงสุขภาพฟันด้วยการรักษาทางทันตกรรมจัดฟัน จะช่วยให้สุขภาพของคุณดีขึ้นด้วย</p>
							<br>
							<p>ข้อจำกัดในการจัดฟัน</p>
							<p>แม้ว่าการจัดฟันจะมีประโยชน์มากมาย แต่ก็มีข้อจำกัดและข้อเสียที่ต้องพิจารณาเช่นกัน</p>
							<br>							
							<p>1.ระยะเวลาในการรักษา – การจัดฟันมักใช้เวลาหลายเดือน หรืออาจจะหลายปีจนกว่าจะเสร็จ ขึ้นอยู่กับความรุนแรงของความผิดปกติในการเรียงตัวของฟัน คุณต้องปฎิบัติตัวตามคำแนะนำของคุณหมอ  และมาตรวจตามนัดอย่างสม่ำเสมอ เพื่อให้การเคลื่อนฟันเป็นไปตามแผนการรักษา</p>
							<p>2.ความเจ็บปวด – คนไข้มักรู้สึกปวดในระหว่างการรักษา โดยเฉพาะอย่างยิ่งในช่วง 3-5 วันแรกของการปรับเครื่องมือจัดฟัน (ในกรณีจัดฟันแบบติดแน่น) หรือการเปลี่ยนชุดเครื่องมือจัดฟันใส</p>
							<p>3.ข้อจำกัดด้านอาหาร – เมื่อจัดฟัน คุณอาจต้องหลีกเลี่ยงอาหารบางชนิด หรือปรับเปลี่ยนประเภทอาหารในระหว่างจัดฟัน เพื่อป้องกันไม่ให้เหล็ก หรืออุปกรณ์จัดฟันเสียหาย ในกรณีจัดฟันแบบใส คุณสามารถถอดเครื่องมือจัดฟันออกได้ขณะรับประทานอาหาร ทำให้ลดข้อจำกัดของตัวเลือกในการรับประทานอาหารลง</p>
							<p>4.ค่าใช้จ่าย – การจัดฟันแต่ละชนิดมีราคาที่แตกต่างกัน คุณควรพิจารณาตัวเลือก และงบประมาณที่เหมาะสมกับคุณ</p>
							<p>5.การเคลื่อนกลับตำแหน่งเดิม – หากไม่ได้ใส่รีเทนเนอร์ (Retainer) หลังจัดฟันเสร็จ ฟันของคุณมีความเสี่ยงในการเคลื่อนกลับตำแหน่งเดิม</p>
							<p>6.สุขอนามัยในช่องปาก – การรักษาความสะอาดในช่องปากเป็นเรื่องท้าทายขึ้น เมื่อมีเหล็กดัดฟัน หรืออุปกรณ์อื่นๆ ในช่องปาก คุณต้องหมั่นแปรงฟัน และใช้ไหมขัดฟันอย่างสม่ำเสมอ</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Feautes -->

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
		<!--/ End Footer Area -->
		
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