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
                            <span id="inStockDisplay" class="fw-bold">Số lượng còn lại: <?php echo $product['in_stock']; ?></span>
                        <?php else: ?>
                            <span id="inStockDisplay" class="fw-bold text-danger">Hết hàng</span>


                        <?php endif; ?>
                    </div>


                    <!-- Form ẩn để thêm vào giỏ hàng -->
                    <form id="addToCartForm" action="/cart/add" method="POST" style="display: none;">
                        <input type="hidden" name="product_id"
                            value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        <input type="hidden" name="quantity" id="formQuantityInput" value="1">
                    </form>

                    <!-- Form ẩn để mua ngay và thêm vào giỏ hàng -->
                    <form id="buyNowForm" action="/cart/buynow" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

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
                        <p>(**) Không áp dụng cho các sản phẩm Clearance. Chỉ bảo hành 01 năm cho khung ghế đối với Ghế Văn Phòng</p>

                    </div>

                </div>
            </div>
        </div>
        <div class="describe-detail-product">
            <div class="title text-center py-2 title-describe-detail-product">
                <h2 class="position-relative d-inline-block p-1">Chi Tiết Sản Phẩm</h2>
            </div>
            <div class="content-describe-detail-product">
                <?php if (isset($product)): ?>
                    <?php
                    $contents = [
                        htmlspecialchars($product['description']),
                        "Sản phẩm không chỉ mang lại sự tiện nghi cho không gian sống mà còn giúp tối ưu hóa diện tích.",
                    ];

                    // Thêm "Nội dung 3" chỉ khi có 3 ảnh trở lên
                    if (isset($product['images']) && count($product['images']) >= 3) {
                        $contents[] = "Sản phẩm dễ dàng vệ sinh và bảo trì, giúp bạn tiết kiệm thời gian và công sức trong việc chăm sóc ngôi nhà.";
                    }
                    ?>

                    <?php foreach ($contents as $index => $content): ?>
                        <div class="content-detail">
                            <p><?php echo $content; ?></p>

                            <?php if (isset($product['images'][$index])): ?>
                                <img src="/images/upload/<?php echo htmlspecialchars($product['images'][$index]['image_url'] ?? ''); ?>"
                                    alt="<?php echo htmlspecialchars($product['images'][$index]['alt_text'] ?? 'No description'); ?>"
                                    class="d-block w-100 h-100 img-fluid">
                                <br>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có thông tin sản phẩm.</p>
                <?php endif; ?>
            </div>


        </div>


        <div class="detail-product-last mt-4">
            <div class="title text-center py-3">
                <h2 class="position-relative d-inline-block">Sản Phẩm Liên Quan</h2>
            </div>
            <div id="relatedProductsCarousel" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <?php foreach (array_chunk($relatedProducts, 4) as $index => $productsChunk): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="row">
                                <?php foreach ($productsChunk as $product): ?>
                                    <div class="product-item col-md-3">
                                        <div class="special-img position-relative overflow-hidden">
                                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>">
                                                <img src="/images/upload/<?php echo htmlspecialchars($product['images'][0]['image_url']); ?>" class="" alt="<?php echo htmlspecialchars($product['product_name']); ?>" style="height: 200px;">
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
                                        <div class="d-flex justify-content-around mb-2">
                                            <!-- Nút Thêm Vào Giỏ -->
                                            <form action="/cart/add" method="POST" style="width: 45%;">
                                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                                <input type="hidden" name="quantity" value="1"> <!-- Số lượng mặc định là 1 -->
                                                <button type="submit" class="btn btn-product mt-3 p-2 w-100">Thêm Vào Giỏ</button>
                                            </form>
                                            <!-- Nút Chi Tiết -->
                                            <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-product mt-3 p-2 btn-detail-product" style="width: 45%;">Chi Tiết</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Nút điều khiển Carousel -->
                <a class="carousel-control-prev" href="#relatedProductsCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#relatedProductsCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>

            </div>

        </div>


    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

    <script>
        // Lấy giá trị số lượng còn lại từ phần tử có ID 'inStockDisplay'
        const inStockElement = document.getElementById('inStockDisplay');
        const inStockText = inStockElement.textContent;

        // Lấy giá trị số lượng bằng cách kiểm tra nội dung văn bản
        const inStock = inStockText.includes('Hết hàng') ? 0 : parseInt(inStockText.match(/\d+/)[0]);

        console.log(`Số lượng trong kho (frontend): ${inStock}`);

        // Lấy các phần tử DOM
        const quantityInput = document.getElementById('quantityInput');
        const formQuantityInput = document.getElementById('formQuantityInput');
        const buyNowQuantityInput = document.getElementById('buyNowQuantityInput');
        const decrementButton = document.getElementById('button-decrement');
        const incrementButton = document.getElementById('button-increment');
        const addToCartBtn = document.getElementById('addToCartBtn');
        const buyNowBtn = document.getElementById('buyNowBtn');
        const addToCartForm = document.getElementById('addToCartForm');
        const buyNowForm = document.getElementById('buyNowForm');

        /**
         * Kiểm tra và tự động điều chỉnh số lượng khi người dùng nhập
         * @param {number} quantity - Số lượng người dùng nhập
         */
        function updateQuantity(quantity) {
            // Cho phép xóa hết ô input và chỉ kiểm tra khi người dùng nhập lại
            if (quantity === '' || isNaN(quantity)) {
                return;
            }

            quantity = parseInt(quantity);

            // Nếu số lượng nhỏ hơn 1, tự động đặt lại là 1
            if (quantity < 1) {
                quantityInput.value = 1;
            } else if (quantity > inStock) {
                // Nếu số lượng vượt quá hàng trong kho, hiển thị thông báo và đặt lại giá trị tối đa
                showAlert(`Số lượng không thể vượt quá hàng trong kho! Chỉ còn ${inStock} sản phẩm.`);
                quantityInput.value = inStock;
            } else {
                quantityInput.value = quantity;
            }
        }

        /**
         * Hiển thị thông báo lỗi cho người dùng
         * @param {string} message - Nội dung thông báo
         */
        function showAlert(message) {
            alert(message);
        }

        // Sự kiện giảm số lượng
        decrementButton.addEventListener('click', () => {
            let currentQuantity = parseInt(quantityInput.value) || 1;
            updateQuantity(currentQuantity - 1);
        });

        // Sự kiện tăng số lượng
        incrementButton.addEventListener('click', () => {
            let currentQuantity = parseInt(quantityInput.value) || 1;
            updateQuantity(currentQuantity + 1);
        });

        // Sự kiện thay đổi trực tiếp trong ô input
        quantityInput.addEventListener('input', () => {
            let currentQuantity = quantityInput.value;
            updateQuantity(currentQuantity);
        });

        // Xử lý thêm vào giỏ hàng
        addToCartBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value) || 1;
            if (quantity <= inStock) {
                formQuantityInput.value = quantity;
                addToCartForm.submit();
            }
        });

        // Xử lý mua ngay
        buyNowBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value) || 1;
            if (quantity <= inStock) {
                buyNowQuantityInput.value = quantity;
                buyNowForm.submit();
            }
        });
    </script>

</body>