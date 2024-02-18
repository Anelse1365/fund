<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
if (isset($_GET['id']) && !empty($_GET['id'])) {
    try {
        // เปิดการเชื่อมต่อฐานข้อมูล
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // เตรียมและประมวลผลคำสั่ง SQL สำหรับการลบข้อมูลรีวิว
        $sql = "DELETE FROM reviews WHERE id = :id";
        $stmt = $conn->prepare($sql);
        // ผูกค่า id กับพารามิเตอร์ในคำสั่ง SQL
        $stmt->bindParam(':id', $_GET['id']);
        // ประมวลผลคำสั่ง SQL
        $stmt->execute();

        // ส่งกลับไปยังหน้า reveiw_dashboard.php หลังจากทำการลบข้อมูลเสร็จสิ้น
        header("Location: reveiw_dashboard.php");
        exit();
    } catch(PDOException $e) {
        echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
    }
} else {
    // ถ้าไม่ได้รับค่า id มาหรือค่า id ไม่ถูกต้อง
    echo "ไม่พบรหัสหมอที่ต้องการลบ";
}
?>
