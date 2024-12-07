<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng Thông Tin Học Viện</title>
    <style>
        /* Định dạng tổng quan */
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }
        
        /* Đầu trang */
        .header {
            background-color: #ffd966;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header img {
            height: 60px;
        }
        .header h1 {
            font-size: 24px;
            color: #b91d1d;
            margin: 0;
        }
        
        /* Thanh menu điều hướng */
        .navbar {
            background-color: #b91d1d;
            color: #fff;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            font-weight: bold;
        }
        .navbar a:hover {
            background-color: #ffd966;
            color: #b91d1d;
        }
        
        /* Thông tin tài khoản */
        .account-info {
            font-size: 14px;
            color: #333;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            cursor: pointer;
        }
        .account-info a {
            color: #b91d1d;
            text-decoration: none;
            font-weight: normal;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .account-info a:hover {
            background-color: #ffd966;
        }

        /* Dropdown menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 35px;
            right: 0;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 1;
        }
        .dropdown-menu a {
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            font-size: 14px;
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }

        /* Bố cục chính */
        .content {
            display: flex;
            margin: 20px;
        }
        /* Sidebar trái */
        .sidebar {
            width: 20%;
            background-color: #f1f1f1;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h3 {
            color: #b91d1d;
            font-weight: bold;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 10px 0;
        }
        .sidebar ul li a {
            color: #333;
            text-decoration: none;
        }
        .sidebar ul li a:hover {
            color: #b91d1d;
        }

        /* Nội dung chính */
        .main-content {
            width: 75%;
            margin-left: 5%;
        }
        .main-content h2 {
            color: #b91d1d;
            font-weight: bold;
        }
        .article {
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .article h3 {
            color: #333;
        }

        /* Phần người dùng online */
        .online-users {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #ffd966;
            padding: 10px 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 10;
        }
        /* Cải tiến phần lịch */
.calendar {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    font-family: 'Arial', sans-serif;
}

.calendar-header h2 {
    color: #b91d1d;
    font-size: 28px;
    font-weight: bold;
    margin: 0;
}

.calendar-header a {
    color: #b91d1d;
    font-weight: bold;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.calendar-header a:hover {
    background-color: #ffd966;
}

.calendar-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.calendar-table th, .calendar-table td {
    padding: 20px;
    text-align: center;
    width: 14.28%;
    font-size: 16px;
    color: #333;
    border: 1px solid #ddd;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.calendar-table th {
    background-color: #ffd966;
    font-weight: bold;
}

.calendar-table td {
    background-color: #f9f9f9;
    cursor: pointer;
}

.calendar-table td:hover {
    background-color: #ffd966;
    color: #b91d1d;
}

.calendar-table .current-day {
    background-color: #ffeb3b;
    font-weight: bold;
    color: #b91d1d;
}

.calendar-table .empty-day {
    background-color: #f1f1f1;
}

    </style>
</head>
<body>
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
    <!-- Đầu trang -->
    <div class="header">
        <div style="display: flex; align-items: center;">
            <a href="tintuc.php">
                <img src="logo.png" alt="Logo Học Viện">
            </a>
            <h1>Cổng Thông Tin Học Viện</h1>
        </div>
        
        <!-- Thanh tìm kiếm và chọn ngôn ngữ -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <input type="text" placeholder="Tìm kiếm..." style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
            <select id="languageSelect" style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="vi">Tiếng Việt</option>
                <option value="en">English</option>
            </select>
        </div>

        <!-- Thông tin tài khoản -->
        <div class="account-info" id="accountInfo">
            <!-- JavaScript sẽ thay đổi nội dung ở đây -->
        </div>
    </div>

    <!-- Thanh menu điều hướng -->
    <div class="navbar">
        <a href="tintuc.php">TIN TỨC</a>
        <a href="congthongtin.php">CÁC CỔNG THÔNG TIN KHÁC CỦA HỌC VIỆN</a>
        <a href="lienhe.php">LIÊN HỆ</a>
        <a href="tienich.php">TIỆN ÍCH</a>
    </div>

    <!-- Bố cục chính -->
    <div class="content">
        
        <!-- Nội dung chính -->
        <div class="main-content">
            <div class="article">
            <div class="calculator">
    <h2>Máy Tính PHP</h2>
    <form method="POST" action="">
        <input type="number" name="number1" step="any" placeholder="Nhập số thứ nhất" required>
        
        <select name="operation" required>
            <option value="add">Cộng (+)</option>
            <option value="subtract">Trừ (-)</option>
            <option value="multiply">Nhân (×)</option>
            <option value="divide">Chia (÷)</option>
        </select>

        <input type="number" name="number2" step="any" placeholder="Nhập số thứ hai" required>
        
        <button type="submit" name="calculate">Tính Kết Quả</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculate'])) {
        $num1 = $_POST['number1'];
        $num2 = $_POST['number2'];
        $operation = $_POST['operation'];
        $result = '';

        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                break;
            case "subtract":
                $result = $num1 - $num2;
                break;
            case "multiply":
                $result = $num1 * $num2;
                break;
            case "divide":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = "Không thể chia cho 0";
                }
                break;
            default:
                $result = "Phép toán không hợp lệ";
        }

        echo "<div class='result'><strong>Kết quả:</strong> $result</div>";
    }
    ?>
                </div>
            </div>

            <div class="article">
            <div class="chat-container">
    <h2>Chat với GPT</h2>
    
    <!-- Hiển thị các tin nhắn -->
    <div class="chat-box">
        <?php if (isset($user_message)) { ?>
            <div class="user-message"><strong>Bạn:</strong> <?php echo htmlspecialchars($user_message); ?></div>
            <div class="gpt-message"><strong>GPT:</strong> <?php echo htmlspecialchars($gpt_reply); ?></div>
        <?php } ?>
    </div>
    
    <!-- Form gửi tin nhắn -->
    <form method="POST" action="">
        <input type="text" name="message" placeholder="Nhập tin nhắn của bạn..." required>
        <button type="submit">Gửi</button>
    </form>
</div>
            </div>


            <div class="article">
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
                        echo '<td class="empty-day"></td>'; // Các ngày trống đầu tháng
                    } elseif ($dayCounter <= $daysInMonth) {
                        // Kiểm tra nếu là ngày hiện tại
                        $class = ($dayCounter == date('d')) ? 'current-day' : '';
                        echo "<td class='$class'>$dayCounter</td>";
                        $dayCounter++;
                    } else {
                        echo '<td class="empty-day"></td>'; // Các ngày trống cuối tháng
                    }
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>


    <!-- Phần người dùng online -->
    <div class="online-users">
        <strong>Người dùng online: </strong><span id="onlineCount">10</span>
    </div>

    <script>
        const isLoggedIn = true;
        const username = "NguyenVanA";
        const isAdmin = false;

        const accountInfoDiv = document.getElementById('accountInfo');

        if (isLoggedIn) {
            accountInfoDiv.innerHTML = `
                <span>Chào ${username}</span>
                ${isAdmin ? '<span>(Admin)</span>' : ''}
                <div class="dropdown-menu">
                    <a href="quantringuoidung.php">Quản trị người dùng</a>
                    <a href="quantribocuc.php">Quản trị bố cục</a>
                    <a href="quantritinbai.php">Quản trị tin bài</a>
                    <a href="quantricongcon.php">Quản trị cổng con</a>
                    <a href="quantringuoidung.php">Quản trị người dùng</a>
                    <a href="quanlylienhe.php">Quản lý liên hệ</a>
                    <a href="quanlylichsudangnhap.php">Quản lý lịc sử đăng nhập</a>
                </div>
            `;
            accountInfoDiv.onclick = function () {
                const menu = accountInfoDiv.querySelector('.dropdown-menu');
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            };
        } else {
            accountInfoDiv.innerHTML = `<a href="#">Đăng nhập</a>`;
        }

        document.getElementById('onlineCount').textContent = '5';
    </script>

<?php
// Kiểm tra nếu người dùng gửi tin nhắn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy tin nhắn từ người dùng
    $user_message = $_POST['message'];
    
    // Gửi yêu cầu tới API OpenAI GPT
    $api_key = "YOUR_OPENAI_API_KEY";  // Thay thế YOUR_OPENAI_API_KEY bằng API key của bạn
    $api_url = "https://api.openai.com/v1/completions";
    
    $data = array(
        "model" => "text-davinci-003",  // Hoặc model khác nếu bạn sử dụng GPT-4
        "prompt" => $user_message,
        "max_tokens" => 150,
        "temperature" => 0.7,
    );
    
    $headers = array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $api_key,
    );
    
    // Cấu trúc dữ liệu JSON
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    // Lấy kết quả từ OpenAI API
    $response = curl_exec($ch);
    curl_close($ch);
    
    $response_data = json_decode($response, true);
    $gpt_reply = $response_data['choices'][0]['text'] ?? 'Không thể trả lời, thử lại!';
}

?>

</body>
</html>
