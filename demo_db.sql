-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 02:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_khachhang` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `cart_status` int(11) NOT NULL,
  `cart_date` varchar(50) NOT NULL,
  `cart_payment` varchar(11) NOT NULL,
  `cart_shipping` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_khachhang`, `code_cart`, `cart_status`, `cart_date`, `cart_payment`, `cart_shipping`) VALUES
(107, 36, '9190', 1, '2023-08-05 21:02:03', 'tienmat', 8),
(108, 38, '1434', 1, '2023-11-21 13:34:26', 'chuyenkhoan', 9),
(109, 38, '8089', 1, '2023-11-21 13:35:01', 'tienmat', 9),
(110, 44, '9523', 1, '2023-11-21 17:26:58', 'tienmat', 0),
(111, 47, '3524', 2, '2023-11-22 16:31:23', 'tienmat', 10),
(112, 47, '2711', 1, '2023-11-28 16:54:51', 'tienmat', 10),
(113, 47, '9376', 1, '2023-12-08 16:47:48', 'chuyenkhoan', 10),
(114, 47, '3917', 1, '2023-12-08 16:47:55', 'tienmat', 10),
(115, 47, '2274', 1, '2023-12-08 17:07:49', 'tienmat', 10),
(116, 47, '2124', 1, '2023-12-13 16:03:33', 'tienmat', 10),
(117, 47, '9957', 1, '2023-12-13 16:05:06', 'tienmat', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id_cart_details` int(11) NOT NULL,
  `code_cart` int(10) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id_cart_details`, `code_cart`, `id_sanpham`, `soluong`, `size`) VALUES
(45, 9190, 51, 1, 'Size M'),
(46, 1434, 49, 1, 'Size M'),
(47, 9523, 52, 1, 'Size L'),
(48, 3524, 49, 1, 'Size L'),
(49, 2711, 49, 2, 'Size M'),
(50, 9376, 57, 1, 'Size L'),
(51, 2274, 52, 1, 'Size M'),
(52, 2124, 49, 1, 'Size M'),
(53, 9957, 49, 1, 'Size M');

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL,
  `tendanhmuc` text NOT NULL,
  `thutu` int(11) NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `last_updated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `tendanhmuc`, `thutu`, `created_time`, `last_updated`) VALUES
(57, 'ÁO', 1, '2023-08-05 19:02:47', '2023-11-23 07:29:35'),
(58, 'QUẦN', 2, '2023-08-05 19:03:02', '2023-11-23 07:29:43'),
(61, 'NÓN', 3, '2023-11-22 18:51:57', '2023-11-23 07:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_library`
--

CREATE TABLE `image_library` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `last_updated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `image_library`
--

INSERT INTO `image_library` (`id`, `product_id`, `path`, `created_time`, `last_updated`) VALUES
(54, 52, '/uploads/05-08-2023/q2(1).jpg', '2023-08-05 20:30:15', '2023-08-05 20:30:15'),
(53, 51, '/uploads/05-08-2023/q1(1).jpg', '2023-08-05 20:30:02', '2023-08-05 20:30:02'),
(52, 50, '/uploads/05-08-2023/ao2(1).png', '2023-08-05 20:29:44', '2023-08-05 20:29:44'),
(51, 49, '/uploads/05-08-2023/a1(1).jpg', '2023-08-05 19:05:53', '2023-08-05 19:05:53'),
(55, 53, '/uploads/22-11-2023/Untitled-1(1).jpg', '2023-11-22 17:51:24', '2023-11-22 17:51:24'),
(56, 54, '/uploads/22-11-2023/ao1(1).jpg', '2023-11-22 18:58:11', '2023-11-22 18:58:11'),
(57, 55, '/uploads/22-11-2023/ao2(1).jpg', '2023-11-22 18:58:27', '2023-11-22 18:58:27'),
(58, 56, '/uploads/22-11-2023/ao3(1).jpg', '2023-11-22 18:58:41', '2023-11-22 18:58:41'),
(59, 57, '/uploads/22-11-2023/ao5(1).jpg', '2023-11-22 18:59:10', '2023-11-22 18:59:10'),
(60, 58, '/uploads/26-11-2023/db8ede068e03a989c27e8ed8fe3e53f0.jpg', '2023-11-26 20:05:44', '2023-11-26 20:05:44'),
(61, 59, '/uploads/08-12-2023/anh2.jpg', '2023-12-08 19:33:01', '2023-12-08 19:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id` int(11) NOT NULL,
  `tenkhachhang` varchar(255) NOT NULL,
  `email` varchar(20) NOT NULL,
  `dienthoai` text NOT NULL,
  `matkhau` varchar(25) NOT NULL,
  `diachi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id`, `tenkhachhang`, `email`, `dienthoai`, `matkhau`, `diachi`) VALUES
(36, 'Võ Đăng Kỷ', 'vodangky9999@gmail.c', '0123456789', '1234', ' TP HCM'),
(40, 'tocomenswear', 'tocomenswear@gmail.c', '0123456789', '1234', ' 15f Đường Số 18, Phường 8, Gò Vấp, Thành phố Hồ Chí Minh 700000, Việt Nam'),
(41, 'tocomenswear', 'abc@gmail.com', '0123456789', '1234', ' 15f Đường Số 18, Phường 8, Gò Vấp, Thành phố Hồ Chí Minh 700000, Việt Nam'),
(42, 'tocomenswear', 'tocomenswear@gmail.c', '0123456789', '1234', ' 15f Đường Số 18, Phường 8, Gò Vấp, Thành phố Hồ Chí Minh 700000, Việt Nam'),
(43, 'tocomenswear', 'tocomenswear@gmail.c', '0123456789', '1234', ' Hcm'),
(44, 'tocomenswear', 'tocomenswear@gmail.c', '0123456789', '1234', ' 15f Đường Số 18, Phường 8, Gò Vấp, Thành phố Hồ Chí Minh 700000, Việt Nam'),
(45, 'vdk', 'vdk', '0123456789', '1234', ' abc'),
(46, 'tocomenswear', 'tocomenswear@gmail.c', '0123456789', '1234', ' 15f Đường Số 18, Phường 8, Gò Vấp, Thành phố Hồ Chí Minh 700000, Việt Nam'),
(47, 'tocomenswear', 'tocomenswear', '0123456789', '1234', ' 15f Đường Số 18, Phường 8, Gò Vấp, Thành phố Hồ Chí Minh 700000, Việt Nam'),
(48, 'tocomenswear', 'tocomenswear', '0123456789', '1234', ' abc'),
(49, 'tocomenswear', 'tocomenswear@gmail.c', '0123456789', '1234', ' abc');

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `noidunglienhe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`id`, `noidunglienhe`) VALUES
(1, '<p><span style=\"font-size:24px\">Trang web b&aacute;n quần &aacute;o online Tocomanswear của ch&uacute;ng t&ocirc;i mang lại sự tiện lợi với giao diện th&acirc;n thiện v&agrave; đa dạng sản phẩm chất lượng.</span></p>\r\n\r\n<p><span style=\"font-size:14px\"><span style=\"font-size:24px\">&nbsp; &nbsp;Ch&uacute;ng t&ocirc;i kh&ocirc;ng chỉ cung cấp sản phẩm m&agrave; c&ograve;n t&ocirc;n vinh sự độc đ&aacute;o v&agrave; phong c&aacute;ch. Trải nghiệm mua sắm được thiết kế đơn giản, an to&agrave;n. Cam kết bảo vệ th&ocirc;ng tin c&aacute; nh&acirc;n v&agrave; đội ngũ hỗ trợ kh&aacute;ch h&agrave;ng sẵn s&agrave;ng gi&uacute;p đỡ. Sự h&agrave;i l&ograve;ng của bạn l&agrave; ưu ti&ecirc;n h&agrave;ng đầu của ch&uacute;ng t&ocirc;i!</span><br />\r\n<img alt=\"\" src=\"http://localhost:8080/index2.php?quanly=lienhe\" /></span></p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_danhmuc` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` float NOT NULL,
  `content` text NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `last_updated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `id_danhmuc`, `name`, `image`, `price`, `content`, `created_time`, `last_updated`) VALUES
(52, '2', 'Quần Short', '/uploads/05-08-2023/q2.jpg', 20000, '<p>QUẦN</p>\r\n', '2023-11-11 20:30:15', '2023-11-22 17:52:56'),
(49, '1', 'ÁO Nam Trắng 2', '/uploads/05-08-2023/a1.jpg', 10000, '<p>&Aacute;O ĐẸP</p>\r\n', '2023-11-11 20:30:15', '2023-11-22 18:50:57'),
(50, '1', 'ÁO Nam Trắng', '/uploads/05-08-2023/ao2.png', 20000, '<p>&Aacute;O</p>\r\n', '2023-11-11 20:30:15', '2023-11-22 17:57:02'),
(51, '2', 'Quần Short 2', '/uploads/05-08-2023/q1.jpg', 10000, '<p>QUẦN</p>\r\n', '2023-11-11 20:30:02', '2023-11-22 17:53:55'),
(53, '3', 'Nón Dickies', '/uploads/22-11-2023/db8ede068e03a989c27e8ed8fe3e53f0(1).jpg', 199000, '', '2023-11-22 17:51:24', '2023-11-22 18:52:12'),
(54, '1', 'Áo Tocomenswear 1', '/uploads/22-11-2023/ao1.jpg', 199000, '', '2023-11-22 18:58:11', '2023-11-22 18:58:11'),
(55, '1', 'Áo Tocomenswear 2', '/uploads/22-11-2023/ao2.jpg', 199000, '', '2023-11-22 18:58:27', '2023-11-22 18:58:27'),
(56, '1', 'Áo Tocomenswear 3', '/uploads/22-11-2023/ao3.jpg', 199000, '', '2023-11-22 18:58:41', '2023-11-22 18:58:41'),
(57, '1', 'Áo Tocomenswear 5', '/uploads/22-11-2023/ao5.jpg', 199000, '', '2023-11-22 18:59:10', '2023-11-22 18:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id_shipping` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `id_dangky` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id_shipping`, `name`, `phone`, `address`, `note`, `id_dangky`) VALUES
(8, 'TocoMenswear', '0123456789', 'Thành phố Hồ Chí Minh', '', 36),
(9, 'ABC', '123345', 'HCM', 'DSADS', 38),
(10, 'abc', '123', 'abce,hcm', '', 47);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`) VALUES
(1, 'admin', 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id_cart_details`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_library`
--
ALTER TABLE `image_library`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id_shipping`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id_cart_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_library`
--
ALTER TABLE `image_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id_shipping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
