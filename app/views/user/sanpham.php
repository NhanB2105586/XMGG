<?php
include_once __DIR__ . '/../partials/header.php';
include_once __DIR__ . '/../../models/Product.php';
include_once __DIR__ . '/../../helpers.php';
?>

<link href="/css/stylesanpham.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-sp">
            <div class="banner-text">
                Sản phẩm
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/sanpham"> <strong class="current-page">Sản
                            phẩm</strong></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần bộ lọc sản phẩm -->
    <div class="filter-section">
        <div class="filter-item">
            <label for="price-filter">Lọc:</label>
            <select id="price-filter">
                <option value="popular" <?= ($filter === 'popular') ? 'selected' : '' ?>>Theo mức độ phổ biến</option>
                <option value="low-to-high" <?= ($filter === 'low-to-high') ? 'selected' : '' ?>>Giá từ thấp đến cao</option>
                <option value="high-to-low" <?= ($filter === 'high-to-low') ? 'selected' : '' ?>>Giá từ cao đến thấp</option>
            </select>
        </div>

        <button class="btn apply-filter-btn" id="apply-filter">ÁP DỤNG</button>
    </div>


    <!-- Danh sách sản phẩm -->
    <!-- Phần danh sách sản phẩm -->
    <div class="container mb-3 mt-3">
        <div class="title text-center py-3">
            <h2 class="position-relative d-inline-block">Danh sách sản phẩm</h2>
        </div>
        <?php if (!empty($query)): ?>
            <p class="text-center">Kết quả tìm kiếm cho: "<strong><?php echo htmlspecialchars($query); ?></strong>"</p>
        <?php endif; ?>
        <div class="special-list row g-0">
            <?php if (!empty($products)) : ?>
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
                        
                        </div>

                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">Mua</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">Không có sản phẩm nào mới.</p>
            <?php endif; ?>
        </div>

        <!-- Phân trang -->
        <div class="text-center">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo !empty($query) ? '&query=' . urlencode($query) : ''; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <!-- Scripts -->
    <script src="/js/script.js"></script>

    <script>
        document.getElementById('apply-filter').addEventListener('click', function() {
            const filterValue = document.getElementById('price-filter').value;
            window.location.href = '?filter=' + filterValue; // Chuyển hướng với bộ lọc
        });
    </script>
</body>

</html>
