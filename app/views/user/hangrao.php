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
                Hàng Rào Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/hangrao"> <strong class="current-page">Hàng Rào Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Hàng rào nhà phố</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Hàng rào biệt thự</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Hàng rào sân vườn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Hàng rào công trình</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Hàng rào tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/hangrao/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Hàng rào</h6>
                            <p class="text-muted">Hàng rào xi măng giả gỗ là giải pháp lý tưởng cho không gian ngoài trời với độ bền cao, tạo sự riêng tư và an toàn cho công trình.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/hangrao/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Hàng rào nhà phố xi măng giả gỗ</h6>
                            <p class="text-muted">Hàng rào nhà phố với thiết kế hiện đại, phù hợp với không gian đô thị. Vật liệu xi măng giả gỗ bền bỉ và dễ bảo trì.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/hangrao/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Hàng rào biệt thự xi măng giả gỗ</h6>
                            <p class="text-muted">Hàng rào biệt thự với thiết kế sang trọng, tạo không gian riêng tư cho công trình cao cấp. Vật liệu chất lượng cao.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/hangrao/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Hàng rào sân vườn xi măng giả gỗ</h6>
                            <p class="text-muted">Hàng rào sân vườn tạo không gian xanh mát, kết hợp hài hòa với thiên nhiên. Thiết kế đa dạng phù hợp mọi phong cách.</p>
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
