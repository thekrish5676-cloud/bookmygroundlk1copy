<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Message Center</h1>
        <div class="header-actions">
            <button class="btn-compose" onclick="openComposeModal()">✉️ Compose Message</button>
        </div>
    </div>

    <!-- Message Stats -->
    <div class="message-stats">
        <div class="stat-item">
            <div class="stat-icon">📧</div>
            <div class="stat-details">
                <span class="stat-number">48</span>
                <span class="stat-label">Total Messages</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">📬</div>
            <div class="stat-details">
                <span class="stat-number">12</span>
                <span class="stat-label">Unread</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">⚡</div>
            <div class="stat-details">
                <span class="stat-number">8</span>
                <span class="stat-label">Priority</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">💬</div>
            <div class="stat-details">
                <span class="stat-number">24</span>
                <span class="stat-label">Conversations</span>
            </div>
        </div>
    </div>

    <div class="messages-layout">
        <!-- Message Sidebar -->
        <div class="messages-sidebar">
            <div class="message-filters">
                <button class="filter-btn active" data-filter="all">All Messages</button>
                <button class="filter-btn" data-filter="unread">Unread (12)</button>
                <button class="filter-btn" data-filter="priority">Priority</button>
                <button class="filter-btn" data-filter="support">Support</button>
                <button class="filter-btn" data-filter="complaints">Complaints</button>
            </div>

            <div class="messages-list">
                <div class="message-item active" data-message="1">
                    <div class="message-avatar">J</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Krishna Wishvajith</span>
                            <span class="message-time">2:30 PM</span>
                        </div>
                        <div class="message-subject">Booking Cancellation Request</div>
                        <div class="message-excerpt">Hi, I need to cancel my booking for tomorrow...</div>
                    </div>
                    <div class="message-status unread"></div>
                </div>

                <div class="message-item" data-message="2">
                    <div class="message-avatar">S</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">University Of Colombo</span>
                            <span class="message-time">1:15 PM</span>
                        </div>
                        <div class="message-subject">Payout Inquiry</div>
                        <div class="message-excerpt">When will I receive this week's payout...</div>
                    </div>
                    <div class="message-status read"></div>
                </div>

                <div class="message-item" data-message="3">
                    <div class="message-avatar">M</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Kalana Ekanayake</span>
                            <span class="message-time">11:45 AM</span>
                        </div>
                        <div class="message-subject">Equipment Rental Issue</div>
                        <div class="message-excerpt">The basketball I rented was damaged...</div>
                    </div>
                    <div class="message-status priority"></div>
                </div>

                <div class="message-item" data-message="4">
                    <div class="message-avatar">C</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Coach Sarah</span>
                            <span class="message-time">10:20 AM</span>
                        </div>
                        <div class="message-subject">Training Session Schedule</div>
                        <div class="message-excerpt">Can we discuss availability for group sessions...</div>
                    </div>
                    <div class="message-status read"></div>
                </div>

                <div class="message-item" data-message="5">
                    <div class="message-avatar">R</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Rental Owner Alex</span>
                            <span class="message-time">Yesterday</span>
                        </div>
                        <div class="message-subject">New Equipment Listing</div>
                        <div class="message-excerpt">I'd like to add new tennis rackets to my inventory...</div>
                    </div>
                    <div class="message-status read"></div>
                </div>
            </div>
        </div>

        <!-- Message Content -->
        <div class="message-content">
            <div class="message-header-bar">
                <div class="conversation-info">
                    <h3>Booking Cancellation Request</h3>
                    <p>Conversation with John Doe</p>
                </div>
                <div class="message-actions">
                    <button class="btn-action-sm btn-archive">Archive</button>
                    <button class="btn-action-sm btn-priority">Mark Priority</button>
                    <button class="btn-action-sm btn-delete">Delete</button>
                </div>
            </div>

            <div class="conversation-thread">
                <div class="message-bubble received">
                    <div class="message-info">
                        <span class="sender">Krishna Wishvajith</span>
                        <span class="timestamp">Today at 2:30 PM</span>
                    </div>
                    <div class="message-text">
                        Hi Admin,<br><br>
                        I need to cancel my booking for tomorrow (August 20th) at the Colombo Cricket Ground from 2:00 PM to 4:00 PM. 
                        Something urgent came up and I won't be able to make it.<br><br>
                        My booking ID is #BK0045. Can you please process the cancellation and refund?<br><br>
                        Thanks!
                    </div>
                </div>

                <div class="message-bubble sent">
                    <div class="message-info">
                        <span class="sender">Admin (You)</span>
                        <span class="timestamp">Today at 2:35 PM</span>
                    </div>
                    <div class="message-text">
                        Hi Krishna,<br><br>
                        I've received your cancellation request for booking #BK0045. Since it's more than 6 hours before your booking time, 
                        you're eligible for a full refund according to our policy.<br><br>
                        I'll process the cancellation and refund now. You should see the refund in your account within 3-5 business days.
                    </div>
                </div>

                <div class="message-bubble received">
                    <div class="message-info">
                        <span class="sender">Krishna Wishvajith</span>
                        <span class="timestamp">Today at 2:40 PM</span>
                    </div>
                    <div class="message-text">
                        Perfect! Thank you so much for the quick response. Really appreciate the excellent customer service! 🙏
                    </div>
                </div>
            </div>

            <div class="reply-section">
                <div class="reply-form">
                    <textarea placeholder="Type your reply..." rows="4"></textarea>
                    <div class="reply-actions">
                        <button class="btn-attach">📎</button>
                        <button class="btn-emoji">😊</button>
                        <button class="btn-send">Send Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Compose Message Modal -->
<div id="composeModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Compose New Message</h3>
            <span class="close" onclick="closeComposeModal()">&times;</span>
        </div>
        <form class="compose-form">
            <div class="form-group">
                <label>To:</label>
                <select name="recipient" required>
                    <option value="">Select Recipient</option>
                    <option value="all_users">All Users</option>
                    <option value="customers">All Customers</option>
                    <option value="stadium_owners">All Stadium Owners</option>
                    <option value="coaches">All Coaches</option>
                    <option value="rental_owners">All Rental Owners</option>
                    <option value="individual">Specific User</option>
                </select>
            </div>
            
            <div class="form-group" id="userSelect" style="display: none;">
                <label>Select User:</label>
                <input type="text" placeholder="Search and select user..." id="userSearch">
            </div>

            <div class="form-group">
                <label>Subject:</label>
                <input type="text" name="subject" required placeholder="Enter message subject">
            </div>

            <div class="form-group">
                <label>Priority:</label>
                <select name="priority">
                    <option value="normal">Normal</option>
                    <option value="high">High Priority</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>

            <div class="form-group">
                <label>Message:</label>
                <textarea name="message" rows="8" required placeholder="Type your message here..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeComposeModal()">Cancel</button>
                <button type="submit" class="btn-send-message">Send Message</button>
            </div>
        </form>
    </div>
</div>


<script>
// Message item selection
document.querySelectorAll('.message-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.message-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        
        // Load message content here
        const messageId = this.dataset.message;
        console.log('Loading message:', messageId);
    });
});

// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        console.log('Filtering messages by:', filter);
    });
});

// Compose modal
function openComposeModal() {
    document.getElementById('composeModal').style.display = 'block';
}

function closeComposeModal() {
    document.getElementById('composeModal').style.display = 'none';
}

// Recipient selection change
document.querySelector('select[name="recipient"]').addEventListener('change', function() {
    const userSelect = document.getElementById('userSelect');
    if (this.value === 'individual') {
        userSelect.style.display = 'block';
    } else {
        userSelect.style.display = 'none';
    }
});

// Send reply
document.querySelector('.btn-send').addEventListener('click', function() {
    const textarea = document.querySelector('.reply-form textarea');
    const message = textarea.value.trim();
    
    if (message) {
        // Add message to conversation
        alert('Reply sent: ' + message);
        textarea.value = '';
    }
});

// Message actions
document.querySelector('.btn-archive').addEventListener('click', function() {
    alert('Message archived');
});

document.querySelector('.btn-priority').addEventListener('click', function() {
    alert('Message marked as priority');
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('composeModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>