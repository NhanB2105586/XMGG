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
                Bộ sưu tập
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/bosuutap"> <strong class="current-page">Bộ sưu tập</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Bộ sưu tập Quý Nhân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Orientale</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Valente</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Mây mới</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Ogami</a></li>
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
                            <h5 class="mt-3 fw-bold">
                                Bộ sưu tập Orientale – Câu chuyện về những khởi đầu mới</h5>
                            <p class="text-muted">"ORIENTALE" – một cái tên mang ý nghĩa sâu sắc, thể hiện khát vọng kết nối từ khắp nơi [...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/2.png" alt="Product 2" class="img-fluid rounded">
                            <h5 class="mt-3 fw-bold">Bộ sưu tập Valente – Tinh túy của sự sang trọng và thanh nhã</h5>
                            <p class="text-muted">Bộ sưu tập Valente - Một cuộc hành trình đắm chìm vào vương quốc của sự tinh tế và sang trọng. Valente [...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/3.png" alt="Product 2" class="img-fluid rounded">
                            <h5 class="mt-3 fw-bold">Bộ sưu tập Mây Mới – Sự dịu dàng tinh tế trong từng chi tiết</h5>
                            <p class="text-muted">Quý Nhân hân hạnh giới thiệu Bộ sưu tập Mây Mới - cảm hứng từ vẻ đẹp giản dị và thanh tao [...]</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/bosuutap/4.png" alt="Product 2" class="img-fluid rounded">
                            <h5 class="mt-3 fw-bold">Bộ sưu tập Ogami – Hòa quyện giữa truyền thống và hiện đại</h5>
                            <p class="text-muted">Bộ sưu tập mới nhất của thương hiệu nội thất Quý Nhân, mang tên “Ogami”, thể hiện một cách khéo léo chất Á Đông trong từng thiết kế [...]</p>
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