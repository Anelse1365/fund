<?php
session_start();

require_once '../config2/db2.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location:../signin2.php');
    exit(); // Always exit after a header redirect
}

if (isset($_SESSION['admin_login'])) {
    $user_id = $_SESSION['admin_login'];
    $stmt = $conn->prepare("SELECT * FROM patien WHERE id = ?");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Database connection
require_once '../config2/db2.php'; // You should include your database connection file once

// Fetch all reviews initially
$sql = "SELECT * FROM reviews WHERE 1";

// Apply search filters if provided
if(isset($_GET['search_name']) && !empty($_GET['search_name'])) {
    $search_name = '%' . $_GET['search_name'] . '%';
    $sql .= " AND doctor_name LIKE ?";
}

if(isset($_GET['search_rating']) && !empty($_GET['search_rating'])) {
    $search_rating = $_GET['search_rating'];
    $sql .= " AND rating = ?";
}

$stmt = $conn->prepare($sql);

if(isset($search_name) && isset($search_rating)) {
    $stmt->execute([$search_name, $search_rating]);
} elseif(isset($search_name)) {
    $stmt->execute([$search_name]);
} elseif(isset($search_rating)) {
    $stmt->execute([$search_rating]);
} else {
    $stmt->execute();
}

$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate chart data
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
    reviews";

if(isset($search_name)) {
    $sql .= " WHERE doctor_name LIKE ?";
}

$sql .= " GROUP BY doctor_name";

$stmt = $conn->prepare($sql);

if(isset($search_name)) {
    $stmt->execute([$search_name]);
} else {
    $stmt->execute();
}

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            width: 750px;
            height: 760px;
            margin-left: 15cm;
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
                            <a class="nav-link" href="main2.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard 2
                            
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
    doctor_name IN ('หมอปกป้อง', 'หมอกอล์ฟ', 'สัภยา', 'เพชร')
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
    } 
    $conn->close();
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
            text: 'คะแนนรีวิวของหมอปกป้องและหมอกอล์ฟ',
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
        tooltip: {
            trigger: 'item',
            formatter: 'จำนวน <br/>{b} : {c} คน ({d}%)',
            textStyle: {
                fontSize: 24,
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
                emphasis: {
                    itemStyle: {
                        borderColor: 'black', // สีขอบ                 
                        borderWidth: 1, // ความหนาขอบ             
                        shadowBlur: 10,                         
                        shadowOffsetX: 0,                         
                        shadowColor: 'rgba(1, 1, 1, 1)',
                    },

                },
                labelLine: {
                    show: false
                },
                data: [
                    <?php foreach($data as $review): ?>
                        { value: <?php echo $review['1point']; ?>, name: '<?php echo $review['doc_name']; ?> - 1 Point' },
                        { value: <?php echo $review['2point']; ?>, name: '<?php echo $review['doc_name']; ?> - 2 Point' },
                        { value: <?php echo $review['3point']; ?>, name: '<?php echo $review['doc_name']; ?> - 3 Point' },
                        { value: <?php echo $review['4point']; ?>, name: '<?php echo $review['doc_name']; ?> - 4 Point' },
                        { value: <?php echo $review['5point']; ?>, name: '<?php echo $review['doc_name']; ?> - 5 Point' },
                        { value: <?php echo $review['6point']; ?>, name: '<?php echo $review['doc_name']; ?> - 6 Point' },
                        { value: <?php echo $review['7point']; ?>, name: '<?php echo $review['doc_name']; ?> - 7 Point' },
                        { value: <?php echo $review['8point']; ?>, name: '<?php echo $review['doc_name']; ?> - 8 Point' },
                        { value: <?php echo $review['9point']; ?>, name: '<?php echo $review['doc_name']; ?> - 9 Point' },
                        { value: <?php echo $review['10point']; ?>, name: '<?php echo $review['doc_name']; ?> - 10 Point' },
                    <?php endforeach; ?>
                ]
            }
        ]
    };

    option && myChart.setOption(option);
</script>


  <div class="container mt-5">
        <h2 class="text-center mb-4">Reviews Dashboard</h2>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="search_name">ค้นหาชื่อหมอ:</label>
    <input type="text" id="search_name" name="search_name">
    <label for="search_rating">ค้นหาคะเเนน:</label>
    <select id="search_rating" name="search_rating">
        <option value="">ทั้งหมด</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select>
    <input type="submit" value="ค้นหา">
</form>
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








