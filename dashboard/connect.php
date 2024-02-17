<?php

$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "fund";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // ตรวจสอบการเชื่อมต่อ
  if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
  }
?>