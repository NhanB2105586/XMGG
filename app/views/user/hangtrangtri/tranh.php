<?php
include_once __DIR__ . '/../../partials/header.php';
include_once __DIR__ . '/../../../models/Product.php';
include_once __DIR__ . '/../../../helpers.php';

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
                Tranh Trang Trí
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;</a>/&nbsp<a
                        href="/hangtrangtri/SUBhangtrangtri"> <strong class="current-page">Tranh Trang Trí</strong></a>
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
                                                                    <img src="/images/imageupload/<?php echo htmlspecialchars($product['main_image']); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                            </a>

                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1"><?php echo htmlspecialchars($product['product_name']); ?></p>
                            <div class="d-flex">
                                <span class="fw-bold d-block"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></span>
                                <span class="price-old"><?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?></span>
                            </div></div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">
                                Yêu thích
                            </button>
                            <?php if ($product['in_stock'] > 0): ?>
                                <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">
                                    Thêm Vào Giỏ
                                </button>
                            <?php else: ?>
                                <button class="btn btn-secondary mt-3 p-2" disabled style="flex: 1;">
                                    Hết Hàng
                                </button>
                            <?php endif; ?>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">Mua</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../../partials/footer.php'; ?>

    <!-- Scripts -->
    <?php include_once __DIR__ . '/../partials/foot.php'; ?>
</body>
</html>
