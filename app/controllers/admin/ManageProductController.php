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
        $products = $this->productModel->getProductSearch($limit, $offset, $searchTerm);
        $totalProducts = $this->productModel->getTotalProductSearch($searchTerm);
        $totalPages = ceil($totalProducts / $limit); // Tính tổng số trang

        // Lấy hình ảnh cho từng sản phẩm (chỉ lấy ảnh đầu tiên)
        foreach ($products as &$product) {
            $images = $this->productImageModel->getImagesByProductId($product['product_id']);
            $product['images'] = $images;
            // Lấy ảnh đầu tiên làm ảnh chính
            $product['main_image'] = !empty($images) ? $images[0]['image_url'] : 'default.jpg';
        }

        // Lấy danh sách categories để hiển thị trong dropdown filter
        $categories = $this->categoryModel->getAllCategories();

        // Gửi dữ liệu đến view
        $this->sendPage('admin/viewProduct', [
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalProducts' => $totalProducts,
            'searchTerm' => $searchTerm,
            'categories' => $categories,
        ]);
    }



    public function edit($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ.';
            header('Location: /admin/viewProduct');
            exit;
        }

        $categories = $this->categoryModel->getAllCategories();
        $product = $this->productModel->getProductCategoryById($id);
        if (!$product) {
            $_SESSION['error_message'] = 'Không tìm thấy sản phẩm.';
            header('Location: /admin/viewProduct');
            exit;
        }

        $product['images'] = $this->productImageModel->getImagesByProductId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->filterData(['product_id', 'category_id', 'product_name', 'old_price', 'price', 'description', 'in_stock'], $_POST);

            if ($this->validateProductData($data)) {
                $this->productModel->updateProduct($id, $data);

                // Xử lý upload ảnh mới - Sửa lỗi duplicate
                if (!empty($_FILES['images']['name'][0])) {
                    $uploadDir = __DIR__ . '/../../../public/images/imageupload/';
                    
                    // Tạo thư mục nếu chưa tồn tại
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    
                    // Debug: Kiểm tra thư mục upload
                    if (!is_writable($uploadDir)) {
                        $_SESSION['error_messages'] = ['Thư mục upload không có quyền ghi: ' . $uploadDir];
                        $this->sendPage('admin/editProduct', ['product' => $product, 'categories' => $categories, 'productImageModel' => $this->productImageModel]);
                        return;
                    }
                    
                    // Đếm số ảnh đã upload thành công để tránh duplicate
                    $uploadedCount = 0;
                    
                    foreach ($_FILES['images']['name'] as $index => $name) {
                        // Chỉ xử lý nếu thực sự có file được chọn và là file upload từ máy
                        if (!empty($name) && $_FILES['images']['error'][$index] === UPLOAD_ERR_OK) {
                            // Kiểm tra loại file
                            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                            $fileType = $_FILES['images']['type'][$index];
                            
                            if (!in_array($fileType, $allowedTypes)) {
                                continue; // Bỏ qua file không hợp lệ
                            }
                            
                            // Kiểm tra kích thước file (tối đa 10MB)
                            $maxSize = 10 * 1024 * 1024;
                            if ($_FILES['images']['size'][$index] > $maxSize) {
                                continue; // Bỏ qua file quá lớn
                            }
                            
                            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                            $base = pathinfo($name, PATHINFO_FILENAME);
                            // Loại bỏ ký tự đặc biệt và dấu cách
                            $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
                            $uniqueName = $base . '_' . uniqid() . '.' . $ext;
                            $imagePath = $uploadDir . $uniqueName;
                            
                            // Kiểm tra xem file có phải là file upload thực sự không
                            if (is_uploaded_file($_FILES['images']['tmp_name'][$index])) {
                                if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $imagePath)) {
                                    // Kiểm tra file đã được tạo thành công
                                    if (file_exists($imagePath)) {
                                        // Kiểm tra xem ảnh này đã tồn tại chưa để tránh duplicate
                                        $existingImage = $this->productImageModel->getImageByUrl($uniqueName);
                                        if (!$existingImage) {
                                            $this->productImageModel->addImage([
                                                'product_id' => $id,
                                                'image_url' => $uniqueName
                                            ]);
                                            $uploadedCount++;
                                        }
                                    } else {
                                        $_SESSION['error_messages'] = ['Không thể tạo file: ' . $imagePath];
                                    }
                                } else {
                                    $_SESSION['error_messages'] = ['Không thể upload file: ' . $name];
                                }
                            }
                        }
                    }
                    
                    // Thông báo số ảnh đã upload thành công
                    if ($uploadedCount > 0) {
                        $_SESSION['success_message'] = "Đã upload thành công {$uploadedCount} ảnh mới.";
                    }
                }

                // Nếu sản phẩm không có ảnh nào (cả cũ lẫn mới), thêm ảnh mặc định
                $currentImages = $this->productImageModel->getImagesByProductId($id);
                if (empty($currentImages)) {
                    $this->productImageModel->addImage(['product_id' => $id, 'image_url' => 'default.jpg']);
                }

                // Xử lý xóa hình ảnh trước (trước khi sắp xếp lại)
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

                // Xử lý chọn ảnh chính sau (sau khi xóa)
                if (isset($_POST['main_image']) && !empty($_POST['main_image'])) {
                    $mainImageId = (int)$_POST['main_image'];
                    $this->productImageModel->setMainImage($id, $mainImageId);
                    // Lưu thông tin ảnh chính vào session để hiển thị đúng trong view
                    $_SESSION['selected_main_image_url'] = $this->productImageModel->getImageById($mainImageId)['image_url'];
                }

                // Đảm bảo sản phẩm luôn có ảnh chính
                $this->productImageModel->ensureMainImage($id);

                $_SESSION['success_message'] = 'Sản phẩm đã được cập nhật thành công.';
                header('Location: /admin/editProduct/' . $id);
                exit;
            } else {
                $_SESSION['error_messages'] = ['Dữ liệu sản phẩm không hợp lệ.'];
            }
        }

        $this->sendPage('admin/editProduct', [
            'product' => $product,
            'categories' => $categories,
            'old' => $_POST ?? []
        ]);
    }

    private function deleteProductImage($image_id, $product_id)
    {
        // Lấy thông tin hình ảnh từ cơ sở dữ liệu bằng image_id
        $image = $this->productImageModel->getImageById($image_id);

        if ($image) {
            // Xóa tệp hình ảnh khỏi thư mục
             $image_path = __DIR__ . '/../../../public/images/imageupload/' . $image['image_url'];
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
            header('Location: /admin/viewProduct');
            exit;
        }
        if ($this->productModel->existsInTable('order_details','product_id',$id)) {
                // Lưu thông báo lỗi
                $_SESSION['error_message'] = 'Không thể xóa sản phẩm này vì còn đơn hàng liên quan.';
            } else {
                $this->productModel->deleteProduct($id);
                $_SESSION['success_message'] = 'Sản phẩm đã được xóa thành công!';
            }
        header('Location: /admin/viewProduct');
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

    // Method để hiển thị trang quản lý sản phẩm
    public function viewProducts()
    {
        $limit = 10;
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $products = $this->productModel->getProductSearch($limit, $offset, $searchTerm, $categoryId);
        $totalProducts = $this->productModel->getTotalProductSearch($searchTerm, $categoryId);
        $totalPages = ceil($totalProducts / $limit);

        // Lấy hình ảnh cho từng sản phẩm (chỉ lấy ảnh đầu tiên)
        foreach ($products as &$product) {
            $images = $this->productImageModel->getImagesByProductId($product['product_id']);
            $product['images'] = $images;
            // Lấy ảnh đầu tiên làm ảnh chính
            $product['main_image'] = !empty($images) ? $images[0]['image_url'] : 'default.jpg';
        }

        // Lấy danh sách categories để hiển thị trong dropdown filter
        $categories = $this->categoryModel->getAllCategories();

        $this->sendPage('admin/viewProduct', [
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalProducts' => $totalProducts,
            'searchTerm' => $searchTerm,
            'categoryId' => $categoryId,
            'categories' => $categories,
        ]);
    }

    // Method để hiển thị trang thêm sản phẩm
    public function showAddProduct()
    {
        $categories = $this->categoryModel->getAllCategories();
        $this->sendPage('admin/addProduct', ['categories' => $categories]);
    }

    // Method để xử lý thêm sản phẩm
    public function addProduct()
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
                $uploadDir = __DIR__ . '/../../../public/images/imageupload/';
                
                // Tạo thư mục nếu chưa tồn tại
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                // Debug: Kiểm tra thư mục upload
                if (!is_writable($uploadDir)) {
                    $_SESSION['error_messages'] = ['Thư mục upload không có quyền ghi: ' . $uploadDir];
                    $this->sendPage('admin/addProduct', ['categories' => $categories, 'old' => $data]);
                    return;
                }
                
                // Đếm số ảnh đã upload thành công để tránh duplicate
                $uploadedCount = 0;
                
                foreach ($_FILES['images']['name'] as $index => $name) {
                    // Chỉ xử lý nếu thực sự có file được chọn và là file upload từ máy
                    if (!empty($name) && $_FILES['images']['error'][$index] === UPLOAD_ERR_OK) {
                        // Kiểm tra loại file
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                        $fileType = $_FILES['images']['type'][$index];
                        
                        if (!in_array($fileType, $allowedTypes)) {
                            continue; // Bỏ qua file không hợp lệ
                        }
                        
                        // Kiểm tra kích thước file (tối đa 10MB)
                        $maxSize = 10 * 1024 * 1024;
                        if ($_FILES['images']['size'][$index] > $maxSize) {
                            continue; // Bỏ qua file quá lớn
                        }
                        
                        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                        $base = pathinfo($name, PATHINFO_FILENAME);
                        // Loại bỏ ký tự đặc biệt và dấu cách
                        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
                        $uniqueName = $base . '_' . uniqid() . '.' . $ext;
                        $imagePath = $uploadDir . $uniqueName;
                        
                        // Kiểm tra xem file có phải là file upload thực sự không
                        if (is_uploaded_file($_FILES['images']['tmp_name'][$index])) {
                            if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $imagePath)) {
                                // Kiểm tra file đã được tạo thành công
                                if (file_exists($imagePath)) {
                                    // Kiểm tra xem ảnh này đã tồn tại chưa để tránh duplicate
                                    $existingImage = $this->productImageModel->getImageByUrl($uniqueName);
                                    if (!$existingImage) {
                                        $this->productImageModel->addImage([
                                            'product_id' => $productId,
                                            'image_url' => $uniqueName
                                        ]);
                                        $uploadedCount++;
                                        $hasImage = true;
                                    }
                                } else {
                                    $_SESSION['error_messages'] = ['Không thể tạo file: ' . $imagePath];
                                }
                            } else {
                                $_SESSION['error_messages'] = ['Không thể upload file: ' . $name];
                            }
                        }
                    }
                }
                
                // Thông báo số ảnh đã upload thành công
                if ($uploadedCount > 0) {
                    $_SESSION['success_message'] = "Đã upload thành công {$uploadedCount} ảnh mới.";
                }
            }

            // Nếu không có ảnh nào được upload, thêm ảnh mặc định
            if (!$hasImage) {
                $this->productImageModel->addImage(['product_id' => $productId, 'image_url' => 'default.jpg']);
            }

            $_SESSION['success_message'] = 'Sản phẩm đã được thêm thành công.';
            header('Location: /admin/viewProduct');
            exit;
        }

        $this->sendPage('admin/addProduct', ['categories' => $categories]);
    }

    // Method để hiển thị trang chỉnh sửa sản phẩm
    public function showEditProduct($productId)
    {
        $product = $this->productModel->getProductById($productId);
        $categories = $this->categoryModel->getAllCategories();

        if (!$product) {
            $_SESSION['error_message'] = 'Sản phẩm không tồn tại.';
            header('Location: /admin/viewProduct');
            exit;
        }

        // Load hình ảnh của sản phẩm
        $product['images'] = $this->productImageModel->getImagesByProductId($productId);

        $this->sendPage('admin/editProduct', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    // Method để cập nhật sản phẩm
public function updateProduct($productId)
{
    $product = $this->productModel->getProductById($productId);
    $categories = $this->categoryModel->getAllCategories();

    if (!$product) {
        $_SESSION['error_message'] = 'Sản phẩm không tồn tại.';
        header('Location: /admin/viewProduct');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        $data['product_id'] = $productId;

        if ($this->validateProductData($data)) {
            // Cập nhật thông tin sản phẩm
            $this->productModel->updateProduct($productId, $data);

            $uploadDir = __DIR__ . '/../../../public/images/imageupload/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            if (!is_writable($uploadDir)) {
                $_SESSION['error_messages'][] = 'Thư mục upload không có quyền ghi: ' . $uploadDir;
                $this->sendPage('admin/editProduct', [
                    'product' => $product,
                    'categories' => $categories,
                ]);
                return;
            }

            // Lấy danh sách ảnh hiện tại
            $currentImages = $this->productImageModel->getImagesByProductId($productId);

            /** ===============             * Xử lý xóa ảnh được tick
             * ====================== */
            if (!empty($_POST['delete_images'])) {
                foreach ($_POST['delete_images'] as $image_id) {
                    $image = $this->productImageModel->getImageById($image_id);
                    if ($image) {
                        // Chỉ xóa file thật nếu không phải default.jpg
                        if ($image['image_url'] !== 'default.jpg') {
                            $filePath = $uploadDir . $image['image_url'];
                            if (file_exists($filePath)) unlink($filePath);
                        }
                        // Xóa bản ghi trong DB
                        $this->productImageModel->deleteImage($image_id);
                    }
                }
                $currentImages = $this->productImageModel->getImagesByProductId($productId);
            }

            /** ===============             * Xử lý upload ảnh mới
             * ====================== */
            if (!empty($_FILES['images']['name'][0])) {
                // Xóa default.jpg khỏi DB nếu đang dùng
                foreach ($currentImages as $img) {
                    if ($img['image_url'] === 'default.jpg') {
                        $this->productImageModel->deleteImage($img['image_id']);
                    }
                }

                foreach ($_FILES['images']['name'] as $index => $name) {
                    if (!empty($name) && $_FILES['images']['error'][$index] === UPLOAD_ERR_OK) {
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                        $fileType = $_FILES['images']['type'][$index];
                        if (!in_array($fileType, $allowedTypes)) continue;

                        $maxSize = 10 * 1024 * 1024;
                        if ($_FILES['images']['size'][$index] > $maxSize) continue;

                        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($name, PATHINFO_FILENAME));
                        $filename = $base . '_' . time() . '_' . uniqid() . '.' . $ext;

                        if (is_uploaded_file($_FILES['images']['tmp_name'][$index])) {
                            if (move_uploaded_file($_FILES['images']['tmp_name'][$index], $uploadDir . $filename)) {
                                $this->productImageModel->addImage([
                                    'product_id' => $productId,
                                    'image_url'  => $filename
                                ]);
                            }
                        }
                    }
                }
            }

            /** ===============             * Nếu không còn ảnh nào → thêm default.jpg
             * ====================== */
            $currentImages = $this->productImageModel->getImagesByProductId($productId);
            if (empty($currentImages)) {
                $this->productImageModel->addImage([
                    'product_id' => $productId,
                    'image_url'  => 'default.jpg'
                ]);
            }

            $_SESSION['success_message'] = 'Sản phẩm đã được cập nhật thành công.';
            header('Location: /admin/viewProduct');
            exit;
        }
    }

    $this->sendPage('admin/editProduct', [
        'product' => $product,
        'categories' => $categories,
    ]);
}




    // Method để xóa sản phẩm
    public function deleteProduct($productId)
    {
        if (!is_numeric($productId) || $productId <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ.';
            header('Location: /admin/viewProduct');
            exit;
        }

        if ($this->productModel->existsInTable('order_details', 'product_id', $productId)) {
            $_SESSION['error_message'] = 'Không thể xóa sản phẩm này vì còn đơn hàng liên quan.';
        } else {
            $this->productModel->deleteProduct($productId);
            $_SESSION['success_message'] = 'Sản phẩm đã được xóa thành công!';
        }

        header('Location: /admin/viewProduct');
        exit;
    }

    // Method để xóa nhiều sản phẩm cùng lúc
    public function deleteMultipleProducts()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['error_message'] = 'Phương thức không hợp lệ.';
            header('Location: /admin/viewProduct');
            exit;
        }

        $ids = $_POST['ids'] ?? null;
        
        if (!$ids) {
            $_SESSION['error_message'] = 'Không có sản phẩm nào được chọn.';
            header('Location: /admin/viewProduct');
            exit;
        }

        // Decode JSON array
        $productIds = json_decode($ids, true);
        
        if (!is_array($productIds) || empty($productIds)) {
            $_SESSION['error_message'] = 'Dữ liệu sản phẩm không hợp lệ.';
            header('Location: /admin/viewProduct');
            exit;
        }

        $successCount = 0;
        $errorCount = 0;
        $errorMessages = [];

        foreach ($productIds as $productId) {
            if (!is_numeric($productId) || $productId <= 0) {
                $errorCount++;
                $errorMessages[] = "ID sản phẩm $productId không hợp lệ.";
                continue;
            }

            // Kiểm tra xem sản phẩm có trong đơn hàng không
            if ($this->productModel->existsInTable('order_details', 'product_id', $productId)) {
                $errorCount++;
                $errorMessages[] = "Không thể xóa sản phẩm ID $productId vì còn đơn hàng liên quan.";
                continue;
            }

            // Xóa sản phẩm
            if ($this->productModel->deleteProduct($productId)) {
                $successCount++;
            } else {
                $errorCount++;
                $errorMessages[] = "Lỗi khi xóa sản phẩm ID $productId.";
            }
        }

        // Tạo thông báo kết quả
        if ($successCount > 0) {
            $_SESSION['success_message'] = "Đã xóa thành công $successCount sản phẩm.";
        }
        
        if ($errorCount > 0) {
            $_SESSION['error_message'] = "Có $errorCount sản phẩm không thể xóa: " . implode(' ', $errorMessages);
        }

        header('Location: /admin/viewProduct');
        exit;
    }

    // Method để lấy thông tin số lượng sản phẩm
    public function getProductStock($productId)
    {
        $product = $this->productModel->getProductById($productId);
        
        if ($product) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'in_stock' => $product['in_stock']
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại'
            ]);
        }
    }

    // Method để cập nhật số lượng sản phẩm khi mua
    public function updateProductStock()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if ($productId && is_numeric($quantity)) {
                $product = $this->productModel->getProductById($productId);
                
                if ($product && $product['in_stock'] >= $quantity) {
                    $newStock = $product['in_stock'] - $quantity;
                    $this->productModel->updateStock($productId, $newStock);
                    
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'message' => 'Cập nhật số lượng thành công',
                        'new_stock' => $newStock
                    ]);
                    return;
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => 'Không thể cập nhật số lượng'
        ]);
    }
}
