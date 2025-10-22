<?php require APPROOT.'/views/rentalowner/inc/header.php'; ?>
<div class="kala-rental-dash-main-content">
    <!-- Dashboard Header -->
    <div class="kala-rental-dash-dashboard-header">
        <h1>Dashboard Overview</h1>
        <div class="kala-rental-dash-date-range">
            <span>📅 <?php echo date('F j, Y'); ?></span>
        </div>
    </div>

    <!-- Stats Cards --> 
    <div class="kala-rental-dash-stats-grid">
        <div class="kala-rental-dash-stat-card">
            <div class="kala-rental-dash-stat-icon">🏬</div>
            <div class="kala-rental-dash-stat-info">
                <h3>4</h3>
                <p>Total Shops register</p>
            </div>
        </div>
        
        <div class="kala-rental-dash-stat-card">
            <div class="kala-rental-dash-stat-icon">📢</div>
            <div class="kala-rental-dash-stat-info">
                <h3>3</h3>
                <p>Total ads posted</p>
            </div>
        </div>
    </div>
</div>

<script>
function publishPendingAds() {
    if(confirm('Are you sure you want to publish all ready advertisements?')) {
        alert('Publishing 2 pending advertisements...');
        // Here you would make an AJAX call to publish the ads
        setTimeout(() => {
            alert('Advertisements published successfully!');
            location.reload();
        }, 1500);
    }
}

// Auto-refresh advertisement data every 2 minutes
setInterval(function() {
    if (window.location.pathname.includes('/admin') && 
        !window.location.pathname.includes('/admin/login')) {
        // This would be replaced with actual AJAX call to refresh ad data
        console.log('Refreshing advertisement data...');
    }
}, 120000); // 2 minutes
</script>
<?php require APPROOT.'/views/rentalowner/inc/footer.php'; ?>