<?php
include_once __DIR__ . '/../../partials/header.php';
include_once __DIR__ . '/../../../models/Product.php';

use App\Core\PDOFactory;
use App\Models\Product;
?>
<link href="/css/stylesanpham.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-5">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner">
            <div class="banner-text">
                Kệ sách
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp; <a href="/phonglamviec">Phòng làm việc</a>/&nbsp<a
                        href="/phonglamviec/kesach"> <strong class="current-page">Kệ sách</strong></a>
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



            <button class="btn apply-filter-btn">ÁP DỤNG</button>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="container mb-3 mt-3">
            <div class="special-list row g-0 ">
                <?php foreach ($products as $product): ?>
                    <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>">
                                <?php
                                // Hiển thị hình ảnh đầu tiên nếu có, nếu không, hiển thị một ảnh mặc định
                                $image_url = !empty($product['images'][0]['image_url']) ? $product['images'][0]['image_url'] : 'default.jpg';
                                ?>
                                <img src="/images/upload/<?php echo htmlspecialchars($image_url); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
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
                            <a href="/products/<?php echo $product['product_id']; ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../../partials/footer.php'; ?>
</body>