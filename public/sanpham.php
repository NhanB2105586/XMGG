<?php
include_once __DIR__ . '/../src/partials/header.php';
include_once __DIR__ . '/../src/dp.php';
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
            <?php
            // Truy vấn lấy danh sách sản phẩm từ cơ sở dữ liệu
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Lặp qua từng sản phẩm và hiển thị
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-item">';
                    echo '<img class="product-image default-image" src="' . $row["image_url"] . '" alt="' . htmlspecialchars($row["name"]) . '">';
                    echo '<img class="product-image hover-image" src="' . $row["hover_image_url"] . '" alt="' . htmlspecialchars($row["name"]) . ' hover">';
                    echo '<div class="product-name">' . htmlspecialchars($row["name"]) . '</div>';
                    echo '<div class="product-price">' . number_format($row["price"], 0, ",", ".") . 'đ</div>';
                    echo '<div class="product-actions">';
                    echo '<button class="add-to-cart-btn">THÊM VÀO GIỎ</button>';
                    echo '<button class="view-more-btn">XEM THÊM</button>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Không có sản phẩm nào.";
            }
            ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>

</html>