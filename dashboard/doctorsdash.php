<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจากตาราง doctors
    $stmt = $conn->query("SELECT * FROM doctors");
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>ข้อมูลหมอ</title>
    <!-- ลิงก์ CSS ของ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">ข้อมูลหมอ</h2>
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
                    <td><?php echo $doctor['first_name']; ?></td>
                    <td><?php echo $doctor['last_name']; ?></td>
                    <td><?php echo $doctor['age']; ?></td>
                    <td><?php echo $doctor['gender']; ?></td>
                    <td><?php echo $doctor['nationality']; ?></td>
                    <td><?php echo $doctor['email']; ?></td>
                    <td><?php echo $doctor['phone_number']; ?></td>
                    <td><?php echo $doctor['education']; ?></td>
                    <td><?php echo $doctor['graduation']; ?></td>
                    <td>
                        <a href="edit_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-primary btn-sm">แก้ไข</a>
                        <a href="delete_doctor.php?id=<?php echo $doctor['id']; ?>" class="btn btn-danger btn-sm">ลบ</a>
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
