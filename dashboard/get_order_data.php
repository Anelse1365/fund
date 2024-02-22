<?php
require_once '../config2/db2.php';

$sql = "SELECT total_products, SUM(total_price) AS total_sales FROM order2 GROUP BY total_products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$productTotals = [];

foreach ($result as $row) {
    $productName = extractProductName($row['total_products']);
    $totalSales = $row['total_sales'];

    // ตรวจสอบว่ามีชื่อสินค้านี้อยู่ใน $productTotals หรือไม่
    if (array_key_exists($productName, $productTotals)) {
        // ถ้ามีให้เพิ่ม total_sales เข้าไปใน $productTotals
        $productTotals[$productName] += $totalSales;
    } else {
        // ถ้าไม่มีให้เพิ่มชื่อสินค้าและ total_sales เข้าไปใน $productTotals
        $productTotals[$productName] = $totalSales;
    }
}

$labels = array_keys($productTotals);
$values = array_values($productTotals);

$data = [
    'labels' => $labels,
    'values' => $values,
];

header('Content-Type: application/json');
echo json_encode($data);

// ฟังก์ชั่นสำหรับดึงชื่อสินค้า
function extractProductName($productString) {
    // ใช้ regular expression ในการดึงชื่อสินค้า
    preg_match('/^[^(]+/', $productString, $matches);
    return trim($matches[0]);
}
?>
