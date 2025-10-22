<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Contact Page Management</h1>
        <div class="header-actions">
            <button class="btn-save-contact" onclick="saveContactInfo()">💾 Save Changes</button>
            <button class="btn-preview-contact" onclick="previewContact()">👁️ Preview</button>
        </div>
    </div>

    <!-- Contact Info Grid -->
    <div class="contact-grid">
        <!-- Primary Contact Information -->
        <div class="contact-card">
            <div class="card-header">
                <h3>Primary Contact Information</h3>
                <span class="edit-indicator">✏️ Editable</span>
            </div>
            <div class="contact-form">
                <div class="form-group">
                    <label>Main Phone Number</label>
                    <input type="tel" id="mainPhone" value="<?php echo $data['contact_info']['main_phone']; ?>" class="form-control">
                    <small class="form-help">This will be displayed as the primary contact number</small>
                </div>
                
                <div class="form-group">
                    <label>Support Phone</label>
                    <input type="tel" id="supportPhone" value="<?php echo $data['contact_info']['support_phone']; ?>" class="form-control">
                    <small class="form-help">For customer support inquiries</small>
                </div>
                
                <div class="form-group">
                    <label>Main Email Address</label>
                    <input type="email" id="mainEmail" value="<?php echo $data['contact_info']['email']; ?>" class="form-control">
                    <small class="form-help">Primary business email</small>
                </div>
                
                <div class="form-group">
                    <label>Support Email</label>
                    <input type="email" id="supportEmail" value="<?php echo $data['contact_info']['support_email']; ?>" class="form-control">
                    <small class="form-help">For customer support emails</small>
                </div>
                
                <div class="form-group">
                    <label>Emergency Contact</label>
                    <input type="tel" id="emergencyContact" value="<?php echo $data['contact_info']['emergency_contact']; ?>" class="form-control">
                    <small class="form-help">24/7 emergency contact number</small>
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="contact-card">
            <div class="card-header">
                <h3>Address & Location</h3>
            </div>
            <div class="contact-form">
                <div class="form-group">
                    <label>Business Address</label>
                    <textarea id="businessAddress" rows="3" class="form-control"><?php echo $data['contact_info']['address']; ?></textarea>
                    <small class="form-help">Full business address with postal code</small>
                </div>
                
                <div class="form-group">
                    <label>Working Hours</label>
                    <input type="text" id="workingHours" value="<?php echo $data['contact_info']['working_hours']; ?>" class="form-control">
                    <small class="form-help">Business operating hours</small>
                </div>
                
                <div class="form-group">
                    <label>Google Maps Embed Code</label>
                    <textarea id="mapsEmbed" rows="4" class="form-control" placeholder="<iframe src='...' ></iframe>"></textarea>
                    <small class="form-help">Paste Google Maps embed code for location display</small>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="contact-card">
            <div class="card-header">
                <h3>Social Media Links</h3>
            </div>
            <div class="contact-form">
                <div class="form-group">
                    <label>Facebook Page</label>
                    <input type="url" id="facebookUrl" placeholder="https://facebook.com/bookmyground" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Instagram Profile</label>
                    <input type="url" id="instagramUrl" placeholder="https://instagram.com/bookmyground" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Twitter/X Profile</label>
                    <input type="url" id="twitterUrl" placeholder="https://twitter.com/bookmyground" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>LinkedIn Company Page</label>
                    <input type="url" id="linkedinUrl" placeholder="https://linkedin.com/company/bookmyground" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>YouTube Channel</label>
                    <input type="url" id="youtubeUrl" placeholder="https://youtube.com/@bookmyground" class="form-control">
                </div>
            </div>
        </div>

        <!-- Contact Form Settings -->
        <div class="contact-card">
            <div class="card-header">
                <h3>Contact Form Settings</h3>
            </div>
            <div class="contact-form">
                <div class="form-group">
                    <label>Form Recipient Email</label>
                    <input type="email" id="formRecipient" placeholder="admin@bookmyground.lk" class="form-control">
                    <small class="form-help">Email address to receive contact form submissions</small>
                </div>
                
                <div class="form-group">
                    <label>Auto-Reply Message</label>
                    <textarea id="autoReply" rows="4" class="form-control" placeholder="Thank you for contacting us. We will get back to you within 24 hours."></textarea>
                    <small class="form-help">Automatic reply message sent to users</small>
                </div>
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="enableCaptcha" checked>
                            <span class="checkmark"></span>
                            Enable reCAPTCHA protection
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="enableNotifications" checked>
                            <span class="checkmark"></span>
                            Send email notifications for new submissions
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="contact-card">
            <div class="card-header">
                <h3>Additional Information</h3>
            </div>
            <div class="contact-form">
                <div class="form-group">
                    <label>WhatsApp Business Number</label>
                    <input type="tel" id="whatsappNumber" placeholder="+94 71 234 5678" class="form-control">
                    <small class="form-help">For WhatsApp Business integration</small>
                </div>
                
                <div class="form-group">
                    <label>Skype ID</label>
                    <input type="text" id="skypeId" placeholder="bookmyground.support" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Business Registration Number</label>
                    <input type="text" id="businessReg" placeholder="PV 12345" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Tax Identification Number</label>
                    <input type="text" id="taxId" placeholder="123456789V" class="form-control">
                </div>
            </div>
        </div>

        <!-- Contact Page Content -->
        <div class="contact-card full-width">
            <div class="card-header">
                <h3>Contact Page Content</h3>
            </div>
            <div class="contact-form">
                <div class="form-group">
                    <label>Page Headline</label>
                    <input type="text" id="pageHeadline" value="Get in Touch with BookMyGround" class="form-control">
                </div>
                
                <div class="form-group">
                    <label>Page Description</label>
                    <textarea id="pageDescription" rows="4" class="form-control">Have questions about our services? Need help with a booking? Our friendly team is here to assist you. Reach out to us through any of the channels below and we'll get back to you as soon as possible.</textarea>
                </div>
                
                <div class="form-group">
                    <label>Additional Information</label>
                    <textarea id="additionalInfo" rows="3" class="form-control" placeholder="Any additional information you want to display on the contact page..."></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Statistics -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Contact Form Statistics</h3>
        </div>
        <div class="contact-stats">
            <div class="stat-item">
                <div class="stat-icon">📧</div>
                <div class="stat-details">
                    <span class="stat-number">245</span>
                    <span class="stat-label">Messages This Month</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">📞</div>
                <div class="stat-details">
                    <span class="stat-number">89</span>
                    <span class="stat-label">Phone Inquiries</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">⚡</div>
                <div class="stat-details">
                    <span class="stat-number">2.5 hrs</span>
                    <span class="stat-label">Avg Response Time</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">📈</div>
                <div class="stat-details">
                    <span class="stat-number">94%</span>
                    <span class="stat-label">Customer Satisfaction</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Contact Form Submissions -->
    <div class="dashboard-card">
        <div class="card-header">
            <h3>Recent Contact Form Entries</h3>
            <a href="<?php echo URLROOT; ?>/admin/messages" class="view-all">View All Messages →</a>
        </div>
        <div class="submissions-list">
            <div class="submission-item">
                <div class="submission-info">
                    <h4>Janaka Rathnayake</h4>
                    <p>john.silva@email.com</p>
                    <small>Inquiry about stadium booking - 2 hours ago</small>
                </div>
                <div class="submission-status unread">New</div>
            </div>
            <div class="submission-item">
                <div class="submission-info">
                    <h4>Sarath Perera</h4>
                    <p>sarath@company.lk</p>
                    <small>Equipment rental question - 5 hours ago</small>
                </div>
                <div class="submission-status read">Read</div>
            </div>
            <div class="submission-item">
                <div class="submission-info">
                    <h4>Pallavi Gunasekara</h4>
                    <p>mike.f@gmail.com</p>
                    <small>Coaching session inquiry - 1 day ago</small>
                </div>
                <div class="submission-status replied">Replied</div>
            </div>
        </div>
    </div>
</div>

<script>
function saveContactInfo() {
    // Collect all form data
    const contactData = {
        mainPhone: document.getElementById('mainPhone').value,
        supportPhone: document.getElementById('supportPhone').value,
        mainEmail: document.getElementById('mainEmail').value,
        supportEmail: document.getElementById('supportEmail').value,
        emergencyContact: document.getElementById('emergencyContact').value,
        businessAddress: document.getElementById('businessAddress').value,
        workingHours: document.getElementById('workingHours').value,
        mapsEmbed: document.getElementById('mapsEmbed').value,
        facebookUrl: document.getElementById('facebookUrl').value,
        instagramUrl: document.getElementById('instagramUrl').value,
        twitterUrl: document.getElementById('twitterUrl').value,
        linkedinUrl: document.getElementById('linkedinUrl').value,
        youtubeUrl: document.getElementById('youtubeUrl').value,
        formRecipient: document.getElementById('formRecipient').value,
        autoReply: document.getElementById('autoReply').value,
        enableCaptcha: document.getElementById('enableCaptcha').checked,
        enableNotifications: document.getElementById('enableNotifications').checked,
        whatsappNumber: document.getElementById('whatsappNumber').value,
        skypeId: document.getElementById('skypeId').value,
        businessReg: document.getElementById('businessReg').value,
        taxId: document.getElementById('taxId').value,
        pageHeadline: document.getElementById('pageHeadline').value,
        pageDescription: document.getElementById('pageDescription').value,
        additionalInfo: document.getElementById('additionalInfo').value
    };
    
    // Here you would make an AJAX call to save the data
    console.log('Saving contact information:', contactData);
    alert('Contact information saved successfully!');
}

function previewContact() {
    window.open('<?php echo URLROOT; ?>/contact?preview=1', '_blank');
}

// Auto-save functionality
let autoSaveTimer;
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('input', function() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            // Auto-save draft
            console.log('Auto-saving contact info...');
        }, 2000);
    });
});

// Form validation
function validateContactInfo() {
    const requiredFields = ['mainPhone', 'mainEmail', 'businessAddress'];
    let isValid = true;
    
    requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if(!field.value.trim()) {
            field.style.borderColor = '#ff4444';
            isValid = false;
        } else {
            field.style.borderColor = '';
        }
    });
    
    return isValid;
}

// Social media URL validation
document.querySelectorAll('input[type="url"]').forEach(input => {
    input.addEventListener('blur', function() {
        if(this.value && !this.value.startsWith('http')) {
            this.value = 'https://' + this.value;
        }
    });
});
</script>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>