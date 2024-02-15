<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fund";
    
    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // รับข้อมูลจากฟอร์ม
    $patient_name = $_POST['patient_name'];
    $doctor = $_POST['doctor'];
    $total_amount = $_POST['total_amount'];
    
    // บันทึกข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO receipts (patient_name, doctor, total_amount) VALUES ('$patient_name', '$doctor', '$total_amount')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: finishreceipt.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
