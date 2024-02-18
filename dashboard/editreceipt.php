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

// ตรวจสอบว่ามีการส่งค่า ID มาหรือไม่
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // ดึงค่า ID จาก URL
    $id = $_GET['id'];

    // คำสั่ง SQL เพื่อดึงข้อมูลของแถวนั้น
    $sql = "SELECT * FROM receipe WHERE id = :id";

    // ประมวลผลคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if(!$appointment) {
        // ถ้าไม่พบข้อมูลกลับไปหน้าก่อนหน้า
        header('Location: finishreceipt.php');
        exit;
    }
} else {
    // ถ้าไม่มี ID ที่ถูกส่งมาก็กลับไปหน้าก่อนหน้า
    header('Location: finishreceipt.php');
    exit;
}

// ถ้ามีการกดปุ่ม "บันทึก"
if(isset($_POST['submit'])) {
    // รับค่าที่แก้ไขจากฟอร์ม
    $patient = $_POST['patient'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $state = $_POST['state'];
    $information = $_POST['information'];
    $doctor = $_POST['doctor'];

    // คำสั่ง SQL สำหรับการอัปเดตข้อมูล
    $sql = "UPDATE receipe SET patient = :patient, email = :email, phone_number = :phone_number, age = :age, gender = :gender, nationality = :nationality, state = :state, information = :information, doctor = :doctor WHERE id = :id";

    // ประมวลผลคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patient', $patient);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':nationality', $nationality);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':information', $information);
    $stmt->bindParam(':doctor', $doctor);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // ส่งกลับไปยังหน้า finishreceipt.php หลังจากการอัปเดตข้อมูลเสร็จสิ้น
    header('Location: finishreceipt.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขรายการนัดหมอฟัน</title>
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
        <h1 class="text-center mb-4">แก้ไขรายการนัดหมอฟัน</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="patient">ชื่อ-นามสกุล:</label>
                <input type="text" class="form-control" name="patient" value="<?php echo $appointment['patient']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">อีเมล:</label>
                <input type="email" class="form-control" name="email" value="<?php echo $appointment['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">เบอร์โทร:</label>
                <input type="tel" class="form-control" name="phone_number" value="<?php echo $appointment['phone_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="age">อายุ:</label>
                <input type="number" class="form-control" name="age" value="<?php echo $appointment['age']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">เพศ:</label>
                <input type="text" class="form-control" name="gender" value="<?php echo $appointment['gender']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nationality">สัญชาติ:</label>
                <input type="text" class="form-control" name="nationality" value="<?php echo $appointment['nationality']; ?>" required>
            </div>
            <div class="form-group">
                <label for="state">คลินิก:</label>
                <input type="text" class="form-control" name="state" value="<?php echo $appointment['state']; ?>">
            </div>
            <div class="form-group">
                <label for="information">บริการ:</label>
                <input type="text" class="form-control" name="information" value="<?php echo $appointment['information']; ?>">
            </div>
            <div class="form-group">
                <label for="doctor">หมอ:</label>
                <select class="form-control" name="doctor" required>
                    <option value="หมอA" <?php echo ($appointment['doctor'] == 'หมอA') ? 'selected' : ''; ?>>หมอA</option>
                    <option value="หมอB" <?php echo ($appointment['doctor'] == 'หมอB') ? 'selected' : ''; ?>>หมอB</option>
                    <option value="หมอC" <?php echo ($appointment['doctor'] == 'หมอC') ? 'selected' : ''; ?>>หมอC</option>
                    <option value="หมอD" <?php echo ($appointment['doctor'] == 'หมอD') ? 'selected' : ''; ?>>หมอD</option>
                    <option value="หมอE" <?php echo ($appointment['doctor'] == 'หมอE') ? 'selected' : ''; ?>>หมอE</option>
                    <option value="หมอF" <?php echo ($appointment['doctor'] == 'หมอF') ? 'selected' : ''; ?>>หมอF</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
            <a href="finishreceipt.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    </div>
</body>
</html>
