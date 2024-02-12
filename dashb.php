<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2>Dashboard</h2>
    <table class="table">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
      
          <th>Created At</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Nationality</th>
          <th>Phone Number</th>
          <th>Address</th>
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
              $sql = "SELECT * FROM patien";
              $stmt = $conn->prepare($sql);
              $stmt->execute();

              // Output data of each row
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>
                          <td>".$row["firstname"]."</td>
                          <td>".$row["lastname"]."</td>
                          <td>".$row["email"]."</td>
                     
                          <td>".$row["created_at"]."</td>
                          <td>".$row["age"]."</td>
                          <td>".$row["gender"]."</td>
                          <td>".$row["nationality"]."</td>
                          <td>".$row["phone_number"]."</td>
                          <td>".$row["address"]."</td>
                        </tr>";
              }
          } catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
          }
          $conn = null;
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
