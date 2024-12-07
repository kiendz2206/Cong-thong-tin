<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị Cổng Con</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Cổng Thông Tin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cổng Con</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Quản lý Tin bài</a>
                </li>
            </ul>
        </div>
    </nav>

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

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
