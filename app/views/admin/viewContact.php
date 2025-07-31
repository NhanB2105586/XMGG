<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div class="container-fluid mt-4" id="main-content">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-primary fw-bold">
                        <i class="fa fa-envelope me-2"></i>Quản lý Liên hệ
                    </h2>
                    <div class="text-muted">
                        <small>Hệ thống quản lý tin nhắn từ khách hàng</small>
                    </div>
                </div>

                <!-- Thống kê -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 opacity-75">Tổng số liên hệ</h6>
                                        <h3 class="mb-0 fw-bold"><?php echo count($contacts); ?></h3>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                        <i class="fa fa-envelope fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 opacity-75">Chưa xử lý</h6>
                                        <h3 class="mb-0 fw-bold"><?php echo $uncontactedCount; ?></h3>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                        <i class="fa fa-clock fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 opacity-75">Đã xử lý</h6>
                                        <h3 class="mb-0 fw-bold"><?php echo count($contacts) - $uncontactedCount; ?></h3>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                        <i class="fa fa-check fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>

                <!-- Thông báo -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i>
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>

                <!-- Danh sách liên hệ -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 text-dark fw-semibold">
                            <i class="fa fa-list me-2"></i>Danh sách tin nhắn
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($contacts)): ?>
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fa fa-inbox fa-4x text-muted"></i>
                                </div>
                                <h5 class="text-muted">Chưa có tin nhắn nào</h5>
                                <p class="text-muted">Khách hàng sẽ gửi tin nhắn qua form liên hệ</p>
            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0 py-3 px-4" style="width: 50px;">#</th>
                                            <th class="border-0 py-3 px-4">Thông tin khách hàng</th>
                                            <th class="border-0 py-3 px-4">Nội dung</th>
                                            <th class="border-0 py-3 px-4" style="width: 120px;">Ngày gửi</th>
                                            <th class="border-0 py-3 px-4" style="width: 100px;">Trạng thái</th>
                                            <th class="border-0 py-3 px-4" style="width: 150px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $index => $contact): ?>
                                            <tr class="<?php echo ($contact['contacted'] == 1) ? 'table-success' : ''; ?>">
                                                <td class="px-4 py-3">
                                                    <span class="badge bg-secondary rounded-pill"><?php echo $index + 1; ?></span>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="fa fa-user text-primary"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold"><?php echo htmlspecialchars($contact['fullname']); ?></h6>
                                                            <div class="text-muted small">
                                                                <i class="fa fa-envelope me-1"></i><?php echo htmlspecialchars($contact['email']); ?>
                                                            </div>
                                                            <div class="text-muted small">
                                                                <i class="fa fa-phone me-1"></i><?php echo htmlspecialchars($contact['phone']); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="message-preview">
                                                        <?php 
                                                        $message = htmlspecialchars($contact['message']);
                                                        $preview = strlen($message) > 100 ? substr($message, 0, 100) . '...' : $message;
                                                        echo $preview;
                                                        ?>
                                                        <?php if (strlen($message) > 100): ?>
                                                            <button type="button" class="btn btn-link btn-sm p-0 ms-2" 
                                                                    data-bs-toggle="modal" data-bs-target="#messageModal<?php echo $contact['id']; ?>">
                                                                Xem thêm
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-muted small">
                                                        <i class="fa fa-calendar me-1"></i>
                                                        <?php echo date('d/m/Y', strtotime($contact['created_at'])); ?>
                                                    </div>
                                                    <div class="text-muted small">
                                                        <i class="fa fa-clock me-1"></i>
                                                        <?php echo date('H:i', strtotime($contact['created_at'])); ?>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <?php if ($contact['contacted'] == 1): ?>
                                                        <span class="badge bg-success rounded-pill">
                                                            <i class="fa fa-check me-1"></i>Đã liên hệ
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning rounded-pill">
                                                            <i class="fa fa-clock me-1"></i>Chưa liên hệ
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="btn-group" role="group">
                                                        <?php if ($contact['contacted'] != 1): ?>
                                                            <form method="POST" action="/admin/contacts/mark-contacted" style="display: inline;">
                                                                <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                                                                <button type="submit" class="btn btn-success btn-sm" title="Đánh dấu đã liên hệ">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                            </form>
                                                        <?php endif; ?>
                                                        
                                                        <form method="POST" action="/admin/contacts/delete" style="display: inline;" 
                                                              onsubmit="return confirm('Bạn có chắc muốn xóa tin nhắn này?')">
                                                            <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Xóa tin nhắn">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                            </form>
                                                    </div>
                        </td>
                    </tr>
                                            
                                            <!-- Modal hiển thị nội dung đầy đủ -->
                                            <div class="modal fade" id="messageModal<?php echo $contact['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">
                                                                <i class="fa fa-envelope me-2"></i>Chi tiết tin nhắn
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h6 class="text-primary mb-2">Thông tin người gửi</h6>
                                                                    <div class="card bg-light border-0">
                                                                        <div class="card-body">
                                                                            <p class="mb-2">
                                                                                <i class="fa fa-user text-primary me-2"></i>
                                                                                <strong>Họ tên:</strong> <?php echo htmlspecialchars($contact['fullname']); ?>
                                                                            </p>
                                                                            <p class="mb-2">
                                                                                <i class="fa fa-envelope text-primary me-2"></i>
                                                                                <strong>Email:</strong> <?php echo htmlspecialchars($contact['email']); ?>
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                <i class="fa fa-phone text-primary me-2"></i>
                                                                                <strong>Số điện thoại:</strong> <?php echo htmlspecialchars($contact['phone']); ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6 class="text-primary mb-2">Thông tin tin nhắn</h6>
                                                                    <div class="card bg-light border-0">
                                                                        <div class="card-body">
                                                                            <p class="mb-2">
                                                                                <i class="fa fa-calendar text-primary me-2"></i>
                                                                                <strong>Ngày gửi:</strong> <?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?>
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                <i class="fa fa-info-circle text-primary me-2"></i>
                                                                                <strong>Trạng thái:</strong> 
                                                                                <?php if ($contact['contacted'] == 1): ?>
                                                                                    <span class="badge bg-success">Đã liên hệ</span>
                    <?php else: ?>
                                                                                    <span class="badge bg-warning">Chưa liên hệ</span>
                    <?php endif; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-4">
                                                                <h6 class="text-primary mb-2">Nội dung tin nhắn</h6>
                                                                <div class="card border-0 bg-light">
                                                                    <div class="card-body">
                                                                        <p class="mb-0" style="white-space: pre-wrap;"><?php echo htmlspecialchars($contact['message']); ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fa fa-times me-1"></i>Đóng
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                </tbody>
            </table>
                            </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-2px);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0,123,255,0.05) !important;
        }
        .message-preview {
            max-width: 300px;
        }
        .btn-group .btn {
            margin-right: 2px;
        }
        .badge {
            font-size: 0.75rem;
        }
    </style>

    <?php include_once __DIR__ . '/../partials/footAdmin.php'; ?>
</body>
