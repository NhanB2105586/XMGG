-- Kiểm tra và tạo bảng favorites với foreign key đúng
-- Đảm bảo bảng users và products đã tồn tại trước

-- Tạo bảng favorites để lưu trữ sản phẩm yêu thích của người dùng
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_product_unique` (`user_id`, `product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Thêm foreign key constraints sau khi tạo bảng
-- Chỉ thêm nếu bảng users và products tồn tại
ALTER TABLE `favorites` 
ADD CONSTRAINT `fk_favorites_user_id` 
FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

ALTER TABLE `favorites` 
ADD CONSTRAINT `fk_favorites_product_id` 
FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE; 