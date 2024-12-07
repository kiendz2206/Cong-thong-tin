<?php
$host = "localhost";
$username = "root"; // Tài khoản mặc định của XAMPP
$password = ""; // Mật khẩu mặc định là rỗng
$dbname = "quanlyhocvien"; // Thay bằng tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập mã hóa UTF-8
$conn->set_charset("utf8");
?>
