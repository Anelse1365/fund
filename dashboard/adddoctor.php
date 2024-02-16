<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลหมอ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                        <h3 class="mb-0">เพิ่มข้อมูลหมอ</h3>
                    </div>
                    <div class="card-body">
                        <form action="add_doctor.php" method="post">
                            <div class="form-group">
                                <label for="first_name">ชื่อ:</label>
                                <input type="text" class="form-control" name="first_name" required> 
                            </div>
                            <div class="form-group">
                                <label for="last_name">นามสกุล:</label>
                                <input type="text" class="form-control" name="last_name" required> 
                            </div>
                            <div class="form-group">
                                <label for="age">อายุ:</label>
                                <input type="number" class="form-control" name="age" required>  
                            </div>
                            <div class="form-group">
                                <label for="gender">เพศ:</label>
                                <select class="form-control" name="gender" required>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nationality">สัญชาติ:</label>
                                <input type="text" class="form-control" name="nationality" required> 
                            </div>
                            <div class="form-group">
                                <label for="email">อีเมล:</label>
                                <input type="email" class="form-control" name="email" required> 
                            </div>
                            <div class="form-group">
                                <label for="phone_number">เบอร์โทร:</label>
                                <input type="tel" class="form-control" name="phone_number" required> 
                            </div>
                            <div class="form-group">
                                <label for="education">การศึกษา:</label>
                                <select class="form-control" name="education" required>
                                    <option value="ปริญญาตรี">ปริญญาตรี</option>
                                    <option value="ปริญญาโท">ปริญญาโท</option>
                                    <option value="ปริญญาเอก">ปริญญาเอก</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="graduation">จบการศึกษา:</label>
                                <input type="text" class="form-control" name="graduation" required> 
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                                <a href="doctorsdash.php" class="btn btn-secondary">ยกเลิก</a>
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
