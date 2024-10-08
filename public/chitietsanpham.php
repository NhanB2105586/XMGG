<?php
include_once __DIR__ . '/../src/partials/header.php';
include_once __DIR__ . '/../src/dp.php';
?>
<link href="/css/stylesofa.css" rel="stylesheet">


<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../src/partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container main-detail-product">
        <!-- Phần hình ảnh trên cùng -->
        <div class="breadcrumb">
            <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/chitietsanpham.php"> <strong class="current-page">Giường Ngủ
                    Gỗ
                    Tràm</strong></a>
        </div>
        <div class="row detail-product-first">

            <div id="carouselExample" class="detail-product-slider carousel slide col-lg-6 col-sm-12"
                data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item-product carousel-item active">
                        <img src="/images/giuong.png" class="d-block w-100 h-100 img-fluid" alt="Home Slide">
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item carousel-item-product">
                        <img src="/images/giuong.png" class="d-block w-100 h-100 img-fluid" alt="Story Slide">
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item carousel-item-product">
                        <img src="/images/giuong.png" class="d-block w-100 h-100 img-fluid" alt="Collections Slide">
                    </div>

                    <!-- Slide 4 -->
                    <div class="carousel-item carousel-item-product">
                        <img src="/images/giuong.png" class="d-block w-100 h-100 img-fluid" alt="Clients Slide">
                    </div>
                    <!-- Slide 5 -->
                    <div class="carousel-item carousel-item-product">
                        <img src="/images/giuong.png" class="d-block w-100 h-100 img-fluid" alt="Contact Slide">
                    </div>
                </div>

                <!-- Controls (Previous/Next buttons) -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators hidden-slider " style="margin-bottom: -20px;">
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1" style="width: 100px;" class="button-thumbnail">
                        <img class="d-block w-100 img-thumbnail" src="/images/giuong.png" class="img-fluid" />
                    </button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"
                        style="width: 100px;" class="button-thumbnail">
                        <img class="d-block w-100 img-thumbnail" src="/images/giuong.png" class="img-fluid" />
                    </button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"
                        style="width: 100px;" class="button-thumbnail">
                        <img class="d-block w-100 img-thumbnail" src="/images/giuong.png" class="img-fluid" />
                    </button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"
                        style="width: 100px;" class="button-thumbnail">
                        <img class="d-block w-100 img-thumbnail" src="/images/giuong.png" class="img-fluid" />
                    </button>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="4" aria-label="Slide 5"
                        style="width: 100px;" class="button-thumbnail">
                        <img class="d-block w-100 img-thumbnail" src="/images/giuong.png" class="img-fluid" />
                    </button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="detail-product">
                    <h2>Giường Ngủ Gỗ Tràm</h2>
                    <div>
                        <span class="fw-bold">Mã sản phẩm:</span>
                        <span>SP01</span>
                    </div>
                    <div class="d-flex">
                        <div class="bg-color-product1 align-content-center text-center text-white m-1"
                            style="width: 60px;">-40%</div>
                        <h3 class="m-2 fw-bold">16.800.000đ</h3>
                        <del class="m-1">28.000.000đ</del>
                    </div>
                    <div>
                        <button class=" color-product active bg-color-product1"></button>
                        <button class=" color-product bg-color-product2"></button>
                        <button class=" color-product bg-color-product3"></button>
                        <button class=" color-product bg-color-product5"></button>
                    </div>
                    <div>
                        <span class="fw-bold">Kích thước:</span>
                        <span>Dài 200cm x Rộng 180cm x Cao 40cm</span>
                    </div>
                    <div>
                        <span class="fw-bold">Chất liệu:</span>
                        <span><br>- Thân giường: Gỗ tràm tự nhiên, Veneer gỗ sồi tự nhiên <br>
                            - Chân giường: Gỗ cao su tự nhiên <br>
                            - Thanh vạt/ Tấm phản: Gỗ plywood chuẩn CARB-P2 (*) <br>
                            (*) Tiêu chuẩn California Air Resources Board xuất khẩu Mỹ, đảm bảo gỗ không độc hại, an
                            toàn cho sức khỏe</span>
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
                </div>
            </div>
        </div>
        <div class="describe-detail-product">
            <div class="title text-center py-2 title-describe-detail-product">
                <h2 class="position-relative d-inline-block p-1">Chi Tiết Sản Phẩm</h2>
            </div>
            <div class="content-describe-detail-product ">
                <div class="content-detail">
                    <p>Nội dung 1</p>
                    <img src="/images/giuong.png" alt="anh" class="d-block w-100 h-100 img-fluid">
                </div>
                <div class="content-detail">
                    <p>Nội dung 2</p>
                    <img src="/images/giuong.png" alt="anh" class="d-block w-100 h-100 img-fluid">
                </div>
                <div class="content-detail">
                    <p>Nội dung 3</p>
                    <img src="/images/giuong.png" alt="anh" class="d-block w-100 h-100 img-fluid">
                </div>
                <div class="content-detail">
                    <p>Nội dung 4</p>
                    <img src="/images/giuong.png" alt="anh" class="d-block w-100 h-100 img-fluid">
                </div>
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
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>