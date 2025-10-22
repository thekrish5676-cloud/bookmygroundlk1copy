<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Advertisement Management</h1>
        <div class="header-actions">
            <button class="btn-publish-ad" onclick="openPublishModal()">📢 Publish New Ad</button>
        </div>
    </div>

    <!-- Ad Stats -->
    <div class="ad-stats">
        <div class="stat-item">
            <div class="stat-icon">⏳</div>
            <div class="stat-details">
                <span class="stat-number">3</span>
                <span class="stat-label">Pending Review</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">✅</div>
            <div class="stat-details">
                <span class="stat-number">2</span>
                <span class="stat-label">Active Ads</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">💰</div>
            <div class="stat-details">
                <span class="stat-number">LKR 47,000</span>
                <span class="stat-label">This Month Revenue</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">📊</div>
            <div class="stat-details">
                <span class="stat-number">15</span>
                <span class="stat-label">Total This Month</span>
            </div>
        </div>
    </div>

    <!-- Pending Advertisements -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Pending Advertisement Requests</h3>
            <span class="badge pending"><?php echo count($data['pending_ads']); ?> pending</span>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company</th>
                        <th>Contact Person</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['pending_ads'] as $ad): ?>
                    <tr>
                        <td>#AD<?php echo str_pad($ad['id'], 3, '0', STR_PAD_LEFT); ?></td>
                        <td>
                            <strong><?php echo $ad['company']; ?></strong>
                        </td>
                        <td>
                            <div class="contact-info">
                                <span><?php echo $ad['contact']; ?></span>
                                <small><?php echo $ad['email']; ?></small>
                            </div>
                        </td>
                        <td><?php echo $ad['phone']; ?></td>
                        <td><strong>LKR <?php echo number_format($ad['amount']); ?></strong></td>
                        <td>
                            <span class="status-badge <?php echo strtolower(str_replace(' ', '-', $ad['status'])); ?>">
                                <?php echo $ad['status']; ?>
                            </span>
                        </td>
                        <td><?php echo $ad['submitted']; ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action-sm btn-view" onclick="viewAdRequest(<?php echo $ad['id']; ?>)">View</button>
                                <?php if($ad['status'] == 'Payment Submitted'): ?>
                                    <button class="btn-action-sm btn-verify" onclick="verifyPayment(<?php echo $ad['id']; ?>)">Verify</button>
                                <?php endif; ?>
                                <?php if($ad['status'] == 'Verified'): ?>
                                    <button class="btn-action-sm btn-publish" onclick="publishAd(<?php echo $ad['id']; ?>)">Publish</button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Published Advertisements -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Currently Published Ads</h3>
        </div>
        <div class="published-ads-grid">
            <?php foreach($data['published_ads'] as $published): ?>
            <div class="published-ad-card">
                <div class="ad-preview">
                    <img src="<?php echo URLROOT; ?>/images/ads/placeholder-ad.jpg" alt="<?php echo $published['company']; ?> Ad">
                    <div class="ad-type"><?php echo $published['type']; ?></div>
                </div>
                <div class="ad-details">
                    <h4><?php echo $published['company']; ?></h4>
                    <p>Published: <?php echo $published['published']; ?></p>
                    <p>Expires: <?php echo $published['expires']; ?></p>
                    <span class="status-badge active"><?php echo $published['status']; ?></span>
                </div>
                <div class="ad-actions">
                    <button class="btn-action-sm btn-edit" onclick="editAd(<?php echo $published['id']; ?>)">Edit</button>
                    <button class="btn-action-sm btn-delete" onclick="deleteAd(<?php echo $published['id']; ?>)">Delete</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Publish Ad Modal -->
<div id="publishModal" class="modal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Publish Advertisement</h3>
            <span class="close" onclick="closePublishModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form class="publish-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="company" required>
                    </div>
                    <div class="form-group">
                        <label>Ad Type</label>
                        <select name="ad_type" required>
                            <option value="">Select Type</option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                            <option value="gif">Animated GIF</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Upload Advertisement (1200px × 386px recommended)</label>
                    <div class="file-upload">
                        <input type="file" accept="image/*,video/*" id="adFile">
                        <div class="upload-preview" id="uploadPreview"></div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Link URL (Optional)</label>
                        <input type="url" name="link_url" placeholder="https://company.com">
                    </div>
                    <div class="form-group">
                        <label>Duration (Days)</label>
                        <input type="number" name="duration" value="30" min="1" max="365">
                    </div>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closePublishModal()">Cancel</button>
                    <button type="submit" class="btn-publish">Publish Advertisement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openPublishModal() {
    document.getElementById('publishModal').style.display = 'block';
}

function closePublishModal() {
    document.getElementById('publishModal').style.display = 'none';
}

function viewAdRequest(id) {
    alert(`Viewing advertisement request #AD${id.toString().padStart(3, '0')}`);
}

function verifyPayment(id) {
    if(confirm('Has the payment been verified through WhatsApp?')) {
        alert(`Payment verified for AD${id.toString().padStart(3, '0')}`);
    }
}

function publishAd(id) {
    if(confirm('Publish this advertisement to the website header?')) {
        alert(`Advertisement AD${id.toString().padStart(3, '0')} published successfully!`);
    }
}

function editAd(id) {
    alert(`Edit advertisement functionality - ID: ${id}`);
}

function deleteAd(id) {
    if(confirm('Are you sure you want to delete this advertisement?')) {
        alert(`Advertisement deleted: ${id}`);
    }
}
</script>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>