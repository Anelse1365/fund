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
        $stmt = $conn->prepare("SELECT * FROM patien WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Fetch patient data
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$patient) {
            echo "Patien not found.";
            exit();
        }

        // Check if form is submitted
        if(isset($_POST['submit'])) {
            // Retrieve form data
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
           
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $nationality = $_POST['nationality'];
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];

            // Prepare SQL statement to update patient data
            $update_stmt = $conn->prepare("UPDATE patien SET firstname=:firstname, lastname=:lastname, email=:email,  age=:age, gender=:gender, nationality=:nationality, phone_number=:phone_number, address=:address WHERE id=:id");
            $update_stmt->bindParam(':firstname', $firstname);
            $update_stmt->bindParam(':lastname', $lastname);
            $update_stmt->bindParam(':email', $email);
         
            $update_stmt->bindParam(':age', $age);
            $update_stmt->bindParam(':gender', $gender);
            $update_stmt->bindParam(':nationality', $nationality);
            $update_stmt->bindParam(':phone_number', $phone_number);
            $update_stmt->bindParam(':address', $address);
            $update_stmt->bindParam(':id', $id);

            // Execute update statement
            if($update_stmt->execute()) {
                echo "Patien data updated successfully.";
            } else {
                echo "Error updating patien data.";
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
  <title>Edit Patient</title>
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
    <h2 class="mb-4">Edit Patient</h2>
    <form method="post">
      <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($patient['firstname']) ? $patient['firstname'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($patient['lastname']) ? $patient['lastname'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($patient['email']) ? $patient['email'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" id="age" name="age" value="<?php echo isset($patient['age']) ? $patient['age'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" id="gender" name="gender">
          <option value="male" <?php echo (isset($patient['gender']) && $patient['gender'] == 'ชาย') ? 'selected' : ''; ?>>ชาย</option>
          <option value="female" <?php echo (isset($patient['gender']) && $patient['gender'] == 'หญิง') ? 'selected' : ''; ?>>หญิง</option>
          <option value="other" <?php echo (isset($patient['gender']) && $patient['gender'] == 'อื่นๆ') ? 'selected' : ''; ?>>อื่นๆ</option>
        </select>
      </div>
      <div class="form-group">
        <label for="nationality">Nationality:</label>
        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo isset($patient['nationality']) ? $patient['nationality'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo isset($patient['phone_number']) ? $patient['phone_number'] : ''; ?>">
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" id="address" name="address" rows="3"><?php echo isset($patient['address']) ? $patient['address'] : ''; ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <a href="dashb.php" class="btn btn-secondary mt-3">กลับหน้าหลัก</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

