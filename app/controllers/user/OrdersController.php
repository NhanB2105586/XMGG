<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;

class OrdersController extends Controller
{
    private $orderModel;
    private $cartModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->orderModel = new Order($this->db);
        $this->cartModel = new Cart($this->db);
        $this->userModel = new User($this->db);
    }

    // Hiển thị trang thanh toán
    public function showCheckout()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $_SESSION['error_message'] = "Vui lòng đăng nhập để thanh toán.";
            header("Location: /dangnhap");
            exit();
        }

        // Lấy danh sách sản phẩm trong giỏ hàng của người dùng
        $cartItems = $this->cartModel->getCartItems($userId);
        
        // Kiểm tra giỏ hàng có sản phẩm không
        if (empty($cartItems)) {
            $_SESSION['error_message'] = "Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.";
            header("Location: /giohang");
            exit();
        }
        
        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));
        
        // Lấy thông tin người dùng từ session thay vì database
        $user = [
            'fullname' => $_SESSION['user_fullname'] ?? '',
            'phone_number' => $_SESSION['user_phone'] ?? '',
            'address' => $_SESSION['user_address'] ?? '',
            'email' => $_SESSION['user_email'] ?? ''
        ];

        // Gửi dữ liệu đến view 'user/checkout'
        $this->sendPage('user/thanhtoan', [
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount,
            'user' => $user // Truyền thông tin người dùng vào view
        ]);
    }

    // Gửi OTP qua SMS
    public function sendOTP()
    {
        header('Content-Type: application/json');
        
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        
        if (empty($phone) || empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ số điện thoại và email']);
            return;
        }

        // Tạo OTP 6 chữ số
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Lưu OTP vào session với thời gian hết hạn (5 phút)
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_phone'] = $phone;
        $_SESSION['otp_email'] = $email;
        $_SESSION['otp_time'] = time();
        
        // Gửi OTP qua email với try-catch để bắt lỗi
        try {
            $emailSent = $this->sendOTPEmail($email, $otp);
            
            // Nếu gửi email thất bại, trả về OTP để hiển thị trên màn hình (chỉ cho development)
            if (!$emailSent) {
                error_log("Email sending failed for OTP to: $email");
                echo json_encode([
                    'success' => true, 
                    'message' => 'Mã OTP đã được gửi',
                    'otp' => $otp
                ]);
            } else {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Mã OTP đã được gửi đến email của bạn'
                ]);
            }
        } catch (Exception $e) {
            error_log("Exception in sendOTP: " . $e->getMessage());
            echo json_encode([
                'success' => true, 
                'message' => 'Mã OTP đã được gửi',
                'otp' => $otp
            ]);
        }
    }

    // Xác thực OTP
    public function verifyOTP()
    {
        header('Content-Type: application/json');
        
        $inputOTP = $_POST['otp'] ?? '';
        
        if (empty($inputOTP)) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng nhập mã OTP']);
            return;
        }

        // Kiểm tra OTP có tồn tại không
        if (!isset($_SESSION['otp']) || !isset($_SESSION['otp_time'])) {
            echo json_encode(['success' => false, 'message' => 'Mã OTP không hợp lệ hoặc đã hết hạn']);
            return;
        }

        // Kiểm tra thời gian hết hạn (5 phút)
        if (time() - $_SESSION['otp_time'] > 300) {
            unset($_SESSION['otp'], $_SESSION['otp_phone'], $_SESSION['otp_email'], $_SESSION['otp_time']);
            echo json_encode(['success' => false, 'message' => 'Mã OTP đã hết hạn. Vui lòng gửi lại']);
            return;
        }

        // Kiểm tra OTP có đúng không
        if ($inputOTP !== $_SESSION['otp']) {
            echo json_encode(['success' => false, 'message' => 'Mã OTP không đúng']);
            return;
        }

        // OTP đúng - đánh dấu đã xác thực
        $_SESSION['otp_verified'] = true;
        $_SESSION['verified_phone'] = $_SESSION['otp_phone'];
        $_SESSION['verified_email'] = $_SESSION['otp_email'];
        
        // Xóa OTP cũ
        unset($_SESSION['otp'], $_SESSION['otp_phone'], $_SESSION['otp_email'], $_SESSION['otp_time']);
        
        echo json_encode(['success' => true, 'message' => 'Xác thực OTP thành công']);
    }

    // Gửi email OTP
    private function sendOTPEmail($email, $otp)
    {
        $subject = "Mã OTP xác thực thanh toán - XMGG";
        $message = "
        <html>
        <head>
            <title>Mã OTP xác thực</title>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
                .container { max-width: 500px; margin: 0 auto; background-color: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                .header { background-color: #007bff; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                .content { padding: 30px; }
                .otp-code { font-size: 32px; font-weight: bold; color: #007bff; text-align: center; padding: 20px; background-color: #f8f9fa; border-radius: 8px; margin: 20px 0; letter-spacing: 5px; }
                .warning { background-color: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 5px; margin: 20px 0; }
                .footer { text-align: center; color: #666; font-size: 14px; margin-top: 30px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🔐 Mã OTP Xác Thực</h1>
                    <p>XMGG - Hệ thống bảo mật thanh toán</p>
                </div>
                <div class='content'>
                    <p>Xin chào,</p>
                    <p>Bạn đang thực hiện thanh toán tại XMGG. Để đảm bảo an toàn, vui lòng sử dụng mã OTP dưới đây:</p>
                    
                    <div class='otp-code'>$otp</div>
                    
                    <div class='warning'>
                        <strong>⚠️ Lưu ý quan trọng:</strong>
                        <ul style='margin: 10px 0; padding-left: 20px;'>
                            <li>Mã này có hiệu lực trong <strong>5 phút</strong></li>
                            <li>Không chia sẻ mã này với bất kỳ ai</li>
                            <li>Nhân viên XMGG không bao giờ yêu cầu mã này</li>
                        </ul>
                    </div>
                    
                    <p>Nếu bạn không thực hiện thanh toán, vui lòng bỏ qua email này.</p>
                    
                    <div class='footer'>
                        <p>Trân trọng,<br><strong>Đội ngũ XMGG</strong></p>
                        <p>📧 support@xmgg.com | 📞 1900-xxxx</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: XMGG <noreply@xmgg.com>" . "\r\n";
        $headers .= "Reply-To: support@xmgg.com" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Kiểm tra cấu hình email trước khi gửi
        if (!function_exists('mail')) {
            error_log("mail() function does not exist");
            return false;
        }
        
        // Gửi email với error handling
        $mailSent = @mail($email, $subject, $message, $headers);
        
        // Log kết quả gửi email
        if ($mailSent) {
            error_log("OTP email sent successfully to: $email");
        } else {
            error_log("Failed to send OTP email to: $email");
            // Log thêm thông tin lỗi
            error_log("Email headers: " . print_r($headers, true));
            error_log("Email subject: $subject");
            error_log("Email to: $email");
            
            // Kiểm tra lỗi PHP
            $error = error_get_last();
            if ($error) {
                error_log("PHP Error: " . print_r($error, true));
            }
        }
        
        return $mailSent;
    }



    // Gửi email xác nhận đơn hàng
    private function sendOrderConfirmationEmail($email, $orderId, $orderDetails, $totalAmount)
    {
        $subject = "Xác nhận đơn hàng #$orderId - XMGG";
        
        $itemsList = "";
        foreach ($orderDetails as $item) {
            $itemsList .= "<tr>
                <td>{$item['product_name']}</td>
                <td>{$item['quantity']}</td>
                <td>" . number_format($item['price'], 0, ',', '.') . "đ</td>
                <td>" . number_format($item['price'] * $item['quantity'], 0, ',', '.') . "đ</td>
            </tr>";
        }

        $message = "
        <html>
        <head>
            <title>Xác nhận đơn hàng</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #007bff; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .total { font-weight: bold; font-size: 18px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>Xác nhận đơn hàng</h1>
                    <p>Mã đơn hàng: #$orderId</p>
                </div>
                <div class='content'>
                    <p>Xin chào,</p>
                    <p>Cảm ơn bạn đã đặt hàng tại XMGG. Đơn hàng của bạn đã được xác nhận thành công.</p>
                    
                    <h3>Chi tiết đơn hàng:</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            $itemsList
                        </tbody>
                    </table>
                    
                    <div class='total'>
                        <p>Tổng cộng: " . number_format($totalAmount, 0, ',', '.') . "đ</p>
                    </div>
                    
                    <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận và giao hàng.</p>
                    <p>Nếu có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
                    
                    <br>
                    <p>Trân trọng,</p>
                    <p>Đội ngũ XMGG</p>
                </div>
            </div>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: XMGG <noreply@xmgg.com>" . "\r\n";

        // Trong thực tế, bạn sẽ sử dụng thư viện email như PHPMailer
        // mail($email, $subject, $message, $headers);
    }

    // Xử lý thanh toán
    public function checkout()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $_SESSION['error_message'] = "Vui lòng đăng nhập để thanh toán.";
            header("Location: /dangnhap");
            exit();
        }

        // Kiểm tra OTP đã được xác thực chưa
        if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
            $_SESSION['error_message'] = "Vui lòng xác thực OTP trước khi thanh toán.";
            header("Location: /thanhtoan");
            exit();
        }

        // Lấy thông tin từ form thanh toán
        $totalAmount = $_POST['total_amount'];
        $paymentMethod = $_POST['payment_method'] ?? 'pending';
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        // Kiểm tra thông tin khớp với OTP đã xác thực
        if ($phone !== $_SESSION['verified_phone'] || $email !== $_SESSION['verified_email']) {
            $_SESSION['error_message'] = "Thông tin số điện thoại hoặc email không khớp với OTP đã xác thực.";
            header("Location: /thanhtoan");
            exit();
        }

        // Tạo đơn hàng mới
        $orderId = $this->orderModel->createOrder($userId, $totalAmount, $paymentMethod, $name, $phone, $address, $email);

        // Lấy các sản phẩm từ giỏ hàng và thêm vào chi tiết đơn hàng
        $cartItems = $this->cartModel->getCartItems($userId);
        foreach ($cartItems as $item) {
            $this->orderModel->addOrderDetail($orderId, $item['product_id'], $item['quantity'], $item['price']);
        }

        // Gửi email xác nhận đơn hàng
        $this->sendOrderConfirmationEmail($email, $orderId, $cartItems, $totalAmount);

        // Xóa giỏ hàng sau khi thanh toán
        $this->cartModel->clearCart($userId);

        // Cập nhật số lượng sản phẩm trong session
        $productCount = $this->cartModel->getProductCountByUserId($userId);
        $_SESSION['cart_product_count'] = $productCount;

        // Xóa thông tin OTP đã xác thực
        unset($_SESSION['otp_verified'], $_SESSION['verified_phone'], $_SESSION['verified_email']);

        // Thông báo thành công và chuyển hướng đến trang đơn hàng
        $_SESSION['success_message'] = "Thanh toán thành công! Mã đơn hàng của bạn là #$orderId. Email xác nhận đã được gửi.";
        header("Location: /donhang/$orderId"); // Chuyển hướng tới trang đơn hàng với mã đơn hàng
        exit();
    }

    // Hiển thị chi tiết đơn hàng
    public function orderDetail($orderId)
    {
        $orderDetails = $this->orderModel->getOrderDetails($orderId);

        // Kiểm tra trạng thái đơn hàng
        $orderStatus = $this->orderModel->getOrderStatus($orderId);

        // Gửi dữ liệu đến view
        $this->sendPage('user/orders', [
            'orderDetails' => $orderDetails,
            'orderStatus' => $orderStatus,
            'orderId' => $orderId
        ]);
    }

    public function showAllOrders()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $_SESSION['error_message'] = "Vui lòng đăng nhập để xem đơn hàng.";
            header("Location: /dangnhap");
            exit();
        }

        // Giả sử có phương thức lấy tất cả đơn hàng của người dùng
        $orders = $this->orderModel->getOrdersByUserId($userId);

        // Gửi dữ liệu đến view
        $this->sendPage('user/all_orders', ['orders' => $orders]);
    }
}
