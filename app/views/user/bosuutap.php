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
                <h4 class="fw-bold mb-3">Bộ sưu tập Nhà Xinh</h4>
                <ul class="list-group">
                    <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Mây mới</a></li>
                    <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Moretti</a></li>
                    <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Valente</a></li>
                    <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Orientale</a></li>
                    <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Bridge</a></li>
                    <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Hùng King</a></li>
                    <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Sài Gòn</a></li>
                    <!-- Thêm các mục khác nếu cần -->
                </ul>
            </div>
        </div>

        <!-- Nội dung chính - Các sản phẩm -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="product-card">
                        <img src="/path/to/image1.jpg" alt="Product 1" class="img-fluid rounded">
                        <h5 class="mt-3 fw-bold">Bộ sưu tập Orientale – Câu chuyện của những sự khởi đầu</h5>
                        <p class="text-muted">"ORIENTALE" - một cái tên đầy ý nghĩa với mong muốn tạo ra những kết nối từ khắp nơi trên [...]</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="product-card">
                        <img src="/path/to/image2.jpg" alt="Product 2" class="img-fluid rounded">
                        <h5 class="mt-3 fw-bold">Bộ sưu tập Valente – Tinh hoa của sự sang trọng và tinh tế</h5>
                        <p class="text-muted">Bộ sưu tập Valente - Hành trình chìm đắm vào thế giới của sự tinh tế và sang trọng. Valente [...]</p>
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