<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container mt-3" id="main-content">
        <h2 class="text-center">Chỉnh Sửa Danh Mục</h2>

        <!-- Hiển thị thông báo thành công -->
        <?php if (!empty($message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>

        <!-- Hiển thị thông báo lỗi  -->
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

        <form action="/admin/editCategory/<?= $category['category_id'] ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['category_id']); ?>">
            <div class="form-group">
                <label for="category_name">Tên Danh Mục</label>
                <input type="text" class="form-control" id="category_name" name="category_name"
                    value="<?php echo htmlspecialchars($category['category_name']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Cập Nhật Danh Mục</button>
        </form>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footAdmin.php';
    ?>
</body>

</html>