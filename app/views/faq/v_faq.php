<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FAQ | BookMyGround.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Title Section -->
  <section class="faq-title-section">
    <div class="title-container">
      <h1 class="faq-main-title">Frequently Asked Questions</h1>
      <p class="faq-subtitle">Find answers to common questions about BookMyGround.com</p>
    </div>
  </section>

  <!-- Hero Section -->
  <section class="faq-hero">
    <div class="hero-text">
      <p class="hero-dis">
        <span class="green">GOT QUESTIONS?</span><br>
        <span class="description">
          Find answers to common questions about booking stadiums, renting equipment, 
          coaching sessions, and more. Your sports journey <span class="green">starts with clarity!</span>
        </span>
      </p>
      <div class="hero-buttons">
        <a href="#general" class="btn faq-btn">General Questions</a>
        <a href="#booking" class="btn faq-btn">Booking Help</a>
      </div>
    </div>
  </section>

  <!-- Search Section -->
  <section class="search-section">
    <div class="search-container">
      <div class="search-box">
        <input type="text" id="faq-search" placeholder="Search for questions..." class="search-input">
        <button class="search-btn">🔍</button>
      </div>
      <p class="search-hint">Type keywords like "booking", "payment", "cancellation" to find relevant answers</p>
    </div>
  </section>

  <!-- FAQ Categories -->
  <section class="faq-categories">
    <div class="categories-container">
      <div class="category-card" data-category="general">
        <div class="category-icon">❓</div>
        <h3>General Questions</h3>
        <p>Basic information about our platform</p>
        <span class="question-count">4 questions</span>
      </div>
      <div class="category-card" data-category="booking">
        <div class="category-icon">📅</div>
        <h3>Booking & Reservations</h3>
        <p>How to book stadiums and manage reservations</p>
        <span class="question-count">4 questions</span>
      </div>
      <div class="category-card" data-category="payment">
        <div class="category-icon">💳</div>
        <h3>Payment & Billing</h3>
        <p>Payment methods and billing information</p>
        <span class="question-count">3 questions</span>
      </div>
      <div class="category-card" data-category="equipment">
        <div class="category-icon">⚽</div>
        <h3>Equipment Rental</h3>
        <p>Renting sports equipment and gear</p>
        <span class="question-count">2 questions</span>
      </div>
      <div class="category-card" data-category="coaching">
        <div class="category-icon">👨‍🏫</div>
        <h3>Coaching Services</h3>
        <p>Professional coaching and training</p>
        <span class="question-count">2 questions</span>
      </div>
      <div class="category-card" data-category="account">
        <div class="category-icon">👤</div>
        <h3>Account & Profile</h3>
        <p>Managing your account and profile</p>
        <span class="question-count">2 questions</span>
      </div>
    </div>
  </section>

  <!-- FAQ Content -->
  <section class="faq-content">
    <div class="faq-container">
      
      <!-- General Questions -->
      <div class="faq-section" id="general">
        <h2 class="section-heading">General Questions</h2>
        
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>What is BookMyGround.com?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>BookMyGround.com is a dedicated sports booking platform that allows you to book stadiums and grounds online. We also list advertisements for rental services and coaches, making it easier for you to find the support you need for your sports activities.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>How do I get started on BookMyGround?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Getting started is easy! Just create an account under your user role (customer, stadium owner, rental service provider, or coach). Once registered, you can immediately browse available stadiums, equipment, and coaching services—and book your first session within minutes.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>Is BookMyGround available in my city?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>We’re rapidly expanding across Sri Lanka! Currently, our services are available in major cities, including the Colombo area. Visit our locations page for the most up-to-date coverage.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>What sports do you support?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>We support a wide range of sports, including football, cricket, badminton, and many more. Our platform caters to both individual players and teams looking for facilities and services.</p>
          </div>
        </div>
      </div>

      <!-- Booking Questions -->
      <div class="faq-section" id="booking">
        <h2 class="section-heading">Booking & Reservations</h2>
        
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>How far in advance can I book a stadium?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>You can book stadiums up to 28 days in advance. This helps with proper planning while keeping availability fair for all users. For popular venues, we recommend booking at least 2–3 weeks early.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>Can I cancel or modify my booking?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Yes! You can cancel your booking up to 12 hours before the scheduled time.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>Do I need to make a payment to confirm my booking?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Yes, all bookings must be confirmed with an online payment. This ensures your slot is reserved and prevents double-booking. Payment details and receipts will be provided immediately after your booking.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>Can I book for a group or team?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Absolutely! We support both individual and group bookings. You can book for teams, organize tournaments, or reserve multiple time slots. For large group bookings or special arrangements, please contact our support team.</p>
          </div>
        </div>
      </div>

      <!-- Payment Questions -->
      <div class="faq-section" id="payment">
        <h2 class="section-heading">Payment & Billing</h2>
        
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>What payment methods do you accept?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>We currently accept credit and debit card payments. We plan to add more payment options in the future.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>When do I get charged for my booking?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Payments are processed immediately upon booking confirmation.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>Do you offer refunds?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Yes. We offer full refunds (excluding handling fees) for cancellations made at least 12 hours before the scheduled booking time.
Cancellations made within 12 hours of the booking will not be eligible for a refund.</p>
          </div>
        </div>
      </div>

      <!-- Equipment Questions -->
      <div class="faq-section" id="equipment">
        <h2 class="section-heading">Equipment Rental</h2>
        
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>What equipment can I rent?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>We provide access to a wide range of sports equipment, including balls, rackets, protective gear, training equipment, and more. Availability may vary depending on the rental service provider. You can check what’s available at your selected provider through our platform.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>How much does equipment rental cost?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Rental prices depend on the type of equipment and the duration of use. Basic items like balls and rackets typically start at LKR 50–100 per session. However, the final prices are determined by each rental service provider. Please note that we do not handle rental bookings directly — we only publish their advertisements. You can contact the provider via our website to confirm rates and arrange rentals.</p>
          </div>
        </div>
      </div>

      <!-- Coaching Questions -->
      <div class="faq-section" id="coaching">
        <h2 class="section-heading">Coaching Services</h2>
        
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>How do I find a coach?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Browse our coaching section to find certified coaches in your area. You can filter by sport, location, experience level, and price. Each coach has a detailed profile with qualifications, experience, and student reviews.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>What are the coaching rates?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Coaching rates vary depending on the coach’s experience, the sport, and the session duration. Individual sessions typically range from LKR 500–2000 per hour. Many coaches also offer group sessions and package deals at discounted rates.
                Please note that we do not provide direct booking services for coaching — we only publish their advertisements. You can contact the coaches directly via our platform for detailed pricing and arrangements.</p>
          </div>
        </div>
      </div>

      <!-- Account Questions -->
      <div class="faq-section" id="account">
        <h2 class="section-heading">Account & Profile</h2>
        
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>How do I update my profile information?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>Go to your dashboard and click on the Profile section. You can update your personal information, contact details, preferences, and profile picture.</p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <h3>Can I have multiple accounts?</h3>
            <span class="toggle-icon">+</span>
          </div>
          <div class="faq-answer">
            <p>We recommend using one account per person for better tracking and management. However, if you need separate accounts for business purposes, please contact our support team for assistance.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Contact Support Section -->
  <section class="support-section">
    <div class="support-container">
      <div class="support-content">
        <h2>Still Have Questions?</h2>
        <p>Can't find what you're looking for? Our support team is here to help!</p>
        <div class="support-actions">
          <a href="mailto:support@bookmyground.com" class="support-btn email-btn">📧 Email Support</a>
          <a href="tel:+91-1800-123-4567" class="support-btn phone-btn">📞 Call Us</a>
          <a href="#live-chat" class="support-btn chat-btn">💬 Live Chat</a>
        </div>
        <div class="support-info">
          <p><strong>Response Time:</strong> Within 24 hours</p>
          <p><strong>Business Hours:</strong> 24/7, all year round (365 days)</p>
        </div>
      </div>
    </div>
  </section>

  <script>
    function toggleFAQ(element) {
      const faqItem = element.parentElement;
      const answer = faqItem.querySelector('.faq-answer');
      const icon = element.querySelector('.toggle-icon');
      
      if (answer.style.maxHeight) {
        answer.style.maxHeight = null;
        icon.textContent = '+';
        faqItem.classList.remove('active');
      } else {
        answer.style.maxHeight = answer.scrollHeight + "px";
        icon.textContent = '−';
        faqItem.classList.add('active');
      }
    }

    // Search functionality
    document.getElementById('faq-search').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const faqItems = document.querySelectorAll('.faq-item');
      
      faqItems.forEach(item => {
        const question = item.querySelector('h3').textContent.toLowerCase();
        const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
        
        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });

    // Category filtering
    document.querySelectorAll('.category-card').forEach(card => {
      card.addEventListener('click', function() {
        const category = this.dataset.category;
        const faqSections = document.querySelectorAll('.faq-section');
        
        faqSections.forEach(section => {
          if (section.id === category) {
            section.scrollIntoView({ behavior: 'smooth' });
          }
        });
      });
    });
  </script>

</body>
</html>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>