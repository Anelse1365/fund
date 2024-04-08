<?php
// เรียกไฟล์การกำหนดค่าของฐานข้อมูล
require_once '../config2/db2.php';

// เริ่มเซสชัน
session_start();

// ตรวจสอบสถานะการเข้าสู่ระบบ
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location:../signin2.php');
    exit; // ออกจากสคริปต์หลังจากเปลี่ยนเส้นทาง
}

// ดึงข้อมูลสำหรับกราฟแท่งจากฐานข้อมูล
$sqlChartData = "SELECT p.name, SUM(p.sold) AS sold 
                 FROM products p
                 GROUP BY p.name";
$stmtChartData = $conn->prepare($sqlChartData);
$stmtChartData->execute();
$chartData = $stmtChartData->fetchAll(PDO::FETCH_ASSOC);

// แปลงข้อมูลเป็นรูปแบบ JSON
$chartDataJSON = json_encode($chartData);

// แสดงข้อมูลในรูปแบบ JavaScript
echo '<script>console.log(' . json_encode($chartData) . ');</script>';
echo '<script>var chartData = ' . $chartDataJSON . ';</script>';

// ดึงจำนวนผู้ป่วย
$sqlPatient = "SELECT COUNT(*) as patientCount FROM patien";
$stmtPatient = $conn->prepare($sqlPatient);
$stmtPatient->execute();
$resultPatient = $stmtPatient->fetch(PDO::FETCH_ASSOC);
$patientCount = $resultPatient['patientCount'];

// ดึงจำนวนการนัดหมาย
$sqlAppointment = "SELECT COUNT(*) as appointmentCount FROM appointmen";
$stmtAppointment = $conn->prepare($sqlAppointment);
$stmtAppointment->execute();
$resultAppointment = $stmtAppointment->fetch(PDO::FETCH_ASSOC);
$appointmentCount = $resultAppointment['appointmentCount'];

// จำนวนยอดขายทั้งหมดที่มีสถานะ order_status เท่ากับ 2
$sqlTotalSales = "SELECT SUM(total_price) as totalSales FROM order2 WHERE order_status = 2";
$stmtTotalSales = $conn->prepare($sqlTotalSales);
$stmtTotalSales->execute();
$totalSales = $stmtTotalSales->fetchColumn();

// ดึงชื่อผู้ใช้ที่เข้าสู่ระบบ
if (isset($_SESSION['admin_login'])) {
    $user_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ดึงข้อมูลสำหรับกราฟแท่งแสดงยอดขายรายวัน
$sqlChartData = "SELECT DATE_FORMAT(created_at, '%b %e') AS date, SUM(total_price) AS total_price 
                 FROM order2 
                 WHERE order_status = 2 
                 GROUP BY DATE_FORMAT(created_at, '%b %e') 
                 ORDER BY created_at ASC";
$stmtChartData = $conn->prepare($sqlChartData);
$stmtChartData->execute();
$chartData = $stmtChartData->fetchAll(PDO::FETCH_ASSOC);

// แสดงข้อมูลในรูปแบบ JSON
echo '<script>console.log(' . json_encode($chartData) . ');</script>';

// ดึงยอดขายรวมทั้งหมด
$sqlTotalRevenue = "SELECT SUM(total_price) as totalRevenue FROM order2 WHERE order_status = 2";
$stmtTotalRevenue = $conn->prepare($sqlTotalRevenue);
$stmtTotalRevenue->execute();
$resultTotalRevenue = $stmtTotalRevenue->fetch(PDO::FETCH_ASSOC);
$totalRevenue = $resultTotalRevenue['totalRevenue'];

// ดึงราคาล่าสุดที่มีสถานะ order_status เป็น 1
$sqlLatestTotalPrice = "SELECT total_price FROM order2 WHERE order_status = 1 ORDER BY created_at DESC LIMIT 1";
$stmtLatestTotalPrice = $conn->prepare($sqlLatestTotalPrice);
$stmtLatestTotalPrice->execute();
$latestTotalPriceResult = $stmtLatestTotalPrice->fetch(PDO::FETCH_ASSOC);
$latestTotalPrice = ($latestTotalPriceResult !== false) ? $latestTotalPriceResult['total_price'] : null;

// ดึงราคาล่าสุดที่มีสถานะ order_status เป็น 2
$sqlLatestTotalPrice = "SELECT total_price FROM order2 WHERE order_status = 2 ORDER BY created_at DESC LIMIT 1";
$stmtLatestTotalPrice = $conn->prepare($sqlLatestTotalPrice);
$stmtLatestTotalPrice->execute();
$latestTotalPriceResult = $stmtLatestTotalPrice->fetch(PDO::FETCH_ASSOC);
$latestTotalPriceValue = ($latestTotalPriceResult !== false) ? $latestTotalPriceResult['total_price'] : null;

// ดึงข้อมูลจากฐานข้อมูลสำหรับกราฟแท่งโดยการระบุช่วงอายุ
$sql = "SELECT p.name, SUM(p.sold) AS sold
        FROM products p
        JOIN order2 o ON p.id = o.product_id
        JOIN patient pt ON o.email = pt.email
        WHERE pt.age BETWEEN :minAge AND :maxAge
        GROUP BY p.name";

// ตรวจสอบว่ามีพารามิเตอร์ minAge และ maxAge หรือไม่
if(isset($_POST['minAge']) && isset($_POST['maxAge'])) {
    // รับค่า minAge และ maxAge
    $minAge = $_POST['minAge'];
    $maxAge = $_POST['maxAge'];

    // เตรียมและ execute คำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':minAge', $minAge, PDO::PARAM_INT);
    $stmt->bindParam(':maxAge', $maxAge, PDO::PARAM_INT);
    $stmt->execute();

    // ดึงข้อมูล
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // แปลงผลลัพธ์เป็น JSON
    echo json_encode($result);

    $sqlAgeData = "SELECT age, total_products FROM order2";
    $stmtAgeData = $conn->prepare($sqlAgeData);
    $stmtAgeData->execute();
    $ageData = $stmtAgeData->fetchAll(PDO::FETCH_ASSOC);
    // สร้างอาร์เรย์เพื่อเก็บข้อมูลอายุและจำนวนสินค้าที่ซื้อ
    $ageProductsData = array();

foreach ($ageData as $row) {
    $age = $row['age'];
    $products = explode(",", $row['total_products']);
    
    if (!isset($ageProductsData[$age])) {
        $ageProductsData[$age] = count($products);
    } else {
        $ageProductsData[$age] += count($products);
    }
}


}
?>  
<?php

// ดึงข้อมูลจำนวนสินค้าที่ขายได้และราคารวมของแต่ละรายการออร์เดอร์
$sqlChartData = "SELECT name, COUNT(*) AS total_orders, SUM(total_price) AS total_price 
                 FROM order2 
                 WHERE order_status = '2' 
                 GROUP BY name";
$stmtChartData = $conn->prepare($sqlChartData);
$stmtChartData->execute();
$chartData = $stmtChartData->fetchAll(PDO::FETCH_ASSOC);

// แปลงข้อมูลเป็นรูปแบบ JSON
$chartDataJSON = json_encode($chartData);

// แสดงข้อมูลในรูปแบบ JavaScript
echo '<script>console.log(' . json_encode($chartData) . ');</script>';
echo '<script>var chartData = ' . $chartDataJSON . ';</script>';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- เรียกใช้งาน Chart.js ที่นี่ -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>

        <script src="//cdn.amcharts.com/lib/4/core.js"></script>
        <script src="//cdn.amcharts.com/lib/4/charts.js"></script>
        <script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>
        

        
        
        
        
             
    </head>
   
  <style>
    body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}

#chartdiv {
    margin-top: 30px;
  width: 100%;
  height: 400px;

  
}
#chartdiv2 {
    margin-top: 30px;
  width: 100%;
  height: 400px;
}

    body {
      padding-top: 56px;
      /* สำหรับ Navbar ด้านบน */
    }

    .sidebar {
      position: fixed;
      top: 56px;
      /* ความสูงของ Navbar ด้านบน */
      bottom: 0;
      left: 0;
      z-index: 100;
      /* จัดการความสูงให้สูงกว่าเนื้อหาหลัก */
      padding: 48px 0;
      /* การเรียงสลับแถบการนำทางและเนื้อหา */
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }





    .sidebar .nav-item {
      margin-bottom: 10px;
      /* เพิ่มระยะห่างด้านล่างของแต่ละ nav-item ไปยัง nav-item ถัดไป */
    }
    body {
  height:97vh;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
    Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }
    #chartdiv3 {
    width: 100%;
    height: 400px;
    max-height: 600px;
    }




  </style>
</head>

<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="main1.php">FUND CLINIC</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                   
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                <li class="nav-item">
            <a class="nav-link" href="#"><?php echo $row['firstname'] . ' ' . $row['lastname']?></a>
          </li>
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>

                        <li><a class="dropdown-item" href="../logout2.php">ออกจากระบบ</a></li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="main1.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="dash_produc.php">Overview</a>
                                    <a class="nav-link" href="dash_product_test.php">TEST</a>
                                    <a class="nav-link" href="order.php">Order</a>
                                    <a class="nav-link" href="../shopping cart/admin.php">Upload</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Info
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="dashb.php">Patient</a>
                                    <a class="nav-link" href="doctorsdash.php">Doctor</a>
                                    <a class="nav-link" href="cilnic_d.php">Cilnic</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="dashbapomen.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Appointment
                            </a>
                            <a class="nav-link" href="finishreceipt.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Receipt
                            </a>
                            <a class="nav-link" href="Report.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Report
                            </a>
                            <a class="nav-link" href="reveiw_dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Review
                            </a>
                        </div>
                    </div>
                    

                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Overview Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Charts</li>
                            
                        </ol>
                        <div class="row">
                        <div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">สินค้าที่มีการสั่งซื้อมากที่สุด
        <?php
            // SQL query to fetch the product with the highest sold count
            $sqlMostSoldProduct = "SELECT name, sold FROM products ORDER BY sold DESC LIMIT 1";
            $stmtMostSoldProduct = $conn->prepare($sqlMostSoldProduct);
            $stmtMostSoldProduct->execute();
            $mostSoldProduct = $stmtMostSoldProduct->fetch(PDO::FETCH_ASSOC);

            // Display the name and the number of sold products
            if ($mostSoldProduct) {
                echo '<div class="h5">' . $mostSoldProduct['name'] . ' (' . $mostSoldProduct['sold'] . ')</div>';
            } else {
                echo '<div class="h5">ไม่มีข้อมูลสินค้า</div>';
            }
            ?>

        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="dash_products2.php">ดูรายละเอียด</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

                            <div class="col-xl-3 col-md-6">
    <div class="card bg-white text-black mb-4">
        <div class="card-body">รายได้ทั้งหมด
            <?php
            // ตรวจสอบว่ามีรายได้ทั้งหมดหรือไม่
            if ($totalRevenue !== null) {
                echo '<div class="h4">' . number_format($totalRevenue, 2) . ' บาท</div>';
            } else {
                echo '<div class="h4">ไม่มีรายการสั่งซื้อ</div>';
            }
            ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="#"></a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">รายได้ล่าสุด
            <?php
            // ตรวจสอบว่ามีข้อมูล total_price ล่าสุดหรือไม่
            if ($latestTotalPriceValue !== null) {
                echo '<div class="h4">' . number_format($latestTotalPriceValue, 2) . ' บาท</div>';
            } else {
                echo '<div class="h4">ไม่มีรายการสั่งซื้อ</div>';
            }
            ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="order_yes.php">ดูการยืนยันสินค้า</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
                            <div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">คำสั่งซื้อที่ยังไม่ได้ยืนยัน
            <?php
            // ตรวจสอบว่ามีข้อมูล total_price ล่าสุดหรือไม่
            if ($latestTotalPrice !== null) {
                echo '<div class="h4">' . number_format($latestTotalPrice, 2) . ' บาท</div>';
            } else {
                echo '<div class="h4">ไม่มีรายการสั่งซื้อ</div>';
            }
            ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="order.php">ยืนยัน Order</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
                        </div>
                        <!-- <div class="card mb-4">
                            
                            
                            
                        </div> -->

    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                รายชื่อลูกค้าในระบบ
                            </div>
                            <div id="chartdiv3"></div>
                            <!-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div> -->
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div>
           

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">

                            <div>

                                <a href="dash_products2.php">Back</a>
                                &middot;
                               
                                
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- แสดงข้อมูลในรูปแบบ JavaScript -->
<script>
var ageData = <?php echo $ageDataJSON; ?>;
</script>
            

     
      </script>
      <script>
chart.data = <?php echo json_encode($ageProductsData); ?>;
</script>



      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
        <script src="assets/demo/chart-pie-demo2.js"></script>
        <script src="assets/demo/barchart.js"></script>
        
        
        
        
</body>

</html>