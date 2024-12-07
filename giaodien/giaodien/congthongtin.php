<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng Thông Tin Học Viện</title>
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
    font-weight: bold;
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
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    overflow: hidden;
    z-index: 1000;
}
.dropdown-menu a {
    color: #333;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    font-size: 14px;
    transition: background-color 0.3s;
}
.dropdown-menu a:hover {
    background-color: #f1f1f1;
}

/* Bố cục chính */
.content {
    display: flex;
    margin: 20px;
    flex-wrap: wrap; /* Hỗ trợ responsive */
}

/* Nội dung chính */
.main-content {
    flex: 1;
    margin-left: 5%;
    min-width: 300px; /* Đảm bảo tương thích trên các màn hình nhỏ */
}
.main-content h2 {
    color: #b91d1d;
    font-weight: bold;
}
.article {
    background-color: #ffffff;
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.article h3 a {
    color: #b91d1d;
    text-decoration: none;
    transition: color 0.3s;
}
.article h3 a:hover {
    color: #ffd966;
}

/* Preview nội dung */
.preview-content {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    transition: all 0.3s ease;
    margin-top: 10px;
}
.preview-content iframe {
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 5px;
}
.preview-content.expanded {
    height: 400px; /* Tăng chiều cao khi hover */
}

/* Phần người dùng online */
.online-users {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #b91d1d;
    color: #ffffff;
    padding: 10px 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    z-index: 10;
    font-size: 14px;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        align-items: flex-start;
    }
    .navbar {
        flex-direction: column;
        gap: 10px;
    }
    .main-content {
        margin-left: 0;
        width: 100%;
    }
}

    </style>
</head>
<body>

    <!-- Đầu trang -->
    <div class="header">
        <div style="display: flex; align-items: center;">
            <a href="tintuc.php">
                <img src="logo.png" alt="Logo Học Viện">
            </a>
            <h1>Cổng Thông Tin Học Viện</h1>
        </div>
        
        <!-- Thanh tìm kiếm và chọn ngôn ngữ -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <input type="text" placeholder="Tìm kiếm..." style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
            <select id="languageSelect" style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="vi">Tiếng Việt</option>
                <option value="en">English</option>
            </select>
        </div>

        <!-- Thông tin tài khoản -->
        <div class="account-info" id="accountInfo">
            <!-- JavaScript sẽ thay đổi nội dung ở đây -->
        </div>
    </div>

    <!-- Thanh menu điều hướng -->
    <div class="navbar">
        <a href="tintuc.php">TIN TỨC</a>
        <a href="congthongtin.php">CÁC CỔNG THÔNG TIN KHÁC CỦA HỌC VIỆN</a>
        <a href="lienhe.php">LIÊN HỆ</a>
        <a href="tienich.php">TIỆN ÍCH</a>
    </div>

    <!-- Bố cục chính -->
    <div class="content">
        
        <!-- Nội dung chính -->
        <div class="main-content">
            <div class="article">
                <h3><a href="https://eaut.edu.vn" target="_blank" onmouseover="showPreviewContent(1)">Trang Facebook học viện</a></h3>
                <p>Di chuột vào liên kết để xem thông tin trước khi truy cập trang.</p>
                <div class="preview-content" id="previewContent1">
                    <iframe src="https://eaut.edu.vn"></iframe>
                </div>
            </div>

            <div class="article">
                <h3><a href="https://eaut.edu.vn" target="_blank" onmouseover="showPreviewContent(2)">Trang Sinh Viên</a></h3>
                <p>Di chuột vào liên kết để xem thông tin trước khi truy cập trang.</p>
                <div class="preview-content" id="previewContent2">
                    <iframe src="https://eaut.edu.vn"></iframe>
                </div>
            </div>

            <div class="article">
                <h3><a href="https://eaut.edu.vn" target="_blank" onmouseover="showPreviewContent(3)">Trang Cộng đồng Sinh viên học viện</a></h3>
                <p>Di chuột vào liên kết để xem thông tin trước khi truy cập trang.</p>
                <div class="preview-content" id="previewContent3">
                    <iframe src="https://eaut.edu.vn"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Người dùng online -->
    <div class="online-users">
        <p>Người dùng online: 200+</p>
    </div>

    <script>
        // Thêm thông tin tài khoản người dùng
        const accountInfo = document.getElementById("accountInfo");

        // Giả sử chúng ta có thông tin người dùng trong session
        const user = { name: "Nguyễn Văn A", role: "Sinh viên" };

        if (user) {
            accountInfo.innerHTML = `${user.name} - ${user.role} <a href="#">Đăng xuất</a>`;
        }

        // Xử lý sự kiện hover
        function showPreviewContent(contentNum) {
            const preview = document.getElementById(`previewContent${contentNum}`);
            preview.classList.add('expanded');
        }

        // Phục hồi kích thước bình thường khi không hover
        document.querySelectorAll('.preview-content').forEach(preview => {
            preview.addEventListener('mouseleave', function() {
                preview.classList.remove('expanded');
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
    // Lấy dữ liệu nút bấm từ localStorage
    const buttons = JSON.parse(localStorage.getItem("buttons")) || [];

    // Tạo và hiển thị các nút bấm
    const mainContent = document.querySelector(".main-content");
    buttons.forEach(button => {
        const buttonElement = document.createElement("div");
        buttonElement.className = "section-button";
        buttonElement.innerHTML = `<a href="${button.link}" target="_blank">${button.label}</a>`;
        mainContent.appendChild(buttonElement);
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // Lấy dữ liệu menu từ localStorage
    const menus = JSON.parse(localStorage.getItem("menus")) || [];

    // Tạo và hiển thị các menu
    const menuBar = document.createElement("div");
    menuBar.className = "menu-bar";
    menus.forEach(menu => {
        const menuItem = document.createElement("a");
        menuItem.href = menu.link;
        menuItem.target = "_blank";
        menuItem.textContent = menu.name;
        menuBar.appendChild(menuItem);
    });

    const mainContent = document.querySelector(".main-content");
    mainContent.prepend(menuBar);
});
document.addEventListener("DOMContentLoaded", function() {
    // Lấy dữ liệu ribbon từ localStorage
    const ribbons = JSON.parse(localStorage.getItem("ribbons")) || [];

    // Tạo và hiển thị các ribbon
    ribbons.forEach(ribbon => {
        const ribbonElement = document.createElement("div");
        ribbonElement.className = "section-ribbon";
        ribbonElement.textContent = ribbon.content;
        ribbonElement.style.backgroundColor = ribbon.style.backgroundColor;
        ribbonElement.style.color = ribbon.style.color;

        const mainContent = document.querySelector(".main-content");
        mainContent.appendChild(ribbonElement);
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // Lấy dữ liệu hình ảnh từ localStorage
    const images = JSON.parse(localStorage.getItem("images")) || [];

    // Tạo và hiển thị các hình ảnh
    const mainContent = document.querySelector(".main-content");
    images.forEach(imageUrl => {
        const imageElement = document.createElement("img");
        imageElement.src = imageUrl;
        imageElement.alt = "Hình ảnh";
        imageElement.className = "section-image";  // Bạn có thể thêm CSS để tùy chỉnh kiểu dáng

        mainContent.appendChild(imageElement);
    });
});

    </script>
        <script>
        const isLoggedIn = true;
        const username = "NguyenVanA";
        const isAdmin = false;

        const accountInfoDiv = document.getElementById('accountInfo');

        if (isLoggedIn) {
            accountInfoDiv.innerHTML = `
                <span>Chào ${username}</span>
                ${isAdmin ? '<span>(Admin)</span>' : ''}
                <div class="dropdown-menu">
                    <a href="quantringuoidung.php">Quản trị người dùng</a>
                    <a href="quantribocuc.php">Quản trị bố cục</a>
                    <a href="quantritinbai.php">Quản trị tin bài</a>
                    <a href="quantricongcon.php">Quản trị cổng con</a>
                    <a href="quantringuoidung.php">Quản trị người dùng</a>
                    <a href="quanlylienhe.php">Quản lý liên hệ</a>
                    <a href="quanlylichsudangnhap.php">Quản lý lịc sử đăng nhập</a>
                </div>
            `;
            accountInfoDiv.onclick = function () {
                const menu = accountInfoDiv.querySelector('.dropdown-menu');
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            };
        } else {
            accountInfoDiv.innerHTML = `<a href="#">Đăng nhập</a>`;
        }

        document.getElementById('onlineCount').textContent = '5';
    </script>
</body>
</html>
