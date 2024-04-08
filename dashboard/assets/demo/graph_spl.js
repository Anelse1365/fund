// เรียกใช้ไลบรารี Chart.js
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

// ฟังก์ชันสำหรับดึงข้อมูลและสร้างกราฟหรือ pie chart
function fetchDataAndCreateChart() {
    // ดึงค่าฟิลเตอร์ที่ถูกเลือกจากฟอร์ม
    var method = document.getElementById("method").value; // เช่น paypal, credit card, cash on delivery
    var orderStatus = document.getElementById("orderStatus").value; // เช่น 0, 1, 2

    // ส่งค่าฟิลเตอร์ไปยังไฟล์ PHP เพื่อดึงข้อมูล
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_data.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // รับข้อมูล JSON ที่ส่งกลับมาจากไฟล์ PHP
            var data = JSON.parse(xhr.responseText);

            // เรียกใช้ฟังก์ชันสร้างกราฟหรือ pie chart
            createChart(data);
        }
    };
    // ส่งค่าฟิลเตอร์ไปยังไฟล์ PHP เพื่อดึงข้อมูล
    var params = "method=" + method + "&orderStatus=" + orderStatus;
    xhr.send(params);
}

// ฟังก์ชันสร้างกราฟหรือ pie chart ด้วยข้อมูลที่ได้รับ
function createChart(data) {
    // สร้างกราฟหรือ pie chart ด้วยไลบรารี Chart.js ตามต้องการ
}
