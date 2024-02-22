// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Fetch data from the server
fetch('get_order_data.php')
  .then(response => response.json())
  .then(data => {
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: data.labels,
        datasets: [{
          data: data.values,
          backgroundColor: ['#007bff', '#dc3545', '#FFFF33', '#28a745','#ce93d8 ','#ce93d8','#FFCCCC','#FFE4B5'],
        }],
      },
    });
  });
