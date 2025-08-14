# Cập nhật Trang Admin Dashboard

## Các thay đổi đã thực hiện

### 1. Xóa phần "Trạng thái hệ thống"
- Đã xóa hoàn toàn phần "Trạng thái hệ thống" khỏi dashboard
- Giao diện trở nên gọn gàng và tập trung hơn

### 2. Thống kê doanh thu theo tháng
- **Biểu đồ đường**: Hiển thị doanh thu 12 tháng trong năm
- **Dữ liệu mô phỏng**: 
  - Tháng 5: 5,000,000 VNĐ
  - Tháng 6: 10,000,000 VNĐ  
  - Tháng 7: 6,800,000 VNĐ
  - Tháng 8: Doanh thu thực tế (hiện tại = 0, sẽ cập nhật khi có đơn hàng)
- **Tính năng tương tác**: Click vào điểm trên biểu đồ để xem chi tiết hóa đơn

### 3. Tính năng xem chi tiết hóa đơn
- **Modal popup**: Hiển thị danh sách hóa đơn khi click vào tháng
- **Thông tin hiển thị**:
  - Mã đơn hàng
  - Tên khách hàng và email
  - Ngày đặt hàng
  - Tổng tiền
  - Trạng thái đơn hàng

### 4. Cập nhật logic tính doanh thu
- **Tính từ order_details**: Doanh thu được tính từ `quantity * price` trong bảng `order_details`
- **Tự động cập nhật**: Khi có đơn hàng mới, biểu đồ sẽ tự động cập nhật
- **Reset hàng năm**: Sau tháng 12, hệ thống sẽ reset về tháng 1 năm mới

## Cách sử dụng

### 1. Chạy dữ liệu mẫu
```sql
-- Import dữ liệu users mẫu
source sample_users.sql

-- Import dữ liệu orders mẫu  
source sample_orders.sql
```

### 2. Truy cập trang admin
- URL: `/admin`
- Đăng nhập: username: `admin`, password: `123123`

### 3. Tương tác với biểu đồ
- **Hover**: Xem doanh thu chi tiết của từng tháng
- **Click**: Mở modal hiển thị danh sách hóa đơn của tháng đó
- **Responsive**: Biểu đồ tự động điều chỉnh kích thước

## Cấu trúc file đã thay đổi

### Backend
- `app/models/model.php`: Thêm methods `getMonthlyRevenue()` và `getOrdersByMonth()`
- `app/controllers/admin/AdminController.php`: Thêm method `getOrdersByMonth()` và cập nhật `index()`
- `app/routes/admin.php`: Thêm route `/admin/getOrdersByMonth`

### Frontend  
- `app/views/admin/dashboard.php`: 
  - Xóa phần "Trạng thái hệ thống"
  - Thêm biểu đồ Chart.js
  - Thêm modal hiển thị hóa đơn
  - Thêm JavaScript xử lý tương tác

### Dữ liệu mẫu
- `sample_users.sql`: Dữ liệu users mẫu
- `sample_orders.sql`: Dữ liệu orders mẫu

## Tính năng nổi bật

1. **Biểu đồ tương tác**: Sử dụng Chart.js với animation mượt mà
2. **Responsive design**: Tương thích với mọi thiết bị
3. **Real-time data**: Dữ liệu được tính toán từ database thực tế
4. **User-friendly**: Giao diện trực quan, dễ sử dụng
5. **Performance**: Tối ưu hóa query database

## Lưu ý kỹ thuật

- **Database**: Cần có bảng `orders`, `order_details`, `users` với cấu trúc phù hợp
- **Dependencies**: Chart.js được load từ CDN
- **Browser support**: Hỗ trợ các trình duyệt hiện đại
- **Security**: API được bảo vệ bởi session admin

## Tương lai

- Thêm biểu đồ cột cho so sánh các năm
- Export dữ liệu ra Excel/PDF
- Thêm filter theo khoảng thời gian
- Thống kê sản phẩm bán chạy
- Dashboard real-time với WebSocket
