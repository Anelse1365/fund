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

        // Prepare SQL statement to fetch patien data by ID
        $stmt = $conn->prepare("SELECT * FROM reports WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Fetch reports data
        $reports = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$reports) {
            echo "Reports not found.";
            exit();
        }

        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Retrieve form data
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

            // Prepare SQL statement to update reports data
            $update_stmt = $conn->prepare("UPDATE reports SET patient=:patient, email=:email, phone_number=:phone_number, age=:age, gender=:gender, nationality=:nationality, state=:state , doctor=:doctor, date=:date, timeInput=:timeInput, information=:information, price=:price, comment=:comment WHERE id=:id");
            $update_stmt->bindParam(':id', $id);
            $update_stmt->bindParam(':patient', $patient);
            $update_stmt->bindParam(':email', $email);
            $update_stmt->bindParam(':phone_number', $phone_number);
            $update_stmt->bindParam(':age', $age);
            $update_stmt->bindParam(':gender', $gender);
            $update_stmt->bindParam(':nationality', $nationality);
            $update_stmt->bindParam(':state', $state);
            $update_stmt->bindParam(':doctor', $doctor);
            $update_stmt->bindParam(':date', $date);
            $update_stmt->bindParam(':timeInput', $timeInput);
            $update_stmt->bindParam(':information', $information);
            $update_stmt->bindParam(':price', $price);
            $update_stmt->bindParam(':comment', $comment);

            // Execute update statement
            if($update_stmt->execute()) {
                echo "Patien data updated successfully.";
            } else {
                echo "Error updating patien data.";
            }

            if(!$update_stmt->execute()) {
              $errorInfo = $update_stmt->errorInfo();
              echo "Error updating patient data: " . $errorInfo[2];
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
  <title>Edit Reports</title>
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
  <div class="container mt-5">
    <h2 class="mb-4">Edit Reports</h2>
    <form method="post">
      <div class="form-group">
        <label for="patient">Name:</label>
        <input type="text" class="form-control" id="patient" name="patient" value="<?php echo isset($reports['patient']) ? $reports['patient'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($reports['email']) ? $reports['email'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo isset($reports['phone_number']) ? $reports['phone_number'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" id="age" name="age" value="<?php echo isset($reports['age']) ? $reports['age'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" id="gender" name="gender">
          <option value="male" <?php echo (isset($reports['gender']) && $reports['gender'] == 'ชาย') ? 'selected' : ''; ?>>ชาย</option>
          <option value="female" <?php echo (isset($reports['gender']) && $reports['gender'] == 'หญิง') ? 'selected' : ''; ?>>หญิง</option>
          <option value="other" <?php echo (isset($reports['gender']) && $reports['gender'] == 'อื่นๆ') ? 'selected' : ''; ?>>อื่นๆ</option>
        </select>
      </div>
      <div class="form-group">
        <label for="nationality">Nationality:</label>
        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo isset($reports['nationality']) ? $reports['nationality'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="state">State:</label>
        <input type="text" class="form-control" id="state" name="state" value="<?php echo isset($reports['state']) ? $reports['state'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="doctor">Doctor:</label>
        <input type="text" class="form-control" id="doctor" name="doctor" value="<?php echo isset($reports['doctor']) ? $reports['doctor'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date" value="<?php echo isset($reports['date']) ? $reports['date'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="timeInput">TimeInput:</label>
        <input type="timeInput" class="form-control" id="timeInput" name="timeInput" value="<?php echo isset($reports['timeInput']) ? $reports['timeInput'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="information">Information:</label>
        <input type="text" class="form-control" id="information" name="information" value="<?php echo isset($reports['information']) ? $reports['information'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo isset($reports['price']) ? $reports['price'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="comment">Comment:</label>
        <input type="text" class="form-control" id="comment" name="comment" value="<?php echo isset($reports['comment']) ? $reports['comment'] : ''; ?>">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <a href="report.php" class="btn btn-secondary mt-3">กลับหน้าหลัก</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>