<head>
    <meta charset="UTF-8">
    <title>Thai Date Selector</title>
    <script>
        function validateForm() {
            const day = parseInt(document.getElementById("day").value);
            const month = parseInt(document.getElementById("month").value);
            const year = parseInt(document.getElementById("year").value);

            const date = new Date(year, month - 1, day);
            let errorMessage = "";
            const thaiMonths = ["มกราคม","กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
 
            if (date.getFullYear() !== year) {
                errorMessage = "ปีไม่ถูกต้อง: " + year;
            } else if (date.getMonth() + 1 !== month) {
                if (month === 2 && day === 29 && ((year % 4 !== 0) || (year % 100 === 0 && year % 400 !== 0))) {
                    errorMessage = "กรุณาเช็ควันให้ถูกต้องเพราะวันที่ 29 ไม่มีในเดือนกุมภาพันธ์ปีนี้";
                } else {
                    errorMessage = "วันไม่ถูกต้อง: " + day;
                }
            } else if (date.getDate() !== day) {
                errorMessage = "วันไม่ถูกต้อง: " + day;
            }

            if (errorMessage) {
                errorMessage += "\nกรุณาเช็ควันให้ถูกต้องเพราะวันที่ " + day + " ไม่มีในเดือน " + thaiMonths[month - 1];
                alert(errorMessage);
                return false;
            }
            return true;
        }
    </script>
</head>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm();">
    <label for="day">วันที่:</label>
    <select name="day" id="day" required>
        <?php for ($i = 1; $i <= 31; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
    
    <label for="month">เดือน:</label>
    <select name="month" id="month" required>
        <?php
        $thaiMonths = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
        foreach ($thaiMonths as $index => $monthName) : ?>
            <option value="<?php echo $index + 1; ?>"><?php echo $monthName; ?></option>
        <?php endforeach; ?>
    </select>
    
    <label for="year">ปี ค.ศ:</label>
    <input type="number" name="year" id="year" min="1900" max="2100" required>
    <input type="submit" value="Submit">
</form>


<?php

class ThaiDate {
    private $day;
    private $month;
    private $year;

    public function __construct($day, $month, $year) {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    public function getWeekday() {
        $weekdays = ["วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์", "วันเสาร์", "วันอาทิตย์"];
        $date = new DateTime("$this->year-$this->month-$this->day");
        $weekday = $date->format("N") - 1;
        return $weekdays[$weekday];
    }

    public function getThaiMonth() {
        $thaiMonths = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
        return $thaiMonths[$this->month - 1];
    }

    public function __toString() {
        return $this->getWeekday() . " ที่ " . $this->day . " " . $this->getThaiMonth() . " ค.ศ. " . $this->year;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $date = new ThaiDate($day, $month, $year);
    echo $date;
}

?>