<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง reports
$sql = "SELECT * FROM reports";

// ประมวลผลคำสั่ง SQL
$stmt = $conn->prepare($sql);
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

// ปรับโค้ด SQL เพื่อให้รองรับคำค้นหา
$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
    $sql = "SELECT * FROM reports WHERE state LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%');
} else {
    $sql = "SELECT * FROM reports";
    $stmt = $conn->prepare($sql);
}




$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

// เพิ่มโค้ดนี้เพื่อคำนวณผลรวมเงินทั้งหมดในตารางที่ถูกกรองด้วยคำค้นหา
$totalPrice = 0;
$totalPatients = 0;
foreach ($reports as $report) {
    $totalPrice += $report['price'];
    $totalPatients++;
}
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
            <i class="fas fa-users"></i> Doctor
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="finishreceipt.php">
            <i class="fas fa-users"></i> Receipt
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

    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- เพิ่มฟอร์มค้นหา -->
            <form action="" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="ค้นหาจากสถานะ">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </div>
            </form>
            <!-- ส่วนของเมนูด้านข้าง -->
        </div>
        <div class="container mt-5">
    <h1 class="text-center mb-4">CILNIC FUND</h1>
    
    <!-- เพิ่มฟอร์มค้นหา -->
    <form action="" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="ค้นหาจากสถานะ">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
        </div>
    </form>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ชื่อ</th>              
                <th>คลินิก</th>          
                <th>บริการ</th>
                <th>ราคา</th>        
                <th>แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $report): ?>
            <tr>
                <td><?php echo $report['patient']; ?></td>
           
                <td><?php echo $report['state']; ?></td>
                <td><?php echo $report['information']; ?></td>
                <td><?php echo $report['price']; ?></td> 
                
                <td>
                    <a href='edit_report.php?id=<?php echo $report["id"]; ?>' class='btn btn-primary'>แก้ไข</a>
                    <a href='delete_report.php?id=<?php echo $report["id"]; ?>' class='btn btn-danger btn-sm'>ลบ</a>          
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- แสดงผลรวมเงินทั้งหมด -->
    <div class="total-price">
        <h4>ผลรวมเงินทั้งหมด: <?php echo $totalPrice; ?> บาท</h4>
        <h4>จำนวนผู้ป่วยทั้งหมด: <?php echo $totalPatients; ?> คน</h4>
    </div>
    <a href="dashbapomen.php" class="btn btn-secondary">ย้อนกลับ</a>
    <a href="dashb.php" class="btn btn-secondary">กลับหน้าหลัก</a>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script> 
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('form').addEventListener('submit', function(event) {
                event.preventDefault(); // ป้องกันการส่งแบบฟอร์ม
                var searchValue = document.querySelector('input[name="search"]').value.toLowerCase();
                var rows = document.querySelectorAll('tbody tr');
                rows.forEach(function(row) {
                    var state = row.querySelector('td:first-child').textContent.toLowerCase();
                    if (state.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
        
    </script>  
</body>
</html>
