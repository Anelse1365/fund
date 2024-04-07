<?php
session_start();
require_once 'config2/db2.php';

// เช็คว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin2.php');
    exit(); 
}

$user_id = $_SESSION['user_login'];

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// เตรียมคำสั่ง SQL เริ่มต้น
$sql = "SELECT * FROM receipe WHERE id_patient = $user_id";

// การกรองข้อมูลจากฟอร์มค้นหา

if(isset($_GET['nationality']) && !empty($_GET['nationality'])) {
    $nationality  = $_GET['nationality'];
    $sql .= " AND nationality LIKE '%$nationality%'";
}
if(isset($_GET['state']) && !empty($_GET['state'])) {
    $state  = $_GET['state'];
    $sql .= " AND state LIKE '%$state%'";
}
if(isset($_GET['doctor']) && !empty($_GET['doctor'])) {
    $doctor  = $_GET['doctor'];
    $sql .= " AND doctor LIKE '%$doctor%'";
}
if(isset($_GET['information']) && !empty($_GET['information'])) {
    $information  = $_GET['information'];
    $sql .= " AND information LIKE '%$information%'";
}
if(isset($_GET['comment']) && !empty($_GET['comment'])) {
    $comment  = $_GET['comment'];
    $sql .= " AND comment LIKE '%$comment%'";
}
if(isset($_GET['date']) && !empty($_GET['date'])) {
    $date  = $_GET['date'];
    $sql .= " AND date LIKE '%$date%'";
}
if(isset($_GET['timeInput']) && !empty($_GET['timeInput'])) {
    $timeInput  = $_GET['timeInput'];
    $sql .= " AND timeInput LIKE '%$timeInput%'";
}
if(isset($_GET['created_at']) && !empty($_GET['created_at'])) {
    $created_at  = $_GET['created_at'];
    $sql .= " AND created_at LIKE '%$created_at%'";
}

// ส่งคำสั่ง SQL ไปยังฐานข้อมูล
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จการนัดจอง</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .receipt {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
            border: 2px solid #17a2b8;
        }
        .receipt-header {
            background-color: #8BD2EC;
            color: #FDFFE4;
            padding: 15px;
            text-align: center;
            border-radius: 6px 6px 0 0;
        }
        h2 {
            margin-bottom: 20px;
        }
        .table th, .table td {
            border-color: #dee2e6;
            text-align: left;
        }
        .table th {
            background-color: #F8F5FD;
            color: #695A5B;
        }
        </style>
</head>
<body>
<div class="container">
                  <!-- เพิ่มฟอร์มสำหรับกรองข้อมูล -->
<form method="get" action="">    
    <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="คลินิก" name="state">
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="หมอ" name="doctor">
        </div>

        <div class="col" >
            <input type="text" class="form-control" placeholder="วันที่ส่ง" name="created_at">
        </div>
        <div class="col" >
            <input type="text" class="form-control" placeholder="วันที่นัด" name="date">
        </div>
        <div class="col" >
            <input type="text" class="form-control" placeholder="เวลานัด" name="timeInput">
        </div>
        <!-- เพิ่มฟิลเตอร์อื่น ๆ ตามต้องการ -->
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
        </div>
    </div>
</form>
    <?php
    // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        // วนลูปผ่านแต่ละแถวของข้อมูล
        while($row = $result->fetch_assoc()) {
            // แสดงข้อมูลในตาราง
            echo "<div class='receipt'>";
            echo "<div class='receipt-header'>";
            echo "<h2>ใบเสร็จการนัดจอง</h2>";        
            echo "</div>";
            echo "<table class='table table-bordered'>";
            echo "<tbody>";
            echo "<tr><th scope='row'>ชื่อ-นามสกุล</th><td>" . $row['patient'] . "</td></tr>";
            echo "<tr><th scope='row'>อีเมล</th><td>" . $row['email'] . "</td></tr>";
            echo "<tr><th scope='row'>เบอร์โทร</th><td>" . $row['phone_number'] . "</td></tr>";
            echo "<tr><th scope='row'>อายุ</th><td>" . $row['age'] . "</td></tr>";
            echo "<tr><th scope='row'>เพศ</th><td>" . $row['gender'] . "</td></tr>";
            echo "<tr><th scope='row'>สัญชาติ</th><td>" . $row['nationality'] . "</td></tr>";
            echo "<tr><th scope='row'>คลินิกที่ทำ</th><td>" . $row['state'] . "</td></tr>";
            echo "<tr><th scope='row'>หมอ</th><td>" . $row['doctor'] . "</td></tr>";
            echo "<tr><th scope='row'>เวลาที่ส่ง</th><td>" . $row['created_at'] . "</td></tr>";
            echo "<tr><th scope='row'>วันที่นัด</th><td>" . $row['date'] . "</td></tr>";
            echo "<tr><th scope='row'>เวลาที่นัด</th><td>" . $row['timeInput'] . "</td></tr>";
            echo "</tbody></table>";
            echo "<div class='text-center'>";
            echo "<h6>รายละเอียดเพิ่มเติมเกี่ยวกับการนัดหมายสามารถติดต่อเราได้ที่ เบอร์ 084-991-1111</h6>";
            echo "</div>";
            echo "<div class='text-center'>";
            echo "<a href='index2.php' class='btn btn-primary'>กลับหน้าแรก</a>";
            echo "<a href='user2.php' class='btn btn-secondary'>ไปยังโปรไฟล์</a>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>

<!-- Link to Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>