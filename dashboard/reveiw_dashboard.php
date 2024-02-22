<?php
session_start();

    require_once '../config2/db2.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location:../signin2.php');
    }

    if (isset($_SESSION['admin_login'])) {
      $user_id = $_SESSION['admin_login'];
      $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }


              // SQL query to fetch data from database
  $sql = "SELECT * FROM reviews  WHERE 1";

  if(isset($_GET['patient']) && !empty($_GET['patient'])) {
    $patient = $_GET['patient'];
    $sql .= " AND patient LIKE '%$patient%'";
}

if(isset($_GET['search_email']) && !empty($_GET['search_email'])) {
    $search_email = $_GET['search_email'];
    $sql .= " AND email LIKE '%$search_email%'";
}
if(isset($_GET['doctor_name']) && !empty($_GET['doctor_name'])) {
    $doctor_name  = $_GET['doctor_name'];
    $sql .= " AND  doctor_name    LIKE '%$doctor_name%'";
}
if(isset($_GET['rating']) && !empty($_GET['rating'])) {
    $rating  = $_GET['rating'];
    $sql .= " AND  rating    LIKE '%$rating%'";
}
if(isset($_GET['comment']) && !empty($_GET['comment'])) {
    $comment  = $_GET['comment'];
    $sql .= " AND  comment    LIKE '%$comment%'";
}

  $stmt = $conn->prepare($sql);

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจากตาราง reviews
    $stmt = $conn->query("SELECT * FROM reviews");
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // หากเกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}
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
        <style>
        #review_dashboard {
            position: absolute;
            margin: auto;
            width: 500px;
            height: 600px;
            margin-left: 9cm;
            margin-top: 5cm;
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
        }
        #review_dashboard1 {
            position: absolute;
            margin: auto;
            width: 500px;
            height: 600px;
            margin-left:23cm;
            margin-top: 5cm;
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
        }
        #review_dashboard2 {
            position: absolute;
            margin: auto;
            width: 500px;
            height: 600px;
            margin-left:37cm;
            margin-top: 5cm;
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
        }
        #review_dashboard3 {
            position: absolute;
            margin: auto;
            width: 500px;
            height: 600px;
            margin-left:51cm;
            margin-top: 5cm;
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
        }
        h2 {
            text-align: center; /* จัดตำแหน่งให้อยู่ตรงกลาง */
            color: black; /* กำหนดสีข้อความเป็นดำ */
            font-weight: bold; /* กำหนดให้ตัวหนา */
            font-size: 50px; /* เพิ่มขนาดตัวอักษร */
        }
        </style>
    </head>
    <body class="sb-nav-fixed">
      <br><br>
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
<script>
        function toggleSubMenu(subMenuId) {
            var subMenu = document.getElementById(subMenuId).querySelector('ul');
            subMenu.style.display = (subMenu.style.display === 'none') ? 'block' : 'none';
        }
    </script>


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

    $sql = "SELECT 
            doctor_name,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) AS 1_point,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) AS 2_point,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) AS 3_point,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) AS 4_point,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) AS 5_point,
            SUM(CASE WHEN rating = 6 THEN 1 ELSE 0 END) AS 6_point,
            SUM(CASE WHEN rating = 7 THEN 1 ELSE 0 END) AS 7_point,
            SUM(CASE WHEN rating = 8 THEN 1 ELSE 0 END) AS 8_point,
            SUM(CASE WHEN rating = 9 THEN 1 ELSE 0 END) AS 9_point,
            SUM(CASE WHEN rating = 10 THEN 1 ELSE 0 END) AS 10_point
        FROM 
            reviews
        WHERE
            doctor_name = 'หมอปกป้อง'
        GROUP BY 
            doctor_name";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        // สร้าง array เพื่อเก็บข้อมูล
        $data = array();
        while($row = $result->fetch_assoc()) {
          $data[] = array(
                'doc_name' => $row['doctor_name'],
                '1point' => $row['1_point'],
                '2point' => $row['2_point'],
                '3point' => $row['3_point'],
                '4point' => $row['4_point'],
                '5point' => $row['5_point'],
                '6point' => $row['6_point'],
                '7point' => $row['7_point'],
                '8point' => $row['8_point'],
                '9point' => $row['9_point'],
                '10point' => $row['10_point'],
          );
        }
    } $conn->close();
?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<div id="review_dashboard"></div>
    <script>
    var review = <?php echo json_encode($data); ?>;

    // สร้าง Pie Chart
    var chartDom = document.getElementById('review_dashboard');
    var myChart = echarts.init(chartDom);
    var option;

option = {
  title: {
    text: 'คะแนนรีวิวของหมอปกป้อง',
    left: 'center',
    top:'5%',
    textStyle: {
      fontSize: 32,
      color:'black'
    }
  },
  legend: {
    type: 'scroll', // กำหนดเป็น scroll type
    top: '16%',
    left: 'center',
    textStyle: {
      fontSize: 22,
      color:'black'
    }
  },
  series: [
    { 
      top: '23%',
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: 'black', // สีขอบ                 
        borderWidth: 1 ,// ความหนาขอบ
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        itemStyle: {
          borderColor: 'black', // สีขอบ                 
          borderWidth: 1, // ความหนาขอบ             
          shadowBlur: 10,                         
          shadowOffsetX: 0,                         
          shadowColor: 'rgba(1, 1, 1, 1)',
        },

      },
      tooltip: {
    
            },
      labelLine: {
        show: false
      },
      data: [
        { value: review[0]['1point'], name: '1 Point' }, // ใช้ค่า 1point จาก JSON
        { value: review[0]['2point'], name: '2 Point' },
        { value: review[0]['3point'], name: '3 Point' },
        { value: review[0]['4point'], name: '4 Point' },
        { value: review[0]['5point'], name: '5 Point' },
        { value: review[0]['6point'], name: '6 Point' },
        { value: review[0]['7point'], name: '7 Point' },
        { value: review[0]['8point'], name: '8 Point' },
        { value: review[0]['9point'], name: '9 Point' },
        { value: review[0]['10point'], name: '10 Point'},
      ]
    }
  ]
};

option && myChart.setOption(option);
</script>

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

$sql = "SELECT 
            doctor_name,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) AS 1_point,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) AS 2_point,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) AS 3_point,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) AS 4_point,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) AS 5_point,
            SUM(CASE WHEN rating = 6 THEN 1 ELSE 0 END) AS 6_point,
            SUM(CASE WHEN rating = 7 THEN 1 ELSE 0 END) AS 7_point,
            SUM(CASE WHEN rating = 8 THEN 1 ELSE 0 END) AS 8_point,
            SUM(CASE WHEN rating = 9 THEN 1 ELSE 0 END) AS 9_point,
            SUM(CASE WHEN rating = 10 THEN 1 ELSE 0 END) AS 10_point
        FROM 
            reviews
        WHERE
            doctor_name = 'หมอกอล์ฟ'
        GROUP BY 
            doctor_name";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        // สร้าง array เพื่อเก็บข้อมูล
        $datagolf = array();
        while($row = $result->fetch_assoc()) {
          $datagolf[] = array(
                'doc_name' => $row['doctor_name'],
                '1point' => $row['1_point'],
                '2point' => $row['2_point'],
                '3point' => $row['3_point'],
                '4point' => $row['4_point'],
                '5point' => $row['5_point'],
                '6point' => $row['6_point'],
                '7point' => $row['7_point'],
                '8point' => $row['8_point'],
                '9point' => $row['9_point'],
                '10point' => $row['10_point'],
          );
        }
    } $conn->close();
?>
<div id="review_dashboard1"></div>
<script>
    var review2 = <?php echo json_encode($datagolf); ?>;

    // สร้าง Pie Chart
    var chartDom = document.getElementById('review_dashboard1');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
  type: 'scroll', // กำหนดเป็น scroll type
  title: {
    text: 'คะแนนรีวิวของหมอกอล์ฟ',
    left: 'center',
    top:'5%',
    textStyle: {
      fontSize: 32,
      color:'black'
    }
  },
  legend: {
    type: 'scroll', // กำหนดเป็น scroll type
    top: '16%',
    left: 'center',
    textStyle: {
      fontSize:22,
      color:'black'
    }
  },
  series: [
    {
      top: '23%',
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: 'black', // สีขอบ                 
        borderWidth: 1 ,// ความหนาขอบ
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        itemStyle: {
          borderColor: 'black', // สีขอบ                 
          borderWidth: 1, // ความหนาขอบ             
          shadowBlur: 10,                         
          shadowOffsetX: 0,                         
          shadowColor: 'rgba(1, 1, 1, 1)',
        },
        label: {
          show: true,
          fontSize: 40,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: review[0]['1point'], name: '1 Point' }, // ใช้ค่า 1point จาก JSON
        { value: review[0]['2point'], name: '2 Point' },
        { value: review[0]['3point'], name: '3 Point' },
        { value: review[0]['4point'], name: '4 Point' },
        { value: review[0]['5point'], name: '5 Point' },
        { value: review[0]['6point'], name: '6 Point' },
        { value: review[0]['7point'], name: '7 Point' },
        { value: review[0]['8point'], name: '8 Point' },
        { value: review[0]['9point'], name: '9 Point' },
        { value: review[0]['10point'], name: '10 Point'},
      ]
    }
  ]
};

option && myChart.setOption(option);
</script>

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

$sql = "SELECT 
            doctor_name,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) AS 1_point,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) AS 2_point,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) AS 3_point,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) AS 4_point,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) AS 5_point,
            SUM(CASE WHEN rating = 6 THEN 1 ELSE 0 END) AS 6_point,
            SUM(CASE WHEN rating = 7 THEN 1 ELSE 0 END) AS 7_point,
            SUM(CASE WHEN rating = 8 THEN 1 ELSE 0 END) AS 8_point,
            SUM(CASE WHEN rating = 9 THEN 1 ELSE 0 END) AS 9_point,
            SUM(CASE WHEN rating = 10 THEN 1 ELSE 0 END) AS 10_point
        FROM 
            reviews
        WHERE
            doctor_name = 'สัภยา'
        GROUP BY 
            doctor_name";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        // สร้าง array เพื่อเก็บข้อมูล
        $datasap = array();
        while($row = $result->fetch_assoc()) {
          $datasap[] = array(
                'doc_name' => $row['doctor_name'],
                '1point' => $row['1_point'],
                '2point' => $row['2_point'],
                '3point' => $row['3_point'],
                '4point' => $row['4_point'],
                '5point' => $row['5_point'],
                '6point' => $row['6_point'],
                '7point' => $row['7_point'],
                '8point' => $row['8_point'],
                '9point' => $row['9_point'],
                '10point' => $row['10_point'],
          );
        }
    } $conn->close();
?>
<div id="review_dashboard2"></div>
<script>
    var review3 = <?php echo json_encode($datasap); ?>;

    // สร้าง Pie Chart
    var chartDom = document.getElementById('review_dashboard2');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
  type: 'scroll', // กำหนดเป็น scroll type
  title: {
    text: 'คะแนนรีวิวของหมอสัภยา',
    left: 'center',
    top:'5%',
    textStyle: {
      fontSize: 32,
      color:'black'
    }
  },
  legend: {
    type: 'scroll', // กำหนดเป็น scroll type
    top: '16%',
    left: 'center',
    textStyle: {
      fontSize: 22,
      color:'black'
    }
  },
  series: [
    {
      top: '23%',
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: 'black', // สีขอบ                 
        borderWidth: 1 ,// ความหนาขอบ
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        itemStyle: {
          borderColor: 'black', // สีขอบ                 
          borderWidth: 1, // ความหนาขอบ             
          shadowBlur: 10,                         
          shadowOffsetX: 0,                         
          shadowColor: 'rgba(1, 1, 1, 1)',
        },
        label: {
          show: true,
          fontSize: 40,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: review[0]['1point'], name: '1 Point' }, // ใช้ค่า 1point จาก JSON
        { value: review[0]['2point'], name: '2 Point' },
        { value: review[0]['3point'], name: '3 Point' },
        { value: review[0]['4point'], name: '4 Point' },
        { value: review[0]['5point'], name: '5 Point' },
        { value: review[0]['6point'], name: '6 Point' },
        { value: review[0]['7point'], name: '7 Point' },
        { value: review[0]['8point'], name: '8 Point' },
        { value: review[0]['9point'], name: '9 Point' },
        { value: review[0]['10point'], name: '10 Point'},
      ]
    }
  ]
};

option && myChart.setOption(option);
</script>

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

$sql = "SELECT 
            doctor_name,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) AS 1_point,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) AS 2_point,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) AS 3_point,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) AS 4_point,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) AS 5_point,
            SUM(CASE WHEN rating = 6 THEN 1 ELSE 0 END) AS 6_point,
            SUM(CASE WHEN rating = 7 THEN 1 ELSE 0 END) AS 7_point,
            SUM(CASE WHEN rating = 8 THEN 1 ELSE 0 END) AS 8_point,
            SUM(CASE WHEN rating = 9 THEN 1 ELSE 0 END) AS 9_point,
            SUM(CASE WHEN rating = 10 THEN 1 ELSE 0 END) AS 10_point
        FROM 
            reviews
        WHERE
            doctor_name = 'เพชร'
        GROUP BY 
            doctor_name";
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        // สร้าง array เพื่อเก็บข้อมูล
        $datapet = array();
        while($row = $result->fetch_assoc()) {
          $datapet[] = array(
                'doc_name' => $row['doctor_name'],
                '1point' => $row['1_point'],
                '2point' => $row['2_point'],
                '3point' => $row['3_point'],
                '4point' => $row['4_point'],
                '5point' => $row['5_point'],
                '6point' => $row['6_point'],
                '7point' => $row['7_point'],
                '8point' => $row['8_point'],
                '9point' => $row['9_point'],
                '10point' => $row['10_point'],
          );
        }
    } $conn->close();
?>
<div id="review_dashboard3"></div>
<script>
    var review4 = <?php echo json_encode($datapet); ?>;

    // สร้าง Pie Chart
    var chartDom = document.getElementById('review_dashboard3');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
  type: 'scroll', // กำหนดเป็น scroll type
  title: {
    text: 'คะแนนรีวิวของหมอเพชร',
    left: 'center',
    top:'5%',
    textStyle: {
      fontSize: 32,
      color:'black'
    }
  },
  legend: {
    type: 'scroll', // กำหนดเป็น scroll type
    top: '16%',
    left: 'center',
    textStyle: {
      fontSize: 22,
      color:'black'
    }
  },
  series: [
    {
      top: '23%',
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: 'black', // สีขอบ                 
        borderWidth: 1 ,// ความหนาขอบ
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        itemStyle: {
          borderColor: 'black', // สีขอบ                 
          borderWidth: 1, // ความหนาขอบ             
          shadowBlur: 10,                         
          shadowOffsetX: 0,                         
          shadowColor: 'rgba(1, 1, 1, 1)',
        },
        label: {
          show: true,
          fontSize: 40,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: review[0]['1point'], name: '1 Point' }, // ใช้ค่า 1point จาก JSON
        { value: review[0]['2point'], name: '2 Point' },
        { value: review[0]['3point'], name: '3 Point' },
        { value: review[0]['4point'], name: '4 Point' },
        { value: review[0]['5point'], name: '5 Point' },
        { value: review[0]['6point'], name: '6 Point' },
        { value: review[0]['7point'], name: '7 Point' },
        { value: review[0]['8point'], name: '8 Point' },
        { value: review[0]['9point'], name: '9 Point' },
        { value: review[0]['10point'], name: '10 Point'},
      ]
    }
  ]
};

option && myChart.setOption(option);
</script>

  <div class="container mt-5">
        <h2 class="text-center mb-4">Reviews Dashboard</h2>
    </div>

<!-- ลิงก์ JavaScript ของ Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>  
</body>
</html>








