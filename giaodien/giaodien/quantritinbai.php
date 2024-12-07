<?php
// Kết nối với cơ sở dữ liệu
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

$chuyenMucList = [];
$sql_chuyenmuc = "SELECT id, tenchuyenmuc FROM ChuyenMuc";
$result_chuyenmuc = $conn->query($sql_chuyenmuc);
if ($result_chuyenmuc->num_rows > 0) {
    while ($row = $result_chuyenmuc->fetch_assoc()) {
        $chuyenMucList[] = $row;
    }
}

$tacGiaList = [];
$sql_tacgia = "SELECT id, tentacgia FROM TacGia";
$result_tacgia = $conn->query($sql_tacgia);
if ($result_tacgia->num_rows > 0) {
    while ($row = $result_tacgia->fetch_assoc()) {
        $tacGiaList[] = $row;
    }
}

$trangThaiList = [];
$sql_trangthai = "SELECT ID, TenTrangThai FROM trangthai";
$result_trangthai = $conn->query($sql_trangthai);
if ($result_trangthai->num_rows > 0) {
    while ($row = $result_trangthai->fetch_assoc()) {
        $trangThaiList[] = $row;
    }
}
// Xử lý tạo tin bài mới
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['TieuDe'])) {
    $title = $_POST['TieuDe'];
    $content = $_POST['NoiDung'];
    $category = $_POST['ChuyenMucID'];
    $publishDate = $_POST['NgayXuatBan'];
    $status = $_POST['TrangThai'];
    $author = $_POST['TacGiaID'];


    // Thêm tin bài vào cơ sở dữ liệu
    $query = "INSERT INTO tinbai (TieuDe, NoiDung, ChuyenMucID, NgayXuatBan, TrangThai, TacGiaID) 
              VALUES ('$title', '$content', '$category', '$publishDate', '$status', '$author')";
    mysqli_query($conn, $query);
}

// Xử lý sửa tin bài
// Xử lý sửa tin bài
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ID'])) {
    $postID = $_POST['ID'];
    $title = $_POST['TieuDe'];
    $content = $_POST['NoiDung'];
    $category = $_POST['ChuyenMucID'];
    $publishDate = $_POST['NgayXuatBan'];
    $status = $_POST['TrangThai'];
    $author = $_POST['TacGiaID'];

    $query = "UPDATE tinbai 
              SET TieuDe = '$title', NoiDung = '$content', ChuyenMucID = '$category', NgayXuatBan = '$publishDate', TrangThai = '$status', TacGiaID = '$author'
              WHERE ID = $postID";
    mysqli_query($conn, $query);
}

// API trả về tin bài theo ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $postID = intval($_GET['id']);
    $query = "SELECT * FROM tinbai WHERE ID = $postID";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        $post['NgayXuatBan'] = date('Y-m-d\TH:i', strtotime($post['NgayXuatBan']));
        header('Content-Type: application/json');
        echo json_encode($post);
        exit();
    } else {
        http_response_code(404);
        echo json_encode(["message" => "Tin bài không tồn tại."]);
        exit();
    }
}

// Truy vấn danh sách chuyên mục
$sql_chuyenmuc = "SELECT id, tenchuyenmuc FROM ChuyenMuc";
$result_chuyenmuc = $conn->query($sql_chuyenmuc);

// Truy vấn danh sách tác giả
$sql_tacgia = "SELECT id, tentacgia FROM TacGia";
$result_tacgia = $conn->query($sql_tacgia);

$sql_trangthai = "SELECT ID, TenTrangThai FROM trangthai";
$result_trangthai = $conn->query($sql_trangthai);
// Lấy danh sách tin bài
$query = "SELECT tinbai.*, chuyenmuc.TenChuyenMuc, tacgia.TenTacGia, trangthai.TenTrangThai 
          FROM tinbai
          JOIN chuyenmuc ON tinbai.ChuyenMucID = chuyenmuc.ID
          JOIN tacgia ON tinbai.TacGiaID = tacgia.ID
          JOIN trangthai ON tinbai.TrangThai = trangthai.ID";

$result = mysqli_query($conn, $query);
// Xử lý xóa tin bài
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteID'])) {
    $postID = intval($_POST['deleteID']);
    $query = "DELETE FROM tinbai WHERE ID = $postID";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Tin bài đã được xóa thành công."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Xóa tin bài thất bại."]);
    }
    exit();
}
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
            <a href="baomatchiutaisaoluu.php">Quản trị người dùng</a>
        </div>
    </div>
</div>

    <div class="navbar">
        <h2>Quản lý Tin bài</h2>
    </div>

    <div class="container">
        <!-- Tim kiem -->

        <h2>Tìm kiếm Thông tin</h2>
        <input type="text" class="form-control" id="searchInput" placeholder="Nhập từ khóa tìm kiếm...">
        <button class="btn btn-primary mt-2" id="searchBtn">Tìm kiếm</button>
        <!-- Thêm Tin bài -->


        <!-- Bảng danh sách tin bài -->
        <h3> Danh sách tin bài </h3>      
        <!-- Thêm Tin bài -->  
        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createPostModal">Tạo Tin bài mới</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Tin bài</th>
                    <th>Chuyên mục</th>
                    <th>Ngày xuất bản</th>
                    <th>Trạng thái</th>
                    <th>Tác giả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['TieuDe'] . "</td>";
                    echo "<td>" . $row['TenChuyenMuc'] . "</td>";
                    echo "<td>" . $row['NgayXuatBan'] . "</td>";
                    echo "<td>" . $row['TenTrangThai'] . "</td>";
                    echo "<td>" . $row['TenTacGia'] . "</td>";
                    echo "<td><button class='btn btn-warning edit-post' data-bs-toggle='modal' data-bs-target='#editPostModal' data-id='" . $row['ID'] . "'>Sửa</button> <button class='btn btn-danger'>Xóa</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tạo Tin bài -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">Tạo Tin bài mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu Đề</label>
                            <input type="text" class="form-control" id="title" name="TieuDe" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Nội Dung</label>
                            <textarea class="form-control" id="content" name="NoiDung" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
        <label for="category" class="form-label">Chuyên Mục</label>
        <select class="form-select" id="category" name="ChuyenMucID" required>
            <?php
            // Điền danh sách chuyên mục vào select
            if ($result_chuyenmuc->num_rows > 0) {
                while($row = $result_chuyenmuc->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["tenchuyenmuc"] . "</option>";
                }
            }
            ?>
        </select>
    </div>

                        <div class="mb-3">
                            <label for="publishDate" class="form-label">Ngày Xuất Bản</label>
                            <input type="datetime-local" class="form-control" id="publishDate" name="NgayXuatBan" required>
                        </div>
                        <div class="mb-3">
        <label for="status" class="form-label">Trạng Thái</label>
        <select class="form-select" id="status" name="TrangThai" required>
            <?php
            // Điền danh sách trạng thái vào select
            if ($result_trangthai->num_rows > 0) {
                while($row = $result_trangthai->fetch_assoc()) {
                    echo "<option value='" . $row["ID"] . "'>" . $row["TenTrangThai"] . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Tác Giả</label>
        <select class="form-select" id="author" name="TacGiaID" required>
            <?php
            // Điền danh sách tác giả vào select
            if ($result_tacgia->num_rows > 0) {
                while($row = $result_tacgia->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["tentacgia"] . "</option>";
                }
            }
            ?>
        </select>
    </div>
                       
                        <button type="submit" class="btn btn-primary">Tạo Tin bài</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Tin bài -->
    <!-- Modal Sửa Tin bài -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">Sửa Tin bài</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <!-- ID của tin bài (ẩn) -->
                    <input type="hidden" id="editID" name="ID">

                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Tiêu Đề</label>
                        <input type="text" class="form-control" id="editTitle" name="TieuDe" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContent" class="form-label">Nội Dung</label>
                        <textarea class="form-control" id="editContent" name="NoiDung" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
    <label for="editCategory" class="form-label">Chuyên Mục</label>
    <select class="form-select" id="editCategory" name="ChuyenMucID" required>
        <?php
        // Chạy lại truy vấn danh sách chuyên mục
        $result_chuyenmuc = $conn->query($sql_chuyenmuc);
        if ($result_chuyenmuc->num_rows > 0) {
            while ($row = $result_chuyenmuc->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["tenchuyenmuc"] . "</option>";
            }
        }
        ?>
    </select>
</div>
                    <div class="mb-3">
                        <label for="editPublishDate" class="form-label">Ngày Xuất Bản</label>
                        <input type="datetime-local" class="form-control" id="editPublishDate" name="NgayXuatBan" required>
                    </div>
                    <div class="mb-3">
    <label for="editStatus" class="form-label">Trạng Thái</label>
    <select class="form-select" id="editStatus" name="TrangThai" required>
        <?php
        // Chạy lại truy vấn danh sách trạng thái
        $result_trangthai = $conn->query($sql_trangthai);
        if ($result_trangthai->num_rows > 0) {
            while ($row = $result_trangthai->fetch_assoc()) {
                echo "<option value='" . $row["ID"] . "'>" . $row["TenTrangThai"] . "</option>";
            }
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="editAuthor" class="form-label">Tác Giả</label>
    <select class="form-select" id="editAuthor" name="TacGiaID" required>
        <?php
        // Chạy lại truy vấn danh sách tác giả
        $result_tacgia = $conn->query($sql_tacgia);
        if ($result_tacgia->num_rows > 0) {
            while ($row = $result_tacgia->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["tentacgia"] . "</option>";
            }
        }
        ?>
    </select>
             <button type="submit" class="btn btn-primary">Cập nhật Tin bài</button>
                </form>
            </div>
        </div>
    </div>
   
</div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function () {
        const postID = this.getAttribute('data-id');

        if (confirm("Bạn có chắc chắn muốn xóa tin bài này không?")) {
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `deleteID=${postID}`
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'success') {
                    alert(result.message);
                    // Xóa hàng khỏi bảng
                    this.closest('tr').remove();
                } else {
                    alert(result.message);
                }
            })
            .catch(error => {
                alert('Có lỗi xảy ra: ' + error.message);
            });
        }
    });
});


       document.querySelectorAll('.edit-post').forEach(button => {
    button.addEventListener('click', function () {
        const postID = this.getAttribute('data-id');

        // Gửi yêu cầu đến API để lấy dữ liệu tin bài
        fetch(`?id=${postID}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không tìm thấy dữ liệu.');
                }
                return response.json();
            })
            .then(post => {
                // Điền thông tin vào modal
                document.getElementById('editID').value = post.ID;
                document.getElementById('editTitle').value = post.TieuDe;
                document.getElementById('editContent').value = post.NoiDung;

                // Gán giá trị đã lưu cho các trường select
                document.getElementById('editCategory').value = post.ChuyenMucID;
                document.getElementById('editPublishDate').value = post.NgayXuatBan;
                document.getElementById('editStatus').value = post.TrangThai;
                document.getElementById('editAuthor').value = post.TacGiaID;
            })
            .catch(error => {
                alert('Có lỗi xảy ra: ' + error.message);
            });
    });
});
const searchBtn = document.getElementById("searchBtn");
    const searchInput = document.getElementById("searchInput");

    searchBtn.addEventListener("click", () => {
        const searchTerm = searchInput.value.toLowerCase();
        document.querySelectorAll("tbody tr").forEach((row) => {
            const name = row.children[0].textContent.toLowerCase();
            const email = row.children[1].textContent.toLowerCase();
            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                row.style.display = ""; // Hiển thị hàng nếu khớp
            } else {
                row.style.display = "none"; // Ẩn hàng nếu không khớp
            }
        });
    });

    </script>
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