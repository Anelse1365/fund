<?php
// เริ่ม session
session_start();

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

// ดึงข้อมูลหมอจากฐานข้อมูล
$stmt = $conn->query("SELECT * FROM doctors");
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ดึงข้อมูลคนไข้จากฐานข้อมูล
$stmt = $conn->query("SELECT * FROM receipe");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $stmt = $conn->query("SELECT * FROM patien");
// $patients = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงบันทึกตารางงานของหมอ</title>
    <!-- ลิงก์ CSS ของ Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- ลิงก์ CSS สำหรับแก้ไขรูปแบบเพิ่มเติม -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        /* ปรับแต่งสไตล์ของปุ่มเพิ่มหมอ */
        .btn-add-doctor {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">ลงบันทึกตารางเข้าทำงานของหมอ</h2>
        <form action="submit_schedule.php" method="POST">
            <div class="form-group">
                <label for="doctor">เลือกหมอ:</label>
                <select class="form-control" id="doctor" name="doctor" required>
                    <option value="">โปรดเลือกหมอ</option>
                    <!-- วนลูปแสดงรายชื่อหมอ -->
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['first_name'] . " " . $doctor['last_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="patient">เลือกคนไข้:</label>
                <select class="form-control" id="patient" name="patient" required>
                    <option value="">โปรดเลือกคนไข้</option>
                    <!-- วนลูปแสดงรายชื่อคนไข้ -->
                    <?php foreach ($patients as $receipe): ?>
                        <option value="<?php echo $receipe['id']; ?>"><?php echo $receipe['patient']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date">วันที่:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">เวลา:</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="note">บันทึกงาน:</label>
                <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
            </div>
            <!-- ปุ่มสำหรับลงบันทึก -->
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
        <!-- ปุ่มสำหรับเพิ่มหมอ -->
        <a href="doctorsdash.php" class="btn btn-secondary mt-3 btn-add-doctor">ย้อนกลับ</a>
    </div>
</body>
</html>
