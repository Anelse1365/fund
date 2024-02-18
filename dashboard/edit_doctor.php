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
        $stmt = $conn->prepare("SELECT * FROM doctors WHERE id = :id");
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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $education = $_POST['education'];
    $graduation = $_POST['graduation'];

    // อัปเดตข้อมูลหมอในฐานข้อมูล
    $update_stmt = $conn->prepare("UPDATE doctors SET first_name = :first_name, last_name = :last_name, age = :age, gender = :gender, nationality = :nationality, email = :email, phone_number = :phone_number, education = :education, graduation = :graduation WHERE id = :id");

    $update_stmt->bindParam(':id', $id);
    $update_stmt->bindParam(':first_name', $first_name);
    $update_stmt->bindParam(':last_name', $last_name);
    $update_stmt->bindParam(':age', $age);
    $update_stmt->bindParam(':gender', $gender);
    $update_stmt->bindParam(':nationality', $nationality);
    $update_stmt->bindParam(':email', $email);
    $update_stmt->bindParam(':phone_number', $phone_number);
    $update_stmt->bindParam(':education', $education);
    $update_stmt->bindParam(':graduation', $graduation);

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
    <title>แก้ไขข้อมูลหมอ</title>
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
                    <h3 class="mb-0">แก้ไขข้อมูลหมอ</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="first_name">ชื่อ</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $doctor['first_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">นามสกุล</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $doctor['last_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="age">อายุ</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo $doctor['age']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">เพศ</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $doctor['gender']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nationality">สัญชาติ</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $doctor['nationality']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $doctor['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">เบอร์โทร</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo $doctor['phone_number']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="education">การศึกษา</label>
                            <input type="text" class="form-control" id="education" name="education" value="<?php echo $doctor['education']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="graduation">จบการศึกษา</label>
                            <input type="text" class="form-control" id="graduation" name="graduation" value="<?php echo $doctor['graduation']; ?>">
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
