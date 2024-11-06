<?php
session_start();
include_once __DIR__ . '/../app/models/PDOFactory.php';
include_once __DIR__ . '/../app/partials/header.php';

// Assuming you store the cart items in a session:
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../app/partials/navbar.php'; ?>

    <!-- Main Container -->
    <div class="container my-5">
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8 mt-5">
                <h2 class="mb-4">Giỏ hàng</h2>
                <?php if (count($cart_items) > 0): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?php echo $item['image']; ?>" class="img-fluid rounded-start"
                                        alt="<?php echo $item['name']; ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                        <p class="card-text">pa_vat_lieu: <?php echo $item['material']; ?></p>
                                        <p class="card-text">pa_kich_thuoc: <?php echo $item['size']; ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold"><?php echo number_format($item['price']); ?>đ</span>
                                            <form method="POST" action="update_cart.php">
                                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $total += $item['price']; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Giỏ hàng của bạn đang trống!</p>
                <?php endif; ?>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tóm tắt đơn hàng</h4>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Thành tiền:
                                <strong><?php echo number_format($total); ?>đ</strong>
                            </li>
                            <li class="list-group-item">
                                Vận chuyển: <strong>Liên hệ phí vận chuyển sau</strong>
                            </li>
                            <li class="list-group-item">
                                <form action="apply_coupon.php" method="POST" class="input-group">
                                    <input type="text" name="coupon_code" class="form-control"
                                        placeholder="Mã giảm giá">
                                    <button type="submit" class="btn btn-primary">Sử dụng</button>
                                </form>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Tổng cộng:
                                <strong><?php echo number_format($total); ?>đ</strong>
                            </li>
                        </ul>
                        <a href="/checkout.php" class="btn btn-dark w-100 mb-2">Đặt hàng</a>
                        <a href="/sanpham.php" class="btn btn-secondary w-100">Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../app/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../app/partials/footer.php'; ?>
</body>

</html>