<?php

namespace App\Controllers;

use League\Plates\Engine;
use PDO;
class Controller
{
    protected $view;
    protected $db;
    public function __construct()
    {
        $this->view = new Engine(ROOTDIR . 'app/views');
        $this->db = new PDO('mysql:host=localhost;dbname=project', 'root', 'nhan12345678');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Gửi trang với dữ liệu đi kèm
    public function sendPage($page, array $data = [])
    {
        exit($this->view->render($page, $data));
    }

    // Lưu các giá trị của form vào $_SESSION, loại trừ các key trong $except
    protected function saveFormValues(array $data, array $except = [])
    {
        $form = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $except, true)) {
                $form[$key] = $value;
            }
        }
        $_SESSION['form'] = $form;
    }

    // Lấy giá trị form đã lưu từ $_SESSION
    protected function getSavedFormValues()
    {
        return $_SESSION['form'] ?? [];
    }

    // Gửi lỗi 404
    public function sendNotFound()
    {
        http_response_code(404);
        exit($this->view->render('errors/404'));
    }

    // Gửi phản hồi JSON
    protected function jsonResponse($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    // Xử lý lỗi
    protected function handleError($message, $status = 400)
    {
        $this->jsonResponse(['error' => $message], $status);
    }

    // Xử lý thành công
    protected function handleSuccess($message, $data = null, $status = 200)
    {
        $response = ['message' => $message];
        if ($data) {
            $response['data'] = $data;
        }
        $this->jsonResponse($response, $status);
    }
    
    
}