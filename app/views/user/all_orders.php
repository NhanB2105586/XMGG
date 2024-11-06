<?php include_once __DIR__ . '/../partials/header.php'; ?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container my-5">
        <h2 class="text-center mb-4 mt-5">Danh sách đơn hàng của bạn</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td><?php echo number_format($order['total_amount'], 0, ',', '.') . 'đ'; ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td>
                            <a href="/donhang/<?php echo htmlspecialchars($order['order_id']); ?>" class="btn btn-info">Xem chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>