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

    // คำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM receipe WHERE id = :id";

    // ประมวลผลคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// ส่งกลับไปยังหน้า finishreceipt.php หลังจากลบข้อมูลเสร็จสิ้น
header('Location: finishreceipt.php');
exit;
?>
