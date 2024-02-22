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

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ส่งมาจากฟอร์ม
    $doctor_id = $_POST['doctor'];
    $patient_id = $_POST['patient'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $note = $_POST['note'];

    // เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในตาราง schedules
    $sql = "INSERT INTO schedules (doctor_id, patient_id, date, time, note) VALUES (:doctor_id, :patient_id, :date, :time, :note)";

    // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
    $stmt = $conn->prepare($sql);

    // ผูกค่าพารามิเตอร์
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':note', $note);

    // ทำการ execute คำสั่ง SQL
    try {
        $stmt->execute();
        echo "บันทึกข้อมูลเรียบร้อยแล้ว";
    } catch(PDOException $e) {
        echo "มีข้อผิดพลาดเกิดขึ้นในการบันทึกข้อมูล: " . $e->getMessage();
    }
} else {
    echo "ไม่พบการส่งข้อมูลผ่านวิธี POST";
}
?>
