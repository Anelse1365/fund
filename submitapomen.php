<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
}

if (isset($_POST['submit'])) { // ปรับเปลี่ยนจาก 'ยืนยัน' เป็นชื่อของปุ่ม submit ในฟอร์ม
    $doctor = $_POST['doctor'];
    $info = $_POST['infomation'];
    $date = $_POST['date'];
    $time = $_POST['timeInput'];
    $email = $_POST['email'];
    $patient = $_POST['patient'];
    $state = $_POST['state'];
    $sql = "INSERT INTO appointmen (user_id, doctor_id, information, appointment_date, appointment_time, email, patient, state) VALUES ('$user_id', '$doctor', '$info', '$date', '$time', '$email', '$patient', '$state')";

    if ($conn->query($sql) === TRUE) {
        echo "บันทึกการนัดหมายเรียบร้อยแล้ว!";
    } else {
        echo "ข้อผิดพลาด: " . $sql . "<br>" . $conn->error;

        
    }
}

$conn->close();
?>
