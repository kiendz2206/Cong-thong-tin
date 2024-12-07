<?php
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TenNguoiDung = $_POST['TenNguoiDung'];
    $MatKhau = $_POST['MatKhau'];
    $Email = $_POST['Email'];
    $VaiTroID = 3; // Mặc định vai trò là "người dùng"

    $message = ""; // Biến lưu thông báo
    $messageType = ""; // Biến lưu loại thông báo (success, error)

    // Kiểm tra dữ liệu trống
    if (empty($TenNguoiDung) || empty($MatKhau) || empty($Email)) {
        $message = "Vui lòng điền đầy đủ thông tin.";
        $messageType = "error";
    } else {
        // Kiểm tra tên người dùng hoặc email đã tồn tại
        $sql_check = "SELECT * FROM nguoidung WHERE TenNguoiDung = ? OR Email = ?";
        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("ss", $TenNguoiDung, $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Tên người dùng hoặc email đã tồn tại.";
            $messageType = "error";
        } else {
            // Mã hóa mật khẩu
            $hashed_password = password_hash($MatKhau, PASSWORD_BCRYPT);

            // Lưu dữ liệu vào cơ sở dữ liệu
            $sql_insert = "INSERT INTO nguoidung (TenNguoiDung, MatKhau, VaiTroID, Email) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("ssis", $TenNguoiDung, $hashed_password, $VaiTroID, $Email);

            if ($stmt->execute()) {
                $message = "Đăng ký thành công.";
                $messageType = "success";
            } else {
                $message = "Đăng ký thất bại. Vui lòng thử lại.";
                $messageType = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
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

        .register-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .register-container h2 {
            color: #b91d1d;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .register-container .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        .register-container .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .register-container .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .register-container label {
            display: block;
            font-weight: bold;
            margin: 10px 0 5px;
            color: #333;
        }

        .register-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .register-container input:focus {
            border-color: #b91d1d;
            outline: none;
        }

        .register-container button {
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

        .register-container button:hover {
            background: #ffd966;
            color: #b91d1d;
        }

        .register-container .login-link {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .register-container .login-link a {
            color: #b91d1d;
            text-decoration: none;
            font-weight: bold;
        }

        .register-container .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Đăng ký</h2>
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

            <label for="Email">Email:</label>
            <input type="email" name="Email" id="Email" required placeholder="Nhập email">

            <button type="submit">Đăng ký</button>
        </form>
        <p class="login-link">
            Đã có tài khoản? <a href="dangnhap.php">Đăng nhập ngay</a>
        </p>
    </div>
</body>
</html>