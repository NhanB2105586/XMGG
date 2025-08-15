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
                Trần Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/tran"> <strong class="current-page">Trần Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Trần phòng khách</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Trần phòng ngủ</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Trần phòng bếp</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Trần phòng tắm</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Trần văn phòng</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Trần tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tran/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Trần</h6>
                            <p class="text-muted">Hệ trần sử dụng vật liệu xi măng giả gỗ mang lại cảm giác ấm áp và sang trọng, bền vững với thời gian. Thiết kế hiện đại với các mẫu đa dạng phù hợp với mọi không gian nội thất.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tran/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Trần xi măng giả gỗ cho phòng khách</h6>
                            <p class="text-muted">Trần phòng khách với thiết kế tinh tế, tạo không gian ấm cúng và sang trọng. Vật liệu xi măng giả gỗ đảm bảo độ bền cao và dễ bảo trì.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tran/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Trần xi măng giả gỗ cho phòng ngủ</h6>
                            <p class="text-muted">Trần phòng ngủ với thiết kế nhẹ nhàng, tạo cảm giác thư thái và dễ chịu. Màu sắc tự nhiên giúp tạo không gian nghỉ ngơi lý tưởng.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tran/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Trần xi măng giả gỗ cho phòng bếp</h6>
                            <p class="text-muted">Trần phòng bếp được thiết kế chống ẩm, dễ lau chùi và bảo trì. Vật liệu xi măng giả gỗ đảm bảo an toàn cho không gian nấu nướng.</p>
                        </div>
                    </div>
                </div>
=======

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-sp">
            <div class="banner-text">
                Trần
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/tran"> <strong class="current-page">Trần</strong></a>
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
            <h2 class="position-relative d-inline-block">Sản phẩm Trần</h2>
        </div>
        <p class="text-center">Khám phá các sản phẩm trần chất lượng cao</p>
        
        <div class="special-list row g-0">
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/1">
                        <img src="/images/upload/tran1.jpg" class="w-100" alt="Trần xi măng giả gỗ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Trần xi măng giả gỗ cao cấp</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">2.500.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="1" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="1" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/1" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                        Chi Tiết
                    </a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/2">
                        <img src="/images/upload/tran2.jpg" class="w-100" alt="Trần trang trí">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Trần trang trí hiện đại</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.800.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="2" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="2" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/2" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                        Chi Tiết
                    </a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/3">
                        <img src="/images/upload/tran3.jpg" class="w-100" alt="Trần phòng khách">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Trần phòng khách sang trọng</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">3.200.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="3" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="3" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/3" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                        Chi Tiết
                    </a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/4">
                        <img src="/images/upload/tran4.jpg" class="w-100" alt="Trần phòng ngủ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Trần phòng ngủ ấm cúng</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">2.800.000đ</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="4" style="flex: 1;">
                        Yêu thích
                    </button>
                    <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="4" style="flex: 1;">
                        Thêm Vào Giỏ
                    </button>
                    <a href="/chitietsanpham/4" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
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
