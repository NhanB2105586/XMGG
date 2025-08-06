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
                Hàng rào
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/hangrao"> <strong class="current-page">Hàng rào</strong></a>
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
            <h2 class="position-relative d-inline-block">Sản phẩm Vách</h2>
        </div>
        <p class="text-center">Khám phá các sản phẩm vách chất lượng cao</p>
        
        <div class="special-list row g-0">
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/1">
                        <img src="/images/upload/vach1.jpg" class="w-100" alt="Vách xi măng giả gỗ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Vách xi măng giả gỗ cao cấp</p>
                    <p class="text-muted">Các vách xi măng giả gỗ được thiết kế để phân tách không gian một cách nhẹ nhàng, vẫn đảm bảo sự thông thoáng và tính thẩm mỹ cao.</p>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/2">
                        <img src="/images/upload/vach2.jpg" class="w-100" alt="Vách trang trí">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Vách trang trí hiện đại</p>
                    <p class="text-muted">Vách trang trí với hoa văn đẹp mắt, phù hợp cho các không gian hiện đại và sang trọng.</p>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/3">
                        <img src="/images/upload/vach3.jpg" class="w-100" alt="Vách phòng khách">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Vách phòng khách sang trọng</p>
                    <p class="text-muted">Vách phòng khách với thiết kế sang trọng, tạo điểm nhấn cho không gian sống.</p>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="/chitietsanpham/4">
                        <img src="/images/upload/vach4.jpg" class="w-100" alt="Vách phòng ngủ">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Vách phòng ngủ ấm cúng</p>
                    <p class="text-muted">Vách phòng ngủ với thiết kế ấm cúng, tạo cảm giác thư thái và thoải mái.</p>
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