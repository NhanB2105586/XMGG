<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Cart;

class CartController extends Controller
{
    private $cartModel;

    public function __construct()
    {
        parent::__construct();
        $this->cartModel = new Cart($this->db);
    }


    // Hiển thị giỏ hàng
    public function showgiohang($userId)
    {
        $cartModel = new Cart($this->db);

        // Lấy danh sách sản phẩm trong giỏ hàng của người dùng
        $cartItems = $cartModel->getCartItems($userId);

        // Gửi dữ liệu đến view 'user/giohang'
        $this->sendPage('user/giohang', ['cartItems' => $cartItems]);
    }


    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($productId)
    {
        $userId = $_SESSION['user_id'] ?? null;
        $cart = $this->cartModel->getCartByUserId($userId);

        if ($cart) {
            // Xóa sản phẩm khỏi giỏ hàng
            $this->cartModel->removeProduct($cart['cart_id'], $productId);

            // Thiết lập thông báo thành công
            $_SESSION['success_message'] = "Sản phẩm đã được xóa khỏi giỏ hàng thành công!";
        } else {
            $_SESSION['error_message'] = "Không tìm thấy giỏ hàng.";
        }

        // Cập nhật lại số loại sản phẩm trong session
        $cartModel = new Cart($this->db); // Giả sử bạn có model Cart
        $_SESSION['cart_product_count'] = $cartModel->getProductCountByUserId($userId);

        // Chuyển hướng về trang giỏ hàng
        header("Location: /giohang");
        exit();
    }


    



    public function updateCart()
    {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $_SESSION['error_message'] = "Vui lòng đăng nhập để cập nhật giỏ hàng.";
            header("Location: /dangnhap");
            exit();
        }

        $quantities = $_POST['quantities'] ?? [];
        $errors = [];

        foreach ($quantities as $productId => $newQuantity) {
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product = $this->cartModel->getProductById($productId);

            // Lấy số lượng hiện tại trong giỏ hàng của sản phẩm này
            $currentQuantity = $this->cartModel->getCurrentQuantityInCart($userId, $productId);
            $originalStock = $product['in_stock'] + $currentQuantity;
            // Tính sự thay đổi số lượng
            $quantity_delta = $newQuantity - $currentQuantity;

            if ($quantity_delta > 0 && $quantity_delta > $product['in_stock']) {
                // Nếu số lượng tăng và vượt quá `in_stock`, hiển thị thông báo lỗi
                $errors[] = "Sản phẩm {$product['product_name']} chỉ có {$originalStock} sản phẩm trong kho!";
                // Trả lại số lượng hiện tại trong giỏ hàng thay vì cập nhật
                $_POST['quantities'][$productId] = $currentQuantity;
            } else {
                // Nếu số lượng hợp lệ, cập nhật số lượng trong giỏ hàng và điều chỉnh `in_stock`
                $this->cartModel->updateQuantity($userId, $productId, $newQuantity);

                // Cập nhật `in_stock` dựa trên thay đổi số lượng
                $newStock = $product['in_stock'] - $quantity_delta;
                $this->cartModel->updateInStock($productId, $newStock);
            }
        }

        if (!empty($errors)) {
            $_SESSION['error_message'] = implode("<br>", $errors);
        } else {
            $_SESSION['success_message'] = "Giỏ hàng đã được cập nhật thành công!";
        }

        header("Location: /giohang");
        exit();
    }




    public function addToCart($userId, $productId, $quantity)
    {
        if (!$userId) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            $_SESSION['error_message'] = "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.";
            header("Location: /dangnhap");
            exit();
        }

        // Thêm sản phẩm vào giỏ hàng
        $this->cartModel->addProduct($userId, $productId, $quantity);

        // Cập nhật lại số loại sản phẩm trong session
        $_SESSION['cart_product_count'] = $this->cartModel->getProductCountByUserId($userId);

        // Thiết lập thông báo thành công
        $_SESSION['success_message'] = "Sản phẩm đã được thêm vào giỏ hàng thành công!";

        // Chuyển hướng về trang giỏ hàng
        header("Location: /giohang");
        exit();
    }

}
