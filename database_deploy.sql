-- =====================================================
-- Database SQL File for Deployment
-- Shop Thời Trang Toco - E-commerce Website
-- Version: 2.0
-- Created for Production Deployment
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Database: `demo_db`
-- Tạo database nếu chưa tồn tại
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `demo_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `demo_db`;

-- --------------------------------------------------------
-- Table structure for table `user`
-- Bảng quản trị viên
-- --------------------------------------------------------

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `danhmuc`
-- Bảng danh mục sản phẩm
-- --------------------------------------------------------

DROP TABLE IF EXISTS `danhmuc`;
CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tendanhmuc` text NOT NULL,
  `thutu` int(11) NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `last_updated` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thutu` (`thutu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `product`
-- Bảng sản phẩm
-- --------------------------------------------------------

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_danhmuc` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `discount_percent` int(11) DEFAULT 0,
  `content` text NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `last_updated` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_danhmuc` (`id_danhmuc`(255)),
  FULLTEXT KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `image_library`
-- Bảng thư viện ảnh sản phẩm
-- --------------------------------------------------------

DROP TABLE IF EXISTS `image_library`;
CREATE TABLE `image_library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `last_updated` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `khachhang`
-- Bảng khách hàng
-- --------------------------------------------------------

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE `khachhang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenkhachhang` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dienthoai` varchar(20) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `diachi` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cart`
-- Bảng giỏ hàng / đơn hàng
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `id_khachhang` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 0 COMMENT '0: Chờ xử lý, 1: Đã xác nhận, 2: Đang giao, 3: Đã giao, 4: Đã hủy',
  `cart_date` varchar(50) NOT NULL,
  `cart_payment` varchar(50) NOT NULL COMMENT 'tienmat: Tiền mặt, chuyenkhoan: Chuyển khoản',
  `cart_shipping` int(11) NOT NULL,
  PRIMARY KEY (`id_cart`),
  KEY `id_khachhang` (`id_khachhang`),
  KEY `code_cart` (`code_cart`),
  KEY `cart_status` (`cart_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `cart_details`
-- Bảng chi tiết giỏ hàng
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cart_details`;
CREATE TABLE `cart_details` (
  `id_cart_details` int(11) NOT NULL AUTO_INCREMENT,
  `code_cart` varchar(10) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `size` text NOT NULL,
  PRIMARY KEY (`id_cart_details`),
  KEY `code_cart` (`code_cart`),
  KEY `id_sanpham` (`id_sanpham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `shipping`
-- Bảng thông tin giao hàng
-- --------------------------------------------------------

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE `shipping` (
  `id_shipping` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `id_dangky` int(11) NOT NULL,
  PRIMARY KEY (`id_shipping`),
  KEY `id_dangky` (`id_dangky`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `lienhe`
-- Bảng thông tin liên hệ
-- --------------------------------------------------------

DROP TABLE IF EXISTS `lienhe`;
CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noidunglienhe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `images`
-- Bảng hình ảnh (cho slideshow)
-- --------------------------------------------------------

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Dumping data for tables
-- Dữ liệu mẫu cơ bản
-- --------------------------------------------------------

-- Dữ liệu admin mặc định
-- Username: admin, Password: 123
-- LƯU Ý: Nên đổi mật khẩu sau khi deploy!
INSERT INTO `user` (`id`, `username`, `fullname`, `password`) VALUES
(1, 'admin', 'Administrator', '123');

-- Dữ liệu danh mục mẫu
INSERT INTO `danhmuc` (`id`, `tendanhmuc`, `thutu`, `created_time`, `last_updated`) VALUES
(1, 'ÁO', 1, NOW(), NOW()),
(2, 'QUẦN', 2, NOW(), NOW()),
(3, 'NÓN', 3, NOW(), NOW());

-- Dữ liệu liên hệ mẫu
INSERT INTO `lienhe` (`id`, `noidunglienhe`) VALUES
(1, '<p><span style="font-size:24px">Trang web bán quần áo online Tocomanswear của chúng tôi mang lại sự tiện lợi với giao diện thân thiện và đa dạng sản phẩm chất lượng.</span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-size:24px">&nbsp; &nbsp;Chúng tôi không chỉ cung cấp sản phẩm mà còn tôn vinh sự độc đáo và phong cách. Trải nghiệm mua sắm được thiết kế đơn giản, an toàn. Cam kết bảo vệ thông tin cá nhân và đội ngũ hỗ trợ khách hàng sẵn sàng giúp đỡ. Sự hài lòng của bạn là ưu tiên hàng đầu của chúng tôi!</span></span></p>\r\n');

-- Reset AUTO_INCREMENT
ALTER TABLE `user` AUTO_INCREMENT = 2;
ALTER TABLE `danhmuc` AUTO_INCREMENT = 4;
ALTER TABLE `lienhe` AUTO_INCREMENT = 2;
ALTER TABLE `product` AUTO_INCREMENT = 1;
ALTER TABLE `image_library` AUTO_INCREMENT = 1;
ALTER TABLE `khachhang` AUTO_INCREMENT = 1;
ALTER TABLE `cart` AUTO_INCREMENT = 1;
ALTER TABLE `cart_details` AUTO_INCREMENT = 1;
ALTER TABLE `shipping` AUTO_INCREMENT = 1;
ALTER TABLE `images` AUTO_INCREMENT = 1;

-- --------------------------------------------------------
-- Foreign Keys (Optional - Uncomment if needed)
-- Lưu ý: Chỉ bỏ comment nếu muốn sử dụng foreign key constraints
-- Nếu database đã có dữ liệu, có thể gặp lỗi khi thêm foreign keys
-- --------------------------------------------------------

-- ALTER TABLE `cart` ADD CONSTRAINT `fk_cart_khachhang` FOREIGN KEY (`id_khachhang`) REFERENCES `khachhang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- ALTER TABLE `cart_details` ADD CONSTRAINT `fk_cart_details_cart` FOREIGN KEY (`code_cart`) REFERENCES `cart` (`code_cart`) ON DELETE CASCADE ON UPDATE CASCADE;
-- ALTER TABLE `cart_details` ADD CONSTRAINT `fk_cart_details_product` FOREIGN KEY (`id_sanpham`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- ALTER TABLE `shipping` ADD CONSTRAINT `fk_shipping_khachhang` FOREIGN KEY (`id_dangky`) REFERENCES `khachhang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
-- ALTER TABLE `image_library` ADD CONSTRAINT `fk_image_library_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- =====================================================
-- HƯỚNG DẪN SỬ DỤNG:
-- =====================================================
-- 1. Import file này vào phpMyAdmin hoặc MySQL client
-- 2. Đổi tên database nếu cần (mặc định: demo_db)
-- 3. Cập nhật thông tin kết nối trong file connect_db.php:
--    - connect_db.php
--    - admin/connect_db.php
-- 4. Đổi mật khẩu admin sau khi deploy (hiện tại: admin/123)
-- 5. Upload thư mục uploads/ lên host nếu có
-- 6. Kiểm tra quyền ghi file cho thư mục uploads/
-- =====================================================
-- 
-- CẤU TRÚC DATABASE:
-- =====================================================
-- - user: Quản trị viên
-- - danhmuc: Danh mục sản phẩm
-- - product: Sản phẩm (có cột discount_percent cho giảm giá)
-- - image_library: Thư viện ảnh sản phẩm
-- - khachhang: Thông tin khách hàng
-- - cart: Đơn hàng
-- - cart_details: Chi tiết đơn hàng
-- - shipping: Thông tin giao hàng
-- - lienhe: Nội dung trang liên hệ
-- - images: Hình ảnh slideshow
-- =====================================================
-- 
-- LƯU Ý QUAN TRỌNG:
-- =====================================================
-- - Tất cả bảng sử dụng ENGINE=InnoDB (hỗ trợ transactions)
-- - Charset: utf8mb4_unicode_ci (hỗ trợ đầy đủ tiếng Việt và emoji)
-- - Price sử dụng decimal(15,2) để đảm bảo độ chính xác
-- - Email có UNIQUE constraint để tránh trùng lặp
-- - Foreign keys được comment để tránh lỗi khi import
-- =====================================================
