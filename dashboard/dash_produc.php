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
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Product Purchase Dashboard</h1>
    <!-- Set the width and height directly -->
    <canvas id="productChart"></canvas>

    <script>
        // Prepare data for Chart.js
        var productData = <?php echo json_encode($productData); ?>;
        var productLabels = Object.keys(productData);
        var productCounts = Object.values(productData);

        // Create a pie chart
        var ctx = document.getElementById('productChart').getContext('2d');
        // Set the width and height directly
        document.getElementById('productChart').width = 300;
        document.getElementById('productChart').height = 300;

        var productChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: productLabels,
                datasets: [{
                    data: productCounts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                        // Add more colors if needed
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>
</body>

</html>
