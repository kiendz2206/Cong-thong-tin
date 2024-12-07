-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 06:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlyhocvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `chuyenmuc`
--

CREATE TABLE `chuyenmuc` (
  `ID` int(11) NOT NULL,
  `TenChuyenMuc` varchar(100) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chuyenmuc`
--

INSERT INTO `chuyenmuc` (`ID`, `TenChuyenMuc`, `MoTa`) VALUES
(1, 'Tin tức', 'Các tin tức mới nhất trong hệ thống'),
(2, 'Chính trị', 'Thông tin về các sự kiện chính trị'),
(3, 'Giải trí', 'Các bài viết về giải trí, nghệ thuật'),
(4, 'Tin tức', 'Các tin tức mới nhất trong hệ thống'),
(5, 'Chính trị', 'Thông tin về các sự kiện chính trị'),
(6, 'Giải trí', 'Các bài viết về giải trí, nghệ thuật');

-- --------------------------------------------------------

--
-- Table structure for table `lichsudangnhap`
--

CREATE TABLE `lichsudangnhap` (
  `ID` int(11) NOT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `ThoiGianDangNhap` datetime DEFAULT current_timestamp(),
  `DiaChiIP` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lichsudangnhap`
--

INSERT INTO `lichsudangnhap` (`ID`, `NguoiDungID`, `ThoiGianDangNhap`, `DiaChiIP`) VALUES
(1, 1, '2024-11-28 15:58:39', '192.168.1.1'),
(2, 2, '2024-11-28 15:58:39', '192.168.1.2'),
(3, 3, '2024-11-28 15:58:39', '192.168.1.3'),
(4, 33, '2024-12-02 03:56:01', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `ID` int(11) NOT NULL,
  `TenNguoiDung` varchar(100) DEFAULT NULL,
  `MatKhau` varchar(255) DEFAULT NULL,
  `VaiTroID` varchar(11) DEFAULT NULL,
  `NgayTao` datetime DEFAULT current_timestamp(),
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`ID`, `TenNguoiDung`, `MatKhau`, `VaiTroID`, `NgayTao`, `Email`) VALUES
(1, 'Nguyễn Văn A', '$2y$10$5zxuQIHfqKuXZVAxJtGGEO7.bIteUJ0Rjwyr8GBlAxg7Ug987l552', 'Quản trị vi', '2024-11-28 15:57:18', 'minhaevchhtb@gmail.com'),
(2, 'Trần Thị B', 'matkhau2', '2', '2024-11-28 15:57:18', NULL),
(3, 'Lê Quang C', 'matkhau3', '3', '2024-11-28 15:57:18', NULL),
(7, 'Nguyễn Văn A', 'matkhau1', '1', '2024-11-28 15:58:39', NULL),
(8, 'Trần Thị B', 'matkhau2', '2', '2024-11-28 15:58:39', NULL),
(9, 'Lê Quang C', 'matkhau3', '3', '2024-11-28 15:58:39', NULL),
(10, 'minh', '$2y$10$DozkB9Zc3FKKyuN1iNC94eKdGRI/vtorym7xC6W3ss8zNLbyuIvDi', '1', '2024-11-28 16:11:38', NULL),
(18, 'nguyen van nam', '$2y$10$rFaWeeFIF6YcGAsRM6EOJOm0dKd48Sv34KEusB4UqmWpBzcBNUxNC', '3', '2024-11-28 16:39:48', NULL),
(19, 'ahihi', '$2y$10$ftqcOW1bVgV7UFRk8WlfLufdToLwCx4y0dc2nyfUrgLRYnpTosazG', '9', '2024-11-28 16:49:46', NULL),
(20, 'ok', '$2y$10$rhc6h11WT0Z2d2qbr05XceGeU6YSrWw48r.pBw98zGus2VpyR4GwW', 'Quản trị vi', '2024-11-28 16:51:28', NULL),
(22, 'ahihi', '$2y$10$yjpKK9yGlCxiVWSx1aZaau1SjUYbNaO38rfmJe9V4lq3H3G5Xht/e', '9', '2024-11-28 16:59:05', 'ahihi@gmail.com'),
(23, 'yz', '$2y$10$7BpOXXpFTLDBNPmldn9/a.Zm0dQutuczdr2cKqxiXqyDJYth87Api', 'Biên tập vi', '2024-11-28 16:59:33', 'yz@gmail.com'),
(24, 'yz', '$2y$10$i0HcypeoJR.27Ea8LVZw.uqxXoOHKnzhruxYwS0BTqyx9lxjML6yK', 'Biên tập vi', '2024-11-28 16:59:44', 'yz@gmail.com'),
(25, 'Nguyễn Văn A', '$2y$10$AFWaA.UwfzYLHQZTLBn.8uYPWt4e79fllpOl12M3SsmR.jGwi4pdq', 'Quản trị vi', '2024-11-28 17:40:30', 'minhaevchhtb@gmail.com'),
(26, 'jkds', '$2y$10$z9PFWv8OTyDv8qGGcmfOB.R9p0zwbPTkfnL2al/lmzqrhfzgMdWri', 'Người dùng', '2024-11-28 17:41:07', 'ok@gmail.com'),
(27, 'jkds', '$2y$10$mjnpn2ab6DMDElMYIrA7/.NjK5K6VaIm1463T0Vo2PttDoPO3908a', 'Người dùng', '2024-11-28 17:41:15', 'ok@gmail.com'),
(28, 'nguyen van nam1', '$2y$10$ddhxAUXgGNI0onVp6i/s8eK.E8x64vxmlXraAn2Af7qCH8Tf99NZC', '1', '2024-11-28 17:58:40', 'minhaevchhtb@gmail.com'),
(29, 'chusyminh', '$2y$10$bb3vyQAhkL.kUVvwMuDuiu7qV1G0ffrufjGr8OfrA1m0jQdPBnvW.', '8', '2024-11-28 18:06:51', 'minhda@gmail.com'),
(30, 'nguyen van nam01', '$2y$10$AYVPIrnrRGwywin2ywS8Yeww8Dmn3vFk4HHSrgYMExvAcFK5Ou3Vm', '9', '2024-11-29 15:49:42', 'ahihi2@gmail.com'),
(31, 'chu sỹ minh', '$2y$10$TPGsgGw3IUBHj4rirblJDe6QBcO7ZsMd72PE5xLvTg7M7rCGVP5Tq', '3', '2024-12-01 20:09:07', 'm@gmail.com'),
(32, 'Chu Sỹ Minh', '$2y$10$TSKli3QjRahVJtC/v6ap.O4kROB2DDVoMStDRdmW6lBgoAksKrMYO', '1', '2024-12-02 09:38:41', 'minhaevchhtb123@gmail.com'),
(33, 'Admin', '$2y$10$EC77upOoYh.CZNSWSRVo/uyJ6e2nwnH3TUYcwzrWblewD4.tSplGy', '1', '2024-12-02 09:43:20', 'Admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `phanhoi`
--

CREATE TABLE `phanhoi` (
  `ID` int(11) NOT NULL,
  `ThamDoYKienID` int(11) DEFAULT NULL,
  `NguoiDungID` int(11) DEFAULT NULL,
  `CauTraLoi` varchar(255) DEFAULT NULL,
  `ThoiGianTraLoi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `ID` int(11) NOT NULL,
  `TenTacGia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`ID`, `TenTacGia`) VALUES
(1, 'Nguyễn Văn D'),
(2, 'Trần Thị E'),
(3, 'Lê Quang F'),
(4, 'Nguyễn Văn D'),
(5, 'Trần Thị E'),
(6, 'Lê Quang F');

-- --------------------------------------------------------

--
-- Table structure for table `thamdoykien`
--

CREATE TABLE `thamdoykien` (
  `ID` int(11) NOT NULL,
  `CauHoi` varchar(255) DEFAULT NULL,
  `ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sdt` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thamdoykien`
--

INSERT INTO `thamdoykien` (`ID`, `CauHoi`, `ten`, `email`, `sdt`) VALUES
(11, 'Bạn thấy sản phẩm của chúng tôi như thế nào?', 'Nguyen Van A', 'vana@example.com', 912345678),
(12, 'Dịch vụ hỗ trợ khách hàng có đáp ứng mong đợi của bạn không?', 'Tran Thi B', 'thib@example.com', 912345679),
(13, 'Bạn có hài lòng với giá cả của sản phẩm không?', 'Le Van C', 'vanc@example.com', 912345680),
(14, 'Thời gian giao hàng có nhanh chóng không?', 'Pham Thi D', 'thid@example.com', 912345681),
(15, 'Bạn có muốn chúng tôi cải thiện điều gì không?', 'Hoang Van E', 'vane@example.com', 912345682),
(17, 'Bạn đánh giá trải nghiệm mua sắm của chúng tôi như thế nào?', 'Do Van G', 'vang@example.com', 912345684),
(18, 'Bạn có cảm thấy sản phẩm đạt chất lượng như mong muốn không?', 'Ngo Thi H', 'thih@example.com', 912345685),
(19, 'Bạn có hài lòng với đội ngũ nhân viên của chúng tôi không?', 'Dang Van I', 'vani@example.com', 912345686),
(20, 'Chúng tôi cần làm gì để bạn cảm thấy tốt hơn?', 'Bui Thi K', 'thik@example.com', 912345687),
(21, 'hom nay that dep', 'chu sy minh', 'minhaevchhtb@gmail.com', 981733957);

-- --------------------------------------------------------

--
-- Table structure for table `tinbai`
--

CREATE TABLE `tinbai` (
  `ID` int(11) NOT NULL,
  `TieuDe` varchar(255) DEFAULT NULL,
  `NoiDung` text DEFAULT NULL,
  `ChuyenMucID` int(11) DEFAULT NULL,
  `TuKhoaID` int(11) DEFAULT NULL,
  `NgayXuatBan` datetime DEFAULT NULL,
  `TrangThai` varchar(50) DEFAULT NULL,
  `TacGiaID` int(11) DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `TrangThaiID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tinbai`
--

INSERT INTO `tinbai` (`ID`, `TieuDe`, `NoiDung`, `ChuyenMucID`, `TuKhoaID`, `NgayXuatBan`, `TrangThai`, `TacGiaID`, `HinhAnh`, `TrangThaiID`) VALUES
(56, 'Miền Bắc sắp đón không khí lạnh nhất từ đầu mùa', 'Ba ngày đầu tuần tới miền Bắc trời hửng nắng, sau đó đón đợt không khí lạnh với cường độ mạnh khiến nhiệt độ đồng bằng thấp nhất 12 độ, vùng núi 7 độ C.\r\n\r\nHai ngày qua, miền Bắc trời ít mây, hửng nắng về trưa do không khí lạnh suy yếu. Trung tâm Dự báo Khí tượng Thủy văn quốc gia cho biết từ nay đến 3/12, Bắc Bộ duy trì tình trạng lạnh về đêm và sáng khi nhiệt độ vùng núi phổ biến 13-16 độ C, đồng bằng 15-18 độ, ban ngày nhiệt độ cao nhất lên mức 24-26 độ. Độ ẩm không khí giảm xuống dưới 50% khiến trời hanh khô.', 3, NULL, '2024-12-01 19:54:00', '3', 1, NULL, NULL),
(65, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, '', NULL),
(66, 'Miền Bắc sắp đón không khí lạnh nhất từ đầu mùa', 'ffffffffffffff', 3, NULL, '2024-12-02 10:24:00', '1', 1, 'image/485-anh-gai-xinh-cute-kham-pha-va-nguon-tai-nguyen-chat-luongimg_66e72fab2afac.jpg', NULL),
(67, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, '', NULL),
(68, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, '', NULL),
(69, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, '', NULL),
(70, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, '', NULL),
(71, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, '', NULL),
(72, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, '', NULL),
(73, 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 'Tổng Bí thư: Tinh gọn bộ máy không thể chậm trễ', 1, NULL, '2024-11-29 17:07:00', '1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trangthai`
--

CREATE TABLE `trangthai` (
  `ID` int(11) NOT NULL,
  `TenTrangThai` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trangthai`
--

INSERT INTO `trangthai` (`ID`, `TenTrangThai`) VALUES
(1, 'Đã xuất bản'),
(2, 'Chờ phê duyệt'),
(3, 'Hủy xuất bản');

-- --------------------------------------------------------

--
-- Table structure for table `tukhoa`
--

CREATE TABLE `tukhoa` (
  `ID` int(11) NOT NULL,
  `TenTuKhoa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tukhoa`
--

INSERT INTO `tukhoa` (`ID`, `TenTuKhoa`) VALUES
(1, 'Chính trị'),
(2, 'Giải trí'),
(3, 'Kinh tế'),
(4, 'Chính trị'),
(5, 'Giải trí'),
(6, 'Kinh tế');

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `ID` int(11) NOT NULL,
  `TenVaiTro` varchar(50) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaitro`
--

INSERT INTO `vaitro` (`ID`, `TenVaiTro`, `MoTa`) VALUES
(1, 'Quản trị viên', 'Quản lý toàn bộ hệ thống'),
(3, 'Người dùng', 'Người dùng bình thường có thể xem và phản hồi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lichsudangnhap`
--
ALTER TABLE `lichsudangnhap`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ThamDoYKienID` (`ThamDoYKienID`),
  ADD KEY `NguoiDungID` (`NguoiDungID`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `thamdoykien`
--
ALTER TABLE `thamdoykien`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tinbai`
--
ALTER TABLE `tinbai`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ChuyenMucID` (`ChuyenMucID`),
  ADD KEY `TuKhoaID` (`TuKhoaID`),
  ADD KEY `TacGiaID` (`TacGiaID`),
  ADD KEY `fk_trangthai` (`TrangThaiID`);

--
-- Indexes for table `trangthai`
--
ALTER TABLE `trangthai`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tukhoa`
--
ALTER TABLE `tukhoa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lichsudangnhap`
--
ALTER TABLE `lichsudangnhap`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `thamdoykien`
--
ALTER TABLE `thamdoykien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tinbai`
--
ALTER TABLE `tinbai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `trangthai`
--
ALTER TABLE `trangthai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tukhoa`
--
ALTER TABLE `tukhoa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lichsudangnhap`
--
ALTER TABLE `lichsudangnhap`
  ADD CONSTRAINT `lichsudangnhap_ibfk_1` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`ID`);

--
-- Constraints for table `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD CONSTRAINT `phanhoi_ibfk_1` FOREIGN KEY (`ThamDoYKienID`) REFERENCES `thamdoykien` (`ID`),
  ADD CONSTRAINT `phanhoi_ibfk_2` FOREIGN KEY (`NguoiDungID`) REFERENCES `nguoidung` (`ID`);

--
-- Constraints for table `tinbai`
--
ALTER TABLE `tinbai`
  ADD CONSTRAINT `fk_trangthai` FOREIGN KEY (`TrangThaiID`) REFERENCES `trangthai` (`ID`),
  ADD CONSTRAINT `tinbai_ibfk_1` FOREIGN KEY (`ChuyenMucID`) REFERENCES `chuyenmuc` (`ID`),
  ADD CONSTRAINT `tinbai_ibfk_2` FOREIGN KEY (`TuKhoaID`) REFERENCES `tukhoa` (`ID`),
  ADD CONSTRAINT `tinbai_ibfk_3` FOREIGN KEY (`TacGiaID`) REFERENCES `tacgia` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
