<?php
// Check if ID parameter is passed through URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fund";

    try {
        // Connect to database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM appointmen WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Fetch appointment data
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row) {
            echo "Appointmen not found.";
            exit();
        }
        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Retrieve form data
            $patient = $_POST['patient'];
            $email = $_POST['email'];
            $information = $_POST['information'];     
          
            $state = $_POST['state'];
           
        
            // Prepare SQL statement to update appointment data
            $update_stmt = $conn->prepare("UPDATE appointmen SET patient = :patient, email = :email, information = :information, state = :state WHERE id = :id");

// Bind parameters
$update_stmt->bindParam(':patient', $patient);
$update_stmt->bindParam(':email', $email);
$update_stmt->bindParam(':information', $information);
$update_stmt->bindParam(':state', $state);
$update_stmt->bindParam(':id', $id);

         
            // Execute the update statement
            if ($update_stmt->execute()) {
                // Insert data into the receipt table
                $receipt_stmt = $conn->prepare("INSERT INTO receipt (patient, email, information, doctor_id, state, appointment_date, appointment_time) VALUES (:patient, :email, :information, :state)");
                $receipt_stmt->bindParam(':patient', $patient);
                $receipt_stmt->bindParam(':email', $email);
                $receipt_stmt->bindParam(':information', $information);
                $receipt_stmt->bindParam(':doctor_id', $doctor_id);
                $receipt_stmt->bindParam(':state', $state);
                $receipt_stmt->bindParam(':appointment_date', $appointment_date);
                $receipt_stmt->bindParam(':appointment_time', $appointment_time);

                // Execute the receipt statement
                if ($receipt_stmt->execute()) {
                    echo "Appointment updated successfully.";
                } else {
                    echo "Error updating appointmen or creating receipt.";
                }
            } else {
                echo "Error updating appointmen.";
            }
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {
    echo "ID parameter is missing.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Appointment</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 50px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border: 2px solid #dee2e6;
      border-radius: 20px;
      padding: 10px;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
    }
    .btn {
      border-radius: 20px;
      padding: 10px 20px;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }
  </style>
</head>
<body>
  <!-- Content -->
  <div class="container">
    <h2 class="mb-4">Edit Appointment</h2>
    <form method="post" action="receiptapomen.php">

      <div class="form-group">
        <label for="patient">Patient</label>
        <input type="text" class="form-control" id="patient" name="patient" value="<?php echo $row['patient']; ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
      </div>
      <div class="form-group">
        <label for="information">บริการ</label>
        <select class="form-control" id="information" name="information">
          <option value="รักษาทันตกรรมทั่วไป" <?php echo ($row['information'] == 'รักษาทันตกรรมทั่วไป') ? 'selected' : ''; ?>>รักษาทันตกรรมทั่วไป</option>
          <option value="ผ่าฟัน" <?php echo ($row['information'] == 'ผ่าฟัน') ? 'selected' : ''; ?>>ผ่าฟัน</option>
          <option value="ถอนฟัน" <?php echo ($row['information'] == 'ถอนฟัน') ? 'selected' : ''; ?>>ถอนฟัน</option>
          <option value="อื่นๆ" <?php echo ($row['information'] == 'อื่นๆ') ? 'selected' : ''; ?>>บริการอื่นๆ</option>
        </select>
      </div>

      <div class="form-group">
    <label for="doctor_id">Doctor</label>
    <select class="form-control" id="doctor_id" name="doctor_id">
        <option value="" disabled selected>Select Doctor</option>
        <option value="หมอA">หมอA</option>
        <option value="หมอB">หมอB</option>
        <option value="หมอC">หมอC</option>
        <option value="หมอD">หมอD</option>
        <option value="หมอE">หมอE</option>
        <option value="หมอF">หมอF</option>
    </select>
</div>

<div class="form-group">
    <label for="appointment_date">วันที่นัดหมาย</label>
    <input type="date" class="form-control" id="appointment_date" name="appointment_date">
</div>

<div class="form-group">
    <label for="appointment_time">เวลานัดหมาย</label>
    <input type="time" class="form-control" id="appointment_time" name="appointment_time">
</div>


      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  
    <a href="dashb.php" class="btn btn-secondary mt-3">กลับหน้าหลัก</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
