// JavaScript cho thông báo tự động tắt - Áp dụng cho tất cả trang

document.addEventListener('DOMContentLoaded', function() {
    // Xử lý thông báo tự động tắt
    const alerts = document.querySelectorAll('.auto-hide');
    alerts.forEach(alert => {
        const delay = parseInt(alert.dataset.delay) || 2000;
        
        // Tự động tắt sau thời gian delay
        setTimeout(() => {
            hideAlert(alert);
        }, delay);
        
        // Xử lý nút đóng
        const closeBtn = alert.querySelector('.close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                hideAlert(alert);
            });
        }
    });
});

// Hàm ẩn thông báo với animation
function hideAlert(alert) {
    alert.style.animation = 'slideOutUp 0.5s ease-out';
    setTimeout(() => {
        if (alert.parentNode) {
            alert.parentNode.removeChild(alert);
        }
    }, 500);
}

// Hàm tạo thông báo mới
function showAlert(message, type = 'success', delay = 2000) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} auto-hide`;
    alertDiv.setAttribute('data-delay', delay);
    alertDiv.setAttribute('role', 'alert');
    
    const icon = type === 'success' ? 'check-circle' : 
                 type === 'danger' ? 'exclamation-triangle' :
                 type === 'warning' ? 'exclamation-triangle' : 'info-circle';
    
    alertDiv.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-${icon} me-2"></i>
                ${message}
            </div>
            <button type="button" class="close" onclick="hideAlert(this.parentElement.parentElement)">
                <span>&times;</span>
            </button>
        </div>
    `;
    
    // Thêm vào đầu container
    const container = document.querySelector('.container-fluid') || document.querySelector('.container') || document.body;
    container.insertBefore(alertDiv, container.firstChild);
    
    // Tự động tắt
    setTimeout(() => {
        hideAlert(alertDiv);
    }, delay);
    
    return alertDiv;
}

// Export functions để sử dụng ở nơi khác
window.showAlert = showAlert;
window.hideAlert = hideAlert;
