<?php
include_once __DIR__ . '/../src/partials/header.php';
include_once __DIR__ . '/../src/dp.php';
?>
<link href="/css/stylesofa.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../src/partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="fw-bold">Tạo tài khoản</h1>
                <p>Đăng ký tài khoản chỉ trong 1 phút để tích lũy điểm và nhận ưu đãi</p>
            </div>
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Họ">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Tên">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giới tính</label>
                            <div>
                                <input class="form-check-input" type="radio" name="gender" id="genderFemale">
                                <label class="form-check-label me-3" for="genderFemale">Nữ</label>
                                <input class="form-check-input" type="radio" name="gender" id="genderMale">
                                <label class="form-check-label" for="genderMale">Nam</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="phone" class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Mật khẩu">
                        </div>
                        <button type="submit" class="btn btn-dark w-100">ĐĂNG KÝ</button>
                        <div class="text-center mt-3">
                            <a href="#">Quay lại trang chủ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once __DIR__ . '/../src/partials/app.php'; ?>
    <?php include_once __DIR__ . '/../src/partials/footer.php'; ?>

</body>