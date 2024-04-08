am4core.useTheme(am4themes_animated);

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

// แปลงข้อมูล total_products ให้เป็นอาร์เรย์ของออบเจกต์
chart.data = [
  {
    country: "USA",
    visits: 23725,
    age: 30, // ตัวอย่างอายุเฉลี่ย
    total_products: [{ name: "Product A", quantity: 5 }, { name: "Product B", quantity: 3 }]
  },
  {
    country: "China",
    visits: 1882,
    age: 28, // ตัวอย่างอายุเฉลี่ย
    total_products: [{ name: "Product A", quantity: 2 }, { name: "Product C", quantity: 1 }]
  },
  // เพิ่มข้อมูลอื่นๆที่ต้องการแสดง
];

// เพิ่มฟิลเตอร์ดูอายุเฉลี่ยของลูกค้า
var ageAxis = chart.xAxes.push(new am4charts.ValueAxis());
ageAxis.renderer.minGridDistance = 30;
ageAxis.title.text = "Average Age";

// เพิ่มฟิลเตอร์ดูจำนวนสินค้าที่ถูกซื้อ
var productAxis = chart.yAxes.push(new am4charts.ValueAxis());
productAxis.renderer.minGridDistance = 50;
productAxis.title.text = "Total Products";

// สร้าง series สำหรับกราฟ
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "age";
series.dataFields.valueY = "total_products.length"; // นับจำนวนสินค้าทั้งหมดที่ถูกซื้อ
series.dataFields.category = "country";
series.tooltipText = "{category}: [bold]{valueX}[/] years, [bold]{valueY}[/] products";

// ตั้งค่า tooltip
series.columns.template.tooltipY = 0;
series.columns.template.tooltipX = am4core.percent(50);

// กำหนดสีให้กับ column
series.columns.template.adapter.add("fill", (fill, target) => {
  return chart.colors.getIndex(target.dataItem.index);
});

// สร้าง legend
chart.legend = new am4charts.Legend();

// ตั้งค่า cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.lineY.disabled = true;
chart.cursor.lineX.strokeDasharray = "1,4";
chart.cursor.behavior = "zoomY";
