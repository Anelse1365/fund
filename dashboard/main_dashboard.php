
<?php 

    session_start();
    require_once '../config2/db2.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location:../signin2.php');
    }

    // Count of Patients
    $sqlPatient = "SELECT COUNT(*) as patientCount FROM patien";
    $stmtPatient = $conn->prepare($sqlPatient);
    $stmtPatient->execute();
    $resultPatient = $stmtPatient->fetch(PDO::FETCH_ASSOC);
    $patientCount = $resultPatient['patientCount'];

    // Count of Appointments
    $sqlAppointment = "SELECT COUNT(*) as appointmentCount FROM appointmen";
    $stmtAppointment = $conn->prepare($sqlAppointment);
    $stmtAppointment->execute();
    $resultAppointment = $stmtAppointment->fetch(PDO::FETCH_ASSOC);
    $appointmentCount = $resultAppointment['appointmentCount'];
    $loggedInUser = $_SESSION['admin_login'];

    $sqlTotalSales = "SELECT SUM(total_price) as totalSales FROM order2";
    $stmtTotalSales = $conn->prepare($sqlTotalSales);
    $stmtTotalSales->execute();
    $totalSales = $stmtTotalSales->fetchColumn();
    $current_page = basename($_SERVER['PHP_SELF']);

    if (isset($_SESSION['admin_login'])) {
      $user_id = $_SESSION['admin_login'];
      $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }


              // SQL query to fetch data from database
  $sql = "SELECT * FROM patien";
  $stmt = $conn->prepare($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 56px; /* สำหรับ Navbar ด้านบน */
    }
    .sidebar {
      position: fixed;
      top: 56px; /* ความสูงของ Navbar ด้านบน */
      bottom: 0;
      left: 0;
      z-index: 100; /* จัดการความสูงให้สูงกว่าเนื้อหาหลัก */
      padding: 48px 0; /* การเรียงสลับแถบการนำทางและเนื้อหา */
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }
    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px); /* สูงของแถบการนำทางลบความสูงของ Navbar ที่ด้านบน */
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto; /* สำหรับเลื่อนแถบการนำทาง */
    }
    .sidebar .nav-link {
      color: #fff;
      padding: 10px 20px; /* กำหนดระยะห่างของ nav-link ด้านบนและด้านล่าง 20px ด้านซ้ายและด้านขวา 10px */
    }
    .sidebar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .main-content {
      margin-left: 240px; /* กว้างของ Sidebar */
      padding: 20px;
    }
    .sidebar {
      width: 200px; /* เพิ่มความกว้างที่ต้องการ */
    }
    .sidebar .nav-item {
      margin-bottom: 10px; /* เพิ่มระยะห่างด้านล่างของแต่ละ nav-item ไปยัง nav-item ถัดไป */
    }

    .sidebar-sticky {
      padding-top: 1rem; /* เพิ่มขอบบนเพื่อให้มีพื้นที่ */
      height: calc(100vh - 48px); /* ลบความสูงของ Navbar ที่ด้านบนออกจากความสูงทั้งหมดที่ต้องการให้ Sidebar มีได้ */
      overflow-x: hidden;
      overflow-y: auto;
    }
    
#maindashboard{
position: absolute;
    margin: auto;
    width: 300px;
    height: 300px;
    margin-left: -1cm;
    margin-top: 6.5cm;
}
#maindashboard1{
    position: absolute;
    margin: auto;
    width: 310px;
    height: 310px;
    margin-left: 10.5cm;
    margin-top: 6.2cm;
}
#maindashboard2{
    position: absolute;
    margin: auto;
    width: 410px;
    height: 410px;
    top:11cm;
    right:8cm;
    
}
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><?php echo $row['firstname'] . ' ' . $row['lastname']?></a>
          </li>
          <!-- Display the logged-in username -->
        
        
          <!-- Add the Log Out button -->
          <li class="nav-item">
            <a class="nav-link" href="../logout2.php">ออกจากระบบ</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <nav class="sidebar bg-dark sidebar-dark">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="main_dashboard.php">
            <i class="fas fa-tachometer-alt"></i> Dashboard <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">
            <i class="fas fa-shopping-cart"></i> Orders
          </a>
        </li>
        <li class="nav-item" id="accountsSubMenu">
    <a href="#" class="nav-link" onclick="toggleSubMenu('accountsSubMenu')">
        <i class="fas fa-box"></i> Products
    </a>
    <ul style="display: <?php echo ($current_page == 'dash_produc.php') ? 'block' : 'none'; ?>">
        <a class="nav-link" href="dash_produc.php">Statistic</a>
        <a class="nav-link" href="..\shopping cart\admin.php">Upload</a>
    </ul>
</li>
<script>
        function toggleSubMenu(subMenuId) {
            var subMenu = document.getElementById(subMenuId).querySelector('ul');
            subMenu.style.display = (subMenu.style.display === 'none') ? 'block' : 'none';
        }
    </script>
        <li class="nav-item">
          <a class="nav-link" href="dashb.php">
            <i class="fas fa-users"></i> Patient
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashbapomen.php">
            <i class="fas fa-users"></i> Appointment
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="finishreceipt.php">
            <i class="fas fa-users"></i> Receipt
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="doctorsdash.php">
            <i class="fas fa-users"></i> doctor
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reveiw_dashboard.php">
            <i class="fas fa-users"></i> Reviews
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Report.php">
            <i class="fas fa-chart-bar"></i> Reports
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Content -->
<div class="container mt-5">
    <h2 class="mb-7">Dashboard</h2>

    <!-- Create a grid for the three sections -->
    <div class="row">
        <!-- First Column: "การนัดหมายใหม่" -->
        <div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">การนัดหมายใหม่</h5>
            <!-- Add your content for "การนัดหมายใหม่" here -->
            
            <!-- You can use links, buttons, or any other content -->
            <?php echo "<p style='font-size: 2em; text-align: right;'>$appointmentCount</p>";?>
            
           
            <a href="dashbapomen.php" class="btn btn-primary" style="margin-bottom: 10px;">Go to Appointments</a>
            
            <!-- Display the appointment count in the same line -->
            
        </div>
    </div>
</div>


        <!-- Second Column: "ผู้ป่วยในระบบ" -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ผู้ป่วยในระบบ</h5>
                    <!-- Add your content for "ผู้ป่วยในระบบ" here -->
                    <?php echo "<p style='font-size: 2em; text-align: right;'>$patientCount</p>";?>
                    
                    
                    <!-- You can use links, buttons, or any other content -->
                    <a href="#" class="btn btn-success">View Patients</a>
                   
                    
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">รายได้</h5>
            <?php
                // Fetch the total price of the latest order from order2 table
                $sqlLatestOrder = "SELECT total_price FROM order2 ORDER BY id DESC LIMIT 1";
                $stmtLatestOrder = $conn->prepare($sqlLatestOrder);
                $stmtLatestOrder->execute();
                $resultLatestOrder = $stmtLatestOrder->fetch(PDO::FETCH_ASSOC);
                $latestTotalPrice = $resultLatestOrder['total_price'];
            ?>
            <!-- Display the total sales value -->
            <p style="font-size: 2em; text-align: right; color: green;">+<?php echo number_format($latestTotalPrice, 2); ?> บาท</p>
            <!-- You can add a link or button to view more details if needed -->
            <a href="#" class="btn btn-info">View Sales</a>
        </div>
    </div>
</div> 

<?php
  // เชื่อมต่อกับฐานข้อมูล
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fund";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // ตรวจสอบการเชื่อมต่อ
  if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
  }

  // คำสั่ง SQL เพื่อดึงข้อมูลจำนวนผู้ป่วยในแต่ละกลุ่มช่วงอายุ
  $sql = "SELECT 
            CASE 
              WHEN age BETWEEN 1 AND 10 THEN '1-10'
              WHEN age BETWEEN 11 AND 20 THEN '11-20'
              WHEN age BETWEEN 21 AND 30 THEN '21-30'
              WHEN age BETWEEN 31 AND 40 THEN '31-40'
              WHEN age BETWEEN 41 AND 50 THEN '41-50'
              ELSE '>50'
            END AS age_group,
            COUNT(*) AS total
          FROM 
            patien 
          GROUP BY 
            age_group
          ORDER BY 
            age_group";

  $result = $conn->query($sql);

  // ตรวจสอบว่ามีข้อมูลหรือไม่
  if ($result->num_rows > 0) {
    // สร้างข้อมูลสำหรับใช้ในกราฟ
    $data = array();
    while($row = $result->fetch_assoc()) {
      $data[] = array(
        'name' => $row['age_group'],
        'value' => $row['total']
      );
    }
  } else {
    echo "ไม่พบข้อมูล";
  }
  $conn->close();
  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <div id="maindashboard"  ></div>
  <div class = 'frame' ></div>
  <script>
  var data = <?php echo json_encode($data); ?>;

// สร้าง Pie Chart
var pieChart = echarts.init(document.getElementById('maindashboard'));
var option = {
  title: {
    text: 'แยกช่วงอายุของผู้ป่วย',
    left: 'center'
  },
  legend: {
        top: '13%',
        left: 'center'
   },
  tooltip: {
    trigger: 'item',
    formatter: '{a} <br/>{b} : {c} ({d}%)'
  },
  series: [
    {
      name: 'จำนวนผู้ป่วย',
      type: 'pie',
      radius: '55%',
      center: ['50%', '60%'],
      data: data,
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};
pieChart.setOption(option);
</script>

<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "fund";

 $conn = new mysqli($servername, $username, $password, $dbname);

 // ตรวจสอบการเชื่อมต่อ
 if ($conn->connect_error) {
   die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
 }

// คำสั่ง SQL
$sql = "SELECT information, COUNT(*) AS count_info FROM appointmen GROUP BY information";
$result = $conn->query($sql);

// สร้างตัวแปร JSON
$data = array();
while ($row = $result->fetch_assoc()) {
    $info[] = array(
        'name' => $row['information'],
        'value' => $row['count_info']
    );
}
$conn->close();
?>
<div id="maindashboard1"  ></div>
<div class = 'frame1' ></div>
<script>
  var info = <?php echo json_encode($info); ?>;
  var chartDom = document.getElementById('maindashboard1');
var myChart = echarts.init(chartDom);
var data = <?php echo json_encode($info); ?>;
var option;

option = {
  title:{
    text: 'จำนวนการนัดจองต่างๆ',
    left:'center',
    top:'4.3%'
  },
    tooltip: {
        trigger: 'item'
    },
    legend: {
      top: '17%',
      left: 'center'
    },
    series: [
        {
            name: 'Access From',
            type: 'pie',
            top:'20%',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: 40,
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: info
        }
    ]
};

option && myChart.setOption(option);
</script>
<?php

 // การเชื่อมต่อกับฐานข้อมูล
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "fund";
 
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 // ตรวจสอบการเชื่อมต่อ
 if ($conn->connect_error) {
     die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
 }
 
 // คำสั่ง SQL
 $sql = "SELECT gender, COUNT(*) AS count_sex FROM patien GROUP BY gender";
 $result = $conn->query($sql);
 
 // สร้างตัวแปร JSON เพื่อใช้กับ ECharts
 $data = array();
 while ($row = $result->fetch_assoc()) {
     $gen[] = array(
         'name' => $row['gender'],
         'value' => $row['count_sex']
     );
 }
 $conn->close();
?>  
<div id="maindashboard2" ></div>
<div class = 'frame2' ></div>
<script>
        // ข้อมูลจากการ query
        var sex = <?php echo json_encode($gen); ?>;

        // สร้าง Bar Chart ด้วย ECharts
        var barChart = echarts.init(document.getElementById('maindashboard2'));

        // กำหนดคอนฟิกสำหรับ Bar Chart
        var option = {
            title: {
                text: 'จำนวนผู้ชายและผู้หญิงในฐานข้อมูล',
                left: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            xAxis: {
                type: 'category',
                data: ['ชาย', 'หญิง']
            },
            yAxis: {
                type: 'value',
                name: 'จำนวน'
            },
            series: [{
                data: sex,
                type: 'bar',
                top:'10%'
            }]
        };

        // นำคอนฟิก Option ไปใช้กับ Bar Chart
        barChart.setOption(option);
    </script>
</body>
</html>
