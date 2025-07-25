<?php
include_once __DIR__ . '../../../core/PDOFactory.php';
include_once __DIR__ . '/../partials/header.php';

?>
<link href="/css/stylehomePage.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <div class="container mb-3"> <?php include_once __DIR__ . '/../partials/navbar.php'; ?></div>


    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-5">
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div id="success-alert" class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
            unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
        }
        ?>
        <!-- Nội dung của bạn sẽ nằm ở đây -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                   <img src="/images/slider/Home1.png" class="d-block w-100 img-fluid" alt="Home Slide">

                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="/images/slider/Our Story1.png" class="d-block w-100 img-fluid " alt="Story Slide">
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <a href="/bosuatap">
                        <img src="/images/slider/Our Collections1.png" class="d-block w-100 img-fluid" alt="Collections Slide">
                    </a>

                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <img src="/images/slider/Our Clients1.png" class="d-block w-100 img-fluid " alt="Clients Slide">
                </div>
                <!-- Slide 5 -->
                <div class="carousel-item">
                    <a href="/lienhe">
                        <img src="/images/slider/Contact Details1.png" class="d-block w-100 img-fluid " alt="Contact Slide">
                    </a>

                </div>
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
        </div>
        <div class="mt-3">
            <div class="title text-center py-2 ">
                <h2 class="position-relative d-inline-block">Xi măng giả gỗ</h2>
            </div>
            <br>


            <div class="container mainHomePage">
                <!-- Các hình nhỏ bên cạnh -->
                <div class="">
                    <div class="row">
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongan/banan">
                                    <img src="/images/lam.jpg" class="img-fluid" alt="Bàn Ăn">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">LAM</h3>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongngu/giuongngu">
                                    <img src="/images/tran.JPG" class="img-fluid" alt="Giường">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">TRẦN</h3>
                                </a>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongngu/tuao">
                                    <img src="/images/vach.jpg" class="img-fluid" alt="Arm Chair">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">VÁCH</h3>
                                </a>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongan/ghean">
                                    <img src="/images/mattien.png" class="img-fluid" alt="Ghế Ăn">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">MẶT TIỀN</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-3">
            <div class="title text-center py-3">
                <h2 class="position-relative d-inline-block"> <img src="/images/GIF/new-blinking.gif" alt="Hot" class="gif-icon">Sản phẩm<img src="/images/GIF/new-blinking.gif" alt="Hot" class="gif-icon">
                </h2>
            </div>
            <div id="newProductsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-inner">
                    <?php foreach (array_chunk($newProducts, 4) as $index => $productsChunk): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row">
                                <?php foreach ($productsChunk as $product): ?>
                                    <div class="product-item col-md-3">
                                        <div class="special-img position-relative overflow-hidden">
                                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>">
                                                <img src="/images/upload/<?php echo htmlspecialchars($product['images'][0]['image_url']); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                            </a>
                                        </div>
                                        <div class="text-start m-1">
                                            <p class="text-capitalize mt-3 mb-1"><?php echo htmlspecialchars($product['product_name']); ?></p>
                                            <div class="d-flex">
                                                <span class="fw-bold d-block">
                                                    <?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?>
                                                </span>
                                                <?php if (!empty($product['old_price'])) : ?>
                                                    <span class="price-old ms-2">
                                                        <?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-around mb-2">
                                            <form action="/cart/add" method="POST" style="width: 45%;">
                                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định là 1 -->
                                                <button type="submit" class="btn btn-product mt-3 p-2 w-100">Thêm Vào Giỏ</button>
                                            </form>
                                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#newProductsCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#newProductsCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>


        </div>

        <div class="container mb-3">
            <div class="title text-center py-3">
                <h2
                    class="position-relative d-inline-block"> <img src="/images/GIF/ban_chay.gif" alt="Hot" class="gif-icon-2"> Sản Phẩm Bán Chạy<img src="/images/GIF/ban_chay.gif" alt="Hot" class="gif-icon-2">
                </h2>
            </div>
            <div id="bestsellersCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-inner">
                    <?php foreach (array_chunk($bestsellers, 4) as $index => $productsChunk): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row">
                                <?php foreach ($productsChunk as $product): ?>
                                    <div class="product-item col-md-3">
                                        <div class="special-img position-relative overflow-hidden">
                                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>">
                                                <img src="/images/upload/<?php echo htmlspecialchars($product['images'][0]['image_url']); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                            </a>
                                        </div>
                                        <div class="text-start m-1">
                                            <p class="text-capitalize mt-3 mb-1"><?php echo htmlspecialchars($product['product_name']); ?></p>
                                            <div class="d-flex">
                                                <span class="fw-bold d-block">
                                                    <?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?>
                                                </span>
                                                <?php if (!empty($product['old_price'])) : ?>
                                                    <span class="price-old ms-2">
                                                        <?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-around mb-2">
                                            <form action="/cart/add" method="POST" style="width: 45%;">
                                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định là 1 -->
                                                <button type="submit" class="btn btn-product mt-3 p-2 w-100">Thêm Vào Giỏ</button>
                                            </form>
                                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#bestsellersCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#bestsellersCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>



            <div>
                <!-- Thiết kế thêm 1 số giao diện đẹp tại đây có thể có hinh ảnh để đi tới phòng khách, phòng ngủ,...-->
                <div class="title text-center py-3">
                    <h2 class="position-relative d-inline-block">Không Gian Phòng Đa Dạng Sản Phẩm</h2>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3 product-item">
                        <div class="mt-3">
                            <a href="/phongkhach">
                                <img src="/images/cua.png" class="card-img-top" alt="Phòng Khách">
                            </a>
                            <div class="card-body text-center ">
                                <h5 class="card-title mt-3" style="  font-size: 18px;font-weight: bold;">CỬA</h5>
                                <p class="card-tex mt-3" style="text-align: center;">Thiết kế trần hiện đại, điểm nhấn cho không gian sống.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 product-item">
                        <div class="mt-3">
                            <a href="/phongngu">
                                <img src="/images/banghe.png" class="card-img-top" alt="Phòng Ngủ">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-title mt-3" style="  font-size: 18px;font-weight: bold;">BÀN GHẾ</h5>
                                <p class="card-text mt-3" style="text-align: center;">Tạo điểm nhấn kiến trúc với hệ lam mạnh mẽ và tinh tế.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 product-item">
                        <div class="mt-3" style="background-color: white; box-shadow: none">
                            <a href="/phongan">
                                <img src="/images/san.png" class="card-img-top" alt="Phòng Ăn">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-title mt-3" style="  font-size: 18px;font-weight: bold;">SÀN</h5>
                                <p class="card-text mt-3" style="text-align: center;">Sàn xi măng giả gỗ – bền theo thời gian, đẹp theo xu hướng.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 product-item">
                        <div class="mt-3">
                            <a href="/phongan">
                                <img src="/images/banghieu.png" class="card-img-top" alt="Phòng Ăn">
                            </a>
                            <div class="card-body text-center">
                                <h5 class="card-title mt-3" style="  font-size:18px;font-weight: bold;">BẢNG HIỆU</h5>
                                <p class="card-text mt-3" style="text-align: center;">Nâng tầm chuyên nghiệp với bảng hiệu hiện đại, sắc nét.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script>
        // Tự động ẩn thông báo sau 2 giây
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 3000); // 2000ms = 2 giây
    </script>
</body>

</html>