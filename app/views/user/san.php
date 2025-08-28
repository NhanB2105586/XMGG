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
                Sàn Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/san"> <strong class="current-page">Sàn Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Sàn phòng khách</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Sàn phòng ngủ</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Sàn phòng bếp</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Sàn ban công</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Sàn sân vườn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Sàn tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/san/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Sàn</h6>
                            <p class="text-muted">Sàn xi măng giả gỗ là giải pháp lý tưởng cho không gian ngoài trời với độ bền cao, không bị cong vênh hay mục nát như gỗ thật.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/san/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Sàn xi măng giả gỗ cho phòng khách</h6>
                            <p class="text-muted">Sàn phòng khách với thiết kế sang trọng, tạo không gian đón tiếp ấm cúng. Vật liệu xi măng giả gỗ đảm bảo độ bền và dễ bảo trì.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/san/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Sàn xi măng giả gỗ cho ban công</h6>
                            <p class="text-muted">Sàn ban công chống thấm tốt, phù hợp với không gian ngoài trời. Thiết kế đa dạng với nhiều mẫu mã khác nhau.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/san/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Sàn xi măng giả gỗ cho sân vườn</h6>
                            <p class="text-muted">Sàn sân vườn tạo không gian xanh mát, kết hợp hài hòa với thiên nhiên. Vật liệu bền bỉ chống chịu tốt với thời tiết.</p>
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
