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
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>