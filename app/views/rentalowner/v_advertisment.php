<?php require APPROOT.'/views/rentalowner/inc/header.php'; ?>

<div class="kal-rental-dashboard-advertisement">
    <div class="kal-rental-dashboard-advertisement-header">
        <h1>Advertisement Management</h1>
        <div class="kal-rental-dashboard-advertisement-header-actions">
            <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-primary" onclick="openPublishModal()">📢 Publish New Ad</button>
        </div>
    </div>

    <!-- Ad Stats -->
    <div class="kal-rental-dashboard-advertisement-stats">
        <div class="kal-rental-dashboard-advertisement-stat-item">
            <div class="kal-rental-dashboard-advertisement-stat-icon">⏳</div>
            <div class="kal-rental-dashboard-advertisement-stat-details">
                <span class="kal-rental-dashboard-advertisement-stat-number"><?php echo count($data['pending_ads']); ?></span>
                <span class="kal-rental-dashboard-advertisement-stat-label">Pending Review</span>
            </div>
        </div>
        <div class="kal-rental-dashboard-advertisement-stat-item">
            <div class="kal-rental-dashboard-advertisement-stat-icon">✅</div>
            <div class="kal-rental-dashboard-advertisement-stat-details">
                <span class="kal-rental-dashboard-advertisement-stat-number"><?php echo count($data['verified_ads']); ?></span>
                <span class="kal-rental-dashboard-advertisement-stat-label">Verified & Ready</span>
            </div>
        </div>
        <div class="kal-rental-dashboard-advertisement-stat-item">
            <div class="kal-rental-dashboard-advertisement-stat-icon">💰</div>
            <div class="kal-rental-dashboard-advertisement-stat-details">
                <span class="kal-rental-dashboard-advertisement-stat-number">LKR <?php echo number_format($data['monthly_revenue']); ?></span>
                <span class="kal-rental-dashboard-advertisement-stat-label">Monthly Revenue</span>
            </div>
        </div>
        <div class="kal-rental-dashboard-advertisement-stat-item">
            <div class="kal-rental-dashboard-advertisement-stat-icon">📊</div>
            <div class="kal-rental-dashboard-advertisement-stat-details">
                <span class="kal-rental-dashboard-advertisement-stat-number"><?php echo count($data['published_ads']); ?></span>
                <span class="kal-rental-dashboard-advertisement-stat-label">Active Ads</span>
            </div>
        </div>
    </div>

    <!-- Advertisement Requests -->
    <div class="kal-rental-dashboard-advertisement-card">
        <div class="kal-rental-dashboard-advertisement-card-header">
            <h3>Advertisement Requests</h3>
            <?php $totalRequests = count($data['pending_ads']) + count($data['verified_ads']); ?>
            <span class="kal-rental-dashboard-advertisement-badge kal-rental-dashboard-advertisement-badge-pending"><?php echo $totalRequests; ?> requests</span>
        </div>
        <div class="kal-rental-dashboard-advertisement-table-container">
            <table class="kal-rental-dashboard-advertisement-data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Business</th>
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
                            <strong><?php echo $ad['business']; ?></strong>
                            <small><?php echo $ad['service_type']; ?></small>
                        </td>
                        <td>
                            <div class="kal-rental-dashboard-advertisement-contact-info">
                                <span><?php echo $ad['contact']; ?></span>
                                <small><?php echo $ad['email']; ?></small>
                            </div>
                        </td>
                        <td><?php echo $ad['phone']; ?></td>
                        <td><strong>LKR <?php echo number_format($ad['amount']); ?></strong></td>
                        <td>
                            <?php
                                // Normalize statuses: hide 'Payment Submitted' by mapping it to 'Under Review'
                                $status = $ad['status'];
                                if(strtolower($status) === 'payment submitted'){
                                    $status = 'Under Review';
                                }
                                $status_class = strtolower(str_replace(' ', '-', $status));
                            ?>
                            <span class="kal-rental-dashboard-advertisement-status-badge kal-rental-dashboard-advertisement-status-<?php echo $status_class; ?>">
                                <?php echo htmlspecialchars($status); ?>
                            </span>
                        </td>
                        <td><?php echo $ad['submitted']; ?></td>
                        <td>
                            <div class="kal-rental-dashboard-advertisement-action-buttons">
                                <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-sm kal-rental-dashboard-advertisement-btn-view" onclick="viewAdRequest(<?php echo $ad['id']; ?>)">View</button>
                                <?php // Verify action removed for rental owners ?>
                                <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-sm kal-rental-dashboard-advertisement-btn-delete" onclick="deleteAdRequest(<?php echo $ad['id']; ?>)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php foreach($data['verified_ads'] as $ad): ?>
                    <tr>
                        <td>#AD<?php echo str_pad($ad['id'], 3, '0', STR_PAD_LEFT); ?></td>
                        <td>
                            <strong><?php echo $ad['business']; ?></strong>
                            <small><?php echo $ad['service_type']; ?></small>
                        </td>
                        <td>
                            <div class="kal-rental-dashboard-advertisement-contact-info">
                                <span><?php echo $ad['contact']; ?></span>
                                <small><?php echo $ad['email']; ?></small>
                            </div>
                        </td>
                        <td><?php echo $ad['phone']; ?></td>
                        <td><strong>LKR <?php echo number_format($ad['amount']); ?></strong></td>
                        <td>
                            <span class="kal-rental-dashboard-advertisement-status-badge kal-rental-dashboard-advertisement-status-verified">
                                Verified
                            </span>
                        </td>
                        <td><?php echo $ad['verified_date'] ?? $ad['submitted']; ?></td>
                        <td>
                            <div class="kal-rental-dashboard-advertisement-action-buttons">
                                <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-sm kal-rental-dashboard-advertisement-btn-view" onclick="viewAdRequest(<?php echo $ad['id']; ?>)">View</button>
                                <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-sm kal-rental-dashboard-advertisement-btn-publish" onclick="publishAd(<?php echo $ad['id']; ?>)">Publish</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Published Advertisements -->
    <div class="kal-rental-dashboard-advertisement-card">
        <div class="kal-rental-dashboard-advertisement-card-header">
            <h3>Currently Published Ads</h3>
        </div>
        <div class="kal-rental-dashboard-advertisement-published-grid">
            <?php foreach($data['published_ads'] as $published): ?>
            <div class="kal-rental-dashboard-advertisement-published-card">
                <div class="kal-rental-dashboard-advertisement-preview">
                    <img src="<?php echo URLROOT; ?>/images/ads/<?php echo $published['image']; ?>" alt="<?php echo $published['business']; ?> Ad">
                    <div class="kal-rental-dashboard-advertisement-type"><?php echo $published['type']; ?></div>
                </div>
                <div class="kal-rental-dashboard-advertisement-details">
                    <h4><?php echo $published['business']; ?></h4>
                    <p><strong>Service:</strong> <?php echo $published['service_type']; ?></p>
                    <p><strong>Published:</strong> <?php echo $published['published']; ?></p>
                    <p><strong>Expires:</strong> <?php echo $published['expires']; ?></p>
                    <span class="kal-rental-dashboard-advertisement-status-badge kal-rental-dashboard-advertisement-status-active"><?php echo $published['status']; ?></span>
                </div>
                <div class="kal-rental-dashboard-advertisement-actions">
                    <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-sm kal-rental-dashboard-advertisement-btn-view" onclick="viewAdStats(<?php echo $published['id']; ?>)">Stats</button>
                    <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-sm kal-rental-dashboard-advertisement-btn-edit" onclick="editAd(<?php echo $published['id']; ?>)">Edit</button>
                    <button class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-sm kal-rental-dashboard-advertisement-btn-delete" onclick="deleteAd(<?php echo $published['id']; ?>)">Delete</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Publish Ad Modal -->
<div id="publishModal" class="kal-rental-dashboard-advertisement-modal">
    <div class="kal-rental-dashboard-advertisement-modal-content kal-rental-dashboard-advertisement-modal-large">
        <div class="kal-rental-dashboard-advertisement-modal-header">
            <h3>Create New Advertisement</h3>
            <span class="kal-rental-dashboard-advertisement-close" onclick="closePublishModal()">&times;</span>
        </div>
        <div class="kal-rental-dashboard-advertisement-modal-body">
            <form class="kal-rental-dashboard-advertisement-publish-form">
                <div class="kal-rental-dashboard-advertisement-form-row">
                    <div class="kal-rental-dashboard-advertisement-form-group">
                        <label>Business Name</label>
                        <input type="text" name="business" placeholder="e.g., Sports Gear Rentals" required>
                    </div>
                    <div class="kal-rental-dashboard-advertisement-form-group">
                        <label>Service Type</label>
                        <select name="service_type" required>
                            <option value="">Select Service</option>
                            <option value="equipment">Sports Equipment Rental</option>
                            <option value="venue">Venue Rental</option>
                            <option value="gear">Sports Gear Rental</option>
                            <option value="facility">Sports Facility</option>
                            <option value="other">Other Rental Service</option>
                        </select>
                    </div>
                </div>
                
                <div class="kal-rental-dashboard-advertisement-form-group">
                    <label>Advertisement Description</label>
                    <textarea name="description" rows="3" placeholder="Describe your rental service, equipment available, pricing, etc..." required></textarea>
                </div>
                
                <div class="kal-rental-dashboard-advertisement-form-group">
                    <label>Upload Advertisement Banner</label>
                    <div class="kal-rental-dashboard-advertisement-file-upload">
                        <input type="file" accept="image/*" id="adFile">
                        <div class="kal-rental-dashboard-advertisement-upload-preview" id="uploadPreview"></div>
                    </div>
                </div>
                
                <div class="kal-rental-dashboard-advertisement-form-row">
                    <div class="kal-rental-dashboard-advertisement-form-group">
                        <label>Contact URL (Optional)</label>
                        <input type="url" name="contact_url" placeholder="https://your-rental-service.com">
                    </div>
                    <div class="kal-rental-dashboard-advertisement-form-group">
                        <label>Duration</label>
                        <select name="duration" required>
                            <option value="7">7 days</option>
                            <option value="15">15 days</option>
                            <option value="30" selected>30 days</option>
                            <option value="60">60 days</option>
                            <option value="90">90 days</option>
                        </select>
                    </div>
                </div>
                
                <div class="kal-rental-dashboard-advertisement-form-row">
                    <div class="kal-rental-dashboard-advertisement-form-group">
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" required>
                    </div>
                    <div class="kal-rental-dashboard-advertisement-form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" required>
                    </div>
                </div>
                
                <div class="kal-rental-dashboard-advertisement-modal-actions">
                    <button type="button" class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-cancel" onclick="closePublishModal()">Cancel</button>
                    <button type="submit" class="kal-rental-dashboard-advertisement-btn kal-rental-dashboard-advertisement-btn-primary">Submit for Review</button>
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

function deleteAdRequest(id) {
    if(confirm('Are you sure you want to delete this advertisement request?')) {
        alert(`Advertisement request AD${id.toString().padStart(3, '0')} deleted successfully!`);
    }
}

function verifyPayment(id) {
    if(confirm('Has the payment been verified through WhatsApp?')) {
        alert(`Payment verified for AD${id.toString().padStart(3, '0')}`);
    }
}

function publishAd(id) {
    if(confirm('Publish this advertisement now?')) {
        alert(`Advertisement AD${id.toString().padStart(3, '0')} published successfully!`);
    }
}

function viewAdStats(id) {
    alert(`Viewing statistics for advertisement #AD${id.toString().padStart(3, '0')}`);
}

function editAd(id) {
    alert(`Edit advertisement functionality - ID: ${id}`);
}

function deleteAd(id) {
    if(confirm('Are you sure you want to delete this published advertisement?')) {
        alert(`Advertisement deleted: ${id}`);
    }
}
</script>

<?php require APPROOT.'/views/rentalowner/inc/footer.php'; ?>