<?php
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลมาจากแบบฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fund";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // กำหนดค่าที่ได้รับมาจากแบบฟอร์ม
        $patient = $_POST['patient'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $nationality = $_POST['nationality'];
        $state = $_POST['state'];
        $doctor = $_POST['doctor'];
        $date = $_POST['date'];
        $timeInput = $_POST['timeInput'];
        $information = $_POST['information'];
        $price = $_POST['price'];
        $comment = $_POST['comment'];
        $id_patient = $_POST['id_patient'];

        // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $sql = "INSERT INTO reports (patient, email, phone_number, age, gender, nationality, state, doctor, date, timeInput, information, price, comment,id_patient) 
                VALUES (:patient, :email, :phone_number, :age, :gender, :nationality, :state, :doctor, :date, :timeInput, :information, :price, :comment,:id_patient)";
        
        // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูล
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':patient', $patient);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':doctor', $doctor);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':timeInput', $timeInput);
        $stmt->bindParam(':information', $information);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':id_patient', $id_patient);

        // ประมวลผลคำสั่ง SQL
        $stmt->execute();

        // ส่งกลับไปยังหน้าที่แสดงข้อมูลหรือหน้าหลัก
        header("Location: dashbapomen.php");
        exit();
    } catch(PDOException $e) {
        echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
}
?>
