<?php
require_once __DIR__ . '/../../partials/header.php';
if (isset($_SESSION['error_messages'])) {
    foreach ($_SESSION['error_messages'] as $error) {
        echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
    }
    // Xóa thông báo lỗi sau khi hiển thị
    unset($_SESSION['error_messages']);
}
?>
<style>
.form-login-admin {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.wrapper-admin {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
}
</style>
<div class="col-lg-3 col-md-8 col-sm-11 form-login-admin mx-auto">
    <div class="wrapper-admin ">
        <h2 class="title-form text-center mb-3">ĐĂNG NHẬP</h2>
        <form method="POST" action="/admin/login">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby=" emailHelp"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ghi Nhớ Tôi</label>
            </div>
            <button type="submit" class="btn btn-form">Đăng Nhập</button>
            <a href="/dangnhap" class="btn btn-form">Quay lại</button></a>
        </form>
    </div>
</div>