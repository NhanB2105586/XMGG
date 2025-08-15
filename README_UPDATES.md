# Cập nhật Website Xi Măng Giả Gỗ

## Các tính năng mới đã được thêm:

### 1. Tính năng Yêu thích sản phẩm
- **Cơ sở dữ liệu**: Tạo bảng `favorites` để lưu trữ sản phẩm yêu thích
- **Model**: `Favorite.php` - Quản lý thao tác với sản phẩm yêu thích
- **Controller**: `FavoriteController.php` - Xử lý logic yêu thích
- **View**: `favorites.php` - Trang hiển thị danh sách yêu thích
- **Icon yêu thích**: Thêm icon trái tim trên navbar với badge số lượng

### 2. Cập nhật Navbar
- Thay đổi icon giỏ hàng từ trái tim thành icon giỏ hàng
- Thêm icon yêu thích với badge số lượng
- Cập nhật các link menu theo tên mới

### 3. Trang mới
- **TIN TỨC**: `tintuc.php` - Trang tin tức và sự kiện
- **KHÁC**: `khac.php` - Thông tin về xi măng giả gỗ, chính sách bảo hành, quy trình thi công
- **HẠNG MỤC**: Các trang mới cho Trần, Lam, Sàn, Tường, Vách, Cửa

### 4. Cập nhật sản phẩm
- Thêm 3 nút cho mỗi sản phẩm: Yêu thích, Thêm vào giỏ hàng, Chi tiết
- Giữ giao diện cũ với text thay vì icon
- Khi nhấn yêu thích hoặc thêm vào giỏ hàng, badge trên navbar sẽ được cập nhật

### 5. Cải thiện giao diện
- Chỉnh kích thước slide homepage cho vừa vặn (500px height)
- Responsive design cho mobile
- CSS tự động resize hình ảnh khi upload

## Cài đặt:

### 1. Cập nhật cơ sở dữ liệu
```sql
-- Chạy file SQL để tạo bảng favorites (không có foreign key)
source create_favorites_simple.sql;

-- Hoặc nếu muốn có foreign key constraints, chạy:
source create_favorites_table.sql;
```

### 2. Cấu trúc thư mục mới
```
app/
├── models/
│   └── favorite.php
├── controllers/user/
│   └── FavoriteController.php
├── views/user/
│   ├── favorites.php
│   ├── tintuc.php
│   ├── khac.php
│   ├── tran.php
│   ├── lam.php
│   └── ...
└── routes/
    ├── favorite.php
    └── news.php
```

### 3. CSS mới
- `public/css/image-resize.css` - Tự động resize hình ảnh
- Cập nhật `stylehomePage.css` - Chỉnh kích thước slide

## Sử dụng:

### Tính năng yêu thích
1. Đăng nhập vào tài khoản
2. Nhấn icon trái tim trên sản phẩm để yêu thích
3. Xem danh sách yêu thích tại icon trái tim trên navbar
4. Quản lý sản phẩm yêu thích trong trang favorites

### Trang mới
- **TIN TỨC**: `/tintuc` - Xem tin tức và sự kiện
- **KHÁC**: `/khac` - Thông tin chi tiết về sản phẩm và dịch vụ
- **HẠNG MỤC**: `/tran`, `/lam`, `/san`, `/tuong`, `/vach`, `/cua`

### Sản phẩm
- Mỗi sản phẩm có 3 nút:
  - Yêu thích
  - Thêm Vào Giỏ  
  - Chi Tiết
- Khi nhấn yêu thích hoặc thêm vào giỏ hàng, badge trên navbar sẽ được cập nhật tự động

## Lưu ý:
- Cần đăng nhập để sử dụng tính năng yêu thích
- Hình ảnh sẽ tự động resize khi upload
- Slide homepage đã được tối ưu cho responsive
- Tất cả các trang mới đều có giao diện thống nhất

## Troubleshooting:
- Nếu gặp lỗi database foreign key, sử dụng file `create_favorites_simple.sql` thay vì `create_favorites_table.sql`
- Nếu gặp lỗi "Class Model not found", chạy `composer dump-autoload` để cập nhật autoloader
- Nếu gặp lỗi "Column not found: p.id", đã được sửa trong `getUserFavorites()` method
- Nếu gặp lỗi "use statement with non-compound name 'PDO'", đã xóa use statement không cần thiết
- Nếu gặp lỗi "Call to undefined method view()", đã sửa thành `sendPage()` trong FavoriteController
- Nếu trang favorites không hiển thị, đã sửa để sử dụng include trực tiếp thay vì sendPage
- Nếu nút yêu thích không lưu vào CSDL, kiểm tra JavaScript console và đảm bảo đã đăng nhập
- Nếu route không hoạt động, kiểm tra file `public/index.php` đã include đủ routes
- Nếu CSS không load, kiểm tra đường dẫn file CSS
- Nếu badge không cập nhật, kiểm tra JavaScript console để xem lỗi
- Nếu nút "Yêu thích" thêm vào giỏ hàng thay vì yêu thích, đã sửa thành 3 nút riêng biệt 