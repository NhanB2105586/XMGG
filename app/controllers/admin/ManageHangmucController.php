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
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $content = $_POST['content'] ?? '';
            
            // Handle image upload
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../../public/images/hangmuc/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imagePath = '/images/hangmuc/' . $fileName;
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
            echo json_encode($pageData);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Không tìm thấy trang']);
        }
    }
}
