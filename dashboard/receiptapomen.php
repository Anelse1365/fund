<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipts</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    /* Your custom styles here */
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Receipts</h2>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Email</th>
            <th>Service</th>
            <th>Doctor</th>
            <th>Status</th>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Connection to database
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "fund";
          try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              // SQL query to fetch data from database
              $sql = "SELECT * FROM receipt";
              $stmt = $conn->prepare($sql);
              $stmt->execute();

              // Output data of each row
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['patient']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['service']."</td>
                            <td>".$row['doctor']."</td>
                            <td>".$row['status']."</td>
                            <td>".$row['appointment_date']."</td>
                            <td>".$row['appointment_time']."</td>
                            <td>".$row['created_at']."</td>
                        </tr>";
              }
          } catch(PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
