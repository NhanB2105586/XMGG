<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Hangmuc;

class ManageHangmucController extends Controller
{
    private $hangmucModel;

    public function __construct($pdo)
    {
        parent::__construct($pdo);
        $this->hangmucModel = new Hangmuc($pdo);
    }

    public function index()
    {
        $hangmucPages = $this->hangmucModel->getAllHangmucPages();
        $this->sendPage('admin/hangmuc', [
            'hangmucPages' => $hangmucPages
        ]);
    }

    public function update($pageId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $content = trim($_POST['content'] ?? '');
            
            // Validation
            if (empty($title)) {
                $_SESSION['error_message'] = 'Tiêu đề không được để trống!';
                header('Location: /admin/hangmuc');
                exit;
            }
            
            // Handle image upload
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['image']);
                if ($uploadResult['success']) {
                    $imagePath = $uploadResult['path'];
                } else {
                    $_SESSION['error_message'] = $uploadResult['error'];
                    header('Location: /admin/hangmuc');
                    exit;
                }
            }
            
            $result = $this->hangmucModel->updateHangmucPage($pageId, $title, $description, $content, $imagePath);
            
            if ($result) {
                $_SESSION['success_message'] = 'Cập nhật hạng mục thành công!';
            } else {
                $_SESSION['error_message'] = 'Có lỗi xảy ra khi cập nhật hạng mục!';
            }
            
            header('Location: /admin/hangmuc');
            exit;
        }
    }

    public function getPageData($pageId)
    {
        $pageData = $this->hangmucModel->getHangmucPageById($pageId);
        if ($pageData) {
            header('Content-Type: application/json');
            echo json_encode($pageData);
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Không tìm thấy trang']);
        }
    }

    private function handleImageUpload($file)
    {
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'error' => 'Chỉ chấp nhận file JPG, PNG, GIF!'];
        }
        
        // Validate file size (5MB max)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'File quá lớn! Kích thước tối đa 5MB.'];
        }
        
        // Create upload directory
        $uploadDir = __DIR__ . '/../../../public/images/hangmuc/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                return ['success' => false, 'error' => 'Không thể tạo thư mục upload!'];
            }
        }
        
        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = 'hangmuc_' . time() . '_' . uniqid() . '.' . $extension;
        $targetPath = $uploadDir . $fileName;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return [
                'success' => true, 
                'path' => '/images/hangmuc/' . $fileName
            ];
        } else {
            return ['success' => false, 'error' => 'Không thể upload file!'];
        }
    }
}
