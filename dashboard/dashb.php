<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    .navbar-brand {
      font-weight: bold;
    }
    .table-responsive {
      max-height: 400px;
      overflow-y: auto;
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Dashboard</a>
    </div>
  </nav>

  <!-- Content -->
  <div class="container mt-4">
    <h2 class="mb-4">Patient List</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Nationality</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Action</th>
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
                        <td>".$row["urole"]."</td>
                        <td>".$row["created_at"]."</td>
                        <td>".$row["age"]."</td>
                        <td>".$row["gender"]."</td>
                        <td>".$row["nationality"]."</td>
                        <td>".$row["phone_number"]."</td>
                        <td>".$row["address"]."</td>
                        <td>
                            <a href='edit.php?id=".$row["id"]."' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i> Edit</a>
                            <a href='delete.php?id=".$row["id"]."' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> Delete</a>
                        </td>
                      </tr>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
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
