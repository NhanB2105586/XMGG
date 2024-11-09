<?php
include_once __DIR__ . '/../../partials/header.php'; // Đường dẫn tới header.php
include_once __DIR__ . '/../../../core/PDOFactory.php'; // Đường dẫn tới PDOFactory.php
?>
<link rel="stylesheet" href="/css/styleforgotpassword.css">

<body>
    <!-- Navbar -->
    <div class="container mb-4"> <?php include_once __DIR__ . '/../../partials/navbar.php'; ?> </div>

    <!-- Main Page Content -->
    <div class="row mt-5 mb-5">
        <div class="col-lg-5 col-md-8 col-sm-11 mx-auto">
            <div class="wrapper">
                <form class="form-forgot-password" action="/send_reset_link.php" method="post">
                    <br>
                    <br>
                    <h2 class="title-form text-center mb-3">Khôi Phục Mật Khẩu</h2>
                    <p class="text-center mb-4">Nhập địa chỉ email của bạn để nhận liên kết khôi phục mật khẩu.</p>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn btn-form">Gửi Liên Kết</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Footer -->
        <?php include_once __DIR__ . '/../../partials/footer.php'; ?>

</body>