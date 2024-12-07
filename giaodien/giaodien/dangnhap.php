<?php
session_start();
include('database.php'); // Kết nối đến cơ sở dữ liệu

$message = ""; // Biến lưu thông báo
$messageType = ""; // Biến lưu loại thông báo (success, error)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $TenNguoiDung = trim($_POST['TenNguoiDung']);
    $MatKhau = trim($_POST['MatKhau']);

    // Kiểm tra dữ liệu rỗng
    if (empty($TenNguoiDung) || empty($MatKhau)) {
        $message = "Vui lòng nhập đầy đủ tên người dùng và mật khẩu.";
        $messageType = "error";
    } else {
        // Truy vấn cơ sở dữ liệu
        $sql = "SELECT * FROM nguoidung WHERE TenNguoiDung = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $TenNguoiDung);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Kiểm tra mật khẩu
            if (password_verify($MatKhau, $user['MatKhau'])) {
                // Lưu thông tin vào session
                $_SESSION['user_id'] = $user['ID'];
                $_SESSION['tennguoidung'] = $user['TenNguoiDung'];
                $_SESSION['vaitroid'] = $user['VaiTroID'];

                // Lưu lịch sử đăng nhập
                $ip_address = $_SERVER['REMOTE_ADDR']; // Lấy địa chỉ IP
                $thoi_gian = date("Y-m-d H:i:s");
                $sql_insert = "INSERT INTO lichsudangnhap (NguoiDungID, ThoiGianDangNhap, DiaChiIP) 
                               VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("iss", $user['ID'], $thoi_gian, $ip_address);
                $stmt_insert->execute();

                // Điều hướng theo VaiTroID
                if ($user['VaiTroID'] == 3) {
                    header("Location: tintuc.php");
                } else {
                    header("Location: congthongtin.php");
                }
                exit;
            } else {
                $message = "Sai mật khẩu.";
                $messageType = "error";
            }
        } else {
            $message = "Tên người dùng không tồn tại.";
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffd966, #b91d1d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            color: #b91d1d;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login-container .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        .login-container .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .login-container .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .login-container label {
            display: block;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #333;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .login-container input:focus {
            border-color: #b91d1d;
            outline: none;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background: #b91d1d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-container button:hover {
            background: #ffd966;
            color: #b91d1d;
        }

        .login-container .register-link {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .login-container .register-link a {
            color: #b91d1d;
            text-decoration: none;
            font-weight: bold;
        }

        .login-container .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <?php if (!empty($message)): ?>
            <div class="message <?= $messageType; ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="TenNguoiDung">Tên người dùng:</label>
            <input type="text" name="TenNguoiDung" id="TenNguoiDung" required placeholder="Nhập tên người dùng">

            <label for="MatKhau">Mật khẩu:</label>
            <input type="password" name="MatKhau" id="MatKhau" required placeholder="Nhập mật khẩu">

            <button type="submit">Đăng nhập</button>
        </form>
        <p class="register-link">
            Chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a>
        </p>
    </div>
</body>
</html>