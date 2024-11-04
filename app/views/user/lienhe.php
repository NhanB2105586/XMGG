<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylelienhe.css" rel="stylesheet">

<body>
    <!-- Navbar -->
    <div class="container mb-4">
        <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4">Liên Hệ Chúng Tôi</h1>
        <div class="row">
            <!-- Thông tin liên hệ -->
            <div class="col-md-6">
                <h3>THÔNG TIN LIÊN HỆ </h3>
                <br>
                <h4>Showroom</h4>
                <p><strong>Địa chỉ:</strong> 3/2, Quận Ninh Kiều, Tp.Cần Thơ, Việt nam</p>
                <p><strong>Số điện thoại:</strong> (012) 345-678</p>
                <p><strong>Email:</strong> nhanb2105586@company.com</p>
                <p><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 6: 9:00 - 18:00</p>
                <br>
                <h4>Xưởng sản xuất</h4>
                <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận X, Thành phố Y</p>
                <p><strong>Số điện thoại:</strong> (012) 345-000</p>
                <p><strong>Email:</strong> quyb2111860@company.com</p>
                <p><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 6: 9:00 - 18:00</p>
            </div>

            <!-- Form liên hệ -->
            <div class="col-md-6">
                <h4>Gửi tin nhắn cho chúng tôi</h4>
                <form action="/submit-contact" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Nội dung</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn custom-btn">Gửi Liên Hệ</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>