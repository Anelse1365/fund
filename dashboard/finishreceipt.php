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

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง receipe
$sql = "SELECT * FROM receipe";

// ประมวลผลคำสั่ง SQL
$stmt = $conn->prepare($sql);
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการนัดหมอฟัน</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .container {
            max-width: 960px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">ใบเสร็จการนัดจอง</h1>
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
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?php echo $appointment['patient']; ?></td>
                    <td><?php echo $appointment['email']; ?></td>
                    <td><?php echo $appointment['phone_number']; ?></td>
                    <td><?php echo $appointment['age']; ?></td>
                    <td><?php echo $appointment['gender']; ?></td>
                    <td><?php echo $appointment['nationality']; ?></td>
                    <td><?php echo $appointment['state']; ?></td>
                   
                    <td><?php echo $appointment['doctor']; ?></td>
                    <td><?php echo $appointment['date']; ?></td>
                    <td><?php echo $appointment['timeInput']; ?></td>
                    <td>
    <a href='editreceipt.php?id=<?php echo $appointment["id"]; ?>' class='btn btn-primary'>แก้ไข</a>
    <a href='deletereceipt.php?id=<?php echo $appointment["id"]; ?>' class='btn btn-danger btn-sm'>ลบ</a>
</td>

 </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashbapomen.php" class="btn btn-secondary">ย้อนกลับ</a>
        <a href="dashb.php" class="btn btn-secondary">กลับหน้าหลัก</a>
    </div>
    </div>
</body>
</html>
