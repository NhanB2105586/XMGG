<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Cart;
<<<<<<< HEAD
use App\Models\Product;
=======
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b

class AjaxCartController extends Controller
{
    private $cartModel;
<<<<<<< HEAD
    private $productModel;
=======
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b

    public function __construct()
    {
        parent::__construct();
        $this->cartModel = new Cart($this->db);
<<<<<<< HEAD
        $this->productModel = new Product($this->db);
=======
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
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
<<<<<<< HEAD
                // Kiểm tra số lượng sản phẩm hiện có
                $product = $this->productModel->getProductById($productId);
                
                if (!$product) {
                    echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
                    return;
                }

                if ($product['in_stock'] < $quantity) {
                    echo json_encode(['success' => false, 'message' => 'Số lượng sản phẩm không đủ. Chỉ còn ' . $product['in_stock'] . ' sản phẩm']);
                    return;
                }

                // Thêm sản phẩm vào giỏ hàng (KHÔNG trừ số lượng)
=======
                // Thêm sản phẩm vào giỏ hàng
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
                $this->cartModel->addProduct($_SESSION['user_id'], $productId, $quantity);
                
                // Cập nhật lại số loại sản phẩm trong session
                $_SESSION['cart_product_count'] = $this->cartModel->getProductCountByUserId($_SESSION['user_id']);
                
<<<<<<< HEAD
                echo json_encode([
                    'success' => true, 
                    'message' => 'Đã thêm vào giỏ hàng',
                    'current_stock' => $product['in_stock']
                ]);
=======
                echo json_encode(['success' => true, 'message' => 'Đã thêm vào giỏ hàng']);
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phương thức không được hỗ trợ']);
        }
    }
<<<<<<< HEAD

    public function getCartCount()
    {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['count' => 0]);
            return;
        }

        $count = $this->cartModel->getProductCountByUserId($_SESSION['user_id']);
        echo json_encode(['count' => $count]);
    }

    public function getFavoriteCount()
    {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['count' => 0]);
            return;
        }

        // Giả sử có model Favorite
        // $count = $this->favoriteModel->getFavoriteCountByUserId($_SESSION['user_id']);
        $count = 0; // Tạm thời
        echo json_encode(['count' => $count]);
    }

    public function getProductStock($productId)
    {
        header('Content-Type: application/json');
        
        try {
            $product = $this->productModel->getProductById($productId);
            
            if (!$product) {
                echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
                return;
            }
            
            echo json_encode([
                'success' => true,
                'in_stock' => $product['in_stock']
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
        }
    }

    // Method để trừ số lượng khi xác nhận mua hàng
    public function confirmPurchase()
    {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập để mua hàng']);
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
                // Kiểm tra số lượng sản phẩm hiện có
                $product = $this->productModel->getProductById($productId);
                
                if (!$product) {
                    echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
                    return;
                }

                if ($product['in_stock'] < $quantity) {
                    echo json_encode(['success' => false, 'message' => 'Số lượng sản phẩm không đủ. Chỉ còn ' . $product['in_stock'] . ' sản phẩm']);
                    return;
                }

                // Trừ số lượng sản phẩm trong kho khi xác nhận mua
                $newStock = $product['in_stock'] - $quantity;
                $this->productModel->updateStock($productId, $newStock);
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Đã mua hàng thành công',
                    'new_stock' => $newStock
                ]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phương thức không được hỗ trợ']);
        }
    }
} 
=======
} 
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
