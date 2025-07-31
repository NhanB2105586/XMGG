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
                        <img src="/images/news/news1.jpg" class="w-100" alt="Xu hướng thiết kế 2024">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Xu hướng thiết kế nội thất 2024 với xi măng giả gỗ</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">15/12/2024</span>
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
                        <img src="/images/news/news2.jpg" class="w-100" alt="Công trình tiêu biểu">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Dự án biệt thự cao cấp sử dụng xi măng giả gỗ</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">10/12/2024</span>
                    </div>
                    <p class="text-muted small">Khám phá dự án biệt thự 500m² tại Vinhomes Central Park, nơi xi măng giả gỗ được ứng dụng một cách nghệ thuật...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/news/news3.jpg" class="w-100" alt="Hướng dẫn thi công">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Hướng dẫn thi công xi măng giả gỗ đúng chuẩn</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">05/12/2024</span>
                    </div>
                    <p class="text-muted small">Bộ hướng dẫn chi tiết từ A-Z về cách thi công xi măng giả gỗ, từ chuẩn bị bề mặt đến hoàn thiện...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/news/news4.jpg" class="w-100" alt="Bảo hành sản phẩm">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Chính sách bảo hành mới - Cam kết chất lượng</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">01/12/2024</span>
                    </div>
                    <p class="text-muted small">Cập nhật chính sách bảo hành mới với thời gian bảo hành lên đến 10 năm cho tất cả sản phẩm...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/news/news5.jpg" class="w-100" alt="Sự kiện triển lãm">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Triển lãm sản phẩm xi măng giả gỗ tại Hà Nội</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">25/11/2024</span>
                    </div>
                    <p class="text-muted small">Sự kiện triển lãm quy mô lớn tại Trung tâm Triển lãm Quốc tế Hà Nội với hơn 100 mẫu sản phẩm mới...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Đọc thêm</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                <div class="special-img position-relative overflow-hidden">
                    <a href="#">
                        <img src="/images/news/news6.jpg" class="w-100" alt="Công nghệ mới">
                    </a>
                </div>
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Công nghệ sản xuất xi măng giả gỗ thế hệ mới</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">20/11/2024</span>
                    </div>
                    <p class="text-muted small">Giới thiệu công nghệ sản xuất 4.0 với máy móc tự động hóa, đảm bảo chất lượng đồng đều...</p>
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