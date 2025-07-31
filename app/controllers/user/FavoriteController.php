<?php

namespace App\Controllers\User;

use App\Models\Favorite;
use App\Controllers\Controller;

class FavoriteController extends Controller
{
    private $favoriteModel;

    public function __construct()
    {
        parent::__construct();
        $this->favoriteModel = new Favorite($this->db);
    }

    public function addFavorite()
    {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập để yêu thích sản phẩm']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            
            if (!$productId) {
                echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ']);
                return;
            }

            try {
                $result = $this->favoriteModel->addFavorite($_SESSION['user_id'], $productId);
                
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Đã thêm vào danh sách yêu thích']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm vào yêu thích']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Phương thức không được hỗ trợ']);
        }
    }

    public function removeFavorite()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            
            if (!$productId) {
                echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ']);
                return;
            }

            $result = $this->favoriteModel->removeFavorite($_SESSION['user_id'], $productId);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Đã xóa khỏi danh sách yêu thích']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra']);
            }
        }
    }

    public function showFavorites()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /dangnhap');
            return;
        }

        $favorites = $this->favoriteModel->getUserFavorites($_SESSION['user_id']);
        
        // Debug: Kiểm tra dữ liệu
        error_log("Favorites count: " . count($favorites));
        
        // Sử dụng include trực tiếp thay vì sendPage
        include_once __DIR__ . '/../../views/partials/header.php';
        include_once __DIR__ . '/../../views/partials/navbar.php';
        include_once __DIR__ . '/../../views/user/favorites.php';
        include_once __DIR__ . '/../../views/partials/footer.php';
    }

    public function getFavoriteStatus()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['isFavorite' => false]);
            return;
        }

        $productId = $_GET['product_id'] ?? null;
        
        if (!$productId) {
            echo json_encode(['isFavorite' => false]);
            return;
        }

        $isFavorite = $this->favoriteModel->isFavorite($_SESSION['user_id'], $productId);
        echo json_encode(['isFavorite' => $isFavorite]);
    }
} 