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
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>
