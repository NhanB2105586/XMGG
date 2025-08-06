<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;

class ManageProductController extends Controller
{
    protected Product $productModel;
    protected ProductImage $productImageModel;
    protected Category $categoryModel;

    public function __construct($pdo)
    {
        parent::__construct(); // Gọi hàm khởi tạo của class cha
        $this->productModel = new Product($pdo);
        $this->productImageModel = new ProductImage($pdo);
        $this->categoryModel = new Category($pdo);
    }

    public function index()
    {
        $limit = 10; // Số lượng khách hàng hiển thị trên mỗi trang
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại từ query string
        $offset = ($page - 1) * $limit; // Tính toán offset

        // Lấy danh sách sản phẩm và tổng số sản phẩm
        $products = $this->productModel->getproductSearch($limit, $offset, $searchTerm);
        $totalProducts = $this->productModel->getTotalproductSearch($searchTerm);
        $totalPages = ceil($totalProducts / $limit); // Tính tổng số trang

        // Lấy hình ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['images'] = $this->productImageModel->getImagesByProductId($product['product_id']);
        }

        // Gửi dữ liệu đến view
        $this->sendPage('admin/viewProduct', [
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm,
        ]);
    }

    public function create()
    {
        $categories = $this->categoryModel->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            if (empty($data['category_id'])) {
                $_SESSION['error_messages'] = ['Vui lòng chọn danh mục sản phẩm.'];
                $this->sendPage('admin/addProduct', ['categories' => $categories, 'old' => $data]);
                return;
            }

            $this->productModel->createProduct($data);
            $productId = $this->productModel->getPDO()->lastInsertId();

            $hasImage = false;
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['name'] as $index => $name) {
                    if (!empty($name) && $_FILES['images']['error'][$index] === UPLOAD_ERR_OK) {
                        $ext = pathinfo($name, PATHINFO_EXTENSION);
                        $base = pathinfo($name, PATHINFO_FILENAME);
                        $uniqueName = $base . '_' . uniqid() . '.' . $ext;
                        $imagePath = dirname(__DIR__, 2) . '/public/images/upload/' . $uniqueName;
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $imagePath)) {
                            $this->productImageModel->addImage(['product_id' => $productId, 'image_url' => $uniqueName]);
                            $hasImage = true;
                        }
                    }
                }
            }
            // Nếu không upload ảnh nào, thêm ảnh mặc định
            if (!$hasImage) {
                $this->productImageModel->addImage(['product_id' => $productId, 'image_url' => 'default.jpg']);
            }

            header('Location: /admin/viewProducts');
            exit;
        }

        $this->sendPage('admin/addProduct', ['categories' => $categories]);
    }

    public function edit($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ.';
            header('Location: /admin/viewProducts');
            exit;
        }

        $categories = $this->categoryModel->getAllCategories();
        $product = $this->productModel->getProductCategoryById($id);
        if (!$product) {
            $_SESSION['error_message'] = 'Không tìm thấy sản phẩm.';
            header('Location: /admin/viewProducts');
            exit;
        }

        $product['images'] = $this->productImageModel->getImagesByProductId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->filterData(['product_id', 'category_id', 'product_name', 'old_price', 'price', 'description', 'in_stock'], $_POST);

            if ($this->validateProductData($data)) {
                $this->productModel->updateProduct($id, $data);

                // Xử lý upload ảnh mới
                if (!empty($_FILES['images']['name'][0])) {
                    foreach ($_FILES['images']['name'] as $index => $name) {
                        // Chỉ xử lý nếu thực sự có file được chọn và là file upload từ máy
                        if (!empty($name) && $_FILES['images']['error'][$index] === UPLOAD_ERR_OK) {
                            $ext = pathinfo($name, PATHINFO_EXTENSION);
                            $base = pathinfo($name, PATHINFO_FILENAME);
                            // Loại bỏ mọi đường dẫn thư mục (chỉ lấy tên file)
                            $base = basename($base);
                            $uniqueName = $base . '_' . uniqid() . '.' . $ext;
                            $uploadDir = dirname(__DIR__, 2) . '/public/images/upload/';
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0777, true);
                            }
                            $imagePath = $uploadDir . $uniqueName;
                            // Chỉ move_uploaded_file nếu là file upload thực sự (không phải đường dẫn cũ)
                            if (is_uploaded_file($_FILES['images']['tmp_name'][$index])) {
                                if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $imagePath)) {
                                    $this->productImageModel->addImage([
                                        'product_id' => $id,
                                        'image_url' => $uniqueName
                                    ]);
                                }
                            }
                        }
                    }
                }

                // Nếu sản phẩm không có ảnh nào (cả cũ lẫn mới), thêm ảnh mặc định
                $currentImages = $this->productImageModel->getImagesByProductId($id);
                if (empty($currentImages)) {
                    $this->productImageModel->addImage(['product_id' => $id, 'image_url' => 'default.jpg']);
                }

                // Xử lý xóa hình ảnh nếu có
                if (isset($_POST['delete_images'])) {
                    foreach ($_POST['delete_images'] as $image_id) {
                        $this->deleteProductImage($image_id, $id);
                    }
                    // Nếu sau khi xóa không còn ảnh nào, thêm ảnh mặc định
                    $currentImages = $this->productImageModel->getImagesByProductId($id);
                    if (empty($currentImages)) {
                        $this->productImageModel->addImage(['product_id' => $id, 'image_url' => 'default.jpg']);
                    }
                }

                $_SESSION['success_message'] = 'Sản phẩm đã được cập nhật thành công.';
                header('Location: /admin/editProducts?id=' . $id);
                exit;
            } else {
                $_SESSION['error_messages'] = ['Dữ liệu sản phẩm không hợp lệ.'];
            }
        }

        $this->sendPage('admin/editProduct', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    private function deleteProductImage($image_id, $product_id)
    {
        // Lấy thông tin hình ảnh từ cơ sở dữ liệu bằng image_id
        $image = $this->productImageModel->getImageById($image_id);

        if ($image) {
            // Xóa tệp hình ảnh khỏi thư mục
            $image_path = dirname(__DIR__, 2) . "/public/images/upload/" . $image['image_url'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            // Xóa ảnh khỏi cơ sở dữ liệu
            $this->productImageModel->deleteImage($image_id);
        }
    }



    public function delete($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ roi.';
            header('Location: /admin/viewProducts');
            exit;
        }
        if ($this->productModel->existsInTable('order_details','product_id',$id)) {
                // Lưu thông báo lỗi
                $_SESSION['error_message'] = 'Không thể xóa khách hàng này vì còn đơn hàng liên quan.';
            } else {
                $this->productModel->deleteProduct($id);
                $_SESSION['success_message'] = 'Khách hàng đã được xóa thành công!';
            }
        header('Location: /admin/viewProducts');
        exit;
    }

    public function validateProductData($data)
    {
        $errors = [];

        // Kiểm tra tên sản phẩm (không được rỗng)
        if (empty($data['product_name'])) {
            $errors[] = 'Tên sản phẩm không được để trống.';
        }

        // Kiểm tra giá cũ (phải là một số và lớn hơn 0)
        if (empty($data['old_price']) || !is_numeric($data['old_price']) || $data['old_price'] <= 0) {
            $errors[] = 'Giá cũ không hợp lệ.';
        }

        // Kiểm tra giá mới (phải là một số và lớn hơn 0)
        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
            $errors[] = 'Giá mới không hợp lệ.';
        }

        // Kiểm tra mô tả sản phẩm (không được rỗng)
        if (empty($data['description'])) {
            $errors[] = 'Mô tả sản phẩm không được để trống.';
        }

        // Kiểm tra danh mục sản phẩm (phải chọn danh mục)
        if (empty($data['category_id']) || !is_numeric($data['category_id'])) {
            $errors[] = 'Danh mục sản phẩm không hợp lệ.';
        }

        // Kiểm tra tình trạng sản phẩm (Còn hàng hay hết hàng)
        if (!isset($data['in_stock'])) {
            $errors[] = 'Vui lòng điền số lượng sản phẩm.';
        }

        // Nếu có lỗi, lưu thông báo lỗi vào session và trả về false
        if (!empty($errors)) {
            $_SESSION['error_messages'] = $errors;
            return false;
        }

        // Nếu không có lỗi, trả về true
        return true;
    }
}