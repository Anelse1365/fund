<?php
include '../../config2/db2.php';;

// Get the order ID from the URL parameter
$orderId = $_GET['id'];

try {
    // Prepare the SQL statement
    $sql = "UPDATE order2 SET order_status = 0 WHERE id = :orderId";
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Redirect back to the order page
    header('Location: ../order.php');
    exit();
} catch (PDOException $e) {
    // Handle any errors
    echo "<script>alert('ไม่สามารถลบข้อมูลได้')</script>";
}

?>
