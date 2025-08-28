<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;

class DynamicNoithatController extends Controller
{
    public function showCategoryBySlug($slug)
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);
        $categoryModel = new Category($this->db);
        
        // Lấy danh mục theo slug
        $category = $categoryModel->getCategoryBySlug($slug);
        
        if (!$category) {
            return $this->sendPage('errors/404');
        }
        
        // Kiểm tra xem có phải loại noithat không
        if ($category['category_type'] !== 'noithat') {
            return $this->sendPage('errors/404');
        }
        
        // Lấy sản phẩm theo danh mục
        $products = $productModel->getProductsByCategory($category['category_id']);
        
        if (empty($products)) {
            $products = [];
        } else {
            foreach ($products as &$product) {
                $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
                $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
            }
        }
        
        // Sử dụng template riêng cho noithat
        $this->sendPage('user/hangtrangtri/dynamic', [
            'category' => $category,
            'products' => $products
        ]);
    }
}
