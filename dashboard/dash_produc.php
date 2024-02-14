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
</head>

<body>
    <h1>Product Purchase Dashboard</h1>
    <!-- Set the width and height directly -->
    <div id="chart-container" style="width: 500px; height: 300px;">
        <div id="productChart" style="width: 70%; height: 100%; float: left;"></div>
        <div id="legend" style="width: 30%; height: 100%; float: left;"></div>
    </div>

    <script>
        // Prepare data for ECharts
        var productData = <?php echo json_encode($productData); ?>;
        var productLabels = Object.keys(productData);
        var productCounts = Object.values(productData);

        // Create a pie chart with ECharts
        var productChart = echarts.init(document.getElementById('productChart'));
        // Create a separate legend container
        var legendContainer = document.getElementById('legend');

        // Specify chart configuration
        var option = {
            tooltip: {
                trigger: 'item',
                formatter: '{b}: {c} ({d}%)'
            },
            legend: {
                orient: 'vertical',
                right: 10, // Adjusted to show the legend on the right
                data: productLabels,
            },
            series: [
                {
                    type: 'pie',
                    radius: '50%',
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
                        formatter: '{b}: {d}%'
                    }
                }
            ]
        };

        // Set the chart option
        productChart.setOption(option);

        // Specify legend configuration
        var legendOption = {
            orient: 'vertical',
            right: 10,
            data: productLabels,
        };

        // Set the legend option
        productChart.on('finished', function () {
            var legendChart = echarts.init(legendContainer);
            legendChart.setOption(legendOption);
        });
    </script>
</body>

</html>
