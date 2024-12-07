<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tích hợp với hệ thống khác</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="#">Tích hợp Hệ thống</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Quản trị tích hợp hệ thống -->
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Tích hợp với Hệ thống khác</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createIntegrationModal">Thêm Hệ thống</button>
        </div>

        <!-- Danh sách hệ thống tích hợp -->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Hệ Thống</th>
                                <th>Loại Hệ Thống</th>
                                <th>Trạng thái Kết nối</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hệ thống Quản lý Học sinh</td>
                                <td>API</td>
                                <td><span class="badge bg-success">Đã kết nối</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editIntegrationModal">Sửa</button>
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Hệ thống Thư viện</td>
                                <td>API</td>
                                <td><span class="badge bg-danger">Ngắt kết nối</span></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editIntegrationModal">Sửa</button>
                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Hệ thống Tích hợp -->
    <div class="modal fade" id="createIntegrationModal" tabindex="-1" aria-labelledby="createIntegrationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createIntegrationModalLabel">Thêm Hệ thống Tích hợp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="systemName" class="form-label">Tên Hệ Thống</label>
                            <input type="text" class="form-control" id="systemName" placeholder="Nhập tên hệ thống">
                        </div>
                        <div class="mb-3">
                            <label for="systemType" class="form-label">Loại Hệ Thống</label>
                            <select class="form-select" id="systemType">
                                <option value="API">API</option>
                                <option value="Web Service">Web Service</option>
                                <option value="Database">Database</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="systemURL" class="form-label">URL Hệ Thống</label>
                            <input type="url" class="form-control" id="systemURL" placeholder="Nhập URL hệ thống">
                        </div>
                        <div class="mb-3">
                            <label for="apiKey" class="form-label">Khóa API</label>
                            <input type="text" class="form-control" id="apiKey" placeholder="Nhập khóa API (nếu có)">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Thêm Hệ Thống</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa Hệ thống -->
    <div class="modal fade" id="editIntegrationModal" tabindex="-1" aria-labelledby="editIntegrationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIntegrationModalLabel">Sửa Hệ thống Tích hợp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editSystemName" class="form-label">Tên Hệ Thống</label>
                            <input type="text" class="form-control" id="editSystemName" value="Hệ thống Quản lý Học sinh">
                        </div>
                        <div class="mb-3">
                            <label for="editSystemType" class="form-label">Loại Hệ Thống</label>
                            <select class="form-select" id="editSystemType">
                                <option value="API" selected>API</option>
                                <option value="Web Service">Web Service</option>
                                <option value="Database">Database</option>
                            </select>
                        </div>
                       
