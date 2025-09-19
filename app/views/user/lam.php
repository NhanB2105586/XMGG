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
                Lam Xi Măng Giả Gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/lam"> <strong class="current-page">Lam Xi Măng Giả Gỗ</strong></a>
                </div>
            </div>
        </div>

        <!-- Section mô tả dịch vụ -->
        <div class="service-description-section py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="service-description-card p-4">
                            <h3 class="service-title mb-3">
                                <i class="fas fa-tools me-2"></i>
                                Dịch vụ làm xi măng giả gỗ chuyên nghiệp
                            </h3>
                            <p class="service-description mb-0">
                                Dịch vụ làm xi măng giả gỗ chuyên nghiệp, mang lại vẻ đẹp tự nhiên và bền vững cho mọi công trình.
                            </p>
                            <div class="service-features mt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="feature-item text-center">
                                            <i class="fas fa-palette feature-icon"></i>
                                            <h6 class="feature-title">Vẻ đẹp tự nhiên</h6>
                                            <p class="feature-text">Mang lại vẻ đẹp tự nhiên như gỗ thật</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="feature-item text-center">
                                            <i class="fas fa-shield-alt feature-icon"></i>
                                            <h6 class="feature-title">Bền vững</h6>
                                            <p class="feature-text">Độ bền cao, chống chịu thời tiết tốt</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="feature-item text-center">
                                            <i class="fas fa-home feature-icon"></i>
                                            <h6 class="feature-title">Mọi công trình</h6>
                                            <p class="feature-text">Phù hợp với mọi loại công trình</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam phòng khách</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam phòng ngủ</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam ban công</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam sân vườn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam văn phòng</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Lam tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/1.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Những công trình mà Đại Quân đã thi công - Hạng mục Lam</h6>
                            <p class="text-muted">Các công trình sử dụng lam xi măng giả gỗ không chỉ giúp chắn nắng mà còn mang lại tính thẩm mỹ hiện đại, mạch lạc cho không gian ngoại thất.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/2.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Lam xi măng giả gỗ cho ban công</h6>
                            <p class="text-muted">Lam ban công với thiết kế thông minh, vừa chắn nắng vừa tạo không gian riêng tư. Vật liệu xi măng giả gỗ chống chịu tốt với thời tiết.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/3.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Lam xi măng giả gỗ cho sân vườn</h6>
                            <p class="text-muted">Lam sân vườn tạo không gian xanh mát, kết hợp hài hòa với thiên nhiên. Thiết kế đa dạng phù hợp với mọi phong cách kiến trúc.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="product-card">
                            <img src="/images/lam/4.png" alt="Product" class="img-fluid rounded">
                            <h6 class="mt-3 fw-bold">Lam xi măng giả gỗ cho văn phòng</h6>
                            <p class="text-muted">Lam văn phòng với thiết kế chuyên nghiệp, tạo không gian làm việc thoải mái và hiệu quả. Vật liệu bền bỉ phù hợp môi trường công sở.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <style>
        /* CSS cho section mô tả dịch vụ */
        .service-description-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-top: 3px solid #ffc107;
            border-bottom: 3px solid #ffc107;
        }

        .service-description-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .service-title {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 1.5rem !important;
        }

        .service-title i {
            color: #ffc107;
            font-size: 1.5rem;
        }

        .service-description {
            color: #495057;
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: center;
            font-weight: 500;
            margin-bottom: 2rem !important;
        }

        .service-features {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 1.5rem !important;
        }

        .feature-item {
            padding: 1rem;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #ffc107;
            margin-bottom: 1rem;
        }

        .feature-title {
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .feature-text {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .service-title {
                font-size: 1.5rem;
            }
            
            .service-description {
                font-size: 1rem;
            }
            
            .feature-icon {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .service-description-card {
                padding: 1.5rem !important;
            }
            
            .service-title {
                font-size: 1.3rem;
            }
        }
    </style>
</body>

</html>
