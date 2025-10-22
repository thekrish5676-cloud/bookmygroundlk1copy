<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Package Management</h1>
        <div class="header-actions">
            <button class="btn-save-packages" onclick="saveAllPackages()">💾 Save All Changes</button>
            <button class="btn-preview-packages" onclick="previewPackages()">👁️ Preview Public Page</button>
        </div>
    </div>

    <!-- Package Statistics -->
    <div class="package-stats">
        <div class="stat-item">
            <div class="stat-icon">📦</div>
            <div class="stat-details">
                <span class="stat-number">3</span>
                <span class="stat-label">Active Packages</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">👥</div>
            <div class="stat-details">
                <span class="stat-number">45</span>
                <span class="stat-label">Stadium Owners</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">💰</div>
            <div class="stat-details">
                <span class="stat-number">LKR 125,000</span>
                <span class="stat-label">Monthly Revenue</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">📈</div>
            <div class="stat-details">
                <span class="stat-number">18%</span>
                <span class="stat-label">Commission Rate</span>
            </div>
        </div>
    </div>

    <!-- Package Cards Grid -->
    <div class="packages-grid">
        <!-- Basic Package -->
        <div class="package-card basic">
            <div class="package-header">
                <div class="package-title">
                    <input type="text" value="Basic" class="package-name-input" id="basicName">
                    <span class="package-icon">🌟</span>
                </div>
                <div class="package-status">
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    
                </div>
            </div>

            <div class="package-pricing">
                <div class="price-section">
                    <label>Monthly Fee</label>
                    <div class="price-input">
                        <span>LKR</span>
                        <input type="number" value="0" id="basicMonthly">
                    </div>
                </div>
                <div class="price-section">
                    <label>Commission Rate</label>
                    <div class="price-input">
                        <input type="number" value="8" id="basicCommission" min="0" max="100">
                        <span>%</span>
                    </div>
                </div>
            </div>

            <div class="package-features">
                <h4>Package Features</h4>
                
                <div class="feature-group">
                    <label>Stadium Listings Limit</label>
                    <div class="feature-input">
                        <input type="number" value="3" id="basicStadiums" min="1" max="100">
                        <span>stadiums</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Photos per Stadium</label>
                    <div class="feature-input">
                        <input type="number" value="3" id="basicPhotos" min="1" max="20">
                        <span>photos</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Videos per Stadium</label>
                    <div class="feature-input">
                        <input type="number" value="3" id="basicVideos" min="0" max="10">
                        <span>videos</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Featured Listings</label>
                    <div class="feature-input">
                        <input type="number" value="0" id="basicFeatured" min="0" max="10">
                        <span>listings</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Support Level</label>
                    <select id="basicSupport">
                        <option value="email" selected>Email Support</option>
                        <option value="phone">Phone Support</option>
                        <option value="priority">Priority Support</option>
                        <option value="dedicated">Dedicated Manager</option>
                    </select>
                </div>

                <div class="feature-toggles">
                    <div class="feature-toggle">
                        <label>
                            <input type="checkbox" checked>
                            <span>Booking Management</span>
                        </label>
                    </div>
                    <div class="feature-toggle">
                        <label>
                            <input type="checkbox" checked>
                            <span>Payment Processing</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="package-description">
                <label>Package Description</label>
                <textarea placeholder="Enter package description...">Perfect for getting started with stadium rentals</textarea>
            </div>
        </div>

        <!-- Standard Package -->
        <div class="package-card standard popular">
           
            <div class="package-header">
                <div class="package-title">
                    <input type="text" value="Standard" class="package-name-input" id="standardName">
                    <span class="package-icon">⚡</span>
                </div>
                <div class="package-status">
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    
                </div>
            </div>

            <div class="package-pricing">
                <div class="price-section">
                    <label>Monthly Fee</label>
                    <div class="price-input">
                        <span>LKR</span>
                        <input type="number" value="0" id="standardMonthly">
                    </div>
                </div>
                <div class="price-section">
                    <label>Commission Rate</label>
                    <div class="price-input">
                        <input type="number" value="12" id="standardCommission" min="0" max="100">
                        <span>%</span>
                    </div>
                </div>
            </div>

            <div class="package-features">
                <h4>Package Features</h4>
                
                <div class="feature-group">
                    <label>Stadium Listings Limit</label>
                    <div class="feature-input">
                        <input type="number" value="6" id="standardStadiums" min="1" max="100">
                        <span>stadiums</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Photos per Stadium</label>
                    <div class="feature-input">
                        <input type="number" value="5" id="standardPhotos" min="1" max="20">
                        <span>photos</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Videos per Stadium</label>
                    <div class="feature-input">
                        <input type="number" value="5" id="standardVideos" min="0" max="10">
                        <span>videos</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Featured Listings</label>
                    <div class="feature-input">
                        <input type="number" value="3" id="standardFeatured" min="0" max="10">
                        <span>listings</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Support Level</label>
                    <select id="standardSupport">
                        <option value="email">Email Support</option>
                        <option value="phone" selected>Phone Support</option>
                        <option value="priority">Priority Support</option>
                        <option value="dedicated">Dedicated Manager</option>
                    </select>
                </div>

                <div class="feature-toggles">
                    <div class="feature-toggle">
                        <label>
                            <input type="checkbox" checked>
                            <span>Booking Management</span>
                        </label>
                    </div>
                    <div class="feature-toggle">
                        <label>
                            <input type="checkbox" checked>
                            <span>Payment Processing</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="package-description">
                <label>Package Description</label>
                <textarea placeholder="Enter package description...">Ideal for growing stadium businesses</textarea>
            </div>
        </div>

        <!-- Gold Package -->
        <div class="package-card gold premium">
            
            <div class="package-header">
                <div class="package-title">
                    <input type="text" value="Gold" class="package-name-input" id="goldName">
                    <span class="package-icon">👑</span>
                </div>
                <div class="package-status">
                    <label class="toggle-switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                    
                </div>
            </div>

            <div class="package-pricing">
                <div class="price-section">
                    <label>Monthly Fee</label>
                    <div class="price-input">
                        <span>LKR</span>
                        <input type="number" value="0" id="goldMonthly">
                    </div>
                </div>
                <div class="price-section">
                    <label>Commission Rate</label>
                    <div class="price-input">
                        <input type="number" value="20" id="goldCommission" min="0" max="100">
                        <span>%</span>
                    </div>
                </div>
            </div>

            <div class="package-features">
                <h4>Package Features</h4>
                
                <div class="feature-group">
                    <label>Stadium Listings Limit</label>
                    <div class="feature-input unlimited">
                        <label class="unlimited-toggle">
                            <input type="checkbox" checked onchange="toggleUnlimited(this, 'goldStadiums')">
                            <span>Unlimited</span>
                        </label>
                        <input type="number" value="999" id="goldStadiums" min="1" max="999" disabled>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Photos per Stadium</label>
                    <div class="feature-input">
                        <input type="number" value="10" id="goldPhotos" min="1" max="20">
                        <span>photos</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Videos per Stadium</label>
                    <div class="feature-input">
                        <input type="number" value="5" id="goldVideos" min="0" max="10">
                        <span>videos</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Featured Listings</label>
                    <div class="feature-input">
                        <input type="number" value="5" id="goldFeatured" min="0" max="10">
                        <span>listings</span>
                    </div>
                </div>

                <div class="feature-group">
                    <label>Support Level</label>
                    <select id="goldSupport">
                        <option value="email">Email Support</option>
                        <option value="phone">Phone Support</option>
                        <option value="priority" selected>Priority Support</option>
                        <option value="dedicated">Dedicated Manager</option>
                    </select>
                </div>

                <div class="feature-toggles">
                    <div class="feature-toggle">
                        <label>
                            <input type="checkbox" checked>
                            <span>Booking Management</span>
                        </label>
                    </div>
                    <div class="feature-toggle">
                        <label>
                            <input type="checkbox" checked>
                            <span>Payment Processing</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="package-description">
                <label>Package Description</label>
                <textarea placeholder="Enter package description...">For established stadium owners who want maximum exposure</textarea>
            </div>
        </div>
    </div>

   
    <!-- Current Package Usage -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Current Package Distribution</h3>
        </div>
        <div class="package-usage">
            <div class="usage-chart">
                <div class="usage-item">
                    <div class="usage-info">
                        <span class="package-name">Basic Package</span>
                        <span class="usage-count">25 users (55%)</span>
                    </div>
                    <div class="usage-bar">
                        <div class="usage-fill basic" style="width: 55%"></div>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-info">
                        <span class="package-name">Standard Package</span>
                        <span class="usage-count">15 users (33%)</span>
                    </div>
                    <div class="usage-bar">
                        <div class="usage-fill standard" style="width: 33%"></div>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-info">
                        <span class="package-name">Gold Package</span>
                        <span class="usage-count">5 users (12%)</span>
                    </div>
                    <div class="usage-bar">
                        <div class="usage-fill gold" style="width: 12%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function saveAllPackages() {
    // Collect all package data
    const packages = {
        basic: gatherPackageData('basic'),
        standard: gatherPackageData('standard'),
        gold: gatherPackageData('gold')
    };
    
    console.log('Saving packages:', packages);
    alert('All package changes saved successfully!');
    // Here you would make AJAX call to save data
}

function gatherPackageData(packageType) {
    return {
        name: document.getElementById(packageType + 'Name').value,
        monthly_fee: document.getElementById(packageType + 'Monthly').value,
        commission: document.getElementById(packageType + 'Commission').value,
        stadiums_limit: document.getElementById(packageType + 'Stadiums').value,
        photos_limit: document.getElementById(packageType + 'Photos').value,
        videos_limit: document.getElementById(packageType + 'Videos').value,
        featured_limit: document.getElementById(packageType + 'Featured').value,
        support_level: document.getElementById(packageType + 'Support').value
    };
}

function toggleUnlimited(checkbox, inputId) {
    const input = document.getElementById(inputId);
    if (checkbox.checked) {
        input.disabled = true;
        input.value = 999;
        input.parentElement.classList.add('unlimited-active');
    } else {
        input.disabled = false;
        input.value = 10;
        input.parentElement.classList.remove('unlimited-active');
    }
}

function previewPackages() {
    window.open('<?php echo URLROOT; ?>/pricing', '_blank');
}

function editComparisonTable() {
    alert('Comparison table editor will open');
    // Here you would open a modal to edit the comparison table
}

// Auto-save functionality
document.querySelectorAll('input, select, textarea').forEach(element => {
    element.addEventListener('change', function() {
        // Visual indication of unsaved changes
        document.querySelector('.btn-save-packages').style.background = '#ff9800';
        document.querySelector('.btn-save-packages').textContent = '💾 Unsaved Changes';
    });
});

// Real-time preview updates
document.querySelectorAll('.package-name-input').forEach(input => {
    input.addEventListener('input', function() {
        // Update comparison table in real-time
        updateComparisonTable();
    });
});

function updateComparisonTable() {
    // Update the comparison table based on current values
    console.log('Updating comparison table...');
}
</script>

<style>
.package-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-item {
    background: #000000ec;
    padding: 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-icon {
    font-size: 32px;
    width: 60px;
    height: 60px;
    background: rgba(3, 178, 0, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-details {
    display: flex;
    flex-direction: column;
}

.stat-number {
    font-size: 24px;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 5px;
}

.stat-label {
    color: #ffffff;
    font-size: 14px;
}

.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.package-card {
    background: #000000ec;
    border-radius: 16px;
    padding: 30px;
    position: relative;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.package-card.basic {
    border-color: #6c757d;
}

.package-card.standard {
    border-color: #007bff;
}

.package-card.gold {
    border-color: #ffc107;
}

.popular-badge, .premium-badge {
    position: absolute;
    top: -10px;
    right: 20px;
    background: #007bff;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.premium-badge {
    background: #ffc107;
    color: #000;
}

.package-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.package-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

.package-name-input {
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 24px;
    font-weight: bold;
    width: auto;
    min-width: 80px;
}

.package-name-input:focus {
    outline: 1px solid #007bff;
    border-radius: 4px;
    padding: 5px;
}

.package-icon {
    font-size: 28px;
}

.package-status {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #ffffff;
    font-size: 14px;
}

.toggle-switch {
    position: relative;
    width: 50px;
    height: 24px;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 24px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #03B200;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.package-pricing {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.price-section label {
    display: block;
    color: #ffffff;
    font-size: 14px;
    margin-bottom: 8px;
    font-weight: 500;
}

.price-input {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #1a1a1a;
    border-radius: 8px;
    padding: 12px;
}

.price-input input {
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    width: 100%;
    outline: none;
}

.price-input span {
    color: #03B200;
    font-weight: bold;
}

.package-features h4 {
    color: #ffffff;
    margin-bottom: 20px;
    font-size: 18px;
}

.feature-group {
    margin-bottom: 20px;
}

.feature-group label {
    display: block;
    color: #ffffff;
    font-size: 14px;
    margin-bottom: 8px;
    font-weight: 500;
}

.feature-input {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #1a1a1a;
    border-radius: 8px;
    padding: 12px;
}

.feature-input input, .feature-input select {
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 14px;
    outline: none;
    flex: 1;
}

.feature-input span {
    color: #666;
    font-size: 12px;
}

.feature-input.unlimited {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
}

.unlimited-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #ffffff;
    cursor: pointer;
}

.unlimited-toggle input {
    width: 16px;
    height: 16px;
}

.feature-input.unlimited-active input[type="number"] {
    opacity: 0.5;
}

.feature-toggles {
    margin-top: 20px;
}

.feature-toggle {
    margin-bottom: 12px;
}

.feature-toggle label {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #ffffff;
    cursor: pointer;
    margin-bottom: 0;
}

.feature-toggle input {
    width: 16px;
    height: 16px;
}

.package-description {
    margin-top: 25px;
}

.package-description label {
    display: block;
    color: #ffffff;
    font-size: 14px;
    margin-bottom: 8px;
    font-weight: 500;
}

.package-description textarea {
    width: 100%;
    background: #1a1a1a;
    border: none;
    border-radius: 8px;
    padding: 12px;
    color: #ffffff;
    font-size: 14px;
    resize: vertical;
    min-height: 80px;
    outline: none;
}

.dashboard-card {
    background: #000000ec;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 30px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #333;
}

.card-header h3 {
    color: #ffffff;
    margin: 0;
    font-size: 20px;
}

.comparison-table-container {
    overflow-x: auto;
}

.comparison-table {
    width: 100%;
    border-collapse: collapse;
    background: #1a1a1a;
    border-radius: 12px;
    overflow: hidden;
}

.comparison-table th,
.comparison-table td {
    padding: 15px 20px;
    text-align: left;
    border-bottom: 1px solid #333;
}

.comparison-table th {
    background: #2a2a2a;
    color: #ffffff;
    font-weight: bold;
}

.comparison-table td {
    color: #ffffff;
}

.comparison-table tr:last-child td {
    border-bottom: none;
}

.package-usage {
    margin-top: 20px;
}

.usage-chart {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.usage-item {
    display: flex;
    align-items: center;
    gap: 20px;
}

.usage-info {
    display: flex;
    flex-direction: column;
    min-width: 200px;
}

.package-name {
    color: #ffffff;
    font-weight: bold;
    font-size: 16px;
}

.usage-count {
    color: #666;
    font-size: 14px;
}

.usage-bar {
    flex: 1;
    height: 8px;
    background: #333;
    border-radius: 4px;
    overflow: hidden;
}

.usage-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.3s ease;
}

.usage-fill.basic {
    background: #6c757d;
}

.usage-fill.standard {
    background: #007bff;
}

.usage-fill.gold {
    background: #ffc107;
}

.btn-save-packages, .btn-preview-packages {
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-save-packages {
    background: #03B200;
    color: white;
    margin-right: 10px;
}

.btn-save-packages:hover {
    background: #029800;
    transform: translateY(-2px);
}

.btn-preview-packages {
    background: #17a2b8;
    color: white;
}

.btn-preview-packages:hover {
    background: #138496;
    transform: translateY(-2px);
}

.btn-edit-comparison {
    background: #6c757d;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-edit-comparison:hover {
    background: #5a6268;
}

@media (max-width: 1200px) {
    .packages-grid {
        grid-template-columns: 1fr;
    }
    
    .package-pricing {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .package-stats {
        grid-template-columns: 1fr;
    }
    
    .dashboard-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .btn-save-packages, .btn-preview-packages {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .usage-item {
        flex-direction: column;
        gap: 10px;
    }
    
    .usage-info {
        min-width: auto;
        width: 100%;
    }
}
</style>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>