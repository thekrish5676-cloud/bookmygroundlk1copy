<?php require APPROOT.'/views/rentalowner/inc/header.php'; ?>

<div class="kal-rental-dash-message-main-content">
    <div class="kal-rental-dash-message-dashboard-header">
        <h1>Message Center</h1>
        <div class="kal-rental-dash-message-header-actions">
            <button class="kal-rental-dash-message-btn-compose" onclick="openComposeModal()">✉️ Compose Message</button>
        </div>
    </div>

    <!-- Message Stats -->
    <div class="kal-rental-dash-message-message-stats">
        <div class="kal-rental-dash-message-stat-item">
            <div class="kal-rental-dash-message-stat-icon">📧</div>
            <div class="kal-rental-dash-message-stat-details">
                <span class="kal-rental-dash-message-stat-number">48</span>
                <span class="kal-rental-dash-message-stat-label">Total Messages</span>
            </div>
        </div>
        <div class="kal-rental-dash-message-stat-item">
            <div class="kal-rental-dash-message-stat-icon">📬</div>
            <div class="kal-rental-dash-message-stat-details">
                <span class="kal-rental-dash-message-stat-number">12</span>
                <span class="kal-rental-dash-message-stat-label">Unread</span>
            </div>
        </div>
        <div class="kal-rental-dash-message-stat-item">
            <div class="kal-rental-dash-message-stat-icon">⚡</div>
            <div class="kal-rental-dash-message-stat-details">
                <span class="kal-rental-dash-message-stat-number">8</span>
                <span class="kal-rental-dash-message-stat-label">Priority</span>
            </div>
        </div>
        <div class="kal-rental-dash-message-stat-item">
            <div class="kal-rental-dash-message-stat-icon">💬</div>
            <div class="kal-rental-dash-message-stat-details">
                <span class="kal-rental-dash-message-stat-number">24</span>
                <span class="kal-rental-dash-message-stat-label">Conversations</span>
            </div>
        </div>
    </div>

    <div class="kal-rental-dash-message-messages-layout">
        <!-- Message Sidebar -->
        <div class="kal-rental-dash-message-messages-sidebar">
            <div class="kal-rental-dash-message-message-filters">
                <button class="kal-rental-dash-message-filter-btn kal-rental-dash-message-active" data-filter="all">All Messages</button>
                <button class="kal-rental-dash-message-filter-btn" data-filter="unread">Unread (12)</button>
                <button class="kal-rental-dash-message-filter-btn" data-filter="priority">Priority</button>
                <button class="kal-rental-dash-message-filter-btn" data-filter="support">Support</button>
                <button class="kal-rental-dash-message-filter-btn" data-filter="complaints">Complaints</button>
            </div>

            <div class="kal-rental-dash-message-messages-list">
                <div class="kal-rental-dash-message-message-item kal-rental-dash-message-active" data-message="1">
                    <div class="kal-rental-dash-message-message-avatar">J</div>
                    <div class="kal-rental-dash-message-message-preview">
                        <div class="kal-rental-dash-message-message-header">
                            <span class="kal-rental-dash-message-sender-name">Krishna Wishvajith</span>
                            <span class="kal-rental-dash-message-message-time">2:30 PM</span>
                        </div>
                        <div class="kal-rental-dash-message-message-subject">Renting sport equipment for school</div>
                        <div class="kal-rental-dash-message-message-excerpt">Hi, I need to rent equipment for school tomorrow...</div>
                    </div>
                    <div class="kal-rental-dash-message-message-status kal-rental-dash-message-unread"></div>
                </div>

                <div class="kal-rental-dash-message-message-item" data-message="2">
                    <div class="kal-rental-dash-message-message-avatar">S</div>
                    <div class="kal-rental-dash-message-message-preview">
                        <div class="kal-rental-dash-message-message-header">
                            <span class="kal-rental-dash-message-sender-name">University Of Colombo</span>
                            <span class="kal-rental-dash-message-message-time">1:15 PM</span>
                        </div>
                        <div class="kal-rental-dash-message-message-subject">Request add more equipment for the shop</div>
                        <div class="kal-rental-dash-message-message-excerpt">Can you add more equipment for the shop...</div>
                    </div>
                    <div class="kal-rental-dash-message-message-status kal-rental-dash-message-read"></div>
                </div>

                <div class="kal-rental-dash-message-message-item" data-message="3">
                    <div class="kal-rental-dash-message-message-avatar">M</div>
                    <div class="kal-rental-dash-message-message-preview">
                        <div class="kal-rental-dash-message-message-header">
                            <span class="kal-rental-dash-message-sender-name">Kalana Ekanayake</span>
                            <span class="kal-rental-dash-message-message-time">11:45 AM</span>
                        </div>
                        <div class="kal-rental-dash-message-message-subject">Equipment Rental Issue</div>
                        <div class="kal-rental-dash-message-message-excerpt">The basketball I rented was damaged...</div>
                    </div>
                    <div class="kal-rental-dash-message-message-status kal-rental-dash-message-priority"></div>
                </div>

            </div>
        </div>

        <!-- Message Content -->
        <div class="kal-rental-dash-message-message-content">
            <div class="kal-rental-dash-message-message-header-bar">
                <div class="kal-rental-dash-message-conversation-info">
                    <h3>Equipment Rental Issue</h3>
                    <p>Conversation with John Doe</p>
                </div>
                <div class="kal-rental-dash-message-message-actions">
                    <button class="kal-rental-dash-message-btn-action-sm kal-rental-dash-message-btn-archive">Archive</button>
                    <button class="kal-rental-dash-message-btn-action-sm kal-rental-dash-message-btn-priority">Mark Priority</button>
                    <button class="kal-rental-dash-message-btn-action-sm kal-rental-dash-message-btn-delete">Delete</button>
                </div>
            </div>

            <div class="kal-rental-dash-message-conversation-thread">
                <div class="kal-rental-dash-message-message-bubble kal-rental-dash-message-received">
                    <div class="kal-rental-dash-message-message-info">
                        <span class="kal-rental-dash-message-sender">Kalana Ekanayake</span>
                        <span class="kal-rental-dash-message-timestamp">Today at 11:45 AM</span>
                    </div>
                    <div class="kal-rental-dash-message-message-text">
                        Hi Rental Owner,<br><br>
                       I’m writing to inform you that one of the rental equipments I used today at the Colombo Cricket Ground appears to be damaged. The issue was noticed after my booking session from 2:00 PM to 4:00 PM.<br><br>
                        My booking ID is #BK0045. Could you please look into this and advise on the next steps?<br><br>
                        Thanks!
                    </div>
                </div>

                <div class="kal-rental-dash-message-message-bubble kal-rental-dash-message-sent">
                    <div class="kal-rental-dash-message-message-info">
                        <span class="kal-rental-dash-message-sender">Admin (You)</span>
                        <span class="kal-rental-dash-message-timestamp">Today at 2:35 PM</span>
                    </div>
                    <div class="kal-rental-dash-message-message-text">
                        Hi Krishna,<br><br>
                        I've received your cancellation request for booking #BK0045. Since it's more than 6 hours before your booking time, 
                        you're eligible for a full refund according to our policy.<br><br>
                        I'll process the cancellation and refund now. You should see the refund in your account within 3-5 business days.
                    </div>
                </div>

                <div class="kal-rental-dash-message-message-bubble kal-rental-dash-message-received">
                    <div class="kal-rental-dash-message-message-info">
                        <span class="kal-rental-dash-message-sender">Krishna Wishvajith</span>
                        <span class="kal-rental-dash-message-timestamp">Today at 2:40 PM</span>
                    </div>
                    <div class="kal-rental-dash-message-message-text">
                        Perfect! Thank you so much for the quick response. Really appreciate the excellent customer service! 🙏
                    </div>
                </div>
            </div>

            <div class="kal-rental-dash-message-reply-section">
                <div class="kal-rental-dash-message-reply-form">
                    <textarea placeholder="Type your reply..." rows="4"></textarea>
                    <div class="kal-rental-dash-message-reply-actions">
                        <button class="kal-rental-dash-message-btn-attach">📎</button>
                        <button class="kal-rental-dash-message-btn-emoji">😊</button>
                        <button class="kal-rental-dash-message-btn-send">Send Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Compose Message Modal -->
<div id="kal-rental-dash-message-composeModal" class="kal-rental-dash-message-modal">
    <div class="kal-rental-dash-message-modal-content">
        <div class="kal-rental-dash-message-modal-header">
            <h3>Compose New Message</h3>
            <span class="kal-rental-dash-message-close" onclick="closeComposeModal()">&times;</span>
        </div>
        <form class="kal-rental-dash-message-compose-form">
            <div class="kal-rental-dash-message-form-group">
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
            
            <div class="kal-rental-dash-message-form-group" id="kal-rental-dash-message-userSelect" style="display: none;">
                <label>Select User:</label>
                <input type="text" placeholder="Search and select user..." id="kal-rental-dash-message-userSearch">
            </div>

            <div class="kal-rental-dash-message-form-group">
                <label>Subject:</label>
                <input type="text" name="subject" required placeholder="Enter message subject">
            </div>

            <div class="kal-rental-dash-message-form-group">
                <label>Priority:</label>
                <select name="priority">
                    <option value="normal">Normal</option>
                    <option value="high">High Priority</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>

            <div class="kal-rental-dash-message-form-group">
                <label>Message:</label>
                <textarea name="message" rows="8" required placeholder="Type your message here..."></textarea>
            </div>

            <div class="kal-rental-dash-message-modal-actions">
                <button type="button" class="kal-rental-dash-message-btn-cancel" onclick="closeComposeModal()">Cancel</button>
                <button type="submit" class="kal-rental-dash-message-btn-send-message">Send Message</button>
            </div>
        </form>
    </div>
</div>

<script>
// Message item selection
document.querySelectorAll('.kal-rental-dash-message-message-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.kal-rental-dash-message-message-item').forEach(i => i.classList.remove('kal-rental-dash-message-active'));
        this.classList.add('kal-rental-dash-message-active');
        
        // Load message content here
        const messageId = this.dataset.message;
        console.log('Loading message:', messageId);
    });
});

// Filter functionality
document.querySelectorAll('.kal-rental-dash-message-filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.kal-rental-dash-message-filter-btn').forEach(b => b.classList.remove('kal-rental-dash-message-active'));
        this.classList.add('kal-rental-dash-message-active');
        
        const filter = this.dataset.filter;
        console.log('Filtering messages by:', filter);
    });
});

// Compose modal
function openComposeModal() {
    document.getElementById('kal-rental-dash-message-composeModal').style.display = 'block';
}

function closeComposeModal() {
    document.getElementById('kal-rental-dash-message-composeModal').style.display = 'none';
}

// Recipient selection change
document.querySelector('select[name="recipient"]').addEventListener('change', function() {
    const userSelect = document.getElementById('kal-rental-dash-message-userSelect');
    if (this.value === 'individual') {
        userSelect.style.display = 'block';
    } else {
        userSelect.style.display = 'none';
    }
});

// Send reply
document.querySelector('.kal-rental-dash-message-btn-send').addEventListener('click', function() {
    const textarea = document.querySelector('.kal-rental-dash-message-reply-form textarea');
    const message = textarea.value.trim();
    
    if (message) {
        // Add message to conversation
        alert('Reply sent: ' + message);
        textarea.value = '';
    }
});

// Message actions
document.querySelector('.kal-rental-dash-message-btn-archive').addEventListener('click', function() {
    alert('Message archived');
});

document.querySelector('.kal-rental-dash-message-btn-priority').addEventListener('click', function() {
    alert('Message marked as priority');
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('kal-rental-dash-message-composeModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<?php require APPROOT.'/views/rentalowner/inc/footer.php'; ?>