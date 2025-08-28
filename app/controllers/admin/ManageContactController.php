<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Contact;

class ManageContactController extends Controller {
    private $contactModel;

    public function __construct() {
        parent::__construct();
        $this->contactModel = new Contact($this->db);
    }

    // Hiển thị trang quản lý liên hệ
    public function index() {
        $contacts = $this->contactModel->getAllContacts();
        $uncontactedCount = $this->contactModel->getUncontactedCount();
        
        include __DIR__ . '/../../views/admin/viewContact.php';
    }

    // Đánh dấu đã liên hệ
    public function markAsContacted() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            
            if ($this->contactModel->markAsContacted($id)) {
                $_SESSION['success'] = 'Đã đánh dấu đã liên hệ!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }
        
        header('Location: /admin/contacts');
        exit;
    }

    // Xóa liên hệ
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            
            if ($this->contactModel->deleteContact($id)) {
                $_SESSION['success'] = 'Đã xóa liên hệ!';
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra!';
            }
        }
        
        header('Location: /admin/contacts');
        exit;
    }
}
?> 