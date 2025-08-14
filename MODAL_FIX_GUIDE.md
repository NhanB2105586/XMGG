# Hướng dẫn sửa lỗi Modal Bootstrap

## Vấn đề
Nút X (đóng modal) không hoạt động trong trang chi tiết hóa đơn.

## Nguyên nhân
- **Conflict version**: Dashboard sử dụng Bootstrap 5 syntax nhưng hệ thống đang dùng Bootstrap 4
- **Missing attributes**: Thiếu các thuộc tính cần thiết cho Bootstrap 4 modal
- **JavaScript conflict**: Chart.js có thể conflict với Bootstrap modal

## Giải pháp đã áp dụng

### 1. Sửa HTML Modal (Bootstrap 4 compatible)
```html
<!-- Trước (Bootstrap 5) -->
<div class="modal fade" id="ordersModal" tabindex="-1" aria-labelledby="ordersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ordersModalLabel">Chi tiết hóa đơn tháng <span id="selectedMonth"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<!-- Sau (Bootstrap 4) -->
<div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-labelledby="ordersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ordersModalLabel">Chi tiết hóa đơn tháng <span id="selectedMonth"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
```

### 2. Sửa JavaScript (jQuery thay vì Bootstrap 5)
```javascript
// Trước (Bootstrap 5)
const modal = new bootstrap.Modal(document.getElementById('ordersModal'));
modal.show();

// Sau (Bootstrap 4 + jQuery)
$('#ordersModal').modal('show');
```

### 3. Thêm Event Handlers
```javascript
$(document).ready(function() {
    // Xử lý sự kiện đóng modal
    $('#ordersModal').on('hidden.bs.modal', function () {
        // Reset nội dung modal khi đóng
        document.getElementById('ordersList').innerHTML = `
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `;
    });

    // Xử lý sự kiện click nút đóng
    $('.close, [data-dismiss="modal"]').on('click', function() {
        $('#ordersModal').modal('hide');
    });
});
```

### 4. Thêm CSS để đảm bảo hiển thị đúng
```css
/* Đảm bảo modal hiển thị đúng */
.modal-dialog {
    max-width: 800px;
}

.modal-header .close {
    font-size: 1.5rem;
    font-weight: bold;
    opacity: 0.5;
    transition: opacity 0.3s;
}

.modal-header .close:hover {
    opacity: 1;
}

/* Đảm bảo spinner hiển thị đúng */
.spinner-border {
    width: 3rem;
    height: 3rem;
}
```

## Các thay đổi chính

### Bootstrap 4 vs Bootstrap 5
| Thuộc tính | Bootstrap 4 | Bootstrap 5 |
|------------|-------------|-------------|
| Modal role | `role="dialog"` | Không cần |
| Dialog role | `role="document"` | Không cần |
| Close button | `class="close"` | `class="btn-close"` |
| Dismiss attribute | `data-dismiss="modal"` | `data-bs-dismiss="modal"` |
| Close symbol | `<span>&times;</span>` | Không cần |
| Screen reader | `sr-only` | `visually-hidden` |

### JavaScript API
| Action | Bootstrap 4 | Bootstrap 5 |
|--------|-------------|-------------|
| Show modal | `$('#modal').modal('show')` | `new bootstrap.Modal(el).show()` |
| Hide modal | `$('#modal').modal('hide')` | `modal.hide()` |
| Toggle modal | `$('#modal').modal('toggle')` | `modal.toggle()` |

## Kiểm tra

### 1. Test file
Sử dụng file `test_modal.html` để kiểm tra modal hoạt động:
```bash
# Mở file test trong browser
open test_modal.html
```

### 2. Console logs
Kiểm tra console để đảm bảo:
- jQuery loaded
- Bootstrap modal events working
- No JavaScript errors

### 3. Manual test
- Click vào điểm trên biểu đồ
- Modal mở
- Click nút X → Modal đóng
- Click bên ngoài modal → Modal đóng
- Press ESC → Modal đóng

## Troubleshooting

### Nếu vẫn không hoạt động:

1. **Kiểm tra jQuery**
```javascript
console.log(typeof $); // Should return "function"
```

2. **Kiểm tra Bootstrap**
```javascript
console.log(typeof $.fn.modal); // Should return "function"
```

3. **Kiểm tra conflicts**
```javascript
// Tạm thời disable Chart.js
// Chart.defaults.plugins.tooltip.enabled = false;
```

4. **Force close modal**
```javascript
$('#ordersModal').modal('hide');
$('.modal-backdrop').remove();
$('body').removeClass('modal-open');
```

## Lưu ý
- Đảm bảo load jQuery trước Bootstrap
- Kiểm tra version compatibility
- Test trên nhiều browser khác nhau
- Backup trước khi thay đổi
