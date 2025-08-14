-- Tạo bảng hangmuc_pages
CREATE TABLE IF NOT EXISTS `hangmuc_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `content` longtext,
  `image_path` varchar(500),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm dữ liệu mẫu cho các trang hạng mục
INSERT INTO `hangmuc_pages` (`slug`, `title`, `description`, `content`) VALUES
('tran', 'Trần', 'Hạng mục Trần - Thiết kế và thi công trần nhà', 'Nội dung chi tiết về hạng mục Trần sẽ được cập nhật tại đây.'),
('lam', 'Lam', 'Hạng mục Lam - Thiết kế và thi công lam nhà', 'Nội dung chi tiết về hạng mục Lam sẽ được cập nhật tại đây.'),
('san', 'Sàn', 'Hạng mục Sàn - Thiết kế và thi công sàn nhà', 'Nội dung chi tiết về hạng mục Sàn sẽ được cập nhật tại đây.'),
('vach', 'Vách', 'Hạng mục Vách - Thiết kế và thi công vách nhà', 'Nội dung chi tiết về hạng mục Vách sẽ được cập nhật tại đây.'),
('cua', 'Cửa', 'Hạng mục Cửa - Thiết kế và thi công cửa nhà', 'Nội dung chi tiết về hạng mục Cửa sẽ được cập nhật tại đây.'),
('cauthang', 'Cầu thang', 'Hạng mục Cầu thang - Thiết kế và thi công cầu thang', 'Nội dung chi tiết về hạng mục Cầu thang sẽ được cập nhật tại đây.'),
('hangrao', 'Hàng rào', 'Hạng mục Hàng rào - Thiết kế và thi công hàng rào', 'Nội dung chi tiết về hạng mục Hàng rào sẽ được cập nhật tại đây.'),
('bonhoa', 'Bồn hoa, bàn, ghế', 'Hạng mục Bồn hoa, bàn, ghế - Thiết kế và thi công ngoại thất', 'Nội dung chi tiết về hạng mục Bồn hoa, bàn, ghế sẽ được cập nhật tại đây.');
