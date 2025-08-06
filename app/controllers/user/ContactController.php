<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller {
    private $contactModel;

    public function __construct() {
        parent::__construct();
        $this->contactModel = new Contact($this->db);
    }

    // Xử lý submit form liên hệ
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $message = $_POST['message'] ?? '';

            // Validate dữ liệu
            if (empty($fullname) || empty($email) || empty($phone) || empty($message)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin!';
                header('Location: /lienhe');
                exit;
            }

            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Email không hợp lệ!';
                header('Location: /lienhe');
                exit;
            }

            // Thêm liên hệ vào database
            if ($this->contactModel->addContact($fullname, $email, $phone, $message)) {
                $_SESSION['success'] = 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.';
                header('Location: /lienhe');
                exit;
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra! Vui lòng thử lại.';
                header('Location: /lienhe');
                exit;
            }
        }
    }
}
?> 