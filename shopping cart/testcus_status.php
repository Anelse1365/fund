<?php
session_start();
require_once '../config2/db2.php';

// ตรวจสอบการเข้าสู่ระบบของผู้ดูแลระบบ
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location:../signin2.php');
    exit; // หยุดการทำงานทันทีหากไม่ได้เข้าสู่ระบบ
}

// เรียกข้อมูลลูกค้าที่ชำระเงินแล้วจากฐานข้อมูล โดยใช้ email เป็นเงื่อนไข
$user_email = $_SESSION['user_login']; // เก็บ email ของผู้ใช้ที่เข้าสู่ระบบ
$sql = "SELECT * FROM order2 WHERE order_status IN ('0', '1', '2') AND email = :email ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $user_email);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders with Payment</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Orders with Payment</h1>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>ชื่อลูกค้า</th>
                        <th>เบอร์โทร</th>
                        <th>อีเมลล์</th>
                        <th>วิธีการชำระเงิน</th>
                        <th>ที่อยู่</th>
                        <th>รายการสินค้า</th>
                        <th>ยอดรวม</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>สถานะการสั่งซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP code to fetch and display order data here -->
                    <!-- Sample data for demonstration purposes -->
                    <?php if ($result && $result->rowCount() > 0): ?>
                        <?php foreach ($result as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['number']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['method']; ?></td>
                                <td><?php echo $row['flat'] . ', ' . $row['street'] . ', ' . $row['city'] . ', ' . $row['state'] . ', ' . $row['country'] . ', ' . $row['pin_code']; ?></td>
                                <td><?php echo $row['total_products']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <?php
                                    if ($row['order_status'] == 0) {
                                        echo 'ยกเลิก';
                                    } elseif ($row['order_status'] == 1) {
                                        echo 'รอการยืนยันการชำระเงิน';
                                    } elseif ($row['order_status'] == 2) {
                                        echo 'ชำระเงินแล้ว';
                                    } else {
                                        echo 'สถานะไม่ถูกต้อง';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">ไม่พบข้อมูลการสั่งซื้อที่มีการชำระเงิน</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Link to Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
