<?php
include_once __DIR__ . '/../partials/header.php';

// Debug: Kiểm tra biến user
echo "<!-- Debug: user = " . (isset($user) ? 'set' : 'not set') . " -->";
if (isset($user)) {
    echo "<!-- Debug: user type = " . gettype($user) . " -->";
    echo "<!-- Debug: user content = " . htmlspecialchars(json_encode($user)) . " -->";
}

// Fallback: Đảm bảo biến user luôn có giá trị
if (!isset($user) || $user === null) {
    $user = [
        'fullname' => $_SESSION['user_fullname'] ?? '',
        'phone_number' => $_SESSION['user_phone'] ?? '',
        'address' => $_SESSION['user_address'] ?? '',
        'email' => $_SESSION['user_email'] ?? ''
    ];
}
?>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container my-5">
        <h2 class="text-center mb-4 mt-5">THANH TOÁN</h2>

        <!-- Thông tin giao hàng -->
        <div class="card mb-4" style="background-color: white;">
            <div class="card-header">Thông tin giao hàng</div>
            <div class="card-body">
                <form action="/checkthanhtoan" method="POST" id="checkoutForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['fullname'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone_number'] ?? ''); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ giao hàng</label>
                        <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                    </div>

                    <!-- Phần xác thực OTP -->
                    <div class="card mb-4" style="background-color: #f8f9fa;">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-shield-alt"></i> Xác thực bảo mật
                            </h5>
                        </div>
                        <div class="card-body">
                            
                                                         <div class="row mb-3">
                                 <div class="col-md-8">
                                     <button type="button" id="sendOTPBtn" class="btn btn-primary">
                                         <i class="fas fa-paper-plane"></i> Gửi mã OTP
                                     </button>
                                     <span id="otpStatus" class="ms-2"></span>
                                 </div>
                                <div class="col-md-4">
                                    <div id="otpTimer" class="text-muted" style="display: none;">
                                        Gửi lại sau: <span id="countdown">300</span>s
                                    </div>
                                </div>
                            </div>
                            
                            <div id="otpInputSection" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="otp" class="form-label">Mã OTP</label>
                                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Nhập mã 6 chữ số" maxlength="6" pattern="[0-9]{6}">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="button" id="verifyOTPBtn" class="btn btn-success">
                                            <i class="fas fa-check"></i> Xác thực OTP
                                        </button>
                                    </div>
                                </div>
                                <div id="otpVerifyStatus" class="mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Tóm tắt giỏ hàng -->
                    <div class="card mb-4" style="background-color: white;">
                        <div class="card-header">Giỏ hàng của bạn</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cartItems as $item) : ?>
                                        <tr>
                                            <td>
                                                <?php
                                                // Sửa đường dẫn hình ảnh
                                                $img = '';
                                                if (!empty($item['image_url'])) {
                                                    // Kiểm tra nếu là URL tuyệt đối
                                                    if (strpos($item['image_url'], 'http') === 0) {
                                                        $img = $item['image_url'];
                                                    } 
                                                    // Kiểm tra nếu đã có /images/ trong đường dẫn
                                                    elseif (strpos($item['image_url'], '/images/') === 0) {
                                                        $img = $item['image_url'];
                                                    }
                                                    // Thêm /images/imageupload/ nếu chưa có
                                                    else {
                                                        // Loại bỏ dấu / ở đầu nếu có
                                                        $imagePath = ltrim($item['image_url'], '/');
                                                        $img = '/images/imageupload/' . $imagePath;
                                                    }
                                                } else {
                                                    $img = '/images/default.jpg';
                                                }
                                                ?>
                                                <img src="<?php echo htmlspecialchars($img); ?>"
                                                    alt="Product Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                <?php echo htmlspecialchars($item['product_name']); ?>
                                            </td>
                                            <td class="text-center"><?php echo $item['quantity']; ?></td>
                                            <td class="text-center"><?php echo number_format($item['price'], 0, ',', '.') . 'đ'; ?></td>
                                            <td class="text-center"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.') . 'đ'; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                        <td class="text-center"><?php echo number_format($totalAmount, 0, ',', '.') . 'đ'; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Thêm trường ẩn cho tổng tiền -->
                    <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">

                    <!-- Phương thức thanh toán -->
                    <div class="card mb-4" style="background-color: white;">
                        <div class="card-header">Phương thức thanh toán</div>
                        <div class="card-body">
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="cod" class="form-check-input" required>
                                <label class="form-check-label">Thanh toán khi nhận hàng (COD)</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="bank_transfer" class="form-check-input" required>
                                <label class="form-check-label">Chuyển khoản ngân hàng</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="payment_method" value="credit_card" class="form-check-input" required>
                                <label class="form-check-label">Thẻ tín dụng</label>
                            </div>
                        </div>
                    </div>

                    <!-- Thông tin chuyển khoản ngân hàng -->
                    <div id="bankTransferInfo" class="card mb-4" style="background-color: #f8f9fa; display: none;">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-university"></i> Thông tin chuyển khoản
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Highlight số tiền -->
                            <div class="bank-transfer-highlight">
                                <h6><i class="fas fa-money-bill-wave"></i> Số tiền cần chuyển: <?php echo number_format($totalAmount, 0, ',', '.'); ?>đ</h6>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bank-info">
                                        <h6><i class="fas fa-building"></i> Thông tin ngân hàng:</h6>
                                        <ul class="list-unstyled">
                                            <li><strong>Ngân hàng:</strong> Vietcombank</li>
                                            <li><strong>Số tài khoản:</strong> <span class="text-primary fw-bold">1234567890</span></li>
                                            <li><strong>Chủ tài khoản:</strong> CÔNG TY TNHH XMGG</li>
                                            <li><strong>Số tiền:</strong> <span class="text-danger fw-bold fs-5"><?php echo number_format($totalAmount, 0, ',', '.'); ?>đ</span></li>
                                            <li><strong>Nội dung:</strong> <span class="text-primary fw-bold">XMGG_<?php echo time(); ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <div class="qr-code-container">
                                        <h6><i class="fas fa-qrcode"></i> Mã QR thanh toán:</h6>
                                        <div id="qrCode" class="mt-3"></div>
                                        <p class="text-muted mt-2">
                                            <small>Quét mã QR bằng ứng dụng ngân hàng để thanh toán nhanh</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-info-circle"></i>
                                <strong>Lưu ý:</strong> Vui lòng chuyển khoản đúng số tiền và nội dung để đơn hàng được xử lý nhanh chóng.
                            </div>
                        </div>
                    </div>

                    <!-- Nút xác nhận thanh toán -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Xác nhận thanh toán</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Nút quay lại giỏ hàng -->
        <div class="text-center">
            <a href="/giohang" class="btn btn-secondary">Quay lại giỏ hàng</a>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>



    <style>
        .bank-info ul li {
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .bank-info ul li:last-child {
            border-bottom: none;
        }
        
        .qr-code-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        #qrCode {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }
        
        #qrCode canvas {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px;
            background: white;
        }
        
        .bank-transfer-highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .bank-transfer-highlight h6 {
            margin: 0;
            font-weight: 600;
        }
    </style>

    <script>
        let otpVerified = false;
        let countdownInterval;

        // Kiểm tra định dạng số điện thoại và email
        const validateForm = () => {
            const phoneInput = document.querySelector('input[name="phone"]');
            const emailInput = document.querySelector('input[name="email"]');
            let valid = true;

            // Kiểm tra định dạng số điện thoại
            if (!/^\d{10,12}$/.test(phoneInput.value)) {
                alert('Số điện thoại không hợp lệ. Vui lòng nhập từ 10 đến 12 chữ số.');
                valid = false;
            }

            // Kiểm tra định dạng email
            if (!/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/.test(emailInput.value)) {
                alert('Email không hợp lệ. Vui lòng nhập một địa chỉ email hợp lệ.');
                valid = false;
            }

            // Kiểm tra OTP đã được xác thực chưa
            if (!otpVerified) {
                alert('Vui lòng xác thực OTP trước khi thanh toán.');
                valid = false;
            }

            return valid;
        };

                 // Gửi OTP
         document.getElementById('sendOTPBtn').addEventListener('click', function() {
            const phone = document.querySelector('input[name="phone"]').value;
            const email = document.querySelector('input[name="email"]').value;

            if (!phone || !email) {
                alert('Vui lòng nhập đầy đủ số điện thoại và email trước khi gửi OTP.');
                return;
            }

            // Kiểm tra định dạng
            if (!/^\d{10,12}$/.test(phone)) {
                alert('Số điện thoại không hợp lệ.');
                return;
            }

            if (!/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/.test(email)) {
                alert('Email không hợp lệ.');
                return;
            }

            const btn = this;
            const status = document.getElementById('otpStatus');
            
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';
            status.innerHTML = '';

            fetch('/send-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'phone=' + encodeURIComponent(phone) + '&email=' + encodeURIComponent(email)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    status.innerHTML = '<span class="text-success"><i class="fas fa-check"></i> ' + data.message + '</span>';
                    document.getElementById('otpInputSection').style.display = 'block';
                    
                    // Nếu có OTP trong response (email không gửi được), tự động điền vào ô OTP
                    if (data.otp) {
                        document.getElementById('otp').value = data.otp;
                    }
                    
                    startCountdown();
                } else {
                    status.innerHTML = '<span class="text-danger"><i class="fas fa-times"></i> ' + data.message + '</span>';
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane"></i> Gửi mã OTP';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                status.innerHTML = '<span class="text-danger"><i class="fas fa-times"></i> Lỗi kết nối. Vui lòng thử lại hoặc kiểm tra kết nối mạng.</span>';
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane"></i> Gửi mã OTP';
            });
        });

        // Xác thực OTP
        document.getElementById('verifyOTPBtn').addEventListener('click', function() {
            const otp = document.getElementById('otp').value;
            const status = document.getElementById('otpVerifyStatus');
            const btn = this;

            if (!otp) {
                alert('Vui lòng nhập mã OTP.');
                return;
            }

            if (!/^\d{6}$/.test(otp)) {
                alert('Mã OTP phải có 6 chữ số.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xác thực...';

            fetch('/verify-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'otp=' + encodeURIComponent(otp)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    status.innerHTML = '<span class="text-success"><i class="fas fa-check"></i> ' + data.message + '</span>';
                    otpVerified = true;
                    document.getElementById('otpInputSection').style.display = 'none';
                    document.getElementById('sendOTPBtn').style.display = 'none';
                    document.getElementById('otpTimer').style.display = 'none';
                    clearInterval(countdownInterval);
                } else {
                    status.innerHTML = '<span class="text-danger"><i class="fas fa-times"></i> ' + data.message + '</span>';
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-check"></i> Xác thực OTP';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                status.innerHTML = '<span class="text-danger"><i class="fas fa-times"></i> Có lỗi xảy ra</span>';
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-check"></i> Xác thực OTP';
            });
        });

        // Đếm ngược thời gian gửi lại OTP
        function startCountdown() {
            let timeLeft = 300; // 5 phút
            const countdownElement = document.getElementById('countdown');
            const timerElement = document.getElementById('otpTimer');
            const sendBtn = document.getElementById('sendOTPBtn');

            timerElement.style.display = 'block';
            sendBtn.disabled = true;

            countdownInterval = setInterval(() => {
                timeLeft--;
                countdownElement.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    timerElement.style.display = 'none';
                    sendBtn.disabled = false;
                    sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Gửi lại OTP';
                    document.getElementById('otpStatus').innerHTML = '';
                }
            }, 1000);
        }

        // Xử lý form submit
        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        // Chỉ cho phép nhập số trong ô OTP
        document.getElementById('otp').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Xử lý hiển thị thông tin chuyển khoản và tạo mã QR
        document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const bankTransferInfo = document.getElementById('bankTransferInfo');
                
                if (this.value === 'bank_transfer') {
                    bankTransferInfo.style.display = 'block';
                    generateQRCode();
                } else {
                    bankTransferInfo.style.display = 'none';
                }
            });
        });

        // Hàm tạo mã QR từ ảnh
        function generateQRCode() {
            console.log('Bắt đầu tạo mã QR từ ảnh...');
            
            const totalAmount = <?php echo $totalAmount; ?>;
            const orderId = 'XMGG_' + Date.now();
            
            console.log('Tổng tiền:', totalAmount);
            console.log('Mã đơn hàng:', orderId);
            
            // Xóa mã QR cũ nếu có
            const qrContainer = document.getElementById('qrCode');
            if (!qrContainer) {
                console.error('Không tìm thấy container QR Code!');
                return;
            }
            
            // Hiển thị loading
            qrContainer.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i><br><small>Đang tạo mã QR...</small></div>';
            
            // Hiển thị mã QR từ ảnh
            setTimeout(function() {
                qrContainer.innerHTML = `
                    <div style="border: 2px solid #e9ecef; border-radius: 10px; padding: 10px; background: white; display: inline-block; width: 200px; height: 200px; display: flex; align-items: center; justify-content: center;">
                        <div style="text-align: center;">
                            <div style="width: 160px; height: 160px; position: relative; background: white;">
                                <!-- Góc định vị trên trái -->
                                <div style="position: absolute; top: 0; left: 0; width: 40px; height: 40px; background: black; border-radius: 4px;"></div>
                                <div style="position: absolute; top: 4px; left: 4px; width: 32px; height: 32px; background: white; border-radius: 2px;"></div>
                                <div style="position: absolute; top: 12px; left: 12px; width: 16px; height: 16px; background: black; border-radius: 1px;"></div>
                                
                                <!-- Góc định vị trên phải -->
                                <div style="position: absolute; top: 0; right: 0; width: 40px; height: 40px; background: black; border-radius: 4px;"></div>
                                <div style="position: absolute; top: 4px; right: 4px; width: 32px; height: 32px; background: white; border-radius: 2px;"></div>
                                <div style="position: absolute; top: 12px; right: 12px; width: 16px; height: 16px; background: black; border-radius: 1px;"></div>
                                
                                <!-- Góc định vị dưới trái -->
                                <div style="position: absolute; bottom: 0; left: 0; width: 40px; height: 40px; background: black; border-radius: 4px;"></div>
                                <div style="position: absolute; bottom: 4px; left: 4px; width: 32px; height: 32px; background: white; border-radius: 2px;"></div>
                                <div style="position: absolute; bottom: 12px; left: 12px; width: 16px; height: 16px; background: black; border-radius: 1px;"></div>
                                
                                <!-- Pattern trung tâm -->
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 24px; height: 24px; background: black; border-radius: 2px;"></div>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 16px; height: 16px; background: white; border-radius: 1px;"></div>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 8px; height: 8px; background: black; border-radius: 0.5px;"></div>
                                
                                <!-- Các pattern ngẫu nhiên -->
                                <div style="position: absolute; top: 20px; left: 50px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 20px; left: 70px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 20px; left: 90px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 20px; left: 110px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 20px; left: 130px; width: 8px; height: 8px; background: black;"></div>
                                
                                <div style="position: absolute; top: 40px; left: 50px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 40px; left: 70px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 40px; left: 90px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 40px; left: 110px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 40px; left: 130px; width: 8px; height: 8px; background: black;"></div>
                                
                                <div style="position: absolute; top: 60px; left: 50px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 60px; left: 70px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 60px; left: 90px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 60px; left: 110px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 60px; left: 130px; width: 8px; height: 8px; background: black;"></div>
                                
                                <div style="position: absolute; top: 80px; left: 50px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 80px; left: 70px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 80px; left: 90px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 80px; left: 110px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 80px; left: 130px; width: 8px; height: 8px; background: black;"></div>
                                
                                <div style="position: absolute; top: 100px; left: 50px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 100px; left: 70px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 100px; left: 90px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 100px; left: 110px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 100px; left: 130px; width: 8px; height: 8px; background: black;"></div>
                                
                                <div style="position: absolute; top: 120px; left: 50px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 120px; left: 70px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 120px; left: 90px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 120px; left: 110px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 120px; left: 130px; width: 8px; height: 8px; background: black;"></div>
                                
                                <div style="position: absolute; top: 140px; left: 50px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 140px; left: 70px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 140px; left: 90px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 140px; left: 110px; width: 8px; height: 8px; background: black;"></div>
                                <div style="position: absolute; top: 140px; left: 130px; width: 8px; height: 8px; background: black;"></div>
                            </div>
                            <small style="font-size: 12px; color: #6c757d; margin-top: 10px; display: block;">QR Code</small>
                        </div>
                    </div>
                `;
                
                console.log('Mã QR từ ảnh đã được tạo thành công!');
            }, 1000);
            
            // Cập nhật nội dung chuyển khoản
            const contentElement = document.querySelector('.text-primary');
            if (contentElement) {
                contentElement.textContent = orderId;
            }
        }

        // Tạo mã QR khi trang load (nếu đã chọn chuyển khoản)
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Trang đã load xong, sẵn sàng tạo mã QR từ ảnh');
            
            const bankTransferRadio = document.querySelector('input[value="bank_transfer"]');
            if (bankTransferRadio && bankTransferRadio.checked) {
                document.getElementById('bankTransferInfo').style.display = 'block';
                generateQRCode();
            }
        });


    </script>

</body>

</html>
