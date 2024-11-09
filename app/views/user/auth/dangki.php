<?php
include_once __DIR__ . '/../../partials/header.php';
include_once __DIR__ . '/../../../core/PDOFactory.php';
?>
<link rel="stylesheet" href="/css/styledangnhap.css">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-11 mx-auto">
            <?php
            if (isset($_SESSION['success_message'])) {
                echo '<div id="success-alert" class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
            }
            ?>
            <?php
            if (isset($_SESSION['error_message'])) {
                echo '<div id="success-alert" class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']); // Xóa thông báo sau khi hiển thị
            }
            ?>
            <div class="wrapper">
                <form class="form-register" action="/checkdangky" method="POST">
                    <h2 class="title-form text-center text-white mb-3">ĐĂNG KÝ</h2>

                    <div class="mb-3">
                        <label for="fullName" class="form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password"
                            required>
                    </div>

                    <div class="mb-4">Bạn đã có tài khoản? <a href="/dangnhap">Đăng nhập</a></div>
                    <button type="reset" class="btn btn-form">Hủy</button>
                    <button type="submit" class="btn btn-form">Đăng Ký</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../partials/footer.php'; ?>
</body>