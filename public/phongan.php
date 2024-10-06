<?php
include_once __DIR__ . '/../src/partials/header.php';
include_once __DIR__ . '/../src/dp.php';
?>
<link href="/css/stylephongan.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../src/partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner">
            <div class="banner-text">
                Phòng ăn
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/phongan.php"> <strong class="current-page">Phòng ăn</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0 fw-bold">
                            <h4>Nội thất phòng ăn</h4>
                        </li>
                        <li class="list-group-item bg-transparent border-0 fw-bold"><a href="#" class="text-decoration-none text-dark">Mẫu phòng ăn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/sanpham/sofa.php" class="text-decoration-none text-dark">Bàn ăn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Ghế ăn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Ghế bar</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Tủ ly</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark">Tủ bếp</a></li>
                    </ul>
                </div>
            </div>


            <!-- Nội dung chính - Các sản phẩm phòng khách -->
            <div class="col-md-9">
                <div class="product-grid">
                    <!-- Sản phẩm 1 -->
                    <div class="product-item">
                        <img class="product-image" src="/logo/phongkhach/mau/coastal.png" alt="Phòng khách Ogami">
                        <div class="product-name">Độc đáo, trẻ trung với phòng khách Ogami</div>
                        <p class="product-description">Ogami thổi một làn gió trẻ trung vào không gian [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>

                    <!-- Sản phẩm 2 -->
                    <div class="product-item">
                        <img class="product-image" src="/logo/phongkhach/mau/ogami.png" alt="Phòng khách Orientale">
                        <div class="product-name">Phòng khách Orientale – Không gian của cảm hứng và sự bình yên</div>
                        <p class="product-description">Với sự chăm chút tỉ mỉ trong từng chi tiết, [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>

                    <!-- Sản phẩm 3 -->
                    <div class="product-item">
                        <img class="product-image" src="/logo/phongkhach/mau/ogami.png" alt="Phòng khách hiện đại">
                        <div class="product-name">Phòng khách Modern – Đơn giản nhưng không kém phần sang trọng</div>
                        <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>

</html>