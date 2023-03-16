<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Select Date of Birth</title>
</head>
<body>
  <form method="post">
    <label>วันเกิด:</label>
    <select name="day" required>
      <?php
        // สร้างตัวเลือกสำหรับวันที่
        for ($i = 1; $i <= 31; $i++) {
          echo "<option value='".$i."'>".$i."</option>";
        }
      ?>
    </select>
    <select name="month" required>
      <?php
        // สร้างตัวเลือกสำหรับเดือน
        $months = array(
          "01" => "มกราคม",
          "02" => "กุมภาพันธ์",
          "03" => "มีนาคม",
          "04" => "เมษายน",
          "05" => "พฤษภาคม",
          "06" => "มิถุนายน",
          "07" => "กรกฎาคม",
          "08" => "สิงหาคม",
          "09" => "กันยายน",
          "10" => "ตุลาคม",
          "11" => "พฤศจิกายน",
          "12" => "ธันวาคม"
        );
        foreach ($months as $key => $value) {
          echo "<option value='".$key."'>".$value."</option>";
        }
      ?>
    </select>
    <select name="year" required>
      <?php
        // สร้างตัวเลือกสำหรับปี
        $current_year = date("Y");
        for ($i = $current_year; $i >= $current_year - 100; $i--) {
          echo "<option value='".$i."'>".$i."</option>";
        }
      ?>
    </select>
    <input type="submit" name="submit" value="แสดงผล">
  </form>

  <?php
    // ตรวจสอบว่ามีการส่งข้อมูลวันเดือนปีเกิดผ่านแบบ POST หรือไม่
    if (isset($_POST['submit'])) {
      // ดึงค่าวันเดือนปีเกิดจากฟอร์ม
      $day = $_POST['day'];
      $month = $_POST['month'];
      $year = $_POST['year'];

    // สร้างวันเดือนปีเกิดในรูปแบบของ PHP
    $dob = date_create($year.'-'.$month.'-'.$day);

      // ตรวจสอบว่าวันเดือนปีเกิดถูกต้องหรือไม่
      if (!checkdate($month, $day, $year)) {
        echo "กรุณากรอกวันเดือนปีเกิดให้ถูกต้อง";
      } else {
        // แสดงผลวันเดือนปีเกิด
        echo "วันเกิด ".date_format($dob, "d/m/Y");
      }
    }