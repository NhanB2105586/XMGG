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
        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));
        $user = $this->userModel->getUserById($userId); // Giả sử bạn đã có model User và phương thức getUserById

        // Gửi dữ liệu đến view 'user/checkout'
        $this->sendPage('user/thanhtoan', [
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount,
            'user' => $user // Truyền thông tin người dùng vào view
        ]);
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

        // Lấy thông tin từ form thanh toán
        $totalAmount = $_POST['total_amount'];
        $paymentMethod = $_POST['payment_method'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        // Tạo đơn hàng mới
        $orderId = $this->orderModel->createOrder($userId, $totalAmount, $paymentMethod, $name, $phone, $address, $email);

        // Lấy các sản phẩm từ giỏ hàng và thêm vào chi tiết đơn hàng
        $cartItems = $this->cartModel->getCartItems($userId);
        foreach ($cartItems as $item) {
            $this->orderModel->addOrderDetail($orderId, $item['product_id'], $item['quantity'], $item['price']);
        }

        // Xóa giỏ hàng sau khi thanh toán
        $this->cartModel->clearCart($userId);

        // Thông báo thành công và chuyển hướng đến trang đơn hàng
        $_SESSION['success_message'] = "Thanh toán thành công! Mã đơn hàng của bạn là #$orderId";
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
