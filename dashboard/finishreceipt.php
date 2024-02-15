<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Finished</title>
</head>
<body>
    <h2>Receipt Created Successfully</h2>
    <?php
    // เชื่อมต่อกับฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fund";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ดึงข้อมูลใบเสร็จล่าสุดจากฐานข้อมูล
    $sql = "SELECT * FROM receipts ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p><strong>Patient Name:</strong> " . $row["patient_name"] . "</p>";
        echo "<p><strong>Doctor:</strong> " . $row["doctor"] . "</p>";
        echo "<p><strong>Total Amount:</strong> " . $row["total_amount"] . "</p>";
    } else {
        echo "No receipt found.";
    }
    $conn->close();
    ?>
</body>
</html>
