am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartdiv3", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

// กำหนดข้อมูลให้กับกราฟแท่ง
chart.data = chartData;

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "name"; // กำหนดชื่อสินค้าให้กับแกน X

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.renderer.minGridDistance = 30;

// สร้าง Bar Chart
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "name"; // กำหนดชื่อสินค้าให้กับแกน X
series.dataFields.valueY = "total_orders"; // กำหนดจำนวนสินค้าที่ขายได้ให้กับแกน Y
series.columns.template.tooltipText = "{valueY.value} orders, Total Price: {total_price}";
series.columns.template.tooltipY = 0;
series.columns.template.strokeOpacity = 0;

// กำหนดสีให้แต่ละแถวของกราฟแท่ง
series.columns.template.adapter.add("fill", (fill, target) => {
  return chart.colors.getIndex(target.dataItem.index);
});
