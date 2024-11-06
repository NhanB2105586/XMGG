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
                $_SESSION['username']= $user['username'];

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

    public function logout()
    {
        session_start();
        session_unset(); // Xóa tất cả các biến session
        session_destroy(); // Hủy session
        header('Location: /dangnhap'); // Chuyển hướng về trang đăng nhập
        exit();
    }
}
