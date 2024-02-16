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

    // เก็บค่าที่รับมาจากฟอร์ม
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $education = $_POST['education'];
    $graduation = $_POST['graduation'];

    // เตรียมและ execute คำสั่ง SQL เพื่อเพิ่มข้อมูลหมอใหม่
    $stmt = $conn->prepare("INSERT INTO doctors (first_name, last_name, age, gender, nationality, email, phone_number, education, graduation) 
                            VALUES (:first_name, :last_name, :age, :gender, :nationality, :email, :phone_number, :education, :graduation)");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':nationality', $nationality);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':education', $education);
    $stmt->bindParam(':graduation', $graduation);
    $stmt->execute();

    // ส่งกลับไปยังหน้า dashboard.php หลังจากเพิ่มข้อมูลเสร็จสิ้น
    header("Location: doctorsdash.php");
    exit();
} catch(PDOException $e) {
    // หากเกิดข้อผิดพลาดในการเพิ่มข้อมูล ให้แสดงข้อความผิดพลาด
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}
?>
