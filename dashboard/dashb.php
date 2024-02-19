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

    if (isset($_SESSION['admin_login'])) {
      $user_id = $_SESSION['admin_login'];
      $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  // Fetch total sales from order2 table
$sqlTotalSales = "SELECT SUM(total_price) as totalSales FROM order2";
$stmtTotalSales = $conn->prepare($sqlTotalSales);
$stmtTotalSales->execute();
$totalSales = $stmtTotalSales->fetchColumn();


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
          <a class="nav-link" href="Reports.php">
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

        <!-- Third Column: "ยอดขาย" -->
        <!-- Display total sales in the card -->

<!-- Third Column: "รายได้" -->


<!-- Third Column: "รายได้" -->
<!-- Third Column: "รายได้" -->
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




    <!-- Patient List Table -->
    <div class="table-responsive mt-5">
        <table class="table table-striped table-bordered">
            
            <tbody>
                <?php
                    // Your existing PHP code to fetch and display patient data
                    // ...
                ?>
            </tbody>
        </table>
    </div>
</div>
  <!-- Content -->
  <div class="container mt-5">
    <h2 class="mb-7">Patient List</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>Email</th>
     
            <th>วัน/เวลา</th>
            <th>อายุ</th>
            <th>เพศ</th>
            <th>สัญชาติ</th>
            <th>เบอร์โทร</th>
            <th>ที่อยู่</th>
            <th>เเก้ไข</th>
          </tr>
        </thead>
        <tbody>
        <?php
          // Connection to database
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "fund";
          try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              // SQL query to fetch data from database
              $sql = "SELECT * FROM patien";
              $stmt = $conn->prepare($sql);
              $stmt->execute();

              // Output data of each row
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>".$row["firstname"]."</td>
                        <td>".$row["lastname"]."</td>
                        <td>".$row["email"]."</td>
                       
                        <td>".$row["created_at"]."</td>
                        <td>".$row["age"]."</td>
                        <td>".$row["gender"]."</td>
                        <td>".$row["nationality"]."</td>
                        <td>".$row["phone_number"]."</td>
                        <td>".$row["address"]."</td>
                        <td>
                            <a href='edit.php?id=".$row["id"]."' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i> Edit</a>
                            <a href='delete.php?id=".$row["id"]."' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> Delete</a>
                        </td>
                      </tr>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>