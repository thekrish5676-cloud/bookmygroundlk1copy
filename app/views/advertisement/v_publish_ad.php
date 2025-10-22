<?php require_once APPROOT . '/views/inc/Components/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/publish-ad.css">

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>🎯 Publish Your Advertisement</h1>
        <p>Reach thousands of sports enthusiasts and grow your business with BookMyGround's premium advertising platform</p>
    </div>

    <!-- Benefits Section -->
    <div class="benefits-section">
        <h2>Why Advertise With Us?</h2>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">👥</div>
                <h3>Massive Reach</h3>
                <p>Connect with thousands of sports enthusiasts, stadium owners, and athletes daily</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🎯</div>
                <h3>Targeted Audience</h3>
                <p>Your ads reach people actively searching for sports-related services</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">📈</div>
                <h3>High Visibility</h3>
                <p>Premium placements on top of our high-traffic website pages</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">💰</div>
                <h3>Affordable Pricing</h3>
                <p>Competitive rates with flexible packages to suit your budget</p>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="pricing-section">
        <h2>📊 Advertising Packages</h2>
        <div class="pricing-cards">
            <?php foreach($data['packages'] as $key => $package): ?>
            <div class="pricing-card <?php echo isset($package['popular']) ? 'featured' : ''; ?>">
                <?php if(isset($package['popular'])): ?>
                <span class="featured-badge">POPULAR</span>
                <?php endif; ?>
                <h3><?php echo $package['name']; ?></h3>
                <div class="price">Rs. <?php echo number_format($package['price']); ?><span>/<?php echo $package['duration']; ?></span></div>
                <ul class="features-list">
                    <?php foreach($package['features'] as $feature): ?>
                    <li><?php echo $feature; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-section">
        <h2>📝 Submit Your Advertisement</h2>
        
        <?php if(isset($_SESSION['ad_success'])): ?>
        <div class="success-message show">
            ✅ <?php echo $_SESSION['ad_success']; unset($_SESSION['ad_success']); ?>
        </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['ad_errors'])): ?>
        <div class="error-message show">
            <?php foreach($_SESSION['ad_errors'] as $error): ?>
                <p>❌ <?php echo $error; ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['ad_errors']); ?>
        </div>
        <?php endif; ?>

        <form action="<?php echo URLROOT; ?>/advertisement/submit" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="companyName">Company/Business Name *</label>
                <input type="text" id="companyName" name="companyName" required 
                       value="<?php echo $_SESSION['ad_form_data']['company_name'] ?? ''; ?>"
                       placeholder="Enter your company name">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="contactName">Contact Person *</label>
                    <input type="text" id="contactName" name="contactName" required 
                           value="<?php echo $_SESSION['ad_form_data']['contact_name'] ?? ''; ?>"
                           placeholder="Your name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required 
                           value="<?php echo $_SESSION['ad_form_data']['email'] ?? ''; ?>"
                           placeholder="your@email.com">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required 
                           value="<?php echo $_SESSION['ad_form_data']['phone'] ?? ''; ?>"
                           placeholder="+94 XX XXX XXXX">
                </div>

                <div class="form-group">
                    <label for="package">Select Package *</label>
                    <select id="package" name="package" required>
                        <option value="">Choose a package</option>
                        <option value="basic">Basic - Rs. 5,000/week</option>
                        <option value="professional">Professional - Rs. 12,000/month</option>
                        <option value="premium">Premium - Rs. 30,000/3 months</option>
                        <option value="custom">Custom Package</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="website">Website/Social Media URL</label>
                <input type="url" id="website" name="website" 
                       value="<?php echo $_SESSION['ad_form_data']['website'] ?? ''; ?>"
                       placeholder="https://yourwebsite.com">
            </div>

            <div class="form-group">
                <label for="adFile">Upload Advertisement Material</label>
                <input type="file" id="adFile" name="adFile" accept="image/*,.pdf">
                <small>Accepted formats: JPG, PNG, PDF (Max 5MB). We'll help you design if needed.</small>
            </div>

            <div class="form-group">
                <label for="message">Additional Information</label>
                <textarea id="message" name="message" placeholder="Tell us about your advertising goals, target audience, or any special requirements..."><?php echo $_SESSION['ad_form_data']['message'] ?? ''; ?></textarea>
            </div>

            <button type="submit" class="btn">Submit Advertisement Request</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo URLROOT; ?>'">← Back to Homepage</button>
        </form>
    </div>
</div>

<script>
// Publish Advertisement Page JavaScript

function handleSubmit(event) {
    event.preventDefault();
    
    // Get form data
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    
    // Show success message
    const successMessage = document.getElementById('successMessage');
    successMessage.classList.add('show');
    
    // Scroll to success message
    successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
    
    // Reset form
    event.target.reset();
    
    // Hide success message after 5 seconds
    setTimeout(() => {
        successMessage.classList.remove('show');
    }, 5000);
    
    // In a real application, you would send this data to your server
    console.log('Advertisement Request:', data);
    
    return false;
}

// Add animation on scroll
function animateOnScroll() {
    const cards = document.querySelectorAll('.pricing-card, .benefit-card');
    cards.forEach(card => {
        const cardTop = card.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
        if (cardTop < windowHeight - 50) {
            card.classList.add('animate');
        }
    });
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', () => {
    // Trigger initial animation
    animateOnScroll();
    
    // Add scroll listener
    window.addEventListener('scroll', animateOnScroll);
});
</script>

<?php unset($_SESSION['ad_form_data']); ?>
<?php require_once APPROOT . '/views/inc/Components/footer.php'; ?>