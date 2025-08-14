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
                Cửa Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/cua"> <strong class="current-page">Cửa Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cửa chính</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cửa phòng ngủ</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cửa phòng bếp</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cửa ban công</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cửa sân vườn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Cửa tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cua/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Cửa</h6>
                            <p class="text-muted">Cửa làm từ khung sắt ốp xi măng giả gỗ giúp tăng độ chắc chắn, tạo điểm nhấn mạnh mẽ và sang trọng cho công trình.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cua/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Cửa chính xi măng giả gỗ</h6>
                            <p class="text-muted">Cửa chính với thiết kế sang trọng, tạo ấn tượng mạnh cho công trình. Vật liệu xi măng giả gỗ đảm bảo độ bền và an toàn.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cua/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Cửa phòng ngủ xi măng giả gỗ</h6>
                            <p class="text-muted">Cửa phòng ngủ với thiết kế nhẹ nhàng, tạo không gian riêng tư. Vật liệu cách âm tốt, đảm bảo sự yên tĩnh.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/cua/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Cửa ban công xi măng giả gỗ</h6>
                            <p class="text-muted">Cửa ban công chống thấm tốt, phù hợp với không gian ngoài trời. Thiết kế đa dạng với nhiều kiểu dáng khác nhau.</p>
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