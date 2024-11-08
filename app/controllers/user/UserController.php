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

        // Lấy 8 sản phẩm mới
        $newProducts = $productModel->getNewProducts(8);

        // Lấy 8 sản phẩm bán chạy (giả định rằng bạn đã có hàm này)
        $bestsellers = $productModel->getBestSellers(8);

        // Lấy hình ảnh cho từng sản phẩm mới
        foreach ($newProducts as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
        }

        // Lấy hình ảnh cho từng sản phẩm bán chạy
        foreach ($bestsellers as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
        }

        // Gửi dữ liệu đến view
        $this->sendPage('user/homePage', [
            'newProducts' => $newProducts,
            'bestsellers' => $bestsellers,
        ]);
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
        $this->sendPage('/user/auth/dangnhap');
    }

    public function showdangki()
    {
        $this->sendPage('/user/auth/dangki');
    }

    public function showkhoiphuc()
    {
        $this->sendPage('/user/auth/khoiphucmatkhau');
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

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $fullName = $_POST['fullname'] ?? '';
            $phoneNumber = $_POST['phone_number'] ?? '';
            $address = $_POST['address'] ?? '';
            $userId = $_SESSION['user_id']; // Giả sử bạn lưu trữ ID người dùng trong session

            

            // Cập nhật thông tin vào cơ sở dữ liệu
            $userModel = new User($this->db);
            $updateSuccess = $userModel->updateUserProfile($userId, $fullName, $phoneNumber, $address);
     
            if ($updateSuccess) {
                $user = $userModel->getUserById($userId);
                $_SESSION['username'] = $user['fullname'];
                // Nếu cập nhật thành công, chuyển hướng với thông báo thành công
                header('Location: /hoso?success=1');
                exit();
            } else {
                // Xử lý lỗi (nếu cần)
                $_SESSION['error_message'] = 'Cập nhật thông tin không thành công. Vui lòng thử lại.';
                header('Location: /hoso');
                exit();
            }
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION['success_message'] = "Đăng xuất thành công!"; // Thiết lập thông báo trước
        session_unset();
        session_destroy();
        header('Location: /dangnhap');
        exit();
    }


}
