<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link rel="stylesheet" href="/css/stylegiohang.css">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    
    <!-- Main Container -->
    <div class="container my-5">
        <div class="row">
            <!-- Favorite Items -->
            <div class="col-lg-8 mt-5">
                <h2>Sản phẩm yêu thích của bạn</h2>

                <?php 
                // Debug: Kiểm tra biến favorites
                echo "<!-- Debug: favorites count = " . (isset($favorites) ? count($favorites) : 'undefined') . " -->";
                if (!empty($favorites)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">Sản phẩm</th>
                            <th class="text-center align-middle">Giá</th>
                            <th class="text-center align-middle">Ngày yêu thích</th>
                            <th class="text-center align-middle">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($favorites as $favorite) : ?>
                        <tr class="align-middle">
                            <td class="text-center align-middle">
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                    <?php
                                    // Sửa đường dẫn hình ảnh
                                    $img = '';
                                    if (!empty($favorite['image_url'])) {
                                        // Kiểm tra nếu là URL tuyệt đối
                                        if (strpos($favorite['image_url'], 'http') === 0) {
                                            $img = $favorite['image_url'];
                                        } 
                                        // Kiểm tra nếu đã có /images/ trong đường dẫn
                                        elseif (strpos($favorite['image_url'], '/images/') === 0) {
                                            $img = $favorite['image_url'];
                                        }
                                                                                    // Thêm /images/imageupload/ nếu chưa có
                                            else {
                                                // Loại bỏ dấu / ở đầu nếu có
                                                $imagePath = ltrim($favorite['image_url'], '/');
                                                $img = '/images/imageupload/' . $imagePath;
                                            }
                                    } else {
                                        $img = '/images/default.jpg';
                                    }
                                    
                                    // Debug: In ra đường dẫn hình ảnh
                                    echo "<!-- Debug: Image path = " . htmlspecialchars($img) . " -->";
                                    ?>
                                                                         <img src="<?php echo htmlspecialchars($img); ?>"
                                         alt="Product Image"
                                         style="width: 100px; height: 100px; object-fit:cover; border-radius:8px; border:1px solid #eee; margin-bottom: 6px;">
                                                                         <div style="font-size: 14px; font-weight: 500; color: #333; margin-top: 4px; word-break: break-word; max-width: 120px; text-align: center;">
                                        <?php echo htmlspecialchars($favorite['product_name']); ?>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo number_format($favorite['price'], 0, ',', '.') . 'đ'; ?></td>
                            <td class="text-center">
                                <?php
                                // Hiển thị ngày giờ yêu thích từ trường created_at (không phải favorited_at)
                                if (!empty($favorite['created_at'])) {
                                    echo date('d/m/Y H:i', strtotime($favorite['created_at']));
                                } else {
                                    echo '<span class="text-muted">Không xác định</span>';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                                                 <div class="d-flex justify-content-center align-items-center gap-2" style="gap: 6px;">
                                     <button class="btn btn-success btn-sm" style="width: 36px; height: 36px; border-radius: 50%; padding: 0; display: flex; align-items: center; justify-content: center;" onclick="addToCart(<?php echo $favorite['product_id']; ?>)" title="Thêm vào giỏ hàng">
                                         <i class="fas fa-shopping-cart"></i>
                                     </button>
                                     <button class="btn btn-danger btn-sm" style="width: 36px; height: 36px; border-radius: 50%; padding: 0; display: flex; align-items: center; justify-content: center;" onclick="removeFavorite(<?php echo $favorite['product_id']; ?>)" title="Bỏ yêu thích">
                                         <i class="fas fa-heart-broken"></i>
                                     </button>
                                 </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else : ?>
                <div class="text-center py-5">
                    <i class="fas fa-heart-broken" style="font-size: 4rem; color: #ddd;"></i>
                    <h3 class="mt-3">Chưa có sản phẩm yêu thích</h3>
                    <p class="text-muted">Bạn chưa yêu thích sản phẩm nào. Hãy khám phá và yêu thích những sản phẩm bạn thích!</p>
                    <a href="/sanpham" class="btn btn-primary">Khám phá sản phẩm</a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Summary -->
            <div class="col-lg-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Tóm tắt yêu thích</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tổng sản phẩm yêu thích:</span>
                            <span class="fw-bold"><?php echo count($favorites); ?></span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <a href="/sanpham" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-shopping-bag"></i> Tiếp tục mua sắm
                            </a>
                            <a href="/giohang" class="btn btn-outline-primary w-100">
                                <i class="fas fa-shopping-cart"></i> Xem giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function removeFavorite(productId) {
        if (confirm('Bạn có chắc muốn bỏ yêu thích sản phẩm này?')) {
            fetch('/remove-favorite', {
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
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra');
            });
        }
    }

    function addToCart(productId) {
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
                alert(data.message);
                updateCartCount();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra');
        });
    }

    function updateCartCount() {
        const cartBadge = document.querySelector('.cart-badge');
        if (cartBadge) {
            const currentCount = parseInt(cartBadge.textContent) || 0;
            cartBadge.textContent = currentCount + 1;
        }
    }
    // Gắn lại sự kiện cho các nút sau khi DOM đã sẵn sàng
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-danger').forEach(btn => {
            btn.onclick = function() {
                const productId = this.getAttribute('onclick').match(/\d+/)[0];
                removeFavorite(productId);
            };
        });
        document.querySelectorAll('.btn-success').forEach(btn => {
            btn.onclick = function() {
                const productId = this.getAttribute('onclick').match(/\d+/)[0];
                addToCart(productId);
            };
        });
    });
    </script>
    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>
