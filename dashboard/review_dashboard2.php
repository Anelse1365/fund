<?php
session_start();

require_once '../config2/db2.php';

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location:../signin2.php');
    exit(); // หลังจาก redirect ควรจะทำการออกจากการทำงานของสคริปต์ด้วย exit()
}

if (isset($_SESSION['admin_login'])) {
    $user_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบ
$user_id = $_SESSION['admin_login'];
$stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ?");
$stmt->execute([$user_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

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
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจากตาราง reviews
    $stmt = $conn->query("SELECT * FROM reviews");
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}

// ตรวจสอบการเชื่อมต่อฐานข้อมูลสำหรับกราฟ
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$sql = "SELECT 
        doctor_name, COUNT(*) AS count_info,
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

if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        #review_dashboard {
            margin-top: 6.5cm;
            position: absolute;
            margin: auto;
            width: 500px;
            height: 500px;
            margin-left: 9cm;
            border: 5px solid black;
            border-radius: 10px;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <h2>Dashboard</h2>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="main_dashboard.php">FUND CLINIC</a>
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
                        <a class="nav-link" href="main_dashboard.php">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div id="review_dashboard"></div>

    <script>
        var data = <?php echo json_encode($data); ?>;
        var chartDom = document.getElementById('review_dashboard');
        var myChart = echarts.init(chartDom);
        var option;

        option = {
            title: {
                text: 'จำนวนผู้ป่วยมาลงคะแนน',
                left: 'center',
                top: '5%',
                textStyle: {
                    fontSize: 24,
                    color: 'black'
                }
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} คน ({d}%)',
                textStyle: {
                    fontSize: 18,
                    color: 'black'
                }
            },
            legend: {
                top: '16%',
                left: 'center',
                textStyle: {
                    fontSize: 18,
                    color: 'black'
                }
            },
            series: [{
                name: 'จำนวนผู้ป่วยรีวิว',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2,
                },
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
                data: data.map(function(item) {
                    return {
                        value: item.count_info,
                        name: item.doctor_name
                    };
                })
            }]
        };

        option && myChart.setOption(option);
    </script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
