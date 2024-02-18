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
} catch(PDOException $e) {
    // หากเกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อรีวิว</title>
    <!-- ลิงก์ CSS ของ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .table {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }
        .btn {
            padding: 5px 12px;
            font-size: 14px;
        }
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
</head>
<body>
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
          <a class="nav-link" href="doctorsdash.php">
            <i class="fas fa-users"></i> doctor
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="doctorsdash.php">
            <i class="fas fa-users"></i> Reviews
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-chart-bar"></i> Reports
          </a>
        </li>
      </ul>
    </div>
  </nav>



<div class="container mt-5">
    <h2 class="text-center mb-4">ข้อมูลการรีวิว</h2>


    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ผู้รีวิว</th>
                    <th>ชื่อหมอ</th>
                    <th>comment</th>
                    <th>คะแนน</th>
                    <th>อีเมล</th>
                    <th>วันที่/เวลา</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $reviews): ?>
                <tr>
                    <td><?php echo $reviews['patient']; ?></td>
                    <td><?php echo $reviews['doctor_name']; ?></td>
                    <td><?php echo $reviews['comment']; ?></td>
                    <td><?php echo $reviews['rating']; ?></td>
                    <td><?php echo $reviews['email']; ?></td>
                    <td><?php echo $reviews['created_at']; ?></td>
                    <td>
                        <a href="edit_review_dashboard.php?id=<?php echo $reviews['id']; ?>" class="btn btn-primary btn-sm">แก้ไข</a>
                        <a href="delete_review_dashboard.php?id=<?php echo $reviews['id']; ?>" class="btn btn-danger btn-sm">ลบ</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
    </div>
</div>

<!-- ลิงก์ JavaScript ของ Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>








