<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylebosuutap.css" rel="stylesheet">
<link href="/css/stylesanpham.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-sp">
            <div class="banner-text">
                Tường
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/tuong"> <strong class="current-page">Tường</strong></a>
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
            <h2 class="position-relative d-inline-block">Sản phẩm Tường</h2>
        </div>
        <p class="text-center">Khám phá các sản phẩm tường chất lượng cao</p>
        
        <div class="special-list row g-0">
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/1">
                        <img src="/images/upload/tuong1.jpg" class="product-image" alt="Tường xi măng giả gỗ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Tường xi măng giả gỗ cao cấp</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.500.000đ</span>
                        <span class="price-old ms-2">1.800.000đ</span>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="btn btn-product-action add-favorite" data-product-id="1">Yêu thích</button>
                    <button class="btn btn-product-action add-to-cart" data-product-id="1">Thêm Vào Giỏ</button>
                    <a href="/chitietsanpham/1" class="btn btn-product-action btn-detail-product">Chi Tiết</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/2">
                        <img src="/images/upload/tuong2.jpg" class="product-image" alt="Tường trang trí">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Tường trang trí hiện đại</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.600.000đ</span>
                        <span class="price-old ms-2">2.000.000đ</span>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="btn btn-product-action add-favorite" data-product-id="2">Yêu thích</button>
                    <button class="btn btn-product-action add-to-cart" data-product-id="2">Thêm Vào Giỏ</button>
                    <a href="/chitietsanpham/2" class="btn btn-product-action btn-detail-product">Chi Tiết</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/3">
                        <img src="/images/upload/tuong3.jpg" class="product-image" alt="Tường phòng khách">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Tường phòng khách sang trọng</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.700.000đ</span>
                        <span class="price-old ms-2">2.100.000đ</span>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="btn btn-product-action add-favorite" data-product-id="3">Yêu thích</button>
                    <button class="btn btn-product-action add-to-cart" data-product-id="3">Thêm Vào Giỏ</button>
                    <a href="/chitietsanpham/3" class="btn btn-product-action btn-detail-product">Chi Tiết</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/4">
                        <img src="/images/upload/tuong4.jpg" class="product-image" alt="Tường phòng ngủ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Tường phòng ngủ ấm cúng</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">1.800.000đ</span>
                        <span class="price-old ms-2">2.200.000đ</span>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="btn btn-product-action add-favorite" data-product-id="4">Yêu thích</button>
                    <button class="btn btn-product-action add-to-cart" data-product-id="4">Thêm Vào Giỏ</button>
                    <a href="/chitietsanpham/4" class="btn btn-product-action btn-detail-product">Chi Tiết</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script>
        document.getElementById('apply-filter').addEventListener('click', function() {
            const filterValue = document.getElementById('price-filter').value;
            window.location.href = '?filter=' + filterValue;
        });
    </script>
</body>

</html>