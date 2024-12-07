<?php
include('database.php');
session_start();
// Kiểm tra xem form có được gửi không
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form
    $ten = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $sdt = $conn->real_escape_string($_POST['phone']);
    $cauhoi = $conn->real_escape_string($_POST['message']);

    // Câu lệnh SQL để chèn dữ liệu
    $sql = "INSERT INTO thamdoykien (CAUHOI, ten, email, sdt) VALUES ('$cauhoi', '$ten', '$email', '$sdt')";

    // Thực thi câu lệnh SQL
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Gửi liên hệ thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi khi gửi liên hệ: " . $conn->error . "');</script>";
    }
}
?>

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

        /* Nội dung chính */
        .main-content {
            width: 75%;
            margin-left: 5%;
        }

        /* Form liên hệ */
        .contact-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .contact-form h2 {
            color: #b91d1d;
            font-weight: bold;
            margin-top: 0;
        }
        .contact-form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .contact-form button {
            margin-top: 10px;
            background-color: #b91d1d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #ffd966;
            color: #b91d1d;
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
    </style>
</head>
<body>

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
        <!-- Sidebar trái -->
        <div class="sidebar">
        <h3>THÔNG TIN LIÊN HỆ CỦA HỌC VIỆN</h3>
            <ul>
                <li><a>Email: tuyensinh@eaut.edu.vn</a></li><br>
                <li><a></a>Điện thoại: 0243.555.2008/
                024.2236.5888</li><br>
                <li><a>Địa chỉ: Đường Trịnh Văn Bô, Nam Từ Liêm, Hà Nội</a></li><br>
                
            </ul>
        </div>
        
        <!-- Nội dung chính -->
        <div class="main-content">
            <!-- Form liên hệ -->
            <div class="contact-form">
                <h2>Liên hệ với chúng tôi</h2>
                <form action="lienhe.php" method="POST">
                    <label for="name">Tên của bạn</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" required pattern="[0-9]{10}">

                    <label for="message">Nội dung</label>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit">Gửi liên hệ</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Phần người dùng online -->
    <div class="online-users">
        <strong>Người dùng online: </strong><span id="onlineCount">5</span>
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

</body>
</html>
