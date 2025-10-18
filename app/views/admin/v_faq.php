<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>FAQ Management</h1>
        <div class="header-actions">
            <button class="btn-add-faq" onclick="openFAQModal()">➕ Add New FAQ</button>
        </div>
    </div>

    <!-- FAQ Stats -->
    <div class="faq-stats">
        <div class="stat-item">
            <div class="stat-icon">❓</div>
            <div class="stat-details">
                <span class="stat-number"><?php echo count($data['faqs']); ?></span>
                <span class="stat-label">Total FAQs</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">📝</div>
            <div class="stat-details">
                <span class="stat-number"><?php echo count(array_filter($data['faqs'], function($faq) { return $faq['status'] == 'Published'; })); ?></span>
                <span class="stat-label">Published</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">📊</div>
            <div class="stat-details">
                <span class="stat-number">1,250</span>
                <span class="stat-label">Total Views</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🔥</div>
            <div class="stat-details">
                <span class="stat-number">5</span>
                <span class="stat-label">Most Popular</span>
            </div>
        </div>
    </div>

    <!-- FAQ Categories Filter -->
    <div class="filters-section">
        <div class="filter-group">
            <select class="filter-select" id="categoryFilter">
                <option value="">All Categories</option>
                <option value="booking">Booking</option>
                <option value="policies">Policies</option>
                <option value="equipment">Equipment</option>
                <option value="payments">Payments</option>
                <option value="general">General</option>
            </select>
        </div>
        <div class="filter-group">
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="archived">Archived</option>
            </select>
        </div>
        <div class="filter-group">
            <input type="text" class="search-input" placeholder="Search FAQs..." id="faqSearch">
        </div>
    </div>

    <!-- FAQ Management Table -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Frequently Asked Questions</h3>
            <span class="total-count"><?php echo count($data['faqs']); ?> total FAQs</span>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['faqs'] as $faq): ?>
                    <tr class="faq-row" data-category="<?php echo strtolower($faq['category']); ?>" data-status="<?php echo strtolower($faq['status']); ?>">
                        <td>#<?php echo str_pad($faq['id'], 3, '0', STR_PAD_LEFT); ?></td>
                        <td>
                            <div class="faq-question">
                                <strong><?php echo $faq['question']; ?></strong>
                                <div class="faq-preview">
                                    <?php echo strlen($faq['answer']) > 100 ? substr($faq['answer'], 0, 100) . '...' : $faq['answer']; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="category-badge <?php echo strtolower($faq['category']); ?>">
                                <?php echo $faq['category']; ?>
                            </span>
                        </td>
                        <td>
                            <span class="status-badge <?php echo strtolower($faq['status']); ?>">
                                <?php echo $faq['status']; ?>
                            </span>
                        </td>
                        <td><?php echo $faq['updated']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action-sm btn-edit" onclick="editFAQ(<?php echo $faq['id']; ?>)">Edit</button>
                                <?php if($faq['status'] == 'Published'): ?>
                                    <button class="btn-action-sm btn-unpublish" onclick="toggleStatus(<?php echo $faq['id']; ?>, 'unpublish')">Unpublish</button>
                                <?php else: ?>
                                    <button class="btn-action-sm btn-publish" onclick="toggleStatus(<?php echo $faq['id']; ?>, 'publish')">Publish</button>
                                <?php endif; ?>
                                <button class="btn-action-sm btn-delete" onclick="deleteFAQ(<?php echo $faq['id']; ?>)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- FAQ Categories Management -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>FAQ Categories</h3>
            <button class="btn-add-category" onclick="addCategory()">+ Add Category</button>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-info">
                    <h4>Booking</h4>
                    <p>5 FAQs</p>
                </div>
                <div class="category-actions">
                    <button class="btn-action-sm btn-edit">Edit</button>
                </div>
            </div>
            <div class="category-card">
                <div class="category-info">
                    <h4>Policies</h4>
                    <p>3 FAQs</p>
                </div>
                <div class="category-actions">
                    <button class="btn-action-sm btn-edit">Edit</button>
                </div>
            </div>
            <div class="category-card">
                <div class="category-info">
                    <h4>Equipment</h4>
                    <p>4 FAQs</p>
                </div>
                <div class="category-actions">
                    <button class="btn-action-sm btn-edit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit FAQ Modal -->
<div id="faqModal" class="modal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3 id="faqModalTitle">Add New FAQ</h3>
            <span class="close" onclick="closeFAQModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form class="faq-form">
                <div class="form-group">
                    <label>Question</label>
                    <input type="text" id="faqQuestion" name="question" required placeholder="Enter the frequently asked question">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Category</label>
                        <select id="faqCategory" name="category" required>
                            <option value="">Select Category</option>
                            <option value="booking">Booking</option>
                            <option value="policies">Policies</option>
                            <option value="equipment">Equipment</option>
                            <option value="payments">Payments</option>
                            <option value="general">General</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select id="faqStatus" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Answer</label>
                    <textarea id="faqAnswer" name="answer" rows="6" required placeholder="Enter the detailed answer to this question"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Tags (Optional)</label>
                    <input type="text" id="faqTags" name="tags" placeholder="Enter tags separated by commas (e.g., booking, cancellation, refund)">
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeFAQModal()">Cancel</button>
                    <button type="submit" class="btn-save-faq">Save FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openFAQModal() {
    document.getElementById('faqModalTitle').textContent = 'Add New FAQ';
    document.getElementById('faqModal').style.display = 'block';
    // Clear form
    document.querySelector('.faq-form').reset();
}

function closeFAQModal() {
    document.getElementById('faqModal').style.display = 'none';
}

function editFAQ(id) {
    document.getElementById('faqModalTitle').textContent = 'Edit FAQ';
    document.getElementById('faqModal').style.display = 'block';
    
    // Here you would populate the form with existing FAQ data
    console.log('Editing FAQ ID:', id);
}

function toggleStatus(id, action) {
    const actionText = action === 'publish' ? 'publish' : 'unpublish';
    if(confirm(`Are you sure you want to ${actionText} this FAQ?`)) {
        alert(`FAQ #${id} ${actionText}ed successfully!`);
        // Here you would make an AJAX call to update the status
    }
}

function deleteFAQ(id) {
    if(confirm('Are you sure you want to delete this FAQ? This action cannot be undone.')) {
        alert(`FAQ #${id} deleted successfully!`);
        // Here you would make an AJAX call to delete the FAQ
    }
}

function addCategory() {
    const categoryName = prompt('Enter new category name:');
    if(categoryName) {
        alert(`Category "${categoryName}" added successfully!`);
        // Here you would make an AJAX call to add the category
    }
}

// Filter functionality
document.getElementById('categoryFilter').addEventListener('change', function() {
    const category = this.value.toLowerCase();
    const rows = document.querySelectorAll('.faq-row');
    
    rows.forEach(row => {
        if(category === '' || row.dataset.category === category) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

document.getElementById('statusFilter').addEventListener('change', function() {
    const status = this.value.toLowerCase();
    const rows = document.querySelectorAll('.faq-row');
    
    rows.forEach(row => {
        if(status === '' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Search functionality
document.getElementById('faqSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.faq-row');
    
    rows.forEach(row => {
        const question = row.querySelector('.faq-question').textContent.toLowerCase();
        if(question.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('faqModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>