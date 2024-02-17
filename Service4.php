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
							<h2>ถอนฟัน คืออะไร</h2>
							<img src="img/section-img.png" alt="#">
							<p>ถอนฟัน คือ การนำฟันออกจากเบ้าในกระดูกขากรรไกร ถือเป็นหนึ่งในทางเลือกสุดท้ายของคุณหมอ ซึ่งใช้ในกรณีที่มีเหตุผลซึ่งไม่สามารถจะเก็บฟันธรรมชาติไว้ใช้งานได้ การถอนฟันมีทั้งแบบธรรมดาซึ่งใช้ในถอนซี่ที่โผล่พ้นเหงือกมาแล้ว และการถอนฟันรวมกับการผ่าตัดหรือที่เราคุ้นชินกับคำว่า ผ่าฟันคุด โดยนับเป็นหนึ่งในทันตกรรมที่หลายคนต้องเคยทำสักครั้งหนึ่งของชีวิต สามารถอ่านบทความ ข้อควรรู้ ผ่าฟันคุด ถอนฟันคุด ฟันจะถูกถอนโดยทันตแพทย์ทั่วไป หรือศัลยแพทย์ช่องปาก ซึ่งจะฉีดยาชาให้กับบริเวณรอบฟัน เพื่อลดความเจ็บปวด และความรู้สึกไม่สบาย หลังเสร็จแล้วคุณจะได้รับคำแนะนำเกี่ยวกับวิธีการดูแลแผลถอนฟัน และการปฏิบัติตัวเพื่อลดความเสี่ยงของภาวะแทรกซ้อน	</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<img src="img/nn01.jpg" alt="#" height="480" width="480">
							<br><br>
							<h2>อาการแบบใดที่ทำให้ต้องถอนฟัน?</h2>
							<img src="img/section-img.png" alt="#">
							<p>ฟันธรรมชาติ ชื่อฟันชุดที่ดีที่สุดที่คุณจะมีได้ คุณหมอจะพยายามใช้หัตถการทางทันตกรรมอื่นๆ เพื่อหลีกเลี่ยงการถอนฟัน และช่วยให้คุณสามารถเก็บฟันธรรมชาติไว้ใช้งานได้ อย่างไรก็ตามในบางกรณีคุณหมอก็มีความจำเป็นต้องถอนฟันของคุณออก ได้แก่
                                <br>
								ฟันผุ
								<br>
                                ฟันที่ผุ หรือติดเชื้อมากเกินกว่าจะรักษาด้วยการ อุดฟัน ครอบฟัน หรือ รักษารากฟัน เป็นหนึ่งในเหตุผลที่คุณจำเป็นต้องถอนฟัน
                                <br>							
								ฟันซ้อน
								<br>
								เมื่อขากรรไกรมีพื้นที่ไม่เพียงพอสำหรับฟันทุกซี่ของคุณ ก็อาจส่งผลให้เกิดฟันซ้อนได้ หากเข้ารับการ จัดฟัน ในบางกรณีคุณอาจต้องถอนฟันเพื่อให้ฟันที่เหลือมีพื้นที่พอสำหรับการเรียงฟันให้อยู่ในตำแหน่งที่เป็นระเบียบและสวยงาม
							    <br>
								ฟันคุด
								<br>
								ฟันกรามที่ขึ้นไม่เต็มที่ อาจต้องถอนออกเพื่อป้องกันการติดเชื้อ หรือเนื้อเยื่อโดยรอบ
								<br>
								อุบัติเหตุ
								<br>
								ฟันที่หักจนไม่สามารถบูรณะขึ้นมาใหม่ได้
								<br>
								ฟันที่มีพยาธิสภาพ
								<br>
								เช่นมีถุงน้ำ (Cyst) หรือเนื้องอก
							</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<h2>ก่อนถอนฟัน เตรียมตัวอย่างไรดี</h2>
							<img src="img/section-img.png" alt="#">
							<p>การจัดฟันสามารถช่วยแก้ไขปัญหาการเรียงตัว และการสบฟันที่ผิดปกติแบบใดได้บ้าง
                                <br>
                                <br>
								1.แจ้งคุณหมอเกี่ยวกับโรคประจำตัว รวมทั้งยาทั้งหมดที่คุณรับประทานอยู่ โดยเฉพาะยาที่ส่งผลต่อการแข็งตัวของเลือด เช่น Aspirin, Clopidogrel (Plavix), Warfarin เป็นต้น
								<br>
								2.หากคุณมีโรคเกี่ยวลิ้นหัวใจ หรือเคยเปลี่ยนลิ้นหัวใจมาก่อน คุณหมออาจแนะนำให้คุณรับประทานยาปฎิชีวนะ (Amoxicillin) ก่อนเข้ารับการถอนฟัน – กรุณาปฎิบัติตามอย่างเคร่งครัด
								<br>
								3.โดยปกติแล้วคุณไม่จำเป็นต้องหยุดยาประจำตัวก่อนถอนฟัน อย่างไรก็ตามในบางกรณี ทันตแพทย์อาจส่งปรึกษาแพทย์ประจำตัวของคุณเพื่อพิจารณาหยุดยาที่ส่งผลต่อการแข็งตัวของเลือด
								<br>
								4.หากคุณมีความดันโลหิต หรือระดับน้ำตาลที่สูง และยังไม่สามารถควบคุมได้ ทันตแพทย์อาจเลื่อนการถอนฟันออกไปก่อน และส่งตัวปรึกษาแพทย์ประจำตัวของคุณเพื่อปรับยาให้สามารถควบคุมโรคได้ดีก่อนเข้ารับการถอนฟัน
								<br>
								5.วางแผนการเดินทางกลับไปพักผ่อนที่บ้านหลังถอนฟัน หากคุณมีครอบครัว หรือเพื่อนมาขับรถรับส่งให้ก็จะดีมาก
							    <br>
								6.สวมใส่เสื้อผ้าหลวมๆ สบายๆ มาในวันนัดถอดฟัน
								<br>
								7.นอนหลับพักผ่อนให้เพียงพอ และหากไม่ได้รับคำแนะนำให้งดอาหาร คุณสามารถทานอาหารได้ตามปกติ แต่ควรบ้วนปาก แปรงฟันให้เรียบร้อยก่อนถึงเวลานัด
								<br>
								8.หากเป็นไปได้เราอยากให้คุณหยุดลาพักผ่อนอยู่บ้านสัก 1-2 วันก่อนกลับไปทำงาน หรือลองให้เราหาคิวนัดคุณหมอในช่วงวันศุกร์ก็เป็นไอเดียที่ดี
								<br>
								9.ซื้อเจลประคบเย็น พร้อมเตรียมผ้าขนหนูเอาไว้ประคบเย็น
								<br>
								10.เตรียมของที่รับประทานง่ายไว้ในตู้เย็น เช่น ซุป ข้าวต้ม โจ๊ก โยเกิร์ต
							</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<h2>ขั้นตอนการถอนฟัน</h2>
							<img src="img/section-img.png" alt="#">
							<p>1.คุณจะได้รับการวัดความดันโลหิต ซักประวัติเพิ่มเติม เพื่อเตรียมตัวให้พร้อม</p>
                            <br>
							<p>2.คุณหมอจะฉีดยาชาในบริเวณฟันซี่ที่ต้องการจะถอน</p>
							<br>
							<p>3.โดยปกติแล้วฟันของคุณจะถูกห่อหุ้มอยู่อย่างแน่นหนาในเบ้ากระดูก คุณหมอจะใช้เครื่องมือพิเศษยกฟันของคุณขึ้น และโยกไปมาเพื่อให้มีพื้นที่ในการนำฟันออก</p>
							<br>
							<p>4.ถึงแม้ว่าจะได้รับยาชาแต่คุณอาจรู้สึกตึงๆ ได้เล็กน้อยในขั้นตอนนี้ แต่หากคุณรู้สึกเจ็บ คุณสามารถบอกกับคุณหมอได้ตลอดเวลา ซึ่งคุณอาจต้องได้รับการฉีดยาชาเพิ่ม</p>
							<br>
							<p>5.เมื่อฟันถูกดึงออกไปแล้ว คุณหมอจะทำความสะอาดเบ้าฟัน ตกแต่งขอบกระดูกที่แหลมคม หากแผลมีขนาดเล็กคุณอาจไม่ต้องเย็บแผลก็ได้</p>
							<br>
							<p>6.เพื่อหยุดเลือดออก คุณหมอจะวางผ้าก็อซและให้คุณกัดลงมาบนผ้าก็อซ คุณจะได้รับน้ำแข็งหรือเจลเย็นสำหรับประคบที่แก้มเพื่อลดอาการบวม หลังจากนั้นคุณจะได้รับคำแนะนำในการปฏิบัติตัว และการดูแลแผลถอนฟัน</p>
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
							<h2>ข้อปฏิบัติหลังถอนฟัน</h2>
							<img src="img/section-img.png" alt="#">							
							<p><strong>การดูแลแผลถอนฟัน</strong></p>
						
							<p>1.กัดผ้าก็อซเป็นเวลาอย่างน้อย 45 นาที หากยังมีเลือดออกคุณสามารถเปลี่ยนผ้าก็อซอันใหม่แล้วกัดต่ออีก 30-45 นาที</p>
														
							<p>2.หากมีน้ำลาย หรือเลือด ระหว่างกัดก๊อซ ให้กลืนลงคอ อย่าบ้วนออก</p>
												
							<p>3.ห้ามรบกวนแผล ห้ามใช้ลิ้นดุนแผล ไม่ควรดูดน้ำลายหรือเลือดจากผ้าก๊อซ</p>
													
							<p>4.หากมีลิ่มเลือดปกคลุมด้านบนแผล ห้ามบ้วน หรือหยิบออก เพราะอาจทำให้เลือดออกซ้ำได้</p>
							<br>

							<p><strong>ประคบเย็นลดอาการบวม</strong></p>
							

							<p>1.คุณสามารถใช้เจลเย็น หรือน้ำแข็งห่อผ้าชุบน้ำหมาดๆ ประคบที่ด้านนอกของแก้มฝั่งที่ถอนฟันเพื่อลดอาการบวม</p>
							<p>2.เปลี่ยนเจล หรือน้ำแข็งทุก 15 นาที และทำต่อเนื่องประมาณ 24 ชม.</p>
							<p>3.หลัง 24 ชม. หากคุณมีรอยช้ำ หรือยังปวดตึงอยู่ คุณสามารถประคบอุ่นต่อได้ (ห้ามใช้น้ำเดือด หรือประคบถุงอุ่นโดยตรงกับผิวแก้ม ให้ห่อผ้าทุกครั้ง)</p>
							<br>
							<p><strong>การดูแลความสะอาด</strong></p>
							<p>1.หากไม่มีเลือดออก คุณสามารถแปรงฟันซี่อื่นๆ ได้ แต่หลีกเลี่ยงบริเวณแผล</p>
							<p>2.หลัง 24 ชม. เป็นต้นไป คุณสามารถผสมเกลือครึ่งช้อนชากับน้ำอุ่น 1 แก้วสำหรับบ้วนปากได้</p>
							<p>3.หลัง 24 ชม. เป็นต้นไป คุณสามารถผสมเกลือครึ่งช้อนชากับน้ำอุ่น 1 แก้วสำหรับบ้วนปากได้</p>
							<br>
							<p><strong>อาหาร</strong></p>
							<p>1.เลือกรับประทานที่ทานง่ายในช่วง 2-3 วันแรก</p>
							<p>2.ควรดื่มน้ำปริมาณมากขึ้น (อย่างน้อย 6-8 แก้วต่อวัน)</p>
							<p>3.เลี่ยงการใช้หลอดดูดน้ำใน 24 ชม. แรก</p>
							<br>
							<p><strong>คำแนะนำอื่นๆ</strong></p>
							<p>1.คุณสามารถรับประทานยาแก้ปวดเช่น Paracetamol หรือ ibuprofen ได้ (กรุณาตรวจสอบประวัติแพ้ยาของคุณให้ดีก่อน)</p>
							<p>2.งดออกกำลังกายอย่างน้อย 3-5 วัน (เนื่องจากคุณรับประทานอาหารได้น้อย คุณจึงได้รับแคลอรี่น้อยกว่าปกติ)</p>
							<p>3.งดสูบบุหรี่อย่างน้อย 1 สัปดาห์ เนื่องจากรบกวนกระบวนการหายของแผล</p>
							<p>4.แก้ไขริมฝีปากแห้งด้วย Lips Balm หรือ Moisture</p>
							<p>5.มาพบคุณหมอตามนัด</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<br>
							<h2>ปัญหาที่พบได้บ่อยภายหลังการถอนฟัน</h2>
							<img src="img/section-img.png" alt="#">							
							<p>การถอนฟัน ถือเป็นหัตถการทางทันตกรรมที่มีโอกาสเกิดผลข้างเคียงได้ ปัจจัยเช่น ฟันมีความซับซ้อนอยู่ในตำแหน่งลึกทำงานยาก มีพยาธิสภาพอย่างอื่นเช่น Cyst ก้อนเนื้อ หรือผู้ป่วยมีโรคประจำตัว หรือรับประทานยาที่ส่งผลต่อการแข็งตัวของเลือด จะเพิ่มโอกาสในการเกิดผลข้างเคียงตามมา

								คุณหมอได้รบรวมปัญหาพบบ่อยที่คุณอาจเจอได้หลังจากถอนฟัน หากคุณสงสัยว่าคุณกำลังประสบปัญหาเหล่านี้ กรุณาติดต่อเจ้าหน้าที่ของเราในทันที</p>
								<p><strong>1.ปัญหาเลือดออก (Hemorrhage)</strong></p>
								
								<p>-หลังถอนฟันเป็นปกติที่คุณจะมีเลือดออกได้ – เราแนะนำให้คุณกัดผ้าก็อซ และสามารถเปลี่ยนได้เรื่อยๆ ทุก 45-60 นาที</p>
								<p>-อย่างไรก็ตามเลือดควรจะออกลดลงเรื่อยๆ และหยุดภายในเวลาไม่เกิน 6 ชม.</p>
								<p>-หากคุณมีเลือดออกปริมาณมาก หรือเลือดออกไม่หยุดหลัง 6 ชม. หรือมีอาการหน้ามืด เหงื่อแตก ใจสั่น เป็นลม กรุณารีบติดต่อเจ้าหน้าที่ของเรา</p>
							<br>
							<p><strong>2.การติดเชื้อหลังถอนฟัน (Post operative infection)</strong></p>
								
								<p>-การติดเชื้อมักเกิดขึ้นในวันที่ 3-4 หลังจากถอนฟันไปแล้ว อาการประกอบด้วย มีไข้ ปวดบวมแดงร้อนบริเวณแก้มด้านที่ถอนฟัน</p>
								<p>-หากมีการติดเชื้อคุณอาจต้องรับประทานยาปฎิชีวนะ และนัดติดตามอาการกับคุณหมออย่างใกล้ชิด</p>
							<br>							
							<p><strong>3.กระดูกเบ้าฟันอักเสบ (Dry Socket)</strong></p>
								
								<p>-ภาวะนี้เกิดขึ้นเมื่อลิ่มเลือดที่ก่อตัวด้านบนแผล หลุดหรือละลายออกเร็วเกินไป ทำให้ไม่มีอะไรปกคลุมเบ้ากระดูกและเส้นประสาทด้านล่าง</p>
								<p>-Dry Socket มักเกิดในวันที่ 3-4 หลังจากถอนฟัน อาการคือมีปวดมาก อาจปวดร้าวขึ้นศีรษะ หรือมีกลิ่นปากที่เหม็นรุนแรง</p>
							<br>							
							<p><strong>4.อ้าปากได้จำกัด (Trismus)</strong></p>
								
								<p>-อาการอ้าปากได้จำกัดเกิดจากการอักเสบของกล้ามเนื้อที่ใช้บดเคี้ยว มักพบในการถอนฟัน หรือผ่าฟันคุด หรือมีการฉีดยาชาบล๊อคเส้นประสาทส่วนปลายที่ขากรรไกรเพื่อลดความเจ็บปวดระหว่างถอนฟัน</p>
								<p>-การรักษาคือการกายภาพบำบัด ร่วมกับการใช้น้ำอุ่นประคบกล้ามเนื้อด้านนอก และอมน้ำเกลืออุ่นบ่อยๆ หากมีการติดเชื้อร่วมด้วย คุณอาจต้องรับประทานยาปฎิชีวนะเพิ่มเติม</p>
								<br>
								<p><strong>5.อาการชา</strong></p>
								
								<p>-เส้นประสาทส่วนปลายอาจได้รับความเสียหายในระหว่างการถอนฟัน ซึ่งสามารถทำให้เกิดอาการชาตามที่ต่างๆ เช่น ริมฝีปาก ลิ้น หรือ คาง</p>
								<p>-อาการชาหลังถอนฟันเป็นภาวะที่พบได้น้อย และมักเป็นอยู่เพียงชั่วคราวเท่านั้น </p>
													
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