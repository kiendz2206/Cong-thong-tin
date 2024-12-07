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
    </style>
</head>
<body>

    <!-- Đầu trang -->
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
        <a>QUẢN TRỊ CỔNG CON HỌC VIỆN</a>
    </div>

    <!-- Quản trị Cổng con -->
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản trị Cổng Con</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSubPortalModal">Tạo Cổng Con</button>
        </div>

        <!-- Danh sách cổng con -->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Cổng Con</th>
                                <th>Chuyên mục</th>
                                <th>Ngày Tạo</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Học viện Công nghệ</td>
                                <td>Học viện</td>
                                <td>01/12/2024</td>
                                <td><span class="badge bg-success">Đang hoạt động</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editSubPortalModal">Sửa</button>
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Học viện Kinh tế</td>
                                <td>Học viện</td>
                                <td>10/12/2024</td>
                                <td><span class="badge bg-danger">Ngừng hoạt động</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editSubPortalModal">Sửa</button>
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tạo Cổng Con -->
    <div class="modal fade" id="createSubPortalModal" tabindex="-1" aria-labelledby="createSubPortalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSubPortalModalLabel">Tạo Cổng Con mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="subPortalName" class="form-label">Tên Cổng Con</label>
                            <input type="text" class="form-control" id="subPortalName" placeholder="Nhập tên cổng con">
                        </div>
                        <div class="mb-3">
                            <label for="subPortalDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="subPortalDescription" rows="3" placeholder="Nhập mô tả cổng con"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="subPortalCategory" class="form-label">Chuyên mục</label>
                            <select class="form-select" id="subPortalCategory">
                                <option value="công nghệ">Công nghệ</option>
                                <option value="kinh tế">Kinh tế</option>
                                <option value="sự kiện">Sự kiện</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Tạo Cổng Con</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Cổng Con -->
    <div class="modal fade" id="editSubPortalModal" tabindex="-1" aria-labelledby="editSubPortalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubPortalModalLabel">Sửa Cổng Con</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editSubPortalName" class="form-label">Tên Cổng Con</label>
                            <input type="text" class="form-control" id="editSubPortalName" value="Học viện Công nghệ">
                        </div>
                        <div class="mb-3">
                            <label for="editSubPortalDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editSubPortalDescription" rows="3">Cổng con của Học viện Công nghệ</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editSubPortalCategory" class="form-label">Chuyên mục</label>
                            <select class="form-select" id="editSubPortalCategory">
                                <option value="công nghệ" selected>Công nghệ</option>
                                <option value="kinh tế">Kinh tế</option>
                                <option value="sự kiện">Sự kiện</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Cập nhật Cổng Con</button>
                </div>
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


</body>
</html>
