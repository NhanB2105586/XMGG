<?php include_once __DIR__ . '/../partials/headerAdmin.php'; ?>

<body>
    <?php require_once __DIR__ . "/../partials/headingAdmin.php"; require_once __DIR__ . "/../partials/sidebar.php"; ?>

    <div class="container mt-3" id="main-content">
<<<<<<< HEAD
        <h2 class="text-center mb-4 modern-title">Chỉnh Sửa Sản Phẩm</h2>
        <div class="mb-4">
            <a href="/../admin/viewProducts" class="btn btn-elegant">
                <i class="fas fa-arrow-left"></i> Quay lại
=======
        <h2 class="text-center">Chỉnh Sửa Sản Phẩm</h2>
        <div class="mb-3">
            <a href="/../admin/viewProducts" class="btn btn-secondary">
                ← Quay lại
>>>>>>> 7c425505595b6e785662ce5f53f9fbc09bd1405b
            </a>
        </div>

        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger modern-alert auto-hide" role="alert" data-delay="2000">
            <?php foreach ($errors as $error): ?>
            <p><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
            <button type="button" class="close" onclick="this.parentElement.remove()"><span>&times;</span></button>
        </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success modern-alert auto-hide" role="alert" data-delay="2000">
            <p><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_message']); ?></p>
            <button type="button" class="close" onclick="this.parentElement.remove()"><span>&times;</span></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_messages'])): ?>
        <div class="alert alert-danger modern-alert auto-hide" role="alert" data-delay="2000">
            <?php foreach ($_SESSION['error_messages'] as $error): ?>
            <p><i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
            <button type="button" class="close" onclick="this.parentElement.remove()"><span>&times;</span></button>
        </div>
        <?php unset($_SESSION['error_messages']); ?>
        <?php endif; ?>

        <!-- Thông báo hướng dẫn -->
        <div class="alert alert-info modern-alert" role="alert">
            <h6><i class="fas fa-info-circle"></i> Hướng dẫn cập nhật sản phẩm:</h6>
            <ul class="mb-0">
                <li><strong>Thông tin cơ bản:</strong> Điền tất cả thông tin (tên, giá, mô tả) và nhấn "Cập Nhật Sản Phẩm" để lưu tất cả cùng lúc.</li>
                <li><strong>Hình ảnh:</strong> Có thể thêm ảnh mới, xóa ảnh cũ, hoặc chọn ảnh chính trong cùng một lần cập nhật.</li>
                <li><strong>Lưu ý:</strong> Tất cả thay đổi sẽ được lưu khi bạn nhấn nút "Cập Nhật Sản Phẩm" ở cuối trang.</li>
            </ul>
        </div>

        <form action="/admin/editProducts" method="POST" enctype="multipart/form-data" class="modern-form">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <div class="row">
                <div class="col-md-8">
                    <div class="card modern-card">
                        <div class="card-header bg-gradient">
                            <h5><i class="fas fa-edit"></i> Thông Tin Sản Phẩm</h5>
                        </div>
                        <div class="card-body">
            <div class="form-group">
                                <label class="form-label">Danh Mục</label>
                                <select class="form-control modern-select" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_id']) ?>"
                        <?php if (isset($product['category_id']) && $product['category_id'] == $category['category_id']) echo 'selected'; ?>>
                        <?= htmlspecialchars($category['category_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                                <label class="form-label">Tên Sản Phẩm</label>
                                <input type="text" class="form-control modern-input" name="product_name"
                    value="<?php echo htmlspecialchars($old['product_name'] ?? $product['product_name']); ?>" required>
            </div>

                            <div class="row">
                                <div class="col-md-6">
            <div class="form-group">
                                        <label class="form-label">Giá Cũ</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">₫</span></div>
                                            <input type="number" class="form-control modern-input" name="old_price" step="0.01"
                    value="<?php echo htmlspecialchars($old['old_price'] ?? $product['old_price']); ?>" required>
            </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
            <div class="form-group">
                                        <label class="form-label">Giá Mới</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text">₫</span></div>
                                            <input type="number" class="form-control modern-input" name="price" step="0.01"
                    value="<?php echo htmlspecialchars($old['price'] ?? $product['price']); ?>" required>
            </div>
                                    </div>
                                </div>
            </div>

            <div class="form-group">
                                <label class="form-label">Mô Tả</label>
                                <textarea class="form-control modern-textarea" name="description" rows="4" required><?php echo htmlspecialchars($old['description'] ?? $product['description']); ?></textarea>
            </div>

            <div class="form-group">
                                <label class="form-label">Số lượng</label>
                                <input type="number" class="form-control modern-input" name="in_stock"
                                    value="<?php echo htmlspecialchars($old['in_stock'] ?? $product['in_stock']); ?>">
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($product['images'])): ?>
                    <div class="card modern-card mt-4">
                        <div class="card-header bg-gradient">
                            <h5><i class="fas fa-images"></i> Hình Ảnh Hiện Tại</h5>
                        </div>
                        <div class="card-body">
                                                                                    <div class="row">
                                <?php foreach ($product['images'] as $index => $image): ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card current-image-card">
                                        <img src="/images/upload/<?= htmlspecialchars($image['image_url']) ?>" 
                                             class="card-img-top current-image" alt="Hình ảnh sản phẩm">
                                        <div class="card-body text-center p-2">
                                            <div class="image-actions">
                                                                                                 <label class="main-image-label">
                                                     <input type="radio" name="main_image" value="<?= $image['image_id'] ?>" 
                                                            <?= (isset($_SESSION['selected_main_image_url']) && $_SESSION['selected_main_image_url'] === $image['image_url']) || (!isset($_SESSION['selected_main_image_url']) && $index === 0) ? 'checked' : '' ?>>
                                                     <span class="main-image-text">
                                                         <i class="fas fa-star <?= (isset($_SESSION['selected_main_image_url']) && $_SESSION['selected_main_image_url'] === $image['image_url']) || (!isset($_SESSION['selected_main_image_url']) && $index === 0) ? 'text-warning' : 'text-muted' ?>"></i> 
                                                         Ảnh chính
                                                     </span>
                                                 </label>
                                                <label class="delete-label">
                                                    <input type="checkbox" name="delete_images[]" value="<?= $image['image_id'] ?>">
                                                    <span class="delete-text"><i class="fas fa-trash text-danger"></i> Xóa</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
            </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-4">
                    <div class="card modern-card">
                        <div class="card-header bg-gradient">
                            <h5><i class="fas fa-plus"></i> Thêm Hình Ảnh Mới</h5>
                        </div>
                        <div class="card-body">
                            <div class="upload-zone" id="uploadZone">
                        <div class="upload-content">
                                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                    <h6>Kéo thả hình ảnh vào đây</h6>
                                    <p>hoặc click để chọn file</p>
                                    <input type="file" class="file-input" id="images" name="images[]" multiple accept="image/*">
                                    <button type="button" class="btn btn-upload">
                                <i class="fas fa-folder-open"></i> Chọn File
                            </button>
                                    <small>JPG, PNG, GIF, WEBP (Max 10MB)</small>
                        </div>
                    </div>
                            <div id="preview-gallery" class="preview-gallery"></div>
                            <div class="mt-2 text-center">
                                <small class="text-muted">
                                    Đã chọn <span id="upload-count">0</span> ảnh để upload
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary-modern">
                    <i class="fas fa-save"></i> Cập Nhật Sản Phẩm
                </button>
            </div>
        </form>
    </div>
    
    <?php 
    // Xóa session sau khi hiển thị để tránh ảnh hưởng đến lần sau
    if (isset($_SESSION['selected_main_image_url'])) {
        unset($_SESSION['selected_main_image_url']);
    }
    include_once __DIR__ . '/../partials/footAdmin.php'; 
    ?>
    
    <style>
:root {
    --primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --danger: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
    --shadow: 0 8px 30px rgba(0,0,0,0.12);
    --radius: 12px;
}

body { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); font-family: 'Segoe UI', sans-serif; }

.modern-title { color: #2c3e50; font-weight: 300; }
.modern-form { animation: fadeInUp 0.6s ease-out; }
@keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

.modern-card { border-radius: var(--radius); box-shadow: var(--shadow); border: none; background: rgba(255,255,255,0.95); transition: all 0.3s ease; }
.modern-card:hover { transform: translateY(-5px); }

.bg-gradient { background: var(--primary) !important; border-radius: var(--radius) var(--radius) 0 0; padding: 1.5rem; }
.bg-gradient h5 { margin: 0; color: white; }

.form-label { font-weight: 600; color: #2c3e50; margin-bottom: 0.8rem; }
.modern-input, .modern-select, .modern-textarea { border: 2px solid #e1e8ed; border-radius: 10px; padding: 0.75rem 1rem; transition: all 0.3s ease; background: rgba(255,255,255,0.8); }
.modern-input:focus, .modern-select:focus, .modern-textarea:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); background: white; outline: none; }

.input-group-text { background: var(--primary); color: white; border: none; font-weight: 600; }

.btn-elegant { background: var(--primary); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 25px; transition: all 0.3s ease; }
.btn-elegant:hover { transform: translateY(-2px); color: white; }

.btn-primary-modern { background: var(--primary); border: none; border-radius: 25px; padding: 0.8rem 2rem; font-weight: 600; color: white; transition: all 0.3s ease; }
.btn-primary-modern:hover { transform: translateY(-3px); }

.upload-zone { border: 3px dashed #c3cfe2; border-radius: var(--radius); padding: 2rem; text-align: center; transition: all 0.3s ease; background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 100%); }
.upload-zone:hover { border-color: #667eea; transform: scale(1.02); }
.upload-zone.dragover { border-color: #4facfe; background: linear-gradient(135deg, #e8f4fd 0%, #d4f1f4 100%); transform: scale(1.05); }

.upload-icon { font-size: 3rem; color: #667eea; margin-bottom: 1rem; animation: float 3s infinite; }
@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

.file-input { display: none; }
.btn-upload { background: var(--success); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 20px; margin: 1rem 0; }

.preview-gallery { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 1.5rem; }
.preview-item { position: relative; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); animation: slideIn 0.4s ease; }
.preview-item img { width: 100%; height: 280px; object-fit: cover; }
.preview-remove { position: absolute; top: 5px; right: 5px; background: rgba(231,76,60,0.9); color: white; border: none; border-radius: 50%; width: 25px; height: 25px; font-size: 12px; cursor: pointer; transition: all 0.3s ease; }
.preview-remove:hover { background: rgba(231,76,60,1); transform: scale(1.1); }
.preview-info { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); color: white; padding: 5px; font-size: 10px; }
.preview-info small { display: block; line-height: 1.2; }

.current-image-card {
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    border: none;
    background: white;
}

.current-image-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.current-image {
    height: 150px;
    object-fit: cover;
    border-radius: var(--radius) var(--radius) 0 0;
    transition: all 0.3s ease;
}

.current-image-card:hover .current-image {
    transform: scale(1.05);
}

.delete-label {
    margin: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.delete-label:hover {
    transform: scale(1.05);
}

.delete-label input {
    margin-right: 0.5rem;
    transform: scale(1.1);
}

.delete-text {
    color: #495057;
    font-weight: 500;
}

.delete-label:hover .delete-text {
    color: #dc3545;
}

.image-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.main-image-label {
    margin: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    padding: 0.3rem;
    border-radius: 5px;
}

.main-image-label:hover {
    transform: scale(1.05);
    background: rgba(255, 193, 7, 0.1);
}

.main-image-label input {
    margin-right: 0.5rem;
    transform: scale(1.1);
}

.main-image-text {
    color: #495057;
    font-weight: 500;
    transition: all 0.3s ease;
}

.main-image-label:hover .main-image-text {
    color: #ffc107;
}

.main-image-label input:checked + .main-image-text {
    color: #ffc107;
    font-weight: 600;
}

.main-image-label input:checked + .main-image-text i {
    animation: starPulse 1s ease-in-out;
}

@keyframes starPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

@keyframes slideIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

/* CSS cho thông báo tự động tắt */
.modern-alert { 
    border-radius: var(--radius); 
    box-shadow: var(--shadow); 
    border: none; 
    margin-bottom: 1.5rem; 
    position: relative;
    overflow: hidden;
    animation: slideInDown 0.5s ease-out;
}

.modern-alert.alert-success { 
    background: var(--success); 
    color: white; 
}

.modern-alert.alert-danger { 
    background: var(--danger); 
    color: white; 
}

.modern-alert.alert-info { 
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
    color: white; 
}

/* Progress bar cho auto-hide */
.auto-hide::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    background: rgba(255,255,255,0.3);
    animation: progressBar 2s linear;
}

@keyframes progressBar {
    from { width: 100%; }
    to { width: 0%; }
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideOutUp {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}
    </style>
    
    <script>
class ModernUploader {
    constructor() {
        this.zone = document.getElementById('uploadZone');
        this.input = document.getElementById('images');
        this.gallery = document.getElementById('preview-gallery');
        this.files = [];
        this.init();
    }
    
    init() {
        // Chỉ mở dialog khi click vào button, không phải toàn bộ zone
        const uploadButton = document.querySelector('.btn-upload');
        if (uploadButton) {
            uploadButton.onclick = (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.input.click();
            };
        }
        
        this.zone.ondragover = (e) => { e.preventDefault(); this.zone.classList.add('dragover'); };
        this.zone.ondragleave = () => this.zone.classList.remove('dragover');
        this.zone.ondrop = (e) => { 
            e.preventDefault(); 
            this.zone.classList.remove('dragover'); 
            this.handleFiles(Array.from(e.dataTransfer.files)); 
        };
        this.input.onchange = (e) => this.handleFiles(Array.from(e.target.files));
    }
    
    handleFiles(files) {
        files.forEach(file => {
            if (file.type.startsWith('image/') && file.size <= 10*1024*1024) {
                // Kiểm tra xem file đã tồn tại chưa để tránh duplicate
                const isDuplicate = this.files.some(existingFile => 
                    existingFile.file.name === file.name && 
                    existingFile.file.size === file.size &&
                    existingFile.file.lastModified === file.lastModified
                );
                
                if (!isDuplicate) {
                    this.addFile(file);
                }
            }
        });
        this.updateInput();
    }
    
    addFile(file) {
        const id = Date.now() + Math.random();
        this.files.push({id, file});
        
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.dataset.id = id;
            div.innerHTML = `
                <img src="${e.target.result}" alt="${file.name}">
                <button class="preview-remove" onclick="uploader.remove('${id}')" title="Xóa ảnh">×</button>
            `;
            this.gallery.appendChild(div);
        };
        reader.readAsDataURL(file);
    }
    
    remove(id) {
        this.files = this.files.filter(f => f.id != id);
        const element = document.querySelector(`[data-id="${id}"]`);
        if (element) {
            element.remove();
        }
        this.updateInput();
    }
    
    updateInput() {
        const dt = new DataTransfer();
        this.files.forEach(f => dt.items.add(f.file));
        this.input.files = dt.files;
        
        // Cập nhật thông báo số lượng ảnh
        const countElement = document.getElementById('upload-count');
        if (countElement) {
            countElement.textContent = this.files.length;
        }
    }
}

document.addEventListener('DOMContentLoaded', () => { 
    window.uploader = new ModernUploader(); 
    
    // Xử lý chọn ảnh chính
    const mainImageRadios = document.querySelectorAll('input[name="main_image"]');
    mainImageRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Cập nhật trạng thái hiển thị của tất cả ảnh
            mainImageRadios.forEach(r => {
                const label = r.closest('.main-image-label');
                const icon = label.querySelector('.fas.fa-star');
                const text = label.querySelector('.main-image-text');
                
                if (r.checked) {
                    icon.classList.remove('text-muted');
                    icon.classList.add('text-warning');
                    text.style.color = '#ffc107';
                    text.style.fontWeight = '600';
                } else {
                    icon.classList.remove('text-warning');
                    icon.classList.add('text-muted');
                    text.style.color = '#495057';
                    text.style.fontWeight = '500';
                }
            });
        });
    });
    
    // Xử lý thông báo tự động tắt
    const alerts = document.querySelectorAll('.auto-hide');
    alerts.forEach(alert => {
        const delay = parseInt(alert.dataset.delay) || 2000;
        setTimeout(() => {
            alert.style.animation = 'slideOutUp 0.5s ease-out';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, delay);
    });
    

});
    </script>
</body>
</html>
