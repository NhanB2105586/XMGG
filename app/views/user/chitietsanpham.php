<?php
include_once __DIR__ . '/../partials/header.php';
?>
<link href="/css/stylesanpham.css" rel="stylesheet">
<link href="/css/stylechitiet.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container main-detail-product">
        <!-- Phần hình ảnh trên cùng -->
        <div class="breadcrumb">
            <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="#"><strong
                    class="current-page"><?php echo htmlspecialchars($product['product_name']); ?></strong></a>
        </div>
        <div class="row detail-product-first">

            <div id="carouselExample" class="detail-product-slider carousel slide col-lg-6 col-sm-12"
                data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <?php if (!empty($product['images'])) : ?>
                    <?php foreach ($product['images'] as $index => $image): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="/images/upload/<?php echo htmlspecialchars($image['image_url']); ?>"
                            class="d-block img-fluid" alt="Product Image">
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- Trường hợp không có hình ảnh nào -->
                    <div class="carousel-item active">
                        <img src="/images/upload/default.jpg" class="d-block img-fluid" alt="No Image Available">
                    </div>
                    <?php endif; ?>
                </div>


                <!-- Controls (Previous/Next buttons) -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators hidden-slider">
                    <?php if (!empty($product['images'])) : ?>
                    <?php foreach ($product['images'] as $index => $image): ?>
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $index; ?>"
                        class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true"
                        aria-label="Slide <?php echo $index + 1; ?>" style="width: 100px;">
                        <img src="/images/upload/<?php echo htmlspecialchars($image['image_url']); ?>"
                            class="d-block img-thumbnail img-fluid" />
                    </button>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- Trường hợp không có hình ảnh nào, hiển thị một ảnh mặc định -->
                    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="No Image Available" style="width: 100px;">
                        <img src="/images/upload/default.jpg" class="d-block img-thumbnail img-fluid" />
                    </button>
                    <?php endif; ?>
                </div>

            </div>


            <div class="col-lg-6">
                <div class="detail-product">
                    <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                    <div>
                        <span class="fw-bold">Mã sản phẩm:</span>
                        <span><?php echo htmlspecialchars($product['product_id']); ?></span>
                    </div>
                    <div class="d-flex">
                        <h3 class="m-2 fw-bold"><?php echo number_format($product['price'], 0, ',', '.') . 'đ'; ?></h3>
                        <?php if (!empty($product['old_price'])): ?>
                        <del class="m-1"><?php echo number_format($product['old_price'], 0, ',', '.') . 'đ'; ?></del>
                        <?php endif; ?>
                    </div>
                    <div>
                        <span class="fw-bold">Kích thước:</span>
                        <span>D200cm x R70cm x C74cm</span>
                    </div>
                    <div>
                        <span class="fw-bold">Chất liệu:</span>
                        <span>Gỗ tự nhiên</span>
                    </div>
                    <div class="quantity ">
                        <button class="decrease" id="button-decrement">-</button>
                        <input class="text-center" id="quantityInput" type="number" value="1" min="1"
                            style="width:50px">
                        <button class="increase" id="button-increment">+</button>
                    </div>
                    <div>
                        <?php if ($product['in_stock'] > 0): ?>
                        <span class="fw-bold">Số lượng còn lại:</span> <?php echo $product['in_stock']; ?>
                        <?php else: ?>
                        <span class="fw-bold text-danger">Hết hàng</span>
                        <?php endif; ?>
                    </div>

                    <!-- Form ẩn để thêm vào giỏ hàng -->
                    <form id="addToCartForm" action="/cart/add" method="POST" style="display: none;">
                        <input type="hidden" name="product_id"
                            value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        <input type="hidden" name="quantity" id="formQuantityInput" value="1">
                    </form>

                    <!-- Form ẩn để mua ngay -->
                    <form id="buyNowForm" action="/checkout" method="GET" style="display: none;">
                        <input type="hidden" name="product_id"
                            value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        <input type="hidden" name="quantity" id="buyNowQuantityInput" value="1">
                    </form>

                    <div class="btn-group-product row">
                        <button class="btn hidden-btn " id="addToCartBtn"
                            <?php echo $product['in_stock'] <= 0 ? 'disabled' : ''; ?>>THÊM VÀO GIỎ</button>
                        <button class="btn hidden-btn" id="buyNowBtn"
                            <?php echo $product['in_stock'] <= 0 ? 'disabled' : ''; ?>>MUA NGAY</button>
                    </div>


                    <div class="product-notes mt-3">
                        <p>✔ Miễn phí giao hàng & lắp đặt tại tất cả quận huyện thuộc TP.Cần Thơ, Hậu Giang, Vĩnh Long
                            (*)</p>
                        <p>✔ Miễn phí 1 đổi 1 - Bảo hành 2 năm - Bảo trì trọn đời (**) </p>
                        <p>(*) Không áp dụng cho danh mục Đồ Trang Trí</p>
                        <p>(**) Không áp dụng cho các sản phẩm Clearance. Chỉ bảo hành 01 năm cho khung ghế, mâm và cần
                            đối với Ghế Văn Phòng</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="describe-detail-product">
            <div class="title text-center py-2 title-describe-detail-product">
                <h2 class="position-relative d-inline-block p-1">Chi Tiết Sản Phẩm</h2>
            </div>
            <div class="content-describe-detail-product">
                <?php
                $contents = [
                    "Nội dung 1",
                    "Nội dung 2",
                    "Nội dung 3",
                    // Thêm nội dung khác nếu cần
                ];
                ?>

                <?php foreach ($contents as $index => $content): ?>
                <div class="content-detail">
                    <!-- Hiển thị nội dung cố định -->
                    <p><?php echo $content; ?></p>

                    <!-- Hiển thị ảnh tương ứng từ bảng `product_images` nếu có -->
                    <?php if (isset($product['images'][$index])): ?>
                    <img src="/images/upload/<?php echo htmlspecialchars($product['images'][$index]['image_url'] ?? ''); ?>"
                        alt="<?php echo htmlspecialchars($product['images'][$index]['alt_text'] ?? 'No description'); ?>"
                        class="d-block w-100 h-100 img-fluid">
                    <br>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

        </div>


        <div class="detail-product-last mt-4">
            <div class="title text-center py-3">
                <h2 class="position-relative d-inline-block">Sản Phẩm Liên Quan</h2>
            </div>

            <div class="special-list row g-0">
                <?php if (!empty($relatedProducts)) : ?>
                <?php foreach ($relatedProducts as $relatedProduct): ?>
                <div class="product-item col-md-6 col-lg-4 col-xl-3 p-2 mb-3">
                    <div class="special-img position-relative overflow-hidden">
                        <a href="/chitietsanpham/<?php echo htmlspecialchars($relatedProduct['product_id']); ?>">
                            <?php
                                    // Hiển thị hình ảnh đầu tiên nếu có, nếu không, hiển thị một ảnh mặc định
                                    $relatedImageUrl = !empty($relatedProduct['images'][0]['image_url']) ? $relatedProduct['images'][0]['image_url'] : 'default.jpg';
                                    ?>
                            <img src="/images/upload/<?php echo htmlspecialchars($relatedImageUrl); ?>" class="w-100"
                                alt="<?php echo htmlspecialchars($relatedProduct['product_name']); ?>">
                        </a>
                    </div>
                    <div class="text-start m-1">
                        <p class="text-capitalize mt-3 mb-1">
                            <?php echo htmlspecialchars($relatedProduct['product_name']); ?></p>
                        <div class="d-flex">
                            <span class="fw-bold d-block">
                                <?php echo number_format($relatedProduct['price'], 0, ',', '.') . 'đ'; ?>
                            </span>
                            <?php if (!empty($relatedProduct['old_price'])) : ?>
                            <span class="price-old ms-2">
                                <?php echo number_format($relatedProduct['old_price'], 0, ',', '.') . 'đ'; ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <a href="#" class="btn btn-product mt-3 p-2" style="width: 45%;">Thêm Vào Giỏ</a>
                        <a href="/chitietsanpham/<?php echo htmlspecialchars($relatedProduct['product_id']); ?>"
                            class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                <p class="text-center">Không có sản phẩm liên quan.</p>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-secondary m-3" style="width: 200px;">Xem thêm</a>
            </div>
        </div>

    </div>
    <!--Script-->
    <script src="/js/script.js"></script>
    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>


    <script>
    // Số lượng hàng trong kho
    const inStock = <?php echo $product['in_stock']; ?>;

    // Các phần tử DOM
    const quantityInput = document.getElementById('quantityInput');
    const formQuantityInput = document.getElementById('formQuantityInput');
    const buyNowQuantityInput = document.getElementById('buyNowQuantityInput');
    const decrementButton = document.getElementById('button-decrement');
    const incrementButton = document.getElementById('button-increment');
    const addToCartBtn = document.getElementById('addToCartBtn');
    const buyNowBtn = document.getElementById('buyNowBtn');
    const addToCartForm = document.getElementById('addToCartForm');
    const buyNowForm = document.getElementById('buyNowForm');

    // Sự kiện giảm số lượng
    decrementButton.addEventListener('click', () => {
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity;
        } else {
            alert("Số lượng không thể nhỏ hơn 1.");
        }
    });

    // Sự kiện tăng số lượng
    incrementButton.addEventListener('click', () => {
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity < inStock) {
            quantityInput.value = currentQuantity;
        } else {
            alert("Số lượng không thể vượt quá hàng trong kho!");
        }
    });

    // Sự kiện khi thay đổi trực tiếp trong ô input
    quantityInput.addEventListener('input', () => {
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > inStock) {
            alert("Số lượng không thể vượt quá hàng trong kho!");
            quantityInput.value = inStock;
        } else if (currentQuantity < 1) {
            alert("Số lượng không thể nhỏ hơn 1.");
            quantityInput.value = 1;
        }
    });

    // Xử lý thêm vào giỏ hàng
    addToCartBtn.addEventListener('click', () => {
        let quantity = parseInt(quantityInput.value);
        if (quantity > inStock) {
            alert("Số lượng không thể vượt quá hàng trong kho!");
        } else if (quantity < 1) {
            alert("Số lượng không thể nhỏ hơn 1.");
        } else {
            // Cập nhật số lượng trong form và submit
            formQuantityInput.value = quantity;
            addToCartForm.submit();
        }
    });

    // Xử lý mua ngay
    buyNowBtn.addEventListener('click', () => {
        let quantity = parseInt(quantityInput.value);
        if (quantity > inStock) {
            alert("Số lượng không thể vượt quá hàng trong kho!");
        } else if (quantity < 1) {
            alert("Số lượng không thể nhỏ hơn 1.");
        } else {
            // Cập nhật số lượng trong form và submit
            buyNowQuantityInput.value = quantity;
            buyNowForm.submit();
        }
    });
    </script>
</body>