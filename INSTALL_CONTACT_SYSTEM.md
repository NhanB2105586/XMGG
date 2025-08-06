# Hướng dẫn cài đặt hệ thống Liên hệ

## Bước 1: Tạo bảng contacts trong database

Chạy SQL sau trong database của bạn (phpMyAdmin hoặc MySQL command line):

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

## Bước 2: Kiểm tra các file đã được tạo

### Models:
- ✅ `app/models/contact.php` - Model xử lý dữ liệu liên hệ

### Controllers:
- ✅ `app/controllers/user/ContactController.php` - Controller xử lý form liên hệ
- ✅ `app/controllers/admin/ManageContactController.php` - Controller quản lý liên hệ trong admin

### Routes:
- ✅ `app/routes/contact.php` - Route xử lý submit form liên hệ
- ✅ `app/routes/manageContact.php` - Route quản lý liên hệ trong admin

### Views:
- ✅ `app/views/user/lienhe.php` - Form liên hệ (đã được sửa)
- ✅ `app/views/admin/viewContact.php` - Trang quản lý liên hệ trong admin

### Cấu hình:
- ✅ `public/index.php` - Đã thêm include các route mới
- ✅ `app/views/partials/sidebar.php` - Đã thêm link đến trang quản lý liên hệ

## Bước 3: Test hệ thống

### Test form liên hệ:
1. Truy cập `/lienhe`
2. Điền form với thông tin:
   - Họ và tên: Test User
   - Email: test@example.com
   - Số điện thoại: 0123456789
   - Nội dung: Test message
3. Nhấn "Gửi"
4. Kiểm tra thông báo thành công

### Test trang admin:
1. Truy cập `/admin/contacts`
2. Kiểm tra hiển thị liên hệ vừa tạo
3. Test nút "Đã liên hệ"
4. Test nút "Xóa"
5. Test modal xem nội dung

## Bước 4: Kiểm tra lỗi thường gặp

### Nếu form không submit được:
- Kiểm tra route `/contact/submit` có hoạt động không
- Kiểm tra database connection
- Kiểm tra quyền ghi vào database

### Nếu trang admin không hiển thị:
- Kiểm tra route `/admin/contacts` có hoạt động không
- Kiểm tra session admin
- Kiểm tra database có dữ liệu không

### Nếu có lỗi namespace:
- Kiểm tra autoload trong composer.json
- Chạy `composer dump-autoload`

## Tính năng đã hoàn thành:

### Form liên hệ (lienhe.php):
- ✅ Họ và tên
- ✅ Email
- ✅ Số điện thoại
- ✅ Nội dung
- ✅ Validation dữ liệu
- ✅ Thông báo thành công/lỗi
- ✅ Lưu ngày giờ tự động

### Trang admin (viewContact.php):
- ✅ Hiển thị tất cả liên hệ
- ✅ Thống kê số lượng liên hệ
- ✅ Đánh dấu đã liên hệ
- ✅ Xóa liên hệ
- ✅ Phân biệt liên hệ đã xử lý/chưa xử lý
- ✅ Modal xem nội dung chi tiết
- ✅ Giao diện responsive

## Lưu ý quan trọng:

1. **Database**: Đảm bảo database connection đúng trong `app/controllers/Controller.php`
2. **Session**: Kiểm tra session_start() trong index.php
3. **Permissions**: Đảm bảo web server có quyền ghi vào database
4. **Bootstrap**: Đảm bảo Bootstrap CSS/JS được load đúng
5. **Routes**: Kiểm tra tất cả routes được include trong index.php

## Troubleshooting:

### Lỗi "Class not found":
```bash
composer dump-autoload
```

### Lỗi database connection:
Kiểm tra thông tin database trong `app/controllers/Controller.php`

### Lỗi 404:
Kiểm tra .htaccess và rewrite rules

### Lỗi session:
Đảm bảo session_start() được gọi trước khi sử dụng $_SESSION 