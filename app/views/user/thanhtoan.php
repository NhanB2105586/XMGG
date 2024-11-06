<?php
include_once __DIR__ . '/../partials/header.php';
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
                            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ giao hàng</label>
                        <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
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
                                                <img src="/images/upload/<?php echo htmlspecialchars($item['image_url'] ?? 'default.jpg'); ?>"
                                                    alt="Product Image" style="width: 50px; height: 50px;">
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

    <script>
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

            return valid;
        };

        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>

</body>

</html>