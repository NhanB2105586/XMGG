<?php
include_once __DIR__ . '../../../core/PDOFactory.php';
include_once __DIR__ . '/../partials/header.php';
?>
<link href="/css/stylesofa.css" rel="stylesheet">

<body>
    <!-- Navbar -->
     <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-5">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner">
            <div class="banner-text">
                Sofa
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp; <a href="/phongkhach.php">Phòng khách</a>/&nbsp<a
                        href="/sanpham/sofa.php"> <strong class="current-page">Sofa</strong></a>
                </div>
            </div>
        </div>

        <!-- Phần bộ lọc sản phẩm -->
        <div class="filter-section">
            <div class="filter-item">
                <label for="price-filter">Giá:</label>
                <select id="price-filter">
                    <option value="popular">Theo mức độ phổ biến</option>
                    <option value="low-to-high">Giá từ thấp đến cao</option>
                    <option value="high-to-low">Giá từ cao đến thấp</option>
                </select>
            </div>

            <div class="filter-item">
                <label for="material-filter">Chất liệu:</label>
                <select id="material-filter">
                    <option value="all">Tất cả</option>
                    <option value="wood">Gỗ</option>
                    <option value="fabric">Vải</option>
                    <option value="leather">Da</option>
                </select>
            </div>

            <button class="apply-filter-btn">ÁP DỤNG</button>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="container mb-3 mt-3">
            <div class="special-list row g-0 ">
                <div class=" product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100" alt="anh">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class=" product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/images/sofa.png" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>