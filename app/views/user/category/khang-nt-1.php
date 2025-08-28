<?php
include_once __DIR__ . '/../partials/header.php';
include_once __DIR__ . '/../../../models/Product.php';
include_once __DIR__ . '/../../../helpers.php';

use App\Core\PDOFactory;
use App\Models\Product;

// Lấy sản phẩm theo danh mục
$products = [];
try {
    $pdo = (new PDOFactory())->create();
    $productModel = new Product($pdo);
    
    // Lấy category_id từ slug
    $categoryModel = new \App\Models\Category($pdo);
    $category = $categoryModel->getCategoryBySlug("khang-nt-1");
    
    if ($category) {
        $products = $productModel->getProductsByCategory($category['category_id']);
    }
} catch (Exception $e) {
    // Nếu có lỗi, products sẽ là array rỗng
}
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
                Khang nt
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;</a>/&nbsp<a href="/category/khang-nt-1"> <strong class="current-page">Khang nt</strong></a>
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
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                            <div class="special-img position-relative overflow-hidden">
                                <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>">
                                    <?php if (!empty($product['main_image']) && $product['main_image'] !== 'default.jpg'): ?>
                                        <img src="/images/imageupload/<?php echo htmlspecialchars($product['main_image']); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <span class="text-muted">Chưa có ảnh</span>
                                        </div>
                                    <?php endif; ?>
                                </a>

                            </div>
                            <div class="text-start m-1">
                                <p class="text-capitalize mt-3 mb-1"><?php echo htmlspecialchars($product['product_name']); ?></p>
                                <div class="d-flex">
                                    <span class="fw-bold d-block"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></span>
                                    <span class="price-old"><?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?></span>
                                </div></div><div class="d-flex justify-content-between gap-2">
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
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <h4>Không có sản phẩm Khang nt nào</h4>
                        <p class="text-muted">Vui lòng quay lại sau hoặc liên hệ với chúng tôi</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <!-- Scripts -->
</body>
</html>