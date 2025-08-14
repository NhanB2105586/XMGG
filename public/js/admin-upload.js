/**
 * Admin Upload Component JavaScript
 * Hỗ trợ drag & drop, preview, validation cho upload hình ảnh
 */

class AdminImageUploader {
    constructor(inputName = 'images', options = {}) {
        this.inputName = inputName;
        this.options = {
            maxSize: 10 * 1024 * 1024, // 10MB
            allowedTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
            maxFiles: options.maxFiles || 10,
            required: options.required || false,
            ...options
        };
        
        this.uploadArea = document.getElementById(`uploadArea_${inputName}`);
        this.fileInput = document.getElementById(inputName);
        this.previewContainer = document.getElementById(`preview-container_${inputName}`);
        this.progressBar = document.querySelector(`#upload-progress_${inputName} .progress-bar`);
        this.progressContainer = document.getElementById(`upload-progress_${inputName}`);
        this.files = [];
        
        this.initializeEventListeners();
    }
    
    initializeEventListeners() {
        if (!this.uploadArea || !this.fileInput) {
            console.error('Upload elements not found');
            return;
        }
        
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
        
        // Form validation
        const form = this.fileInput.closest('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                if (this.options.required && this.files.length === 0) {
                    e.preventDefault();
                    this.showError('Vui lòng chọn ít nhất một hình ảnh');
                    return false;
                }
            });
        }
    }
    
    handleFiles(files) {
        if (this.files.length + files.length > this.options.maxFiles) {
            this.showError(`Chỉ được upload tối đa ${this.options.maxFiles} file`);
            return;
        }
        
        files.forEach(file => {
            if (this.validateFile(file)) {
                this.addFile(file);
            }
        });
        this.updateFileInput();
    }
    
    validateFile(file) {
        if (!this.options.allowedTypes.includes(file.type)) {
            this.showError(`File ${file.name} không phải là hình ảnh hợp lệ`);
            return false;
        }
        
        if (file.size > this.options.maxSize) {
            this.showError(`File ${file.name} quá lớn (tối đa ${this.formatFileSize(this.options.maxSize)})`);
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
        const fileType = file.type.split('/')[1].toUpperCase();
        
        previewItem.innerHTML = `
            <img src="${src}" alt="${file.name}" loading="lazy">
            <button class="remove-btn" onclick="uploader_${this.inputName}.removeFile('${fileId}')" title="Xóa">
                <i class="fas fa-times"></i>
            </button>
            <div class="file-type-indicator">${fileType}</div>
            <div class="file-info">
                ${file.name} (${size})
            </div>
        `;
        
        this.previewContainer.appendChild(previewItem);
        
        // Animation
        previewItem.style.opacity = '0';
        previewItem.style.transform = 'scale(0.8)';
        setTimeout(() => {
            previewItem.style.transition = 'all 0.3s ease';
            previewItem.style.opacity = '1';
            previewItem.style.transform = 'scale(1)';
        }, 10);
    }
    
    removeFile(fileId) {
        this.files = this.files.filter(f => f.id !== fileId);
        const previewItem = document.querySelector(`[data-file-id="${fileId}"]`);
        if (previewItem) {
            previewItem.style.transition = 'all 0.3s ease';
            previewItem.style.opacity = '0';
            previewItem.style.transform = 'scale(0.8)';
            setTimeout(() => {
                previewItem.remove();
            }, 300);
        }
        this.updateFileInput();
    }
    
    updateFileInput() {
        const dt = new DataTransfer();
        this.files.forEach(fileObj => {
            dt.items.add(fileObj.file);
        });
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
        // Remove existing alerts
        const existingAlerts = this.uploadArea.parentNode.querySelectorAll('.alert');
        existingAlerts.forEach(alert => alert.remove());
        
        const alert = document.createElement('div');
        alert.className = 'alert alert-danger alert-dismissible fade show mt-3';
        alert.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        this.uploadArea.parentNode.insertBefore(alert, this.uploadArea.nextSibling);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 5000);
    }
    
    showSuccess(message) {
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show mt-3';
        alert.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        this.uploadArea.parentNode.insertBefore(alert, this.uploadArea.nextSibling);
        
        setTimeout(() => {
            if (alert.parentNode) {
                alert.remove();
            }
        }, 3000);
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
    
    clearFiles() {
        this.files = [];
        this.previewContainer.innerHTML = '';
        this.updateFileInput();
    }
    
    // Upload files via AJAX (optional)
    async uploadFiles(url, additionalData = {}) {
        if (this.files.length === 0) {
            this.showError('Không có file nào để upload');
            return false;
        }
        
        const formData = new FormData();
        this.files.forEach((fileObj, index) => {
            formData.append(`files[${index}]`, fileObj.file);
        });
        
        // Add additional data
        Object.keys(additionalData).forEach(key => {
            formData.append(key, additionalData[key]);
        });
        
        try {
            this.showProgress(0);
            
            const response = await fetch(url, {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                this.showSuccess('Upload thành công!');
                this.hideProgress();
                return result;
            } else {
                this.showError(result.message || 'Upload thất bại');
                this.hideProgress();
                return false;
            }
        } catch (error) {
            this.showError('Lỗi kết nối: ' + error.message);
            this.hideProgress();
            return false;
        }
    }
}

// Global uploader instances
window.AdminUploaders = {};

// Initialize uploader when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Auto-initialize uploaders with data-uploader attribute
    const uploadInputs = document.querySelectorAll('input[data-uploader]');
    uploadInputs.forEach(input => {
        const inputName = input.name.replace('[]', '');
        const options = {
            required: input.hasAttribute('required'),
            maxFiles: input.dataset.maxFiles ? parseInt(input.dataset.maxFiles) : 10
        };
        
        window.AdminUploaders[inputName] = new AdminImageUploader(inputName, options);
    });
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = AdminImageUploader;
} 