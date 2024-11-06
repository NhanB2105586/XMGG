<?php
include_once __DIR__ . '../../../core/PDOFactory.php';
include_once __DIR__ . '/../partials/header.php';

use App\Core\PDOFactory;
use App\Models\Product;

// Khởi tạo PDO và Model Product
$pdoFactory = new PDOFactory();
$pdo = $pdoFactory->create();
$productModel = new Product($pdo);

// Lấy sản phẩm mới nhất
$newProducts = $productModel->getNewProducts();
?>
<link href="/css/stylehomePage.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <div class="container mb-4"> <?php include_once __DIR__ . '/../partials/navbar.php'; ?></div>


    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-5">
        <!-- Nội dung của bạn sẽ nằm ở đây -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <a href="/sanpham"> <img src="/images/slider/Home.png" class="d-block w-100 " alt="Home Slide"></a>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="/images/slider/Our Story.png" class="d-block w-100 " alt="Story Slide">
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <a href="/bosuatap">
                        <img src="/images/slider/Our Collections.png" class="d-block w-100 "
                            alt="Collections Slide">
                    </a>

                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <img src="/images/slider/Our Clients.png" class="d-block w-100 " alt="Clients Slide">
                </div>
                <!-- Slide 5 -->
                <div class="carousel-item">
                    <a href="/lienhe">
                        <img src="/images/slider/Contact Details.png" class="d-block w-100 " alt="Contact Slide">
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
                <h2 class="position-relative d-inline-block">Khám Phá Không Gian Sống</h2>
            </div>
            <br>
            <div class="container mainHomePage">
                <!-- Các hình nhỏ bên cạnh -->
                <div class="">
                    <div class="row">
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongan/banan">
                                    <img src="/images/ban-an-grace-11.jpg" class="img-fluid" alt="Bàn Ăn">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">BÀN ĂN</h3>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongngu/giuongngu">
                                    <img src="/images/giuong.png" class="img-fluid" alt="Giường">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">GIƯỜNG NGỦ</h3>
                                </a>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongngu/tuao">
                                    <img src="/images/tu-quan-ao-wddct05.jpg" class="img-fluid" alt="Arm Chair">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">TỦ ÁO</h3>
                                </a>

                            </div>
                        </div>
                        <div class="col-md-6 mb-4 col-lg-6">
                            <div class="position-relative">
                                <a href="/phongan/ghean">
                                    <img src="/images/ghe-an-hien-dai-ga22-5-.jpg" class="img-fluid" alt="Ghế Ăn">
                                    <h3 class="position-absolute text-light" style="bottom: 10px; left: 20px;">GHẾ ĂN</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-3">
            <div class="title text-center py-3">
                <h2 class="position-relative d-inline-block"> <img src="/images/GIF/new-blinking.gif" alt="Hot" class="gif-icon"> Sản Phẩm Mới<img src="/images/GIF/new-blinking.gif" alt="Hot" class="gif-icon">
                </h2>
            </div>

            <div class="special-list row g-0 ">
                <?php foreach ($newProducts as $product): ?>
                    <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/<?php echo $product['product_id']; ?>">
                                <img src="/images/upload/<?php echo htmlspecialchars($product['image_url']); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1"><?php echo htmlspecialchars($product['product_name']); ?></p>
                            <div class="d-flex">
                                <span class="fw-bold d-block"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></span>
                                <span class="price-old"><?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                            <a href="/chitietsanpham/<?php echo $product['product_id']; ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="container mb-3">
            <div class="title text-center py-3">
                <h2
                    class="position-relative d-inline-block"> <img src="/images/GIF/ban_chay.gif" alt="Hot" class="gif-icon-2"> Sản Phẩm Bán Chạy<img src="/images/GIF/ban_chay.gif" alt="Hot" class="gif-icon-2">
                </h2>
            </div>

            <div class="special-list row g-0 ">
                <?php foreach ($newProducts as $product): ?>
                    <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/<?php echo $product['product_id']; ?>">
                                <img src="/images/upload/<?php echo htmlspecialchars($product['image_url']); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1"><?php echo htmlspecialchars($product['product_name']); ?></p>
                            <div class="d-flex">
                                <span class="fw-bold d-block"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></span>
                                <span class="price-old"><?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?></span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                            <a href="/chitietsanpham/<?php echo $product['product_id']; ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                        </div>
                    </div>
                <?php endforeach; ?>
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

</html>