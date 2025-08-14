<?php
/**
 * Component: Image Uploader
 * Sử dụng: include_once __DIR__ . '/components/imageUploader.php';
 * 
 * @param string $inputName - Tên của input field
 * @param bool $required - Có bắt buộc hay không
 * @param string $label - Label cho upload area
 * @param array $options - Các tùy chọn khác
 */
?>

<div class="form-group">
    <label for="<?= $inputName ?? 'images' ?>"><?= $label ?? 'Hình Ảnh' ?></label>
    <div class="upload-container">
        <div class="upload-area" id="uploadArea_<?= $inputName ?? 'images' ?>">
            <div class="upload-content">
                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                <h5>Kéo thả hình ảnh vào đây hoặc click để chọn</h5>
                <p class="text-muted">Hỗ trợ: JPG, PNG, GIF, WEBP (Tối đa 10MB mỗi file)</p>
                <input type="file" class="form-control" id="<?= $inputName ?? 'images' ?>" 
                       name="<?= $inputName ?? 'images' ?>[]" multiple accept="image/*" 
                       <?= ($required ?? false) ? 'required' : '' ?> style="display: none;">
                <button type="button" class="btn btn-outline-primary mt-2" 
                        onclick="document.getElementById('<?= $inputName ?? 'images' ?>').click()">
                    <i class="fas fa-folder-open"></i> Chọn File
                </button>
            </div>
        </div>
        <div id="preview-container_<?= $inputName ?? 'images' ?>" class="preview-container mt-3"></div>
        <div id="upload-progress_<?= $inputName ?? 'images' ?>" class="upload-progress mt-3" style="display: none;">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%"></div>
            </div>
            <small class="text-muted">Đang xử lý...</small>
        </div>
    </div>
</div>

<style>
.upload-container {
    border: 2px dashed #ddd;
    border-radius: 10px;
    padding: 20px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.upload-area {
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-area:hover {
    background: #e9ecef;
    border-color: #007bff;
}

.upload-area.dragover {
    background: #e3f2fd;
    border-color: #2196f3;
    transform: scale(1.02);
}

.upload-content {
    text-align: center;
}

.preview-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.preview-item:hover {
    transform: scale(1.05);
}

.preview-item img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.preview-item .remove-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255,0,0,0.8);
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preview-item .file-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 5px;
    font-size: 11px;
    text-align: center;
}

.upload-progress {
    margin-top: 15px;
}

.progress {
    height: 8px;
    border-radius: 4px;
}

.file-error {
    border: 2px solid #dc3545 !important;
    background: #f8d7da !important;
}

.file-success {
    border: 2px solid #28a745 !important;
    background: #d4edda !important;
}
</style>

<script>
class ImageUploader {
    constructor(inputName = 'images') {
        this.inputName = inputName;
        this.uploadArea = document.getElementById(`uploadArea_${inputName}`);
        this.fileInput = document.getElementById(inputName);
        this.previewContainer = document.getElementById(`preview-container_${inputName}`);
        this.progressBar = document.querySelector(`#upload-progress_${inputName} .progress-bar`);
        this.progressContainer = document.getElementById(`upload-progress_${inputName}`);
        this.files = [];
        
        this.initializeEventListeners();
    }
    
    initializeEventListeners() {
        // Click để chọn file
        this.uploadArea.addEventListener('click', () => {
            this.fileInput.click();
        });
        
        // Drag and drop events
        this.uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            this.uploadArea.classList.add('dragover');
        });
        
        this.uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            this.uploadArea.classList.remove('dragover');
        });
        
        this.uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            this.uploadArea.classList.remove('dragover');
            const files = Array.from(e.dataTransfer.files);
            this.handleFiles(files);
        });
        
        // File input change
        this.fileInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);
            this.handleFiles(files);
        });
    }
    
    handleFiles(files) {
        files.forEach(file => {
            if (this.validateFile(file)) {
                this.addFile(file);
            }
        });
        this.updateFileInput();
    }
    
    validateFile(file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        const maxSize = 10 * 1024 * 1024; // 10MB
        
        if (!allowedTypes.includes(file.type)) {
            this.showError(`File ${file.name} không phải là hình ảnh hợp lệ`);
            return false;
        }
        
        if (file.size > maxSize) {
            this.showError(`File ${file.name} quá lớn (tối đa 10MB)`);
            return false;
        }
        
        return true;
    }
    
    addFile(file) {
        const fileId = Date.now() + Math.random();
        this.files.push({ id: fileId, file: file });
        
        const reader = new FileReader();
        reader.onload = (e) => {
            this.createPreviewItem(fileId, e.target.result, file);
        };
        reader.readAsDataURL(file);
    }
    
    createPreviewItem(fileId, src, file) {
        const previewItem = document.createElement('div');
        previewItem.className = 'preview-item';
        previewItem.dataset.fileId = fileId;
        
        const size = this.formatFileSize(file.size);
        
        previewItem.innerHTML = `
            <img src="${src}" alt="${file.name}">
            <button class="remove-btn" onclick="uploader_${this.inputName}.removeFile('${fileId}')">
                <i class="fas fa-times"></i>
            </button>
            <div class="file-info">
                ${file.name} (${size})
            </div>
        `;
        
        this.previewContainer.appendChild(previewItem);
    }
    
    removeFile(fileId) {
        this.files = this.files.filter(f => f.id !== fileId);
        const previewItem = document.querySelector(`[data-file-id="${fileId}"]`);
        if (previewItem) {
            previewItem.remove();
        }
        this.updateFileInput();
    }
    
    updateFileInput() {
        // Tạo một DataTransfer object mới
        const dt = new DataTransfer();
        
        // Thêm tất cả files vào DataTransfer
        this.files.forEach(fileObj => {
            dt.items.add(fileObj.file);
        });
        
        // Cập nhật file input
        this.fileInput.files = dt.files;
    }
    
    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    showError(message) {
        // Tạo thông báo lỗi
        const alert = document.createElement('div');
        alert.className = 'alert alert-danger alert-dismissible fade show mt-3';
        alert.innerHTML = `
            ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        `;
        
        this.uploadArea.parentNode.insertBefore(alert, this.uploadArea.nextSibling);
        
        // Tự động ẩn sau 5 giây
        setTimeout(() => {
            alert.remove();
        }, 5000);
    }
    
    showProgress(progress) {
        this.progressContainer.style.display = 'block';
        this.progressBar.style.width = progress + '%';
    }
    
    hideProgress() {
        this.progressContainer.style.display = 'none';
        this.progressBar.style.width = '0%';
    }
    
    getFiles() {
        return this.files;
    }
    
    hasFiles() {
        return this.files.length > 0;
    }
}

// Khởi tạo uploader khi trang load
document.addEventListener('DOMContentLoaded', function() {
    window[`uploader_${<?= json_encode($inputName ?? 'images') ?>}`] = new ImageUploader(<?= json_encode($inputName ?? 'images') ?>);
});
</script> 
