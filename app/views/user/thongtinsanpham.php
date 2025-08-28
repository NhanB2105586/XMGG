<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylesanpham.css" rel="stylesheet">
<style>
    .product-info-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 35px;
        margin: 25px 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .product-title {
        color: #2c3e50;
        border-bottom: 4px solid #27ae60;
        padding-bottom: 15px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .product-item {
        background: white;
        border-left: 5px solid #27ae60;
        padding: 25px;
        margin: 20px 0;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    
    .product-item:hover {
        transform: translateY(-5px);
    }
    
    .product-item h4 {
        color: #27ae60;
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .feature-list {
        list-style: none;
        padding-left: 0;
    }
    
    .feature-list li {
        padding: 12px 0;
        border-bottom: 1px solid #ecf0f1;
        position: relative;
        padding-left: 30px;
        font-size: 16px;
    }
    
    .feature-list li:before {
        content: "✓";
        color: #27ae60;
        font-weight: bold;
        font-size: 18px;
        position: absolute;
        left: 0;
    }
    
    .product-image {
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }
    
    .product-image:hover {
        transform: scale(1.05);
    }
    
    .spec-table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .spec-table th {
        background: #27ae60;
        color: white;
        padding: 15px;
        font-weight: 600;
    }
    
    .spec-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ecf0f1;
    }
    
    .spec-table tr:nth-child(even) {
        background: #f8f9fa;
    }
    
    .highlight-box {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        color: white;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        margin: 30px 0;
    }
    
    .highlight-box h3 {
        margin-bottom: 15px;
        font-size: 1.8rem;
    }
    
    .application-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin: 30px 0;
    }
    
    .application-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }
    
    .application-card:hover {
        transform: translateY(-8px);
    }
    
    .application-card img {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
        border-radius: 50%;
        background: #f8f9fa;
        padding: 15px;
    }
    
    .timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 3px;
        background: #27ae60;
        transform: translateX(-50%);
    }
    
    .timeline-item {
        position: relative;
        margin: 30px 0;
        width: 45%;
    }
    
    .timeline-item:nth-child(odd) {
        left: 0;
        text-align: right;
        padding-right: 30px;
    }
    
    .timeline-item:nth-child(even) {
        left: 55%;
        text-align: left;
        padding-left: 30px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        top: 20px;
        width: 15px;
        height: 15px;
        background: #27ae60;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px #27ae60;
    }
    
    .timeline-item:nth-child(odd)::before {
        right: -37px;
    }
    
    .timeline-item:nth-child(even)::before {
        left: -37px;
    }
</style>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container-fluid main-content mt-3">

        <!-- Phần hình ảnh trên cùng -->
        <div class="top-banner-sp">
            <div class="banner-text">
                Thông tin sản phẩm xi măng giả gỗ
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/khac">Thông tin & Hỗ trợ</a>&nbsp;/&nbsp;<strong class="current-page">Thông tin sản phẩm</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Nội dung thông tin sản phẩm -->
    <div class="container mb-5 mt-4">
        <div class="title text-center py-3">
            <h1 class="position-relative d-inline-block product-title">🌳 THÔNG TIN SẢN PHẨM XI MĂNG GIẢ GỖ</h1>
        </div>
        
        <div class="text-center mb-4">
            <p class="lead">Khám phá công nghệ tiên tiến và chất lượng vượt trội của sản phẩm xi măng giả gỗ - Giải pháp hoàn hảo cho không gian sống hiện đại</p>
        </div>

        <!-- Giới thiệu tổng quan -->
        <div class="product-info-section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-item">
                        <h4><strong>🏭 Tổng quan về xi măng giả gỗ</strong></h4>
                        <p>Xi măng giả gỗ là sản phẩm công nghệ cao được sản xuất từ xi măng Portland kết hợp với các phụ gia đặc biệt, tạo ra bề mặt có vân gỗ tự nhiên với độ bền vượt trội so với gỗ thật.</p>
                        
                        <ul class="feature-list">
                            <li>Chất liệu xi măng Portland cao cấp</li>
                            <li>Công nghệ ép vân gỗ tự nhiên</li>
                            <li>Khả năng chống ẩm, chống mối mọt</li>
                            <li>Độ bền cao, tuổi thọ lâu dài</li>
                            <li>Thân thiện với môi trường</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="/images/khac/Thi công ốp vách trên tường xi măng.png" alt="Xi măng giả gỗ" class="img-fluid product-image">
                </div>
            </div>
        </div>

        <!-- Đặc tính kỹ thuật -->
        <div class="product-info-section">
            <div class="product-item">
                <h4><strong>⚙️ Đặc tính kỹ thuật</strong></h4>
                
                <div class="spec-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Thông số</th>
                                <th>Giá trị</th>
                                <th>Đơn vị</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Độ dày</strong></td>
                                <td>8 - 25</td>
                                <td>mm</td>
                            </tr>
                            <tr>
                                <td><strong>Khối lượng riêng</strong></td>
                                <td>1.8 - 2.2</td>
                                <td>g/cm³</td>
                            </tr>
                            <tr>
                                <td><strong>Độ bền uốn</strong></td>
                                <td>≥ 15</td>
                                <td>MPa</td>
                            </tr>
                            <tr>
                                <td><strong>Độ bền nén</strong></td>
                                <td>≥ 25</td>
                                <td>MPa</td>
                            </tr>
                            <tr>
                                <td><strong>Độ hút nước</strong></td>
                                <td>≤ 8</td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td><strong>Độ chống cháy</strong></td>
                                <td>A1</td>
                                <td>Class</td>
                            </tr>
                            <tr>
                                <td><strong>Tuổi thọ</strong></td>
                                <td>20 - 30</td>
                                <td>năm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Ứng dụng đa dạng -->
        <div class="product-info-section">
            <h3 class="text-center mb-4"><strong>🏠 Ứng dụng đa dạng</strong></h3>
            
            <div class="application-grid">
                <div class="application-card">
                    <img src="/images/khac/Thi công ốp vách trên tường xi măng.png" alt="Ốp tường">
                    <h5><strong>Ốp tường nội thất</strong></h5>
                    <p>Trang trí tường phòng khách, phòng ngủ, văn phòng với vân gỗ tự nhiên, tạo không gian ấm cúng và sang trọng.</p>
                </div>
                
                <div class="application-card">
                    <img src="/images/khac/Thi công ốp trần trên khung sắt.png" alt="Ốp trần">
                    <h5><strong>Ốp trần nhà</strong></h5>
                    <p>Làm trần giả với khả năng chống ẩm tốt, phù hợp cho phòng tắm, nhà bếp và các khu vực ẩm ướt.</p>
                </div>
                
                <div class="application-card">
                    <img src="/images/khac/Thi công lót sàn trên nền xi măng.png" alt="Lót sàn">
                    <h5><strong>Lót sàn</strong></h5>
                    <p>Sàn xi măng giả gỗ với độ bền cao, chống trượt, phù hợp cho sân vườn, ban công, lối đi.</p>
                </div>
                
                <div class="application-card">
                    <img src="/images/khac/Thi công ốp vách trên khung sắt.png" alt="Vách ngăn">
                    <h5><strong>Vách ngăn</strong></h5>
                    <p>Tạo vách ngăn phòng với thiết kế linh hoạt, dễ dàng tháo lắp và di chuyển khi cần thiết.</p>
                </div>
            </div>
        </div>

        <!-- Lịch sử phát triển -->
        <div class="product-info-section">
            <h3 class="text-center mb-4"><strong>📈 Lịch sử phát triển</strong></h3>
            
            <div class="timeline">
                <div class="timeline-item">
                    <h5><strong>1990s</strong></h5>
                    <p>Khởi đầu với công nghệ ép vân gỗ cơ bản trên bề mặt xi măng</p>
                </div>
                
                <div class="timeline-item">
                    <h5><strong>2000s</strong></h5>
                    <p>Phát triển công nghệ ép vân 3D và cải thiện độ bền</p>
                </div>
                
                <div class="timeline-item">
                    <h5><strong>2010s</strong></h5>
                    <p>Ứng dụng công nghệ nano và phụ gia chống ẩm tiên tiến</p>
                </div>
                
                <div class="timeline-item">
                    <h5><strong>2020s</strong></h5>
                    <p>Công nghệ 4.0 với máy móc tự động hóa và kiểm soát chất lượng AI</p>
                </div>
            </div>
        </div>

        <!-- So sánh với gỗ tự nhiên -->
        <div class="product-info-section">
            <div class="product-item">
                <h4><strong>🔄 So sánh với gỗ tự nhiên</strong></h4>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-success">✅ Ưu điểm vượt trội</h5>
                        <ul class="feature-list">
                            <li>Chống ẩm, chống mối mọt 100%</li>
                            <li>Độ bền cao, không cong vênh</li>
                            <li>Giá thành hợp lý hơn</li>
                            <li>Dễ bảo trì và vệ sinh</li>
                            <li>Thân thiện môi trường</li>
                            <li>Đa dạng mẫu mã và màu sắc</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-warning">⚠️ Hạn chế</h5>
                        <ul class="feature-list">
                            <li>Không có mùi hương tự nhiên</li>
                            <li>Trọng lượng nặng hơn</li>
                            <li>Cần kỹ thuật thi công chuyên nghiệp</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cam kết chất lượng -->
        <div class="highlight-box">
            <h3>🏆 CAM KẾT CHẤT LƯỢNG</h3>
            <p class="mb-0">Sản phẩm xi măng giả gỗ của chúng tôi được sản xuất theo tiêu chuẩn ISO 9001:2015, đảm bảo chất lượng vượt trội và tuổi thọ lâu dài cho mọi công trình.</p>
        </div>

        <div class="text-center mt-4">
            <p class="lead">✨ Chất lượng tạo nên sự khác biệt!</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

</body>
