<<<<<<< HEAD
USE project;

CREATE TABLE favorites (
    favorite_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (user_id, product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
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
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
