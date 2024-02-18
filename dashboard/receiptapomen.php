<?php
session_start();

// ตรวจสอบว่ามีการส่ง ID มาหรือไม่
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fund";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ดึงข้อมูลจากตาราง appointmen โดยใช้ ID เป็นเงื่อนไข
        $stmt = $conn->prepare("SELECT * FROM appointmen WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->query("SELECT * FROM doctors");
        $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การแก้ไขใบเสร็จ</title>
    <!-- ลิงก์ CSS ของ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* เพิ่มสไตล์เพื่อปรับแต่งฟอร์มให้ดูสวยงาม */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .styled-input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.styled-label {
    margin-right: 10px;
    font-size: 16px;
}
/* เพิ่มขีดเส้นรอบ input เวลา */
input[type="time"] {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
    width: 100px; /* ปรับขนาดตามต้องการ */
}

/* จัดให้ข้อความ "เลือกเวลา" อยู่ด้านบนของ input เวลา */
.time-input-container label {
    display: block;
    margin-bottom: 5px;
}

/* จัดให้ input เวลาอยู่ในแนวนอน */
.time-input-container input[type="time"] {
    display: inline-block;
}


    </style>
</head>
<body>
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">ทำการนัด</h3>
                    </div>
                    <div class="card-body">
                        <form action="submitreceipt.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="name">ชื่อ-นามสกุล:</label>
                                <input type="text" class="form-control" name="patient" value="<?php echo isset($row['patient']) ? $row['patient'] : ''; ?>" required> 
                            </div>
                            

                            <div class="form-group">
                                <label for="email">อีเมล:</label>
                                <input type="email" class="form-control" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required> 
                            </div>
                            <div class="form-group">
                                <label for="phone_number">เบอร์โทร:</label>
                                <input type="tel" class="form-control" name="phone_number" value="<?php echo isset($row['phone_number']) ? $row['phone_number'] : ''; ?>" required> 
                            </div>
                            <div class="form-group">
                                <label for="age">อายุ:</label>
                                <input type="number" class="form-control" name="age" value="<?php echo isset($row['age']) ? $row['age'] : ''; ?>" required>  
                            </div>
                            <div class="form-group">
                                <label for="gender">เพศ:</label>
                                <input type="text" class="form-control" name="gender" value="<?php echo isset($row['gender']) ? $row['gender'] : ''; ?>" required> 
                            </div>
                            <div class="form-group">
                                <label for="nationality">สัญชาติ:</label>
                                <input type="text" class="form-control" name="nationality" value="<?php echo isset($row['nationality']) ? $row['nationality'] : ''; ?>" required> 
                            </div>
                            <div class="form-group">
                                <label for="state">คลินิก</label>
                                <input type="text" class="form-control" id="state" name="state" value="<?php echo isset($row['state']) ? $row['state'] : ''; ?>">
                            </div>


                            <input type="date" name="date" class="styled-input">
<div class="time-input-container">
    
    <label for="timeInput" class="styled-label">เลือกเวลา:</label>
    <input type="time"name="timeInput" class="styled-input">
</div>




                           
                            <div class="form-group">
                                <label for="doctor">หมอ</label>
                                <select class="form-control" name="doctor" required>
                                <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['first_name']; ?>"><?php echo $doctor['first_name'] . " " . $doctor['last_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                            </div>

                            <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['first_name']; ?>"><?php echo $doctor['first_name'] . " " . $doctor['last_name']; ?></option>
                    <?php endforeach; ?>



                            
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">ยืนยันการนัด</button>
                                <a href="dashbapomen.php" class="btn btn-secondary">ยกเลิก</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ลิงก์ JavaScript ของ Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
