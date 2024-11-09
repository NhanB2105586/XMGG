<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container mt-3" id="main-content">
        <div class="d-flex justify-content-between mb-3">
            <h2>Chi Tiết Đơn Hàng #<?= htmlspecialchars($id) ?></h2>
        </div>

        <div class="row">
            <div class="">
                <h4>Thông Tin Đơn Hàng</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <td><?= htmlspecialchars($id) ?></td>
                    </tr>
                    <tr>
                        <th>Tên Người Dùng</th>
                        <td><?= htmlspecialchars($order['fullname']) ?></td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ</th>
                        <td><?= htmlspecialchars($order['address']) ?></td>
                    </tr>
                    <tr>
                        <th>Số Điện Thoại</th>
                        <td><?= htmlspecialchars($order['phone_number']) ?></td>
                    </tr>
                    <tr>
                        <th>Ngày Đặt Hàng</th>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                    </tr>
                    <tr>
                        <th>Tổng Tiền</th>
                        <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VNĐ</td>
                    </tr>
                    <tr>
                        <th>Trạng Thái</th>
                        <td><?= htmlspecialchars($order['status']) ?></td>
                    </tr>
                </table>
            </div>
            <div class="">
                <h4>Chi Tiết Sản Phẩm</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Tổng Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderDetail as $detail): ?>
                        <tr>
                            <td><?= htmlspecialchars($detail['product_name']) ?></td>
                            <td><?= htmlspecialchars($detail['quantity']) ?></td>
                            <td><?= number_format($detail['price'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= number_format($detail['price'] * $detail['quantity'], 0, ',', '.') ?> VNĐ</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="/admin/viewOrders" class="btn btn-primary">Quay lại danh sách đơn hàng</a>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footAdmin.php';
    ?>
</body>