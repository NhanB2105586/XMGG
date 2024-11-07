-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 05, 2024 lúc 01:04 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--
use project;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Sofa'),
(2, 'Ghế ăn'),
(3, 'Ghế làm việc'),
(4, 'Kệ phòng khách'),
(5, 'Kệ sách'),
(6, 'Giường ngủ'),
(7, 'Nệm'),
(8, 'Bàn nước'),
(9, 'Bàn ăn'),
(10, 'Bàn làm việc'),
(11, 'Tủ tivi'),
(12, 'Tủ bếp'),
(13, 'Tủ ly'),
(14, 'Tủ áo'),
(15, 'Gối'),
(16, 'Mền'),
(17, 'Bình trang trí'),
(18, 'Đèn trang trí'),
(19, 'Tranh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dữ liệu cho bảng `orders`sẽ được thêm khi người dùng đặt hàng thành công!

-- Cấu trúc bảng cho bảng `order_details`

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dữ liệu cho bảng `order_details`sẽ được thêm khi người dùng đặt hàng thành công!



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `in_stock` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--
INSERT INTO `products` (`product_id`, `product_name`, `category_id`, `old_price`, `price`, `in_stock`, `description`) VALUES
-- sofa
	(1,'Sofa 1 chỗ Orientale',1, 8000000.00, 7400000.00, 10, 'Ghế sofa 1 chỗ ngồi với thiết kế hiện đại, bọc vải da cao cấp.'),
	(2,'Sofa 2 chỗ làm từ mây mới',1, 21000000.00, 18000000.00, 0, 'Ghế sofa 2 chỗ ngồi với thiết kế sang trọng làm từ mây cao cấp.'),
	(3,'Sofa 2 chỗ Ogami',1, 13000000.00, 11000000.00,0, 'Ghế sofa 2 chỗ ngồi Ogami với thiết kế đơn giản làm từ vải cao cấp.'),
	(4,'Sofa 3 chỗ xanh ngọc',1, 29000000.00, 24000000.00, 12, 'Ghế sofa 3 chỗ ngồi với thiết kế sang trọng làm từ vải xanh MB408'),
    (5,'Sofa 1 chỗ v1',1, 8000000.00, 7400000.00, 6, 'Ghế sofa 1 chỗ ngồi với thiết kế hiện đại, bọc vải da cao cấp.'),
	(6,'Sofa 2 chỗ v2',1, 21000000.00, 18000000.00, 7, 'Ghế sofa 2 chỗ ngồi với thiết kế sang trọng làm từ mây cao cấp.'),
	(7,'Sofa 2 chỗ v3',1, 13000000.00, 11000000.00,0, 'Ghế sofa 2 chỗ ngồi Ogami với thiết kế đơn giản làm từ vải cao cấp.'),
	(8,'Sofa 3 chỗ v4',1, 29000000.00, 24000000.00, 2, 'Ghế sofa 3 chỗ ngồi với thiết kế sang trọng làm từ vải xanh MB408'),

-- ghế ăn
(9,'Ghế ăn có tay vải vact10491',2, 6000000.00, 5400000.00, 10, 'Ghế ăn có tay Ogami vải vact10491 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),
(10,'Ghế ăn có tay vải vact10492',2, 6100000.00, 5500000.00, 10, 'Ghế ăn có tay Ogami vải vact10492 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),
(11,'Ghế ăn có tay vải vact10493',2, 6200000.00, 5600000.00, 10, 'Ghế ăn có tay Ogami vải vact10493 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),
(12,'Ghế ăn có tay vải vact10494',2, 6300000.00, 5700000.00, 10, 'Ghế ăn có tay Ogami vải vact10494 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),
(13,'Ghế ăn có tay vải vact10495',2, 6400000.00, 5800000.00, 13, 'Ghế ăn có tay Ogami vải vact10495 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),
(14,'Ghế ăn có tay vải vact10496',2, 6500000.00, 5800000.00, 12, 'Ghế ăn có tay Ogami vải vact10496 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),
(15,'Ghế ăn có tay vải vact10497',2, 6600000.00, 5800000.00, 11, 'Ghế ăn có tay Ogami vải vact10497 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),
(16,'Ghế ăn có tay vải vact10498',2, 6700000.00, 5900000.00, 0, 'Ghế ăn có tay Ogami vải vact10498 mang đến sự kết hợp hoàn hảo giữa thiết kế hiện đại và sự thoải mái.'),

-- ghế làm việc
(25, 'Ghế làm việc 80728K', 3, 14500000.00, 12900000.00, 20, 'Ghế làm việc 80728K có thiết kế hiện đại với đệm ngồi êm ái.'),
(26, 'Ghế làm việc 80729K', 3, 15500000.00, 13900000.00, 10, 'Ghế làm việc 80729K được làm từ chất liệu bền bỉ, dễ dàng vệ sinh.'),
(27, 'Ghế làm việc 80730K', 3, 16000000.00, 14200000.00, 12, 'Ghế làm việc 80730K mang lại sự thoải mái với thiết kế công thái học.'),
(28, 'Ghế làm việc 80731K', 3, 15000000.00, 13400000.00, 8, 'Ghế làm việc 80731K có kiểu dáng thể thao, thích hợp cho mọi không gian làm việc.'),
(29, 'Ghế làm việc 80732K', 3, 14000000.00, 12500000.00, 15, 'Ghế làm việc 80732K với chất liệu vải thoáng khí và khung chắc chắn.'),
(30, 'Ghế làm việc 80733K', 3, 13800000.00, 12200000.00, 18, 'Ghế làm việc 80733K giúp nâng cao hiệu suất làm việc với thiết kế tiện dụng.'),
(31, 'Ghế làm việc 80734K', 3, 14800000.00, 13200000.00, 5, 'Ghế làm việc 80734K có đệm ngồi dày dạn và tay vịn thoải mái.'),

-- kệ phòng khách 
(32, 'Kệ phòng khách KE01', 4, 14800000.00, 13200000.00, 5, 'Kệ phòng khách thiết kế chất liệu chắc chắn.'),
(33, 'Kệ phòng khách KE02', 4, 15800000.00, 14500000.00, 4, 'Kệ phòng khách KE02 với thiết kế tối giản, phù hợp với mọi không gian.'),
(34, 'Kệ phòng khách KE03', 4, 16500000.00, 15000000.00, 3, 'Kệ phòng khách KE03 được làm từ gỗ tự nhiên, bền đẹp theo thời gian.'),
(35, 'Kệ phòng khách KE04', 4, 17000000.00, 15600000.00, 6, 'Kệ phòng khách KE04 có nhiều ngăn chứa, thuận tiện cho việc sắp xếp đồ đạc.'),
(36, 'Kệ phòng khách KE05', 4, 16000000.00, 14000000.00, 8, 'Kệ phòng khách KE05 thiết kế hiện đại, dễ dàng kết hợp với nội thất khác.'),
(37, 'Kệ phòng khách KE06', 4, 17500000.00, 16200000.00, 2, 'Kệ phòng khách KE06 mang lại vẻ sang trọng cho không gian phòng khách.'),
(38, 'Kệ phòng khách KE07', 4, 18000000.00, 16500000.00, 7, 'Kệ phòng khách KE07 thiết kế độc đáo với kệ mở và kệ kín.'),
(39, 'Kệ phòng khách KE08', 4, 15500000.00, 14000000.00, 5, 'Kệ phòng khách KE08 có màu sắc trung tính, dễ dàng phối hợp với các màu sắc khác.'),

-- kệ sách
(40, 'Kệ sách KSV01', 5, 25500000.00, 24000000.00, 6, 'Kệ sách KSV01 có màu sắc trung tính, dễ dàng phối hợp với các màu sắc khác.'),
(41, 'Kệ sách KSV02', 5, 26000000.00, 24500000.00, 5, 'Kệ sách KSV02 thiết kế hiện đại, tối ưu không gian lưu trữ.'),
(42, 'Kệ sách KSV03', 5, 26500000.00, 25000000.00, 4, 'Kệ sách KSV03 với chất liệu gỗ tự nhiên, bền đẹp theo thời gian.'),
(43, 'Kệ sách KSV04', 5, 27000000.00, 25500000.00, 3, 'Kệ sách KSV04 có nhiều ngăn chứa, thuận tiện cho việc sắp xếp sách và đồ dùng.'),
(44, 'Kệ sách KSV05', 5, 27500000.00, 26000000.00, 8, 'Kệ sách KSV05 thiết kế thông minh, dễ dàng di chuyển và lắp đặt.'),
(45, 'Kệ sách KSV06', 5, 28000000.00, 26500000.00, 2, 'Kệ sách KSV06 mang lại vẻ sang trọng và phong cách cho không gian học tập.'),
(46, 'Kệ sách KSV07', 5, 28500000.00, 27000000.00, 7, 'Kệ sách KSV07 có thể kết hợp với các loại nội thất khác, tạo nên không gian hài hòa.'),
(47, 'Kệ sách KSV08', 5, 29000000.00, 27500000.00, 6, 'Kệ sách KSV08 thiết kế mở, giúp dễ dàng truy cập và trưng bày sách.'),

-- Giường ngủ
(48, 'Giường ngủ GNV01', 6, 32000000.00, 31500000.00, 6, 'Giường ngủ GNV01 với thiết kế thoải mái đem lại giấc ngủ ngon.'),
(49, 'Giường ngủ GNV02', 6, 32500000.00, 32000000.00, 5, 'Giường ngủ GNV02 được làm từ chất liệu gỗ tự nhiên cao cấp.'),
(50, 'Giường ngủ GNV03', 6, 33000000.00, 32500000.00, 4, 'Giường ngủ GNV03 thiết kế hiện đại, phù hợp với nhiều phong cách nội thất.'),
(51, 'Giường ngủ GNV04', 6, 33500000.00, 33000000.00, 3, 'Giường ngủ GNV04 có màu sắc trang nhã, dễ dàng phối hợp với các đồ nội thất khác.'),
(52, 'Giường ngủ GNV05', 6, 34000000.00, 33500000.00, 8, 'Giường ngủ GNV05 với thiết kế đơn giản, mang lại sự thoải mái cho người sử dụng.'),
(53, 'Giường ngủ GNV06', 6, 34500000.00, 34000000.00, 2, 'Giường ngủ GNV06 có cấu trúc chắc chắn, đảm bảo an toàn và bền bỉ.'),
(54, 'Giường ngủ GNV07', 6, 35000000.00, 34500000.00, 7, 'Giường ngủ GNV07 mang lại không gian thư giãn tuyệt vời cho gia đình bạn.'),
(55, 'Giường ngủ GNV08', 6, 35500000.00, 35000000.00, 6, 'Giường ngủ GNV08 với thiết kế tiện lợi, dễ dàng lắp ráp và di chuyển.'),

-- Nệm
(56, 'Nệm NEV01', 7, 12000000.00, 11500000.00, 10, 'Nệm NEV01 với công nghệ làm mát, mang lại giấc ngủ ngon cho bạn.'),
(57, 'Nệm NEV02', 7, 12500000.00, 12000000.00, 9, 'Nệm NEV02 hỗ trợ tối ưu cho cột sống, giúp bạn có giấc ngủ sâu hơn.'),
(58, 'Nệm NEV03', 7, 13000000.00, 12500000.00, 8, 'Nệm NEV03 với chất liệu cao cấp, bền bỉ theo thời gian.'),
(59, 'Nệm NEV04', 7, 13500000.00, 13000000.00, 7, 'Nệm NEV04 có khả năng kháng khuẩn, an toàn cho sức khỏe.'),
(60, 'Nệm NEV05', 7, 14000000.00, 13500000.00, 6, 'Nệm NEV05 với thiết kế thông minh, dễ dàng vệ sinh.'),
(61, 'Nệm NEV06', 7, 14500000.00, 14000000.00, 5, 'Nệm NEV06 mang lại cảm giác êm ái và thoải mái khi nằm.'),
(62, 'Nệm NEV07', 7, 15000000.00, 14500000.00, 4, 'Nệm NEV07 phù hợp cho mọi lứa tuổi, đặc biệt là trẻ em.'),
(63, 'Nệm NEV08', 7, 15500000.00, 15000000.00, 3, 'Nệm NEV08 với công nghệ giảm áp lực, tốt cho người có vấn đề về lưng.'),


-- Bàn nước
(64, 'Bàn nước BNV01', 8, 8000000.00, 7500000.00, 5, 'Bàn nước BNV01 với thiết kế tinh tế, phù hợp cho mọi không gian.'),
(65, 'Bàn nước BNV02', 8, 8500000.00, 8000000.00, 6, 'Bàn nước BNV02 được làm từ gỗ tự nhiên, bền đẹp theo thời gian.'),
(66, 'Bàn nước BNV03', 8, 9000000.00, 8500000.00, 4, 'Bàn nước BNV03 có ngăn chứa tiện lợi, giúp bạn sắp xếp đồ dùng dễ dàng.'),
(67, 'Bàn nước BNV04', 8, 9500000.00, 9000000.00, 3, 'Bàn nước BNV04 với kiểu dáng hiện đại, dễ dàng phối hợp với nội thất khác.'),
(68, 'Bàn nước BNV05', 8, 10000000.00, 9500000.00, 2, 'Bàn nước BNV05 mang lại sự sang trọng cho không gian sống của bạn.'),
(69, 'Bàn nước BNV06', 8, 10500000.00, 10000000.00, 1, 'Bàn nước BNV06 với thiết kế đơn giản, nhưng tinh tế.'),
(70, 'Bàn nước BNV07', 8, 11000000.00, 10500000.00, 5, 'Bàn nước BNV07 được làm từ chất liệu cao cấp, chịu lực tốt.'),
(71, 'Bàn nước BNV08', 8, 11500000.00, 11000000.00, 4, 'Bàn nước BNV08 có thể dễ dàng di chuyển và lắp đặt.'),


-- Bàn ăn
(72, 'Bàn ăn BAV01', 9, 20000000.00, 19000000.00, 5, 'Bàn ăn BAV01 với kiểu dáng hiện đại, phù hợp cho gia đình.'),
(73, 'Bàn ăn BAV02', 9, 20500000.00, 19500000.00, 4, 'Bàn ăn BAV02 được làm từ gỗ tự nhiên, sang trọng và bền bỉ.'),
(74, 'Bàn ăn BAV03', 9, 21000000.00, 20000000.00, 3, 'Bàn ăn BAV03 có thiết kế đơn giản nhưng tinh tế, dễ dàng phối hợp với ghế.'),
(75, 'Bàn ăn BAV04', 9, 21500000.00, 20500000.00, 2, 'Bàn ăn BAV04 mang lại không gian ấm cúng cho bữa cơm gia đình.'),
(76, 'Bàn ăn BAV05', 9, 22000000.00, 21000000.00, 6, 'Bàn ăn BAV05 với chất liệu cao cấp, dễ dàng vệ sinh.'),
(77, 'Bàn ăn BAV06', 9, 22500000.00, 21500000.00, 1, 'Bàn ăn BAV06 thiết kế hiện đại, phù hợp cho mọi không gian.'),
(78, 'Bàn ăn BAV07', 9, 23000000.00, 22000000.00, 4, 'Bàn ăn BAV07 với phong cách tối giản, dễ dàng kết hợp với nội thất khác.'),
(79, 'Bàn ăn BAV08', 9, 23500000.00, 22500000.00, 3, 'Bàn ăn BAV08 phù hợp cho những bữa tiệc gia đình và bạn bè.'),


-- Bàn làm việc
(80, 'Bàn làm việc BLVV01', 10, 30000000.00, 29000000.00, 5, 'Bàn làm việc BLVV01 với thiết kế hiện đại, phù hợp cho không gian làm việc chuyên nghiệp.'),
(81, 'Bàn làm việc BLVV02', 10, 30500000.00, 29500000.00, 4, 'Bàn làm việc BLVV02 được làm từ gỗ tự nhiên, bền bỉ và chắc chắn.'),
(82, 'Bàn làm việc BLVV03', 10, 31000000.00, 30000000.00, 6, 'Bàn làm việc BLVV03 có thiết kế đơn giản, giúp tối ưu không gian làm việc.'),
(83, 'Bàn làm việc BLVV04', 10, 31500000.00, 30500000.00, 3, 'Bàn làm việc BLVV04 với nhiều ngăn lưu trữ tiện lợi cho văn phòng.'),
(84, 'Bàn làm việc BLVV05', 10, 32000000.00, 31000000.00, 2, 'Bàn làm việc BLVV05 mang lại cảm giác thoải mái khi làm việc lâu dài.'),
(85, 'Bàn làm việc BLVV06', 10, 32500000.00, 31500000.00, 1, 'Bàn làm việc BLVV06 với thiết kế đẹp mắt, dễ dàng phối hợp với ghế.'),
(86, 'Bàn làm việc BLVV07', 10, 33000000.00, 32000000.00, 4, 'Bàn làm việc BLVV07 phù hợp cho không gian văn phòng hiện đại.'),
(87, 'Bàn làm việc BLVV08', 10, 33500000.00, 32500000.00, 3, 'Bàn làm việc BLVV08 có màu sắc trang nhã, dễ dàng kết hợp với nội thất khác.'),


-- Tủ tivi
(88, 'Tủ tivi TUTVV01', 11, 25000000.00, 24000000.00, 5, 'Tủ tivi TUTVV01 với thiết kế sang trọng, phù hợp cho phòng khách.'),
(89, 'Tủ tivi TUTVV02', 11, 25500000.00, 24500000.00, 4, 'Tủ tivi TUTVV02 được làm từ chất liệu gỗ tự nhiên, bền đẹp theo thời gian.'),
(90, 'Tủ tivi TUTVV03', 11, 26000000.00, 25000000.00, 6, 'Tủ tivi TUTVV03 thiết kế hiện đại, dễ dàng phối hợp với các nội thất khác.'),
(91, 'Tủ tivi TUTVV04', 11, 26500000.00, 25500000.00, 3, 'Tủ tivi TUTVV04 có ngăn lưu trữ tiện lợi cho thiết bị giải trí.'),
(92, 'Tủ tivi TUTVV05', 11, 27000000.00, 26000000.00, 2, 'Tủ tivi TUTVV05 với thiết kế gọn gàng, giúp tiết kiệm không gian.'),
(93, 'Tủ tivi TUTVV06', 11, 27500000.00, 26500000.00, 1, 'Tủ tivi TUTVV06 mang lại không gian sống tiện nghi và hiện đại.'),
(94, 'Tủ tivi TUTVV07', 11, 28000000.00, 27000000.00, 4, 'Tủ tivi TUTVV07 có màu sắc trang nhã, dễ dàng kết hợp với nội thất khác.'),
(95, 'Tủ tivi TUTVV08', 11, 28500000.00, 27500000.00, 3, 'Tủ tivi TUTVV08 thiết kế đẹp mắt, tạo điểm nhấn cho phòng khách.'),

-- Tủ bếp
(96, 'Tủ bếp TBEV01', 12, 35000000.00, 34000000.00, 5, 'Tủ bếp TBEV01 được thiết kế thông minh, tiết kiệm không gian.'),
(97, 'Tủ bếp TBEV02', 12, 35500000.00, 34500000.00, 4, 'Tủ bếp TBEV02 với chất liệu gỗ tự nhiên, sang trọng và bền bỉ.'),
(98, 'Tủ bếp TBEV03', 12, 36000000.00, 35000000.00, 6, 'Tủ bếp TBEV03 thiết kế hiện đại, dễ dàng lắp ráp và di chuyển.'),
(99, 'Tủ bếp TBEV04', 12, 36500000.00, 35500000.00, 3, 'Tủ bếp TBEV04 có ngăn lưu trữ tiện lợi cho dụng cụ nấu ăn.'),
(100, 'Tủ bếp TBEV05', 12, 37000000.00, 36000000.00, 2, 'Tủ bếp TBEV05 với thiết kế sang trọng, phù hợp cho mọi gia đình.'),
(101, 'Tủ bếp TBEV06', 12, 37500000.00, 36500000.00, 1, 'Tủ bếp TBEV06 mang lại không gian bếp tiện nghi và hiện đại.'),
(102, 'Tủ bếp TBEV07', 12, 38000000.00, 37000000.00, 4, 'Tủ bếp TBEV07 có màu sắc trang nhã, dễ dàng phối hợp với nội thất khác.'),
(103, 'Tủ bếp TBEV08', 12, 38500000.00, 37500000.00, 3, 'Tủ bếp TBEV08 thiết kế đẹp mắt, tạo điểm nhấn cho không gian bếp.'),
-- Tủ ly
(104, 'Tủ ly TLYV01', 13, 22000000.00, 21000000.00, 5, 'Tủ ly TLYV01 với thiết kế tinh tế, phù hợp cho phòng khách sang trọng.'),
(105, 'Tủ ly TLYV02', 13, 22500000.00, 21500000.00, 4, 'Tủ ly TLYV02 được làm từ chất liệu cao cấp, bền đẹp theo thời gian.'),
(106, 'Tủ ly TLYV03', 13, 23000000.00, 22000000.00, 6, 'Tủ ly TLYV03 thiết kế hiện đại, dễ dàng phối hợp với các nội thất khác.'),
(107, 'Tủ ly TLYV04', 13, 23500000.00, 22500000.00, 3, 'Tủ ly TLYV04 có ngăn lưu trữ tiện lợi cho đồ dùng gia đình.'),
(108, 'Tủ ly TLYV05', 13, 24000000.00, 23000000.00, 2, 'Tủ ly TLYV05 với thiết kế gọn gàng, giúp tiết kiệm không gian.'),
(109, 'Tủ ly TLYV06', 13, 24500000.00, 23500000.00, 1, 'Tủ ly TLYV06 mang lại không gian sống tiện nghi và hiện đại.'),
(110, 'Tủ ly TLYV07', 13, 25000000.00, 24000000.00, 4, 'Tủ ly TLYV07 có màu sắc trang nhã, dễ dàng kết hợp với nội thất khác.'),
(111, 'Tủ ly TLYV08', 13, 25500000.00, 24500000.00, 3, 'Tủ ly TLYV08 thiết kế đẹp mắt, tạo điểm nhấn cho phòng khách.'),

-- Tủ áo
(112, 'Tủ áo TAOV01', 14, 28000000.00, 27000000.00, 5, 'Tủ áo TAOV01 thiết kế đơn giản nhưng rất tiện lợi cho việc lưu trữ.'),
(113, 'Tủ áo TAOV02', 14, 28500000.00, 27500000.00, 4, 'Tủ áo TAOV02 được làm từ chất liệu cao cấp, bền bỉ theo thời gian.'),
(114, 'Tủ áo TAOV03', 14, 29000000.00, 28000000.00, 6, 'Tủ áo TAOV03 thiết kế hiện đại, phù hợp cho không gian phòng ngủ.'),
(115, 'Tủ áo TAOV04', 14, 29500000.00, 28500000.00, 3, 'Tủ áo TAOV04 có màu sắc trang nhã, dễ dàng kết hợp với các đồ nội thất khác.'),
(116, 'Tủ áo TAOV05', 14, 30000000.00, 29000000.00, 2, 'Tủ áo TAOV05 mang lại không gian lưu trữ rộng rãi cho quần áo và phụ kiện.'),
(117, 'Tủ áo TAOV06', 14, 30500000.00, 29500000.00, 1, 'Tủ áo TAOV06 thiết kế thông minh với nhiều ngăn lưu trữ tiện lợi.'),
(118, 'Tủ áo TAOV07', 14, 31000000.00, 30000000.00, 4, 'Tủ áo TAOV07 phù hợp cho gia đình có nhiều thành viên.'),
(119, 'Tủ áo TAOV08', 14, 31500000.00, 30500000.00, 3, 'Tủ áo TAOV08 với thiết kế sang trọng, nâng cao giá trị cho không gian sống.'),


-- Gối
(120, 'Gối GOIV01', 15, 500000.00, 450000.00, 20, 'Gối GOIV01 với thiết kế êm ái, mang lại giấc ngủ ngon cho bạn.'),
(121, 'Gối GOIV02', 15, 600000.00, 550000.00, 15, 'Gối GOIV02 được làm từ chất liệu mềm mại, phù hợp cho mọi người sử dụng.'),
(122, 'Gối GOIV03', 15, 550000.00, 500000.00, 10, 'Gối GOIV03 thiết kế trẻ trung, năng động, thích hợp cho các bạn trẻ.'),
(123, 'Gối GOIV04', 15, 650000.00, 600000.00, 8, 'Gối GOIV04 có khả năng nâng đỡ tốt, giảm thiểu tình trạng đau cổ khi ngủ.'),
(124, 'Gối GOIV05', 15, 700000.00, 650000.00, 5, 'Gối GOIV05 với thiết kế độc đáo, mang lại phong cách riêng cho không gian.'),
(125, 'Gối GOIV06', 15, 800000.00, 750000.00, 7, 'Gối GOIV06 giúp hỗ trợ tốt cho cổ và đầu khi nằm.'),
(126, 'Gối GOIV07', 15, 900000.00, 850000.00, 6, 'Gối GOIV07 được sản xuất từ chất liệu tự nhiên, an toàn cho sức khỏe.'),
(127, 'Gối GOIV08', 15, 950000.00, 900000.00, 4, 'Gối GOIV08 có màu sắc và họa tiết đa dạng, dễ dàng phối hợp với nội thất.'),


-- Mền
(128, 'Mền MEMV01', 16, 1500000.00, 1400000.00, 20, 'Mền MEMV01 được làm từ chất liệu mềm mại, ấm áp cho mùa đông.'),
(129, 'Mền MEMV02', 16, 1600000.00, 1500000.00, 15, 'Mền MEMV02 thiết kế dễ thương, thích hợp cho phòng ngủ trẻ em.'),
(130, 'Mền MEMV03', 16, 1700000.00, 1600000.00, 10, 'Mền MEMV03 với chất liệu cao cấp, mang lại cảm giác dễ chịu khi sử dụng.'),
(131, 'Mền MEMV04', 16, 1800000.00, 1700000.00, 8, 'Mền MEMV04 có thiết kế đơn giản nhưng tinh tế, dễ dàng kết hợp với nội thất khác.'),
(132, 'Mền MEMV05', 16, 1900000.00, 1800000.00, 5, 'Mền MEMV05 là lựa chọn lý tưởng cho những buổi tối lạnh giá.'),
(133, 'Mền MEMV06', 16, 2000000.00, 1900000.00, 7, 'Mền MEMV06 với khả năng giữ nhiệt tốt, giúp bạn luôn ấm áp.'),
(134, 'Mền MEMV07', 16, 2100000.00, 2000000.00, 6, 'Mền MEMV07 được sản xuất từ nguyên liệu tự nhiên, an toàn cho sức khỏe.'),
(135, 'Mền MEMV08', 16, 2200000.00, 2100000.00, 4, 'Mền MEMV08 có nhiều màu sắc và kích thước khác nhau, dễ dàng lựa chọn.'),


-- Đèn trang trí
(136, 'Đèn trang trí DTTV01', 17, 2500000.00, 2400000.00, 15, 'Đèn trang trí DTTV01 với thiết kế sang trọng, tạo điểm nhấn cho không gian.'),
(137, 'Đèn trang trí DTTV02', 17, 2600000.00, 2500000.00, 12, 'Đèn trang trí DTTV02 được làm từ chất liệu bền đẹp, dễ dàng vệ sinh.'),
(138, 'Đèn trang trí DTTV03', 17, 2700000.00, 2600000.00, 10, 'Đèn trang trí DTTV03 thiết kế hiện đại, phù hợp cho phòng khách.'),
(139, 'Đèn trang trí DTTV04', 17, 2800000.00, 2700000.00, 8, 'Đèn trang trí DTTV04 có ánh sáng ấm áp, mang lại không gian ấm cúng.'),
(140, 'Đèn trang trí DTTV05', 17, 2900000.00, 2800000.00, 5, 'Đèn trang trí DTTV05 có nhiều kiểu dáng, dễ dàng kết hợp với nội thất.'),
(141, 'Đèn trang trí DTTV06', 17, 3000000.00, 2900000.00, 3, 'Đèn trang trí DTTV06 giúp trang trí không gian sống thêm phần sinh động.'),
(142, 'Đèn trang trí DTTV07', 17, 3100000.00, 3000000.00, 2, 'Đèn trang trí DTTV07 với thiết kế độc đáo, tạo ấn tượng mạnh.'),
(143, 'Đèn trang trí DTTV08', 17, 3200000.00, 3100000.00, 1, 'Đèn trang trí DTTV08 là lựa chọn hoàn hảo cho không gian hiện đại.'),

-- Bình trang trí
(144, 'Bình trang trí BTTV01', 18, 1500000.00, 1400000.00, 20, 'Bình trang trí BTTV01 với thiết kế độc đáo, làm đẹp không gian.'),
(145, 'Bình trang trí BTTV02', 18, 1600000.00, 1500000.00, 15, 'Bình trang trí BTTV02 được làm từ chất liệu cao cấp, bền đẹp theo thời gian.'),
(146, 'Bình trang trí BTTV03', 18, 1700000.00, 1600000.00, 10, 'Bình trang trí BTTV03 thiết kế hiện đại, dễ dàng kết hợp với nội thất.'),
(147, 'Bình trang trí BTTV04', 18, 1800000.00, 1700000.00, 8, 'Bình trang trí BTTV04 có thể dùng để trang trí hoa tươi.'),
(148, 'Bình trang trí BTTV05', 18, 1900000.00, 1800000.00, 5, 'Bình trang trí BTTV05 là lựa chọn hoàn hảo cho không gian sống thêm sinh động.'),
(149, 'Bình trang trí BTTV06', 18, 2000000.00, 1900000.00, 7, 'Bình trang trí BTTV06 mang lại sự sang trọng cho không gian.'),
(150, 'Bình trang trí BTTV07', 18, 2100000.00, 2000000.00, 6, 'Bình trang trí BTTV07 có nhiều màu sắc, dễ dàng lựa chọn theo sở thích.'),
(151, 'Bình trang trí BTTV08', 18, 2200000.00, 2100000.00, 4, 'Bình trang trí BTTV08 với họa tiết đẹp mắt, tạo điểm nhấn cho không gian.'),


-- Tranh
(152, 'Tranh TRAV01', 19, 2500000.00, 2400000.00, 15, 'Tranh TRAV01 với thiết kế nghệ thuật, tạo cảm hứng cho không gian.'),
(153, 'Tranh TRAV02', 19, 2600000.00, 2500000.00, 12, 'Tranh TRAV02 được làm từ chất liệu tốt, bền đẹp theo thời gian.'),
(154, 'Tranh TRAV03', 19, 2700000.00, 2600000.00, 10, 'Tranh TRAV03 thiết kế hiện đại, phù hợp cho phòng khách.'),
(155, 'Tranh TRAV04', 19, 2800000.00, 2700000.00, 8, 'Tranh TRAV04 có nhiều kiểu dáng, dễ dàng kết hợp với nội thất.'),
(156, 'Tranh TRAV05', 19, 2900000.00, 2800000.00, 5, 'Tranh TRAV05 mang lại không gian sống thêm phần sinh động.'),
(157, 'Tranh TRAV06', 19, 3000000.00, 2900000.00, 3, 'Tranh TRAV06 với họa tiết đẹp mắt, tạo điểm nhấn cho không gian.'),
(158, 'Tranh TRAV07', 19, 3100000.00, 3000000.00, 2, 'Tranh TRAV07 giúp trang trí không gian sống thêm phần phong cách.'),
(159, 'Tranh TRAV08', 19, 3200000.00, 3100000.00, 1, 'Tranh TRAV08 là lựa chọn hoàn hảo cho những ai yêu thích nghệ thuật.');


--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_url`) VALUES
	(1,1, 'sofa/sofa1cho/sofa1choOrientale-1.png'),
	(2,1, 'sofa/sofa1cho/sofa1choOrientale-2.png'),
	(3,1, 'sofa/sofa1cho/sofa1choOrientale-3.png'),
	(4,2, 'sofa/sofa2cho/sofa2choMay-1.png'),
	(5,2, 'sofa/sofa2cho/sofa2choMay-2.png'),
	(6,2, 'sofa/sofa2cho/sofa2choMay-3.png'),
	(7,3, 'sofa/sofa2cho/sofa2choOgami-1.png'),
	(8,3, 'sofa/sofa2cho/sofa2choOgami-2.png'),
	(9,3, 'sofa/sofa2cho/sofa2choOgami-3.png'),
	(10,4, 'sofa/sofa3cho/Sofa3choxanh-1.png'),
	(11,4, 'sofa/sofa3cho/Sofa3choxanh-2.png'),
    (12, 5, 'sofa/sofa1.png'),
(13, 5, 'sofa/sofa0.png'),
(14, 5, 'sofa/sofa0.png'),
(15, 6, 'sofa/sofa2.png'),
(16, 6, 'sofa/sofa0.png'),
(17, 6, 'sofa/sofa0.png'),
(18, 7, 'sofa/sofa3.png'),
(19, 7, 'sofa/sofa0.png'),
(20, 7, 'sofa/sofa0.png'),
(21, 8, 'sofa/sofa4.png'),
(22, 8, 'sofa/sofa0.png'),
-- ghe an
(23, 9, '/ghean/ghean1.png'),
(24, 9, '/ghean/ghean1.1.png'),
(25, 10, '/ghean/ghean2.png'),
(26, 10, '/ghean/ghean1.1.png'),
(27, 11, '/ghean/ghean3.png'),
(28, 11, '/ghean/ghean1.2.png'),
(29, 12, '/ghean/ghean4.png'),
(30, 12, '/ghean/ghean1.2.png'),
(31, 13, '/ghean/ghean5.png'),
(32, 13, '/ghean/ghean1.2.png'),
(33, 14, '/ghean/ghean6.png'),
(34, 14, '/ghean/ghean1.2.png'),
(35, 15, '/ghean/ghean2.png'),
(36, 15, '/ghean/ghean1.2.png'),
(37, 16, '/ghean/ghean1.png'),
(38, 16, '/ghean/ghean1.2.png'),

(39, 25, '/ghelamviec/ghelv1.png'),
(40, 25, '/ghelamviec/ghelv1.1.png'),
(41, 26, '/ghelamviec/ghelv2.png'),
(42, 26, '/ghelamviec/ghelv2.2.png'),
(43, 27, '/ghelamviec/ghelv3.png'),
(44, 27, '/ghelamviec/ghelv3.3.png'),
(45, 28, '/ghelamviec/ghelv4.png'),
(46, 28, '/ghelamviec/ghelv4.4.png'),
(47, 29, '/ghelamviec/ghelv5.png'),
(48, 29, '/ghelamviec/ghelv5.5.png'),
(49, 30, '/ghelamviec/ghelv6.png'),
(50, 30, '/ghelamviec/ghelv6.6.png'),
(51, 31, '/ghelamviec/ghelv1.png'),
(52, 31, '/ghelamviec/ghelv1.1.png'),

(53, 32, '/kephongkhach/kpk1.png'),
(54, 32, '/kephongkhach/kpk1.1.png'),
(55, 33, '/kephongkhach/kpk2.png'),
(56, 33, '/kephongkhach/kpk2.2.png'),
(57, 34, '/kephongkhach/kpk3.png'),
(58, 34, '/kephongkhach/kpk3.3.png'),
(59, 35, '/kephongkhach/kpk4.png'),
(60, 35, '/kephongkhach/kpk4.4.png'),
(61, 36, '/kephongkhach/kpk5.png'),
(62, 36, '/kephongkhach/kpk5.5.png'),
(63, 37, '/kephongkhach/kpk4.png'),
(64, 37, '/kephongkhach/kpk4.4.png'),
(65, 38, '/kephongkhach/kpk1.png'),
(66, 38, '/kephongkhach/kpk1.1.png'),
(67, 39, '/kephongkhach/kpk3.png'),
(68, 39, '/kephongkhach/kpk3.3png'),

(69, 40, '/kesach/ks1.png'),
(70, 40, '/kesach/ks11.png'),
(71, 41, '/kesach/ks2.png'),
(72, 41, '/kesach/ks22.png'),

(73, 42, '/kesach/ks3.png'),
(74, 42, '/kesach/ks33.png'),
(75, 43, '/kesach/ks4.png'),
(76, 43, '/kesach/ks44.png'),
(77, 44, '/kesach/ks5.png'),
(78, 44, '/kesach/ks55.png'),
(79, 45, '/kesach/ks3.png'),
(80, 45, '/kesach/ks33.png'),
(81, 46, '/kesach/ks1.png'),
(82, 46, '/kesach/ks11.png'),
(83, 47, '/kesach/ks2.png'),


(84, 48, '/giuongngu/gn1.png'),
(85, 48, '/giuongngu/gn11.png'),
(86, 49, '/giuongngu/gn2.png'),
(87, 49, '/giuongngu/gn22.png'),
(88, 50, '/giuongngu/gn3.png'),
(89, 50, '/giuongngu/gn33.png'),
(90, 51, '/giuongngu/gn4.png'),
(91, 51, '/giuongngu/gn44.png'),
(92, 52, '/giuongngu/gn5.png'),
(93, 52, '/giuongngu/gn55.png'),
(94, 53, '/giuongngu/gn3.png'),
(95, 53, '/giuongngu/gn33.png'),
(96, 54, '/giuongngu/gn4.png'),
(97, 54, '/giuongngu/gn44.png'),
(98, 55, '/giuongngu/gn2.png'),
(99, 55, '/giuongngu/gn22.png'),

(100, 56, '/nem/n1.png'),
(101, 56, '/nem/n11.png'),
(103, 57, '/nem/n2.png'),
(104, 57, '/nem/n22.png'),
(105, 58, '/nem/n3.png'),
(106, 58, '/nem/n33.png'),
(107, 59, '/nem/n4.png'),
(108, 59, '/nem/n44.png'),
(109, 60, '/nem/n2.png'),
(110, 60, '/nem/n22.png'),
(111, 61, '/nem/n3.png'),
(112, 61, '/nem/n33.png'),
(113, 62, '/nem/n4.png'),
(114, 62, '/nem/n44.png'),
(115, 63, '/nem/n1.png'),
(116, 63, '/nem/n11.png'),

(117, 64, '/bannuoc/bn1.png'),
(118, 64, '/bannuoc/bn0.png'),
(119, 65, '/bannuoc/bn2.png'),
(120, 65, '/bannuoc/bn0.png'),
(121, 66, '/bannuoc/bn3.png'),
(122, 66, '/bannuoc/bn0.png'),
(123, 67, '/bannuoc/bn4.png'),
(124, 67, '/bannuoc/bn0.png'),
(125, 68, '/bannuoc/bn5.png'),
(126, 68, '/bannuoc/bn0.png'),
(127, 69, '/bannuoc/bn6.png'),
(128, 69, '/bannuoc/bn0.png'),
(129, 70, '/bannuoc/bn1.png'),
(130, 70, '/bannuoc/bn0.png'),
(131, 71, '/bannuoc/bn2.png'),
(132, 71, '/bannuoc/bn0.png'),

(133, 72, '/banan/ba1.png'),
(134, 72, '/banan/ba0.png'),
(135, 73, '/banan/ba2.png'),
(136, 73, '/banan/ba0.png'),
(137, 74, '/banan/ba3.png'),
(138, 74, '/banan/ba0.png'),
(139, 75, '/banan/ba4.png'),
(140, 75, '/banan/ba0.png'),
(141, 76, '/banan/ba5.png'),
(142, 76, '/banan/ba0.png'),
(143, 77, '/banan/ba6.png'),
(144, 77, '/banan/ba0.png'),
(145, 78, '/banan/ba7.png'),
(146, 78, '/banan/ba0.png'),
(147, 79, '/banan/ba1.png'),
(148, 79, '/banan/ba0.png'),

(149, 80, '/banlv/blv1.png'),
(150, 80, '/banlv/blv0.png'),
(151, 81, '/banlv/blv2.png'),
(152, 81, '/banlv/blv0.png'),
(153, 82, '/banlv/blv3.png'),
(154, 82, '/banlv/blv0.png'),
(155, 83, '/banlv/blv4.png'),
(156, 83, '/banlv/blv0.png'),
(157, 84, '/banlv/blv5.png'),
(158, 84, '/banlv/blv0.png'),
(159, 85, '/banlv/blv6.png'),
(160, 85, '/banlv/blv0.png'),
(161, 86, '/banlv/blv7.png'),
(162, 86, '/banlv/blv0.png'),
(163, 87, '/banlv/blv1.png'),
(164, 87, '/banlv/blv0.png'),

(165, 88, '/tutivi/tutv1.png'),
(166, 88, '/tutivi/tutv0.png'),
(167, 89, '/tutivi/tutv2.png'),
(168, 89, '/tutivi/tutv0.png'),
(169, 90, '/tutivi/tutv3.png'),
(170, 90, '/tutivi/tutv0.png'),
(171, 91, '/tutivi/tutv4.png'),
(172, 91, '/tutivi/tutv0.png'),
(173, 92, '/tutivi/tutv5.png'),
(174, 92, '/tutivi/tutv0.png'),
(175, 93, '/tutivi/tutv1.png'),
(176, 93, '/tutivi/tutv0.png'),
(177, 94, '/tutivi/tutv2.png'),
(178, 94, '/tutivi/tutv0.png'),
(179, 95, '/tutivi/tutv3.png'),
(180, 95, '/tutivi/tutv0.png'),

(181, 96, '/tubep/tubep1.png'),
(182, 96, '/tubep/tubep0.png'),
(183, 97, '/tubep/tubep2.png'),
(184, 97, '/tubep/tubep0.png'),
(185, 98, '/tubep/tubep3.png'),
(186, 98, '/tubep/tubep0.png'),
(187, 99, '/tubep/tubep4.png'),
(188, 99, '/tubep/tubep0.png'),
(189, 100, '/tubep/tubep5.png'),
(190, 100, '/tubep/tubep0.png'),
(191, 101, '/tubep/tubep6.png'),
(192, 101, '/tubep/tubep0.png'),
(193, 102, '/tubep/tubep2.png'),
(194, 102, '/tubep/tubep0.png'),
(195, 103, '/tubep/tubep1.png'),
(196, 103, '/tubep/tubep0.png'),

(197, 104, '/tuly/tl1.png'),
(198, 104, '/tuly/tl0.png'),
(199, 105, '/tuly/tl2.png'),
(201, 105, '/tuly/tl0.png'),
(202, 106, '/tuly/tl3.png'),
(203, 106, '/tuly/tl0.png'),
(204, 107, '/tuly/tl4.png'),
(205, 107, '/tuly/tl0.png'),
(206, 108, '/tuly/tl5.png'),
(207, 108, '/tuly/tl0.png'),
(208, 109, '/tuly/tl6.png'),
(209, 109, '/tuly/tl0.png'),
(210, 110, '/tuly/tl2.png'),
(211, 110, '/tuly/tl0.png'),
(212, 111, '/tuly/tl3.png'),
(213, 111, '/tuly/tl0.png'),

(214, 112, '/tuao/ta1.png'),
(215, 112, '/tuao/ta0.png'),
(216, 113, '/tuao/ta2.png'),
(217, 113, '/tuao/ta0.png'),
(218, 114, '/tuao/ta3.png'),
(219, 114, '/tuao/ta0.png'),
(220, 115, '/tuao/ta1.png'),
(221, 115, '/tuao/ta0.png'),
(222, 116, '/tuao/ta2.png'),
(223, 116, '/tuao/ta0.png'),
(224, 117, '/tuao/ta3.png'),
(225, 117, '/tuao/ta0.png'),
(226, 118, '/tuao/ta2.png'),
(227, 118, '/tuao/ta0.png'),
(228, 119, '/tuao/ta1.png'),
(229, 119, '/tuao/ta0.png'),

(230, 120, '/goi/g1.png'),
(231, 120, '/goi/g0.png'),
(232, 121, '/goi/g2.png'),
(233, 121, '/goi/g0.png'),
(234, 122, '/goi/g3.png'),
(235, 122, '/goi/g0.png'),
(236, 123, '/goi/g4.png'),
(237, 123, '/goi/g0.png'),
(238, 124, '/goi/g1.png'),
(239, 124, '/goi/g0.png'),
(240, 125, '/goi/g3.png'),
(241, 125, '/goi/g0.png'),
(242, 126, '/goi/g2.png'),
(243, 126, '/goi/g0.png'),
(244, 127, '/goi/g4.png'),
(245, 127, '/goi/g0.png'),

(246, 128, '/chan/c1.png'),
(247, 128, '/chan/c0.png'),
(248, 129, '/chan/c2.png'),
(249, 129, '/chan/c0.png'),
(250, 130, '/chan/c3.png'),
(251, 130, '/chan/c0.png'),
(252, 131, '/chan/c4.png'),
(253, 131, '/chan/c0.png'),
(254, 132, '/chan/c2.png'),
(255, 132, '/chan/c0.png'),
(256, 133, '/chan/c4.png'),
(257, 133, '/chan/c0.png'),
(258, 134, '/chan/c3.png'),
(259, 134, '/chan/c0.png'),
(260, 135, '/chan/c1.png'),
(261, 135, '/chan/c0.png'),

(262, 136, '/den/d1.png'),
(263, 136, '/den/d0.png'),
(264, 137, '/den/d2.png'),
(265, 137, '/den/d0.png'),
(266, 138, '/den/d3.png'),
(267, 138, '/den/d0.png'),
(268, 139, '/den/d4.png'),
(269, 139, '/den/d0.png'),
(270, 140, '/den/d5.png'),
(271, 140, '/den/d0.png'),
(272, 141, '/den/d2.png'),
(273, 141, '/den/d0.png'),
(274, 142, '/den/d1.png'),
(275, 142, '/den/d0.png'),
(276, 143, '/den/d4.png'),
(277, 143, '/den/d0.png'),

(278, 144, '/binh/b1.png'),
(279, 144, '/binh/b0.png'),
(280, 145, '/binh/b2.png'),
(281, 145, '/binh/b0.png'),
(282, 146, '/binh/b3.png'),
(283, 146, '/binh/b0.png'),
(284, 147, '/binh/b4.png'),
(285, 147, '/binh/b0.png'),
(286, 148, '/binh/b4.png'),
(287, 148, '/binh/b0.png'),
(288, 149, '/binh/b5.png'),
(289, 149, '/binh/b0.png'),
(290, 150, '/binh/b2.png'),
(291, 150, '/binh/b0.png'),
(292, 151, '/binh/b1.png'),
(293, 151, '/binh/b0.png'),

(294, 152, '/tranh/t1.png'),
(295, 152, '/tranh/t0.png'),
(296, 153, '/tranh/t2.png'),
(297, 153, '/tranh/t0.png'),
(298, 154, '/tranh/t3.png'),
(299, 154, '/tranh/t0.png'),
(300, 155, '/tranh/t4.png'),
(301, 155, '/tranh/t0.png'),
(302, 156, '/tranh/t5.png'),
(303, 156, '/tranh/t0.png'),
(304, 157, '/tranh/t2.png'),
(305, 157, '/tranh/t0.png'),
(306, 158, '/tranh/t4.png'),
(307, 158, '/tranh/t0.png'),
(308, 159, '/tranh/t1.png'),
(309, 159, '/tranh/t0.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`user_id`, `email`, `password`, `address`, `phone_number`, `fullname`, `created_at`) VALUES 
(1, 'user1@example.com', 'password123', '123 Main St, City A', '0331234567', 'Nguyen Van A', NOW()),
(2, 'user2@example.com', 'password123', '456 Oak St, City B', '0702345678', 'Tran Thi B', NOW()),
(3, 'user3@example.com', 'password123', '789 Pine St, City C', '0913456789', 'Le Van C', NOW()),
(4, 'user4@example.com', 'password123', '321 Maple St, City D', '0334567890', 'Pham Thi D', NOW()),
(5, 'user5@example.com', 'password123', '654 Elm St, City E', '0705678901', 'Hoang Van E', NOW());
--



-- Chỉ mục cho các bảng đã đổ

-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_images_ibfk_1` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

-- Cấu trúc bảng cho bảng `carts`
--
CREATE TABLE carts (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);


--
-- Cấu trúc bảng cho bảng `cart_items`
--
CREATE TABLE cart_items (
    cart_item_id INT PRIMARY KEY AUTO_INCREMENT,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (cart_id) REFERENCES carts(cart_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;








