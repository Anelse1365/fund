<?php
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

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $patient = $_POST['patient'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $state = $_POST['state'];
    $date = $_POST['date'];
    $timeInput = $_POST['timeInput'];
    $doctor = $_POST['doctor'];

    try {
        // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $sql = "INSERT INTO receipe (patient, email, phone_number, age, gender, nationality, state, date, timeInput, doctor) 
                VALUES (:patient, :email, :phone_number, :age, :gender, :nationality, :state, :date, :timeInput, :doctor)";
        
        // พร้อมคำสั่ง SQL ของเราเพื่อการใช้งาน
        $stmt = $conn->prepare($sql);
        
        // ผูกค่าพารามิเตอร์
        $stmt->bindParam(':patient', $patient);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':timeInput', $timeInput);
        $stmt->bindParam(':doctor', $doctor);
        
        // ประมวลผลคำสั่ง SQL
        $stmt->execute();

        // ส่งกลับไปยังหน้าหลักหลังจากบันทึกข้อมูลเสร็จสมบูรณ์
        header("Location: dashbapomen.php");
        exit();
    } catch(PDOException $e) {
        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $e->getMessage();
    }
}
?>
