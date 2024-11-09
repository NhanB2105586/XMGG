<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Category;

class ManageCategoryController extends Controller
{
    protected $categoryModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new Category($pdo);
        parent::__construct();
    }

    // Hiển thị danh sách danh mục
    public function index()
    {
        $limit = 10; // Số lượng danh mục hiển thị trên mỗi trang
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại từ query string
        $offset = ($page - 1) * $limit; // Tính toán offset

        // Lấy danh sách danh mục và tổng số danh mục
        $categories = $this->categoryModel->getCategoriesSearch($limit, $offset, $searchTerm);
        $totalCategories = $this->categoryModel->getTotalCategoriesSearch($searchTerm);
        $totalPages = ceil($totalCategories / $limit); // Tính tổng số trang

        // Gửi dữ liệu đến view
        $this->sendPage('admin/viewCategory', [
            'categories' => $categories,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm,
        ]);
    }

    // Hiển thị trang thêm danh mục
    public function create()
    {
        $this->sendPage('admin/addCategory', []);
    }

    // Xử lý thêm danh mục
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->filterData(['category_name'], $_POST);

            // Kiểm tra tính hợp lệ của dữ liệu
            if (empty($data['category_name'])) {
                $errors['category_name'] = 'Tên danh mục không được để trống.';
                $this->sendPage('admin/addCategory', ['errors' => $errors]);
                return;
            }

            // Kiểm tra xem danh mục đã tồn tại trong cơ sở dữ liệu chưa
            if ($this->categoryModel->categoryExists($data['category_name'])) {
                $errors['category_name'] = 'Tên danh mục đã tồn tại. Vui lòng chọn tên khác.';
                $this->sendPage('admin/addCategory', ['errors' => $errors]);
                return;
            }

            // Thực hiện tạo danh mục
            if ($this->categoryModel->createCategory($data)) {
                header('Location: /admin/viewCategory');
                $_SESSION['success_message'] = 'Danh mục đã được thêm thành công!';
                exit;
            } else {
                $errors['database'] = 'Có lỗi xảy ra khi thêm danh mục.';
                $this->sendPage('admin/addCategory', ['errors' => $errors]);
            }
        } else {
            header('Location: /admin/viewCategory');
            exit;
        }
    }

    // Hiển thị trang sửa danh mục

    public function edit($id)
    {
        // Lấy thông tin danh mục dựa trên ID
        $category = $this->categoryModel->getByID('categories', 'category_id', $id);
        if (!$category) {
            $this->sendNotFound();
            return;
        }

        $message = '';
        $errors = []; // Biến để chứa thông báo

        // Kiểm tra xem có yêu cầu POST không
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lọc dữ liệu từ form
            $data = $this->filterData(['category_name'], $_POST);

            // Kiểm tra tính hợp lệ của dữ liệu
            if (empty($data['category_name'])) {
                $errors[] = 'Tên danh mục không được để trống.'; // Thông báo lỗi
            }
            
            
                // Kiểm tra xem danh mục đã tồn tại trong cơ sở dữ liệu chưa
                if ($this->categoryModel->categoryExists($data['category_name'])) {
                    $errors['category_name'] = 'Tên danh mục đã tồn tại. Vui lòng chọn tên khác.';
                $this->sendPage('admin/editCategory', [
                    'category' => $category, 
                    'errors' => $errors,
                ]);
                    return;
                } else {
                // Cập nhật thông tin danh mục
                if ($this->categoryModel->updateCategory($id, $data)) {
                    $_SESSION['success_message'] = 'Danh mục đã được cập nhật thành công!';
                    header('Location: /admin/viewCategory');
                    exit;
                } else {
                    $errors[] = 'Có lỗi xảy ra khi cập nhật danh mục.'; // Thông báo lỗi
                }
            }
        }

        // Gửi dữ liệu đến view
        $this->sendPage('admin/editCategory', [
            'category' => $category,
            'message' => $message,
            'errors' => $errors,
        ]);
    }


    // Xóa danh mục
    public function deletecategory()
    {
        // Kiểm tra xem có ID được gửi không
        if (isset($_POST['id'])) {
            $categoryId = $_POST['id'];
            if ($this->categoryModel->existsInTable('products','category_id',$categoryId)) {
                // Lưu thông báo lỗi
                $_SESSION['error_message'] = 'Không thể xóa danh mục này vì còn sản phẩm liên quan.';
            } else {
                $this->categoryModel->deleteCategory($categoryId);
                $_SESSION['success_message'] = 'Danh mục đã được xóa thành công!';
            }

            // Chuyển hướng về danh sách khách hàng
            header('Location: /admin/viewCategory');
            exit;
        }
    }
}