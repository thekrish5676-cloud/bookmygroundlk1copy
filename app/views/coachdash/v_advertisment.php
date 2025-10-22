<?php require APPROOT . '/views/coachdash/inc/header.php'; ?>

<div class="kal-coach-dashboard-advertisement">
    <div class="kal-coach-dashboard-advertisement-header">
        <h1>Advertisement Management</h1>
        <div class="kal-coach-dashboard-advertisement-header-actions">
            <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-primary" onclick="openPublishModal()">📢 Publish New Ad</button>
        </div>
    </div>

    <!-- Ad Stats -->
    <div class="kal-coach-dashboard-advertisement-stats">
        <div class="kal-coach-dashboard-advertisement-stat-item">
            <div class="kal-coach-dashboard-advertisement-stat-icon">⏳</div>
            <div class="kal-coach-dashboard-advertisement-stat-details">
                <span class="kal-coach-dashboard-advertisement-stat-number"><?php echo count($data['pending_ads']); ?></span>
                <span class="kal-coach-dashboard-advertisement-stat-label">Pending Requests</span>
            </div>
        </div>
        <div class="kal-coach-dashboard-advertisement-stat-item">
            <div class="kal-coach-dashboard-advertisement-stat-icon">✅</div>
            <div class="kal-coach-dashboard-advertisement-stat-details">
                <span class="kal-coach-dashboard-advertisement-stat-number"><?php echo count($data['verified_ads']); ?></span>
                <span class="kal-coach-dashboard-advertisement-stat-label">Verified & Ready</span>
            </div>
        </div>
        <div class="kal-coach-dashboard-advertisement-stat-item">
            <div class="kal-coach-dashboard-advertisement-stat-icon">💰</div>
            <div class="kal-coach-dashboard-advertisement-stat-details">
                <span class="kal-coach-dashboard-advertisement-stat-number">LKR <?php echo number_format($data['monthly_revenue']); ?></span>
                <span class="kal-coach-dashboard-advertisement-stat-label">Monthly Earnings</span>
            </div>
        </div>
        <div class="kal-coach-dashboard-advertisement-stat-item">
            <div class="kal-coach-dashboard-advertisement-stat-icon">📊</div>
            <div class="kal-coach-dashboard-advertisement-stat-details">
                <span class="kal-coach-dashboard-advertisement-stat-number"><?php echo count($data['published_ads']); ?></span>
                <span class="kal-coach-dashboard-advertisement-stat-label">Active Ads</span>
            </div>
        </div>
    </div>

    <!-- Pending Advertisement Requests -->
    <div class="kal-coach-dashboard-advertisement-card">
        <div class="kal-coach-dashboard-advertisement-card-header">
            <h3>My Advertisement Requests</h3>
            <?php $totalRequests = count($data['pending_ads']) + count($data['verified_ads']); ?>
            <span class="kal-coach-dashboard-advertisement-badge kal-coach-dashboard-advertisement-badge-pending"><?php echo $totalRequests; ?> requests</span>
        </div>
        <div class="kal-coach-dashboard-advertisement-table-container">
            <table class="kal-coach-dashboard-advertisement-data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad Title</th>
                        <th>Target Audience</th>
                        <th>Duration</th>
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
                            <strong><?php echo $ad['title']; ?></strong>
                        </td>
                        <td><?php echo $ad['audience']; ?></td>
                        <td><?php echo $ad['duration']; ?> days</td>
                        <td><strong>LKR <?php echo number_format($ad['amount']); ?></strong></td>
                        <td>
                            <span class="kal-coach-dashboard-advertisement-status-badge kal-coach-dashboard-advertisement-status-<?php echo strtolower(str_replace(' ', '-', $ad['status'])); ?>">
                                <?php echo $ad['status']; ?>
                            </span>
                        </td>
                        <td><?php echo $ad['submitted']; ?></td>
                        <td>
                            <div class="kal-coach-dashboard-advertisement-action-buttons">
                                <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-sm kal-coach-dashboard-advertisement-btn-view" onclick="viewAdRequest(<?php echo $ad['id']; ?>)">View</button>
                                <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-sm kal-coach-dashboard-advertisement-btn-delete" onclick="deleteAdRequest(<?php echo $ad['id']; ?>)">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <!-- Verified ads are now shown within My Advertisement Requests with status 'Verified' and a Publish action -->
                    <?php foreach($data['verified_ads'] as $ad): ?>
                    <tr>
                        <td>#AD<?php echo str_pad($ad['id'], 3, '0', STR_PAD_LEFT); ?></td>
                        <td>
                            <strong><?php echo $ad['title']; ?></strong>
                        </td>
                        <td><?php echo $ad['audience']; ?></td>
                        <td><?php echo $ad['duration']; ?> days</td>
                        <td><strong>LKR <?php echo number_format($ad['amount']); ?></strong></td>
                        <td>
                            <span class="kal-coach-dashboard-advertisement-status-badge kal-coach-dashboard-advertisement-status-verified">
                                Verified
                            </span>
                        </td>
                        <td><?php echo $ad['verified_date'] ?? '-'; ?></td>
                        <td>
                            <div class="kal-coach-dashboard-advertisement-action-buttons">
                                <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-sm kal-coach-dashboard-advertisement-btn-view" onclick="viewAdRequest(<?php echo $ad['id']; ?>)">View</button>
                                <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-sm kal-coach-dashboard-advertisement-btn-publish" onclick="publishAd(<?php echo $ad['id']; ?>)">Publish</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Verified ads removed as a separate section; verified items are shown in My Advertisement Requests with Publish action -->

    <!-- Currently Published Ads -->
    <div class="kal-coach-dashboard-advertisement-card">
        <div class="kal-coach-dashboard-advertisement-card-header">
            <h3>My Active Advertisements</h3>
        </div>
        <div class="kal-coach-dashboard-advertisement-published-grid">
            <?php foreach($data['published_ads'] as $published): ?>
            <div class="kal-coach-dashboard-advertisement-published-card">
                <div class="kal-coach-dashboard-advertisement-preview">
                    <img src="<?php echo URLROOT; ?>/images/ads/<?php echo $published['image']; ?>" alt="<?php echo $published['title']; ?>">
                    <div class="kal-coach-dashboard-advertisement-type"><?php echo $published['type']; ?></div>
                </div>
                <div class="kal-coach-dashboard-advertisement-details">
                    <h4><?php echo $published['title']; ?></h4>
                    <p><strong>Target:</strong> <?php echo $published['audience']; ?></p>
                    <p><strong>Published:</strong> <?php echo $published['published']; ?></p>
                    <p><strong>Expires:</strong> <?php echo $published['expires']; ?></p>
                    <span class="kal-coach-dashboard-advertisement-status-badge kal-coach-dashboard-advertisement-status-active"><?php echo $published['status']; ?></span>
                </div>
                <div class="kal-coach-dashboard-advertisement-actions">
                    <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-sm kal-coach-dashboard-advertisement-btn-view" onclick="viewAdStats(<?php echo $published['id']; ?>)">Stats</button>
                    <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-sm kal-coach-dashboard-advertisement-btn-edit" onclick="editAd(<?php echo $published['id']; ?>)">Edit</button>
                    <button class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-sm kal-coach-dashboard-advertisement-btn-delete" onclick="deleteAd(<?php echo $published['id']; ?>)">Delete</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Publish Ad Modal -->
<div id="publishModal" class="kal-coach-dashboard-advertisement-modal">
    <div class="kal-coach-dashboard-advertisement-modal-content kal-coach-dashboard-advertisement-modal-large">
        <div class="kal-coach-dashboard-advertisement-modal-header">
            <h3>Create New Advertisement</h3>
            <span class="kal-coach-dashboard-advertisement-close" onclick="closePublishModal()">&times;</span>
        </div>
        <div class="kal-coach-dashboard-advertisement-modal-body">
            <form class="kal-coach-dashboard-advertisement-publish-form">
                <div class="kal-coach-dashboard-advertisement-form-row">
                    <div class="kal-coach-dashboard-advertisement-form-group">
                        <label>Advertisement Title</label>
                        <input type="text" name="title" placeholder="e.g., Football Coaching Sessions" required>
                    </div>
                    <div class="kal-coach-dashboard-advertisement-form-group">
                        <label>Ad Type</label>
                        <select name="ad_type" required>
                            <option value="">Select Type</option>
                            <option value="coaching">Coaching Service</option>
                            <option value="training">Training Program</option>
                            <option value="workshop">Workshop</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="kal-coach-dashboard-advertisement-form-group">
                    <label>Target Audience</label>
                    <select name="audience" required>
                        <option value="">Select Target Audience</option>
                        <option value="beginners">Beginners</option>
                        <option value="intermediate">Intermediate Players</option>
                        <option value="advanced">Advanced Players</option>
                        <option value="kids">Kids (Under 12)</option>
                        <option value="teens">Teenagers</option>
                        <option value="adults">Adults</option>
                        <option value="all">All Levels</option>
                    </select>
                </div>
                
                <div class="kal-coach-dashboard-advertisement-form-group">
                    <label>Advertisement Content (Description)</label>
                    <textarea name="description" rows="4" placeholder="Describe your coaching service, expertise, and what students can expect..." required></textarea>
                </div>
                
                <div class="kal-coach-dashboard-advertisement-form-group">
                    <label>Upload Advertisement Image/Banner</label>
                    <div class="kal-coach-dashboard-advertisement-file-upload">
                        <input type="file" accept="image/*" id="adFile">
                        <div class="kal-coach-dashboard-advertisement-upload-preview" id="uploadPreview"></div>
                    </div>
                </div>
                
                <div class="kal-coach-dashboard-advertisement-form-row">
                    <div class="kal-coach-dashboard-advertisement-form-group">
                        <label>Contact URL (Optional)</label>
                        <input type="url" name="contact_url" placeholder="https://your-coaching-profile.com">
                    </div>
                    <div class="kal-coach-dashboard-advertisement-form-group">
                        <label>Duration (Days)</label>
                        <select name="duration" required>
                            <option value="7">7 days</option>
                            <option value="15">15 days</option>
                            <option value="30" selected>30 days</option>
                            <option value="60">60 days</option>
                            <option value="90">90 days</option>
                        </select>
                    </div>
                </div>
                
                <div class="kal-coach-dashboard-advertisement-modal-actions">
                    <button type="button" class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-cancel" onclick="closePublishModal()">Cancel</button>
                    <button type="submit" class="kal-coach-dashboard-advertisement-btn kal-coach-dashboard-advertisement-btn-primary">Submit for Review</button>
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

<?php require APPROOT . '/views/coachdash/inc/footer.php'; ?>