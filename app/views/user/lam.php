<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylesanpham.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-sp">
            <div class="banner-text">
                Lam
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/lam"> <strong class="current-page">Lam</strong></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần bộ lọc sản phẩm -->
    <div class="filter-section">
        <div class="filter-item">
            <label for="price-filter">Lọc:</label>
            <select id="price-filter">
                <option value="popular">Theo mức độ phổ biến</option>
                <option value="low-to-high">Giá từ thấp đến cao</option>
                <option value="high-to-low">Giá từ cao đến thấp</option>
            </select>
        </div>

        <button class="btn apply-filter-btn" id="apply-filter">ÁP DỤNG</button>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="container mb-3 mt-3">
        <div class="title text-center py-3">
            <h2 class="position-relative d-inline-block">Sản phẩm Lam</h2>
        </div>
        <p class="text-center">Khám phá các sản phẩm lam chất lượng cao</p>
        
        <div class="special-list row g-0">
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/5">
                        <img src="/images/upload/lam1.jpg" class="w-100" alt="Lam xi măng giả gỗ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Lam xi măng giả gỗ cao cấp</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.800.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="5" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="5" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/5" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                        Chi Tiết
                    </a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/6">
                        <img src="/images/upload/lam2.jpg" class="w-100" alt="Lam trang trí">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Lam trang trí hiện đại</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.500.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="6" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="6" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/6" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                        Chi Tiết
                    </a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/7">
                        <img src="/images/upload/lam3.jpg" class="w-100" alt="Lam phòng khách">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Lam phòng khách sang trọng</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">2.200.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="7" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="7" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/7" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                        Chi Tiết
                    </a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/8">
                        <img src="/images/upload/lam4.jpg" class="w-100" alt="Lam phòng ngủ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Lam phòng ngủ ấm cúng</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.900.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="8" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="8" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/8" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                        Chi Tiết
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script>
        // Xử lý nút yêu thích
        document.querySelectorAll('.add-favorite').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                
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
                        updateFavoriteCount();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra');
                });
            });
        });

        // Xử lý nút thêm vào giỏ hàng
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                
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
                        updateCartCount();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra');
                });
            });
        });

        // Cập nhật số lượng yêu thích
        function updateFavoriteCount() {
            const favoriteBadge = document.querySelector('.favorite-badge');
            if (favoriteBadge) {
                const currentCount = parseInt(favoriteBadge.textContent) || 0;
                favoriteBadge.textContent = currentCount + 1;
            }
        }

        // Cập nhật số lượng giỏ hàng
        function updateCartCount() {
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                const currentCount = parseInt(cartBadge.textContent) || 0;
                cartBadge.textContent = currentCount + 1;
            }
        }
    </script>
</body> 