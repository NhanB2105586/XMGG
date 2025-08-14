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
                            <i class="fas fa-box me-3"></i>Quản lý sản phẩm
                        </h1>
                        <p class="text-muted fs-5 mb-0">Quản lý tất cả sản phẩm của Đại Quân Decor</p>
                    </div>
                    <div>
                        <a href="/admin/addProducts" class="btn btn-primary-modern">
                            <i class="fas fa-plus me-2"></i>Thêm sản phẩm mới
                        </a>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="card modern-card mb-4">
                    <div class="card-body">
                        <div class="row">
                                                         <div class="col-md-6">
                                 <form method="GET" action="" class="d-flex">
                                     <div class="input-group">
                                         <span class="input-group-text">
                                             <i class="fas fa-search"></i>
                                         </span>
                                         <input type="text" class="form-control modern-input" name="search" id="searchInput" 
                                                placeholder="Tìm kiếm sản phẩm..." 
                                                value="<?php echo htmlspecialchars($searchTerm ?? ''); ?>">
                                         <button type="submit" class="btn btn-primary-modern">
                                             <i class="fas fa-search"></i>
                                         </button>
                                         <?php if (!empty($searchTerm)): ?>
                                             <a href="?<?php echo isset($categoryId) ? 'category_id=' . $categoryId : ''; ?>" class="btn btn-outline-secondary">
                                                 <i class="fas fa-times"></i>
                                             </a>
                                         <?php endif; ?>
                                     </div>
                                 </form>
                             </div>
                            <div class="col-md-3">
                                <select class="form-select modern-select" id="categoryFilter" name="category_id">
                                    <option value="">Tất cả danh mục</option>
                                    <?php if (isset($categories) && !empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?php echo htmlspecialchars($category['category_id']); ?>" 
                                                    <?php echo (isset($categoryId) && $categoryId == $category['category_id']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($category['category_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select modern-select" id="statusFilter">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="active">Đang bán</option>
                                    <option value="inactive">Ngừng bán</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                                 <!-- Products Table -->
                 <div class="card modern-card">
                     <div class="card-header bg-gradient">
                         <div class="d-flex justify-content-between align-items-center">
                             <h5 class="mb-0 fw-bold text-white">
                                 <i class="fas fa-list me-2"></i>Danh sách sản phẩm
                                 <?php if (!empty($searchTerm)): ?>
                                     <span class="badge bg-light text-dark ms-2">
                                         <i class="fas fa-search me-1"></i>
                                         "<?php echo htmlspecialchars($searchTerm); ?>"
                                         (<?php echo $totalProducts; ?> kết quả)
                                     </span>
                                 <?php endif; ?>
                             </h5>
                             <div class="d-flex align-items-center">
                                 <button type="button" class="btn btn-danger btn-sm me-3" id="deleteSelectedBtn" style="display: none;">
                                     <i class="fas fa-trash me-2"></i>Xóa đã chọn
                                 </button>
                                 <div class="text-white">
                                     <small>
                                         Trang <?php echo $currentPage; ?> / <?php echo $totalPages; ?> 
                                         (<?php echo $totalProducts; ?> sản phẩm)
                                     </small>
                                 </div>
                             </div>
                         </div>
                     </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAll" class="form-check-input">
                                        </th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($products)): ?>
                                        <?php foreach ($products as $product): ?>
                                            <tr class="product-row">
                                                <td>
                                                    <input type="checkbox" class="form-check-input product-checkbox" 
                                                           value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php 
                                                        $imageUrl = $product['main_image'] ?? 'default.jpg';
                                                        ?>
                                                        <img src="/images/upload/<?php echo htmlspecialchars($imageUrl); ?>" 
                                                             alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                                                             class="rounded product-image" style="width: 60px; height: 60px; object-fit: cover;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <div class="fw-semibold"><?php echo htmlspecialchars($product['product_name']); ?></div>
                                                        <small class="text-muted">ID: #<?php echo htmlspecialchars($product['product_id']); ?></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary-modern"><?php echo htmlspecialchars($product['category_name'] ?? 'N/A'); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-decoration-line-through text-muted">
                                                            <?php echo number_format($product['old_price'], 0, ',', '.'); ?>đ
                                                        </span>
                                                        <br>
                                                        <span class="fw-bold text-success fs-6">
                                                            <?php echo number_format($product['price'], 0, ',', '.'); ?>đ
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if ($product['in_stock'] > 0): ?>
                                                        <span class="badge bg-success"><?php echo $product['in_stock']; ?> sản phẩm</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger">Hết hàng</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($product['status'] == 'active'): ?>
                                                        <span class="badge bg-success">Đang bán</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">Ngừng bán</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="/admin/editProducts?id=<?php echo htmlspecialchars($product['product_id']); ?>" 
                                                           class="btn btn-sm btn-outline-primary-modern" title="Chỉnh sửa">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="/chitietsanpham/<?php echo htmlspecialchars($product['product_id']); ?>" 
                                                           class="btn btn-sm btn-outline-info" title="Xem chi tiết" target="_blank">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                onclick="deleteProduct(<?php echo htmlspecialchars($product['product_id']); ?>)" title="Xóa">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-box-open fa-3x mb-3"></i>
                                                    <h5>Chưa có sản phẩm nào</h5>
                                                    <p>Bắt đầu bằng cách thêm sản phẩm đầu tiên</p>
                                                    <a href="/admin/addProducts" class="btn btn-primary-modern">
                                                        <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <?php if (!empty($products) && isset($totalPages) && $totalPages > 1): ?>
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Product pagination">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?><?php 
                                            echo !empty($searchTerm) ? '&search=' . urlencode($searchTerm) : ''; 
                                            echo isset($categoryId) ? '&category_id=' . $categoryId : ''; 
                                        ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>Xác nhận xóa
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
                    <p class="text-muted small">Hành động này không thể hoàn tác.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">
                        <i class="fas fa-trash me-2"></i>Xóa sản phẩm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Multiple Products Confirmation Modal -->
    <div class="modal fade" id="deleteMultipleModal" tabindex="-1" aria-labelledby="deleteMultipleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMultipleModalLabel">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>Xác nhận xóa nhiều sản phẩm
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa <span id="selectedCount" class="fw-bold text-danger">0</span> sản phẩm đã chọn không?</p>
                    <p class="text-muted small">Hành động này không thể hoàn tác.</p>
                    <div id="selectedProductsList" class="mt-3">
                        <!-- Danh sách sản phẩm sẽ được hiển thị ở đây -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteMultiple">
                        <i class="fas fa-trash me-2"></i>Xóa sản phẩm đã chọn
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footAdmin.php'; ?>

         <script>
         // Real-time search functionality
         let searchTimeout;
         document.getElementById('searchInput').addEventListener('input', function() {
             const searchTerm = this.value.trim();
             
             // Clear previous timeout
             clearTimeout(searchTimeout);
             
             // Set new timeout for 500ms delay
             searchTimeout = setTimeout(() => {
                 if (searchTerm.length >= 2 || searchTerm.length === 0) {
                     // Perform search via AJAX
                     performSearch(searchTerm);
                 }
             }, 500);
         });
         
         function performSearch(searchTerm) {
             const currentUrl = new URL(window.location);
             
             if (searchTerm) {
             currentUrl.searchParams.set('search', searchTerm);
             } else {
                 currentUrl.searchParams.delete('search');
             }
             
             currentUrl.searchParams.set('page', '1'); // Reset to first page
             
             // Show loading indicator
             showLoading();
             
             fetch(currentUrl.toString())
                 .then(response => response.text())
                 .then(html => {
                     // Create a temporary div to parse the HTML
                     const tempDiv = document.createElement('div');
                     tempDiv.innerHTML = html;
                     
                     // Extract the table body content
                     const newTableBody = tempDiv.querySelector('tbody');
                     const currentTableBody = document.querySelector('tbody');
                     
                     if (newTableBody && currentTableBody) {
                         currentTableBody.innerHTML = newTableBody.innerHTML;
                     }
                     
                     // Update pagination if exists
                     const newPagination = tempDiv.querySelector('.pagination');
                     const currentPagination = document.querySelector('.pagination');
                     
                     if (newPagination && currentPagination) {
                         currentPagination.innerHTML = newPagination.innerHTML;
                     }
                     
                     // Update URL without page reload
                     window.history.pushState({}, '', currentUrl.toString());
                     
                     hideLoading();
                 })
                 .catch(error => {
                     console.error('Search error:', error);
                     hideLoading();
                 });
         }
         
         function showLoading() {
             const tbody = document.querySelector('tbody');
             if (tbody) {
                 tbody.innerHTML = `
                     <tr>
                         <td colspan="7" class="text-center py-5">
                             <div class="text-muted">
                                 <i class="fas fa-spinner fa-spin fa-3x mb-3"></i>
                                 <h5>Đang tìm kiếm...</h5>
                             </div>
                         </td>
                     </tr>
                 `;
             }
         }
         
         function hideLoading() {
             // Loading will be hidden when content is updated
         }

        // Category filter
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selectedCategoryId = this.value;
            const currentUrl = new URL(window.location);
            
            if (selectedCategoryId) {
                currentUrl.searchParams.set('category_id', selectedCategoryId);
            } else {
                currentUrl.searchParams.delete('category_id');
            }
            
            // Reset về trang 1 khi thay đổi filter
            currentUrl.searchParams.set('page', '1');
            
            // Show loading indicator
            showLoading();
            
            fetch(currentUrl.toString())
                .then(response => response.text())
                .then(html => {
                    // Create a temporary div to parse the HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = html;
                    
                    // Extract the table body content
                    const newTableBody = tempDiv.querySelector('tbody');
                    const currentTableBody = document.querySelector('tbody');
                    
                    if (newTableBody && currentTableBody) {
                        currentTableBody.innerHTML = newTableBody.innerHTML;
                    }
                    
                    // Update pagination if exists
                    const newPagination = tempDiv.querySelector('.pagination');
                    const currentPagination = document.querySelector('.pagination');
                    
                    if (newPagination && currentPagination) {
                        currentPagination.innerHTML = newPagination.innerHTML;
                    }
                    
                    // Update URL without page reload
                    window.history.pushState({}, '', currentUrl.toString());
                    
                    hideLoading();
                })
                .catch(error => {
                    console.error('Category filter error:', error);
                    hideLoading();
            });
        });

        // Status filter
        document.getElementById('statusFilter').addEventListener('change', function() {
            const selectedStatus = this.value;
            const rows = document.querySelectorAll('.product-row');
            
            rows.forEach(row => {
                const statusElement = row.querySelector('td:nth-child(6)');
                if (statusElement) {
                    const status = statusElement.textContent.trim();
                    
                    if (!selectedStatus || 
                        (selectedStatus === 'active' && status === 'Đang bán') ||
                        (selectedStatus === 'inactive' && status === 'Ngừng bán')) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });

        // Delete product functionality
        let productIdToDelete = null;

        function deleteProduct(productId) {
            productIdToDelete = productId;
            $('#deleteModal').modal('show');
        }

        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (productIdToDelete) {
                const formData = new FormData();
                formData.append('id', productIdToDelete);
                
                fetch('/admin/deleteProducts', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.text();
                    }
                })
                .then(data => {
                    if (data) {
                        console.log('Response:', data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi xóa sản phẩm');
                });
            }
        });

        // Multiple delete functionality
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
            const confirmDeleteMultipleBtn = document.getElementById('confirmDeleteMultiple');

            // Select all functionality
            selectAllCheckbox.addEventListener('change', function() {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateDeleteButton();
            });

            // Individual checkbox change
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllCheckbox();
                    updateDeleteButton();
                });
            });

            // Update select all checkbox state
            function updateSelectAllCheckbox() {
                const checkedBoxes = document.querySelectorAll('.product-checkbox:checked');
                const totalBoxes = productCheckboxes.length;
                
                if (checkedBoxes.length === 0) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                } else if (checkedBoxes.length === totalBoxes) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = true;
                }
            }

            // Update delete button visibility
            function updateDeleteButton() {
                const checkedBoxes = document.querySelectorAll('.product-checkbox:checked');
                if (checkedBoxes.length > 0) {
                    deleteSelectedBtn.style.display = 'inline-block';
                    deleteSelectedBtn.textContent = `Xóa đã chọn (${checkedBoxes.length})`;
                } else {
                    deleteSelectedBtn.style.display = 'none';
                }
            }

            // Delete selected button click
            deleteSelectedBtn.addEventListener('click', function() {
                const checkedBoxes = document.querySelectorAll('.product-checkbox:checked');
                if (checkedBoxes.length > 0) {
                    showDeleteMultipleModal(checkedBoxes);
                }
            });

            // Show delete multiple modal
            function showDeleteMultipleModal(checkedBoxes) {
                const selectedCount = document.getElementById('selectedCount');
                const selectedProductsList = document.getElementById('selectedProductsList');
                
                selectedCount.textContent = checkedBoxes.length;
                
                // Create list of selected products
                let productsList = '<div class="alert alert-warning"><strong>Sản phẩm sẽ bị xóa:</strong><ul class="mb-0 mt-2">';
                checkedBoxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const productName = row.querySelector('td:nth-child(3) .fw-semibold').textContent;
                    const productId = checkbox.value;
                    productsList += `<li>${productName} (ID: #${productId})</li>`;
                });
                productsList += '</ul></div>';
                
                selectedProductsList.innerHTML = productsList;
                $('#deleteMultipleModal').modal('show');
            }

            // Confirm delete multiple
            confirmDeleteMultipleBtn.addEventListener('click', function() {
                const checkedBoxes = document.querySelectorAll('.product-checkbox:checked');
                const productIds = Array.from(checkedBoxes).map(checkbox => checkbox.value);
                
                if (productIds.length > 0) {
                    const formData = new FormData();
                    formData.append('ids', JSON.stringify(productIds));
                    
                    fetch('/admin/deleteMultipleProducts', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        } else {
                            return response.text();
                        }
                    })
                    .then(data => {
                        if (data) {
                            console.log('Response:', data);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi xóa sản phẩm');
                    });
                }
            });

            // Ensure modal close buttons work properly
            document.querySelectorAll('[data-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.closest('.modal').id;
                    $('#' + modalId).modal('hide');
                });
            });

            // Close modal when clicking outside
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        $(this).modal('hide');
                    }
                });
            });

            // Close modal on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    $('.modal').modal('hide');
                }
            });
        });
    </script>

    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --success-color: #4facfe;
            --danger-color: #ff6b6b;
            --warning-color: #ffa500;
            --info-color: #00f2fe;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .modern-card {
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            border: none;
            background: rgba(255,255,255,0.95);
            transition: all 0.3s ease;
        }

        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .bg-gradient {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-outline-primary-modern {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary-modern:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        .modern-input, .modern-select {
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .modern-input:focus, .modern-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .product-image {
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        .badge {
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-weight: 600;
        }

        .bg-primary-modern {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        }

        .table-hover tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .pagination .page-link {
            border-radius: 8px;
            margin: 0 2px;
            border: none;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }

        .pagination .page-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modern-card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Checkbox styling */
        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid #dee2e6;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        /* Delete selected button */
        #deleteSelectedBtn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        #deleteSelectedBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
        }

        /* Selected products list in modal */
        #selectedProductsList .alert {
            border-radius: 10px;
            border: none;
        }

        #selectedProductsList ul {
            max-height: 200px;
            overflow-y: auto;
        }

        #selectedProductsList li {
            padding: 0.25rem 0;
            border-bottom: 1px solid #f8f9fa;
        }

        #selectedProductsList li:last-child {
            border-bottom: none;
        }

        /* Modal close button styling */
        .modal .close {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: 0.5;
            background: transparent;
            border: 0;
            padding: 0;
            margin: -1rem -1rem -1rem auto;
        }

        .modal .close:hover {
            color: #000;
            text-decoration: none;
            opacity: 0.75;
        }

        .modal .close:focus {
            outline: 0;
            box-shadow: none;
        }

        /* Modal backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Ensure modal is above other elements */
        .modal {
            z-index: 1050;
        }

        .modal-backdrop {
            z-index: 1040;
        }
    </style>
</body>
