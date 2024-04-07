<?php
session_start();
include '../../config2/db2.php';;

if(isset($_GET['id'])) {
    // รับค่าไอดีการสั่งซื้อ
    $orderID = $_GET['id'];

    // ค้นหาข้อมูลการสั่งซื้อจากฐานข้อมูล
    $stmt = $conn->prepare("SELECT * FROM order2 WHERE id = :order_id");
    $stmt->bindParam(':order_id', $orderID);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if($order) {
        // อัปเดตค่า sold ของสินค้าที่ถูกซื้อในการสั่งซื้อนี้
        $products = explode(',', $order['total_products']);
        foreach($products as $product) {
            $productInfo = explode('(', $product);
            $productName = trim($productInfo[0]);
            $quantity = intval(str_replace(')', '', $productInfo[1]));
            // ค้นหาสินค้าจากชื่อ
            $productStmt = $conn->prepare("SELECT * FROM products WHERE name = :product_name");
            $productStmt->bindParam(':product_name', $productName);
            $productStmt->execute();
            $productRow = $productStmt->fetch(PDO::FETCH_ASSOC);
            if($productRow) {
                // อัปเดตค่า sold
                $updateSoldStmt = $conn->prepare("UPDATE products SET sold = sold + :quantity WHERE id = :product_id");
                $updateSoldStmt->bindParam(':quantity', $quantity);
                $updateSoldStmt->bindParam(':product_id', $productRow['id']);
                $updateSoldStmt->execute();
            }
        }

        // อัปเดตสถานะการสั่งซื้อเป็นชำระเงินแล้ว
        $updateOrderStatusStmt = $conn->prepare("UPDATE order2 SET order_status = 2 WHERE id = :order_id");
        $updateOrderStatusStmt->bindParam(':order_id', $orderID);
        $updateOrderStatusStmt->execute();

        // บันทึกประวัติการยืนยันการสั่งซื้อ (ถ้าต้องการ)
        // เช่น บันทึกลงฐานข้อมูลประวัติการสั่งซื้อ

        // ลบหลักฐานการโอนเงิน (ถ้าต้องการ)
        // เช่น ลบไฟล์รูปภาพหลักฐานการโอนเงินที่เก็บไว้

        // ตัวอย่างการ redirect กลับไปยังหน้าที่มีการยืนยันสินค้า
        header('Location: ../order_yes.php');
        exit;
    } else {
        echo "ไม่พบข้อมูลการสั่งซื้อ";
    }
} else {
    echo "ไม่พบไอดีการสั่งซื้อ";
}
?>
