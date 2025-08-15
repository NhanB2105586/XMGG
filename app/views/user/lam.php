<?php
<<<<<<< HEAD
include_once __DIR__ . '../../../core/PDOFactory.php';
include_once __DIR__ . '/../partials/header.php';
?>
<link href="/css/stylebosuutap.css" rel="stylesheet">
=======
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylesanpham.css" rel="stylesheet">
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">
<<<<<<< HEAD
        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-phongkhach">
            <div class="banner-text">
                Lam Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/lam"> <strong class="current-page">Lam Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam phòng khách</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam phòng ngủ</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam ban công</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam sân vườn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam văn phòng</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Lam</h6>
                            <p class="text-muted">Các công trình sử dụng lam xi măng giả gỗ không chỉ giúp chắn nắng mà còn mang lại tính thẩm mỹ hiện đại, mạch lạc cho không gian ngoại thất.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Lam xi măng giả gỗ cho ban công</h6>
                            <p class="text-muted">Lam ban công với thiết kế thông minh, vừa chắn nắng vừa tạo không gian riêng tư. Vật liệu xi măng giả gỗ chống chịu tốt với thời tiết.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Lam xi măng giả gỗ cho sân vườn</h6>
                            <p class="text-muted">Lam sân vườn tạo không gian xanh mát, kết hợp hài hòa với thiên nhiên. Thiết kế đa dạng phù hợp với mọi phong cách kiến trúc.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Lam xi măng giả gỗ cho văn phòng</h6>
                            <p class="text-muted">Lam văn phòng với thiết kế chuyên nghiệp, tạo không gian làm việc thoải mái và hiệu quả. Vật liệu bền bỉ phù hợp môi trường công sở.</p>
                        </div>
                    </div>
                </div>
=======

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
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
            </div>
        </div>
    </div>

    <!-- Footer -->
<<<<<<< HEAD
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>
=======
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
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
