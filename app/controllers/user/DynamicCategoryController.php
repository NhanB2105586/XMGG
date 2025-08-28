<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;

class DynamicCategoryController extends Controller
{
    public function showCategoryBySlug($slug)
    {
        $productModel = new Product($this->db);
        $productImageModel = new ProductImage($this->db);
        $categoryModel = new Category($this->db);
        $category = $categoryModel->getCategoryBySlug($slug);
        
        if (!$category) {
            return $this->sendPage('errors/404');
        }

        $products = $productModel->getProductsByCategory($category['category_id']);
        if (empty($products)) {
            $products = [];
        } else {
            // Lấy hình ảnh cho từng sản phẩm
            foreach ($products as &$product) {
                $product['images'] = $productImageModel->getImagesByProductId($product['product_id']);
                $product['main_image'] = $productImageModel->getMainImageForDisplay($product['product_id']);
            }
        }

        // Xác định template dựa trên loại danh mục
        $viewPage = $this->getViewPageByCategoryType($category['category_type'], $slug);
        
        $this->sendPage($viewPage, [
            'category' => $category,
            'products' => $products
        ]);
    }

    private function getViewPageByCategoryType($categoryType, $slug)
    {
        switch ($categoryType) {
            case 'ximang':
                return 'user/xmgg/dynamicxm';
            case 'noithat':
                return 'user/hangtrangtri/dynamic';
            default:
                return 'user/hangtrangtri/dynamic';
        }
    }
}
