<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <style>
    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .form-control {
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        width: 100%;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-group {
        margin-top: 10px;
    }

    @media (max-width: 576px) {
        .container {
            padding: 15px;
        }
    }
    </style>

    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container mt-3" id="main-content">
        <h2 class="text-center">Chỉnh Sửa Sản Phẩm</h2>

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

        <form action="/admin/editProducts" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

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
                    value="<?php echo htmlspecialchars($old['product_name'] ?? $product['product_name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="old_price">Giá Cũ</label>
                <input type="number" class="form-control" id="old_price" name="old_price" step="0.01"
                    value="<?php echo htmlspecialchars($old['old_price'] ?? $product['old_price']); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Giá Mới</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                    value="<?php echo htmlspecialchars($old['price'] ?? $product['price']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" id="description" name="description"
                    required><?php echo htmlspecialchars($old['description'] ?? $product['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="in_stock">Còn Hàng</label>
                <select class="form-control" id="in_stock" name="in_stock" required>
                    <option value="1" <?= (isset($old['in_stock']) && $old['in_stock'] == 1) ? 'selected' : ''; ?>>Còn
                        hàng</option>
                    <option value="0" <?= (isset($old['in_stock']) && $old['in_stock'] == 0) ? 'selected' : ''; ?>>Hết
                        hàng</option>
                </select>
            </div>

            <?php if (!empty($product['images'])): ?>

            <div class="form-group">
                <div>
                    <?php if (!empty($product['images'])): ?>
                    <div class="form-group">
                        <label>Hình Ảnh Hiện Tại</label>
                        <div>
                            <?php foreach ($product['images'] as $image): ?>
                            <div style="display: inline-block; margin-right: 10px; text-align: center;">
                                <img src="/images/upload/<?= htmlspecialchars($image['image_url']) ?>"
                                    alt="Product Image" style="width: 100px; height: auto;">
                                <div>
                                    <!-- Checkbox để xóa hình ảnh -->
                                    <label>
                                        <input type="checkbox" name="delete_images[]" value="<?= $image['image_id'] ?>">
                                        Xóa
                                    </label>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php endif; ?>
            <div class="form-group">
                <label for="images">Hình Ảnh</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
                <small class="form-text text-muted">Chọn nhiều hình ảnh (tối đa 5MB mỗi file).</small>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Cập Nhật Sản Phẩm</button>
        </form>

    </div>

    <?php
    include_once __DIR__ . '/../partials/footAdmin.php';
    ?>
</body>

</html>