<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;

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
            // Có thể thông báo hoặc chuyển hướng
            $this->sendPage('user/phongkhach/phongkhach');
            return;
        }

        // Lấy hình ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
        }

        // Xác định view page dựa trên categoryId
        switch ($categoryId) {
            case 1: // Sofa
                $viewPage = 'user/phongkhach/sofa';
                break;
            case 2: // Ghế ăn
                $viewPage = 'user/phongan/ghean';
                break;
            case 3: // Ghế làm việc
                $viewPage = 'user/phonglamviec/ghelamviec';
                break;
            case 4: // Kệ phòng khách
                $viewPage = 'user/phongkhach/kephongkhach';
                break;
            case 5: // Kệ sách
                $viewPage = 'user/phonglamviec/kesach';
                break;
            case 6: // Giường ngủ
                $viewPage = 'user/phongngu/giuongngu';
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
            default:
                $viewPage = 'user/phongkhach/default'; // Giá trị mặc định
        }

        // Gửi dữ liệu đến view tương ứng
        $this->sendPage($viewPage, ['products' => $products]);
    }



    public function showsofa()
    {
        $this->showProductsByCategory(1); // category_id cho sofa
    }

    public function showghean()
    {
        $this->showProductsByCategory(2); // category_id cho ghế ăn
    }

    public function showghelamviec()
    {
        $this->showProductsByCategory(3); // category_id cho ghế làm việc
    }

    public function showkephongkhach()
    {
        $this->showProductsByCategory(4); // category_id cho kệ phòng khách
    }

    public function showkesach()
    {
        $this->showProductsByCategory(5); // category_id cho kệ sách
    }

    public function showgiuongngu()
    {
        $this->showProductsByCategory(6); // category_id cho giường ngủ
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

            // Lấy danh sách sản phẩm liên quan dựa trên cùng loại (`category_id`)
            $categoryId = $product['category_id'];
            $relatedProducts = $productModel->getProductsByCategory($categoryId, $id, 8); // Hiển thị tối đa 8 sản phẩm liên quan

            // Lấy hình ảnh cho từng sản phẩm liên quan
            foreach ($relatedProducts as &$relatedProduct) {
                $relatedProduct['images'] = $productImageModel->getImagesByProductId($relatedProduct['product_id']);
            }

            // Gửi dữ liệu sản phẩm và sản phẩm liên quan đến view 'user/chitietsanpham'
            $this->sendPage('user/chitietsanpham', [
                'product' => $product,
                'relatedProducts' => $relatedProducts
            ]);
        } else {
            return $this->sendPage('errors/404'); // Giả sử bạn có một trang lỗi 404
        }
    }





}

?>