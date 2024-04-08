<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->prepare("SELECT * FROM patien WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $patient = $row['firstname'] . ' ' . $row['lastname'];
            $email = $row['email'];
            $phone_number = $row['phone_number'];
            $age = $row['age'];
            $gender = $row['gender'];
            $id_patient = $row['id'];
            $nationality = $row['nationality'];

            // รับข้อมูลการนัดหมอจากฟอร์ม
            $state = $_POST['state'];

            // เตรียมคำสั่ง SQL สำหรับบันทึกข้อมูลการนัดหมอลงในฐานข้อมูล
            $sql = "INSERT INTO appointmen (patient, email, phone_number, age, gender, id_patient, nationality, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $patient, $email, $phone_number, $age, $gender, $id_patient, $nationality, $state);

            // ทำการ execute คำสั่ง SQL
            if ($stmt->execute()) {
                echo "บันทึกข้อมูลการนัดหมอเรียบร้อยแล้ว";
            } else {
                echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
            }
        } else {
            echo "ไม่พบข้อมูลผู้ใช้";
        }
    } else {
        echo "กรุณาเข้าสู่ระบบก่อนทำการนัดหมอ";
    }
} else {
    echo "การเรียกใช้งานไม่ถูกต้อง";
}

$conn->close();
?>
