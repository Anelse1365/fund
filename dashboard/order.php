<?php

    session_start();
    require_once '../config2/db2.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location:../signin2.php');
    
    }

    // Count of Patients

    if (isset($_SESSION['admin_login'])) {
      $user_id = $_SESSION['admin_login'];
      $stmt = $conn->query("SELECT * FROM patien WHERE id = $user_id");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  

              // SQL query to fetch data from database
  $sql = "SELECT * FROM patien";
  $stmt = $conn->prepare($sql);

$sql = "SELECT total_products FROM order2";
$result = $conn->query($sql);

$productData = array();

if ($result !== false && $result->rowCount() > 0) {
    while ($productRow = $result->fetch(PDO::FETCH_ASSOC)) {
        // Parse the product data and count occurrences
        $products = explode(',', $productRow['total_products']);
        foreach ($products as $product) {
            $product = trim($product);
            if (!empty($product)) {
                // Remove the count from the product name
                $productName = trim(preg_replace('/\(\d+\)/', '', $product));
                if (isset($productData[$productName])) {
                    $productData[$productName]++;
                } else {
                    $productData[$productName] = 1;
                }
            }
        }
    }
}
$sql = "SELECT total_products, total_price FROM order2";
$current_page = basename($_SERVER['PHP_SELF']);



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="main1.php">FUND CLINIC</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                   
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                <li class="nav-item">
            <a class="nav-link" href="#"><?php echo $row['firstname'] . ' ' . $row['lastname']?></a>
          </li>
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>

                        <li><a class="dropdown-item" href="../logout2.php">ออกจากระบบ</a></li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="main1.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            
                            </a>
                            <a class="nav-link" href="main2.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard 2
                            
                            </a>
                            <a class="nav-link" href="main3.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard รีวิว
                            
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="dash_produc.php">Overview</a>
                                    <a class="nav-link" href="order.php">Order</a>
                                    <a class="nav-link" href="../shopping cart/admin.php">Upload</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Info
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="dashb.php">Patient</a>
                                    <a class="nav-link" href="doctorsdash.php">Doctor</a>
                                    <a class="nav-link" href="cilnic_d.php">Cilnic</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="dashbapomen.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Appointment
                            </a>
                            <a class="nav-link" href="finishreceipt.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Receipt
                            </a>
                            <a class="nav-link" href="Report.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Report
                            </a>
                            <a class="nav-link" href="reveiw_dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Review
                            </a>
                        </div>
                    </div>

                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    
                <div class="container-fluid px-4">
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                แสดงข้อมูลการสั่งซื้อ
                                
                                <div>
                                    <br>
                                <a href="order_yes.php"><button type="button" class="btn btn-outline-success">ชำระแล้ว</button></a>
                                <a href="order.php"><button type="button" class="btn btn-outline-success">ยังไม่ชำระเงิน</button></a>
                                <a href="order_no.php"><button type="button" class="btn btn-outline-success">ยกเลิกการสั่งซื้อ</button></a>
                                </div>
                                <br>
                                <div>
                                    <form name="for1" method="POST" action="order.php">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input type="date" name="dt1" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="date" name="dt2" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                        </div>


                                    </form>

                                </div>

                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple" table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ลูกค้า</th>
                                            <th>เบอร์</th>
                                            <th>อีเมลล์</th>
                                            <th>วิธีชำระเงิน</th>
                                            <th>ที่อยู่</th>
                                            <th>ตำบล</th>
                                            <th>อำเภอ</th>
                                            <th>จังหวัด</th>
                                            <th>ประเทศ</th>
                                            <th>รหัสไปรษณีย์</th>
                                            <th>รายการสินค้า</th>
                                            <th>ยอดรวม</th>
                                            <th>วันที่สั่งซื้อ</th>
                                            <th>สถานะการสั่งซื้อ</th>
                                            <th>ยืนยันคำสั่งซื้อ</th>
                                            <th>ยกเลิกคำสั่งซื้อ</th>
                                            <th>หลักฐานการโอน</th>
                                            
                                            

                                        </tr>
                                        </thead>
                                        
<tbody>
<?php
// Include database configuration
require_once '../config2/db2.php';

$ddt1=@$_POST['dt1'];
$ddt2=@$_POST['dt2'];
$add_date=date('Y-m-d', strtotime($ddt2 . "+1 days"));

if(($ddt1 != "") & ($ddt2 != "")){
    echo "ค้นหาจากวันที่ $ddt1 ถึง $ddt2";
    $sql = "SELECT * FROM order2 WHERE order_status='1' AND created_at BETWEEN '$ddt1' AND '$add_date' ORDER BY created_at DESC";
} else {
    $sql = "SELECT * FROM `order2` WHERE order_status ='1' ORDER BY created_at DESC";
}


// SQL query to fetch data from order2 table
// $sql = "SELECT * FROM `order2` ORDER BY `created_at` DESC"; ขึ้นหมด

$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // Output data from each row
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['number'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['method'] . "</td>";
        echo "<td>" . $row['flat'] . "</td>";
        echo "<td>" . $row['street'] . "</td>";
        echo "<td>" . $row['city'] . "</td>";
        echo "<td>" . $row['state'] . "</td>";
        echo "<td>" . $row['country'] . "</td>";
        echo "<td>" . $row['pin_code'] . "</td>";
        echo "<td>" . $row['total_products'] . "</td>";
        echo "<td>" . $row['total_price'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "<td>"; // Open the <td> tag for order status

        
                // Check order status and display appropriate text
if (isset($row['order_status'])) {
    $status = $row['order_status'];
    if ($status == 1) {
        echo "ยังไม่ได้ชำระเงิน";
    } else if ($status == 2) {
        echo "<b style= 'color:green'>ชำระเงินแล้ว</b>";
    } else if ($status == 0) {
        echo "<b style= 'color:red'> ยกเลิกการสั่งซื้อ</b>";
    }
}
echo "</td>"; // Close the <td> tag for order status

        echo "<td> <a href='product_dash/pay_order.php?id=" . $row['id'] . "' class='btn btn-success' onclick=\"del1(this.href); return false;\">ยืนยัน</a></td>";
        echo "<td> <a href='product_dash/cancel_order.php?id=" . $row['id'] . "' class='btn btn-danger' onclick=\"del(this.href); return false;\">ยกเลิก</a></td>";





        

        // Check if 'pay' field has a value (image filename)
        if (!empty($row['pay'])) {
            // Construct the image path
            $imagePath = "../shopping cart/uploaded_img/" . $row['pay']; // Adjust the path accordingly
            
            // Check if the image file exists
            if (file_exists($imagePath)) {
                // Display image as a clickable link
                echo "<td><a href='" . $imagePath . "' target='_blank'><img src='" . $imagePath . "' width='100' height='100'></a></td>";
            } else {
                // Display a placeholder if the image file does not exist
                echo "<td>No Image</td>";
            }
        } else {
            // Display a placeholder if no image
            echo "<td>No Image</td>";
        }
        
        echo "</tr>";
    }
} else {
    echo "ไม่พบ";
}

 

?>
                            </tbody>
                                  <tfoot>
                                    <tr>
                                            <th>ID</th>
                                            <th>ลูกค้า</th>
                                            <th>เบอร์</th>
                                            <th>อีเมลล์</th>
                                            <th>วิธีชำระเงิน</th>

                                    </tr>
 
                                       </tfoot>
                                       <tr>  
                                            <td><?=$row['id'] ?></td>
                                            <td><?=$row['name'] ?></td>
                                            <td><?=$row['method'] ?></td>
                                            <td><?=$row['flat'] ?></td>
                                            <td><?=$row['street'] ?></td>
                                            <td><?=$row['city'] ?></td>
                                            <td><?=$row['state'] ?></td>
                                            <td><?=$row['country'] ?></td>
                                            <td><?=$row['pin_code'] ?></td>
                                            <td><?=$row['total_products'] ?></td>
                                            <td><?=$row['total_price'] ?></td>
                                            <td><?=$row['created_at'] ?></td>
                                            <td><?=$row['order_status'] ?></td>
                                            


                                        </tr>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable('#datatablesSimple');
    });
</script>
<script>
  function del(mypage){
    var agree = confirm('คุณต้องการยกเลิกคำสั่งซื้อหรือไม่');
    if(agree){
      window.location=mypage;
    }
  }
  function del1(mypage1){
    var agree = confirm('คุณต้องการยืนยันคำสั่งซื้อหรือไม่');
    if(agree){
      window.location=mypage1;
    }
  }

</script>

        
    </body>
</html>
