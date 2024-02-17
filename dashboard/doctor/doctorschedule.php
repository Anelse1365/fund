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
$stmt = $conn->query("SELECT * FROM patien");
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงบันทึกตารางงานของหมอ</title>
    <!-- ลิงก์ CSS ของ Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">ลงบันทึกตารางงานของหมอ</h2>
        <form action="submit_schedule.php" method="POST">
            <div class="form-group">
                <label for="doctor">เลือกหมอ:</label>
                <select class="form-control" id="doctor" name="doctor" required>
                    <option value="">โปรดเลือกหมอ</option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['first_name'] . " " . $doctor['last_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="patient">เลือกคนไข้:</label>
                <select class="form-control" id="patient" name="patien" required>
                    <option value="">โปรดเลือกคนไข้</option>
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?php echo $patient['id']; ?>"><?php echo $patient['firstname'] . " " . $patient['lastname']; ?></option>
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
            <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
    </div>
</body>
</html>
