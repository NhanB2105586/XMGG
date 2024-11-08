<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\User; 
use PDO;

class ManageCustomerController extends Controller
{
    private User $customerModel;

    public function __construct(PDO $pdo)
    {
        $this->customerModel = new User($pdo);
        parent::__construct();
    }

    public function index()
    {
        $limit = 10; // Số lượng khách hàng hiển thị trên mỗi trang
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Lấy trang hiện tại từ query string
        $offset = ($page - 1) * $limit; // Tính toán offset

        // Lấy danh sách khách hàng và tổng số khách hàng
        $customers = $this->customerModel->getCustomersSearch($limit, $offset,$searchTerm);
        $totalCustomers = $this->customerModel->getTotalCustomersSearch($searchTerm);
        $totalPages = ceil($totalCustomers / $limit); // Tính tổng số trang

        // Gửi dữ liệu đến view
        $this->sendPage('admin/viewCustomers', [
            'customers' => $customers,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'searchTerm' => $searchTerm,
        ]);
    }
    public function showForm()
    {
        $this->sendPage('admin/addCustomer');
    }

    public function addCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy và lọc dữ liệu từ form
            $data = $this->filterData(['fullname', 'email', 'password', 'address', 'phone_number'], $_POST);

            // Kiểm tra xem tất cả các trường có được điền đầy đủ không
            if (in_array('', $data)) {
                $errors[] = 'Vui lòng điền đầy đủ tất cả các thông tin.';
                $this->sendPage('admin/addCustomer', ['errors' => $errors, 'old' => $data]);
                return;
            }

            // Kiểm tra dữ liệu
            $errors = $this->validateCustomerData($data);
            if (!empty($errors)) {
                // Nếu có lỗi, hiển thị lại form với thông báo lỗi
                $this->sendPage('admin/addCustomer', ['errors' => $errors, 'old' => $data]);
                return;
            }

            // Kiểm tra trùng lặp email
            if ($this->customerModel->emailExists($data['email'])) {
                $errors[] = 'Email đã tồn tại.';
            }

            // Nếu có lỗi trùng lặp, hiển thị lại form
            if (!empty($errors)) {
                $this->sendPage('admin/addCustomer', ['errors' => $errors, 'old' => $data]);
                return;
            }

            // Mã hóa mật khẩu trước khi lưu
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            // Thêm khách hàng vào cơ sở dữ liệu
            if ($this->customerModel->addUser($data)) {
                // Lưu thông báo thành công vào session
                $_SESSION['success_message'] = 'Khách hàng đã được thêm thành công!';
            } else {
                // Lưu thông báo lỗi vào session
                $_SESSION['error_message'] = 'Có lỗi xảy ra khi thêm khách hàng. Vui lòng thử lại.';
            }

            // Chuyển hướng đến trang danh sách khách hàng
            header('Location: /admin/viewCustomer'); // Thay đổi đường dẫn nếu cần
            exit;
        }

        // Nếu không phải là POST, hiển thị form thêm khách hàng
        $this->showForm();
    }

    public function editCustomer($id)
    {
        $customer = $this->customerModel->getByID('users', 'user_id', $id);
        if (!$customer) {
            $this->sendNotFound();
            return;
        }

        $message = '';
        $errors = []; // Biến để chứa thông báo

        // Kiểm tra xem có yêu cầu POST không
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lọc dữ liệu từ form
            $data = $this->filterData(['fullname', 'username', 'email', 'address', 'phone_number'], $_POST);


            // Kiểm tra tính hợp lệ của dữ liệu
            if (empty($data['fullname']) || empty($data['address']) || empty($data['phone_number']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Vui lòng điền đầy đủ thông tin hợp lệ.'; // Thông báo lỗi
            } else {
                // Cập nhật thông tin khách hàng
                if ($this->customerModel->updateUser($id, $data)) {
                    $_SESSION['success_message'] = 'Khách hàng đã được cập nhật thành công!';
                    header('Location: /admin/viewCustomer');
                    exit;
                } else {
                    $errors[] = 'Có lỗi xảy ra khi cập nhật khách hàng.'; // Thông báo lỗi
                }
            }
        }

        // Gửi dữ liệu đến view
        $this->sendPage('admin/editCustomer', [
            'customer' => $customer,
            'message' => $message,
            'errors' => $errors,
        ]);
    }



    public function deleteCustomer()
    {
        // Kiểm tra xem có ID được gửi không
        if (isset($_POST['id'])) {
            $customerId = $_POST['id'];
            if ($this->customerModel->existsInTable('orders','user_id',$customerId)) {
                // Lưu thông báo lỗi
                $_SESSION['error_message'] = 'Không thể xóa khách hàng này vì còn đơn hàng liên quan.';
            } else {
                $this->customerModel->deleteUser($customerId);
                $_SESSION['success_message'] = 'Khách hàng đã được xóa thành công!';
            }

            // Chuyển hướng về danh sách khách hàng
            header('Location: /admin/viewCustomer');
            exit;
        }
    }


    private function validateCustomerData(array $data): array
    {
        $errors = [];
        if (empty($data['fullname'])) {
            $errors[] = 'Họ và tên là bắt buộc.';
        }
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email không hợp lệ.';
        }
        if (empty($data['password'])) {
            $errors[] = 'Mật khẩu là bắt buộc.';
        }
        return $errors;
    }
}