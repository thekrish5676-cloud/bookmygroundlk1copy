<?php require APPROOT.'/views/stadium_owner/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Messages</h1>
        <div class="header-actions">
            <button class="btn-compose" onclick="openComposeModal()">✉️ Compose Message</button>
            <button class="btn-mark-all-read" onclick="markAllAsRead()">📖 Mark All Read</button>
        </div>
    </div>

    <!-- Message Stats -->
    <div class="message-stats">
        <div class="stat-item">
            <div class="stat-icon">📧</div>
            <div class="stat-details">
                <span class="stat-number"><?php echo count($data['messages'] ?? []) + 15; ?></span>
                <span class="stat-label">Total Messages</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">📬</div>
            <div class="stat-details">
                <span class="stat-number"><?php echo $data['unread_count'] ?? 3; ?></span>
                <span class="stat-label">Unread</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">⚡</div>
            <div class="stat-details">
                <span class="stat-number">1</span>
                <span class="stat-label">Priority</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">🏆</div>
            <div class="stat-details">
                <span class="stat-number">98%</span>
                <span class="stat-label">Response Rate</span>
            </div>
        </div>
    </div>

    <div class="messages-layout">
        <!-- Message Sidebar -->
        <div class="messages-sidebar">
            <div class="message-filters">
                <button class="filter-btn active" data-filter="all">All Messages</button>
                <button class="filter-btn" data-filter="unread">Unread (<?php echo $data['unread_count'] ?? 3; ?>)</button>
                <button class="filter-btn" data-filter="booking">Booking Inquiries</button>
                <button class="filter-btn" data-filter="general">General</button>
                <button class="filter-btn" data-filter="complaints">Complaints</button>
                <button class="filter-btn" data-filter="reviews">Reviews</button>
            </div>

            <div class="messages-list" id="messagesList">
                <!-- Sample Messages -->
                <div class="message-item active" data-message="1" data-type="booking">
                    <div class="message-avatar">K</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Krishna Wishvajith</span>
                            <span class="message-time">2:30 PM</span>
                        </div>
                        <div class="message-subject">Booking Inquiry - Cricket Ground</div>
                        <div class="message-excerpt">Hi, I'd like to book your cricket ground for this weekend...</div>
                        <div class="message-property">Colombo Cricket Ground</div>
                    </div>
                    <div class="message-status unread"></div>
                </div>

                <div class="message-item" data-message="2" data-type="booking">
                    <div class="message-avatar">U</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Kulakshi Thathsarani</span>
                            <span class="message-time">1:15 PM</span>
                        </div>
                        <div class="message-subject">Payment Confirmation</div>
                        <div class="message-excerpt">I've completed the payment for tomorrow's booking...</div>
                        <div class="message-property">Football Arena Pro</div>
                    </div>
                    <div class="message-status read"></div>
                </div>

                <div class="message-item" data-message="3" data-type="general">
                    <div class="message-avatar">D</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Dinesh Sulakshana</span>
                            <span class="message-time">11:45 AM</span>
                        </div>
                        <div class="message-subject">Facility Question</div>
                        <div class="message-excerpt">Do you provide equipment rental with the court booking...</div>
                        <div class="message-property">Tennis Academy Courts</div>
                    </div>
                    <div class="message-status priority"></div>
                </div>

                <div class="message-item" data-message="4" data-type="reviews">
                    <div class="message-avatar">K</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Kalana Ekanayake</span>
                            <span class="message-time">10:20 AM</span>
                        </div>
                        <div class="message-subject">Great Experience!</div>
                        <div class="message-excerpt">Had an amazing time at your facility. The courts were...</div>
                        <div class="message-property">Basketball Courts</div>
                    </div>
                    <div class="message-status read"></div>
                </div>

                <div class="message-item" data-message="5" data-type="complaints">
                    <div class="message-avatar">A</div>
                    <div class="message-preview">
                        <div class="message-header">
                            <span class="sender-name">Admin Support</span>
                            <span class="message-time">Yesterday</span>
                        </div>
                        <div class="message-subject">Customer Complaint Report</div>
                        <div class="message-excerpt">A customer has raised a complaint about facility cleanliness...</div>
                        <div class="message-property">General</div>
                    </div>
                    <div class="message-status read"></div>
                </div>
            </div>
        </div>

        <!-- Message Content -->
        <div class="message-content">
            <div class="message-header-bar">
                <div class="conversation-info">
                    <div class="contact-details">
                        <h3 id="conversationTitle">Booking Inquiry - Cricket Ground</h3>
                        <p id="conversationWith">Conversation with Krishna Wishvajith</p>
                        <div class="contact-meta">
                            <span class="contact-phone">📞 +94 71 234 5678</span>
                            <span class="contact-email">📧 krishna@test.com</span>
                            <span class="property-tag">🏏 Colombo Cricket Ground</span>
                        </div>
                    </div>
                </div>
                <div class="message-actions">
                    <button class="btn-action-sm btn-mark-read" onclick="markAsRead()">Mark as Read</button>
                    <button class="btn-action-sm btn-priority" onclick="togglePriority()">Priority</button>
                    <button class="btn-action-sm btn-archive" onclick="archiveMessage()">Archive</button>
                    <button class="btn-action-sm btn-block" onclick="blockSender()">Block</button>
                </div>
            </div>

            <div class="conversation-thread" id="conversationThread">
                <div class="message-bubble received">
                    <div class="message-info">
                        <span class="sender">Krishna Wishvajith</span>
                        <span class="timestamp">Today at 2:30 PM</span>
                    </div>
                    <div class="message-text">
                        Hi there!<br><br>
                        I'm interested in booking your cricket ground for this weekend. Could you please let me know about availability on Saturday, August 19th, from 2:00 PM to 5:00 PM?<br><br>
                        Also, what's included with the booking? Do you provide equipment or should we bring our own?<br><br>
                        Looking forward to your response!<br><br>
                        Best regards,<br>
                        Krishna
                    </div>
                </div>

                <div class="message-bubble sent">
                    <div class="message-info">
                        <span class="sender">You</span>
                        <span class="timestamp">Today at 2:45 PM</span>
                    </div>
                    <div class="message-text">
                        Hi Krishna,<br><br>
                        Thank you for your interest in our cricket ground!<br><br>
                        Good news - we have availability for Saturday, August 19th from 2:00 PM to 5:00 PM. The booking fee for 3 hours would be LKR 15,000.<br><br>
                        Included with your booking:<br>
                        • Floodlights (if needed)<br><br>
                        You'll need to bring your own bats, balls, and protective gear. We do have a partnership with a nearby sports equipment rental if you need anything.<br><br>
                        Would you like me to reserve this slot for you? I'll need a 50% deposit to confirm the booking.<br><br>
                        Best regards,<br>
                        Stadium Management
                    </div>
                </div>

                <div class="message-bubble received">
                    <div class="message-info">
                        <span class="sender">Krishna Wishvajith</span>
                        <span class="timestamp">Today at 3:10 PM</span>
                    </div>
                    <div class="message-text">
                        Perfect! That sounds exactly what we need. 🏏<br><br>
                        Please reserve the slot for us. How can I make the deposit payment? Do you accept online transfers?<br><br>
                        Also, could you share the contact details for the equipment rental partner?<br><br>
                        Thanks!
                    </div>
                </div>

                <div class="typing-indicator" id="typingIndicator" style="display: none;">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span class="typing-text">You are typing...</span>
                </div>
            </div>

            <div class="reply-section">
                <div class="quick-replies">
                    <button class="quick-reply-btn" onclick="insertQuickReply('Thank you for your message. I\'ll get back to you shortly.')">
                        Quick Thanks
                    </button>
                    <button class="quick-reply-btn" onclick="insertQuickReply('The slot is available. I\'ll send you the booking details.')">
                        Confirm Availability
                    </button>
                    <button class="quick-reply-btn" onclick="insertQuickReply('Unfortunately, that time slot is not available. Here are some alternatives:')">
                        Not Available
                    </button>
                    <button class="quick-reply-btn" onclick="insertQuickReply('The booking has been confirmed. Here are the payment details:')">
                        Payment Details
                    </button>
                </div>
                
                <div class="reply-form">
                    <div class="reply-input-wrapper">
                        <textarea id="replyMessage" placeholder="Type your reply..." rows="4" onkeyup="showTypingIndicator()"></textarea>
                        <div class="reply-actions">
                            <button class="btn-attach" onclick="attachFile()">📎</button>
                            <button class="btn-emoji" onclick="showEmojiPicker()">😊</button>
                            <button class="btn-template" onclick="showTemplates()">📝</button>
                            <button class="btn-send" onclick="sendReply()">Send Reply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Templates -->
    <div class="message-templates-section">
        <div class="dashboard-card">
            <div class="card-header">
                <h3>Quick Response Templates</h3>
                <button class="btn-add-template" onclick="openTemplateModal()">+ Add Template</button>
            </div>
            <div class="templates-grid">
                <div class="template-card" onclick="useTemplate('booking-confirmation')">
                    <h4>Booking Confirmation</h4>
                    <p>Thank you for your booking. Here are the details...</p>
                    <span class="template-category">Booking</span>
                </div>
                <div class="template-card" onclick="useTemplate('payment-request')">
                    <h4>Payment Request</h4>
                    <p>To confirm your booking, please make the payment...</p>
                    <span class="template-category">Payment</span>
                </div>
                <div class="template-card" onclick="useTemplate('cancellation-policy')">
                    <h4>Cancellation Policy</h4>
                    <p>Our cancellation policy allows free cancellation...</p>
                    <span class="template-category">Policy</span>
                </div>
                <div class="template-card" onclick="useTemplate('thank-you')">
                    <h4>Thank You Message</h4>
                    <p>Thank you for choosing our facility...</p>
                    <span class="template-category">General</span>
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
                    <option value="all_customers">All Customers</option>
                    <option value="recent_customers">Recent Customers</option>
                    <option value="frequent_customers">Frequent Customers</option>
                    <option value="individual">Specific Customer</option>
                </select>
            </div>
            
            <div class="form-group" id="customerSelect" style="display: none;">
                <label>Select Customer:</label>
                <input type="text" placeholder="Search customer by name or email..." id="customerSearch">
                <div class="customer-suggestions" id="customerSuggestions"></div>
            </div>

            <div class="form-group">
                <label>Subject:</label>
                <input type="text" name="subject" required placeholder="Enter message subject">
            </div>

            <div class="form-group">
                <label>Property (Optional):</label>
                <select name="property">
                    <option value="">General Message</option>
                    <option value="cricket-ground">Colombo Cricket Ground</option>
                    <option value="football-arena">Football Arena Pro</option>
                    <option value="tennis-courts">Tennis Academy Courts</option>
                </select>
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

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="save_template">
                    <span class="checkmark"></span>
                    Save as template for future use
                </label>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeComposeModal()">Cancel</button>
                <button type="button" class="btn-save-draft">Save Draft</button>
                <button type="submit" class="btn-send-message">Send Message</button>
            </div>
        </form>
    </div>
</div>

<!-- Template Modal -->
<div id="templateModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Message Template</h3>
            <span class="close" onclick="closeTemplateModal()">&times;</span>
        </div>
        <form class="template-form">
            <div class="form-group">
                <label>Template Name:</label>
                <input type="text" name="template_name" required placeholder="e.g., Booking Confirmation">
            </div>
            
            <div class="form-group">
                <label>Category:</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="booking">Booking</option>
                    <option value="payment">Payment</option>
                    <option value="policy">Policy</option>
                    <option value="general">General</option>
                    <option value="complaint">Complaint Response</option>
                </select>
            </div>

            <div class="form-group">
                <label>Template Content:</label>
                <textarea name="template_content" rows="8" required placeholder="Enter your template message..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeTemplateModal()">Cancel</button>
                <button type="submit" class="btn-save-template">Save Template</button>
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
        
        // Update conversation
        const messageId = this.dataset.message;
        loadConversation(messageId);
    });
});

// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        filterMessages(filter);
    });
});

function filterMessages(filter) {
    const messageItems = document.querySelectorAll('.message-item');
    
    messageItems.forEach(item => {
        if (filter === 'all') {
            item.style.display = 'flex';
        } else if (filter === 'unread') {
            item.style.display = item.querySelector('.message-status.unread') ? 'flex' : 'none';
        } else {
            item.style.display = item.dataset.type === filter ? 'flex' : 'none';
        }
    });
}

function loadConversation(messageId) {
    // In a real app, this would load conversation data via AJAX
    console.log('Loading conversation:', messageId);
}

// Compose modal
function openComposeModal() {
    document.getElementById('composeModal').style.display = 'block';
}

function closeComposeModal() {
    document.getElementById('composeModal').style.display = 'none';
}

// Template modal
function openTemplateModal() {
    document.getElementById('templateModal').style.display = 'block';
}

function closeTemplateModal() {
    document.getElementById('templateModal').style.display = 'none';
}

// Quick replies
function insertQuickReply(text) {
    document.getElementById('replyMessage').value = text;
    document.getElementById('replyMessage').focus();
}

// Send reply
function sendReply() {
    const message = document.getElementById('replyMessage').value.trim();
    
    if (message) {
        // Add message to conversation
        const thread = document.getElementById('conversationThread');
        const messageHtml = `
            <div class="message-bubble sent">
                <div class="message-info">
                    <span class="sender">You</span>
                    <span class="timestamp">Just now</span>
                </div>
                <div class="message-text">${message.replace(/\n/g, '<br>')}</div>
            </div>
        `;
        thread.insertAdjacentHTML('beforeend', messageHtml);
        
        // Clear textarea
        document.getElementById('replyMessage').value = '';
        
        // Scroll to bottom
        thread.scrollTop = thread.scrollHeight;
        
        // Hide typing indicator
        document.getElementById('typingIndicator').style.display = 'none';
    }
}

// Typing indicator
let typingTimer;
function showTypingIndicator() {
    const indicator = document.getElementById('typingIndicator');
    indicator.style.display = 'flex';
    
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
        indicator.style.display = 'none';
    }, 2000);
}

// Message actions
function markAsRead() {
    document.querySelector('.message-item.active .message-status').className = 'message-status read';
    alert('Message marked as read');
}

function togglePriority() {
    const status = document.querySelector('.message-item.active .message-status');
    if (status.classList.contains('priority')) {
        status.className = 'message-status read';
        alert('Priority removed');
    } else {
        status.className = 'message-status priority';
        alert('Message marked as priority');
    }
}

function archiveMessage() {
    if (confirm('Archive this message?')) {
        document.querySelector('.message-item.active').style.opacity = '0.5';
        alert('Message archived');
    }
}

function blockSender() {
    if (confirm('Block this sender? They will not be able to send you messages.')) {
        alert('Sender blocked');
    }
}

function markAllAsRead() {
    if (confirm('Mark all messages as read?')) {
        document.querySelectorAll('.message-status.unread').forEach(status => {
            status.className = 'message-status read';
        });
        alert('All messages marked as read');
    }
}

// Template functions
function useTemplate(templateId) {
    const templates = {
        'booking-confirmation': 'Thank you for your booking request. I\'m pleased to confirm your reservation...',
        'payment-request': 'To secure your booking, please complete the payment using the following details...',
        'cancellation-policy': 'Our cancellation policy allows free cancellation up to 12 hours before your booking...',
        'thank-you': 'Thank you for choosing our facility. We appreciate your business and hope you had a great experience!'
    };
    
    document.getElementById('replyMessage').value = templates[templateId] || '';
}

// Recipient selection change
document.querySelector('select[name="recipient"]').addEventListener('change', function() {
    const customerSelect = document.getElementById('customerSelect');
    if (this.value === 'individual') {
        customerSelect.style.display = 'block';
    } else {
        customerSelect.style.display = 'none';
    }
});

// File attachment
function attachFile() {
    alert('File attachment feature will be implemented');
}

// Emoji picker
function showEmojiPicker() {
    alert('Emoji picker will be implemented');
}

// Templates
function showTemplates() {
    alert('Template selector will be implemented');
}

// Close modals when clicking outside
window.onclick = function(event) {
    const composeModal = document.getElementById('composeModal');
    const templateModal = document.getElementById('templateModal');
    
    if (event.target == composeModal) {
        composeModal.style.display = "none";
    }
    if (event.target == templateModal) {
        templateModal.style.display = "none";
    }
}

// Auto-scroll to bottom of conversation on load
document.addEventListener('DOMContentLoaded', function() {
    const thread = document.getElementById('conversationThread');
    thread.scrollTop = thread.scrollHeight;
});
</script>

<style>
.messages-layout {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 0;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    min-height: 600px;
}

.messages-sidebar {
    background: #f8f9fa;
    border-right: 1px solid #dee2e6;
    display: flex;
    flex-direction: column;
}

.message-filters {
    padding: 20px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.filter-btn {
    padding: 10px 16px;
    background: transparent;
    border: none;
    border-radius: 8px;
    text-align: left;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    color: #6c757d;
}

.filter-btn.active,
.filter-btn:hover {
    background: white;
    color: #212529;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.messages-list {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
}

.message-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 8px;
    position: relative;
}

.message-item:hover {
    background: rgba(255,255,255,0.8);
}

.message-item.active {
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.message-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
    flex-shrink: 0;
}

.message-preview {
    flex: 1;
    min-width: 0;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}

.sender-name {
    font-weight: 600;
    color: #212529;
    font-size: 14px;
}

.message-time {
    font-size: 12px;
    color: #6c757d;
}

.message-subject {
    font-weight: 500;
    color: #495057;
    font-size: 13px;
    margin-bottom: 4px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.message-excerpt {
    font-size: 12px;
    color: #6c757d;
    line-height: 1.4;
    margin-bottom: 6px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.message-property {
    font-size: 11px;
    color: #28a745;
    background: rgba(40, 167, 69, 0.1);
    padding: 2px 6px;
    border-radius: 10px;
    display: inline-block;
}

.message-status {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    position: absolute;
    top: 16px;
    right: 16px;
}

.message-status.unread {
    background: #007bff;
}

.message-status.read {
    background: #28a745;
}

.message-status.priority {
    background: #dc3545;
}

.message-content {
    display: flex;
    flex-direction: column;
    background: white;
}

.message-header-bar {
    padding: 20px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.contact-details h3 {
    margin: 0 0 4px 0;
    color: #212529;
    font-size: 18px;
}

.contact-details p {
    margin: 0 0 8px 0;
    color: #6c757d;
    font-size: 14px;
}

.contact-meta {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.contact-meta span {
    font-size: 12px;
    color: #6c757d;
}

.property-tag {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745 !important;
    padding: 2px 8px;
    border-radius: 12px;
}

.conversation-thread {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    max-height: 400px;
}

.message-bubble {
    margin-bottom: 16px;
    max-width: 70%;
}

.message-bubble.received {
    align-self: flex-start;
}

.message-bubble.sent {
    align-self: flex-end;
    margin-left: auto;
}

.message-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
    font-size: 12px;
    color: #6c757d;
}

.message-text {
    background: #f8f9fa;
    padding: 12px 16px;
    border-radius: 16px;
    line-height: 1.5;
    font-size: 14px;
    color: #212529;
}

.message-bubble.sent .message-text {
    background: #007bff;
    color: white;
}

.typing-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 16px 0;
    font-size: 12px;
    color: #6c757d;
}

.typing-dots {
    display: flex;
    gap: 4px;
}

.typing-dots span {
    width: 6px;
    height: 6px;
    background: #6c757d;
    border-radius: 50%;
    animation: typing 1.5s infinite ease-in-out;
}

.typing-dots span:nth-child(2) {
    animation-delay: 0.3s;
}

.typing-dots span:nth-child(3) {
    animation-delay: 0.6s;
}

@keyframes typing {
    0%, 60%, 100% {
        transform: translateY(0);
        opacity: 0.5;
    }
    30% {
        transform: translateY(-10px);
        opacity: 1;
    }
}

.reply-section {
    border-top: 1px solid #dee2e6;
    padding: 20px;
}

.quick-replies {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.quick-reply-btn {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quick-reply-btn:hover {
    background: #e9ecef;
}

.reply-input-wrapper {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 16px;
}

.reply-input-wrapper textarea {
    width: 100%;
    border: none;
    background: transparent;
    resize: none;
    outline: none;
    font-family: inherit;
    font-size: 14px;
    margin-bottom: 12px;
}

.reply-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.reply-actions button {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-attach,
.btn-emoji,
.btn-template {
    background: transparent;
    color: #6c757d;
}

.btn-attach:hover,
.btn-emoji:hover,
.btn-template:hover {
    background: #e9ecef;
    color: #495057;
}

.btn-send {
    background: #007bff;
    color: white;
    font-weight: 500;
}

.btn-send:hover {
    background: #0056b3;
}

.message-templates-section {
    margin-top: 30px;
}

.templates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 16px;
}

.template-card {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 12px;
    padding: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.template-card:hover {
    border-color: #007bff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.template-card h4 {
    margin: 0 0 8px 0;
    color: #212529;
    font-size: 16px;
}

.template-card p {
    margin: 0 0 12px 0;
    color: #6c757d;
    font-size: 14px;
    line-height: 1.4;
}

.template-category {
    background: #e9ecef;
    color: #495057;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
}

.customer-suggestions {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    max-height: 150px;
    overflow-y: auto;
    display: none;
}

.customer-suggestion {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #f8f9fa;
}

.customer-suggestion:hover {
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .messages-layout {
        grid-template-columns: 1fr;
    }
    
    .messages-sidebar {
        display: none;
    }
    
    .contact-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .quick-replies {
        flex-direction: column;
    }
    
    .templates-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php require APPROOT.'/views/stadium_owner/inc/footer.php'; ?> Professional cricket pitch<br>
                        • Changing rooms with lockers<br>
                        • Basic equipment (stumps, bails)<br>
                        • Parking for up to 20 vehicles<br>
                        •