<?php
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container my-5">
        <h2 class="text-center mb-4 mt-5">Đơn hàng của bạn</h2>

        <div class="card mb-4" style="background-color: white;">
            <div class="card-header">Chi tiết đơn hàng #<?php echo htmlspecialchars($orderId); ?></div>
            <div class="card-body">
                <p><strong>Trạng thái đơn hàng:</strong> <?php echo htmlspecialchars($orderStatus); ?></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($orderDetails as $item) : ?>
                            <tr>
                                <td>
                                    <img src="/images/upload/<?php echo htmlspecialchars($item['image_url'] ?? 'default.jpg'); ?>"
                                        alt="Product Image" style="width: 50px; height: 50px;">
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </td>
                                <td class="text-center"><?php echo $item['quantity']; ?></td>
                                <td class="text-center"><?php echo number_format($item['price'], 0, ',', '.') . 'đ'; ?></td>
                                <td class="text-center"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.') . 'đ'; ?></td>
                            </tr>
                            <?php $total += $item['price'] * $item['quantity']; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td class="text-center"><?php echo number_format($total, 0, ',', '.') . 'đ'; ?></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Nút quay lại giỏ hàng -->
                <div class="text-center">
                    <a href="/giohang" class="btn btn-secondary">Quay lại giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>