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
                Cầu Thang Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/cauthang"> <strong class="current-page">Cầu Thang Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cầu thang trong nhà</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cầu thang ngoài trời</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cầu thang xoắn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cầu thang thẳng</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cầu thang tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cauthang/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Cầu thang</h6>
                            <p class="text-muted">Cầu thang xi măng giả gỗ không chỉ mang lại vẻ đẹp tự nhiên mà còn tạo cảm giác ấm áp và thân thiện cho cả không gian nội thất lẫn ngoại thất.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cauthang/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Cầu thang trong nhà xi măng giả gỗ</h6>
                            <p class="text-muted">Cầu thang trong nhà với thiết kế sang trọng, tạo điểm nhấn cho không gian nội thất. Vật liệu xi măng giả gỗ bền bỉ và dễ bảo trì.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cauthang/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Cầu thang ngoài trời xi măng giả gỗ</h6>
                            <p class="text-muted">Cầu thang ngoài trời chống chịu tốt với thời tiết, phù hợp với không gian sân vườn. Thiết kế đa dạng với nhiều kiểu dáng.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cauthang/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Cầu thang xoắn xi măng giả gỗ</h6>
                            <p class="text-muted">Cầu thang xoắn với thiết kế độc đáo, tiết kiệm không gian. Vật liệu xi măng giả gỗ đảm bảo độ bền và an toàn.</p>
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
