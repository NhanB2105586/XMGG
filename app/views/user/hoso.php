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
                                    <div class="profile-img-container text-center">
                        <div class="profile-img-wrapper position-relative">
                            <img id="avatar-preview" src="<?= $user['avatar'] ?? '/images/avatar.jpg' ?>" alt="User Avatar" 
                                 style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; border: 3px solid #f0f0f0;">
                            <div class="avatar-overlay">
                                <label for="avatar-upload" class="avatar-upload-btn">
                                    <i class="fas fa-camera"></i>
                                    <span>Thay đổi ảnh</span>
                                </label>
                            </div>
                        </div>
                        <p class="text-muted mt-2">Click vào ảnh để thay đổi</p>
                    </div>
            </div>
            <div class="col-md-8">
                <form action="/updateProfile" method="POST" enctype="multipart/form-data" id="profile-form">
                    <input type="hidden" name="current_avatar" value="<?= $user['avatar'] ?? '/images/avatar.jpg' ?>">
                    <input type="file" id="avatar-upload" name="avatar" accept="image/*" style="display: none;">
                    
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
    
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>
</body>

<style>
.profile-img-wrapper {
    display: inline-block;
    position: relative;
    cursor: pointer;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.profile-img-wrapper:hover .avatar-overlay {
    opacity: 1;
}

.avatar-upload-btn {
    color: white;
    text-align: center;
    cursor: pointer;
    font-size: 14px;
}

.avatar-upload-btn i {
    display: block;
    font-size: 24px;
    margin-bottom: 5px;
}

.avatar-upload-btn span {
    display: block;
    font-size: 12px;
}
</style>

<script>
    // Xử lý upload ảnh đại diện
    document.getElementById('avatar-upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Kiểm tra kích thước file (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('File ảnh quá lớn. Vui lòng chọn file nhỏ hơn 5MB.');
                return;
            }
            
            // Kiểm tra loại file
            if (!file.type.startsWith('image/')) {
                alert('Vui lòng chọn file ảnh hợp lệ.');
                return;
            }
            
            // Hiển thị preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Chỉ sử dụng label để mở file picker, không cần event listener trên wrapper

    // Validation form
    document.getElementById('profile-form').addEventListener('submit', function(event) {
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
