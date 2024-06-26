<?php
session_start();

require_once '../config2/db2.php';

if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location:../signin2.php');
    exit; // จบการทำงานทันทีหลังจาก redirect
}

if (isset($_SESSION['admin_login'])) {
    $user_id = $_SESSION['admin_login'];
    $stmt = $conn->prepare("SELECT * FROM patien WHERE id = ?");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query เริ่มต้น
    $sql = "SELECT * FROM doctors WHERE 1";

    // Check if search parameters are provided
    if (isset($_GET['first_name']) && !empty($_GET['first_name'])) {
        $first_name = $_GET['first_name'];
        $sql .= " AND first_name LIKE '%$first_name%'";
    }

    if (isset($_GET['email']) && !empty($_GET['email'])) {
        $email = $_GET['email'];
        $sql .= " AND email LIKE '%$email%'";
    }
    if (isset($_GET['phone_number']) && !empty($_GET['phone_number'])) {
        $phone_number = $_GET['phone_number'];
        $sql .= " AND phone_number LIKE '%$phone_number%'";
    }
    if (isset($_GET['age']) && !empty($_GET['age'])) {
        $age = $_GET['age'];
        $sql .= " AND age LIKE '%$age%'";
    }
    if (isset($_GET['nationality']) && !empty($_GET['nationality'])) {
        $nationality = $_GET['nationality'];
        $sql .= " AND nationality LIKE '%$nationality%'";
    }
    if (isset($_GET['gender']) && !empty($_GET['gender'])) {
        $gender = $_GET['gender'];
        $sql .= " AND gender LIKE '%$gender%'";
    }
    if (isset($_GET['education']) && !empty($_GET['education'])) {
        $education = $_GET['education'];
        $sql .= " AND education LIKE '%$education%'";
    }
    if (isset($_GET['graduation']) && !empty($_GET['graduation'])) {
        $graduation = $_GET['graduation'];
        $sql .= " AND graduation LIKE '%$graduation%'";
    }

    // เพิ่มเงื่อนไขการกรองฟิลเตอร์อื่น ๆ ตามต้องการ

    // ดึงข้อมูลจากฐานข้อมูล
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // หากเกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}

    try {
    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลตารางทำงานของหมอ
    $sql = "SELECT * FROM schedules";

    // สร้างคำสั่ง SQL โดยการเชื่อมต่อเงื่อนไขการค้นหาจากแบบฟอร์มถ้ามี
    if (isset($_GET['doctor_id']) && !empty($_GET['doctor_id'])) {
        $doctor_id = $_GET['doctor_id'];
        $sql .= " WHERE doctor_id = $doctor_id";
    }

    // ดึงข้อมูลจากฐานข้อมูล
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // แสดงข้อผิดพลาดหากไม่สามารถดึงข้อมูลได้
    echo "Error: " . $e->getMessage();
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
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="main1.php">FUND CLINIC</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">


            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <?php echo $row['firstname'] . ' ' . $row['lastname'] ?>
                </a>
            </li>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Products
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="dash_produc.php">Overview</a>
                                <a class="nav-link" href="order.php">Order</a>
                                <a class="nav-link" href="../shopping cart/admin.php">Upload</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Info
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
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
        <h2 class="text-center mb-4">ข้อมูลหมอ</h2>
        <form method="get" action="">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="ค้นหาตามชื่อ" name="first_name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="ค้นหาตามอีเมล" name="email">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="ค้นหาตามเบอร์โทร" name="phone_number">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="อายุ" name="age">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="สัญชาติ" name="nationality">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="เพศ" name="gender">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="การศึกษา" name="education">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="จบการศึกษา" name="graduation">
                </div>
                <!-- เพิ่มฟิลเตอร์อื่น ๆ ตามต้องการ -->
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </div>
            </div>
        </form>
        <a href="adddoctor.php" class="btn btn-primary mt-3 d-block mx-auto"><i class="fas fa-plus-circle mr-1"></i>
            เพิ่มหมอ</a>
        <a href="doctor/doctorschedule.php" class="btn btn-primary mt-3 d-block mx-auto"><i
                class="fas fa-plus-circle mr-1"></i>ตารางงาน</a>


        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>อายุ</th>
                        <th>เพศ</th>
                        <th>สัญชาติ</th>
                        <th>อีเมล</th>
                        <th>เบอร์โทร</th>
                        <th>การศึกษา</th>
                        <th>จบการศึกษา</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctors as $doctor): ?>
                        <tr>
                            <td>
                                <?php echo $doctor['first_name']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['age']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['gender']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['nationality']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['email']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['phone_number']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['education']; ?>
                            </td>
                            <td>
                                <?php echo $doctor['graduation']; ?>
                            </td>
                            <td>
                                <a href="edit_doctor.php?id=<?php echo $doctor['id']; ?>"
                                    class="btn btn-primary btn-sm">แก้ไข</a>
                                <a href="delete_doctor.php?id=<?php echo $doctor['id']; ?>"
                                    class="btn btn-danger btn-sm">ลบ</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">ตารางทำงานหมอ</h2>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>doctor_id</th>
                        <th>patient_id</th>
                        <th>date</th>
                        <th>time</th>
                        <th>note</th>
                        <th>created_at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr>
                            <td>
                                <?php echo $schedule['id']; ?>
                            </td>
                            <td>
                                <?php echo $schedule['doctor_id']; ?>
                            </td>
                            <td>
                                <?php echo $schedule['patient_id']; ?>
                            </td>
                            <td>
                                <?php echo $schedule['date']; ?>
                            </td>
                            <td>
                                <?php echo $schedule['time']; ?>
                            </td>
                            <td>
                                <?php echo $schedule['note']; ?>
                            </td>
                            <td>
                                <?php echo $schedule['created_at']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ลิงก์ JavaScript ของ Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>