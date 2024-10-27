<?php
include_once __DIR__ . '/../app/partials/header.php'; // Đường dẫn tới header.php
include_once __DIR__ . '/app/models/PDOFactory.php'; // Đường dẫn tới PDOFactory.php
?>
<link rel="stylesheet" href="/css/styledangnhap.css">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../app/partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="row">

        <div class="col-lg-5 col-md-8 col-sm-11 mx-auto">
            <div class="wrapper">
                <form class="form-register">
                    <h2 class="title-form text-center mb-3">ĐĂNG NHẬP</h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email/ username</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>

                    <div class="mb-2">Bạn là khách hàng mới? <a href="/dangki.php">Tạo tài khoản</a></div>
                    <div class="mb-3">Bạn quên mật khẩu? <a href="#">Đổi mật khẩu</a></div>

                    <button type="submit" class="btn btn-form">Đăng Nhập</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/app/partials/footer.php'; ?>
</body>