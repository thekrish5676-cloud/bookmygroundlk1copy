<?php require APPROOT.'/views/stadium_owner/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Booking Management</h1>
        <div class="header-actions">
            <button class="btn-export" onclick="exportBookings()">📊 Export Data</button>
            <button class="btn-calendar-view" onclick="toggleCalendarView()">📅 Calendar View</button>
        </div>
    </div>

    <!-- Booking Stats -->
    <div class="booking-stats">
        <div class="stat-item">
            <div class="stat-icon">✅</div>
            <div class="stat-details">
                <span class="stat-number"><?php echo $data['booking_stats']['confirmed'] ?? 67; ?></span>
                <span class="stat-label">Confirmed</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">⏳</div>
            <div class="stat-details">
                <span class="stat-number"><?php echo $data['booking_stats']['pending'] ?? 8; ?></span>
                <span class="stat-label">Pending</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🏃‍♂️</div>
            <div class="stat-details">
                <span class="stat-number"><?php echo $data['booking_stats']['today'] ?? 3; ?></span>
                <span class="stat-label">Today</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">💰</div>
            <div class="stat-details">
                <span class="stat-number">LKR <?php echo number_format($data['booking_stats']['revenue'] ?? 125000); ?></span>
                <span class="stat-label">This Month</span>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="booking-filters">
        <div class="filter-group">
            <select class="filter-select" id="propertyFilter">
                <option value="">All Properties</option>
                <option value="cricket-ground">Colombo Cricket Ground</option>
                <option value="football-arena">Football Arena Pro</option>
                <option value="tennis-courts">Tennis Academy Courts</option>
            </select>
        </div>
        <div class="filter-group">
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="confirmed">Confirmed</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <div class="filter-group">
            <select class="filter-select" id="dateFilter">
                <option value="">All Time</option>
                <option value="today">Today</option>
                <option value="tomorrow">Tomorrow</option>
                <option value="this-week">This Week</option>
                <option value="next-week">Next Week</option>
                <option value="this-month">This Month</option>
            </select>
        </div>
        <div class="filter-group">
            <input type="text" class="search-input" placeholder="Search customer name..." id="customerSearch">
        </div>
    </div>

    <!-- Quick Actions Bar -->
    <div class="quick-actions-bar">
        <div class="action-item">
            <span class="action-label">Quick Actions:</span>
        </div>
        <div class="action-item">
            <button class="quick-action-btn" onclick="approveAllPending()">
                <span class="action-icon">✅</span>
                Approve All Pending
            </button>
        </div>
        <div class="action-item">
            <button class="quick-action-btn" onclick="sendReminders()">
                <span class="action-icon">📱</span>
                Send Reminders
            </button>
        </div>
        <div class="action-item">
            <button class="quick-action-btn" onclick="blockTimeSlot()">
                <span class="action-icon">🚫</span>
                Block Time Slot
            </button>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>All Bookings</h3>
            <span class="total-count"><?php echo count($data['all_bookings']); ?> total bookings</span>
        </div>
        <div class="table-container">
            <table class="data-table" id="bookingsTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>Booking ID</th>
                        <th>Property</th>
                        <th>Customer</th>
                        <th>Date & Time</th>
                        <th>Duration</th>
                        <th>Amount</th>
                        <th>Commission</th>
                        <th>Your Earnings</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['all_bookings'] as $booking): ?>
                    <tr class="booking-row" data-status="<?php echo strtolower($booking['status']); ?>">
                        <td>
                            <input type="checkbox" class="booking-checkbox" value="<?php echo $booking['id']; ?>">
                        </td>
                        <td>
                            <span class="booking-id">#<?php echo $booking['id']; ?></span>
                        </td>
                        <td>
                            <div class="property-cell">
                                <div class="property-info">
                                    <strong><?php echo $booking['property']; ?></strong>
                                    <small>Court 1</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="customer-cell">
                                <div class="customer-avatar"><?php echo substr($booking['customer'], 0, 1); ?></div>
                                <div class="customer-info">
                                    <strong><?php echo $booking['customer']; ?></strong>
                                    <small>+94 71 234 5678</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="datetime-info">
                                <strong><?php echo $booking['date']; ?></strong>
                                <small><?php echo $booking['time']; ?></small>
                            </div>
                        </td>
                        <td>
                            <span class="duration-badge"><?php echo $booking['duration']; ?></span>
                        </td>
                        <td>
                            <span class="amount-total">LKR <?php echo number_format($booking['amount']); ?></span>
                        </td>
                        <td>
                            <span class="commission-amount">LKR <?php echo number_format($booking['commission']); ?></span>
                            <small class="commission-rate">(12%)</small>
                        </td>
                        <td>
                            <span class="earnings-amount">LKR <?php echo number_format($booking['net_amount']); ?></span>
                        </td>
                        <td>
                            <span class="status-badge <?php echo strtolower($booking['status']); ?>">
                                <?php echo $booking['status']; ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action-sm btn-view" onclick="viewBookingDetails('<?php echo $booking['id']; ?>')">
                                    View
                                </button>
                                <?php if($booking['status'] == 'Pending'): ?>
                                    <button class="btn-action-sm btn-approve" onclick="approveBooking('<?php echo $booking['id']; ?>')">
                                        Approve
                                    </button>
                                    <button class="btn-action-sm btn-reject" onclick="rejectBooking('<?php echo $booking['id']; ?>')">
                                        Reject
                                    </button>
                                <?php elseif($booking['status'] == 'Confirmed'): ?>
                                    <button class="btn-action-sm btn-contact" onclick="contactCustomer('<?php echo $booking['customer']; ?>')">
                                        Contact
                                    </button>
                                    <button class="btn-action-sm btn-reschedule" onclick="rescheduleBooking('<?php echo $booking['id']; ?>')">
                                        Reschedule
                                    </button>
                                <?php else: ?>
                                    <button class="btn-action-sm btn-receipt" onclick="downloadReceipt('<?php echo $booking['id']; ?>')">
                                        Receipt
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Today's Schedule -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Today's Schedule</h3>
            <span class="schedule-date"><?php echo date('F j, Y'); ?></span>
        </div>
        <div class="todays-schedule">
            <?php 
            $todaysBookings = [
                ['time' => '08:00 - 10:00', 'customer' => 'Krishna Wishvajith', 'property' => 'Cricket Ground', 'status' => 'Confirmed'],
                ['time' => '14:00 - 16:00', 'customer' => 'Kulakshi Thathsarani', 'property' => 'Tennis Courts', 'status' => 'Confirmed'],
                ['time' => '18:00 - 20:00', 'customer' => 'Dinesh Sulakshana', 'property' => 'Football Arena', 'status' => 'Pending']
            ];
            foreach($todaysBookings as $booking): ?>
            <div class="schedule-slot">
                <div class="slot-time">
                    <span class="time-range"><?php echo $booking['time']; ?></span>
                </div>
                <div class="slot-details">
                    <h4><?php echo $booking['customer']; ?></h4>
                    <p><?php echo $booking['property']; ?></p>
                </div>
                <div class="slot-status">
                    <span class="status-badge <?php echo strtolower($booking['status']); ?>">
                        <?php echo $booking['status']; ?>
                    </span>
                </div>
                <div class="slot-actions">
                    <button class="btn-contact-customer" onclick="contactCustomer('<?php echo $booking['customer']; ?>')">
                        📱
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Upcoming Bookings Calendar -->
    <div class="dashboard-card" id="calendarView" style="display: none;">
        <div class="card-header">
            <h3>Calendar View</h3>
            <div class="calendar-controls">
                <button class="btn-calendar-nav" onclick="previousMonth()">←</button>
                <span class="calendar-month">January 2025</span>
                <button class="btn-calendar-nav" onclick="nextMonth()">→</button>
            </div>
        </div>
        <div class="calendar-container">
            <div class="calendar-grid">
                <div class="calendar-header">
                    <div class="day-header">Sun</div>
                    <div class="day-header">Mon</div>
                    <div class="day-header">Tue</div>
                    <div class="day-header">Wed</div>
                    <div class="day-header">Thu</div>
                    <div class="day-header">Fri</div>
                    <div class="day-header">Sat</div>
                </div>
                <div class="calendar-days" id="calendarDays">
                    <!-- Calendar days will be generated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Summary -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Booking Revenue Summary</h3>
            <select class="period-select">
                <option value="this-month">This Month</option>
                <option value="last-month">Last Month</option>
                <option value="this-year">This Year</option>
            </select>
        </div>
        <div class="revenue-summary">
            <div class="revenue-breakdown">
                <div class="revenue-item">
                    <div class="revenue-label">Gross Revenue</div>
                    <div class="revenue-value">LKR 156,000</div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-label">Platform Commission (12%)</div>
                    <div class="revenue-value commission">-LKR 18,720</div>
                </div>
                <div class="revenue-item">
                    <div class="revenue-label">Your Earnings</div>
                    <div class="revenue-value earnings">LKR 137,280</div>
                </div>
            </div>
            
            <div class="revenue-chart">
                <canvas id="revenueChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Booking Details Modal -->
<div id="bookingModal" class="modal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Booking Details</h3>
            <span class="close" onclick="closeBookingModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="booking-details-grid">
                <div class="detail-section">
                    <h4>Booking Information</h4>
                    <div class="detail-row">
                        <label>Booking ID:</label>
                        <span id="modalBookingId">#BK001</span>
                    </div>
                    <div class="detail-row">
                        <label>Property:</label>
                        <span id="modalProperty">Colombo Cricket Ground</span>
                    </div>
                    <div class="detail-row">
                        <label>Date & Time:</label>
                        <span id="modalDateTime">2025-01-25, 2:00 PM - 4:00 PM</span>
                    </div>
                    <div class="detail-row">
                        <label>Duration:</label>
                        <span id="modalDuration">2 hours</span>
                    </div>
                    <div class="detail-row">
                        <label>Status:</label>
                        <span id="modalStatus" class="status-badge">Confirmed</span>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h4>Customer Information</h4>
                    <div class="detail-row">
                        <label>Name:</label>
                        <span id="modalCustomerName">Krishna Wishvajith</span>
                    </div>
                    <div class="detail-row">
                        <label>Phone:</label>
                        <span id="modalCustomerPhone">+94 71 234 5678</span>
                    </div>
                    <div class="detail-row">
                        <label>Email:</label>
                        <span id="modalCustomerEmail">customer@test.com</span>
                    </div>
                    <div class="detail-row">
                        <label>Previous Bookings:</label>
                        <span id="modalCustomerHistory">5 bookings</span>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h4>Payment Information</h4>
                    <div class="detail-row">
                        <label>Total Amount:</label>
                        <span id="modalTotalAmount" class="amount">LKR 5,000</span>
                    </div>
                    <div class="detail-row">
                        <label>Platform Commission:</label>
                        <span id="modalCommission" class="commission">LKR 600 (12%)</span>
                    </div>
                    <div class="detail-row">
                        <label>Your Earnings:</label>
                        <span id="modalEarnings" class="earnings">LKR 4,400</span>
                    </div>
                    <div class="detail-row">
                        <label>Payment Status:</label>
                        <span id="modalPaymentStatus" class="status-badge">Paid</span>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h4>Special Notes</h4>
                    <div class="notes-content">
                        <p id="modalNotes">Customer requested additional equipment. Please ensure cricket bats are available.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeBookingModal()">Close</button>
            <button class="btn-contact-customer" onclick="contactCustomerFromModal()">Contact Customer</button>
            <button class="btn-action-primary" onclick="approveBookingFromModal()">Approve Booking</button>
        </div>
    </div>
</div>

<!-- Block Time Slot Modal -->
<div id="blockTimeModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Block Time Slot</h3>
            <span class="close" onclick="closeBlockTimeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form class="block-time-form">
                <div class="form-group">
                    <label>Property</label>
                    <select name="property" required>
                        <option value="">Select Property</option>
                        <option value="cricket-ground">Colombo Cricket Ground</option>
                        <option value="football-arena">Football Arena Pro</option>
                        <option value="tennis-courts">Tennis Academy Courts</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="block_date" required>
                    </div>
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" name="start_time" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" name="end_time" required>
                    </div>
                    <div class="form-group">
                        <label>Reason</label>
                        <select name="reason" required>
                            <option value="">Select Reason</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="private-event">Private Event</option>
                            <option value="weather">Weather Conditions</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Additional Notes</label>
                    <textarea name="notes" rows="3" placeholder="Additional information about the block..."></textarea>
                </div>
            </form>
        </div>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeBlockTimeModal()">Cancel</button>
            <button class="btn-block-time" onclick="confirmBlockTime()">Block Time Slot</button>
        </div>
    </div>
</div>

<script>
// Table functionality
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.booking-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

// Booking actions
function viewBookingDetails(bookingId) {
    // Populate modal with booking data
    document.getElementById('modalBookingId').textContent = '#' + bookingId;
    document.getElementById('bookingModal').style.display = 'block';
}

function closeBookingModal() {
    document.getElementById('bookingModal').style.display = 'none';
}

function approveBooking(bookingId) {
    if(confirm('Are you sure you want to approve this booking?')) {
        alert(`Booking ${bookingId} approved successfully!`);
        // Here you would make an AJAX call to approve the booking
        location.reload();
    }
}

function rejectBooking(bookingId) {
    const reason = prompt('Please provide a reason for rejection:');
    if(reason) {
        alert(`Booking ${bookingId} rejected. Reason: ${reason}`);
        // Here you would make an AJAX call to reject the booking
        location.reload();
    }
}

function contactCustomer(customerName) {
    alert(`Contacting ${customerName} via WhatsApp...`);
    // Here you would integrate with WhatsApp Business API
}

function rescheduleBooking(bookingId) {
    alert(`Opening reschedule dialog for booking ${bookingId}`);
    // Here you would open a reschedule modal
}

function downloadReceipt(bookingId) {
    alert(`Downloading receipt for booking ${bookingId}`);
    // Here you would generate and download the receipt
}

// Quick actions
function approveAllPending() {
    const pendingBookings = document.querySelectorAll('.booking-row[data-status="pending"]');
    if(pendingBookings.length === 0) {
        alert('No pending bookings to approve.');
        return;
    }
    
    if(confirm(`Are you sure you want to approve all ${pendingBookings.length} pending bookings?`)) {
        alert('All pending bookings approved successfully!');
        location.reload();
    }
}

function sendReminders() {
    alert('Sending booking reminders to customers...');
    // Here you would make an AJAX call to send reminders
}

function blockTimeSlot() {
    document.getElementById('blockTimeModal').style.display = 'block';
}

function closeBlockTimeModal() {
    document.getElementById('blockTimeModal').style.display = 'none';
}

function confirmBlockTime() {
    const form = document.querySelector('.block-time-form');
    const formData = new FormData(form);
    
    // Validate form
    if(!form.checkValidity()) {
        alert('Please fill in all required fields.');
        return;
    }
    
    alert('Time slot blocked successfully!');
    closeBlockTimeModal();
    location.reload();
}

// Calendar functionality
function toggleCalendarView() {
    const calendarView = document.getElementById('calendarView');
    const isVisible = calendarView.style.display !== 'none';
    
    if(isVisible) {
        calendarView.style.display = 'none';
    } else {
        calendarView.style.display = 'block';
        generateCalendar();
    }
}

function generateCalendar() {
    const calendarDays = document.getElementById('calendarDays');
    const today = new Date();
    const firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
    const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    
    let html = '';
    
    // Add empty cells for days before month starts
    for(let i = 0; i < firstDay.getDay(); i++) {
        html += '<div class="calendar-day empty"></div>';
    }
    
    // Add days of the month
    for(let day = 1; day <= lastDay.getDate(); day++) {
        const isToday = day === today.getDate();
        const hasBookings = Math.random() > 0.7; // Simulate bookings
        
        html += `
            <div class="calendar-day ${isToday ? 'today' : ''} ${hasBookings ? 'has-bookings' : ''}">
                <span class="day-number">${day}</span>
                ${hasBookings ? '<div class="booking-indicator"></div>' : ''}
            </div>
        `;
    }
    
    calendarDays.innerHTML = html;
}

// Filter functionality
document.getElementById('statusFilter').addEventListener('change', function() {
    const status = this.value.toLowerCase();
    const rows = document.querySelectorAll('.booking-row');
    
    rows.forEach(row => {
        if(status === '' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Search functionality
document.getElementById('customerSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.booking-row');
    
    rows.forEach(row => {
        const customerName = row.querySelector('.customer-info strong').textContent.toLowerCase();
        if(customerName.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Export functionality
function exportBookings() {
    alert('Exporting bookings data to CSV...');
    // Here you would generate and download CSV file
}

// Modal functions
function contactCustomerFromModal() {
    const customerName = document.getElementById('modalCustomerName').textContent;
    contactCustomer(customerName);
}

function approveBookingFromModal() {
    const bookingId = document.getElementById('modalBookingId').textContent.replace('#', '');
    approveBooking(bookingId);
}

// Close modals when clicking outside
window.onclick = function(event) {
    const bookingModal = document.getElementById('bookingModal');
    const blockTimeModal = document.getElementById('blockTimeModal');
    
    if (event.target == bookingModal) {
        bookingModal.style.display = "none";
    }
    if (event.target == blockTimeModal) {
        blockTimeModal.style.display = "none";
    }
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh data every 30 seconds
    setInterval(function() {
        console.log('Refreshing booking data...');
        // Here you would make an AJAX call to refresh data
    }, 30000);
});
</script>

<style>
.booking-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.booking-filters {
    display: flex;
    gap: 16px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-select,
.search-input {
    padding: 10px 12px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    min-width: 150px;
}

.quick-actions-bar {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f8f9fa;
    border-radius: 12px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.action-label {
    font-weight: 500;
    color: #495057;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 12px;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quick-action-btn:hover {
    background: #e9ecef;
    border-color: #adb5bd;
}

.action-icon {
    font-size: 14px;
}

.booking-row {
    transition: background-color 0.3s ease;
}

.booking-row:hover {
    background: #f8f9fa;
}

.booking-id {
    font-family: monospace;
    font-weight: 600;
    color: #495057;
}

.property-cell,
.customer-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.customer-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #28a745;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.customer-info strong,
.property-info strong {
    display: block;
    color: #212529;
    font-size: 14px;
}

.customer-info small,
.property-info small {
    color: #6c757d;
    font-size: 12px;
}

.datetime-info strong {
    display: block;
    color: #212529;
    font-size: 14px;
}

.datetime-info small {
    color: #6c757d;
    font-size: 12px;
}

.duration-badge {
    background: #e9ecef;
    color: #495057;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.amount-total {
    font-weight: 600;
    color: #212529;
    font-size: 14px;
}

.commission-amount {
    color: #dc3545;
    font-weight: 500;
    font-size: 13px;
}

.commission-rate {
    display: block;
    color: #6c757d;
    font-size: 11px;
}

.earnings-amount {
    color: #28a745;
    font-weight: 600;
    font-size: 14px;
}

.todays-schedule {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.schedule-slot {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f8f9fa;
    border-radius: 12px;
    border-left: 4px solid #28a745;
}

.slot-time {
    min-width: 120px;
}

.time-range {
    font-weight: 600;
    color: #495057;
    font-size: 14px;
}

.slot-details {
    flex: 1;
}

.slot-details h4 {
    margin: 0 0 4px 0;
    color: #212529;
    font-size: 15px;
}

.slot-details p {
    margin: 0;
    color: #6c757d;
    font-size: 13px;
}

.slot-actions {
    display: flex;
    gap: 8px;
}

.btn-contact-customer {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #28a745;
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-contact-customer:hover {
    background: #218838;
    transform: scale(1.05);
}

.calendar-container {
    padding: 20px;
}

.calendar-grid {
    max-width: 800px;
    margin: 0 auto;
}

.calendar-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
    margin-bottom: 8px;
}

.day-header {
    padding: 12px;
    text-align: center;
    font-weight: 600;
    color: #495057;
    background: #f8f9fa;
    border-radius: 4px;
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 1px;
}

.calendar-day {
    min-height: 80px;
    padding: 8px;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 4px;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.calendar-day:hover {
    background: #f8f9fa;
}

.calendar-day.today {
    background: #e8f5e8;
    border-color: #28a745;
}

.calendar-day.has-bookings {
    border-left: 4px solid #007bff;
}

.calendar-day.empty {
    background: #f8f9fa;
    cursor: default;
}

.day-number {
    font-weight: 500;
    color: #495057;
}

.booking-indicator {
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 8px;
    height: 8px;
    background: #007bff;
    border-radius: 50%;
}

.calendar-controls {
    display: flex;
    align-items: center;
    gap: 16px;
}

.btn-calendar-nav {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-calendar-nav:hover {
    background: #e9ecef;
}

.calendar-month {
    font-weight: 600;
    color: #495057;
    min-width: 120px;
    text-align: center;
}

.revenue-summary {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
    align-items: center;
}

.revenue-breakdown {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.revenue-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
}

.revenue-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.revenue-label {
    font-size: 14px;
    color: #6c757d;
}

.revenue-value {
    font-weight: 600;
    font-size: 16px;
    color: #212529;
}

.revenue-value.commission {
    color: #dc3545;
}

.revenue-value.earnings {
    color: #28a745;
    font-size: 18px;
}

.booking-details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.detail-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
}

.detail-section h4 {
    margin: 0 0 16px 0;
    color: #495057;
    font-size: 16px;
    font-weight: 600;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 8px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
}

.detail-row label {
    color: #6c757d;
    font-weight: 500;
}

.detail-row span {
    color: #212529;
    font-weight: 600;
}

.detail-row .amount {
    color: #212529;
    font-size: 16px;
}

.detail-row .commission {
    color: #dc3545;
}

.detail-row .earnings {
    color: #28a745;
    font-size: 16px;
}

.notes-content {
    background: white;
    padding: 16px;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.notes-content p {
    margin: 0;
    color: #495057;
    line-height: 1.5;
}

.period-select {
    padding: 8px 12px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    font-size: 13px;
    background: white;
}

.schedule-date {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
}

.btn-export,
.btn-calendar-view {
    background: #007bff;
    color: white;
    padding: 10px 16px;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-export:hover,
.btn-calendar-view:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .booking-filters {
        flex-direction: column;
    }
    
    .quick-actions-bar {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .revenue-summary {
        grid-template-columns: 1fr;
    }
    
    .booking-details-grid {
        grid-template-columns: 1fr;
    }
    
    .calendar-days {
        gap: 0;
    }
    
    .calendar-day {
        min-height: 60px;
        padding: 4px;
    }
    
    .schedule-slot {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
}
</style>

<?php require APPROOT.'/views/stadium_owner/inc/footer.php'; ?>