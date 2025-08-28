<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container mt-3" id="main-content">
        <h2 class="text-center">Thêm Sản Phẩm Mới</h2>
        <div class="mb-3">
            <a href="/../admin/viewProduct" class="btn btn-secondary">
                ← Quay lại
            </a>
        </div>
        
        <!-- Hiển thị thông báo lỗi nếu có -->
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <form action="/admin/addProduct" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category_id">Danh Mục</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_id']) ?>"
                        <?= (isset($old['category_id']) && $old['category_id'] == $category['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['category_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product_name">Tên Sản Phẩm</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    value="<?php echo htmlspecialchars($old['product_name'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="old_price">Giá Cũ</label>
                <input type="number" class="form-control" id="old_price" name="old_price" step="0.01"
                    value="<?php echo htmlspecialchars($old['old_price'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Giá Mới</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                    value="<?php echo htmlspecialchars($old['price'] ?? ''); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($old['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label for="in_stock">Số lượng</label>
                <input type="number" class="form-control" id="in_stock" name="in_stock"
                    value="<?php echo htmlspecialchars($old['in_stock'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="images">Hình Ảnh</label>
                <input type="file" class="form-control-file" id="images" name="images[]" multiple accept="image/*" required>
                <small class="form-text text-muted">Chọn một hoặc nhiều hình ảnh để thêm vào sản phẩm.</small>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block mt-3">Thêm Sản Phẩm</button>
        </form>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footAdmin.php';
    ?>
</body>
</html>
