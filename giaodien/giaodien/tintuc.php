<?php
include('database.php');

// Lấy dữ liệu bài viết ở trạng thái 'Đã xuất bản'
$sql = "SELECT * FROM tinbai WHERE TrangThai = 1 ORDER BY NgayXuatBan DESC";
$result = $conn->query($sql);
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
            flex-direction: column;
            margin: 20px;
        }

        /* Thanh menu bên trái */
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

        /* Phần tin tức */
        .news-list {
            display: flex;
            flex-direction: column; /* Hiển thị các mục tin tức dọc */
            gap: 20px; /* Khoảng cách giữa các tin tức */
        }

        .news-item {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news-item h2 {
            font-size: 20px;
            color: #b91d1d;
            margin: 0;
        }

        .news-item small {
            display: block;
            margin: 10px 0;
            color: #777;
        }

        .news-item p {
            font-size: 14px;
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
    </style>
</head>
<body>

    <!-- Đầu trang -->
    <div class="header">
        <div style="display: flex; align-items: center;">
            <img src="logo.png" alt="Logo Học Viện">
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
        <h1>Danh sách Tin Tức</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="news-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="news-item">
                        <h2><?php echo htmlspecialchars($row['TieuDe']); ?></h2>
                        <small>Ngày đăng: <?php echo htmlspecialchars($row['NgayXuatBan']); ?></small>
                        <p><?php echo htmlspecialchars($row['NoiDung']); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Không có bài viết nào để hiển thị.</p>
        <?php endif; ?>
    </div>

    <!-- Phần người dùng online -->
    <div class="online-users">
        <strong>Người dùng online: </strong><span id="onlineCount">100</span>
    </div>

    <script>
        const isLoggedIn = true;
        const username = "NguyenVanA";
        const isAdmin = false;

        const accountInfoDiv = document.getElementById('accountInfo');

        if (isLoggedIn) {
            accountInfoDiv.innerHTML = `
                <span>Menu</span>
                ${isAdmin ? '<span>(Admin)</span>' : ''}
                <div class="dropdown-menu">
                    <a href="quantringuoidung.php">Quản trị người dùng</a>
                    <a href="quantribocuc.php">Quản trị bố cục</a>
                    <a href="quantritinbai.php">Quản trị tin bài</a>
                    <a href="quantricongcon.php">Quản trị cổng con</a>
                    <a href="quanlylienhe.php">Quản lý liên hệ</a>
                    <a href="quanlylichsudangnhap.php">Quản lý lịch sử đăng nhập</a>
                </div>
            `;
        } else {
            accountInfoDiv.innerHTML = `<a href="dangnhap.php">Đăng nhập</a>`;
        }

        // Xử lý dropdown menu
        accountInfoDiv.addEventListener('click', function () {
            const dropdownMenu = document.querySelector('.dropdown-menu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });
    </script>
</body>
</html>