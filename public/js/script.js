// Script chung cho website
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script loaded successfully');
    
    // Xử lý nút yêu thích - Tránh duplicate event listeners
    document.querySelectorAll('.add-favorite').forEach(button => {
        // Kiểm tra xem button đã có event listener chưa
        if (!button.hasAttribute('data-favorite-initialized')) {
            button.setAttribute('data-favorite-initialized', 'true');
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                console.log('Click nút yêu thích - Product ID:', productId);
                
                fetch('/add-favorite', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'product_id=' + encodeURIComponent(productId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        // Tự động reset trang để cập nhật
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra');
                });
            });
        }
    });

    // Xử lý nút thêm vào giỏ hàng - Tránh duplicate event listeners
    document.querySelectorAll('.add-to-cart').forEach(button => {
        // Kiểm tra xem button đã có event listener chưa
        if (!button.hasAttribute('data-cart-initialized')) {
            button.setAttribute('data-cart-initialized', 'true');
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                const buttonText = this.textContent.trim();
                console.log('Click nút:', buttonText, '- Product ID:', productId);
                
                            // Kiểm tra nếu là nút "Mua" (có text "Mua")
            if (buttonText === 'Mua' || buttonText.includes('Mua')) {
                console.log('Nút Mua được click - redirecting to /thanhtoan');
                // Nút "Mua" - chuyển đến trang thanh toán
                fetch('/ajax-add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'product_id=' + encodeURIComponent(productId) + '&quantity=1'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Chuyển đến trang thanh toán
                        window.location.href = '/thanhtoan';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra');
                });
            } else {
                    // Nút "Thêm Vào Giỏ" - thêm vào giỏ hàng bình thường
                    fetch('/ajax-add-to-cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'product_id=' + encodeURIComponent(productId) + '&quantity=1'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Đã thêm vào giỏ hàng!');
                            // Tự động reset trang để cập nhật
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra');
                    });
                }
            });
        }
    });

    // Cập nhật số lượng yêu thích
    function updateFavoriteCount() {
        fetch('/get-favorite-count')
            .then(response => response.json())
            .then(data => {
                const favoriteBadge = document.querySelector('.favorite-badge');
                if (favoriteBadge) {
                    favoriteBadge.textContent = data.count;
                }
            });
    }

    // Cập nhật số lượng giỏ hàng
    function updateCartCount() {
        fetch('/get-cart-count')
            .then(response => response.json())
            .then(data => {
                const cartBadge = document.querySelector('.cart-badge');
                if (cartBadge) {
                    cartBadge.textContent = data.count;
                }
            });
    }

    // Cập nhật trạng thái số lượng
    function updateStockStatus(productId) {
        fetch('/get-product-stock/' + productId)
            .then(response => response.json())
            .then(data => {
                const productItem = document.querySelector('[data-product-id="' + productId + '"]').closest('.product-item');
                const stockStatus = productItem.querySelector('.stock-status');
                const addToCartBtn = productItem.querySelector('.add-to-cart');
                
                if (data.in_stock > 0) {
                    stockStatus.innerHTML = '<span class="badge bg-success">Còn ' + data.in_stock + ' sản phẩm</span>';
                    if (addToCartBtn) {
                        addToCartBtn.disabled = false;
                        addToCartBtn.textContent = 'Thêm Vào Giỏ';
                        addToCartBtn.className = 'btn btn-product mt-3 p-2 add-to-cart';
                    }
                } else {
                    stockStatus.innerHTML = '<span class="badge bg-danger">Hết hàng</span>';
                    if (addToCartBtn) {
                        addToCartBtn.disabled = true;
                        addToCartBtn.textContent = 'Hết Hàng';
                        addToCartBtn.className = 'btn btn-secondary mt-3 p-2';
                    }
                }
            });
    }

    // Xử lý filter sản phẩm
    const applyFilterBtn = document.getElementById('apply-filter');
    if (applyFilterBtn) {
        applyFilterBtn.addEventListener('click', function() {
            const filterValue = document.getElementById('price-filter').value;
            window.location.href = '?filter=' + filterValue;
        });
    }

    // Tự động ẩn thông báo sau 3 giây
    setTimeout(function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000);

    // Modal user info được xử lý trong navbar.php để tránh xung đột

    // Xử lý dropdown menu - Chỉ cho mobile, không can thiệp vào desktop hover
    if (window.innerWidth <= 768) {
        const dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                e.preventDefault();
                const menu = this.nextElementSibling;
                if (menu) {
                    menu.classList.toggle('show');
                }
            });
        });

        // Đóng dropdown khi click ra ngoài (chỉ mobile)
        document.addEventListener('click', function(e) {
            if (!e.target.matches('.dropdown-toggle')) {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                dropdowns.forEach(dropdown => {
                    if (dropdown.classList.contains('show')) {
                        dropdown.classList.remove('show');
                    }
                });
            }
        });
    }

    // Xử lý form tìm kiếm
    const searchForm = document.querySelector('form[action="/sanpham"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('input[name="query"]');
            if (!searchInput.value.trim()) {
                e.preventDefault();
                alert('Vui lòng nhập từ khóa tìm kiếm');
            }
        });
    }

    // Xử lý responsive menu
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
    }

    // Smooth scroll cho anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Lazy loading cho images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Xử lý responsive cho dropdown menu
    window.addEventListener('resize', function() {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        if (window.innerWidth > 768) {
            // Desktop: xóa class show để tránh xung đột với hover
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });
    
    console.log('Event listeners attached successfully');
}); 