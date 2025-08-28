<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Hangmuc;

// Include HangmucProducts model directly
require_once __DIR__ . '/../../models/hangmuc_products.php';
use App\Models\HangmucProducts;

class ManageHangmucProductsController extends Controller
{
    private $hangmucProductsModel;
    private $hangmucModel;

    public function __construct()
    {
        parent::__construct();
        $this->hangmucProductsModel = new HangmucProducts($this->db);
        $this->hangmucModel = new Hangmuc($this->db);
    }

    public function showHangmucProducts($slug = null)
    {
        if (!$slug) {
            // Hiển thị danh sách tất cả hạng mục
            $hangmucPages = $this->hangmucModel->getAllHangmucPages();
            $this->sendPage('admin/hangmuc_products_list', [
                'hangmucPages' => $hangmucPages
            ]);
            return;
        }

        // Hiển thị sản phẩm của hạng mục cụ thể
        $hangmucPage = $this->hangmucModel->getHangmucPageBySlug($slug);
        $products = $this->hangmucProductsModel->getProductsByHangmucSlugForAdmin($slug);

        $this->sendPage('admin/hangmuc_products', [
            'hangmucPage' => $hangmucPage,
            'products' => $products,
            'slug' => $slug
        ]);
    }

    public function createProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $slug = $_POST['hangmuc_slug'] ?? '';
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $sortOrder = $_POST['sort_order'] ?? 0;
            $isActive = isset($_POST['is_active']) ? 1 : 0;

            // Xử lý upload hình ảnh
            $imagePath = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../../public/images/imageupload/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $imagePath = '/images/imageupload/' . $fileName;
                }
            }

            $data = [
                'hangmuc_slug' => $slug,
                'title' => $title,
                'description' => $description,
                'image_path' => $imagePath,
                'sort_order' => $sortOrder,
                'is_active' => $isActive
            ];

            if ($this->hangmucProductsModel->createProduct($data)) {
                header('Location: /admin/hangmuc-products/' . $slug . '?success=created');
            } else {
                header('Location: /admin/hangmuc-products/' . $slug . '?error=create_failed');
            }
            exit;
        }
    }

    public function updateProduct($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = $this->hangmucProductsModel->getProductById($id);
            if (!$product) {
                header('Location: /admin/hangmuc-products?error=product_not_found');
                exit;
            }

            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $sortOrder = $_POST['sort_order'] ?? 0;
            $isActive = isset($_POST['is_active']) ? 1 : 0;

            $data = [
                'title' => $title,
                'description' => $description,
                'sort_order' => $sortOrder,
                'is_active' => $isActive
            ];

            // Xử lý upload hình ảnh mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../../public/images/imageupload/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $data['image_path'] = '/images/imageupload/' . $fileName;
                }
            }

            if ($this->hangmucProductsModel->updateProduct($id, $data)) {
                header('Location: /admin/hangmuc-products/' . $product['hangmuc_slug'] . '?success=updated');
            } else {
                header('Location: /admin/hangmuc-products/' . $product['hangmuc_slug'] . '?error=update_failed');
            }
            exit;
        }
    }

    public function deleteProduct($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = $this->hangmucProductsModel->getProductById($id);
            if (!$product) {
                header('Location: /admin/hangmuc-products?error=product_not_found');
                exit;
            }

            if ($this->hangmucProductsModel->deleteProduct($id)) {
                header('Location: /admin/hangmuc-products/' . $product['hangmuc_slug'] . '?success=deleted');
            } else {
                header('Location: /admin/hangmuc-products/' . $product['hangmuc_slug'] . '?error=delete_failed');
            }
            exit;
        }
    }

    public function toggleActive($id)
    {
        if ($this->hangmucProductsModel->toggleActive($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function getProduct($id)
    {
        try {
            $product = $this->hangmucProductsModel->getProductById($id);
            if ($product) {
                echo json_encode(['success' => true, 'product' => $product]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Product not found']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function updateSortOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (isset($data['id']) && isset($data['sort_order'])) {
                if ($this->hangmucProductsModel->updateSortOrder($data['id'], $data['sort_order'])) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Missing parameters']);
            }
        }
    }
}
