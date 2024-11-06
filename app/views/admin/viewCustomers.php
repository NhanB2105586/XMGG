<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <style>
    .table {
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    .btn-add {
        margin-bottom: 15px;
    }

    .search-form {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .search-form input {
        margin-right: 10px;
        flex-grow: 1;
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
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên"
                        value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <a href="/admin/addCustomer" class="btn btn-primary btn-add">Thêm Khách Hàng</a>
        </div>
        <div class="table-responsive">
            <?php if (!empty($essage)): ?>
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
            // Đặt thời gian để ẩn thông báo sau 2 giây (2000 milliseconds)
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
                <?php unset($_SESSION['success_message']); ?>
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
                        <th class="text-center">Họ và Tên</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Địa Chỉ</th>
                        <th class="text-center">Số Điện Thoại</th>
                        <th class="text-center">Ngày Tạo</th>
                        <th class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)): ?>
                    <?php foreach ($customers as $index => $customer): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($customer["fullname"]) ?></td>
                        <td><?= htmlspecialchars($customer["email"]) ?></td>
                        <td><?= htmlspecialchars($customer["address"]) ?></td>
                        <td class="text-center"><?= htmlspecialchars($customer["phone_number"]) ?></td>
                        <td class="text-center"><?= htmlspecialchars($customer["created_at"]) ?></td>
                        <td class="text-center">
                            <a href="/admin/editCustomer?id=<?= $customer['user_id'] ?>"
                                class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                            <form action="/admin/deleteCustomer" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $customer['user_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Không có khách hàng nào.</td>
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