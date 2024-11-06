<?php

namespace App\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Controllers\Controller;

class ManageOrderController extends Controller
{
    protected $orderModel;
    protected $orderDetailModel;
    protected $productModel;
    protected $userModel;

    public function __construct()
    {
        parent::__construct(); // Gọi constructor của Controller

        $this->orderModel = new Order($this->db);
        $this->orderDetailModel = new OrderDetail($this->db);
        $this->productModel = new Product($this->db);
        $this->userModel = new User($this->db);
    }

    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $limit = 10; // Số đơn hàng hiển thị mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

        // Lấy danh sách đơn hàng
        $orders = $this->orderModel->getAllOrders($limit, $offset, $searchTerm);
        $totalOrders = $this->orderModel->getTotalOrders($searchTerm);
        $totalPages = ceil($totalOrders / $limit);

        // Truyền dữ liệu vào view
        $this->sendPage('admin/viewOrder', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'searchTerm' => $searchTerm
        ]);
    }

    // Xem chi tiết đơn hàng
    public function viewOrder($orderId)
    {
        // Lấy thông tin đơn hàng và chi tiết đơn hàng
        $orderDetail = $this->orderDetailModel->getByOrderId($orderId);
        $order = $this->orderModel->getOrderById($orderId);
        if (!$order) {
            $this->sendNotFound(); // Nếu không tìm thấy đơn hàng, trả về trang lỗi 404
            return;
        }
        // Truyền dữ liệu vào view
        $this->sendPage('admin/viewOrder', [
            'order' => $order,
            'orderdetail' => $orderDetail
        ]);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus()
    {
        // Kiểm tra nếu có dữ liệu từ form
        if (isset($_POST['order_id']) && isset($_POST['status'])) {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];

            // Cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
            $updated = $this->orderModel->updateStatus($orderId, $status);

            if ($updated) {
                $_SESSION['success_message'] = 'Cập nhật trạng thái đơn hàng thành công.';
            } else {
                $_SESSION['error_message'] = 'Cập nhật trạng thái đơn hàng thất bại.';
            }
        }

        // Điều hướng lại về trang quản lý đơn hàng
        header('Location: /admin/viewOrders');
        exit;
    }


    // Xóa đơn hàng
    public function deleteOrder($orderId)
    {
        // Kiểm tra xem đơn hàng có tồn tại không
        $order = $this->orderModel->getOrderById($orderId);
        if (!$order) {
            $this->sendNotFound(); // Nếu không tìm thấy đơn hàng, trả về trang lỗi 404
            return;
        }

        // Xóa đơn hàng
        $deleted = $this->orderModel->deleteOrder($orderId);
        if ($deleted) {
            $_SESSION['success_message'] = 'Đơn hàng đã được xóa thành công.';
        } else {
            $_SESSION['error_message'] = 'Xóa đơn hàng thất bại.';
        }
        header('Location: /admin/viewOrders');
        exit;
    }

    // Lấy tổng doanh thu
    public function getRevenue()
    {
        $totalRevenue = $this->orderModel->calculateRevenue();
        $this->handleSuccess('Doanh thu tổng cộng', ['revenue' => $totalRevenue]);
    }

    // Lấy tổng số đơn hàng đã hoàn thành
    public function getSuccessfulOrders()
    {
        $totalSuccessfulOrders = $this->orderModel->countSuccessfulOrders();
        $this->handleSuccess('Tổng số đơn hàng thành công', ['successful_orders' => $totalSuccessfulOrders]);
    }
}