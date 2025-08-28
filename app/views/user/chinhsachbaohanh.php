<?php
include_once __DIR__ . '/../partials/header.php';
?>

<link href="/css/stylesanpham.css" rel="stylesheet">
<style>
    .warranty-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 30px;
        margin: 20px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .warranty-title {
        color: #2c3e50;
        border-bottom: 3px solid #3498db;
        padding-bottom: 10px;
        margin-bottom: 25px;
    }
    
    .warranty-item {
        background: white;
        border-left: 4px solid #3498db;
        padding: 20px;
        margin: 15px 0;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .warranty-item h4 {
        color: #2c3e50;
        margin-bottom: 15px;
    }
    
    .warranty-list {
        list-style: none;
        padding-left: 0;
    }
    
    .warranty-list li {
        padding: 8px 0;
        border-bottom: 1px solid #ecf0f1;
        position: relative;
        padding-left: 25px;
    }
    
    .warranty-list li:before {
        content: "✓";
        color: #27ae60;
        font-weight: bold;
        position: absolute;
        left: 0;
    }
    
    .warranty-list li.excluded:before {
        content: "✗";
        color: #e74c3c;
    }
    
    .contact-info {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        margin: 30px 0;
    }
    
    .contact-info h3 {
        margin-bottom: 20px;
        font-size: 1.8rem;
    }
    
    .contact-details {
        background: rgba(255,255,255,0.1);
        padding: 20px;
        border-radius: 8px;
        margin: 15px 0;
    }
    
    .highlight-box {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
    }
    
    .highlight-box h5 {
        color: #856404;
        margin-bottom: 10px;
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
                Chính sách bảo hành - Bảo trì
                <div class="breadcrumb">
                    <a href="/">Trang chủ</a>&nbsp;/&nbsp;<a href="/khac">Thông tin & Hỗ trợ</a>&nbsp;/&nbsp;<strong class="current-page">Chính sách bảo hành</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Nội dung chính sách bảo hành -->
    <div class="container mb-5 mt-4">
        <div class="title text-center py-3">
            <h1 class="position-relative d-inline-block warranty-title">🌟 CHÍNH SÁCH BẢO HÀNH – BẢO TRÌ</h1>
        </div>
        
        <div class="text-center mb-4">
            <p class="lead">Trong quá trình sử dụng, nếu gặp bất kỳ trục trặc kỹ thuật nào, Quý khách hàng có thể liên hệ trực tiếp với chúng tôi để được hỗ trợ.</p>
        </div>

        <!-- Trường hợp được bảo hành -->
        <div class="warranty-section">
            <div class="warranty-item">
                <h4><strong>1. Trường hợp được bảo hành</strong></h4>
                <p>Bảo hành sản phẩm là việc khắc phục những lỗi hỏng hóc, sự cố kỹ thuật xảy ra do lỗi của nhà sản xuất.</p>
                
                <ul class="warranty-list">
                    <li>Sản phẩm còn trong thời hạn bảo hành tính từ ngày giao hàng hoặc ngày ghi trên phiếu bảo hành.</li>
                    <li>Có Phiếu bảo hành của nhà sản xuất hoặc nhà phân phối.</li>
                    <li>Có Hóa đơn mua hàng của Công ty TNHH Giải Pháp Xây Dựng và Thương Mại Đại Quân.</li>
                    <li>Việc bảo hành tuân thủ theo quy định riêng của từng nhà sản xuất đối với các sự cố kỹ thuật.</li>
                </ul>
            </div>
        </div>

        <!-- Trường hợp không được bảo hành -->
        <div class="warranty-section">
            <div class="warranty-item">
                <h4><strong>2. Trường hợp không được bảo hành</strong></h4>
                
                <ul class="warranty-list">
                    <li class="excluded">Sản phẩm quá thời hạn bảo hành hoặc mất Phiếu bảo hành.</li>
                    <li class="excluded">Không xác định được nguồn gốc mua tại Công ty.</li>
                    <li class="excluded">Mất hóa đơn.</li>
                    <li class="excluded">Tem bảo hành bị rách, vỡ, hoặc sửa đổi.</li>
                    <li class="excluded">Phiếu bảo hành không ghi rõ số Serial hoặc ngày mua hàng.</li>
                    <li class="excluded">Serial trên sản phẩm và phiếu bảo hành không trùng khớp.</li>
                    <li class="excluded">Sản phẩm hư hỏng do sử dụng sai hướng dẫn.</li>
                    <li class="excluded">Sản phẩm hư hỏng do rơi, vỡ, va đập, trầy xước, ẩm ướt, hoen rỉ, chảy nước.</li>
                    <li class="excluded">Sản phẩm bị hư hỏng do chuột bọ, côn trùng, hỏa hoạn, thiên tai.</li>
                    <li class="excluded">Tự ý tháo dỡ, sửa chữa bởi cá nhân hoặc kỹ thuật viên không được ủy quyền.</li>
                </ul>
                
                <div class="highlight-box">
                    <h5>💡 Lưu ý quan trọng:</h5>
                    <p class="mb-0">Những sản phẩm mua tại Công ty nhưng hết thời hạn bảo hành vẫn sẽ được hỗ trợ sửa chữa tính phí.</p>
                </div>
            </div>
        </div>

        <!-- Bảo trì - bảo dưỡng -->
        <div class="warranty-section">
            <div class="warranty-item">
                <h4><strong>3. Bảo trì – bảo dưỡng</strong></h4>
                <p>Bao gồm: bảo dưỡng định kỳ, kiểm tra, vệ sinh, sửa chữa hỏng hóc nhỏ (không bao gồm thay thế thiết bị).</p>
                <p><strong>Thời gian và chi phí bảo trì được thỏa thuận trực tiếp giữa khách hàng và Công ty.</strong></p>
            </div>
        </div>

        <!-- Địa điểm bảo hành -->
        <div class="warranty-section">
            <div class="warranty-item">
                <h4><strong>4. Địa điểm bảo hành – bảo trì</strong></h4>
                <ul class="warranty-list">
                    <li>Nếu hợp đồng, biên bản bàn giao hoặc phiếu bảo hành không ghi rõ địa điểm, sản phẩm sẽ được bảo hành tại trung tâm bảo hành của Hãng.</li>
                    <li>Nhân viên Công ty có thể hướng dẫn hoặc thay mặt khách hàng liên hệ với Hãng, mang sản phẩm đến trung tâm bảo hành để được xử lý.</li>
                </ul>
            </div>
        </div>

        <!-- Thông tin liên hệ -->
        <div class="contact-info">
            <h3>📞 THÔNG TIN LIÊN HỆ</h3>
            <h4><strong>CÔNG TY TNHH GIẢI PHÁP XÂY DỰNG VÀ THƯƠNG MẠI ĐAI QUÂN</strong></h4>
            
            <div class="contact-details">
                <h5>🏢 Showroom Cần Thơ:</h5>
                <p class="mb-2">I6-8 Cao Minh Lộc, Phường Hưng Phú, TP. Cần Thơ, Việt Nam</p>
                
                <h5>📱 Hotline:</h5>
                <p class="mb-0"><strong>093 949 64 69</strong></p>
            </div>
        </div>

        <div class="text-center mt-4">
            <p class="lead">✨ Trân trọng kính gửi đến Quý khách hàng!</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

</body>
