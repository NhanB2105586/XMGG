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