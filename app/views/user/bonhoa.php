<?php
include_once __DIR__ . '/../partials/header.php';
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
                Trần
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/tran"> <strong class="current-page">Trần</strong></a>
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
    <!--Danh sách sản phẩm -->
        <div class="container mb-3 mt-3">
            <div class="title text-center py-3">
                <h2 class="position-relative d-inline-block">Giải pháp cho trần nhà</h2>
            </div>
            <p class="text-center">Khám phá các giải pháp thi công và trang trí trần mang lại sự bền vững và thẩm mỹ cho không gian sống</p>
            
            <div class="special-list row g-0">
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/hangmuc/tran.jpg" class="w-100" alt="Giải pháp thi công trần">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Thi công trần bền đẹp</p>
                        <p class="text-muted">Ứng dụng các vật liệu tiên tiến giúp thi công trần chắc chắn, chống ẩm mốc và chịu lực tốt.</p>
                    </div>
                </div>

                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/hangmuc/tran1.png" class="w-100" alt="Trang trí trần hiện đại">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Trang trí trần hiện đại</p>
                        <p class="text-muted">Thiết kế trần mang hơi thở hiện đại, phù hợp nhiều phong cách nội thất khác nhau.</p>
                    </div>
                </div>

                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/hangmuc/tran2.png" class="w-100" alt="Trần nhà tối ưu không gian">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Tối ưu không gian trần</p>
                        <p class="text-muted">Giải pháp bố trí trần giúp không gian thông thoáng, tối ưu ánh sáng và lưu thông không khí.</p>
                    </div>
                </div>

                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <img src="/hangmuc/tran3.jpg" class="w-100" alt="Vật liệu cho trần nhà">
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">Vật liệu phù hợp cho trần</p>
                        <p class="text-muted">Lựa chọn vật liệu an toàn, bền vững và dễ dàng bảo trì cho các hạng mục trần nội – ngoại thất.</p>
                    </div>
                </div>
            </div>
        </div>



    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script>
        document.getElementById('apply-filter').addEventListener('click', function() {
            const filterValue = document.getElementById('price-filter').value;
            window.location.href = '?filter=' + filterValue;
        });
    </script>
</body>

</html> 