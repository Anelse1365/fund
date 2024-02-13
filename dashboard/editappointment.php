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

        // Fetch patient data
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$patient) {
            echo "Appointment not found.";
            exit();
        }
        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Retrieve form data
            $patient = $_POST['patient'];
            $email = $_POST['email'];
            $information = $_POST['information'];     
            $doctor_id = $_POST['doctor_id'];
            $state = $_POST['state'];
            $appointment_date = $_POST['appointment_date'];
            $appointment_time = $_POST['appointment_time'];
        
            // Prepare SQL statement to update appointment data
            $update_stmt = $conn->prepare("UPDATE appointmen SET patient = :patient, email = :email, information = :information, doctor_id = :doctor_id, state = :state, appointment_date = :appointment_date, appointment_time = :appointment_time WHERE id = :id");

            // Bind parameters
            $update_stmt->bindParam(':patient', $patient);
            $update_stmt->bindParam(':email', $email);
            $update_stmt->bindParam(':information', $information);
            $update_stmt->bindParam(':doctor_id', $doctor_id);
            $update_stmt->bindParam(':state', $state);
            $update_stmt->bindParam(':appointment_date', $appointment_date);
            $update_stmt->bindParam(':appointment_time', $appointment_time);
            $update_stmt->bindParam(':id', $id);
        
            // Execute the update statement
            if ($update_stmt->execute()) {
                echo "Appointment updated successfully.";
            } else {
                echo "Error updating appointment.";
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
    <form method="post">
      <div class="form-group">
        <label for="patient">Patient</label>
        <input type="text" class="form-control" id="patient" name="patient" value="<?php echo $patient['patient']; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>">
      </div>
      <div class="form-group">
        <label for="information">บริการ</label>
        <select class="form-control" id="information" name="information">
          <option value="ดัดฟัน" <?php echo ($patient['information'] == 'ดัดฟัน') ? 'selected' : ''; ?>>ดัดฟัน</option>
          <option value="ถอนฟัน" <?php echo ($patient['information'] == 'ถอนฟัน') ? 'selected' : ''; ?>>ถอนฟัน</option>
          <option value="จัดฟัน" <?php echo ($patient['information'] == 'จัดฟัน') ? 'selected' : ''; ?>>จัดฟัน</option>
        </select>
      </div>
      <div class="form-group">
        <label for="doctor_id">Doctor</label>
        <select class="form-control" id="doctor_id" name="doctor_id">
          <option value="หมอA" <?php echo ($patient['doctor_id'] == 'หมอA') ? 'selected' : ''; ?>>หมอA</option>
          <option value="หมอB" <?php echo ($patient['doctor_id'] == 'หมอB') ? 'selected' : ''; ?>>หมอB</option>
          <option value="หมอC" <?php echo ($patient['doctor_id'] == 'หมอC') ? 'selected' : ''; ?>>หมอC</option>
          <option value="หมอD" <?php echo ($patient['doctor_id'] == 'หมอD') ? 'selected' : ''; ?>>หมอD</option>
          <option value="หมอE" <?php echo ($patient['doctor_id'] == 'หมอE') ? 'selected' : ''; ?>>หมอE</option>
          <option value="หมอF" <?php echo ($patient['doctor_id'] == 'หมอF') ? 'selected' : ''; ?>>หมอF</option>
        </select>
      </div>
      <div class="form-group">
        <label for="state">State</label>
        <input type="text" class="form-control" id="state" name="state" value="<?php echo $patient['state']; ?>">
      </div>
      <div class="form-group">
        <label for="appointment_date">Appointment Date</label>
        <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?php echo $patient['appointment_date']; ?>">
      </div>
      <div class="form-group">
        <label for="appointment_time">Appointment Time</label>
        <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?php echo $patient['appointment_time']; ?>">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <a href="dashb.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>