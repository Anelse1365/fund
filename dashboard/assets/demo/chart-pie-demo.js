
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data from PHP variable chartData
chart.data = chartData;

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "sold"; // ใช้ข้อมูลจำนวนสินค้าที่ขายได้จากตาราง products
pieSeries.dataFields.category = "name"; // ใช้ชื่อสินค้าจากตาราง products


pieSeries.ticks.template.disabled = true;
pieSeries.alignLabels = false;
pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
pieSeries.labels.template.radius = am4core.percent(-40);
pieSeries.labels.template.fill = am4core.color("white");

pieSeries.labels.template.adapter.add("radius", function(radius, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return 0;
  }
  return radius;
});

pieSeries.labels.template.adapter.add("fill", function(color, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return am4core.color("#000");
  }
  return color;
});

chart.legend = new am4charts.Legend();  
