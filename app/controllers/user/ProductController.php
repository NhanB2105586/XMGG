<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Product;
use PDO;

class ProductController extends Controller
{
    private Product $productModel;

    public function __construct(PDO $pdo)
    {
        $this->productModel = new Product($pdo);
        parent::__construct();
    }

    public function index()
    {
        $products = $this->productModel->all();
        $this->sendPage('user/sanpham', [
            'products' => $products,
        ]);
    }

    public function show(int $id)
    {
        $product = $this->productModel->find($id);

        if ($product) {
            $this->sendPage('products/show', ['product' => $product]);
        } else {
            $this->sendNotFound();
        }
    }
}
