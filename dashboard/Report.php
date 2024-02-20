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
  
  
                // SQL query to fetch data from database
    $sql = "SELECT * FROM patien";
    $stmt = $conn->prepare($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <!-- Include ECharts -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.1/dist/echarts.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
</head>
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


</style>



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

    <div class="container mt-5">
        <h1 class="text-center mb-4">ประวัติคนไข้</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทร</th>
                    <th>อายุ</th>
                    <th>เพศ</th>
                    <th>สัญชาติ</th>
                    <th>คลินิก</th>
                    <th>หมอ</th>
                    <th>วันที่</th>
                    <th>เวลา</th>
                    <th>ข้อมูลเพิ่มเติม</th>
                    <th>ราคา</th>
                    <th>ความคิดเห็น</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?php echo $report['patient']; ?></td>
                    <td><?php echo $report['email']; ?></td>
                    <td><?php echo $report['phone_number']; ?></td>
                    <td><?php echo $report['age']; ?></td>
                    <td><?php echo $report['gender']; ?></td>
                    <td><?php echo $report['nationality']; ?></td>
                    <td><?php echo $report['state']; ?></td>
                    <td><?php echo $report['doctor']; ?></td>
                    <td><?php echo $report['date']; ?></td>
                    <td><?php echo $report['timeInput']; ?></td>
                    <td><?php echo $report['information']; ?></td>
                    <td><?php echo $report['price']; ?></td>
                    <td><?php echo $report['comment']; ?></td>
                    <td>
                        <a href='edit_report.php?id=<?php echo $report["id"]; ?>' class='btn btn-primary'>แก้ไข</a>
                        <a href='deletereports.php?id=<?php echo $report["id"]; ?>' class='btn btn-danger btn-sm'>ลบ</a>
                       
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashbapomen.php" class="btn btn-secondary">ย้อนกลับ</a>
        <a href="dashb.php" class="btn btn-secondary">กลับหน้าหลัก</a>
    </div>
</body>
</html>
