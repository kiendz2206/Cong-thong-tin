<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng Thông Tin Học Viện</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Tùy chỉnh -->
    <link rel="stylesheet" href="styles.css">
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
        .header {
    background-color: #ffd966;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between; /* Đẩy các phần tử về hai phía */
    position: relative;
}

.account-info {
    font-size: 14px;
    color: #333;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    position: relative;
}

.account-info span {
    margin-right: 10px; /* Tạo khoảng cách với menu */
}

.account-info .dropdown-menu {
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

.account-info .dropdown-menu a {
    color: #333;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    font-size: 14px;
}

.account-info .dropdown-menu a:hover {
    background-color: #f1f1f1;
}

    </style>
</head>
<body>
<div class="header">
    <a href="tintuc.php" style="text-decoration: none; color: inherit;">
        <h1>Cổng Thông Tin Học Viện</h1>
    </a>
    <div class="account-info" id="accountInfo">
        <span>Chào Nguyễn Văn A</span>
        <div class="dropdown-menu">
            <a href="quantringuoidung.php">Quản trị người dùng</a>
            <a href="quantribocuc.php">Quản trị bố cục</a>
            <a href="quantritinbai.php">Quản trị tin bài</a>
            <a href="quantricongcon.php">Quản trị cổng con</a>
            <a href="baomatchiutaisaoluu.php">Quản trị người dùng</a>
        </div>
    </div>
</div>
    <!-- Thanh menu điều hướng -->
    <div class="navbar">
        <a>BẢO MẬT, CHỊU TẢI, SAO LƯU HỌC VIỆN</a>
    </div>
    <!-- Quản lý Bảo mật và Hệ thống -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Bảo mật Hệ thống</h3>
                <form>
                    <div class="mb-3">
                        <label for="authMethod" class="form-label">Phương thức xác thực</label>
                        <select class="form-select" id="authMethod">
                            <option value="basic">Xác thực cơ bản</option>
                            <option value="2fa">Xác thực 2 yếu tố (2FA)</option>
                            <option value="ldap">LDAP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="loginAttempts" class="form-label">Số lần đăng nhập tối đa</label>
                        <input type="number" class="form-control" id="loginAttempts" value="5">
                    </div>
                    <div class="mb-3">
                        <label for="firewallStatus" class="form-label">Trạng thái Tường lửa</label>
                        <select class="form-select" id="firewallStatus">
                            <option value="enabled">Bật</option>
                            <option value="disabled">Tắt</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật cài đặt bảo mật</button>
                </form>
            </div>

            <div class="col-md-6">
                <h3>Giám sát và Phân tải</h3>
                <form>
                    <div class="mb-3">
                        <label for="serverLoad" class="form-label">Chia tải máy chủ</label>
                        <select class="form-select" id="serverLoad">
                            <option value="auto">Tự động</option>
                            <option value="manual">Thủ công</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="serverMonitoring" class="form-label">Giám sát tình trạng máy chủ</label>
                        <select class="form-select" id="serverMonitoring">
                            <option value="enabled">Bật</option>
                            <option value="disabled">Tắt</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="loadBalancer" class="form-label">Máy chủ cân bằng tải</label>
                        <select class="form-select" id="loadBalancer">
                            <option value="nginx">Nginx</option>
                            <option value="apache">Apache</option>
                            <option value="haproxy">HAProxy</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật cài đặt phân tải</button>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Sao lưu và phục hồi dữ liệu</h3>
                <form>
                    <div class="mb-3">
                        <label for="backupFrequency" class="form-label">Tần suất sao lưu</label>
                        <select class="form-select" id="backupFrequency">
                            <option value="daily">Hằng ngày</option>
                            <option value="weekly">Hằng tuần</option>
                            <option value="monthly">Hằng tháng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="backupLocation" class="form-label">Vị trí sao lưu</label>
                        <input type="text" class="form-control" id="backupLocation" value="Đám mây">
                    </div>
                    <div class="mb-3">
                        <label for="restoreData" class="form-label">Khôi phục dữ liệu từ sao lưu</label>
                        <button type="button" class="btn btn-warning">Khôi phục từ sao lưu</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật cài đặt sao lưu</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript xử lý dropdown menu -->
    <script>
    document.getElementById('accountInfo').addEventListener('click', function(event) {
        // Ngừng sự kiện mặc định
        event.stopPropagation();
        var dropdownMenu = document.querySelector('.dropdown-menu');
        // Toggle hiển thị menu
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
    });

    // Đảm bảo rằng menu sẽ ẩn khi người dùng nhấp ra ngoài
    window.addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        if (!event.target.closest('#accountInfo')) {
            dropdownMenu.style.display = 'none';
        }
    });
</script>

</body>
</html>
