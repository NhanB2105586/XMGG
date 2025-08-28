<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylesanpham.css" rel="stylesheet">
<style>
    .construction-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 35px;
        margin: 25px 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .construction-title {
        color: #2c3e50;
        border-bottom: 4px solid #e67e22;
        padding-bottom: 15px;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .construction-item {
        background: white;
        border-left: 5px solid #e67e22;
        padding: 25px;
        margin: 20px 0;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    
    .construction-item:hover {
        transform: translateY(-5px);
    }
    
    .construction-item h4 {
        color: #e67e22;
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .step-list {
        list-style: none;
        padding-left: 0;
    }
    
    .step-list li {
        padding: 15px 0;
        border-bottom: 1px solid #ecf0f1;
        position: relative;
        padding-left: 40px;
        font-size: 16px;
        counter-increment: step-counter;
    }
    
    .step-list li:before {
        content: counter(step-counter);
        color: white;
        background: #e67e22;
        font-weight: bold;
        font-size: 16px;
        position: absolute;
        left: 0;
        top: 15px;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .construction-image {
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
        margin: 20px 0;
    }
    
    .construction-image:hover {
        transform: scale(1.03);
    }
    
    .video-container {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        margin: 10px 0;
        background: #000;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        max-width: 100%;
        height: 200px;
    }
    
    .video-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    
    .video-container video {
        width: 100%;
        height: 200px;
        border-radius: 10px;
        display: block;
        transition: transform 0.3s ease;
        object-fit: contain;
    }
    
    .video-container:hover video {
        transform: scale(1.005);
    }
    
    /* Đảm bảo video hiển thị đầy đủ khi fullscreen */
    .video-container video:fullscreen {
        object-fit: contain;
        width: 100vw;
        height: 100vh;
        border-radius: 0;
    }
    
    .video-container video:-webkit-full-screen {
        object-fit: contain;
        width: 100vw;
        height: 100vh;
        border-radius: 0;
    }
    
    .video-container video:-moz-full-screen {
        object-fit: contain;
        width: 100vw;
        height: 100vh;
        border-radius: 0;
    }
    
    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .video-container:hover .video-overlay {
        opacity: 1;
    }
    
    .play-button {
        width: 80px;
        height: 80px;
        background: rgba(230, 126, 34, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .play-button:hover {
        background: #e67e22;
        transform: scale(1.1);
    }
    
    .highlight-box {
        background: linear-gradient(135deg, #e67e22, #f39c12);
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
    
    .process-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        margin: 30px 0;
    }
    
    .process-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.3s ease;
        border-top: 5px solid #e67e22;
    }
    
    .process-card:hover {
        transform: translateY(-10px);
    }
    
    .process-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    .process-card h5 {
        color: #e67e22;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .safety-section {
        background: #fff3cd;
        border: 2px solid #ffeaa7;
        border-radius: 12px;
        padding: 25px;
        margin: 30px 0;
    }
    
    .safety-section h4 {
        color: #856404;
        margin-bottom: 20px;
    }
    
    .safety-list {
        list-style: none;
        padding-left: 0;
    }
    
    .safety-list li {
        padding: 10px 0;
        border-bottom: 1px solid #ffeaa7;
        position: relative;
        padding-left: 30px;
    }
    
    .safety-list li:before {
        content: "⚠️";
        position: absolute;
        left: 0;
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
        width: 4px;
        background: #e67e22;
        transform: translateX(-50%);
    }
    
    .timeline-item {
        position: relative;
        margin: 40px 0;
        width: 45%;
    }
    
    .timeline-item:nth-child(odd) {
        left: 0;
        text-align: right;
        padding-right: 40px;
    }
    
    .timeline-item:nth-child(even) {
        left: 55%;
        text-align: left;
        padding-left: 40px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        top: 20px;
        width: 20px;
        height: 20px;
        background: #e67e22;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 0 0 4px #e67e22;
    }
    
    .timeline-item:nth-child(odd)::before {
        right: -52px;
    }
    
    .timeline-item:nth-child(even)::before {
        left: -52px;
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
                Quy trình thi công chuyên nghiệp
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/khac">Thông tin & Hỗ trợ</a>&nbsp;/&nbsp;<strong class="current-page">Quy trình thi công</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Nội dung quy trình thi công -->
    <div class="container mb-5 mt-4">
        <div class="title text-center py-3">
            <h1 class="position-relative d-inline-block construction-title">🔨 QUY TRÌNH THI CÔNG CHUYÊN NGHIỆP</h1>
        </div>
        
        <div class="text-center mb-4">
            <p class="lead">Khám phá quy trình thi công xi măng giả gỗ từ chuẩn bị bề mặt đến hoàn thiện - Đảm bảo chất lượng và thẩm mỹ tối ưu cho mọi công trình</p>
        </div>

        <!-- Quy trình tổng quan -->
        <div class="construction-section">
            <div class="construction-item">
                <h4><strong>📋 Quy trình thi công tổng quan</strong></h4>
                <p>Quy trình thi công xi măng giả gỗ được thực hiện theo 6 bước chính, đảm bảo chất lượng và độ bền của sản phẩm:</p>
                
                <ol class="step-list" style="counter-reset: step-counter;">
                    <li><strong>Chuẩn bị bề mặt:</strong> Làm sạch, san phẳng và xử lý bề mặt thi công</li>
                    <li><strong>Đo đạc và cắt:</strong> Đo kích thước chính xác và cắt tấm theo yêu cầu</li>
                    <li><strong>Chuẩn bị keo:</strong> Pha trộn keo dán chuyên dụng theo tỷ lệ chuẩn</li>
                    <li><strong>Thi công lắp đặt:</strong> Dán và cố định tấm lên bề mặt</li>
                    <li><strong>Xử lý mối nối:</strong> Làm phẳng và xử lý các khe hở</li>
                    <li><strong>Hoàn thiện:</strong> Vệ sinh và kiểm tra chất lượng cuối cùng</li>
                </ol>
            </div>
        </div>

        <!-- Video thi công -->
        <div class="construction-section">
            <h3 class="text-center mb-4"><strong>🎥 Video hướng dẫn thi công</strong></h3>
            
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="video-container">
                        <video controls>
                            <source src="/images/khac/Video thi công ốp trần trên khung sắt.mp4" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ video.
                        </video>
                    </div>
                    <h6 class="text-center mt-2 text-primary"><strong>🔨 Thi công ốp trần trên khung sắt</strong></h6>
                    <p class="text-center text-muted small">Video hướng dẫn chi tiết quy trình thi công ốp trần</p>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="video-container">
                        <video controls>
                            <source src="/images/khac/Video thi công làm lam xi măng giả gỗ.mp4" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ video.
                        </video>
                    </div>
                    <h6 class="text-center mt-2 text-primary"><strong>🏗️ Thi công làm lam xi măng giả gỗ</strong></h6>
                    <p class="text-center text-muted small">Video hướng dẫn chi tiết quy trình thi công lam</p>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="video-container">
                        <video controls>
                            <source src="/images/khac/Video thi công ốp trần trên nền xi măng.mp4" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ video.
                        </video>
                    </div>
                    <h6 class="text-center mt-2 text-primary"><strong>🏠 Thi công ốp trần trên nền xi măng</strong></h6>
                    <p class="text-center text-muted small">Video hướng dẫn thi công trên bề mặt xi măng</p>
                </div>
            </div>
        </div>

        <!-- Chi tiết từng bước -->
        <div class="construction-section">
            <h3 class="text-center mb-4"><strong>🔧 Chi tiết từng bước thi công</strong></h3>
            
            <div class="process-grid">
                <div class="process-card">
                    <img src="/images/khac/Thi công ốp vách trên tường xi măng.png" alt="Chuẩn bị bề mặt">
                    <h5>1. Chuẩn bị bề mặt</h5>
                    <p>Làm sạch bề mặt, loại bỏ bụi bẩn, dầu mỡ. San phẳng bề mặt gồ ghề. Xử lý chống ẩm nếu cần thiết.</p>
                    <ul class="text-start">
                        <li>Làm sạch bề mặt</li>
                        <li>San phẳng gồ ghề</li>
                        <li>Xử lý chống ẩm</li>
                    </ul>
                </div>
                
                <div class="process-card">
                    <img src="/images/khac/Thi công ốp trần trên khung sắt.png" alt="Đo đạc và cắt">
                    <h5>2. Đo đạc và cắt</h5>
                    <p>Đo kích thước chính xác của khu vực thi công. Cắt tấm xi măng giả gỗ theo kích thước đã đo.</p>
                    <ul class="text-start">
                        <li>Đo kích thước chính xác</li>
                        <li>Cắt tấm theo yêu cầu</li>
                        <li>Kiểm tra độ khớp</li>
                    </ul>
                </div>
                
                <div class="process-card">
                    <img src="/images/khac/Thi công lót sàn trên nền xi măng.png" alt="Chuẩn bị keo">
                    <h5>3. Chuẩn bị keo</h5>
                    <p>Pha trộn keo dán chuyên dụng theo tỷ lệ chuẩn. Đảm bảo keo có độ dính và độ bền cao.</p>
                    <ul class="text-start">
                        <li>Pha trộn keo chuyên dụng</li>
                        <li>Đảm bảo tỷ lệ chuẩn</li>
                        <li>Kiểm tra độ dính</li>
                    </ul>
                </div>
                
                <div class="process-card">
                    <img src="/images/khac/Thi công ốp vách trên khung sắt.png" alt="Lắp đặt">
                    <h5>4. Thi công lắp đặt</h5>
                    <p>Dán và cố định tấm lên bề mặt. Đảm bảo các tấm được lắp đặt chính xác và đều đặn.</p>
                    <ul class="text-start">
                        <li>Dán tấm lên bề mặt</li>
                        <li>Cố định chắc chắn</li>
                        <li>Kiểm tra độ phẳng</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Các phương pháp thi công -->
        <div class="construction-section">
            <h3 class="text-center mb-4"><strong>🏗️ Các phương pháp thi công</strong></h3>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="construction-item">
                        <h4><strong>Thi công trên tường xi măng</strong></h4>
                        <img src="/images/khac/Thi công ốp vách trên tường xi măng.png" alt="Thi công trên tường xi măng" class="img-fluid construction-image">
                        <p><strong>Ưu điểm:</strong></p>
                        <ul>
                            <li>Bề mặt ổn định, độ bám dính cao</li>
                            <li>Dễ dàng thi công và bảo trì</li>
                            <li>Chi phí thấp hơn</li>
                        </ul>
                        <p><strong>Ứng dụng:</strong> Tường nội thất, vách ngăn cố định</p>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="construction-item">
                        <h4><strong>Thi công trên khung sắt</strong></h4>
                        <img src="/images/khac/Thi công ốp vách trên khung sắt.png" alt="Thi công trên khung sắt" class="img-fluid construction-image">
                        <p><strong>Ưu điểm:</strong></p>
                        <ul>
                            <li>Linh hoạt trong thiết kế</li>
                            <li>Dễ dàng tháo lắp</li>
                            <li>Tạo khoảng trống cách nhiệt</li>
                        </ul>
                        <p><strong>Ứng dụng:</strong> Vách ngăn di động, trần giả</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thời gian thi công -->
        <div class="construction-section">
            <h3 class="text-center mb-4"><strong>⏱️ Thời gian thi công</strong></h3>
            
            <div class="timeline">
                <div class="timeline-item">
                    <h5><strong>Chuẩn bị</strong></h5>
                    <p>1-2 ngày: Chuẩn bị bề mặt, đo đạc, cắt tấm</p>
                </div>
                
                <div class="timeline-item">
                    <h5><strong>Thi công chính</strong></h5>
                    <p>3-5 ngày: Lắp đặt tấm, xử lý mối nối</p>
                </div>
                
                <div class="timeline-item">
                    <h5><strong>Hoàn thiện</strong></h5>
                    <p>1-2 ngày: Vệ sinh, kiểm tra chất lượng</p>
                </div>
                
                <div class="timeline-item">
                    <h5><strong>Tổng thời gian</strong></h5>
                    <p>5-9 ngày cho công trình trung bình</p>
                </div>
            </div>
        </div>

        <!-- Lưu ý an toàn -->
        <div class="safety-section">
            <h4><strong>⚠️ Lưu ý an toàn khi thi công</strong></h4>
            <ul class="safety-list">
                <li>Đeo đầy đủ đồ bảo hộ: găng tay, kính mắt, khẩu trang</li>
                <li>Đảm bảo thông gió tốt trong khu vực thi công</li>
                <li>Sử dụng dụng cụ cắt chuyên dụng, tránh bụi</li>
                <li>Kiểm tra độ ổn định của giàn giáo trước khi thi công</li>
                <li>Không thi công trong điều kiện thời tiết xấu</li>
                <li>Tuân thủ các quy định an toàn lao động</li>
            </ul>
        </div>

        <!-- Cam kết chất lượng -->
        <div class="highlight-box">
            <h3>🏆 CAM KẾT THI CÔNG</h3>
            <p class="mb-0">Đội ngũ thợ thi công chuyên nghiệp với kinh nghiệm 10+ năm, đảm bảo chất lượng thi công và thời gian hoàn thành đúng tiến độ cho mọi công trình.</p>
        </div>

        <div class="text-center mt-4">
            <p class="lead">✨ Chất lượng thi công tạo nên sự hoàn hảo!</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

</body>
