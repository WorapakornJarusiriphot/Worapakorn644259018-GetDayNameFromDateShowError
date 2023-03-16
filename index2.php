<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Select Date of Birth</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
      });
    } );
  </script>
</head>
<body>
  <form method="post">
    <label>วันเดือนปีเกิด:</label>
    <input type="text" id="datepicker" name="dob" required>
    <input type="submit" name="submit" value="แสดงผล">
  </form>

  <?php
    // ตรวจสอบว่ามีการส่งข้อมูลวันเดือนปีเกิดผ่านแบบ POST หรือไม่
    if (isset($_POST['submit'])) {
      // ดึงค่าวันเดือนปีเกิดจากฟอร์ม
      $dob = $_POST['dob'];

      // แสดงผลวันเดือนปีเกิด
      echo "วันเกิด ".$dob;
    }
  ?>
</body>
</html>
