<?php
include_once __DIR__ . '/../partials/header.php';
include_once __DIR__ . '/../../models/Product.php';
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
            <label for="price-filter">Giá:</label>
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

                        <div class="d-flex justify-content-around">
                            <form action="/cart/add" method="POST" style="width: 45%;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định là 1 -->
                                <button type="submit" class="btn btn-product mt-3 p-2 w-100">Thêm Vào Giỏ</button>
                            </form>
                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
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