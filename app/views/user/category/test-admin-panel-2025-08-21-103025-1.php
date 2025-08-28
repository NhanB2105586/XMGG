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
                Test Admin Panel 2025-08-21 10:30:25
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/sanpham">Sản phẩm</a>&nbsp;/&nbsp;<strong class="current-page">Test Admin Panel 2025-08-21 10:30:25</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Phần bộ lọc sản phẩm -->
    <div class="filter-section">
        <div class="filter-item">
            <label for="price-filter">Lọc:</label>
            <select id="price-filter">
                <option value="popular">Theo mức độ phổ biến</option>
                <option value="low-to-high">Giá từ thấp đến cao</option>
                <option value="high-to-low">Giá từ cao đến thấp</option>
            </select>
        </div>
        <button class="btn apply-filter-btn" id="apply-filter">ÁP DỤNG</button>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="container mt-4">
        <div class="row" id="products-container">
            <!-- Sản phẩm sẽ được load bằng AJAX -->
            <div class="col-12 text-center">
                <p>Đang tải sản phẩm...</p>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/foot.php'; ?>

    <script>
        // Load sản phẩm theo danh mục
        document.addEventListener("DOMContentLoaded", function() {
            loadProductsByCategory("test-admin-panel-2025-08-21-103025-1");
        });

        function loadProductsByCategory(categorySlug) {
            fetch(`/api/products?category=${categorySlug}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById("products-container");
                    if (data.products && data.products.length > 0) {
                        container.innerHTML = data.products.map(product => `
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="product-item">
                                    <div class="product-image">
                                        <img src="${product.image_url || '/images/default-product.jpg'}" alt="${product.product_name}">
                                    </div>
                                    <div class="product-info">
                                        <h5>${product.product_name}</h5>
                                        <p class="price">${product.price ? product.price.toLocaleString('vi-VN') + ' VNĐ' : 'Liên hệ'}</p>
                                        <button class="btn btn-primary" onclick="addToCart(${product.product_id})">Thêm vào giỏ</button>
                                    </div>
                                </div>
                            </div>
                        `).join("");
                    } else {
                        container.innerHTML = '<div class="col-12 text-center"><p>Chưa có sản phẩm nào trong danh mục này.</p></div>';
                    }
                })
                .catch(error => {
                    console.error("Lỗi:", error);
                    document.getElementById("products-container").innerHTML = '<div class="col-12 text-center"><p>Có lỗi xảy ra khi tải sản phẩm.</p></div>';
                });
        }
    </script>
</body>
</html>