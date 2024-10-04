<?php
require_once __DIR__ . '/../src/bootstrap.php';
include_once __DIR__ . '/../src/partials/header.php';
?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../src/partials/navbar.php'; ?>

    <!-- Thêm CSS để phần nội dung chính chiếm 100% chiều ngang -->
    <style>
        .main-content {
            width: 100vw;
            /* Chiều rộng toàn màn hình */
            padding: 0;
            margin: 0;
        }
    </style>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">
        <h1>Nội dung sản phẩm ở đây</h1>
        <h1>Nội dung sản phẩm ở đây</h1>
        <h1>Nội dung sản phẩm ở đây</h1>
        <h1>Nội dung sản phẩm ở đây</h1>
        <h1>Nội dung sản phẩm ở đây</h1>
        <h1>Nội dung sản phẩm ở đây</h1>
        <h1>Nội dung sản phẩm ở đây</h1>
        <h1>Nội dung sản phẩm ở đây</h1>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>

</html>