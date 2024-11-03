<?php

namespace App\Controllers;

use App\Models\Product;

class UserController extends Controller
{

    public function showsofa()
    {
        $this->sendPage('user/sofa');
    }
    public function showsanpham()
    {
        $productModel = new Product($this->db); // Khởi tạo Product với PDO
        $products = $productModel->all(); // Lấy tất cả sản phẩm

        $this->sendPage('user/sanpham', ['products' => $products]);
    }
    public function showphongkhach()
    {
        $this->sendPage('user/phongkhach');
    }
}
