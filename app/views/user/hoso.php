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
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const fullname = document.querySelector('input[name="fullname"]').value.trim();
        const phoneNumber = document.querySelector('input[name="phone_number"]').value.trim();
        const address = document.querySelector('input[name="address"]').value.trim();

        let isValid = true;

        // Kiểm tra họ và tên
        if (fullname === '') {
            alert('Họ và tên không được để trống.');
            isValid = false;
        }

        // Kiểm tra số điện thoại (có 10-12 ký tự, bắt đầu bằng số 0)
        if (phoneNumber === '' || !/^0\d{9,11}$/.test(phoneNumber)) {
            alert('Số điện thoại không hợp lệ. Số điện thoại phải bắt đầu bằng số 0 và có từ 10 đến 12 ký tự.');
            isValid = false;
        }

        // Kiểm tra địa chỉ
        if (address === '') {
            alert('Địa chỉ không được để trống.');
            isValid = false;
        }

        // Nếu không hợp lệ, ngăn không cho form gửi
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>