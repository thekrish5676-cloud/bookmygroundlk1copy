<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Booking Management</h1>
        <div class="header-actions">
            <button class="btn-export">📊 Export Data</button>
        </div>
    </div>

    <!-- Booking Stats -->
    <div class="booking-stats">
        <div class="stat-item">
            <div class="stat-icon">✅</div>
            <div class="stat-details">
                <span class="stat-number">287</span>
                <span class="stat-label">Completed</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">⏳</div>
            <div class="stat-details">
                <span class="stat-number">43</span>
                <span class="stat-label">Pending</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">❌</div>
            <div class="stat-details">
                <span class="stat-number">12</span>
                <span class="stat-label">Cancelled</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">💰</div>
            <div class="stat-details">
                <span class="stat-number">LKR 1.2M</span>
                <span class="stat-label">Total Revenue</span>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <div class="filter-group">
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="cancelled">Cancelled</option>
                <option value="refunded">Refunded</option>
            </select>
        </div>
        <div class="filter-group">
            <select class="filter-select" id="dateFilter">
                <option value="">All Time</option>
                <option value="today">Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
                <option value="custom">Custom Range</option>
            </select>
        </div>
        <div class="filter-group">
            <input type="text" class="search-input" placeholder="Search bookings..." id="bookingSearch">
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>All Bookings</h3>
            <span class="total-count">342 total bookings</span>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Stadium</th>
                        <th>Customer</th>
                        <th>Date & Time</th>
                        <th>Duration</th>
                        <th>Amount</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($data['bookings'])): ?>
                        <?php foreach($data['bookings'] as $booking): ?>
                        <tr>
                            <td>#BK<?php echo str_pad($booking['id'], 4, '0', STR_PAD_LEFT); ?></td>
                            <td>
                                <div class="stadium-info">
                                    <strong><?php echo $booking['stadium']; ?></strong>
                                    <small>Court 1</small>
                                </div>
                            </td>
                            <td><?php echo $booking['customer']; ?></td>
                            <td>
                                <div class="datetime-info">
                                    <strong><?php echo $booking['date']; ?></strong>
                                    <small>2:00 PM - 4:00 PM</small>
                                </div>
                            </td>
                            <td>2 hours</td>
                            <td>LKR <?php echo number_format($booking['amount']); ?></td>
                            <td>LKR <?php echo number_format($booking['amount'] * 0.2); ?></td>
                            <td>
                                <span class="status-badge <?php echo strtolower($booking['status']); ?>">
                                    <?php echo $booking['status']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-view" onclick="viewBooking(<?php echo $booking['id']; ?>)">View</button>
                                    <button class="btn-action-sm btn-refund" onclick="processRefund(<?php echo $booking['id']; ?>)">Refund</button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Sample data for demo -->
                        <tr>
                            <td>#BK0001</td>
                            <td>
                                <div class="stadium-info">
                                    <strong>Colombo Cricket Ground</strong>
                                    <small>Main Field</small>
                                </div>
                            </td>
                            <td>John Doe</td>
                            <td>
                                <div class="datetime-info">
                                    <strong>2025-08-19</strong>
                                    <small>2:00 PM - 4:00 PM</small>
                                </div>
                            </td>
                            <td>2 hours</td>
                            <td>LKR 5,000</td>
                            <td>LKR 1,000</td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-view">View</button>
                                    <button class="btn-action-sm btn-refund">Refund</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#BK0002</td>
                            <td>
                                <div class="stadium-info">
                                    <strong>Football Arena Pro</strong>
                                    <small>Field A</small>
                                </div>
                            </td>
                            <td>Jane Smith</td>
                            <td>
                                <div class="datetime-info">
                                    <strong>2025-08-20</strong>
                                    <small>6:00 PM - 8:00 PM</small>
                                </div>
                            </td>
                            <td>2 hours</td>
                            <td>LKR 7,500</td>
                            <td>LKR 1,500</td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-view">View</button>
                                    <button class="btn-action-sm btn-approve">Approve</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#BK0003</td>
                            <td>
                                <div class="stadium-info">
                                    <strong>Tennis Academy Courts</strong>
                                    <small>Court 3</small>
                                </div>
                            </td>
                            <td>Mike Wilson</td>
                            <td>
                                <div class="datetime-info">
                                    <strong>2025-08-18</strong>
                                    <small>10:00 AM - 12:00 PM</small>
                                </div>
                            </td>
                            <td>2 hours</td>
                            <td>LKR 2,500</td>
                            <td>LKR 500</td>
                            <td><span class="status-badge refunded">Refunded</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action-sm btn-view">View</button>
                                    <button class="btn-action-sm btn-receipt">Receipt</button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Recent Activity</h3>
        </div>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon completed">✅</div>
                <div class="activity-details">
                    <p><strong>Booking #BK0045</strong> completed at Colombo Cricket Ground</p>
                    <small>2 minutes ago</small>
                </div>
                <div class="activity-amount">+LKR 1,000</div>
            </div>
            <div class="activity-item">
                <div class="activity-icon pending">⏳</div>
                <div class="activity-details">
                    <p><strong>New booking #BK0046</strong> pending approval</p>
                    <small>5 minutes ago</small>
                </div>
                <div class="activity-amount">LKR 3,500</div>
            </div>
            <div class="activity-item">
                <div class="activity-icon refund">💸</div>
                <div class="activity-details">
                    <p><strong>Refund processed</strong> for booking #BK0032</p>
                    <small>15 minutes ago</small>
                </div>
                <div class="activity-amount">-LKR 800</div>
            </div>
        </div>
    </div>
</div>

<!-- Booking Details Modal -->
<div id="bookingModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Booking Details</h3>
            <span class="close" onclick="closeBookingModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="booking-details">
                <div class="detail-row">
                    <label>Booking ID:</label>
                    <span>#BK0001</span>
                </div>
                <div class="detail-row">
                    <label>Stadium:</label>
                    <span>Colombo Cricket Ground</span>
                </div>
                <div class="detail-row">
                    <label>Customer:</label>
                    <span>John Doe (john@example.com)</span>
                </div>
                <div class="detail-row">
                    <label>Date & Time:</label>
                    <span>2025-08-19, 2:00 PM - 4:00 PM</span>
                </div>
                <div class="detail-row">
                    <label>Total Amount:</label>
                    <span>LKR 5,000</span>
                </div>
                <div class="detail-row">
                    <label>Admin Commission:</label>
                    <span>LKR 1,000 (20%)</span>
                </div>
                <div class="detail-row">
                    <label>Stadium Owner Payout:</label>
                    <span>LKR 4,000</span>
                </div>
                <div class="detail-row">
                    <label>Payment Status:</label>
                    <span class="status-badge completed">Paid</span>
                </div>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeBookingModal()">Close</button>
            <button class="btn-refund-process">Process Refund</button>
        </div>
    </div>
</div>

<script>
function viewBooking(id) {
    document.getElementById('bookingModal').style.display = 'block';
}

function closeBookingModal() {
    document.getElementById('bookingModal').style.display = 'none';
}

function processRefund(id) {
    if(confirm('Are you sure you want to process refund for booking #' + id + '?')) {
        alert('Refund processed for booking #' + id);
        // Here you would make an AJAX call to process the refund
    }
}

// Filter functionality
document.getElementById('statusFilter').addEventListener('change', function() {
    const status = this.value;
    // Filter table rows based on status
    console.log('Filtering by status:', status);
});

document.getElementById('dateFilter').addEventListener('change', function() {
    const dateRange = this.value;
    // Filter table rows based on date range
    console.log('Filtering by date:', dateRange);
});

document.getElementById('bookingSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    // Search through table rows
    console.log('Searching for:', searchTerm);
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('bookingModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Export functionality
document.querySelector('.btn-export').addEventListener('click', function() {
    alert('Export functionality will be implemented');
});
</script>