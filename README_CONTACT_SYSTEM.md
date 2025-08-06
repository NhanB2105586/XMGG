# Hệ thống Liên hệ - Hướng dẫn cài đặt

## 1. Tạo bảng contacts trong database

Chạy SQL sau trong database của bạn:

```sql
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `contacted` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

## 2. Các file đã được tạo/sửa đổi:

### Models:
- `app/models/contact.php` - Model xử lý dữ liệu liên hệ

### Controllers:
- `app/controllers/user/ContactController.php` - Controller xử lý form liên hệ
- `app/controllers/admin/ManageContactController.php` - Controller quản lý liên hệ trong admin

### Routes:
- `app/routes/contact.php` - Route xử lý submit form liên hệ
- `app/routes/manageContact.php` - Route quản lý liên hệ trong admin

### Views:
- `app/views/user/lienhe.php` - Form liên hệ (đã được sửa)
- `app/views/admin/viewContact.php` - Trang quản lý liên hệ trong admin

### Cấu hình:
- `public/index.php` - Đã thêm include các route mới
- `app/views/partials/sidebar.php` - Đã thêm link đến trang quản lý liên hệ

## 3. Tính năng:

### Form liên hệ (lienhe.php):
- Họ và tên
- Email
- Số điện thoại
- Nội dung
- Validation dữ liệu
- Thông báo thành công/lỗi

### Trang admin (viewContact.php):
- Hiển thị tất cả liên hệ
- Thống kê số lượng liên hệ
- Đánh dấu đã liên hệ
- Xóa liên hệ
- Phân biệt liên hệ đã xử lý/chưa xử lý

## 4. Cách sử dụng:

1. Khách hàng điền form liên hệ tại `/lienhe`
2. Dữ liệu được lưu vào bảng `contacts`
3. Admin xem liên hệ tại `/admin/contacts`
4. Admin có thể đánh dấu đã liên hệ hoặc xóa liên hệ

## 5. Lưu ý:

- Đảm bảo database connection đúng
- Kiểm tra quyền ghi vào database
- Test form validation
- Kiểm tra session để hiển thị thông báo 