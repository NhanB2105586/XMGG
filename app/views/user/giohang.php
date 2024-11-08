<?php
include_once __DIR__ . '../../../core/PDOFactory.php';
include_once __DIR__ . '/../partials/header.php';

// Assuming you store the cart items in a session:
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

<link rel="stylesheet" href="/css/stylegiohang.css">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <?php if (isset($_SESSION['error_message'])) : ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>


    <?php if (isset($_SESSION['success_message'])) : ?>
    <div class="alert alert-success text-center">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <!-- Main Container -->
    <div class="container my-5">
        <div class="row">

            <!-- Cart Items -->
            <div class="col-lg-8 mt-5">
                <h2>Giỏ hàng của bạn</h2>

                <?php if (!empty($cartItems)) : ?>
                <form action="/cart/update" method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">Sản phẩm</th>
                                <th class="text-center align-middle">Giá</th>
                                <th class="text-center align-middle">Số lượng</th>
                                <th class="text-center align-middle">Tổng</th>
                                <th class="text-center align-middle">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach ($cartItems as $item) : ?>
                            <tr class="align-middle">
                                <td>
                                    <img src="/images/upload/<?php echo htmlspecialchars($item['image_url'] ?? 'default.jpg'); ?>"
                                        alt="Product Image" style="width: 50px; height: 50px;">
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </td>
                                <td class="text-center"><?php echo number_format($item['price'], 0, ',', '.') . 'đ'; ?>
                                </td>
                                <td class="text-center">
                                    <input type="number" name="quantities[<?php echo $item['product_id']; ?>]"
                                        value="<?php echo $item['quantity']; ?>" min="1" style="width: 60px;">
                                </td>
                                <td class="text-center">
                                    <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.') . 'đ'; ?>
                                </td>
                                <td class="text-center">
                                    <a href="/cart/remove/<?php echo $item['product_id']; ?>" class="btn btn-danger"
                                        onclick="return confirmDelete('<?php echo htmlspecialchars($item['product_name']); ?>');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $total += $item['price'] * $item['quantity']; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                <td class="text-center"><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Nút cập nhật giỏ hàng -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sync-alt"></i>&nbsp;Cập nhật
                        </button>
                    </div>
                </form>

                <?php else : ?>
                <p>Giỏ hàng của bạn đang trống.</p>
                <?php endif; ?>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-1">Tóm tắt đơn hàng</h4>
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Thành tiền:
                                <strong><?php echo number_format($total); ?>đ</strong>
                            </li>
                            <li class="list-group-item">
                                Vận chuyển: <strong>Liên hệ phí vận chuyển sau</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Tổng cộng:
                                <strong><?php echo number_format($total); ?>đ</strong>
                            </li>
                            <li class="list-group-item">
                                <p style="font-size: 13px;">Thông tin giao hàng</p>
                                <p style="font-size: 12px;">Đối với những sản phẩm có sẵn tại khu vực, Quý Nhân sẽ giao
                                    hàng trong vòng 2-7 ngày.</p>
                                <p style="font-size: 12px;"> Đối với những sản phẩm không có sẵn, thời gian giao hàng sẽ
                                    được nhân viên Quý Nhân thông báo đến quý khách.</p>
                                <a href="#footer" style="font-size: 13px; color: black;">Cửa hàng gần bạn</a>
                            </li>
                        </ul>
                        <!-- Nút Đặt hàng -->
                        <div class="text-center">
                            <?php if (!empty($cartItems)) : // Kiểm tra nếu giỏ hàng không trống 
                            ?>
                            <a href="#" class="btn btn-dark w-100 mb-2"
                                onclick="document.getElementById('placeOrderForm').submit();">
                                <i class="fas fa-credit-card" style="font-size: 19px;"></i>&nbsp;Đặt hàng
                            </a>
                            <?php else : ?>
                            <button class="btn btn-dark w-100 mb-2" disabled>
                                <i class="fas fa-credit-card" style="font-size: 19px;"></i>&nbsp;Giỏ hàng trống
                            </button>
                            <?php endif; ?>
                        </div>

                        <!-- Form ẩn để gửi yêu cầu đặt hàng -->
                        <form id="placeOrderForm" action="/thanhtoan" method="POST" style="display: none;"></form>


                        <a href="/sanpham" class="btn btn-secondary w-100" style="font-size: 19px;">
                            <i class="fas fa-shopping-cart"></i>&nbsp;Tiếp tục mua hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>
<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.add('fade-out');
        });
    }, 2000); // Thời gian hiển thị là 2000ms = 2 giây
});
</script>

<script>
function confirmDelete(productName) {
    return confirm("Bạn có chắc chắn muốn xóa sản phẩm '" + productName + "' khỏi giỏ hàng không?");
}
</script>

</html>