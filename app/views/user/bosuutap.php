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
                Công trình đã thi công
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/bosuutap"> <strong class="current-page">Tin tức</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2022</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2023</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2024</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">2025</a></li>
                        <!-- Thêm các mục khác nếu cần -->
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/1.png" alt="Product 1" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">
                                Những công trình mà Đại Quân đã thi công - Hạng mục Lam</h6>
                            <p class="text-muted">Các công trình sử dụng lam xi măng giả gỗ không chỉ giúp chắn nắng mà còn mang lại tính thẩm mỹ hiện đại, mạch lạc cho không gian ngoại thất. [...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/2.png" alt="Product 2" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Trần</h6>
                            <p class="text-muted">Hệ trần sử dụng vật liệu xi măng giả gỗ mang lại cảm giác ấm áp và sang trọng, bền vững với thời gian.[...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/3.png" alt="Product 2" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Vách</h6>
                            <p class="text-muted">Các vách xi măng giả gỗ được thiết kế để phân tách không gian một cách nhẹ nhàng, vẫn đảm bảo sự thông thoáng và tính thẩm mỹ cao.[...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/4.png" alt="Product 2" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Cửa</h6>
                            <p class="text-muted">Cửa làm từ khung sắt ốp xi măng giả gỗ giúp tăng độ chắc chắn, tạo điểm nhấn mạnh mẽ và sang trọng cho công trình.[...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/4.png" alt="Product 2" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Sàn</h6>
                            <p class="text-muted">Sàn xi măng giả gỗ là giải pháp lý tưởng cho không gian ngoài trời với độ bền cao, không bị cong vênh hay mục nát như gỗ thật.[...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/4.png" alt="Product 2" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Tường</h6>
                            <p class="text-muted">Ốp tường bằng xi măng giả gỗ không chỉ mang lại vẻ đẹp tự nhiên mà còn tạo cảm giác ấm áp và thân thiện cho cả không gian nội thất lẫn ngoại thất.[...]</p>
                        </div>
                    </div>
                      <!-- Thêm các sản phẩm khác -->
                </div>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>