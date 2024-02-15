
            <!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การทำใบเสร็จ</title>
</head>
<body>
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
          $sql = "SELECT * FROM appointmen";
          $stmt = $conn->prepare($sql);
          $stmt->execute();

          // Output data of each row
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                   <td>".$row["patient"]."</td>
                   <td>".$row["email"]."</td>
                   <td>".$row["phone_number"]."</td>
                   <td>".$row["age"]."</td>
                   <td>".$row["gender"]."</td>
                   <td>".$row["nationality"]."</td>
                   <td>".$row["state"]."</td>
                   <td>".$row["information"]."</td>
                   <td>".$row["doctor"]."</td>
                   <td>".$row["created_at"]."</td>
                  </tr>";
          }
      } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
      ?>
<section>
	<div class="container"> 
        <h1>การทำใบเสร็จ</h1>
        <p>กรุณากรอกข้อมูลเพื่อนัดหมอฟัน</p>  
        <form action="submitapomen.php" method="post">
		<div class="form-group">
    <label for="name">ชื่อ-นามสกุล:</label>
    <input type="text" class="form-control" name="patient" value="<?php echo $row['patient']?>" required> 
</div>

            <div class="form-group">
                <label for="email">อีเมล:</label>
                <input type="email" class="form-control" name="email" value=" <?php echo $row['email']?>"required> 
            </div>
            <div class="form-group">
                <label for="phone_number">เบอร์โทร:</label>
                <input type="tel" class="form-control" name="phone_number"  value=" <?php echo $row['phone_number']?>  " required> 
            </div>
			<div class="form-group">
    <label for="age">อายุ:</label>
    <input type="number" class="form-control" name="age" value="<?php echo $row['age']?>" required>  
</div>

            <div class="form-group">
                <label for="gender">เพศ:</label>
                <input type="text" class="form-control" name="gender" value="  <?php echo $row['gender']?>  " required> 
            </div>
            <div class="form-group">
                <label for="nationality">สัญชาติ:</label>
                <input type="text" class="form-control" name="nationality" value="  <?php echo $row['nationality']?>  "  required> 
            </div>
            <
            <button type="submit" name="submit" class="btn btn-primary">ยืนยัน</button>
            <a href="index2.php" class="btn btn-secondary">กลับหน้าหลัก</a>
        </form>
    </div>
    </section>
</form>
