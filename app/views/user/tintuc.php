<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylesanpham.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-sp">
            <div class="banner-text">
                Tin tức
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/tintuc"> <strong class="current-page">Tin tức</strong></a>
                </div>
            </div>
        </div>
    </div>



    <!-- Danh sách tin tức -->
    <div class="container mb-3 mt-3">
        <div class="title text-center py-3">
            <h2 class="position-relative d-inline-block">Tin tức & Sự kiện</h2>
        </div>
        <p class="text-center mb-4">Cập nhật những tin tức mới nhất về sản phẩm, xu hướng thiết kế và các sự kiện đặc biệt của chúng tôi</p>
        
        <div class="row">
            <div class="col-12">
                <div class="news-intro text-center mb-4">
                    <h4 class="text-primary">📰 Tin tức mới nhất</h4>
                    <p class="text-muted">Khám phá những xu hướng thiết kế, công nghệ mới và dự án tiêu biểu</p>
                </div>
            </div>
        </div>
        
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/tintuc/tintuc1.png" class="w-100" alt="Xu hướng thiết kế 2024">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Xu hướng thiết kế nội thất 2024 với xi măng giả gỗ</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">15/08/2025</span>
                    </div>
                    <p class="text-muted small">Khám phá những xu hướng thiết kế mới nhất năm 2024, với sự kết hợp hoàn hảo giữa xi măng giả gỗ và các vật liệu hiện đại...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/tintuc/tintuc2.png" class="w-100" alt="Công trình tiêu biểu">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Dự án biệt thự cao cấp sử dụng xi măng giả gỗ</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">10/02/2025</span>
                    </div>
                    <p class="text-muted small">Khám phá dự án biệt thự 500m² tại Vĩnh Long, nơi xi măng giả gỗ được ứng dụng một cách nghệ thuật...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/tintuc/tintuc3.png" class="w-100" alt="Hướng dẫn thi công">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Showroom được xây dựng 80% từ xi măng giả gỗ</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">05/12/2024</span>
                    </div>
                    <p class="text-muted small">Xây dựng toàn bộ showroom bằng xi măng giả gỗ...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
           
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/tintuc/3d.jpg" class="w-100" alt="Hướng dẫn thi công">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Công nghệ cắt CNC từ file 3D3D</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">02/08/2025</span>
                    </div>
                    <p class="text-muted small">Áp dụng file 3D cho tấm bord. Cắt hoa văn theo yêu cầu của khách hàng...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>


</body> 