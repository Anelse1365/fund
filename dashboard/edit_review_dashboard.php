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

    // ตรวจสอบว่ามีการส่งค่า ID มาหรือไม่
    if(isset($_GET['id'])) {
        // ดึงข้อมูลหมอจากฐานข้อมูลโดยใช้ ID ที่ส่งมา
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

        // ตรวจสอบว่าพบข้อมูลหมอหรือไม่
        if(!$doctor) {
            echo "ไม่พบข้อมูลหมอ";
            exit;
        }
    } else {
        echo "ไม่ได้ระบุ ID";
        exit;
    }

} catch(PDOException $e) {
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}

// ตรวจสอบการส่งข้อมูลแบบ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $doctor_name = $_POST['doctor_name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $created_at = $_POST['created_at'];
    $patient = $_POST['patient'];
    $email = $_POST['email'];

    // อัปเดตข้อมูลหมอในฐานข้อมูล
    $update_stmt = $conn->prepare("UPDATE reviews SET doctor_name = :doctor_name, rating = :rating, comment = :comment, created_at = :created_at, patient = :patient, email = :email WHERE id = :id");

    $update_stmt->bindParam(':id', $id);
    $update_stmt->bindParam(':doctor_name', $doctor_name);
    $update_stmt->bindParam(':rating', $rating);
    $update_stmt->bindParam(':comment', $comment);
    $update_stmt->bindParam(':created_at', $created_at);
    $update_stmt->bindParam(':patient', $patient);
    $update_stmt->bindParam(':email', $email);

    if ($update_stmt->execute()) {
        // หากอัปเดตสำเร็จให้เปลี่ยนเส้นทางไปยังหน้ารายการหมอ
        header("Location: doctorsdash.php");
    } else {
        echo "เกิดข้อผิดพลาดขณะอัปเดตข้อมูลหมอ";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรีวิว</title>
    <!-- ลิงก์ CSS ของ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- ลิงก์ไอคอน -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* เพิ่มสไตล์เพื่อปรับแต่งหน้าให้ดูสวยงาม */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">แก้ไขข้อมูลรีวิว</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="doctor_name">ชื่อหมอ</label>
                            <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="<?php echo $doctor['doctor_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="rating">คะแนน</label>
                            <input type="text" class="form-control" id="rating" name="rating" value="<?php echo $doctor['rating']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="comment">comment</label>
                            <input type="text" class="form-control" id="comment" name="comment" value="<?php echo $doctor['comment']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="created_at">วันที่/เวลา</label>
                            <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo $doctor['created_at']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="patient">ผู้รีวิว</label>
                            <input type="text" class="form-control" id="patient" name="patient" value="<?php echo $doctor['patient']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $doctor['email']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                        <a href="doctorsdash.php" class="btn btn-secondary">ยกเลิก</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ลิงก์ JavaScript ของ Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
