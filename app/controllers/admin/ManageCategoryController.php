<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Category;

class ManageCategoryController extends Controller
{
    private $categoryModel;

    public function __construct($db)
    {
        parent::__construct($db);
        $this->categoryModel = new Category($db);
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        // Phân trang - 10 danh mục mỗi trang
        $itemsPerPage = 10;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $searchTerm = $_GET['search'] ?? '';
        
        // Tính offset
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Lấy danh mục theo trang và tìm kiếm
        if (!empty($searchTerm)) {
            $categories = $this->categoryModel->getCategoriesSearch($itemsPerPage, $offset, $searchTerm);
            $totalCategories = $this->categoryModel->getTotalCategoriesSearch($searchTerm);
        } else {
            $categories = $this->categoryModel->getCategoriesSearch($itemsPerPage, $offset);
            $totalCategories = $this->categoryModel->getTotalCategoriesSearch();
        }
        
        // Tính tổng số trang
        $totalPages = ceil($totalCategories / $itemsPerPage);
        
        $this->sendPage('admin/viewCategory', [
            'categories' => $categories,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm,
            'totalCategories' => $totalCategories
        ]);
    }

    // Hiển thị form tạo danh mục mới
    public function create()
    {
        $this->sendPage('admin/addCategory');
    }

    // Lưu danh mục mới
    public function store()
    {
        $categoryName = $_POST['category_name'];
        $categoryType = $_POST['category_type'] ?? 'noithat';
        
        // TỰ ĐỘNG TẠO SLUG nếu không có hoặc trống
        $slug = $_POST['slug'] ?? '';
        if (empty($slug)) {
            $slug = $this->createSlugFromName($categoryName);
        }
        
        $data = [
            'category_name' => $categoryName,
            'slug' => $slug,
            'category_type' => $categoryType
        ];

        $result = $this->categoryModel->createCategory($data);
        
        if ($result) {
            $_SESSION['success_message'] = 'Danh mục đã được tạo thành công! Trang web và link đã được tạo tự động.';
        } else {
            $_SESSION['error_message'] = 'Có lỗi xảy ra khi tạo danh mục.';
        }

        header('Location: /admin/viewCategory');
        exit;
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            $_SESSION['error_message'] = 'Không tìm thấy danh mục.';
            header('Location: /admin/viewCategory');
            exit;
        }

        $this->sendPage('admin/editCategory', [
            'category' => $category
        ]);
    }

    // Cập nhật danh mục
    public function update($id)
    {
        $categoryName = $_POST['category_name'] ?? '';
        $categoryType = $_POST['category_type'] ?? 'noithat';
        
        // TỰ ĐỘNG TẠO SLUG nếu không có hoặc trống
        $slug = $_POST['slug'] ?? '';
        if (empty($slug)) {
            $slug = $this->createSlugFromName($categoryName);
        }
        
        $data = [
            'category_name' => $categoryName,
            'slug' => $slug,
            'category_type' => $categoryType,
            'description' => $_POST['description'] ?? ''
        ];

        $result = $this->categoryModel->updateCategory($id, $data);
        
        if ($result) {
            $_SESSION['success_message'] = 'Danh mục đã được cập nhật thành công! Trang web và link đã được cập nhật tự động.';
        } else {
            $_SESSION['error_message'] = 'Có lỗi xảy ra khi cập nhật danh mục.';
        }

        header('Location: /admin/viewCategory');
        exit;
    }

    // Xóa danh mục
    public function deletecategory()
    {
        $categoryId = $_POST['id'] ?? null;
        
        if (!$categoryId) {
            $_SESSION['error_message'] = 'ID danh mục không hợp lệ.';
            header('Location: /admin/viewCategory');
            exit;
        }

        // Lấy thông tin danh mục trước khi xóa để biết slug
        $category = $this->categoryModel->getCategoryById($categoryId);
        
        // Xóa danh mục khỏi database
        $deleted = $this->categoryModel->deleteCategory($categoryId);
        
        if ($deleted && $category) {
            // Tự động xóa khỏi navbar và routes
            $this->removeCategoryFromSystem($category);
            $_SESSION['success_message'] = 'Danh mục đã được xóa thành công! Trang web và link cũng đã bị xóa.';
        } else {
            $_SESSION['error_message'] = 'Có lỗi xảy ra khi xóa danh mục.';
        }

        header('Location: /admin/viewCategory');
        exit;
    }

    // Cập nhật hàng loạt danh mục
    public function bulkUpdateCategories()
    {
        $categories = $_POST['categories'] ?? [];
        
        foreach ($categories as $categoryId => $data) {
            $this->categoryModel->updateCategory($categoryId, $data);
        }

        $_SESSION['success_message'] = 'Các danh mục đã được cập nhật thành công!';
        header('Location: /admin/viewCategory');
        exit;
    }

    // Phương thức tự động xóa danh mục khỏi hệ thống
    private function removeCategoryFromSystem($category)
    {
        if (!$category || !isset($category['slug'])) {
            return false;
        }

        $slug = $category['slug'];
        $categoryType = $category['category_type'] ?? 'noithat';

        // Tạo log để ghi nhận việc xóa
        $logMessage = "Đã xóa danh mục: {$category['category_name']} (Slug: {$slug}, Loại: {$categoryType})";
        error_log($logMessage);

        // Thông báo cho admin biết URL nào đã bị xóa
        $url = $categoryType === 'ximang' ? "/xmgg/{$slug}" : "/hangtrangtri/{$slug}";
        $_SESSION['info_message'] = "URL {$url} đã bị xóa khỏi hệ thống.";

        return true;
    }

    // TỰ ĐỘNG TẠO SLUG TỪ TÊN DANH MỤC
    private function createSlugFromName($name)
    {
        // Chuyển về chữ thường
        $slug = strtolower($name);
        
        // Thay thế các ký tự đặc biệt
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        
        // Thay thế khoảng trắng bằng dấu gạch ngang
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        
        // Loại bỏ dấu gạch ngang ở đầu và cuối
        $slug = trim($slug, '-');
        
        // Nếu slug rỗng, tạo slug mặc định
        if (empty($slug)) {
            $slug = 'category-' . time();
        }
        
        // Kiểm tra slug đã tồn tại chưa và tạo slug duy nhất
        $originalSlug = $slug;
        $counter = 1;
        while ($this->categoryModel->slugExists($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
}