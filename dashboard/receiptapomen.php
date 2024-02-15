<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // เซ็ตโหมดของ PDO เพื่อให้แสดงข้อผิดพลาดออกมา
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจากตาราง appointmen
    $stmt = $conn->query("SELECT * FROM appointmen");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การทำใบเสร็จ</title>
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
    </style>
</head>
<body>
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">การทำใบเสร็จ</h3>
                    </div>
                    <div class="card-body">
                        <form action="submitreceipt.php" method="post">
                            <div class="form-group">
                                <label for="name">ชื่อ-นามสกุล:</label>
                                <input type="text" class="form-control" name="patient" value="<?php echo isset($row['patient']) ? $row['patient'] : ''; ?>" required> 
                            </div>
                            <!-- เพิ่มสไตล์ให้กับฟอร์มเพื่อให้มีการจัดหน้าและใช้งานง่ายขึ้น -->
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
                            <div class="form-group">
                                <label for="information">บริการ</label>
                                <input type="text" class="form-control" id="information" name="information" value="<?php echo isset($row['information']) ? $row['information'] : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="doctor">Doctor</label>
                                <select class="form-control" id="doctor" name="doctor" required>
                                    <option value="หมอA" <?php echo (isset($row['doctor']) && $row['doctor'] == 'หมอA') ? 'selected' : ''; ?>>หมอA</option>
                                    <option value="หมอB" <?php echo (isset($row['doctor']) && $row['doctor'] == 'หมอB') ? 'selected' : ''; ?>>หมอB</option>
                                    <option value="หมอC" <?php echo (isset($row['doctor']) && $row['doctor'] == 'หมอC') ? 'selected' : ''; ?>>หมอC</option>
                                    <option value="หมอD" <?php echo (isset($row['doctor']) && $row['doctor'] == 'หมอD') ? 'selected' : ''; ?>>หมอD</option>
                                    <option value="หมอE" <?php echo (isset($row['doctor']) && $row['doctor'] == 'หมอE') ? 'selected' : ''; ?>>หมอE</option>
                                    <option value="หมอF" <?php echo (isset($row['doctor']) && $row['doctor'] == 'หมอF') ? 'selected' : ''; ?>>หมอF</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">ยืนยัน</button>
                                <a href="dashb.php" class="btn btn-secondary">กลับหน้าหลัก</a>
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
