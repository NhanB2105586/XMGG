<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <style>
    .table {
        border-collapse: collapse;
        font-size: 0.85rem;
        width: 100%;
    }

    .table th,
    .table td {
        padding: 0.5rem;
        text-align: center;
    }

    .btn-link {
        padding: 0;
        font-size: 0.9rem;
    }

    .pagination {
        margin-top: 15px;
    }
    </style>

    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container mt-3" id="main-content">
        <div class="d-flex justify-content-between mb-3">
            <div class="search-form me-auto">
                <form method="GET" action="" class="d-flex">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm"
                        value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger" id="error-message">
                <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                <?php unset($_SESSION['error_message']); ?>
            </div>
            <script>
            setTimeout(function() {
                var errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            }, 2000);
            </script>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success" id="success-message">
                <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            </div>
            <script>
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 2000);
            </script>
            <?php endif; ?>

            <table class="table mt-1">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Mã Đơn Hàng</th>
                        <th class="text-center">Tên Người Dùng</th>
                        <th class="text-center">Ngày Đặt Hàng</th>
                        <th class="text-center">Tổng Tiền</th>
                        <th class="text-center">Trạng Thái</th>
                        <th class="text-center">Chi Tiết</th>
                        <th class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $index => $order): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td class="text-center"><?= htmlspecialchars($order['order_id']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($order['order_date']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($order['total_amount']) ?></td>
                        <td class="text-center">
                            <!-- Dropdown để chọn trạng thái đơn hàng -->
                            <form action="/admin/update-statusOrders/<?= $order['order_id'] ?>" method="POST"
                                style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <select name="status" class="form-control form-control-sm"
                                    onchange="this.form.submit()">
                                    <option value="pending" <?= ($order['status'] === 'pending') ? 'selected' : ''; ?>>
                                        Đang chờ xử lý</option>
                                    <option value="completed"
                                        <?= ($order['status'] === 'completed') ? 'selected' : ''; ?>>Hoàn thành</option>
                                    <option value="shipped" <?= ($order['status'] === 'shipped') ? 'selected' : ''; ?>>
                                        Đang giao</option>
                                    <option value="cancelled"
                                        <?= ($order['status'] === 'cancelled') ? 'selected' : ''; ?>>Đã hủy</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-link" data-toggle="modal"
                                data-target="#order-details-modal-<?= $order['order_id'] ?>">Xem Chi Tiết</button>

                            <!-- Modal chi tiết đơn hàng -->
                            <div class="modal fade" id="order-details-modal-<?= $order['order_id'] ?>" tabindex="-1"
                                role="dialog" aria-labelledby="modalLabel-<?= $order['order_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel-<?= $order['order_id'] ?>">Chi Tiết
                                                Đơn Hàng #<?= $order['order_id'] ?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tên Sản Phẩm</th>
                                                        <th>Số Lượng</th>
                                                        <th>Giá</th>
                                                        <th>Tổng Tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php foreach ($orderdetail as $detail): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($detail['product_name']); ?>
                                                        </td>
                                                        <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                                                        <td><?php echo number_format($detail['price'], 0, ',', '.'); ?>
                                                            VNĐ</td>
                                                        <td><?php echo number_format($detail['price'] * $detail['quantity'], 0, ',', '.'); ?>
                                                            VNĐ</td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <form action="/admin/deleteOrders/<?= $order['order_id'] ?>" method="POST"
                                style="display:inline;">
                                <input type="hidden" name="id" value="<?= $order['order_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Không có đơn hàng nào.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Phân trang -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?page=<?php echo $currentPage - 1; ?>&search=<?php echo urlencode($searchTerm); ?>"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?page=<?php echo $currentPage + 1; ?>&search=<?php echo urlencode($searchTerm); ?>"
                            aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footAdmin.php';
    ?>
</body>