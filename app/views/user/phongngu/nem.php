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
                Nệm
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp; <a href="/phongngu">Phòng ngủ</a>/&nbsp<a
                        href="/phongngu/nem"> <strong class="current-page">Nệm</strong></a>
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
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                                Chi Tiết
                            </a>
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
    <script>
        // Xử lý nút yêu thích
        document.querySelectorAll('.add-favorite').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                
                fetch('/add-favorite', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'product_id=' + encodeURIComponent(productId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        updateFavoriteCount();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra');
                });
            });
        });

        // Xử lý nút thêm vào giỏ hàng
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                
                fetch('/ajax-add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'product_id=' + encodeURIComponent(productId) + '&quantity=1'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Đã thêm vào giỏ hàng!');
                        updateCartCount();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra');
                });
            });
        });

        // Cập nhật số lượng yêu thích
        function updateFavoriteCount() {
            fetch('/get-favorite-count')
                .then(response => response.json())
                .then(data => {
                    const favoriteBadge = document.querySelector('.favorite-badge');
                    if (favoriteBadge) {
                        favoriteBadge.textContent = data.count;
                    }
                });
        }

        // Cập nhật số lượng giỏ hàng
        function updateCartCount() {
            fetch('/get-cart-count')
                .then(response => response.json())
                .then(data => {
                    const cartBadge = document.querySelector('.cart-badge');
                    if (cartBadge) {
                        cartBadge.textContent = data.count;
                    }
                });
        }
    </script>
</body>