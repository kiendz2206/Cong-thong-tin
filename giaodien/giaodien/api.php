<?php
// Lấy tháng và năm hiện tại
$currentMonth = date('m');
$currentYear = date('Y');

// Kiểm tra nếu có tháng và năm được gửi qua URL
if (isset($_GET['month'])) {
    $currentMonth = $_GET['month'];
}
if (isset($_GET['year'])) {
    $currentYear = $_GET['year'];
}

// Lấy số ngày trong tháng
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Tìm ngày đầu tháng và ngày cuối tháng
$firstDayOfMonth = strtotime("$currentYear-$currentMonth-01");
$lastDayOfMonth = strtotime("$currentYear-$currentMonth-" . $daysInMonth);

// Lấy ngày trong tuần của ngày đầu tiên của tháng (0 = Chủ nhật, 6 = Thứ bảy)
$firstDayOfWeek = date('w', $firstDayOfMonth);

// Tạo liên kết điều hướng giữa các tháng
$prevMonth = date('m', strtotime("-1 month", $firstDayOfMonth));
$prevYear = date('Y', strtotime("-1 month", $firstDayOfMonth));
$nextMonth = date('m', strtotime("+1 month", $lastDayOfMonth));
$nextYear = date('Y', strtotime("+1 month", $lastDayOfMonth));
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Tháng <?php echo $currentMonth . '/' . $currentYear; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calendar {
            width: 350px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .calendar-header {
            text-align: center;
        }
        .calendar-header h2 {
            margin: 0;
        }
        .calendar-header a {
            text-decoration: none;
            color: #333;
        }
        .calendar-header a:hover {
            color: #007bff;
        }
        .calendar-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .calendar-table th, .calendar-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .calendar-table th {
            background-color: #f8f9fa;
        }
        .calendar-table td {
            cursor: pointer;
        }
        .calendar-table td:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <div class="calendar">
        <div class="calendar-header">
            <h2>Lịch <?php echo $currentMonth . '/' . $currentYear; ?></h2>
            <p>
                <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>"><< Tháng trước</a> | 
                <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>">Tháng sau >></a>
            </p>
        </div>

        <table class="calendar-table">
            <thead>
                <tr>
                    <th>CN</th>
                    <th>T2</th>
                    <th>T3</th>
                    <th>T4</th>
                    <th>T5</th>
                    <th>T6</th>
                    <th>T7</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Hiển thị các ngày trong tháng
                $dayCounter = 1;
                $rows = ceil(($firstDayOfWeek + $daysInMonth) / 7);

                for ($i = 0; $i < $rows; $i++) {
                    echo '<tr>';
                    for ($j = 0; $j < 7; $j++) {
                        if ($i == 0 && $j < $firstDayOfWeek) {
                            echo '<td></td>'; // Các ngày trống đầu tháng
                        } elseif ($dayCounter <= $daysInMonth) {
                            echo '<td>' . $dayCounter . '</td>';
                            $dayCounter++;
                        } else {
                            echo '<td></td>'; // Các ngày trống cuối tháng
                        }
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
