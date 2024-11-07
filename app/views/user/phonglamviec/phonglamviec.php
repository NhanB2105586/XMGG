<?php
include_once __DIR__ . '../../../../core/PDOFactory.php';
include_once __DIR__ . '/../../partials/header.php';
?>
<link href="/css/stylephong.css" rel="stylesheet">

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


            <!-- Nội dung chính - Các sản phẩm phòng khách -->
            <div class="col-md-9">
                <div class="product-grid">
                    <!-- Sản phẩm 1 -->
                    <div class="product-item">
                        <img class="product-image" src="/images/bosuutap/1.png" alt="Phòng khách Ogami">
                        <div class="product-name">Độc đáo, trẻ trung với phòng làm việc Ogami</div>
                        <p class="product-description">Ogami thổi một làn gió trẻ trung vào không gian [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>

                    <!-- Sản phẩm 2 -->
                    <div class="product-item">
                        <img class="product-image" src="/images/bosuutap/2.png" alt="Phòng khách Orientale">
                        <div class="product-name">Phòng làm việc Orientale – Không gian của cảm hứng và sự bình yên</div>
                        <p class="product-description">Với sự chăm chút tỉ mỉ trong từng chi tiết, [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>

                    <!-- Sản phẩm 3 -->
                    <div class="product-item">
                        <div class="content"></div>
                        <img class="product-image" src="/images/bosuutap/3.png" alt="Phòng khách hiện đại">
                        <div class="product-name">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</div>
                        <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>
                    <div class="product-item">
                        <div class="content"></div>
                        <img class="product-image" src="/images/bosuutap/4.png" alt="Phòng khách hiện đại">
                        <div class="product-name">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</div>
                        <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>
                    <div class="product-item">
                        <div class="content"></div>
                        <img class="product-image" src="/images/bosuutap/1.png" alt="Phòng khách hiện đại">
                        <div class="product-name">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</div>
                        <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>
                    <div class="product-item">
                        <div class="content"></div>
                        <img class="product-image" src="/images/bosuutap/2.png" alt="Phòng khách hiện đại">
                        <div class="product-name">Phòng làm việc Modern – Đơn giản nhưng không kém phần sang trọng</div>
                        <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        <button class="view-more-btn">XEM CHI TIẾT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../../partials/footer.php'; ?>
</body>

</html>