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
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
    $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
}

if (isset($_POST['summit'])) {
    $doctor = $_POST['doctor'];
    $info = $_POST['infomation'];
    $patient = $_POST["patient"];
    $date = $_POST['date'];
    $time = $_POST['timeInput'];

    $sql = "INSERT INTO appointmen (user_id,doctor_id, information,appointment_date,appointment_time,patient) VALUES ('$user_id' ,'$doctor', '$info','$date',' $time','$patient')";


    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
