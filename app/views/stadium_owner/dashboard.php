<?php require APPROOT.'/views/stadium_owner/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Stadium Owner Dashboard</h1>
        <div class="welcome-message">
            <p>Welcome back, <?php echo $data['user_first_name']; ?>! Here's your business overview.</p>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">🏟️</div>
            <div class="stat-info">
                <h3><?php echo $data['stats']['total_properties']; ?></h3>
                <p>Total Properties</p>
                <span class="stat-change positive">+2 this month</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-info">
                <h3><?php echo $data['stats']['active_bookings']; ?></h3>
                <p>Active Bookings</p>
                <span class="stat-change positive">+15% from last week</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info">
                <h3>LKR <?php echo number_format($data['stats']['monthly_revenue']); ?></h3>
                <p>Monthly Revenue</p>
                <span class="stat-change positive">+18% from last month</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <h3><?php echo $data['stats']['total_customers']; ?></h3>
                <p>Total Customers</p>
                <span class="stat-change positive">+5 new this week</span>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="secondary-stats">
        <div class="stat-item">
            <div class="stat-label">Occupancy Rate</div>
            <div class="stat-value"><?php echo $data['stats']['occupancy_rate']; ?>%</div>
            <div class="stat-bar">
                <div class="stat-fill" style="width: <?php echo $data['stats']['occupancy_rate']; ?>%"></div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-label">Average Rating</div>
            <div class="stat-value"><?php echo $data['stats']['average_rating']; ?> ⭐</div>
            <div class="stat-bar">
                <div class="stat-fill" style="width: <?php echo ($data['stats']['average_rating'] / 5) * 100; ?>%"></div>
            </div>
        </div>
    </div>

    <!-- Dashboard Content Grid -->
    <div class="dashboard-grid">
        <!-- Recent Bookings -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Recent Bookings</h3>
                <a href="<?php echo URLROOT; ?>/stadium_owner/bookings" class="view-all">View All →</a>
            </div>
            <div class="recent-bookings">
                <?php foreach($data['recent_bookings'] as $booking): ?>
                <div class="booking-item">
                    <div class="booking-info">
                        <h4><?php echo $booking['customer']; ?></h4>
                        <p class="booking-property"><?php echo $booking['property']; ?></p>
                        <p class="booking-time"><?php echo $booking['date']; ?> • <?php echo $booking['time']; ?></p>
                    </div>
                    <div class="booking-amount">
                        <span class="amount">LKR <?php echo number_format($booking['amount']); ?></span>
                        <span class="status-badge <?php echo strtolower($booking['status']); ?>">
                            <?php echo $booking['status']; ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Upcoming Schedule */
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Upcoming Schedule</h3>
                <span class="schedule-count"><?php echo count($data['upcoming_schedules']); ?> upcoming</span>
            </div>
            <div class="schedule-list">
                <?php foreach($data['upcoming_schedules'] as $schedule): ?>
                <div class="schedule-item">
                    <div class="schedule-date">
                        <span class="day"><?php echo $schedule['date']; ?></span>
                        <span class="month"><?php echo $schedule['month']; ?></span>
                    </div>
                    <div class="schedule-details">
                        <h4><?php echo $schedule['property']; ?></h4>
                        <p class="customer"><?php echo $schedule['customer']; ?></p>
                        <p class="time"><?php echo $schedule['time']; ?></p>
                    </div>
                    <div class="schedule-status">
                        <span class="status-badge <?php echo strtolower($schedule['status']); ?>">
                            <?php echo $schedule['status']; ?>
                        </span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Revenue Overview -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Revenue Overview</h3>
                <a href="<?php echo URLROOT; ?>/stadium_owner/revenue" class="view-all">View Details →</a>
            </div>
            <div class="revenue-content">
                <div class="revenue-comparison">
                    <div class="revenue-item">
                        <div class="revenue-label">This Month</div>
                        <div class="revenue-value">LKR <?php echo number_format($data['revenue_overview']['this_month']); ?></div>
                    </div>
                    <div class="revenue-growth">
                        <div class="growth-indicator positive">
                            +<?php echo $data['revenue_overview']['growth_percentage']; ?>%
                        </div>
                        <small>vs last month</small>
                    </div>
                    <div class="revenue-item">
                        <div class="revenue-label">Last Month</div>
                        <div class="revenue-value">LKR <?php echo number_format($data['revenue_overview']['last_month']); ?></div>
                    </div>
                </div>
                
                <div class="payout-info">
                    <div class="payout-item">
                        <div class="payout-label">Pending Payout</div>
                        <div class="payout-value">LKR <?php echo number_format($data['revenue_overview']['pending_payouts']); ?></div>
                    </div>
                    <div class="payout-item">
                        <div class="payout-label">Next Payout Date</div>
                        <div class="payout-date"><?php echo $data['revenue_overview']['next_payout_date']; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Summary -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Property Summary</h3>
                <a href="<?php echo URLROOT; ?>/stadium_owner/properties" class="view-all">Manage →</a>
            </div>
            <div class="property-summary">
                <div class="property-stats">
                    <div class="property-stat">
                        <span class="stat-number"><?php echo $data['property_summary']['total_properties']; ?></span>
                        <span class="stat-label">Total Properties</span>
                    </div>
                    <div class="property-stat">
                        <span class="stat-number"><?php echo $data['property_summary']['active_properties']; ?></span>
                        <span class="stat-label">Active</span>
                    </div>
                    <div class="property-stat">
                        <span class="stat-number"><?php echo $data['property_summary']['under_maintenance']; ?></span>
                        <span class="stat-label">Maintenance</span>
                    </div>
                </div>

                <div class="package-limits">
                    <div class="limit-info">
                        <span>Package: <?php echo $data['property_summary']['package_type']; ?></span>
                        <span><?php echo $data['property_summary']['total_properties']; ?>/<?php echo $data['property_summary']['properties_limit']; ?></span>
                    </div>
                    <div class="limit-bar">
                        <div class="limit-fill" style="width: <?php echo ($data['property_summary']['total_properties'] / $data['property_summary']['properties_limit']) * 100; ?>%"></div>
                    </div>
                    <?php if($data['property_summary']['can_add_more']): ?>
                        <a href="<?php echo URLROOT; ?>/stadium_owner/add_property" class="btn-add-property">Add New Property</a>
                    <?php else: ?>
                        <span class="limit-reached">Property limit reached. Upgrade package to add more.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Package Information -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Package Information</h3>
                <a href="<?php echo URLROOT; ?>/pricing" class="view-all">Upgrade →</a>
            </div>
            <div class="package-info-content">
                <div class="current-package">
                    <h4><?php echo $data['package_info']['package_name']; ?> Package</h4>
                    <p class="commission-rate">Commission Rate: <?php echo $data['package_info']['commission_rate']; ?>%</p>
                </div>
                
                <div class="package-features">
                    <div class="feature-item">
                        <span class="feature-label">Properties Limit:</span>
                        <span class="feature-value"><?php echo $data['package_info']['properties_limit']; ?></span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-label">Photos per Property:</span>
                        <span class="feature-value"><?php echo $data['package_info']['photos_limit']; ?></span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-label">Videos per Property:</span>
                        <span class="feature-value"><?php echo $data['package_info']['videos_limit']; ?></span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-label">Featured Listings:</span>
                        <span class="feature-value"><?php echo $data['package_info']['featured_listings']; ?></span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-label">Support:</span>
                        <span class="feature-value"><?php echo $data['package_info']['support_type']; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Recent Activity</h3>
            </div>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon booking">📅</div>
                    <div class="activity-details">
                        <p><strong>New booking</strong> from Krishna Wishvajith</p>
                        <small>Colombo Cricket Ground - 2 hours ago</small>
                    </div>
                    <div class="activity-amount">+LKR 5,000</div>
                </div>
                <div class="activity-item">
                    <div class="activity-details">
                        <p><strong>Message received</strong> from Kulakshi Thathsarani</p>
                        <small>About Football Arena Pro - 5 hours ago</small>
                    </div>
                    <div class="activity-badge">New</div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon payout">💰</div>
                    <div class="activity-details">
                        <p><strong>Payout processed</strong></p>
                        <small>Monthly earnings - Yesterday</small>
                    </div>
                    <div class="activity-amount">+LKR 38,000</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh dashboard data every 2 minutes
setInterval(function() {
    if (window.location.pathname.includes('/stadium_owner') && 
        !window.location.pathname.includes('/stadium_owner/login')) {
        // This would be replaced with actual AJAX call to refresh data
        console.log('Refreshing stadium owner dashboard data...');
    }
}, 120000); // 2 minutes

// Interactive elements
document.addEventListener('DOMContentLoaded', function() {
    // Animate stat cards on load
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Add click handlers for booking items
    const bookingItems = document.querySelectorAll('.booking-item');
    bookingItems.forEach(item => {
        item.addEventListener('click', function() {
            // Navigate to booking details
            alert('Navigate to booking details');
        });
    });
});
</script>

<?php require APPROOT.'/views/stadium_owner/inc/footer.php'; ?>