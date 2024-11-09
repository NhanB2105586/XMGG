<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>
<style>
.modal-body {
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-height: 400px;
    overflow-y: auto;
}
</style>

<body>
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
            <a href="/admin/addProducts" class="btn btn-primary btn-add">Thêm Sản Phẩm</a>
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
                        <th class="text-center">Tên Sản Phẩm</th>
                        <th class="text-center">Ảnh</th>
                        <th class="text-center">Giá Cũ</th>
                        <th class="text-center">Giá Mới</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Mô Tả</th>
                        <th class="text-center">Ngày Tạo</th>
                        <th class="text-center">Ngày Cập Nhật</th>
                        <th class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                    <?php foreach ($products as $index => $product): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($product["product_name"]) ?></td>
                        <td class="text-center">
                            <?php if (!empty($product['images'])): ?>
                            <img src="/images/upload/<?= htmlspecialchars($product['images'][0]['image_url']) ?>"
                                alt="<?= htmlspecialchars($product['product_name']) ?>"
                                style="width: 100%; height: auto;">
                            <?php else: ?>
                            <p>Không có hình ảnh</p>
                            <?php endif; ?>
                        </td>


                        <td class="text-center"><?= htmlspecialchars($product["old_price"]) ?></td>
                        <td class="text-center"><?= htmlspecialchars($product["price"]) ?></td>
                        <td class="text-center"><?= htmlspecialchars($product["in_stock"]) ?>
                        </td>
                        <td>
                            <div>
                                <button class="btn btn-link" data-toggle="modal"
                                    data-target="#modal-<?= $product['product_id'] ?>">Xem Thêm</button>
                            </div>
                            <div class="modal fade" id="modal-<?= $product['product_id'] ?>" tabindex="-1" role="dialog"
                                aria-labelledby="modalLabel-<?= $product['product_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel-<?= $product['product_id'] ?>">Chi
                                                Tiết Sản Phẩm</h5>
                                        </div>
                                        <div class="modal-body">
                                            <?= htmlspecialchars($product["description"]) ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><?= htmlspecialchars($product["created_at"]) ?></td>
                        <td class="text-center"><?= htmlspecialchars($product["updated_at"]) ?></td>
                        <td class="text-center">
                            <a href="/admin/editProducts?id=<?= $product['product_id'] ?>"
                                class="btn btn-warning btn-sm">Chỉnh Sửa</a>
                            <form action="/admin/deleteProducts" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $product['product_id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">Không có sản phẩm nào.</td>
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