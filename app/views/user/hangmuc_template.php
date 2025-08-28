<?php
include_once __DIR__ . '/../../core/PDOFactory.php';
include_once __DIR__ . '/../partials/header.php';

// Include HangmucProducts model directly
require_once __DIR__ . '/../../models/hangmuc_products.php';

use App\Core\PDOFactory;
use App\Models\HangmucProducts;

// Lấy sản phẩm theo hạng mục
$products = [];
try {
    $pdo = (new PDOFactory())->create();
    $hangmucProductsModel = new HangmucProducts($pdo);
    $products = $hangmucProductsModel->getProductsByHangmucSlug($slug);
} catch (Exception $e) {
    // Nếu có lỗi, products sẽ là array rỗng
}

// Lấy thông tin hạng mục
$hangmucInfo = [
    'tran' => ['name' => 'Trần Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach'],
    'lam' => ['name' => 'Lam Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach'],
    'san' => ['name' => 'Sàn Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach'],
    'vach' => ['name' => 'Vách Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach'],
    'cua' => ['name' => 'Cửa Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach'],
    'cauthang' => ['name' => 'Cầu Thang Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach'],
    'hangrao' => ['name' => 'Hàng Rào Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach'],
    'bonhoa' => ['name' => 'Bồn Hoa, Bàn, Ghế Xi Măng Giả Gỗ', 'banner' => 'top-banner-phongkhach']
];

$hangmucName = $hangmucInfo[$slug]['name'] ?? 'Hạng Mục';
$bannerClass = $hangmucInfo[$slug]['banner'] ?? 'top-banner-phongkhach';
?>

<link href="/css/stylebosuutap.css" rel="stylesheet">
<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">
        <!-- Phần hình ảnh trên cùng -->
        <div class="<?php echo $bannerClass; ?>">
            <div class="banner-text">
                <?php echo $hangmucName; ?>
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/<?php echo $slug; ?>"> <strong class="current-page"><?php echo $hangmucName; ?></strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row mt-4 nd">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Đại Quân</h4>
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark"><?php echo $hangmucName; ?> phòng khách</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark"><?php echo $hangmucName; ?> phòng ngủ</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark"><?php echo $hangmucName; ?> phòng bếp</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark"><?php echo $hangmucName; ?> phòng tắm</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark"><?php echo $hangmucName; ?> văn phòng</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="#" class="text-decoration-none text-dark"><?php echo $hangmucName; ?> tùy chỉnh</a></li>
                    </ul>
                </div>
            </div>

            <!-- Nội dung chính - Các sản phẩm -->
            <div class="col-md-9">
                <div class="row">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-6 mb-4">
                                <div class="product-card">
                                    <?php if ($product['image_path']): ?>
                                        <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" class="img-fluid rounded">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    <h6 class="mt-3 fw-bold"><?php echo htmlspecialchars($product['title']); ?></h6>
                                    <p class="text-muted"><?php echo htmlspecialchars($product['description']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-boxes fa-4x mb-4"></i>
                                    <h4>Chưa có sản phẩm nào</h4>
                                    <p class="mb-4">Sản phẩm sẽ được hiển thị sau khi admin thêm vào</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
