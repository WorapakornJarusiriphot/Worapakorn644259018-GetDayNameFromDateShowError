<?php
  // สร้างวันเดือนปีปัจจุบันในรูปแบบของ PHP
  $today = date_create();
  $current_year = date_format($today, "Y");

  // แสดงฟอร์มเพื่อให้ผู้ใช้กรอกวันเดือนปีเกิด
  echo "<form method='post'>";
  echo "<label>วันเกิด:</label>";
  echo "<input type='text' name='day' maxlength='2' placeholder='dd' required>";
  echo "<input type='text' name='month' maxlength='2' placeholder='mm' required>";
  echo "<input type='text' name='year' maxlength='4' value='$current_year' required>";
  echo "<input type='submit' name='submit' value='แสดงผล'>";
  echo "</form>";

  // ตรวจสอบว่ามีการส่งข้อมูลวันเดือนปีเกิดผ่านแบบ POST หรือไม่
  if (isset($_POST['submit'])) {
    // ดึงค่าวันเดือนปีเกิดจากฟอร์ม
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    // สร้างวันเดือนปีเกิดในรูปแบบของ PHP
    $dob = date_create($year.'-'.$month.'-'.$day);

    // แสดงผลวันเดือนปีเกิด
    echo "วันเกิด ".date_format($dob, "d/m/Y");
  }
