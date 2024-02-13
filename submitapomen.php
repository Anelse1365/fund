<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $doctor = $_POST['doctor'];
    $info = $_POST['infomation'];
    $date = $_POST['date'];
    $time = $_POST['timeInput'];
    $email = $_POST['email'];
    $patient = $_POST['patient'];
    $state = $_POST['state'];

    // Check if all required fields are filled
    if (!empty($doctor) && !empty($info) && !empty($date) && !empty($time) && !empty($email) && !empty($patient) && !empty($state)) {
        // Prepare SQL query
        $sql = "INSERT INTO appointmen (doctor_id, information, appointment_date, appointment_time, email, patient, state) VALUES ('$doctor', '$info', '$date', '$time', '$email', '$patient', '$state')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            echo "บันทึกการนัดหมายเรียบร้อยแล้ว!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
    }
}

// Close connection
$conn->close();
?>
