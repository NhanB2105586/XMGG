<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use PDO;

class ProductController extends Controller
{
    public function showProductsByCategory($categoryId)
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);

        // Lấy tất cả sản phẩm thuộc category_id
        $products = $productModel->getProductsByCategory($categoryId);

        // Kiểm tra xem có sản phẩm nào không
        if (empty($products)) {
            // Nếu không có sản phẩm, vẫn hiển thị trang nhưng với mảng rỗng
            $products = [];
        }

        // Lấy hình ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
        }

        // Xác định view page dựa trên categoryId
        switch ($categoryId) {
            case 1: // Thanh Lath (thay thế cho Sofa)
                $viewPage = 'user/xmgg/thanhlath';
                break;
            case 2: // Thanh Plank (thay thế cho Ghế ăn)
                $viewPage = 'user/xmgg/plank';
                break;
            case 3: // Thanh Lapsiding (thay thế cho Ghế làm việc)
                $viewPage = 'user/xmgg/lapsiding';
                break;
            case 4: // Thanh Array (thay thế cho Kệ phòng khách)
                $viewPage = 'user/xmgg/array';
                break;
            case 5: // Thanh Deck (thay thế cho Kệ sách)
                $viewPage = 'user/xmgg/deck';
                break;
            case 6: // Thanh Mould (thay thế cho Giường ngủ)
                $viewPage = 'user/xmgg/mould';
                break;
            case 7: // Nệm
                $viewPage = 'user/phongngu/nem';
                break;
            case 8: // Bàn nước
                $viewPage = 'user/phongkhach/bannuoc';
                break;
            case 9: // Bàn ăn
                $viewPage = 'user/phongan/banan';
                break;
            case 10: // Bàn làm việc
                $viewPage = 'user/phonglamviec/banlamviec';
                break;
            case 11: // Tủ tivi
                $viewPage = 'user/phongkhach/tutivi';
                break;
            case 12: // Tủ bếp
                $viewPage = 'user/phongan/tubep';
                break;
            case 13: // Tủ ly
                $viewPage = 'user/phongan/tuly';
                break;
            case 14: // Tủ áo
                $viewPage = 'user/phongngu/tuao';
                break;
            case 15: // Gối
                $viewPage = 'user/phongngu/goi';
                break;
            case 16: // Mền
                $viewPage = 'user/phongngu/chan';
                break;
            case 17: // Bình trang trí
                $viewPage = 'user/hangtrangtri/binh';
                break;
            case 18: // Đèn trang trí
                $viewPage = 'user/hangtrangtri/den';
                break;
            case 19: // Tranh
                $viewPage = 'user/hangtrangtri/tranh';
                break;
            case 70: // Khang
                $viewPage = 'user/hangtrangtri/khang';
                break;
            case 71: // Khang xm
                $viewPage = 'user/hangtrangtri/khang-xm';
                break;
            default:
                $viewPage = 'user/phongkhach/default'; // Giá trị mặc định
        }

        // Gửi dữ liệu đến view tương ứng
        $this->sendPage($viewPage, ['products' => $products]);
    }



    public function showthanhlath()
    {
        $this->showProductsByCategory(1); // category_id cho thanh lath (thay thế cho sofa)
    }

    public function showplank()
    {
        $this->showProductsByCategory(2); // category_id cho thanh plank (thay thế cho ghế ăn)
    }

    public function showlapsiding()
    {
        $this->showProductsByCategory(3); // category_id cho thanh lapsiding (thay thế cho ghế làm việc)
    }

    public function showarray()
    {
        $this->showProductsByCategory(4); // category_id cho thanh array (thay thế cho kệ phòng khách)
    }

    public function showdeck()
    {
        $this->showProductsByCategory(5); // category_id cho thanh deck (thay thế cho kệ sách)
    }

    public function showmould()
    {
        $this->showProductsByCategory(6); // category_id cho thanh mould (thay thế cho giường ngủ)
    }

    public function shownem()
    {
        $this->showProductsByCategory(7); // category_id cho nệm
    }

    public function showbannuoc()
    {
        $this->showProductsByCategory(8); // category_id cho bàn nước
    }

    public function showbanan()
    {
        $this->showProductsByCategory(9); // category_id cho bàn ăn
    }

    public function showbanlamviec()
    {
        $this->showProductsByCategory(10); // category_id cho bàn làm việc
    }

    public function showtivi()
    {
        $this->showProductsByCategory(11); // category_id cho tivi
    }

    public function showtubep()
    {
        $this->showProductsByCategory(12); // category_id cho tủ bếp
    }

    public function showtuly()
    {
        $this->showProductsByCategory(13); // category_id cho tủ ly
    }

    public function showtuao()
    {
        $this->showProductsByCategory(14); // category_id cho tủ áo
    }

    public function showgoi()
    {
        $this->showProductsByCategory(15); // category_id cho gối
    }

    public function showmen()
    {
        $this->showProductsByCategory(16); // category_id cho gối
    }

    public function showbinh()
    {
        $this->showProductsByCategory(17); // category_id cho bình trang trí
    }

    public function showden()
    {
        $this->showProductsByCategory(18); // category_id cho đèn trang trí
    }

    public function showtranh()
    {
        $this->showProductsByCategory(19); // category_id cho tranh
    }

    public function showkhang()
    {
        $this->showProductsByCategory(70); // category_id cho khang
    }

    public function showkhangxm()
    {
        $this->showProductsByCategory(71); // category_id cho khang xm
    }

    public function showtran()
    {
        $this->sendPage('user/tran');
    }

    public function showlam()
    {
        $this->sendPage('user/lam');
    }

    public function showsan()
    {
        $this->sendPage('user/san');
    }

    public function showtuong()
    {
        $this->sendPage('user/tuong');
    }

    public function showvach()
    {
        $this->sendPage('user/vach');
    }

    public function showcua()
    {
        $this->sendPage('user/cua');
    }

    public function showhangrao()
    {
        $this->sendPage('user/hangrao');
    }

    public function showcauthang()
    {
        $this->sendPage('user/cauthang');
    }

    public function showbonhoa()
    {
        $this->sendPage('user/bonhoa');
    }

    public function showsanpham()
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);

        // Lấy từ khóa tìm kiếm và bộ lọc từ GET request
        $query = $_GET['query'] ?? '';
        $filter = $_GET['filter'] ?? 'popular'; // Mặc định là lọc theo mức độ phổ biến
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 16;

        // Lấy tổng số sản phẩm và sản phẩm dựa trên bộ lọc
        $totalProducts = $productModel->getTotalProducts($query);
        $totalPages = ceil($totalProducts / $itemsPerPage);

        // Lấy sản phẩm với phân trang và bộ lọc
        $products = $productModel->getProducts($page, $itemsPerPage, $query, $filter);

        // Lấy hình ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
        }

        // Gửi dữ liệu đến view 'user/sanpham'
        $this->sendPage('user/sanpham', [
            'products' => $products,
            'query' => $query,
            'filter' => $filter,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    }




    public function showchitietsanpham($id)
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);

        // Lấy chi tiết sản phẩm theo ID
        $product = $productModel->getProductById($id);

        // Kiểm tra xem sản phẩm có tồn tại không
        if ($product) {
            // Lấy hình ảnh cho sản phẩm dựa vào `product_id`
            $product['images'] = $productImageModel->getImagesByProductId($id);
            $product['main_image'] = $productImageModel->getMainImageForDisplay($id);

            // Kiểm tra xem sản phẩm có thuộc loại ximang không
            $isXimangProduct = false;
            if (isset($product['category_id'])) {
                $stmt = $this->db->prepare("SELECT category_type FROM categories WHERE category_id = ?");
                $stmt->execute([$product['category_id']]);
                $category = $stmt->fetch(PDO::FETCH_ASSOC);
                $isXimangProduct = $category && $category['category_type'] === 'ximang';
            }

            // Lấy danh sách sản phẩm liên quan dựa trên cùng loại (`category_id`)
            $categoryId = $product['category_id'];
            $relatedProducts = $productModel->getProductsByCategory($categoryId, $id, 8); // Hiển thị tối đa 8 sản phẩm liên quan

            // Lấy hình ảnh cho từng sản phẩm liên quan
            foreach ($relatedProducts as &$relatedProduct) {
                $relatedProduct['images'] = $productImageModel->getImagesByProductId($relatedProduct['product_id']);
                $relatedProduct['main_image'] = $productImageModel->getMainImageForDisplay($relatedProduct['product_id']);
            }

            // Gửi dữ liệu sản phẩm và sản phẩm liên quan đến view 'user/chitietsanpham'
            $this->sendPage('user/chitietsanpham', [
                'product' => $product,
                'relatedProducts' => $relatedProducts,
                'isXimangProduct' => $isXimangProduct
            ]);
        } else {
            return $this->sendPage('errors/404'); // Giả sử bạn có một trang lỗi 404
        }
    }





}

?>