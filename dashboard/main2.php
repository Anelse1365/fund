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
$sql = "SELECT * FROM patien";
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
} catch (PDOException $e) {
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
        #maindashboard {
            position: absolute;
            margin: auto;
            width: 500px;
            height: 500px;
            margin-left: 9cm;
            /*margin-top: 6.5cm;*/
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
        }
        #maindashboard1 {
            position: absolute;
            margin: auto;
            width: 500px;
            height: 500px;
            margin-left: 22.5cm;
            /*margin-top: 6.5cm;*/
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
        }
        #maindashboard2 {
            position: absolute;
            margin: auto;
            width: 500px;
            height: 500px;
            margin-left: 36cm;
            /*margin-top: 6.5cm;*/
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */

        }
        #maindashboard3 {
            position: absolute;
            margin: auto;
            width: 1520px;
            height: 410px;
            top: 18.85cm;
            left: 9cm;
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
            margin-bottom: 20px; /* เพิ่ม margin ด้านล่าง 20px */
        }
        #maindashboard4 {
            position: absolute;
            margin: auto;
            width: 1520px;
            height: 410px;
            top: 29.85cm;
            left: 9cm;
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 3px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
            margin-bottom: 20px; /* เพิ่ม margin ด้านล่าง 20px */
        }
        h2 {
            text-align: center; /* จัดตำแหน่งให้อยู่ตรงกลาง */
            color: black; /* กำหนดสีข้อความเป็นดำ */
            font-weight: bold; /* กำหนดให้ตัวหนา */
            font-size: 50px; /* เพิ่มขนาดตัวอักษร */
        }
    </style>
</head>
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
                <a class="nav-link" href="#"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></a>
            </li>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
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
                        <a class="nav-link" href="main2.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard 2
                            
                        </a>
                        <a class="nav-link" href="main3.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard รีวิว
                            
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
        </ul>
    </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Dashboard</h2>
    </div>
    <!-- ลิงก์ JavaScript ของ Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>  
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
        while ($row = $result->fetch_assoc()) {
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
    <div id="maindashboard"></div>
    <div class='frame'></div>

    <script>
        var data = <?php echo json_encode($data); ?>;

        // สร้าง Pie Chart
        var pieChart = echarts.init(document.getElementById('maindashboard'));
        var option = {
            title: {
                text: 'จำนวนช่วงอายุของผู้มาใช้บริการ',
                left: 'center',
                top:'5%',
                textStyle: {
                    fontSize: 24,
                    color:'black'

                }
            },
            legend: {
                top: '16%',
                left: 'center',
                textStyle: {
                    fontSize: 18,
                    color:'black'
                }

            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} คน ({d}%)',
                textStyle: {
                    fontSize: 18,
                    color:'black'
                }
            },
            series: [{
                itemStyle:{
                borderColor: 'black', // สีขอบ
                borderWidth: 1 // ความหนาขอบ
                },
                name: 'จำนวนผู้ป่วย',
                type: 'pie',
                borderColor: 'black',
                borderWidth:2,
                radius: '55%',
                top: '-1%',
                center: ['50%', '60%'],
                data: data,
                emphasis: {
                    itemStyle: {
                        borderColor: 'black', // สีขอบ
                        borderWidth: 1, // ความหนาขอบ
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)',
                    }
                }
            }]
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


    $sql = "SELECT information, COUNT(*) AS count_info FROM reports GROUP BY information";
    $result = $conn->query($sql);


    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'name' => $row['information'],
            'value' => $row['count_info']
        );
    }
    $conn->close();

    ?>
    <div id="maindashboard1"></div>
    <div class='frame1'></div>
    <script>
        var info = <?php echo json_encode($data); ?>;
        var chartDom = document.getElementById('maindashboard1');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            title: {
                text: 'จำนวนการนัดจองต่างๆ',
                left: 'center',
                top: '4.3%',
                textStyle: {
                    fontSize: 24,
                    color:'black'
                }
            },
            tooltip: {
                formatter: '{a} <br/>{b} : {c} คน ({d}%)',
                trigger: 'item',
                textStyle: {
                    fontSize: 24,
                    color:'black'
                }
            },
            legend: {
                top: '17%',
                left: 'center',
                textStyle: {
                    fontSize: 24,
                    color:'black'
                }
            },
            series: [{
                itemStyle:{
                borderColor: 'black', // สีขอบ
                borderWidth: 1 // ความหนาขอบ
                },
                name: 'Access From',
                type: 'pie',
                top: '20%',
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
                        fontWeight: 'bold',
                        color:'black'
                    },
                itemStyle: { // เพิ่มการกำหนดขอบให้วงกลม
                borderColor: 'black', // สีขอบ
                borderWidth: 2 // ความหนาขอบ
            }
                },
                labelLine: {
                    show: false
                },
                data: info
            }]
        };
        option && myChart.setOption(option);
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


    $sql = "SELECT information, COUNT(*) AS count_info FROM reports GROUP BY information";
    $result = $conn->query($sql);


    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'name' => $row['information'],
            'value' => $row['count_info']
        );
    }
    $conn->close();

    ?>
    <div id="maindashboard2"></div>
    <div class='frame1'></div>
    <script>
        var info = <?php echo json_encode($data); ?>;
        var chartDom = document.getElementById('maindashboard2');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            title: {
                text: 'จำนวนการนัดจองต่างๆ',
                left: 'center',
                top: '4.3%',
                textStyle: {
                    fontSize: 24,
                    color:'black'
                }
            },
            tooltip: {
                formatter: '{a} <br/>{b} : {c} คน ({d}%)',
                trigger: 'item',
                textStyle: {
                    fontSize: 24,
                    color:'black'
                }
            },
            legend: {
                top: '17%',
                left: 'center',
                textStyle: {
                    fontSize: 24,
                    color:'black'
                }
            },
            series: [{
                itemStyle:{
                borderColor: 'black', // สีขอบ
                borderWidth: 1 // ความหนาขอบ
                },
                type: 'pie',
                top: '20%',
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
                        fontWeight: 'bold',
                        color:'black'
                    },
                itemStyle: { // เพิ่มการกำหนดขอบให้วงกลม
                borderColor: 'black', // สีขอบ
                borderWidth: 2 // ความหนาขอบ
            }
                },
                labelLine: {
                    show: false
                },
                data: info
            }]
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
    <div id="maindashboard2"></div>
    <div class='frame2'></div>
    <script>
        // ข้อมูลจากการ query
        var sex = <?php echo json_encode($gen); ?>;

        // สร้าง Bar Chart ด้วย ECharts
        var barChart = echarts.init(document.getElementById('maindashboard2'));

        // กำหนดคอนฟิกสำหรับ Bar Chart
        var option = {
            title: {
                text: 'จำนวนผู้ชายและผู้หญิงในฐานข้อมูล',
                left: 'center',
                top:'1%',
                textStyle: {
                    fontSize: 22,
                    color:'black'
                }
            },
            tooltip: {
                formatter: 'จำนวน <br/>{b} : {c} คน',
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                textStyle: {
                    fontSize: 24,
                    color:'black'
                }
            },
            xAxis: {
                top:'6%',
                type: 'category',
                data: ['ชาย', 'หญิง'],
                axisLabel: {
        textStyle: {
            fontSize: 20 ,// ขนาดตัวอักษร
            color:'black'
        }
    }
            },
            yAxis: {
                top:'6%',
                type: 'value',
                name: 'จำนวน',
                formatter: 1,
                
                
            },
            series: [{
                data: sex,
                type: 'bar',
                bottom:'20px',
                itemStyle:{
                    borderColor: 'black', // สีขอบ
                    borderWidth: 1 ,// ความหนาขอบ
                }
            }]
        };
        // นำคอนฟิก Option ไปใช้กับ Bar Chart
        barChart.setOption(option);
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
    $sql = "SELECT information,
      SUM(CASE WHEN gender = 'ชาย' THEN 1 ELSE 0 END) AS male_count,
      SUM(CASE WHEN gender = 'หญิง' THEN 1 ELSE 0 END) AS female_count
  FROM 
      reports
  GROUP BY 
      information";
    $result = $conn->query($sql);
    
    // สร้างตัวแปร JSON เพื่อใช้กับ ECharts
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'information' => $row['information'],
                'male_count' => $row['male_count'],
                'female_count' => $row['female_count']
            );
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <div id="maindashboard3"></div>
    <div class='frame3'></div>
    <script>
        // สร้าง Bar Chart ด้วย ECharts
        var chartDom = document.getElementById('maindashboard3');
        var myChart = echarts.init(chartDom);
        var option;

        // ใช้ข้อมูลที่ดึงมาจาก PHP
        var reportData = <?php echo json_encode($data); ?>;
        var sourceData = [
            ['a', 'ชาย', 'หญิง']
        ]; // สร้าง array ตัวแรกที่เก็บชื่อหัวของแต่ละคอลัมน์

        for (var i = 0; i < reportData.length; i++) {
            sourceData.push([
                reportData[i].information,
                reportData[i].male_count,
                reportData[i].female_count
            ]);
        }
        option = {
            title: {
                text: 'จำนวนการนัดจองในแต่ละประเภท',
                left: 'center',
                top:'1%',
                textStyle: {
                    fontSize: 22,
                    color:'black'
                }
            },
            legend: {
                top:'13%',
                textStyle: {
                    fontSize: 22,
                    color:'black'
                }
            },
            grid: {
        top: '27%', // ปรับตำแหน่งด้านซ้า
        containLabel: true // ปรับให้กราฟอยู่ในพื้นที่ที่กำหนดไว้
        
    },
            tooltip: {
            
                textStyle: {
                    fontSize: 22,
                    color:'black'
                }
            },
            dataset: {
                source: sourceData,
                textStyle: {
                    fontSize: 22,
                    color:'black'
                }
            },
            xAxis: {
                type: 'category',
                textStyle: {
                    fontSize: 22,
                    color:'black'
                }
            },
            yAxis: {
                formatter: 1,
                textStyle: {
                    fontSize: 22,
                    color:'black'
                }
            },
            series: [
                {
                    type: 'bar',
                    itemStyle: {
                        color: 'skyblue',
                         barBorderRadius: [5, 5, 0, 0] ,// เพิ่มเส้นขอบด้านบนเป็นโค้ง
                        borderColor:'black'
                    }
                },
                {
                    type: 'bar',
                    itemStyle: {
                        color: 'pink',
                        fontWeight: 'bold',
                        barBorderRadius: [5, 5, 0, 0], // เพิ่มเส้นขอบด้านบนเป็นโค้ง
                        borderColor:'black'
                    }
                }
            ]
        };
        option && myChart.setOption(option);
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
    
    
        $sql = "SELECT state, COUNT(*) AS count_info FROM appointmen GROUP BY state";
        $result = $conn->query($sql);
    
    
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'name' => $row['state'],
                'value' => $row['count_info']
            );
        }
        $conn->close();
    
        ?>
        <div id="maindashboard4"></div>
        <div class='frame4'></div>
        <script>
            var info = <?php echo json_encode($data); ?>;
            var chartDom = document.getElementById('maindashboard4');
            var myChart = echarts.init(chartDom);
            var option;
    
            option = {
                title: {
                    text: 'จำนวนการนัดจองต่างๆ',
                    left: 'center',
                    top: '4.3%',
                    textStyle: {
                        fontSize: 24,
                        color:'black'
                    }
                },
                tooltip: {
                    formatter: '{a} <br/>{b} : {c} คน ({d}%)',
                    trigger: 'item',
                    textStyle: {
                        fontSize: 24,
                        color:'black'
                    }
                },
                legend: {
                    top: '17%',
                    left: 'center',
                    textStyle: {
                        fontSize: 24,
                        color:'black'
                    }
                },
                series: [{
                    itemStyle:{
                    borderColor: 'black', // สีขอบ
                    borderWidth: 1 // ความหนาขอบ
                    },
                    name: 'Access From',
                    type: 'pie',
                    top: '20%',
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
                            fontWeight: 'bold',
                            color:'black'
                        },
                    itemStyle: { // เพิ่มการกำหนดขอบให้วงกลม
                    borderColor: 'black', // สีขอบ
                    borderWidth: 2 // ความหนาขอบ
                }
                    },
                    labelLine: {
                        show: false
                    },
                    data: info
                }]
            };
            option && myChart.setOption(option);
        </script>
</body>
    
    
    
</html>