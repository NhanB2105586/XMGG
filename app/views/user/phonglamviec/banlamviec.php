<?php
    include_once __DIR__ . '/../partials/header.php';
    include_once __DIR__ . '/../../models/Product.php';

use App\Core\PDOFactory;
use App\Models\Product;


// Khởi tạo kết nối PDO và model Product
$pdoFactory = new PDOFactory();
$pdo = $pdoFactory->create();
$productModel = new Product($pdo);
// Lấy danh sách sản phẩm
$products = $productModel->getAllProducts();
?>
?>
<link href="/css/stylesanpham.css" rel="stylesheet">

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
                <?php foreach ($products as $product): ?>
                    <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                        <div class="special-img position-relative overflow-hidden">
                            <img src="/images/upload/<?php echo htmlspecialchars($product['image_url']); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
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
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>