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
        $stmt = $conn->prepare("SELECT * FROM receipe WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>ทำประวัติคนไข้</title>
    <!-- ลิงก์ CSS ของ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">ทำประวัติคนไข้</h3>
                </div>
                <div class="card-body">
                    <form action="submitReport.php" method="post">
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
                            <input type="text" class="form-control" name="state" value="<?php echo isset($row['state']) ? $row['state'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="doctor">หมอ</label>
                            <input type="doctor" class="form-control"  name="doctor" value="<?php echo isset($row['doctor']) ? $row['doctor'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="date">วันที่:</label>
                            <input type="date" class="form-control" name="date" value="<?php echo isset($row['date']) ? $row['date'] : ''; ?>" required> 
                        </div>
                        <div class="form-group">
                            <label for="timeInput">เวลา:</label>
                            <input type="time" class="form-control" name="timeInput" value="<?php echo isset($row['timeInput']) ? $row['timeInput'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="information">ประเภทการนัด:</label>
                            <select class="form-control" name="information">
                                <option value="" disabled selected>กรุณาเลือกประเภทการนัด</option>
                                <option value="รักษาทันตกรรมทั่วไป">รักษาทันตกรรมทั่วไป</option>
                                <option value="ผ่าฟัน">ผ่าฟัน</option>
                                <option value="จัดฟัน">จัดฟัน</option>
                                <option value="อุดฟัน">อุดฟัน</option>
                                <option value="รักษารากฟัน">รักษารากฟัน</option>
                                <option value="ขูดหินปูน">ขูดหินปูน</option>
                                <option value="อื่นๆ">บริการอื่นๆ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">ราคา:</label>
                            <input type="number" class="form-control" name="price" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">ความคิดเห็น:</label>
                            <textarea class="form-control" name="comment"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                            <a href="dashbapomen.php" class="btn btn-secondary">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ลิงก์ JavaScript ของ Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
