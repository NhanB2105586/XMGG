<?php
include_once __DIR__ . '../../../../core/PDOFactory.php';
include_once __DIR__ . '/../../partials/header.php';
?>
<link href="/css/stylephong.css" rel="stylesheet">
<link href="/css/image-resize.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../../partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-phonglamviec">
            <div class="banner-text-phonglamviec">
                Phòng làm việc
                <div class="breadcrumb-lv">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/phonglamviec"> <strong class="current-page">Phòng làm việc</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0 fw-bold">
                            <h4>Nội thất phòng làm việc</h4>
                        </li>
                        <li class="list-group-item bg-transparent border-0 fw-bold"><a href="#" class="text-decoration-none text-dark">Mẫu phòng làm việc</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/phonglamviec/banlamviec" class="text-decoration-none text-dark">Bàn làm việc</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/phonglamviec/ghelamviec" class="text-decoration-none text-dark">Ghế làm việc</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/phonglamviec/kesach" class="text-decoration-none text-dark">Kệ sách</a></li>
                        <li class="list-group-item bg-transparent border-0 fw-bold">
                            <h4>Hàng trang trí</h4>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a href="/hangtrangtri/den"
                                class="text-decoration-none text-dark">Đèn trang trí</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/hangtrangtri/binh"
                                class="text-decoration-none text-dark">Bình trang trí</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/hangtrangtri/tranh"
                                class="text-decoration-none text-dark">Tranh trang trí</a></li>
                        <li class="list-group-item bg-transparent border-0 fw-bold">
                    </ul>
                </div>
            </div>


            <!-- Nội dung chính - Các sản phẩm phòng làm việc -->
            <div class="col-md-9">
                <div class="product-grid">
                    <!-- Sản phẩm 1 -->
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/19">
                                <img class="product-image" src="/images/bosuutap/1.png" alt="Phòng làm việc Ogami">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Độc đáo, trẻ trung với phòng làm việc Ogami</p>
                            <p class="product-description">Ogami thổi một làn gió trẻ trung vào không gian [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="19" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="19" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="19" style="flex: 1;">Mua</button>
                        </div>
                    </div>

                    <!-- Sản phẩm 2 -->
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/20">
                                <img class="product-image" src="/images/bosuutap/2.png" alt="Phòng làm việc Orientale">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng làm việc Orientale – Không gian của cảm hứng và sự bình yên</p>
                            <p class="product-description">Với sự chăm chút tỉ mỉ trong từng chi tiết, [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="20" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="20" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="20" style="flex: 1;">Mua</button>
                        </div>
                    </div>

                    <!-- Sản phẩm 3 -->
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/21">
                                <img class="product-image" src="/images/bosuutap/3.png" alt="Phòng làm việc hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="21" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="21" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="21" style="flex: 1;">Mua</button>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/22">
                                <img class="product-image" src="/images/bosuutap/4.png" alt="Phòng làm việc hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="22" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="22" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="22" style="flex: 1;">Mua</button>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/23">
                                <img class="product-image" src="/images/bosuutap/1.png" alt="Phòng làm việc hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="23" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="23" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="23" style="flex: 1;">Mua</button>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/24">
                                <img class="product-image" src="/images/bosuutap/2.png" alt="Phòng làm việc hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="24" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="24" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="24" style="flex: 1;">Mua</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../../partials/footer.php'; ?>

    <!-- Scripts -->
    <script src="/js/script.js"></script>
 </body>

</html>
