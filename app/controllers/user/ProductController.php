<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{

    public function showsofa()
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);

        // Lấy tất cả sản phẩm thuộc category_id = 1 (Sofa)
        $products = $productModel->getProductsByCategory(1);

        // Lấy hình ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
        }

        // Gửi dữ liệu đến view 'user/sanpham'
        $this->sendPage('user/sanpham', ['products' => $products]);
    }


    public function showsanpham()
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);

        // Lấy tất cả sản phẩm
        $products = $productModel->getAllProducts();

        // Lấy hình ảnh cho từng sản phẩm
        foreach ($products as &$product) {
            $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
        }

        // Gửi dữ liệu đến view 'user/homePage'
        $this->sendPage('user/sanpham', ['products' => $products]);

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

        // Lấy các sản phẩm liên quan (ví dụ: 4 sản phẩm khác)
        $relatedProducts = $productModel->getRelatedProducts($id, 4);
        foreach ($relatedProducts as &$relatedProduct) {
            // Lấy hình ảnh đầu tiên của mỗi sản phẩm liên quan
            $relatedProduct['images'] = $productImageModel->getImagesByProductId($relatedProduct['product_id']);
        }
    } else {
        return $this->sendPage('errors/404'); // Giả sử bạn có một trang lỗi 404
    }

    // Gửi dữ liệu sản phẩm và sản phẩm liên quan đến view 'user/chitietsanpham'
    $this->sendPage('user/chitietsanpham', [
        'product' => $product,
        'relatedProducts' => $relatedProducts
    ]);
}


}

?>