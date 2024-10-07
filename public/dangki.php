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
                    <h2 class="title-form text-center mb-3">ĐĂNG KÝ</h2>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-4">Bạn đã có tài khoản? <a href="/dangnhap.php">Đăng nhập</a></div>
                    <button type="submit" class="btn btn-form">Đăng Ký</button>
                </form>

            </div>

        </div>

    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>