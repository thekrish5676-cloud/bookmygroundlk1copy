<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>User Management</h1>
        <div class="header-actions">
            <button class="btn-add-user" onclick="openAddUserModal()">+ Add New User</button>
        </div>
    </div>

    <!-- User Stats -->
    <div class="user-stats">
        <div class="stat-item">
            <span class="stat-number">320</span>
            <span class="stat-label">Customers</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">45</span>
            <span class="stat-label">Stadium Owners</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">28</span>
            <span class="stat-label">Coaches</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">12</span>
            <span class="stat-label">Rental Owners</span>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <div class="filter-group">
            <select class="filter-select" id="roleFilter">
                <option value="">All Roles</option>
                <option value="customer">Customer</option>
                <option value="stadium_owner">Stadium Owner</option>
                <option value="coach">Coach</option>
                <option value="rental_owner">Rental Owner</option>
            </select>
        </div>
        <div class="filter-group">
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="suspended">Suspended</option>
            </select>
        </div>
        <div class="filter-group">
            <input type="text" class="search-input" placeholder="Search users..." id="userSearch">
        </div>
    </div>

    <!-- Users Table -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>All Users</h3>
            <span class="total-count">405 total users</span>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data['users'])): ?>
                        <?php foreach($data['users'] as $user): ?>
                        <tr>
                            <td>#<?php echo $user['id']; ?></td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar"><?php echo substr($user['name'], 0, 1); ?></div>
                                    <span><?php echo $user['name']; ?></span>
                                </div>
                            </td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                <span class="role-badge <?php echo strtolower(str_replace(' ', '-', $user['role'])); ?>">
                                    <?php echo $user['role']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge <?php echo strtolower($user['status']); ?>">
                                    <?php echo $user['status']; ?>
                                </span>
                            </td>
                            <td>2025-01-15</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-edit" onclick="editUser(<?php echo $user['id']; ?>)">Edit</button>
                                    <button class="btn-action-sm btn-suspend" onclick="suspendUser(<?php echo $user['id']; ?>)">Suspend</button>
                                    <button class="btn-action-sm btn-delete" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Sample data for demo -->
                        <tr>
                            <td>#001</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">J</div>
                                    <span>John Doe</span>
                                </div>
                            </td>
                            <td>john@example.com</td>
                            <td><span class="role-badge customer">Customer</span></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>2025-01-15</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-edit">Edit</button>
                                    <button class="btn-action-sm btn-suspend">Suspend</button>
                                    <button class="btn-action-sm btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">S</div>
                                    <span>Stadium Owner 1</span>
                                </div>
                            </td>
                            <td>stadium1@example.com</td>
                            <td><span class="role-badge stadium-owner">Stadium Owner</span></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>2025-01-12</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-edit">Edit</button>
                                    <button class="btn-action-sm btn-suspend">Suspend</button>
                                    <button class="btn-action-sm btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">M</div>
                                    <span>Coach Mike</span>
                                </div>
                            </td>
                            <td>coach.mike@example.com</td>
                            <td><span class="role-badge coach">Coach</span></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>2025-01-10</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-edit">Edit</button>
                                    <button class="btn-action-sm btn-suspend">Suspend</button>
                                    <button class="btn-action-sm btn-delete">Delete</button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New User</h3>
            <span class="close" onclick="closeAddUserModal()">&times;</span>
        </div>
        <form class="modal-form">
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" required>
                        <option value="">Select Role</option>
                        <option value="customer">Customer</option>
                        <option value="stadium_owner">Stadium Owner</option>
                        <option value="coach">Coach</option>
                        <option value="rental_owner">Rental Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="tel" name="phone">
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeAddUserModal()">Cancel</button>
                <button type="submit" class="btn-save">Add User</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddUserModal() {
    document.getElementById('addUserModal').style.display = 'block';
}

function closeAddUserModal() {
    document.getElementById('addUserModal').style.display = 'none';
}

function editUser(id) {
    alert('Edit user #' + id + ' - This will open edit modal');
}

function suspendUser(id) {
    if(confirm('Are you sure you want to suspend this user?')) {
        alert('User #' + id + ' suspended');
    }
}

function deleteUser(id) {
    if(confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        alert('User #' + id + ' deleted');
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('addUserModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>