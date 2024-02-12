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
</head>
<body>
<div class="container">
    <h2>Edit Patient</h2>
    <form method="post">
      <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $patient['firstname']; ?>">
      </div>
      <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $patient['lastname']; ?>">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>">
      </div>
      
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" id="age" name="age" value="<?php echo $patient['age']; ?>">
      </div>
      <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" id="gender" name="gender">
          <option value="Male" <?php if($patient['gender'] == 'ชาย') echo 'selected'; ?>>ชาย</option>
          <option value="Female" <?php if($patient['gender'] == 'หญิง') echo 'selected'; ?>>หญิง</option>
          <option value="Female" <?php if($patient['gender'] == 'อื่นๆ') echo 'selected'; ?>>อื่นๆ</option>
        </select>
        </select>
      </div>
      <div class="form-group">
        <label for="nationality">Nationality:</label>
        <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $patient['nationality']; ?>">
      </div>
      <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $patient['phone_number']; ?>">
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" id="address" name="address"><?php echo $patient['address']; ?></textarea>
        </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>

  <a href="dashb.php" class="btn btn-secondary mt-2">กลับหน้าเเรก</a>
</div>
  
  </div>
</body>
</html>
