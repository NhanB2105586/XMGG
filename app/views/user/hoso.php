<?php
include_once __DIR__ . '/../partials/header.php';
include_once __DIR__ . '../../../core/PDOFactory.php';
?>

<link href="/css/styleProfile.css" rel="stylesheet">

<body>
    <div class="container mt-5 mb-4">
        <h2 class="text-center mb-4">Thông Tin Hồ Sơ</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="<?= $user['avatar'] ?? '/images/avatar.jpg' ?>" alt="User Avatar" style="width: 200px; height: 200px; border-radius: 50%;">
                </div>
            </div>
            <div class="col-md-8">
                <form action="/updateProfile" method="POST">
                    <div class="form-group mb-3">
                        <label class="fw-bold">Họ và tên:</label>
                        <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($user['fullname']) ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">Số điện thoại:</label>
                        <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars($user['phone_number']) ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold">Địa chỉ:</label>
                        <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>">
                    </div>
                    <div class="form-group">
                        <!-- Sử dụng lớp Bootstrap để căn giữa văn bản trong nút -->
                        <button type="submit" class="btn btn-primary">Cập Nhật Thông Tin</button>
                        <a href="/" class="btn btn-danger ms-3">Quay lại</a>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            Thông tin hồ sơ đã được cập nhật thành công.
        </div>
    <?php endif; ?>
</body>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>