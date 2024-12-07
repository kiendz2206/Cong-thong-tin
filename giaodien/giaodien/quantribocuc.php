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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị Bố cục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: #ffd966;
            padding: 10px 20px;
            text-align: center;
        }

        h2 {
            color: #b91d1d;
            font-weight: bold;
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

        .content {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .main-content {
            width: 100%;
            max-width: 1200px;
        }

        .menu-bar {
            background-color: #b91d1d;
            padding: 10px;
            margin-bottom: 15px;
        }

        .menu-bar a {
            margin-right: 15px;
            color: white;
            text-decoration: none;
        }

        .section-ribbon {
            background-color: #b91d1d;
            color: #ffffff;
            padding: 10px;
            margin: 10px 0;
        }

        .section-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }

        .section-button a:hover {
            background-color: #218838;
        }

        .section-image {
            width: 100%;
            height: auto;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            width: 25%;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 20px;
        }

        .preview-area {
            width: 75%;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        h2 {
            color: #ffffff; /* Màu chữ trắng */
            margin: 0;
            padding: 10px;
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


    <div class="navbar">
        <h2>Quản lý bố cục</h2>
    </div>


    <div class="container">
        <div class="content">
            <div class="sidebar">
                <h5>Công cụ</h5>
                <button class="btn btn-primary" onclick="addMenu()">Thêm Menu</button>
                <button class="btn btn-secondary" onclick="addRibbon()">Thêm Ribbon</button>
                <button class="btn btn-success" onclick="addButton()">Thêm Nút bấm</button>
                <button class="btn btn-warning" onclick="saveLayout()">Lưu Bố cục</button>
            </div>

            <div class="preview-area">
                <h5>Xem trước Bố cục</h5>
                <div id="previewArea">
                    <!-- Nội dung xem trước -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Biến lưu trữ dữ liệu bố cục
        let layoutData = {
            header: { menu: [] },
            body: { sections: [] }
        };

        // Thêm menu
        function addMenu() {
            const menuName = prompt("Nhập tên menu:");
            const menuLink = prompt("Nhập liên kết menu:");
            if (menuName && menuLink) {
                // Lưu dữ liệu menu vào localStorage
                let menus = JSON.parse(localStorage.getItem("menus")) || [];
                menus.push({ name: menuName, link: menuLink });
                localStorage.setItem("menus", JSON.stringify(menus));

                layoutData.header.menu.push({ name: menuName, link: menuLink });
                updatePreview();
            }
        }

        // Thêm ribbon
        function addRibbon() {
            const ribbonContent = prompt("Nhập nội dung ribbon:");
            if (ribbonContent) {
                // Lưu dữ liệu ribbon vào localStorage
                let ribbons = JSON.parse(localStorage.getItem("ribbons")) || [];
                ribbons.push({ content: ribbonContent, style: { backgroundColor: "#b91d1d", color: "#ffffff" } });
                localStorage.setItem("ribbons", JSON.stringify(ribbons));

                layoutData.body.sections.push({
                    type: "ribbon",
                    content: ribbonContent,
                    style: { backgroundColor: "#b91d1d", color: "#ffffff" }
                });
                updatePreview();
            }
        }

        // Thêm nút bấm
        function addButton() {
            const buttonLabel = prompt("Nhập nội dung nút bấm:");
            const buttonLink = prompt("Nhập liên kết nút bấm:");
            if (buttonLabel && buttonLink) {
                // Lưu dữ liệu nút bấm vào localStorage
                let buttons = JSON.parse(localStorage.getItem("buttons")) || [];
                buttons.push({ label: buttonLabel, link: buttonLink });
                localStorage.setItem("buttons", JSON.stringify(buttons));

                layoutData.body.sections.push({
                    type: "button",
                    label: buttonLabel,
                    link: buttonLink,
                    style: { backgroundColor: "#28a745", color: "#ffffff" }
                });
                updatePreview();
            }
        }

        // Cập nhật giao diện xem trước
        function updatePreview() {
            const previewArea = document.getElementById("previewArea");
            previewArea.innerHTML = "";

            // Xem trước menu
            if (layoutData.header.menu.length > 0) {
                const menuBar = document.createElement("div");
                menuBar.className = "menu-bar";
                menuBar.innerHTML = layoutData.header.menu
                    .map(menu => `<a href="${menu.link}" target="_blank">${menu.name}</a>`)
                    .join("");
                previewArea.appendChild(menuBar);
            }

            // Xem trước body
            layoutData.body.sections.forEach(section => {
                if (section.type === "ribbon") {
                    const ribbon = document.createElement("div");
                    ribbon.className = "section-ribbon";
                    ribbon.textContent = section.content;
                    previewArea.appendChild(ribbon);
                } else if (section.type === "button") {
                    const button = document.createElement("div");
                    button.className = "section-button";
                    button.innerHTML = `<a href="${section.link}" target="_blank">${section.label}</a>`;
                    previewArea.appendChild(button);
                }
            });
        }

        // Lưu bố cục (Giả lập)
        function saveLayout() {
            console.log("Dữ liệu bố cục:", layoutData);
            alert("Bố cục đã được lưu thành công!");
        }
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