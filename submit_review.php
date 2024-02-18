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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_name = $_POST["doctor_name"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    $patient = $_POST["patient"];
    $email = $_POST["email"];
    $roomFilter = isset($_GET['room']) ? $_GET['room'] : '';

    $sql = "INSERT INTO reviews (doctor_name, rating, comment ,patient,email) VALUES ('$doctor_name', $rating, '$comment', '$patient','$email')";

    if (!empty($roomFilter)) {
      
        
    }

    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
