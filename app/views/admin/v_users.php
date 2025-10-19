<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>User Management</h1>
        <div class="header-actions">
            <a href="<?php echo URLROOT; ?>/admin/add_user" class="btn-add-user">
                <span class="icon">➕</span> Add New User
            </a>
            <button class="btn-export" onclick="exportUsers()">
                <span class="icon">📊</span> Export Data
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <span class="icon">✅</span>
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-error">
            <span class="icon">❌</span>
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- User Stats -->
    <div class="user-stats">
        <div class="stat-item">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <span class="stat-number"><?php echo $data['stats']['total_users']; ?></span>
                <span class="stat-label">Total Users</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🏃‍♂️</div>
            <div class="stat-info">
                <span class="stat-number"><?php echo $data['stats']['customers']; ?></span>
                <span class="stat-label">Customers</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🏟️</div>
            <div class="stat-info">
                <span class="stat-number"><?php echo $data['stats']['stadium_owners']; ?></span>
                <span class="stat-label">Stadium Owners</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🏃‍♂️</div>
            <div class="stat-info">
                <span class="stat-number"><?php echo $data['stats']['coaches']; ?></span>
                <span class="stat-label">Coaches</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🎾</div>
            <div class="stat-info">
                <span class="stat-number"><?php echo $data['stats']['rental_owners']; ?></span>
                <span class="stat-label">Rental Owners</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">✅</div>
            <div class="stat-info">
                <span class="stat-number"><?php echo $data['stats']['active']; ?></span>
                <span class="stat-label">Active</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">⏸️</div>
            <div class="stat-info">
                <span class="stat-number"><?php echo $data['stats']['suspended']; ?></span>
                <span class="stat-label">Suspended</span>
            </div>
        </div>
    </div>

    <!-- Advanced Filters -->
    <div class="filters-section">
        <form method="GET" action="<?php echo URLROOT; ?>/admin/users" class="filters-form">
            <div class="filter-group">
                <label for="role">Filter by Role:</label>
                <select name="role" id="role" class="filter-select">
                    <option value="">All Roles</option>
                    <option value="customer" <?php echo ($data['filters']['role'] == 'customer') ? 'selected' : ''; ?>>Customer</option>
                    <option value="stadium_owner" <?php echo ($data['filters']['role'] == 'stadium_owner') ? 'selected' : ''; ?>>Stadium Owner</option>
                    <option value="coach" <?php echo ($data['filters']['role'] == 'coach') ? 'selected' : ''; ?>>Coach</option>
                    <option value="rental_owner" <?php echo ($data['filters']['role'] == 'rental_owner') ? 'selected' : ''; ?>>Rental Owner</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="status">Filter by Status:</label>
                <select name="status" id="status" class="filter-select">
                    <option value="">All Status</option>
                    <option value="active" <?php echo ($data['filters']['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo ($data['filters']['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    <option value="suspended" <?php echo ($data['filters']['status'] == 'suspended') ? 'selected' : ''; ?>>Suspended</option>
                    <option value="pending" <?php echo ($data['filters']['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="search">Search Users:</label>
                <input type="text" 
                       name="search" 
                       id="search" 
                       class="search-input" 
                       placeholder="Search by name, email..." 
                       value="<?php echo htmlspecialchars($data['filters']['search']); ?>">
            </div>
            
            <div class="filter-actions">
                <button type="submit" class="btn-filter">
                    <span class="icon">🔍</span> Filter
                </button>
                <a href="<?php echo URLROOT; ?>/admin/users" class="btn-clear">
                    <span class="icon">🔄</span> Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div class="bulk-actions" id="bulkActions" style="display: none;">
        <div class="bulk-info">
            <span id="selectedCount">0</span> user(s) selected
        </div>
        <div class="bulk-buttons">
            <button class="btn-bulk" onclick="bulkAction('activate')">
                <span class="icon">✅</span> Activate
            </button>
            <button class="btn-bulk" onclick="bulkAction('suspend')">
                <span class="icon">⏸️</span> Suspend
            </button>
            <button class="btn-bulk btn-danger" onclick="bulkAction('delete')">
                <span class="icon">🗑️</span> Delete
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>All Users</h3>
            <span class="total-count"><?php echo count($data['users']); ?> users found</span>
        </div>
        
        <div class="table-container">
            <table class="data-table" id="usersTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>ID</th>
                        <th>User Info</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($data['users']) > 0): ?>
                        <?php foreach($data['users'] as $user): ?>
                        <tr class="user-row" data-user-id="<?php echo $user->id; ?>">
                            <td>
                                <input type="checkbox" class="user-checkbox" value="<?php echo $user->id; ?>">
                            </td>
                            <td>
                                <span class="user-id">#<?php echo str_pad($user->id, 4, '0', STR_PAD_LEFT); ?></span>
                            </td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <?php echo strtoupper(substr($user->display_name ?? $user->first_name, 0, 1)); ?>
                                    </div>
                                    <div class="user-details">
                                        <span class="user-name"><?php echo htmlspecialchars($user->display_name ?? $user->first_name . ' ' . $user->last_name); ?></span>
                                        <?php if($user->owner_name): ?>
                                            <small class="owner-name">Owner: <?php echo htmlspecialchars($user->owner_name); ?></small>
                                        <?php endif; ?>
                                        <small class="user-id-small">ID: <?php echo $user->id; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="user-email"><?php echo htmlspecialchars($user->email); ?></span>
                            </td>
                            <td>
                                <span class="user-phone"><?php echo htmlspecialchars($user->phone); ?></span>
                            </td>
                            <td>
                                <span class="role-badge <?php echo strtolower(str_replace('_', '-', $user->role)); ?>">
                                    <?php 
                                    $roleNames = [
                                        'customer' => 'Customer',
                                        'stadium_owner' => 'Stadium Owner',
                                        'coach' => 'Coach',
                                        'rental_owner' => 'Rental Owner'
                                    ];
                                    echo $roleNames[$user->role] ?? ucfirst($user->role);
                                    ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge <?php echo strtolower($user->status); ?>" data-status="<?php echo $user->status; ?>">
                                    <span class="status-dot"></span>
                                    <?php echo ucfirst($user->status); ?>
                                </span>
                            </td>
                            <td>
                                <span class="join-date"><?php echo date('M j, Y', strtotime($user->created_at)); ?></span>
                                <small class="join-time"><?php echo date('g:i A', strtotime($user->created_at)); ?></small>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-view" 
                                            onclick="viewUser(<?php echo $user->id; ?>)" 
                                            title="View Details">
                                        <span class="icon">👁️</span>
                                    </button>
                                    
                                    <button class="btn-action-sm btn-edit" 
                                            onclick="editUser(<?php echo $user->id; ?>)" 
                                            title="Edit User">
                                        <span class="icon">✏️</span>
                                    </button>
                                    
                                    <?php if($user->status == 'active'): ?>
                                        <button class="btn-action-sm btn-suspend" 
                                                onclick="changeUserStatus(<?php echo $user->id; ?>, 'suspended')" 
                                                title="Suspend User">
                                            <span class="icon">⏸️</span>
                                        </button>
                                    <?php elseif($user->status == 'suspended'): ?>
                                        <button class="btn-action-sm btn-activate" 
                                                onclick="changeUserStatus(<?php echo $user->id; ?>, 'active')" 
                                                title="Activate User">
                                            <span class="icon">✅</span>
                                        </button>
                                    <?php endif; ?>
                                    
                                    <button class="btn-action-sm btn-delete" 
                                            onclick="deleteUser(<?php echo $user->id; ?>, '<?php echo htmlspecialchars($user->display_name ?? $user->first_name . ' ' . $user->last_name); ?>')" 
                                            title="Delete User">
                                        <span class="icon">🗑️</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="no-data">
                                <div class="no-data-message">
                                    <span class="icon">📭</span>
                                    <h3>No users found</h3>
                                    <p>Try adjusting your search criteria or add your first user.</p>
                                    <a href="<?php echo URLROOT; ?>/admin/add_user" class="btn-add-first">Add First User</a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination (if needed) -->
    <?php if(count($data['users']) > 50): ?>
    <div class="pagination">
        <div class="pagination-info">
            Showing 1-50 of <?php echo count($data['users']); ?> users
        </div>
        <div class="pagination-controls">
            <button class="btn-page" disabled>‹ Previous</button>
            <button class="btn-page active">1</button>
            <button class="btn-page">2</button>
            <button class="btn-page">3</button>
            <button class="btn-page">Next ›</button>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- User Details Modal -->
<div id="userModal" class="modal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3 id="modalTitle">User Details</h3>
            <span class="close" onclick="closeUserModal()">&times;</span>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- User details will be loaded here -->
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeUserModal()">Close</button>
            <button class="btn-edit" id="modalEditBtn" onclick="">Edit User</button>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="confirmTitle">Confirm Action</h3>
            <span class="close" onclick="closeConfirmModal()">&times;</span>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">Are you sure you want to perform this action?</p>
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeConfirmModal()">Cancel</button>
            <button class="btn-confirm" id="confirmBtn" onclick="">Confirm</button>
        </div>
    </div>
</div>

<script>
// User Management JavaScript Functions

// Toggle select all checkbox
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    const bulkActions = document.getElementById('bulkActions');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

// Update bulk actions visibility
function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.user-checkbox:checked');
    const bulkActions = document.getElementById('bulkActions');
    const selectedCount = document.getElementById('selectedCount');
    
    if (checkboxes.length > 0) {
        bulkActions.style.display = 'flex';
        selectedCount.textContent = checkboxes.length;
    } else {
        bulkActions.style.display = 'none';
    }
}

// Individual checkbox change
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
});

// View user details
function viewUser(userId) {
    // Show loading state
    document.getElementById('modalTitle').textContent = 'Loading...';
    document.getElementById('modalBody').innerHTML = '<div class="loading">Loading user details...</div>';
    document.getElementById('userModal').style.display = 'block';
    
    // In a real application, you would fetch user details via AJAX
    // For now, we'll simulate this
    setTimeout(() => {
        document.getElementById('modalTitle').textContent = 'User Details - #' + userId.toString().padStart(4, '0');
        document.getElementById('modalBody').innerHTML = `
            <div class="user-detail-content">
                <div class="detail-section">
                    <h4>Basic Information</h4>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label>User ID:</label>
                            <span>#${userId.toString().padStart(4, '0')}</span>
                        </div>
                        <div class="detail-item">
                            <label>Full Name:</label>
                            <span>Loading...</span>
                        </div>
                        <div class="detail-item">
                            <label>Email:</label>
                            <span>Loading...</span>
                        </div>
                        <div class="detail-item">
                            <label>Phone:</label>
                            <span>Loading...</span>
                        </div>
                        <div class="detail-item">
                            <label>Role:</label>
                            <span>Loading...</span>
                        </div>
                        <div class="detail-item">
                            <label>Status:</label>
                            <span>Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="detail-section">
                    <h4>Account Information</h4>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <label>Joined Date:</label>
                            <span>Loading...</span>
                        </div>
                        <div class="detail-item">
                            <label>Last Login:</label>
                            <span>Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('modalEditBtn').onclick = () => editUser(userId);
    }, 500);
}

// Edit user
function editUser(userId) {
    window.location.href = `<?php echo URLROOT; ?>/admin/edit_user/${userId}`;
}

// Change user status
function changeUserStatus(userId, newStatus) {
    const statusText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
    
    showConfirmModal(
        `Change User Status`,
        `Are you sure you want to ${statusText.toLowerCase()} this user?`,
        () => {
            // Show loading state
            const statusBadge = document.querySelector(`tr[data-user-id="${userId}"] .status-badge`);
            statusBadge.innerHTML = '<span class="loading-dot"></span>Processing...';
            
            // Simulate AJAX request
            setTimeout(() => {
                statusBadge.className = `status-badge ${newStatus}`;
                statusBadge.innerHTML = `<span class="status-dot"></span>${statusText}`;
                statusBadge.setAttribute('data-status', newStatus);
                
                // Update action buttons
                updateActionButtons(userId, newStatus);
                
                showNotification(`User status changed to ${statusText}`, 'success');
            }, 1000);
        }
    );
}

// Update action buttons based on status
function updateActionButtons(userId, status) {
    const row = document.querySelector(`tr[data-user-id="${userId}"]`);
    const actionButtons = row.querySelector('.action-buttons');
    
    // Remove existing status buttons
    actionButtons.querySelectorAll('.btn-suspend, .btn-activate').forEach(btn => btn.remove());
    
    // Add appropriate button
    if (status === 'active') {
        const suspendBtn = document.createElement('button');
        suspendBtn.className = 'btn-action-sm btn-suspend';
        suspendBtn.title = 'Suspend User';
        suspendBtn.innerHTML = '<span class="icon">⏸️</span>';
        suspendBtn.onclick = () => changeUserStatus(userId, 'suspended');
        actionButtons.insertBefore(suspendBtn, actionButtons.lastElementChild);
    } else if (status === 'suspended') {
        const activateBtn = document.createElement('button');
        activateBtn.className = 'btn-action-sm btn-activate';
        activateBtn.title = 'Activate User';
        activateBtn.innerHTML = '<span class="icon">✅</span>';
        activateBtn.onclick = () => changeUserStatus(userId, 'active');
        actionButtons.insertBefore(activateBtn, actionButtons.lastElementChild);
    }
}

// Delete user
function deleteUser(userId, userName) {
    showConfirmModal(
        'Delete User',
        `Are you sure you want to delete "${userName}"? This action cannot be undone.`,
        () => {
            // Show loading state
            const row = document.querySelector(`tr[data-user-id="${userId}"]`);
            row.style.opacity = '0.5';
            row.style.pointerEvents = 'none';
            
            // Simulate AJAX request
            setTimeout(() => {
                row.remove();
                showNotification('User deleted successfully', 'success');
                updateUserCount();
            }, 1000);
        }
    );
}

// Bulk actions
function bulkAction(action) {
    const selectedUsers = document.querySelectorAll('.user-checkbox:checked');
    const count = selectedUsers.length;
    
    if (count === 0) {
        showNotification('Please select users first', 'error');
        return;
    }
    
    const actionText = action.charAt(0).toUpperCase() + action.slice(1);
    
    showConfirmModal(
        `Bulk ${actionText}`,
        `Are you sure you want to ${action} ${count} selected user(s)?`,
        () => {
            // Process bulk action
            selectedUsers.forEach((checkbox, index) => {
                const userId = checkbox.value;
                const row = checkbox.closest('tr');
                
                setTimeout(() => {
                    if (action === 'delete') {
                        row.remove();
                    } else {
                        changeUserStatus(userId, action === 'activate' ? 'active' : 'suspended');
                    }
                }, index * 100); // Stagger the updates
            });
            
            // Clear selections
            document.getElementById('selectAll').checked = false;
            updateBulkActions();
            
            showNotification(`Bulk ${action} completed successfully`, 'success');
            updateUserCount();
        }
    );
}

// Update user count in stats
function updateUserCount() {
    const totalRows = document.querySelectorAll('.user-row').length;
    document.querySelector('.total-count').textContent = `${totalRows} users found`;
}

// Export users
function exportUsers() {
    showNotification('Exporting users data...', 'info');
    
    // Simulate export process
    setTimeout(() => {
        showNotification('Users data exported successfully', 'success');
    }, 2000);
}

// Modal functions
function closeUserModal() {
    document.getElementById('userModal').style.display = 'none';
}

function showConfirmModal(title, message, onConfirm) {
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMessage').textContent = message;
    document.getElementById('confirmBtn').onclick = () => {
        onConfirm();
        closeConfirmModal();
    };
    document.getElementById('confirmModal').style.display = 'block';
}

function closeConfirmModal() {
    document.getElementById('confirmModal').style.display = 'none';
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <span class="notification-icon">${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}</span>
        <span class="notification-message">${message}</span>
        <button class="notification-close" onclick="this.parentElement.remove()">×</button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Close modals when clicking outside
window.onclick = function(event) {
    const userModal = document.getElementById('userModal');
    const confirmModal = document.getElementById('confirmModal');
    
    if (event.target === userModal) {
        userModal.style.display = 'none';
    }
    if (event.target === confirmModal) {
        confirmModal.style.display = 'none';
    }
}

// Auto-submit filters on change
document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('.filter-select');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            this.closest('form').submit();
        });
    });
    
    // Search with debounce
    const searchInput = document.getElementById('search');
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            this.closest('form').submit();
        }, 500);
    });
});
</script>

<style>
/* Additional CSS for enhanced user management */
.alert {
    padding: 12px 16px;
    margin-bottom: 20px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid #28a745;
    color: #155724;
}

.alert-error {
    background: rgba(220, 53, 69, 0.1);
    border: 1px solid #dc3545;
    color: #721c24;
}

.user-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-item {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-icon {
    font-size: 24px;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #03B200, #029800);
    border-radius: 12px;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-number {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.stat-label {
    font-size: 14px;
    color: #666;
}

.filters-section {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.filters-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.filter-group label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
}

.filter-select, .search-input {
    padding: 10px 12px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.filter-select:focus, .search-input:focus {
    outline: none;
    border-color: #03B200;
}

.filter-actions {
    display: flex;
    gap: 10px;
}

.btn-filter, .btn-clear {
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-filter {
    background: linear-gradient(135deg, #03B200, #029800);
    color: white;
}

.btn-clear {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.bulk-actions {
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-left: 4px solid #03B200;
}

.bulk-info {
    font-weight: 600;
    color: #333;
}

.bulk-buttons {
    display: flex;
    gap: 10px;
}

.btn-bulk {
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
}

.btn-bulk:hover {
    transform: translateY(-1px);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #03B200, #029800);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    color: #333;
}

.owner-name, .user-id-small {
    font-size: 12px;
    color: #666;
}

.role-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.role-badge.customer {
    background: rgba(0, 123, 255, 0.1);
    color: #007bff;
}

.role-badge.stadium-owner {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.role-badge.coach {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.role-badge.rental-owner {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.status-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

.status-badge.active {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.status-badge.active .status-dot {
    background: #28a745;
}

.status-badge.suspended {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.status-badge.suspended .status-dot {
    background: #ffc107;
}

.status-badge.inactive {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
}

.status-badge.inactive .status-dot {
    background: #6c757d;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action-sm {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-view {
    background: rgba(0, 123, 255, 0.1);
    color: #007bff;
}

.btn-edit {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.btn-suspend {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.btn-activate {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.btn-delete {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.btn-action-sm:hover {
    transform: translateY(-1px);
    opacity: 0.8;
}

.no-data {
    text-align: center;
    padding: 60px 20px;
}

.no-data-message {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

.no-data-message .icon {
    font-size: 48px;
    opacity: 0.5;
}

.no-data-message h3 {
    margin: 0;
    color: #666;
}

.no-data-message p {
    margin: 0;
    color: #999;
}

.btn-add-first {
    padding: 10px 20px;
    background: linear-gradient(135deg, #03B200, #029800);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
}

.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.pagination-controls {
    display: flex;
    gap: 8px;
}

.btn-page {
    padding: 8px 12px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-page:hover:not(:disabled) {
    background: #f8f9fa;
}

.btn-page.active {
    background: linear-gradient(135deg, #03B200, #029800);
    color: white;
    border-color: #03B200;
}

.btn-page:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    padding: 16px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 1000;
    min-width: 300px;
    border-left: 4px solid;
    animation: slideIn 0.3s ease;
}

.notification-success {
    border-left-color: #28a745;
}

.notification-error {
    border-left-color: #dc3545;
}

.notification-info {
    border-left-color: #007bff;
}

.notification-close {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    margin-left: auto;
    opacity: 0.5;
}

.notification-close:hover {
    opacity: 1;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.modal-content.large {
    max-width: 800px;
}

.modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid #e1e5e9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    color: #333;
}

.close {
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    color: #999;
    transition: color 0.3s ease;
}

.close:hover {
    color: #333;
}

.modal-body {
    padding: 24px;
    max-height: 60vh;
    overflow-y: auto;
}

.modal-actions {
    padding: 20px 24px;
    border-top: 1px solid #e1e5e9;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.btn-cancel, .btn-confirm, .btn-edit {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.btn-confirm {
    background: linear-gradient(135deg, #03B200, #029800);
    color: white;
}

.btn-edit {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.user-detail-content {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.detail-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}

.detail-section h4 {
    margin: 0 0 16px 0;
    color: #333;
    font-size: 16px;
    font-weight: 600;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-item label {
    font-size: 12px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-item span {
    font-size: 14px;
    color: #333;
    font-weight: 500;
}

.loading {
    text-align: center;
    padding: 40px;
    color: #666;
}

.loading-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #03B200;
    animation: pulse 1s infinite;
    margin-right: 8px;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Responsive design */
@media (max-width: 768px) {
    .user-stats {
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
    }
    
    .stat-item {
        padding: 15px;
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }
    
    .filters-form {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .filter-actions {
        grid-column: 1;
        justify-content: stretch;
    }
    
    .btn-filter, .btn-clear {
        flex: 1;
        justify-content: center;
    }
    
    .bulk-actions {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .bulk-buttons {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .data-table {
        min-width: 800px;
    }
    
    .user-info {
        min-width: 200px;
    }
    
    .action-buttons {
        min-width: 150px;
    }
    
    .modal-content {
        margin: 10% auto;
        width: 95%;
    }
    
    .modal-header {
        padding: 16px 20px;
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .modal-actions {
        padding: 16px 20px;
        flex-direction: column;
    }
    
    .btn-cancel, .btn-confirm, .btn-edit {
        width: 100%;
    }
    
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .notification {
        right: 10px;
        left: 10px;
        min-width: auto;
    }
    
    .pagination {
        flex-direction: column;
        gap: 15px;
    }
    
    .pagination-controls {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .dashboard-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .header-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-add-user, .btn-export {
        width: 100%;
        justify-content: center;
    }
    
    .user-stats {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .stat-number {
        font-size: 20px;
    }
    
    .stat-label {
        font-size: 12px;
    }
}
</style>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>