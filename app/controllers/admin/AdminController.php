<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Model;
use PDO;

class AdminController extends Controller
{
    private Model $model;
    public function __construct(PDO $pdo)
    {
        $this->model = new Model($pdo);
        parent::__construct();
    }
    public function getStatistics()
    {
        // Lấy số lượng người dùng
        $userCount = $this->model->countUsers();

        // Lấy số lượng đơn hàng
        $orderCount = $this->model->countOrders();

        // Lấy số lượng đơn hàng thành công
        $successfulOrders = $this->model->countSuccessfulOrders();

        // Lấy doanh thu
        $revenue = $this->model->calculateRevenue();

        return [
            'userCount' => $userCount,
            'orderCount' => $orderCount,
            'successfulOrders' => $successfulOrders,
            'revenue' => $revenue,
        ];
    }

    public function index()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /admin/login');
            exit;
        }
        // Lấy số liệu thống kê
        $data = $this->getStatistics();
        
        $this->sendPage('/admin/dashboard', [
            'admin' => $_SESSION['admin'],
            'userCount' => $data['userCount'],
            'orderCount' => $data['orderCount'],
            'successfulOrders' => $data['successfulOrders'],
            'revenue' => $data['revenue'],
        ]);
    }
    // Hiển thị trang đăng nhập
    public function showLogin()
    {
        $this->sendPage('/admin/authAdmin/loginAdmin', []);
    }

    public function login()
    {
        // Kiểm tra nếu là yêu cầu POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Làm sạch và lấy dữ liệu từ biểu mẫu
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $remember = isset($_POST['remember']);

            // Kiểm tra thông tin đăng nhập
            if ($username === 'admin' && $password === '123123') {
                // Nếu đăng nhập thành công, lưu thông tin admin vào session
                $_SESSION['admin'] = ['email' => $username]; // Lưu thông tin admin

                // Nếu chọn "Ghi nhớ tôi", lưu cookie
                if ($remember) {
                    setcookie('admin_email', $username, time() + (86400 * 30), "/"); // Cookie có hiệu lực trong 30 ngày
                }

                // Chuyển hướng đến trang admin
                header('Location: /admin');
                exit;
            } else {
                // Nếu đăng nhập không thành công, tạo thông báo lỗi
                $errors['login'] = "username hoặc mật khẩu không đúng.";
                $this->sendPage('/admin/authAdmin/loginAdmin', ['errors' => $errors]); // Đảm bảo đường dẫn chính xác
            }
        } else {
            // Nếu không phải là yêu cầu POST, chuyển hướng đến trang đăng nhập
            header('Location: /admin/login');
            exit;
        }
    }

    // Đăng xuất admin
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /admin/login');
        exit;
    }
    
}