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
                Sofa
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp; <a href="/phongkhach">Phòng khách</a>/&nbsp<a
                        href="/phongkhach/sofa"> <strong class="current-page">Sofa</strong></a>
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
                                $image_url = $product['main_image'];
                                ?>
                                <?php if (!empty($image_url) && $image_url !== 'default.jpg'): ?>
                                    <img src="/images/imageupload/<?php echo htmlspecialchars($image_url); ?>" class="w-100" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
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
                            </div>
                        </div>
                     <div class="d-flex justify-content-around">
                            <button class="btn btn-favorite mt-3 p-2 add-favorite" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>" style="width: 30%;">
                                Yêu thích
                            </button>
                            <form action="/cart/add" method="POST" style="width: 30%;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-product mt-3 p-2 w-100">
                                    Thêm Vào Giỏ
                                </button>
                            </form>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý thêm vào yêu thích
    document.querySelectorAll('.add-favorite').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            
            fetch('/add-favorite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'product_id=' + productId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Đã thêm vào danh sách yêu thích!');
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
    
    // Xử lý thêm vào giỏ hàng
    document.querySelectorAll('form[action="/cart/add"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const productId = formData.get('product_id');
            const quantity = formData.get('quantity');
            
            fetch('/cart/add', {
                method: 'POST',
                body: formData
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
});

function updateFavoriteCount() {
    const favoriteBadge = document.querySelector('.favorite-badge');
    if (favoriteBadge) {
        const currentCount = parseInt(favoriteBadge.textContent) || 0;
        favoriteBadge.textContent = currentCount + 1;
    }
}

function updateCartCount() {
    const cartBadge = document.querySelector('.cart-badge');
    if (cartBadge) {
        const currentCount = parseInt(cartBadge.textContent) || 0;
        cartBadge.textContent = currentCount + 1;
    }
}
</script>
    <?php include_once __DIR__ . '/../partials/foot.php'; ?>
</body>