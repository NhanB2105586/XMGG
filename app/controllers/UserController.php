<?php

namespace App\Controllers;

use App\Models\Product;

class UserController extends Controller
{

    public function showsofa()
    {
        $this->sendPage('user/phongkhach/sofa');
    }
    public function showsanpham()
    {
        $this->sendPage('user/sanpham');
    }
    public function showphongkhach()
    {
        $this->sendPage('user/phongkhach/phongkhach');
    }
    public function showphongan()
    {
        $this->sendPage('user/phongan/phongan');
    }
    public function showphongngu()
    {
        $this->sendPage('user/phongngu/phongngu');
    }
    public function showphonglamviec()
    {
        $this->sendPage('user/phonglamviec/phonglamviec');
    }

    public function showlienhe()
    {
        $this->sendPage('user/lienhe');
    }

    public function showdangnhap()
    {
        $this->sendPage('auth/dangnhap');
    }

    public function showdangki()
    {
        $this->sendPage('auth/dangki');
    }

    public function showkhoiphuc()
    {
        $this->sendPage('auth/khoiphucmatkhau');
    }

    public function showchitietsanpham($id)
    {
        $productModel = new Product($this->db);

        // Lấy thông tin sản phẩm
        $product = $productModel->getProductById($id);
        if (!$product) {
            $this->sendNotFound();
            return;
        }

        // Lấy danh sách ảnh của sản phẩm
        $images = $productModel->getProductImages($id);

        // Lấy danh sách chi tiết của sản phẩm
        $details = $productModel->getProductDetails($id);

        // Gửi tất cả dữ liệu đến view
        $this->sendPage('user/chitietsanpham', [
            'product' => $product,
            'images' => $images,
            'details' => $details
        ]);
    }

}
