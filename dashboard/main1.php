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
            width: 750px;
            height: 730px;
            margin-left: 17cm;
            margin-top: 0.5cm;
            /*margin-top: 6.5cm;*/
            border: 5px solid black; /* เพิ่มเส้นขอบสีเทา */
            border-radius: 10px; /* กำหนดรูปร่างของกรอบเป็นรูปสี่เหลี่ยมมนเว้น */
            
        }
       
        h2 {
            text-align: center; /* จัดตำแหน่งให้อยู่ตรงกลาง */
            color: black; /* กำหนดสีข้อความเป็นดำ */
            font-weight: bold; /* กำหนดให้ตัวหนา */
            font-size: 50px; /* เพิ่มขนาดตัวอักษร */
        }
        /* ใช้ Flexbox */
#filterForm {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* จัดตำแหน่งฟอร์มที่ด้านซ้าย */
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    width: 300px; /* ปรับขนาดฟอร์มตามต้องการ */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* เพิ่มเงา */
    margin-left: calc(-25cm - 20px); /* 14cm - 20px (ค่า margin ต้นฉบับ) */
    margin-top: calc(2cm - 20px);
}


/* ให้ฟอร์มเต็มความกว้างของพื้นที่ที่กำหนด */
.container {
    display: flex;
    justify-content: center;
}

/* สีขอบของฟอร์ม */
#filterForm label, #filterForm select, #filterForm button {
    margin-bottom: 10px;
}

/* สีขอบของเลเบล */
label {
    color: #555; /* สีเทาเข้ม */
    font-weight: bold;
    display: block; /* ให้เลเบลเรียงต่อกันแนวดิ่ง */
}

/* สีของเลือก */
select {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc; /* เส้นขอบสีเทา */
    width: calc(100% - 22px); /* ลดขนาดของเลือกเล็กน้อยเพื่อให้พอดีกับขอบ */
}

/* สีของปุ่ม */
button[type="submit"] {
    background-color: #4CAF50; /* เขียว */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

button[type="submit"]:hover {
    background-color: #45a049; /* เขียวเข้ม */
}

/* เรียงตัวเลือกให้อยู่ในแนวดิ่ง */
select, button {
    display: block;
}

    </style>
</head>
</style>
</head>
<body class="sb-nav-fixed">
    <h2>Dashboard</h2>
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
                            Dashboard2
                            
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
    
    <!-- ลิงก์ JavaScript ของ Bootstrap 


 <option value="พิษณุโลก">พิษณุโลก</option>
        <option value="กำเเพงเพชร">กำเเพงเพชร</option>

-->
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
// คำสั่ง SQL เพื่อดึงข้อมูลจำนวนผู้ป่วยในแต่ละกลุ่มช่วงอายุ, เพศ, บริการ, คลินิก, และหมอ
$sql = "SELECT 
            CASE 
              WHEN age BETWEEN 1 AND 10 THEN '1-10'
              WHEN age BETWEEN 11 AND 20 THEN '11-20'
              WHEN age BETWEEN 21 AND 30 THEN '21-30'
              WHEN age BETWEEN 31 AND 40 THEN '31-40'
              WHEN age BETWEEN 41 AND 50 THEN '41-50'
              ELSE '>50'
            END AS age_group,
            gender,
            information,
            state,
            doctor,
            COUNT(*) AS total
          FROM 
          reports
          GROUP BY 
            age_group, gender, information, state, doctor
          ORDER BY 
            age_group, gender, information, state, doctor";

$result = $conn->query($sql);
// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // สร้างข้อมูลสำหรับใช้ในกราฟ
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'age_group' => $row['age_group'],
            'gender' => $row['gender'],
            'information' => $row['information'],
            'state' => $row['state'],
            'doctor' => $row['doctor'],
            'total' => $row['total']
        );
    }
} else {
    echo "ไม่พบข้อมูล";
}
$conn->close();
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.3/echarts.min.js" integrity="sha512-EmNxF3E6bM0Xg1zvmkeYD3HDBeGxtsG92IxFt1myNZhXdCav9MzvuH/zNMBU1DmIPN6njrhX1VTbqdJxQ2wHDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div id="maindashboard"></div>
<center>
<form id="filterForm">
    <label for="ageGroup">กรองตามช่วงอายุ:</label>
    <select id="ageGroup" name="ageGroup">
        <option value="">ทั้งหมด</option>
        <option value="1-10">1-10</option>
        <option value="11-20">11-20</option>
        <option value="21-30">21-30</option>
        <option value="31-40">31-40</option>
        <option value="41-50">41-50</option>
        <option value=">50">>50</option>
    </select>
    <label for="gender">เพศ:</label>
    <select id="gender" name="gender">
        <option value="">ทั้งหมด</option>
        <option value="ชาย">ชาย</option>
        <option value="หญิง">หญิง</option>
    </select>
    <label for="information">บริการ:</label>
    <select id="information" name="information">
        <option value="">ทั้งหมด</option>
        <option value="ผ่าฟัน">ผ่าฟัน</option>
        <option value="อุดฟัน">อุดฟัน</option>
    </select>
    <label for="state">คลินิก:</label>
    <select id="state" name="state">
        <option value="">ทั้งหมด</option>
        <option value="พิษณุโลก">พิษณุโลก</option>
        <option value="กำเเพงเพชร">กำเเพงเพชร</option>
    </select>
    <label for="doctor">หมอ:</label>
    <select id="doctor" name="doctor">
        <option value="">ทั้งหมด</option>
        <option value="หมอปกป้อง">หมอปกป้อง</option>
        <option value="เพชร">เพชร</option>
        <option value="สัภยา">สัภยา</option>
    </select>
    <button type="submit">ค้นหา</button>
</form>
</center>
<div class='frame'></div>

<script>
    var data = <?php echo json_encode($data); ?>;

    // สร้าง Pie Chart
    var pieChart = echarts.init(document.getElementById('maindashboard'));
    var option = {
        title: {
            text: 'จำนวนผู้ป่วยแยกรายช่วงอายุ, เพศ, บริการ, คลินิก, และหมอ',
            left: 'center',
            top: '5%',
            textStyle: {
                fontSize: 24,
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
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} คน ({d}%)',
            textStyle: {
                fontSize: 18,
                color: 'black'
            }
        },
        series: [{
            itemStyle: {
                borderColor: 'black',
                borderWidth: 1
            },
            name: 'จำนวนผู้ป่วย',
            type: 'pie',
            borderColor: 'black',
            borderWidth: 2,
            radius: '55%',
            top: '-1%',
            center: ['50%', '60%'],
            data: [],
            emphasis: {
                itemStyle: {
                    borderColor: 'black',
                    borderWidth: 1,
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)',
                }
            }
        }]
    };
    pieChart.setOption(option);

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var ageGroup = formData.get('ageGroup');
        var gender = formData.get('gender');
        var information = formData.get('information');
        var state = formData.get('state');
        var doctor = formData.get('doctor');
        var filteredData = data.filter(function(item) {
            return (ageGroup === '' || item.age_group === ageGroup) &&
                (gender === '' || item.gender === gender) &&
                (information === '' || item.information === information) &&
                (state === '' || item.state === state) &&
                (doctor === '' || item.doctor === doctor);
        });
        updateChart(filteredData);
    });

    function updateChart(filteredData) {
        var processedData = [];
        filteredData.forEach(function(item) {
            var label = item.age_group + ' (' + item.gender + ') - ' + item.information + ' - ' + item.state + ' - ' + item.doctor;
            processedData.push({
                name: label,
                value: item.total
            });
        });
        option.series[0].data = processedData;
        pieChart.setOption(option);
    }
</script>






</body>
</html>