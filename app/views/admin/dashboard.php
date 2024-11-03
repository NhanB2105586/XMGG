<?php
include_once __DIR__ . '/../partials/headerAdmin.php';
?>

<body>
    <?php
    require_once __DIR__ . "/../partials/headingAdmin.php";
    require_once __DIR__ . "/../partials/sidebar.php";
    ?>

    <div id="main-content" class="container allContent-section py-4">
        <div class="row text-center">
            <div class="col-sm-3">
                <div class="card" style="background-color: #007bff; color: white;">
                    <i class="fa fa-users mb-2" style="font-size: 70px;"></i>
                    <h4>Số lượng người dùng</h4>
                    <h5><?php echo htmlspecialchars($userCount); ?></h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card" style="background-color: #28a745; color: white;">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4>Số lượng đơn hàng</h4>
                    <h5><?php echo htmlspecialchars($orderCount); ?></h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card" style="background-color: #17a2b8; color: white;">
                    <i class="fa fa-check mb-2" style="font-size: 70px;"></i>
                    <h4>Số lượng đơn hàng thành công</h4>
                    <h5><?php echo htmlspecialchars($successfulOrders); ?></h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card" style="background-color: #dc3545; color: white;">
                    <i class="fa fa-dollar-sign mb-2" style="font-size: 70px;"></i>
                    <h4>Doanh thu</h4>
                    <h5><?php echo number_format($revenue, 0, ',', '.') . ' VNĐ'; ?></h5>
                </div>
            </div>
        </div>
    </div>

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

    <?php
    include_once __DIR__ . '/../partials/footAdmin.php';
    ?>
</body>

</html>