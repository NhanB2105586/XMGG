<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Cart;

class AjaxCartController extends Controller
{
    private $cartModel;

    public function __construct()
    {
        parent::__construct();
        $this->cartModel = new Cart($this->db);
    }

    public function addToCart()
    {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập để thêm vào giỏ hàng']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;
            
            if (!$productId) {
                echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ']);
                return;
            }

            try {
                // Thêm sản phẩm vào giỏ hàng
                $this->cartModel->addProduct($_SESSION['user_id'], $productId, $quantity);
                
                // Cập nhật lại số loại sản phẩm trong session
                $_SESSION['cart_product_count'] = $this->cartModel->getProductCountByUserId($_SESSION['user_id']);
                
                echo json_encode(['success' => true, 'message' => 'Đã thêm vào giỏ hàng']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phương thức không được hỗ trợ']);
        }
    }
} 