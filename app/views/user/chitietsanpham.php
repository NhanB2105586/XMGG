<?php
include_once __DIR__ . '/../partials/header.php';
?>
<link href="/css/stylesanpham.css" rel="stylesheet">
<link href="/css/stylechitiet.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container main-detail-product">
        <!-- Phần hình ảnh trên cùng -->
        <div class="breadcrumb">
            <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="#"><strong class="current-page"><?php echo htmlspecialchars($product['product_name']); ?></strong></a>
        </div>
        <div class="row detail-product-first">

            <div id="carouselExample" class="detail-product-slider carousel slide col-lg-6 col-sm-12" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <?php foreach ($images as $index => $image): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="/images/upload/<?php echo htmlspecialchars($images[$index]['image_url'] ?? ''); ?>" class="d-block img-fluid" alt="Product Image">
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls (Previous/Next buttons) -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators hidden-slider">
                    <?php foreach ($images as $index => $image): ?>
                        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>" style="width: 100px;">
                            <img src="/images/upload/<?php echo htmlspecialchars($images[$index]['image_url'] ?? ''); ?>" class="d-block img-thumbnail img-fluid" />
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="detail-product">
                    <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                    <div>
                        <span class="fw-bold">Mã sản phẩm:</span>
                        <span><?php echo htmlspecialchars($product['product_id']); ?></span>
                    </div>
                    <div class="d-flex">
                        <h3 class="m-2 fw-bold"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></h3>
                        <?php if (!empty($product['old_price'])): ?>
                            <del class="m-1"><?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?></del>
                        <?php endif; ?>
                    </div>
                    <div>
                        <button class=" color-product active bg-color-product1"></button>
                        <button class=" color-product bg-color-product2"></button>
                        <button class=" color-product bg-color-product3"></button>
                        <button class=" color-product bg-color-product5"></button>
                    </div>
                    <div>
                        <span class="fw-bold">Kích thước:</span>
                        <span><?php echo htmlspecialchars($product['size']); ?></span>
                    </div>
                    <div>
                        <span class="fw-bold">Chất liệu:</span>
                        <span><?php echo htmlspecialchars($product['material']); ?></span>
                    </div>
                    <div class="quantity ">
                        <button class="decrease" id="button-decrement">-</button>
                        <input class="text-center" id="quantityInput" type="number" value="1" min="1"
                            style="width:50px">
                        <button class="increase" id="button-increment">+</button>
                    </div>
                    <div class="btn-group-product row">
                        <button class="btn hidden-btn ">THÊM VÀO GIỎ</button>
                        <button class="btn hidden-btn">MUA NGAY</button>
                    </div>

                    <div class="product-notes mt-3">
                        <p>✔ Miễn phí giao hàng & lắp đặt tại tất cả quận huyện thuộc TP.Cần Thơ, Hậu Giang, Vĩnh Long (*)</p>
                        <p>✔ Miễn phí 1 đổi 1 - Bảo hành 2 năm - Bảo trì trọn đời (**) </p>
                        <p>(*) Không áp dụng cho danh mục Đồ Trang Trí</p>
                        <p>(**) Không áp dụng cho các sản phẩm Clearance. Chỉ bảo hành 01 năm cho khung ghế, mâm và cần đối với Ghế Văn Phòng</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="describe-detail-product">
            <div class="title text-center py-2 title-describe-detail-product">
                <h2 class="position-relative d-inline-block p-1">Chi Tiết Sản Phẩm</h2>
            </div>
            <div class="content-describe-detail-product">
                <?php foreach ($details as $index => $detail): ?>
                    <div class="content-detail">
                        <!-- Hiển thị nội dung từ bảng `product_details` -->
                        <h4><?php echo htmlspecialchars($detail['content'] ?? ''); ?></h4>

                        <!-- Hiển thị ảnh tương ứng từ bảng `product_images` nếu có -->
                        <?php if (isset($images[$index])): ?>
                            <img src="/images/upload/<?php echo htmlspecialchars($images[$index]['image_url'] ?? ''); ?>"
                                alt="<?php echo htmlspecialchars($images[$index]['alt_text'] ?? 'No description'); ?>"
                                class="d-block w-100 h-100 img-fluid">
                            <br>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <div class="detail-product-last mt-4">
            <div class="title text-center py-3">
                <h2 class="position-relative d-inline-block">Sản Phẩm Liên Quan</h2>
            </div>

            <div class="special-list row g-0 ">
                <div class=" product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="images/tu-quan-ao-wddct05.jpg" class="w-100">
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
                        <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="images/tu-quan-ao-wddct05.jpg" class="w-100">
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
                        <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="images/tu-quan-ao-wddct05.jpg" class="w-100">
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
                        <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3 ">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="images/tu-quan-ao-wddct05.jpg" class="w-100">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tủ quần áo</p>
                        <div class="d-flex">
                            <span class="fw-bold d-block ">20.000.000đ</span>
                            <p class=" price-old ">23.000.000đ</p>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2 " style="width: 45%;">Thêm Vào
                            Giỏ</a>
                        <a href="#" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi
                            Tiết</a>
                    </div>
                </div>
                <a href="#" class="detailLink" style="display: none;"></a>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-secondary m-3" style="width: 200px;">Xem thêm</a>
            </div>
        </div>

    </div>
    <!--Script-->
    <script src="/js/script.js"></script>
    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>