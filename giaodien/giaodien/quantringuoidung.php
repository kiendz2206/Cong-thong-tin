<?php
// Include file kết nối cơ sở dữ liệu
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

// Kiểm tra nếu có từ khóa tìm kiếm
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = trim($_GET['search']);
}

// Truy vấn dữ liệu từ bảng nguoidung với điều kiện tìm kiếm
$sql = "SELECT * FROM nguoidung WHERE TenNguoiDung LIKE ? OR Email LIKE ?";
$stmt = $conn->prepare($sql);
$searchWildcard = "%" . $searchTerm . "%"; // Thêm dấu % vào trước và sau từ khóa tìm kiếm
$stmt->bind_param("ss", $searchWildcard, $searchWildcard);
$stmt->execute();
$result = $stmt->get_result();

// Truy vấn các vai trò từ bảng vaitro
$sqlRoles = "SELECT ID, TenVaiTro FROM vaitro";
$rolesResult = $conn->prepare($sqlRoles);
$rolesResult->execute();
$roles = $rolesResult->get_result()->fetch_all(MYSQLI_ASSOC);

// Kiểm tra nếu form được gửi qua phương thức POST (Thêm người dùng mới hoặc Sửa thông tin)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Chuẩn bị biến cho các thông báo
    $message = '';

    if (isset($_POST['addUser'])) {
        // Lấy dữ liệu từ form thêm người dùng
        $userName = trim($_POST['userName']);
        $userEmail = trim($_POST['userEmail']);
        $userPassword = trim($_POST['userPassword']);
        $userRole = intval($_POST['userRole']);

        if (empty($userName) || empty($userEmail) || empty($userPassword) || empty($userRole)) {
            $message = 'Vui lòng điền đầy đủ thông tin.';
        } else {
            // Mã hóa mật khẩu trước khi lưu
            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

            // Chuẩn bị câu lệnh SQL để thêm người dùng
            $sqlInsert = "INSERT INTO nguoidung (TenNguoiDung, Email, MatKhau, VaiTroID, NgayTao) 
                          VALUES (?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sqlInsert);
            $stmt->bind_param("sssi", $userName, $userEmail, $hashedPassword, $userRole);

            if ($stmt->execute()) {
                $message = 'Người dùng đã được thêm thành công.';
            } else {
                $message = 'Lỗi khi thêm người dùng.';
            }
            $stmt->close();
        }
    } elseif (isset($_POST['editUser'])) {
        // Lấy dữ liệu từ form sửa người dùng
        $userId = intval($_POST['userId']);
        $userName = trim($_POST['userName']);
        $userEmail = trim($_POST['userEmail']);
        $userPassword = trim($_POST['userPassword']);
        $userRole = intval($_POST['userRole']);

        if (empty($userName) || empty($userEmail) || empty($userRole)) {
            $message = 'Vui lòng điền đầy đủ thông tin.';
        } else {
            // Mã hóa mật khẩu nếu người dùng thay đổi mật khẩu
            $sqlUpdate = "UPDATE nguoidung SET TenNguoiDung = ?, Email = ?, VaiTroID = ? ";
            $params = [$userName, $userEmail, $userRole];
            $types = "ssi";

            if (!empty($userPassword)) {
                $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
                $sqlUpdate .= ", MatKhau = ?";
                $params[] = $hashedPassword;
                $types .= "s";
            }
            $sqlUpdate .= " WHERE ID = ?";
            $params[] = $userId;
            $types .= "i";

            $stmt = $conn->prepare($sqlUpdate);
            $stmt->bind_param($types, ...$params);

            if ($stmt->execute()) {
                $message = 'Thông tin người dùng đã được cập nhật.';
            } else {
                $message = 'Lỗi khi cập nhật thông tin người dùng.';
            }
            $stmt->close();
        }
    }
    echo "<script>alert('$message'); window.location.href='';</script>";
}

// Xóa người dùng
if (isset($_GET['deleteUser'])) {
    $userId = intval($_GET['deleteUser']);
    $sqlDelete = "DELETE FROM nguoidung WHERE ID = ?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<script>alert('Người dùng đã được xóa thành công.'); window.location.href='';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa người dùng.');</script>";
    }
    $stmt->close();
}

// Hiển thị thông tin để sửa
$editingUser = null;
if (isset($_GET['editUser'])) {
    $userId = intval($_GET['editUser']);
    $sqlEdit = "SELECT * FROM nguoidung WHERE ID = ?";
    $stmt = $conn->prepare($sqlEdit);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $editingUser = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
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
        /* Định dạng tổng quan */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        /* Căn giữa phần nội dung chính */
        .content {
            display: flex;
            justify-content: center; /* Căn giữa nội dung trong trang */
            margin: 20px;
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
        /* Căn giữa phần nội dung chính */
        .main-content {
            width: 100%; /* Đảm bảo nội dung có thể chiếm hết không gian */
            max-width: 1200px; /* Đặt chiều rộng tối đa để nội dung không bị rộng quá */
            margin-left: 0;
            margin-right: 0;
        }

        /* Căn giữa tiêu đề */
        .main-content h2 {
            color: #b91d1d;
            font-weight: bold;
            text-align: center;
        }

        /* Các phần tử bên trong bài viết */
        .article {
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Căn giữa header */
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
        <span>Menu</span>
        <div class="dropdown-menu">
            <a href="quantringuoidung.php">Quản trị người dùng</a>
            <a href="quantribocuc.php">Quản trị bố cục</a>
            <a href="quantritinbai.php">Quản trị tin bài</a>
            <a href="quantricongcon.php">Quản trị cổng con</a>
            <a href="baomatchiutaisaoluu.php">Bảo mật</a>
        </div>
    </div>
</div>
    <div class="navbar">
        <h2>Quản lý người dùng</h2>
    </div>

    <div class="content">

        <div class="main-content">
            <!-- Form tìm kiếm -->
             <h3> Tìm kiếm </h3>
            <form method="GET" action="" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm người dùng theo tên hoặc email" value="<?= htmlspecialchars($searchTerm) ?>">
                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                </div>
            </form>

            <!-- Form thêm hoặc sửa người dùng -->
            <div class="article">
                <h3><?php echo $editingUser ? 'Sửa thông tin người dùng' : 'Thêm người dùng mới'; ?></h3>
                <form method="POST" action="">
                    <input type="hidden" name="userId" value="<?= $editingUser ? $editingUser['ID'] : ''; ?>">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="userName" name="userName" value="<?= $editingUser ? $editingUser['TenNguoiDung'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?= $editingUser ? $editingUser['Email'] : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Chỉ để trống nếu không thay đổi">
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Vai trò</label>
                        <select class="form-select" id="userRole" name="userRole" required>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['ID'] ?>" <?= $editingUser && $role['ID'] == $editingUser['VaiTroID'] ? 'selected' : ''; ?>>
                                    <?= $role['TenVaiTro'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="<?= $editingUser ? 'editUser' : 'addUser'; ?>">
                        <?= $editingUser ? 'Cập nhật' : 'Thêm người dùng'; ?>
                    </button>
                </form>
            </div>

            <!-- Danh sách người dùng -->
            <div class="article">
                <h3>Danh sách người dùng</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày Tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $user['ID'] ?></td>
                                <td><?= $user['TenNguoiDung'] ?></td>
                                <td><?= $user['Email'] ?></td>
                                <td><?= $roles[array_search($user['VaiTroID'], array_column($roles, 'ID'))]['TenVaiTro'] ?></td>
                                <td><?= $user['NgayTao'] ?></td>
                                <td>
                                    <a href="?editUser=<?= $user['ID'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <!-- Bootstrap JS & jQuery -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>