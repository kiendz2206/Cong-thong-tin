<?php
session_start();
include('database.php'); // Kết nối đến cơ sở dữ liệu

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

// Lấy dữ liệu lịch sử đăng nhập
$sql = "
    SELECT ls.ID, nd.TenNguoiDung, ls.ThoiGianDangNhap, ls.DiaChiIP
    FROM lichsudangnhap ls
    JOIN nguoidung nd ON ls.NguoiDungID = nd.ID
    ORDER BY ls.ThoiGianDangNhap DESC
";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng Thông Tin Học Viện</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }

        .header {
            background-color: #ffd966;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar {
            background-color: #b91d1d;
            color: #fff;
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }

        .navbar h2 {
            margin: 0;
        }

        .container {
            margin-top: 30px;
        }

        .search-form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .search-form input {
            width: 300px;
            padding: 10px;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .main-content {
            margin-top: 30px;
        }

        .delete-btn {
            color: #fff;
            background-color: #dc3545;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 10px;
        }
        
    </style>
</head>
<body>

    <div class="header">
        <h1>Cổng Thông Tin Học Viện</h1>
    </div>

    <div class="navbar">
        <h2>Quản lý lịch sử đăng nhập</h2>
    </div>

    <div class="container">
        <div class="search-form">
            <input type="text" class="form-control" id="searchInput" placeholder="Nhập từ khóa tìm kiếm...">
            <button class="btn btn-primary" id="searchBtn">Tìm kiếm</button>
        </div>

        <!-- Table -->
        <div class="main-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Thời gian đăng nhập</th>
                        <th>Địa chỉ IP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['ID']); ?></td>
                                <td><?php echo htmlspecialchars($row['TenNguoiDung']); ?></td>
                                <td><?php echo htmlspecialchars($row['ThoiGianDangNhap']); ?></td>
                                <td><?php echo htmlspecialchars($row['DiaChiIP']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Không có lịch sử đăng nhập nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <p><a href="tintuc.php">Quay lại</a></p>
    </div>

    <script>
        // Tìm kiếm người dùng trong bảng
        const searchBtn = document.getElementById("searchBtn");
        const searchInput = document.getElementById("searchInput");

        searchBtn.addEventListener("click", () => {
            const searchTerm = searchInput.value.toLowerCase();
            document.querySelectorAll("tbody tr").forEach((row) => {
                const cells = row.children;
                let rowVisible = false;
                // Duyệt qua tất cả các ô trong hàng
                for (let i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                        rowVisible = true;
                        break;
                    }
                }
                row.style.display = rowVisible ? "" : "none";
            });
        });
    </script>

</body>
</html>