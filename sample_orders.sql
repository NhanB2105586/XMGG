-- Dữ liệu mẫu cho bảng orders để test biểu đồ doanh thu
-- Thêm một số đơn hàng mẫu cho các tháng trước

-- Thêm đơn hàng tháng 5 (5,000,000 VNĐ)
INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`) VALUES
(1, 1, '2024-05-15 10:30:00', 5000000.00, 'completed');

-- Thêm đơn hàng tháng 6 (10,000,000 VNĐ)
INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`) VALUES
(2, 2, '2024-06-05 09:45:00', 10000000.00, 'completed');

-- Thêm đơn hàng tháng 7 (6,800,000 VNĐ)
INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`) VALUES
(3, 3, '2024-07-03 13:45:00', 6800000.00, 'completed');

-- Thêm đơn hàng tháng 8 (hiện tại - sẽ được cập nhật khi có đơn hàng thực)
INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`) VALUES
(4, 4, '2024-08-01 10:00:00', 1500000.00, 'completed');

-- Thêm chi tiết đơn hàng cho các đơn hàng trên
INSERT INTO `order_details` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
-- Chi tiết đơn hàng 1 (tháng 5 - 5,000,000)
(1, 1, 1, 1, 5000000.00),

-- Chi tiết đơn hàng 2 (tháng 6 - 10,000,000)
(2, 2, 2, 1, 10000000.00),

-- Chi tiết đơn hàng 3 (tháng 7 - 6,800,000)
(3, 3, 3, 1, 6800000.00),

-- Chi tiết đơn hàng 4 (tháng 8 - 1,500,000)
(4, 4, 4, 1, 1500000.00);
