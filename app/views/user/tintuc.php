<?php
include_once __DIR__ . '../../../core/PDOFactory.php';
include_once __DIR__ . '/../partials/header.php';
?>
<link href="/css/stylebosuutap.css" rel="stylesheet">
<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">
        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-phongkhach">
            <div class="banner-text">
                Tin tức & Sự kiện
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/tintuc"> <strong class="current-page">Tin tức</strong></a>
                </div>
            </div>
        </div>

        <!-- Nội dung chính - Các tin tức -->
        <div class="row mt-4 nd">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tintuc/tintuc1.jpg" alt="Xu hướng thiết kế 2024" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Xu hướng thiết kế nội thất 2024 với xi măng giả gỗ</h6>
                            <p class="text-muted">Khám phá những xu hướng thiết kế mới nhất năm 2024, với sự kết hợp hoàn hảo giữa xi măng giả gỗ và các vật liệu hiện đại. Thiết kế hiện đại với các mẫu đa dạng phù hợp với mọi không gian nội thất.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tintuc/tintuc2.png" alt="Công trình tiêu biểu" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Dự án biệt thự cao cấp sử dụng xi măng giả gỗ</h6>
                            <p class="text-muted">Khám phá dự án biệt thự 500m² tại Vĩnh Long, nơi xi măng giả gỗ được ứng dụng một cách nghệ thuật. Vật liệu xi măng giả gỗ đảm bảo độ bền cao và dễ bảo trì.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tintuc/tintuc3.jpg" alt="Hướng dẫn thi công" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Showroom được xây dựng 80% từ xi măng giả gỗ</h6>
                            <p class="text-muted">Xây dựng toàn bộ showroom bằng xi măng giả gỗ với thiết kế hiện đại và bền vững. Màu sắc tự nhiên giúp tạo không gian trưng bày lý tưởng.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/tintuc/tintuc4.jpg" alt="Công nghệ 3D" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Công nghệ cắt CNC từ file 3D</h6>
                            <p class="text-muted">Áp dụng file 3D cho tấm bord. Cắt hoa văn theo yêu cầu của khách hàng với độ chính xác cao. Vật liệu xi măng giả gỗ đảm bảo an toàn cho không gian sử dụng.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>
