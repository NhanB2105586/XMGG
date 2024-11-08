<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container mt-3" id="main-content">
        <h2 class="text-center">Thêm Danh Mục Mới</h2>

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



        <form action="/admin/addCategory" method="POST">
            <div class="form-group">
                <label for="category_name">Tên Danh Mục</label>
                <input type="text" class="form-control" id="category_name" name="category_name"
                    value="<?php echo htmlspecialchars($old['category_name'] ?? ''); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Thêm Danh Mục</button>
        </form>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footAdmin.php';
    ?>
</body>

</html>