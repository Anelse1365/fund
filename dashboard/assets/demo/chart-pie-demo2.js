// ใช้ข้อมูลที่ได้จาก PHP
// เพื่อสร้าง Bar Chart


// กำหนดข้อมูลให้แกน X เป็นอายุของลูกค้า
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "age";

// กำหนดข้อมูลให้แกน Y เป็นจำนวนสินค้าที่ซื้อ
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.renderer.minGridDistance = 30;

// สร้าง Bar Chart
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "age";
series.dataFields.valueY = "count"; // เปลี่ยน count เป็นชื่อคอลัมน์ที่เก็บจำนวนสินค้าที่ซื้อ
series.columns.template.tooltipText = "{valueY.value}";
series.columns.template.tooltipY = 0;
series.columns.template.strokeOpacity = 0;

// กำหนดสีให้แต่ละแถวของกราฟแท่ง
series.columns.template.adapter.add("fill", (fill, target) => {
  return chart.colors.getIndex(target.dataItem.index);
});
