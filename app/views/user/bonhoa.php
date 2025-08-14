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
                Bồn Hoa, Bàn, Ghế Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/bonhoa"> <strong class="current-page">Bồn Hoa, Bàn, Ghế Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Bồn hoa</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Bàn ngoài trời</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Ghế ngoài trời</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Bộ bàn ghế</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bonhoa/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Bồn hoa, bàn, ghế</h6>
                            <p class="text-muted">Bồn hoa, bàn ghế xi măng giả gỗ là giải pháp lý tưởng cho không gian ngoài trời với độ bền cao, tạo không gian xanh và thân thiện.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bonhoa/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Bồn hoa xi măng giả gỗ</h6>
                            <p class="text-muted">Bồn hoa với thiết kế đa dạng, phù hợp với mọi không gian sân vườn. Vật liệu xi măng giả gỗ chống thấm tốt.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bonhoa/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Bàn ghế ngoài trời xi măng giả gỗ</h6>
                            <p class="text-muted">Bàn ghế ngoài trời với thiết kế thoải mái, phù hợp với không gian sân vườn. Vật liệu bền bỉ chống chịu tốt với thời tiết.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bonhoa/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Bộ bàn ghế xi măng giả gỗ</h6>
                            <p class="text-muted">Bộ bàn ghế với thiết kế đồng bộ, tạo không gian thư giãn lý tưởng. Vật liệu xi măng giả gỗ đảm bảo độ bền và thẩm mỹ.</p>
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