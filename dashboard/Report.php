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
        <h1 class="text-center mb-4">ทำประวัติคนไข้</h1>
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
                        <a href='editreports.php?id=<?php echo $report["id"]; ?>' class='btn btn-primary'>แก้ไข</a>
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
