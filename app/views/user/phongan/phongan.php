<?php
include_once __DIR__ . '../../../../core/PDOFactory.php';
include_once __DIR__ . '/../../partials/header.php';
?>
<link href="/css/stylephong.css" rel="stylesheet">
<link href="/css/image-resize.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../../partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-phongan">
            <div class="banner-text-phongan">
                Phòng ăn
                <div class="breadcrumb-an">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/phongan.php"> <strong class="current-page">Phòng
                            ăn</strong></a>
                </div>
            </div>
        </div>

        <!-- Sidebar danh mục sản phẩm -->
        <div class="row">
            <div class="col-md-3">
                <div class="category-sidebar p-4 bg-light border rounded shadow-sm">
                    <ul class="list-group">
                        <li class="list-group-item bg-transparent border-0 fw-bold">
                            <h4>Nội thất phòng ăn</h4>
                        </li>
                        <li class="list-group-item bg-transparent border-0 fw-bold"><a href="#"
                                class="text-decoration-none text-dark">Mẫu phòng ăn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/phongan/banan"
                                class="text-decoration-none text-dark">Bàn ăn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/phongan/ghean"
                                class="text-decoration-none text-dark">Ghế ăn</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/phongan/tuly"
                                class="text-decoration-none text-dark">Tủ ly</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/phongan/tubep"
                                class="text-decoration-none text-dark">Tủ bếp</a></li>
                        <li class="list-group-item bg-transparent border-0 fw-bold">
                            <h4>Hàng trang trí</h4>
                        </li>
                        <li class="list-group-item bg-transparent border-0"><a href="/hangtrangtri/den"
                                class="text-decoration-none text-dark">Đèn trang trí</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/hangtrangtri/binh"
                                class="text-decoration-none text-dark">Bình trang trí</a></li>
                        <li class="list-group-item bg-transparent border-0"><a href="/hangtrangtri/tranh"
                                class="text-decoration-none text-dark">Tranh trang trí</a></li>
                        <li class="list-group-item bg-transparent border-0 fw-bold">
                    </ul>
                </div>
            </div>


            <!-- Nội dung chính - Các sản phẩm phòng ăn -->
            <div class="col-md-9">
                <div class="product-grid">
                    <!-- Sản phẩm 1 -->
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/13">
                                <img class="product-image" src="/images/bosuutap/1.png" alt="Phòng ăn Ogami">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Độc đáo, trẻ trung với phòng ăn Ogami</p>
                            <p class="product-description">Ogami thổi một làn gió trẻ trung vào không gian [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="13" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="13" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <a href="/chitietsanpham/13" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                                Chi Tiết
                            </a>
                        </div>
                    </div>

                    <!-- Sản phẩm 2 -->
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/14">
                                <img class="product-image" src="/images/bosuutap/2.png" alt="Phòng ăn Orientale">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng ăn Orientale – Không gian của cảm hứng và sự bình yên</p>
                            <p class="product-description">Với sự chăm chút tỉ mỉ trong từng chi tiết, [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="14" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="14" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <a href="/chitietsanpham/14" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                                Chi Tiết
                            </a>
                        </div>
                    </div>

                    <!-- Sản phẩm 3 -->
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/15">
                                <img class="product-image" src="/images/bosuutap/3.png" alt="Phòng ăn hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng ăn Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="15" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="15" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <a href="/chitietsanpham/15" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                                Chi Tiết
                            </a>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/16">
                                <img class="product-image" src="/images/bosuutap/4.png" alt="Phòng ăn hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng ăn Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="16" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="16" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <a href="/chitietsanpham/16" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                                Chi Tiết
                            </a>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/17">
                                <img class="product-image" src="/images/bosuutap/1.png" alt="Phòng ăn hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng ăn Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="17" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="17" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <a href="/chitietsanpham/17" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                                Chi Tiết
                            </a>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="special-img position-relative overflow-hidden">
                            <a href="/chitietsanpham/18">
                                <img class="product-image" src="/images/bosuutap/2.png" alt="Phòng ăn hiện đại">
                            </a>
                        </div>
                        <div class="text-start m-1">
                            <p class="text-capitalize mt-3 mb-1">Phòng ăn Modern – Đơn giản nhưng không kém phần sang trọng</p>
                            <p class="product-description">Thiết kế đơn giản, hiện đại với màu sắc nhẹ nhàng [...]</p>
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <button class="btn btn-product mt-3 p-2 add-favorite" data-product-id="18" style="flex: 1;">
                                Yêu thích
                            </button>
                            <button class="btn btn-product mt-3 p-2 add-to-cart" data-product-id="18" style="flex: 1;">
                                Thêm Vào Giỏ
                            </button>
                            <a href="/chitietsanpham/18" class="btn btn-product mt-3 p-2 btn-detail-product" style="flex: 1;">
                                Chi Tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../../partials/footer.php'; ?>

    <!-- Scripts -->
    <script src="/js/script.js"></script>

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
            const favoriteBadge = document.querySelector('.favorite-badge');
            if (favoriteBadge) {
                const currentCount = parseInt(favoriteBadge.textContent) || 0;
                favoriteBadge.textContent = currentCount + 1;
            }
        }

        // Cập nhật số lượng giỏ hàng
        function updateCartCount() {
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                const currentCount = parseInt(cartBadge.textContent) || 0;
                cartBadge.textContent = currentCount + 1;
            }
        }
    </script>
</body>

</html>
