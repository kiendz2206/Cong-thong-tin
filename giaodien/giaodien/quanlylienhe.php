<?php
include('database.php');

session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

// Kiểm tra VaiTroID
if ($_SESSION['vaitroid'] == 3) {
    echo "Bạn không có quyền truy cập trang này.";
    exit;
}

// Xử lý yêu cầu xóa ý kiến
if (isset($_GET['delete_ID'])) {
    $deleteId = intval($_GET['delete_ID']);
    $sql = "DELETE FROM thamdoykien WHERE ID = $deleteId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Xóa ý kiến thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa ý kiến: " . $conn->error . "');</script>";
    }
}

// Lấy danh sách các ý kiến từ database
$sql = "SELECT * FROM thamdoykien ORDER BY ID DESC";
$result = $conn->query($sql);

$searchKeyword = '';
if (isset($_GET['search'])) {
    $searchKeyword = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM thamdoykien 
            WHERE ten LIKE '%$searchKeyword%' 
            OR email LIKE '%$searchKeyword%' 
            OR sdt LIKE '%$searchKeyword%' 
            OR CauHoi LIKE '%$searchKeyword%' 
            ORDER BY ID DESC";
} else {
    $sql = "SELECT * FROM thamdoykien ORDER BY id DESC";
}

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
            margin: 0;
            padding: 0;
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

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            font-weight: bold;
        }


        .table th, .table td {
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .search-form {
            display: flex;
            justify-content: center;  /* Căn giữa theo chiều ngang */
            align-items: center;      /* Căn giữa theo chiều dọc */
            width: 100%;
            margin: 20px 0;
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

        .main-content {
            text-align: center;  /* Căn giữa nội dung của main-content */
        }
        
    </style>
</head>
<body>

    <div class="header">
        <a href="tintuc.php" style="text-decoration: none; color: inherit;">
            <h1>Cổng Thông Tin Học Viện</h1>
        </a>
    </div>

    <div class="navbar">
        <h2>Quản Lý Thăm Dò Ý Kiến</h2>
    </div>

    <div class="main-content">
        <!-- Form tìm kiếm -->
        <form class="search-form" method="GET">
            <input type="text" name="search" placeholder="Nhập từ khóa tìm kiếm..." value="<?= htmlspecialchars($searchKeyword) ?>">
            <button type="submit">Tìm kiếm</button>
        </form>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Câu hỏi</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['ID']; ?></td>
                            <td><?= htmlspecialchars($row['ten']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['sdt']); ?></td>
                            <td><?= htmlspecialchars($row['CauHoi']); ?></td>
                            <td>
                                <a class="delete-btn" href="quanlylienhe.php?delete_ID=<?= $row['ID']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Không có dữ liệu thăm dò ý kiến.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>