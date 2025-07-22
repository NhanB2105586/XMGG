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
        <h1 class="text-center mt-4 mb-4 ">LIÊN HỆ CHÚNG TÔI</h1>
        <div class="row">
            <!-- Thông tin liên hệ -->
            <div class="col-md-6 mt-3">
                <h3>Thông tin liên hệ</h3>
                <br>
                <h4>Showroom Cần Thơ</h4>
                <p><strong>Địa chỉ:</strong> I6-8 Cao Minh Lộc, Phường Hưng Phú, Tp.Cần Thơ, Việt Nam</p>
                <p><strong>Số điện thoại:</strong> 093 949 64 69</p>
                <p><strong>Email:</strong> daiquandecor@gmail.com</p>
                <p><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 7: 7:00 - 17:00</p>
                <br>
                <h4>Văn phòng An Giang</h4>
                <p><strong>Địa chỉ:</strong> 621A, Nguyễn Trung Trực, Phường An Hòa, An Giang, Việt Nam</p>
                <p><strong>Số điện thoại:</strong> 093 930 39 78</p>
                <p><strong>Email:</strong> daiquandecor@gmail.com</p>
                <p><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 7: 7:00 - 17:00</p>
            </div>

            <!-- Form liên hệ -->
            <div class="col-md-6 mt-3">
                <h4>Gửi tin nhắn cho chúng tôi</h4>
                <form action="/submit-contact" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label mt-4">Họ và Tên</label>
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
                    <button type="submit" class="btn custom-btn float-end">Gửi</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/app.php'; ?>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>