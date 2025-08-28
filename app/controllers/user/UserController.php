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

        // Lấy sản phẩm từ các danh mục nội thất cụ thể: đèn trang trí, tranh, tủ ly
        $noithatProducts = [];
        
        // Lấy sản phẩm từ danh mục đèn trang trí (category_id = 18)
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = 18 ORDER BY product_id ASC LIMIT 8");
        $stmt->execute();
        $denProducts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($denProducts as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
            $product['category_name'] = 'Đèn trang trí';
        }
        $noithatProducts = array_merge($noithatProducts, $denProducts);
        
        // Lấy sản phẩm từ danh mục tranh (category_id = 19)
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = 19 ORDER BY product_id ASC LIMIT 8");
        $stmt->execute();
        $tranhProducts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($tranhProducts as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
            $product['category_name'] = 'Tranh';
        }
        $noithatProducts = array_merge($noithatProducts, $tranhProducts);
        
        // Lấy sản phẩm từ danh mục tủ ly (category_id = 13)
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = 13 ORDER BY product_id ASC LIMIT 8");
        $stmt->execute();
        $tulyProducts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($tulyProducts as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
            $product['category_name'] = 'Tủ ly';
        }
        $noithatProducts = array_merge($noithatProducts, $tulyProducts);

        // Lấy hình ảnh cho từng sản phẩm mới
        foreach ($newProducts as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
        }

        // Lấy hình ảnh cho từng sản phẩm bán chạy
        foreach ($bestsellers as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
        }

        // Gửi dữ liệu đến view
        $this->sendPage('user/homePage', [
            'newProducts' => $newProducts,
            'bestsellers' => $bestsellers,
            'noithatProducts' => $noithatProducts,
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

    // Methods cho các hạng mục mới
    public function showvach()
    {
        $this->sendPage('user/vach');
    }

    public function showcua()
    {
        $this->sendPage('user/cua');
    }

    public function showhangrao()
    {
        $this->sendPage('user/hangrao');
    }

    public function showlam()
    {
        $this->sendPage('user/lam');
    }

    public function showsan()
    {
        $this->sendPage('user/san');
    }

    public function showtran()
    {
        $this->sendPage('user/tran');
    }

    public function showcauthang()
    {
        $this->sendPage('user/cauthang');
    }

    public function showbonhoa()
    {
        $this->sendPage('user/bonhoa');
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
                $this->sendPage('user/auth/dangnhap', ['error' => $error]); // Trả lại trang đăng nhập với lỗi
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
            $userId = $_SESSION['user_id'];
            $currentAvatar = $_POST['current_avatar'] ?? '/images/avatar.jpg';
            
            // Debug: Log thông tin
            error_log("Update Profile - User ID: " . $userId);
            error_log("Current Avatar: " . $currentAvatar);
            error_log("Files: " . print_r($_FILES, true));
            
            // Xử lý upload ảnh đại diện
            $avatarPath = $currentAvatar;
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../../public/images/imageupload/';
                
                // Debug: Log đường dẫn
                error_log("Upload Directory: " . $uploadDir);
                
                // Tạo thư mục nếu chưa tồn tại
                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0777, true)) {
                        error_log("Failed to create directory: " . $uploadDir);
                        header('Location: /hoso?error=Không thể tạo thư mục upload.');
                        exit();
                    }
                }
                
                // Kiểm tra quyền ghi
                if (!is_writable($uploadDir)) {
                    error_log("Directory not writable: " . $uploadDir);
                    header('Location: /hoso?error=Thư mục upload không có quyền ghi.');
                    exit();
                }
                
                $file = $_FILES['avatar'];
                $fileName = $file['name'];
                $fileSize = $file['size'];
                $fileTmp = $file['tmp_name'];
                $fileType = $file['type'];
                
                // Debug: Log thông tin file
                error_log("File Name: " . $fileName);
                error_log("File Size: " . $fileSize);
                error_log("File Type: " . $fileType);
                error_log("Temp Path: " . $fileTmp);
                
                // Kiểm tra kích thước file (max 5MB)
                if ($fileSize > 5 * 1024 * 1024) {
                    header('Location: /hoso?error=File ảnh quá lớn. Vui lòng chọn file nhỏ hơn 5MB.');
                    exit();
                }
                
                // Kiểm tra loại file
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedTypes)) {
                    header('Location: /hoso?error=Vui lòng chọn file ảnh hợp lệ (JPG, PNG, GIF).');
                    exit();
                }
                
                // Tạo tên file mới
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = 'avatar_' . $userId . '_' . time() . '.' . $fileExtension;
                $uploadPath = $uploadDir . $newFileName;
                
                // Debug: Log đường dẫn upload
                error_log("Upload Path: " . $uploadPath);
                
                // Upload file
                if (move_uploaded_file($fileTmp, $uploadPath)) {
                    $avatarPath = '/images/imageupload/' . $newFileName;
                    error_log("Upload successful. New avatar path: " . $avatarPath);
                    
                    // Xóa ảnh cũ nếu không phải ảnh mặc định
                    if ($currentAvatar !== '/images/avatar.jpg' && file_exists(__DIR__ . '/../../../public' . $currentAvatar)) {
                        unlink(__DIR__ . '/../../../public' . $currentAvatar);
                        error_log("Deleted old avatar: " . $currentAvatar);
                    }
                } else {
                    error_log("Upload failed. Error: " . error_get_last()['message']);
                    header('Location: /hoso?error=Không thể upload ảnh. Vui lòng thử lại.');
                    exit();
                }
            } else {
                error_log("No file uploaded or upload error: " . ($_FILES['avatar']['error'] ?? 'No file'));
            }

            // Debug: Log avatar path before database update
            error_log("Avatar path to save: " . $avatarPath);

            // Cập nhật thông tin vào cơ sở dữ liệu
            $userModel = new User($this->db);
            $updateSuccess = $userModel->updateUserProfileWithAvatar($userId, $fullName, $phoneNumber, $address, $avatarPath);
     
            if ($updateSuccess) {
                $user = $userModel->getUserById($userId);
                $_SESSION['username'] = $user['fullname'];
                $_SESSION['avatar'] = $user['avatar'];
                
                error_log("Profile updated successfully. New avatar in session: " . $_SESSION['avatar']);
                
                // Nếu cập nhật thành công, chuyển hướng với thông báo thành công
                header('Location: /hoso?success=1');
                exit();
            } else {
                error_log("Database update failed");
                // Xử lý lỗi (nếu cần)
                header('Location: /hoso?error=Cập nhật thông tin không thành công. Vui lòng thử lại.');
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
