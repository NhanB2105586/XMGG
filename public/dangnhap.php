<?php
include_once __DIR__ . '/../src/partials/header.php';
include_once __DIR__ . '/../src/dp.php';
?>

<link href="/css/styledangnhap.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../src/partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="row">

        <div class="col-lg-5 col-md-8 col-sm-11 mx-auto">
            <div class="wrapper">
                <form class="form-register">
                    <h2 class="title-form text-center mb-3">Đăng nhập</h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email/ username</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-2 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>

                    </div>
                    <div class="mb-4">Bạn là khách hàng mới? <a href="/public/dangky.php">Tạo tài khoản</a></div>
                    <button type="submit" class="btn btn-form">Đăng Nhập</button>
                </form>

            </div>

        </div>

    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>