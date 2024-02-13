<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
    }
    .table {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
      vertical-align: middle !important;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4">Receipt</h2>
    <div class="table-responsive">
      <table class="table table-striped table-bordered"> 
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
            // Your PHP code to fetch and display data from the receipt table will be here
          ?>
        </tbody>
      </table>
    </div>
    <a href="dashb.php" class="btn btn-secondary">Back to Dashboard</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
