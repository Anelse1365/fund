<?php
// Assuming you have a database connection, you can use the following code to fetch data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fund";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT total_products FROM order2";
$result = $conn->query($sql);

$productData = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Parse the product data and count occurrences
        $products = explode(',', $row['total_products']);
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
    <!-- Include ECharts -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.1/dist/echarts.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
</head>



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
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
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
        <li class="nav-item">
          <a class="nav-link" href="dash_produc.php">
            <i class="fas fa-box"></i> Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashb.php">
            <i class="fas fa-users"></i> Patient
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dashbapomen.php">
            <i class="fas fa-users"></i> Appointment
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="doctorsdash.php">
            <i class="fas fa-users"></i> doctor
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
    <div class="container mt-5">

    <h1>Product Purchase Dashboard</h1>
    <!-- Set the width and height directly -->
<<<<<<< HEAD
    <div id="chart-container" style="width: 1200px; height: 300px;">
    <div id="productChart" style="width: 100%; height: 100%;  margin-left: 300px;"></div>

        <div id="legend" style="width: 30%; height: 100%; float: left; padding-top: 50px;"></div>
=======
    <div id="chart-container">
        <div id="productChart"></div>
        <div style="position: relative; width: 560px; height: 500px; padding: 0px; margin: 0px; border-width: 0px; cursor: default; left: 0;">
    <canvas data-zr-dom-id="zr_0" width="560" height="500" style="position: absolute; left: 0px; top: 0px; width: 560px; height: 500px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
</div>

        
        <div id="legend"></div>
>>>>>>> 7bc28aec8a75357448e8bfe839d43d6045f6a4c2
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
    </script>
    </div>
</body>

</html>