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
               <!-- Modern Header -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h1 class="display-6 fw-bold text-gradient mb-2">
                            <i class="fas fa-tachometer-alt me-3"></i>Dashboard
                        </h1>
                        <p class="text-muted fs-5 mb-0">Tổng quan hệ thống Đại Quân Decor</p>
                    </div>
                    <div class="text-end">
                        <div class="badge bg-light text-dark fs-6 mb-2">
                            <i class="fas fa-clock me-2"></i>Cập nhật lần cuối
                        </div>
                        <div class="fw-semibold fs-5"><?php echo date('d/m/Y H:i'); ?></div>
                    </div>
                </div>

                <!-- Modern Stats Cards -->
                <div class="row mb-5">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-2 opacity-75 fw-semibold">Tổng người dùng</h6>
                                        <h2 class="mb-1 fw-bold display-6"><?php echo htmlspecialchars($userCount); ?></h2>
                                        <small class="opacity-75">Khách hàng đã đăng ký</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-4">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <div class="text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-2 opacity-75 fw-semibold">Tổng đơn hàng</h6>
                                        <h2 class="mb-1 fw-bold display-6"><?php echo htmlspecialchars($orderCount); ?></h2>
                                        <small class="opacity-75">Đơn hàng đã đặt</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-4">
                                        <i class="fas fa-shopping-cart fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <div class="text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-2 opacity-75 fw-semibold">Đơn hàng thành công</h6>
                                        <h2 class="mb-1 fw-bold display-6"><?php echo htmlspecialchars($successfulOrders); ?></h2>
                                        <small class="opacity-75">Đã hoàn thành</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-4">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card h-100" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <div class="text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-2 opacity-75 fw-semibold">Doanh thu</h6>
                                        <h2 class="mb-1 fw-bold display-6"><?php echo number_format($revenue, 0, ',', '.'); ?></h2>
                                        <small class="opacity-75">VNĐ</small>
                                    </div>
                                    <div class="bg-white bg-opacity-20 rounded-circle p-4">
                                        <i class="fas fa-dollar-sign fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modern Content Sections -->
                <div class="row">
                    <!-- Recent Orders -->
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-list-alt me-2"></i>Đơn hàng gần đây
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Khách hàng</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($recentOrders)): ?>
                                                <?php foreach ($recentOrders as $order): ?>
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary">#<?php echo htmlspecialchars($order['order_id']); ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bg-light rounded-circle p-2 me-3">
                                                                    <i class="fas fa-user text-muted"></i>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-semibold"><?php echo htmlspecialchars($order['customer_name']); ?></div>
                                                                    <small class="text-muted"><?php echo htmlspecialchars($order['email']); ?></small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="fw-bold text-success">
                                                                <?php echo number_format($order['total_amount'], 0, ',', '.'); ?>đ
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $statusClass = '';
                                                            $statusText = '';
                                                            switch ($order['status']) {
                                                                case 'pending':
                                                                    $statusClass = 'bg-warning';
                                                                    $statusText = 'Chờ xử lý';
                                                                    break;
                                                                case 'processing':
                                                                    $statusClass = 'bg-info';
                                                                    $statusText = 'Đang xử lý';
                                                                    break;
                                                                case 'completed':
                                                                    $statusClass = 'bg-success';
                                                                    $statusText = 'Hoàn thành';
                                                                    break;
                                                                case 'cancelled':
                                                                    $statusClass = 'bg-danger';
                                                                    $statusText = 'Đã hủy';
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class="badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button type="button" class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-outline-success">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                                            <p>Chưa có đơn hàng nào</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-bolt me-2"></i>Thao tác nhanh
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-3">
                                    <a href="/admin/addProduct" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                                    </a>
                                    <a href="/admin/viewProduct" class="btn btn-outline-primary">
                                        <i class="fas fa-box me-2"></i>Quản lý sản phẩm
                                    </a>
                                    <a href="/admin/viewOrder" class="btn btn-outline-success">
                                        <i class="fas fa-shopping-cart me-2"></i>Xem đơn hàng
                                    </a>
                                    <a href="/admin/viewCustomers" class="btn btn-outline-info">
                                        <i class="fas fa-users me-2"></i>Quản lý khách hàng
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-chart-line me-2"></i>Thống kê doanh thu theo tháng
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <canvas id="revenueChart" width="400" height="200"></canvas>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="monthly-stats">
                                            <h6 class="text-muted mb-3">Tổng quan tháng</h6>
                                            <div id="monthlyStats">
                                                <p class="text-muted">Click vào điểm trên biểu đồ để xem chi tiết</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Modal -->
                <div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-labelledby="ordersModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content modern-modal">
                            <div class="modal-header modern-header">
                                <div class="modal-title-wrapper">
                                    <h5 class="modal-title" id="ordersModalLabel">
                                        <i class="fas fa-chart-bar me-2"></i>
                                        Chi tiết hóa đơn tháng <span id="selectedMonth" class="highlight-month"></span>
                                    </h5>
                                    <p class="modal-subtitle mb-0">Danh sách đơn hàng và thống kê chi tiết</p>
                                </div>
                                <button type="button" class="btn-close-modern" data-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="modal-body modern-body">
                                <div id="ordersList">
                                    <div class="loading-container">
                                        <div class="loading-spinner">
                                            <div class="spinner-ring"></div>
                                            <div class="spinner-text">Đang tải dữ liệu...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footAdmin.php'; ?>

    <style>
        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .chart-container {
            position: relative;
            height: 400px;
        }
        
        .monthly-stats {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            height: 100%;
        }
        
        .revenue-point {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .revenue-point:hover {
            transform: scale(1.1);
        }
        
        /* Modern Modal Styles */
        .modern-modal {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        .modern-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1.5rem 2rem;
            position: relative;
        }
        
        .modal-title-wrapper {
            flex: 1;
        }
        
        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .highlight-month {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            margin-left: 0.5rem;
            font-weight: 600;
        }
        
        .modal-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }
        
        .btn-close-modern {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-close-modern:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
            color: white;
        }
        
        .btn-close-modern:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }
        
        .btn-close-modern::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }
        
        .btn-close-modern:hover::before {
            width: 100%;
            height: 100%;
        }
        
        .modern-body {
            padding: 2rem;
            background: #f8f9fa;
        }
        
        /* Loading Animation */
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }
        
        .loading-spinner {
            text-align: center;
        }
        
        .spinner-ring {
            width: 60px;
            height: 60px;
            border: 4px solid #e3e3e3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }
        
        .spinner-text {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Table Styles */
        .modern-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .modern-table .table {
            margin: 0;
        }
        
        .modern-table .table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            padding: 1rem;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        
        .modern-table .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .modern-table .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: translateY(-1px);
        }
        
        .modern-table .table tbody td {
            padding: 1rem;
            border: none;
            border-bottom: 1px solid #f1f3f4;
            vertical-align: middle;
        }
        
        /* Status Badge Styles */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-pending {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            color: #fff;
        }
        
        .status-processing {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: #fff;
        }
        
        .status-completed {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #fff;
        }
        
        .status-cancelled {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: #fff;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .empty-state h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .empty-state p {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        /* Error State */
        .error-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #dc3545;
        }
        
        .error-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.7;
        }
        
        .error-state h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .error-state p {
            font-size: 0.9rem;
            opacity: 0.8;
        }
    </style>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Dữ liệu doanh thu theo tháng từ PHP
        const monthlyRevenue = <?php echo json_encode($monthlyRevenue); ?>;
        
        // Tên các tháng
        const monthNames = [
            'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];
        
        // Chuẩn bị dữ liệu cho biểu đồ
        const labels = monthNames;
        const data = Object.values(monthlyRevenue);
        
        // Tạo biểu đồ
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: data,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(75, 192, 192)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN').format(context.parsed.y) + ' VNĐ';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('vi-VN').format(value) + ' VNĐ';
                            }
                        }
                    }
                },
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const index = elements[0].index;
                        const month = index + 1;
                        const revenue = data[index];
                        
                        if (revenue > 0) {
                            showOrdersForMonth(month, monthNames[index]);
                        }
                    }
                },
                onHover: function(event, elements) {
                    event.native.target.style.cursor = elements.length > 0 ? 'pointer' : 'default';
                }
            }
        });
        
        // Hiển thị thống kê tháng khi hover
        revenueChart.options.plugins.tooltip.callbacks.afterBody = function(context) {
            const index = context[0].dataIndex;
            const month = index + 1;
            const revenue = data[index];
            
            if (revenue > 0) {
                return 'Click để xem chi tiết hóa đơn';
            }
            return 'Chưa có doanh thu';
        };
        
        // Hàm hiển thị hóa đơn theo tháng
        function showOrdersForMonth(month, monthName) {
            document.getElementById('selectedMonth').textContent = monthName;
            document.getElementById('ordersList').innerHTML = `
                <div class="loading-container">
                    <div class="loading-spinner">
                        <div class="spinner-ring"></div>
                        <div class="spinner-text">Đang tải dữ liệu...</div>
                    </div>
                </div>
            `;
            
            $('#ordersModal').modal('show');
            
            // Gọi API để lấy hóa đơn
            fetch('/admin/getOrdersByMonth', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    month: month,
                    year: new Date().getFullYear()
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.orders && data.orders.length > 0) {
                    displayOrders(data.orders);
                } else {
                    document.getElementById('ordersList').innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h5>Không có dữ liệu</h5>
                            <p>Không có hóa đơn nào trong tháng này</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('ordersList').innerHTML = `
                    <div class="error-state">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h5>Lỗi tải dữ liệu</h5>
                        <p>Có lỗi xảy ra khi tải dữ liệu. Vui lòng thử lại sau.</p>
                    </div>
                `;
            });
        }
        
        // Hiển thị danh sách hóa đơn
        function displayOrders(orders) {
            let html = `
                <div class="modern-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-2"></i>Mã đơn hàng</th>
                                    <th><i class="fas fa-user me-2"></i>Khách hàng</th>
                                    <th><i class="fas fa-calendar me-2"></i>Ngày đặt</th>
                                    <th><i class="fas fa-money-bill-wave me-2"></i>Tổng tiền</th>
                                    <th><i class="fas fa-info-circle me-2"></i>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
            `;
            
            orders.forEach(order => {
                const statusClass = getStatusClass(order.status);
                const statusText = getStatusText(order.status);
                const orderDate = new Date(order.order_date).toLocaleDateString('vi-VN');
                
                html += `
                    <tr>
                        <td><span class="badge bg-primary" style="font-size: 0.9rem; padding: 0.5rem 0.75rem;">#${order.order_id}</span></td>
                        <td>
                            <div>
                                <div class="fw-semibold" style="color: #495057;">${order.customer_name}</div>
                                <small class="text-muted" style="font-size: 0.8rem;">${order.email}</small>
                            </div>
                        </td>
                        <td style="color: #6c757d; font-weight: 500;">${orderDate}</td>
                        <td><span class="fw-bold" style="color: #28a745; font-size: 1.1rem;">${new Intl.NumberFormat('vi-VN').format(order.total_amount)}đ</span></td>
                        <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    </tr>
                `;
            });
            
            html += `
                            </tbody>
                        </table>
                    </div>
                </div>
            `;
            
            document.getElementById('ordersList').innerHTML = html;
        }
        
        // Hàm helper để lấy class cho trạng thái
        function getStatusClass(status) {
            switch (status) {
                case 'pending': return 'status-pending';
                case 'processing': return 'status-processing';
                case 'completed': return 'status-completed';
                case 'cancelled': return 'status-cancelled';
                default: return 'status-pending';
            }
        }
        
        // Hàm helper để lấy text cho trạng thái
        function getStatusText(status) {
            switch (status) {
                case 'pending': return 'Chờ xử lý';
                case 'processing': return 'Đang xử lý';
                case 'completed': return 'Hoàn thành';
                case 'cancelled': return 'Đã hủy';
                default: return 'Không xác định';
            }
        }

        // Đảm bảo modal hoạt động khi trang load xong
        $(document).ready(function() {
            // Xử lý sự kiện đóng modal
            $('#ordersModal').on('hidden.bs.modal', function () {
                // Reset nội dung modal khi đóng
                document.getElementById('ordersList').innerHTML = `
                    <div class="loading-container">
                        <div class="loading-spinner">
                            <div class="spinner-ring"></div>
                            <div class="spinner-text">Đang tải dữ liệu...</div>
                        </div>
                    </div>
                `;
            });

            // Xử lý sự kiện click nút đóng
            $('.btn-close-modern, [data-dismiss="modal"]').on('click', function() {
                $('#ordersModal').modal('hide');
            });
        });
    </script>
</body>

</html>
