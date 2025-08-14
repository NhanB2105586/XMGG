# Hướng dẫn chức năng Ảnh chính (MẸO Đơn giản)

## Cách hoạt động
Chức năng ảnh chính sử dụng **MẸO đơn giản**: Ảnh đầu tiên trong danh sách luôn là ảnh chính. Khi admin tick chọn ảnh khác làm ảnh chính, ảnh đó sẽ được di chuyển lên vị trí đầu tiên.

- ✅ **Không cần sửa SQL database**
- ✅ **Không cần file JSON phức tạp**
- ✅ **Logic đơn giản, dễ hiểu**
- ✅ **Hoạt động ngay lập tức**
- ✅ **Không ảnh hưởng đến dữ liệu hiện tại**

## Cách hoạt động
- Ảnh chính = Ảnh đầu tiên trong danh sách (ORDER BY image_id ASC)
- Khi admin tick chọn ảnh chính → Tất cả ảnh được sắp xếp lại, ảnh được chọn lên đầu
- **Thứ tự xử lý**: Xóa ảnh trước → Chọn ảnh chính sau (để tránh lỗi image_id)
- Sử dụng session để lưu trữ tạm thời thông tin ảnh chính đã chọn
- Ảnh chính sẽ hiển thị đúng trong view sau khi cập nhật

## Bước 2: Tính năng mới

### Trong Admin Panel (editProduct.php):
- ✅ Thêm radio button để chọn ảnh chính
- ✅ Hiển thị icon sao cho ảnh chính
- ✅ JavaScript để xử lý việc chọn ảnh chính
- ✅ CSS styling cho giao diện đẹp
- ✅ Logic hiển thị đúng ảnh chính sau khi cập nhật (sử dụng session)

### Trong Model (ProductImage.php):
- ✅ Method `getMainImageByProductId()` - Lấy ảnh chính (ảnh đầu tiên)
- ✅ Method `setMainImage()` - MẸO: Sắp xếp lại tất cả ảnh, ảnh được chọn lên đầu
- ✅ Method `ensureMainImage()` - Đảm bảo luôn có ảnh chính
- ✅ Method `getMainImageForDisplay()` - Lấy ảnh đầu tiên để hiển thị
- ✅ Method `isMainImage()` - Kiểm tra ảnh có phải ảnh chính không (ảnh đầu tiên)

### Trong Controllers:
- ✅ UserController - Cập nhật để sử dụng ảnh chính
- ✅ ProductController - Cập nhật để sử dụng ảnh chính
- ✅ ManageProductController - Xử lý lưu ảnh chính và session
- ✅ **Thứ tự xử lý**: Xóa ảnh trước → Chọn ảnh chính sau

### Trong Helpers:
- ✅ Function `getMainImage()` - Helper để lấy ảnh chính
- ✅ Function `isMainImage()` - Helper để kiểm tra ảnh chính (ảnh đầu tiên)

## Bước 3: Cách sử dụng

### Trong Views, thay vì:
```php
<img src="<?= getImagePath($product['images'][0]['image_url']) ?>">
```

### Sử dụng:
```php
<img src="<?= getMainImage($product) ?>">
```

## Bước 4: Lợi ích
- ✅ **Không cần sửa database** - Sử dụng mẹo đơn giản
- ✅ **Logic đơn giản** - Ảnh đầu tiên = Ảnh chính
- ✅ **Hoạt động ngay lập tức** - Không cần file JSON phức tạp
- ✅ Admin có thể chọn ảnh chính cho sản phẩm
- ✅ Ảnh chính sẽ hiển thị đầu tiên trên web
- ✅ Tự động fallback về ảnh đầu tiên nếu không có ảnh chính
- ✅ Giao diện admin đẹp và dễ sử dụng
- ✅ Không ảnh hưởng đến dữ liệu hiện tại
- ✅ Dễ dàng triển khai và test

## Lưu ý
- Ảnh chính = Ảnh đầu tiên trong danh sách
- Khi admin tick chọn ảnh chính → Tất cả ảnh được sắp xếp lại, ảnh được chọn lên đầu
- **Thứ tự xử lý quan trọng**: Xóa ảnh trước → Chọn ảnh chính sau
- Sử dụng session để lưu trữ tạm thời thông tin ảnh chính đã chọn
- Logic đơn giản, không cần file JSON phức tạp
- Hoạt động ngay lập tức sau khi lưu
- Radio button sẽ hiển thị đúng ảnh chính sau khi cập nhật
- Xóa ảnh hoạt động chính xác với thứ tự xử lý mới
