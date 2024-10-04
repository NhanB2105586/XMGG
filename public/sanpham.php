<?php
require_once __DIR__ . '/../src/bootstrap.php';
include_once __DIR__ . '/../src/partials/header.php';

?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../src/partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner">
            <div class="banner-text">
                Sản phẩm
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/sanpham.php"> <strong class="current-page">Sản phẩm</strong></a>
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
        <div class="product-grid">
            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="product-grid">
            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="product-grid">
            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>

            <div class="product-item">
                <img class="product-image default-image" src="/logo/dssanpham/ghe1.jpg" alt="Armchair Doulton vintage">
                <img class="product-image hover-image" src="/logo/dssanpham/ghe1.1.jpg" alt="Armchair Doulton vintage hover">
                <div class="product-name">Armchair Doulton vintage</div>
                <div class="product-price">28,500,000đ</div>
                <div class="product-actions">
                    <button class="add-to-cart-btn">THÊM VÀO GIỎ</button>
                    <button class="view-more-btn">XEM THÊM</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>

</html>