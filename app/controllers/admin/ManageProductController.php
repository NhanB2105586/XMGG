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
        // Lấy danh sách danh mục
        $categories = $this->categoryModel->getAllCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $data['in_stock'] = isset($data['in_stock']) ? true : false;

            // Tạo sản phẩm
            $this->productModel->createProduct($data);
            $productId = $this->productModel->getPDO()->lastInsertId();

            // Xử lý upload hình ảnh
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['name'] as $index => $name) {
                    if ($_FILES['images']['error'][$index] === UPLOAD_ERR_OK) {
                        // Lưu hình ảnh vào thư mục
                        $imagePath = 'C:/Users/Phu Qui/OneDrive/CNWeb/project/public/images/upload/' . basename($name);
                        move_uploaded_file($_FILES['images']['tmp_name'][$index], $imagePath);

                        // Chỉ lưu tên tệp vào cơ sở dữ liệu
                        $this->productImageModel->addImage(['product_id' => $productId, 'image_url' => basename($name)]);
                    }
                }
            }


            header('Location: /admin/viewProducts');
            exit;
        }

        // Gọi view cho form tạo sản phẩm
        $this->sendPage('admin/addProduct', ['categories' => $categories]);
    }

    public function edit($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ.';
            header('Location: /admin/viewProducts');
            exit;
        }

        // Lấy danh mục và sản phẩm từ database
        $categories = $this->categoryModel->getAllCategories();
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            $_SESSION['error_message'] = 'Không tìm thấy sản phẩm.';
            header('Location: /admin/viewProducts');
            exit;
        }

        // Lấy hình ảnh của sản phẩm
        $product['images'] = $this->productImageModel->getImagesByProductId($id);

        // Kiểm tra khi form được gửi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Lọc dữ liệu form
            $data = $this->filterData(['product_id', 'category_id', 'product_name', 'old_price', 'price', 'description', 'in_stock'], $_POST);

            // Validate dữ liệu form trước khi cập nhật
            if ($this->validateProductData($data)) {
                // Cập nhật sản phẩm
                $this->productModel->updateProduct($id, $data);
                if (!empty($_FILES['images']['name'][0])) {
                    foreach ($_FILES['images']['name'] as $index => $name) {
                        if ($_FILES['images']['error'][$index] === UPLOAD_ERR_OK) {
                            // Lưu hình ảnh vào thư mục
                            $imagePath = 'C:/Users/Phu Qui/OneDrive/CNWeb/project/public/images/upload/' . basename($name);
                            move_uploaded_file($_FILES['images']['tmp_name'][$index], $imagePath);

                            // Chỉ lưu tên tệp vào cơ sở dữ liệu
                            $this->productImageModel->addImage([
                                'product_id' => $id,
                                'image_url' => basename($imagePath) // Chỉ lưu tên tệp
                            ]);
                        }
                    }
                }
            
                // Xử lý xóa hình ảnh nếu có
                if (isset($_POST['delete_images'])) {
                    foreach ($_POST['delete_images'] as $image_id) {
                        $this->deleteProductImage($image_id, $id);  // Xóa từng ảnh
                    }
                }

                $_SESSION['success_message'] = 'Sản phẩm đã được cập nhật thành công.';
                header('Location: /admin/viewProducts');
                exit;
            } else {
                $_SESSION['error_messages'] = ['Dữ liệu sản phẩm không hợp lệ.'];
            }
        }

        // Gửi dữ liệu đến view
        $this->sendPage('admin/editProduct', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    private function getUploadErrorMessage($errorCode)
    {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return 'Tệp vượt quá kích thước tối đa cho phép trong php.ini.';
            case UPLOAD_ERR_FORM_SIZE:
                return 'Tệp vượt quá kích thước tối đa cho phép trong form HTML.';
            case UPLOAD_ERR_PARTIAL:
                return 'Tệp chỉ tải lên một phần.';
            case UPLOAD_ERR_NO_FILE:
                return 'Không có tệp nào được tải lên.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Thiếu thư mục tạm thời.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Không thể ghi tệp vào đĩa.';
            case UPLOAD_ERR_EXTENSION:
                return 'Tệp bị dừng lại do một phần mở rộng PHP.';
            default:
                return 'Có lỗi khi tải lên tệp.';
        }
    }

    private function deleteProductImage($image_id, $product_id)
    {
        // Lấy thông tin hình ảnh từ cơ sở dữ liệu bằng image_id
        $image = $this->productImageModel->getImageById($image_id);

        if ($image) {
            // Xóa tệp hình ảnh khỏi thư mục
            $image_path = __DIR__ . "/../../public/images/upload/" . $image['image_url'];

            if (file_exists($image_path)) {
                // Thực hiện xóa ảnh trong thư mục
                if (unlink($image_path)) {
                    echo "Ảnh đã được xóa thành công"; // Debug thông báo xóa
                } else {
                    echo "Lỗi khi xóa ảnh"; // Debug lỗi khi xóa
                }
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
        if ($this->productModel->deleteProduct($id)) {
            $_SESSION['success_message'] = 'Sản phẩm đã được xóa thành công.';
        } else {
            $_SESSION['error_messages'] = ['Có lỗi xảy ra khi xóa sản phẩm.'];
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
            $errors[] = 'Vui lòng chọn tình trạng sản phẩm.';
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