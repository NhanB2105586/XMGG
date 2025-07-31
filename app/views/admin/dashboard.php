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
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="text-primary fw-bold mb-1">
                            <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                        </h2>
                        <p class="text-muted mb-0">Tổng quan hệ thống Đại Quân Decor</p>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">Cập nhật lần cuối</div>
                        <div class="fw-semibold"><?php echo date('d/m/Y H:i'); ?></div>
                    </div>
                </div>

                <!-- Thống kê chính -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 opacity-75">Tổng người dùng</h6>
                                        <h3 class="mb-0 fw-bold"><?php echo htmlspecialchars($userCount); ?></h3>
                                        <small class="opacity-75">Khách hàng đã đăng ký</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                        <i class="fa fa-users fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 opacity-75">Tổng đơn hàng</h6>
                                        <h3 class="mb-0 fw-bold"><?php echo htmlspecialchars($orderCount); ?></h3>
                                        <small class="opacity-75">Đơn hàng đã đặt</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                        <i class="fa fa-shopping-cart fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 opacity-75">Đơn hàng thành công</h6>
                                        <h3 class="mb-0 fw-bold"><?php echo htmlspecialchars($successfulOrders); ?></h3>
                                        <small class="opacity-75">Đã hoàn thành</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                        <i class="fa fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 opacity-75">Doanh thu</h6>
                                        <h3 class="mb-0 fw-bold"><?php echo number_format($revenue, 0, ',', '.'); ?></h3>
                                        <small class="opacity-75">VNĐ</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-3">
                                        <i class="fa fa-dollar-sign fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
                </div>

                <!-- Biểu đồ và thống kê chi tiết -->
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 text-dark fw-semibold">
                                    <i class="fa fa-chart-line me-2"></i>Thống kê đơn hàng
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-3 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fa fa-clock text-warning fa-2x mb-2"></i>
                                            <h6 class="mb-1">Đang xử lý</h6>
                                            <h4 class="text-warning mb-0"><?php echo $orderCount - $successfulOrders; ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fa fa-truck text-info fa-2x mb-2"></i>
                                            <h6 class="mb-1">Đang giao</h6>
                                            <h4 class="text-info mb-0">0</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fa fa-check text-success fa-2x mb-2"></i>
                                            <h6 class="mb-1">Hoàn thành</h6>
                                            <h4 class="text-success mb-0"><?php echo $successfulOrders; ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="p-3 bg-light rounded">
                                            <i class="fa fa-times text-danger fa-2x mb-2"></i>
                                            <h6 class="mb-1">Đã hủy</h6>
                                            <h4 class="text-danger mb-0">0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 text-dark fw-semibold">
                                    <i class="fa fa-tasks me-2"></i>Hành động nhanh
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="/admin/viewOrders" class="btn btn-outline-primary">
                                        <i class="fa fa-shopping-cart me-2"></i>Xem đơn hàng
                                    </a>
                                    <a href="/admin/viewProducts" class="btn btn-outline-success">
                                        <i class="fa fa-th-large me-2"></i>Quản lý sản phẩm
                                    </a>
                                    <a href="/admin/viewCategory" class="btn btn-outline-secondary">
                                        <i class="fa fa-th me-2"></i>Quản lý Hạng mục
                                    </a>
                                    <a href="/admin/contacts" class="btn btn-outline-warning">
                                        <i class="fa fa-envelope me-2"></i>Tin nhắn mới
                                    </a>
                                    <a href="/admin/viewCustomer" class="btn btn-outline-info">
                                        <i class="fa fa-users me-2"></i>Khách hàng
                                    </a>
                                </div>
                            </div>
                </div>
            </div>
                </div>

                <!-- Thông báo hệ thống -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="mb-0 text-dark fw-semibold">
                                    <i class="fa fa-bell me-2"></i>Thông báo hệ thống
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info border-0 mb-0">
                                    <i class="fa fa-info-circle me-2"></i>
                                    <strong>Chào mừng!</strong> Hệ thống quản lý Đại Quân Decor đã sẵn sàng phục vụ bạn.
                                </div>
                            </div>
                </div>
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
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }
        .btn-outline-success:hover {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border-color: #43e97b;
        }
        .btn-outline-warning:hover {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-color: #f093fb;
        }
        .btn-outline-info:hover {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-color: #4facfe;
        }
    </style>

    <?php
    // Xử lý thông báo từ các yêu cầu khác
    $messages = [
        'category' => 'Category Successfully Added',
        'size' => 'Size Successfully Added',
        'variation' => 'Variation Successfully Added'
    ];

    foreach ($messages as $key => $successMessage) {
        if (isset($_GET[$key])) {
            $message = ($_GET[$key] == "success") ? $successMessage : "Adding Unsuccess";
            echo '<script>alert("' . htmlspecialchars($message) . '")</script>';
        }
    }
    ?>

    <?php include_once __DIR__ . '/../partials/footAdmin.php'; ?>
</body>