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
                Thông tin & Hỗ trợ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/khac"> <strong class="current-page">Thông tin & Hỗ trợ</strong></a>
                </div>
            </div>
        </div>
    </div>



    <!-- Danh sách thông tin -->
    <div class="container mb-3 mt-3">
        <div class="title text-center py-3">
            <h2 class="position-relative d-inline-block">Thông tin & Hỗ trợ</h2>
        </div>
        <p class="text-center mb-4">Tìm hiểu thêm về sản phẩm xi măng giả gỗ, chính sách bảo hành và quy trình thi công</p>
        
        <div class="row">
            <div class="col-12">
                <div class="info-intro text-center mb-4">
                    <h4 class="text-primary">ℹ️ Thông tin chi tiết</h4>
                    <p class="text-muted">Tìm hiểu về sản phẩm, chính sách bảo hành và quy trình thi công</p>
                </div>
            </div>
        </div>
        
        <div class="special-list row g-0">
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
               
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Về xi măng giả gỗ</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">Thông tin chi tiết</span>
                    </div>
                    <p class="text-muted small">Tìm hiểu về lịch sử, đặc tính kỹ thuật và ứng dụng đa dạng của xi măng giả gỗ trong xây dựng hiện đại...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="/thongtinsanpham" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Xem chi tiết</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
               
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Chính sách bảo hành</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">Cam kết chất lượng</span>
                    </div>
                    <p class="text-muted small">Chính sách bảo hành toàn diện với thời gian bảo hành lên đến 10 năm, dịch vụ hỗ trợ 24/7...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="/chinhsachbaohanh" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Xem chi tiết</a>
                </div>
            </div>
            
            <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
             
                <div class="text-start m-1">
                    <p class="text-capitalize mt-3 mb-1">Quy trình thi công</p>
                    <div class="d-flex">
                        <span class="fw-bold d-block">Hướng dẫn chi tiết</span>
                    </div>
                    <p class="text-muted small">Quy trình thi công chuẩn từ chuẩn bị bề mặt, lắp đặt đến hoàn thiện, đảm bảo chất lượng tối ưu...</p>
                </div>
                <div class="d-flex justify-content-around">
                    <a href="/quytrinhthicong" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 100%;">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>


</body>
         
