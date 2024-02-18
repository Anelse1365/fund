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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <!-- Include ECharts -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.1/dist/echarts.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
</head>
<style>
        body {
      padding-top: 56px; /* สำหรับ Navbar ด้านบน */
    }
    .sidebar {
      position: fixed;
      top: 56px; /* ความสูงของ Navbar ด้านบน */
      bottom: 0;
      left: 0;
      z-index: 100; /* จัดการความสูงให้สูงกว่าเนื้อหาหลัก */
      padding: 48px 0; /* การเรียงสลับแถบการนำทางและเนื้อหา */
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }
    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px); /* สูงของแถบการนำทางลบความสูงของ Navbar ที่ด้านบน */
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto; /* สำหรับเลื่อนแถบการนำทาง */
    }
    .sidebar .nav-link {
      color: #fff;
    }
    .sidebar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .main-content {
      margin-left: 240px; /* กว้างของ Sidebar */
      padding: 20px;
    }
    .sidebar {
  width: 200px; /* เพิ่มความกว้างที่ต้องการ */
}

.sidebar-sticky {
  padding-top: 1rem; /* เพิ่มขอบบนเพื่อให้มีพื้นที่ */
  height: calc(100vh - 48px); /* ลบความสูงของ Navbar ที่ด้านบนออกจากความสูงทั้งหมดที่ต้องการให้ Sidebar มีได้ */
  overflow-x: hidden;
  overflow-y: auto;
}


</style>



<body>
    
     <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          
          <li class="nav-item">
            <a class="nav-link" href="#"><?php echo $row['firstname'] . ' ' . $row['lastname']?></a>
          </li>
                  <!-- Display the logged-in username -->
        
        
        <!-- Add the Log Out button -->
          <li class="nav-item">
          <a class="nav-link" href="../logout2.php">ออกจากระบบ</a>
        </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <nav class="sidebar bg-dark sidebar-dark">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="main_dashboard.php">
            <i class="fas fa-tachometer-alt"></i> Dashboard <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-shopping-cart"></i> Orders
          </a>
        </li>

        <li class="nav-item" id="accountsSubMenu">
    <a href="#" class="nav-link" onclick="toggleSubMenu('accountsSubMenu')">
        <i class="fas fa-box"></i> Products
    </a>
    <ul style="display: <?php echo ($current_page == 'dash_produc.php') ? 'block' : 'none'; ?>">
        <a class="nav-link" href="dash_produc.php">Statistic</a>
        <a class="nav-link" href="..\shopping cart\admin.php">Upload</a>
    </ul>
</li>



    <script>
        function toggleSubMenu(subMenuId) {
            var subMenu = document.getElementById(subMenuId).querySelector('ul');
            subMenu.style.display = (subMenu.style.display === 'none') ? 'block' : 'none';
        }
    </script>
        <li class="nav-item">
          <a class="nav-link" href="dashbapomen.php">
            <i class="fas fa-users"></i> Appointment
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-chart-bar"></i> Reports
          </a>
        </li>
        
      </ul>
    </div>
  </nav>
  <!-- Content -->





    <!-- Patient List Table -->
    <div class="table-responsive mt-5">
        <table class="table table-striped table-bordered">
            
            <tbody>
                <?php
                    // Your existing PHP code to fetch and display patient data
                    // ...
                ?>
            </tbody>
        </table>
    </div>
</div>
    <!-- Set the width and height directly -->
    <div id="chart-container" style="width: 1200px; height: 300px;">
    <div id="productChart" style="width: 100%; height: 100%;  margin-left: 300px;"></div>

        <div id="legend" style="width: 30%; height: 100%; float: left; padding-top: 50px;"></div>
    </div>

    <script>
        // Prepare data for ECharts
        var productData = <?php echo json_encode($productData); ?>;
        var productLabels = Object.keys(productData);
        var productCounts = Object.values(productData);

        // Create a pie chart with ECharts
        var productChart = echarts.init(document.getElementById('productChart'));

        // Specify chart configuration
        var option = {
    backgroundColor: '#f5f5f5',  // กำหนดสีพื้นหลัง
    tooltip: {
        trigger: 'item',
        formatter: '{b}: {c} ({d}%)'
    },
    series: [
        {
            type: 'pie',
            radius: '50%',
            center: ['30%', '50%'],  // ปรับตำแหน่ง Pie Chart
            data: productLabels.map(function (label, index) {
                return { value: productCounts[index], name: label };
            }),
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },
            label: {
                show: true,
                formatter: '{b}: {d}%',
                position: 'outside',
                alignTo: 'labelLine'  // ปรับการแสดงตำแหน่งของ label
            },
            tooltip: {
                trigger: 'item',
                formatter: function (params) {
                    var productName = params.name;
                    var productCount = productData[productName] || 0;
                    return productName + ': ' + productCount + ' ชิ้น';
                }
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '16',
                    fontWeight: 'bold'
                }
            }
        }
    ]
};

// Set the chart option
productChart.setOption(option);

// ปรับแต่ง legendContainer ให้เรียงลงมา
legendContainer.style.float = 'left';
legendContainer.style.paddingTop = '50px';


        // Set the chart option
        productChart.setOption(option);

        // Create a separate legend container
        var legendContainer = document.getElementById('legend');
        var legendChart = echarts.init(legendContainer);

        // Specify legend configuration
        var legendOption = {
            orient: 'vertical',
            right: 10,
            data: productLabels,
        };
        

        // Set the legend option
        legendChart.setOption(legendOption);
        var productCounts = Object.values(productData).map(function (product) {
    return product.total_price; // หรือแต่คุณต้องการจะดึงข้อมูลอะไรมาแสดง
});

        
    </script>
</body>

</html>