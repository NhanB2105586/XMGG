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
                Vách Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/vach"> <strong class="current-page">Vách Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Vách phòng khách</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Vách phòng ngủ</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Vách phòng bếp</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Vách ban công</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Vách sân vườn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Vách tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/vach/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Vách</h6>
                            <p class="text-muted">Các vách xi măng giả gỗ được thiết kế để phân tách không gian một cách nhẹ nhàng, vẫn đảm bảo sự thông thoáng và tính thẩm mỹ cao.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/vach/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Vách xi măng giả gỗ cho phòng khách</h6>
                            <p class="text-muted">Vách phòng khách với thiết kế tinh tế, tạo không gian riêng tư mà vẫn đảm bảo sự thông thoáng. Vật liệu xi măng giả gỗ bền bỉ.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/vach/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Vách xi măng giả gỗ cho phòng ngủ</h6>
                            <p class="text-muted">Vách phòng ngủ tạo không gian riêng tư, yên tĩnh cho giấc ngủ. Thiết kế nhẹ nhàng với màu sắc tự nhiên.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/vach/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Vách xi măng giả gỗ cho ban công</h6>
                            <p class="text-muted">Vách ban công chắn gió, tạo không gian riêng tư cho không gian ngoài trời. Vật liệu chống chịu tốt với thời tiết.</p>
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