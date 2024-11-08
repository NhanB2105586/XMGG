<?php
include_once __DIR__ . '/../partials/header.php'; // Đường dẫn tới header.php
include_once __DIR__ . '/../../core/PDOFactory.php'; // Đường dẫn tới PDOFactory.php
?>
<link rel="stylesheet" href="/css/styledangnhap.css">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="row">

        <div class="col-lg-5 col-md-8 col-sm-11 mx-auto">
            <div class="wrapper">
                <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>
                <?php
                if (isset($_SESSION['success_message'])) {
                    echo '<div id="success-alert" class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                    unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
                }
                ?>

                <form class="form-register" action="/checkuser" method="POST">
                    <h2 class="title-form text-center mb-3">ĐĂNG NHẬP</h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email/username:</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>

                    <div class="mb-2">Bạn là khách hàng mới? <a href="/dangki">Tạo tài khoản</a></div>
                    <div class="mb-2">Bạn quên mật khẩu? <a href="/khoiphucmatkhau">Khôi phục mật khẩu</a></div>
                    <div class="mb-3"><a href="/admin/login">Bạn là quản trị viên?</a></div>
                    <div class="btn-container">
                        <button type="reset" class="btn btn-form">Hủy</button>
                        <button type="submit" class="btn btn-form">Đăng Nhập</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <script>
    // Tự động ẩn thông báo sau 2 giây
    setTimeout(function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000); // 2000ms = 2 giây
    </script>
    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>