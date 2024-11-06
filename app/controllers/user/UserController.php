<?php

namespace App\Controllers\User;
use App\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Cart;

class UserController extends Controller
{

    public function showindex()
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);

        // Lấy tất cả sản phẩm
        $products = $productModel->getAllProducts();

        // Lấy hình ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
        }

        // Gửi dữ liệu đến view 'user/homePage'
        $this->sendPage('user/homePage', ['products' => $products]);
    }

    public function showphongkhach()
    {
        $this->sendPage('user/phongkhach/phongkhach');
    }
    public function showphongan()
    {
        $this->sendPage('user/phongan/phongan');
    }
    public function showphongngu()
    {
        $this->sendPage('user/phongngu/phongngu');
    }
    public function showphonglamviec()
    {
        $this->sendPage('user/phonglamviec/phonglamviec');
    }

    public function showlienhe()
    {
        $this->sendPage('user/lienhe');
    }

    public function showdangnhap()
    {
        $this->sendPage('auth/dangnhap');
    }

    public function showdangki()
    {
        $this->sendPage('auth/dangki');
    }

    public function showkhoiphuc()
    {
        $this->sendPage('auth/khoiphucmatkhau');
    }

    public function showbosuutap()
    {
        $this->sendPage('user/bosuutap');
    }

    public function showhoso()
    {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $userModel = new User($this->db);
        $user = $userModel->getUserById($_SESSION['user_id']);

        // Truyền đối tượng người dùng vào view 'user/hoso'
        $this->sendPage('user/hoso', ['user' => $user]);
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User($this->db);
            $user = $userModel->authenticate($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['success_message'] = "Đăng nhập thành công!";
                $_SESSION['username']= $user['fullname'];

                $cartModel = new Cart($this->db); // Giả sử bạn có model Cart
                $productCount = $cartModel->getProductCountByUserId($user['user_id']);
                $_SESSION['cart_product_count'] = $productCount;


                header('Location: /'); // Redirect to home page
                exit();
            } else {
                $error = "Email hoặc mật khẩu không đúng.";
                $this->sendPage('auth/dangnhap', ['error' => $error]); // Trả lại trang đăng nhập với lỗi
            }
        }
    }

    public function handleRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = $_POST['full_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            // Kiểm tra tính hợp lệ của dữ liệu
            if ($password !== $confirmPassword) {
                $_SESSION['error_message'] = "Mật khẩu không khớp.";
                header('Location: /dangki');
                exit();
            }

            $userModel = new User($this->db);
            $registrationSuccess = $userModel->registerUser($fullName, $email, $phone, $address, $password);

            if ($registrationSuccess) {
                $_SESSION['success_message'] = "Đăng ký thành công! Bạn có thể đăng nhập ngay.";
                header('Location: /dangnhap'); // Chuyển hướng về trang đăng nhập
                exit();
            } else {
                $_SESSION['error_message'] = "Đăng ký không thành công. Vui lòng thử lại.";
                header('Location: /dangki'); // Quay lại trang đăng ký
                exit();
            }
        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $_SESSION['success_message'] = "Đăng xuất thành công!";
        header('Location: /dangnhap');
        exit();
    }

}
