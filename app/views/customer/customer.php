<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | BookMyGround.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Title Section -->
  <section class="dashboard-title-section">
    <div class="title-container">
      <h1 class="dashboard-main-title">Customer Dashboard</h1>
      <p class="dashboard-subtitle">Manage your bookings, explore stadiums, and continue your sports journey</p>
    </div>
  </section>

  <!-- Hero Section -->
  <section class="dashboard-hero">
    <div class="hero-text">
      <p class="welcome-dis">
        <span class="green">WELCOME BACK</span> TO THE GAME<br>
        <span class="description">
          Manage your bookings, explore new stadiums, and continue your sports journey 
          <span class="green">— All from your dashboard!</span>
        </span>
      </p>
      <div class="hero-buttons">
        <a href="#bookings" class="btn dashboard-btn">My Bookings</a>
        <a href="#explore" class="btn dashboard-btn">Explore Stadiums</a>
      </div>
    </div>
  </section>

  <!-- Quick Stats Section -->
  <section class="stats-section">
    <div class="stats-container">
      <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-content">
          <h3 class="stat-number">12</h3>
          <p class="stat-label">Active Bookings</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">🏟️</div>
        <div class="stat-content">
          <h3 class="stat-number">8</h3>
          <p class="stat-label">Stadiums Visited</p>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">⭐</div>
        <div class="stat-content">
          <h3 class="stat-number">4.8</h3>
          <p class="stat-label">Rating Given</p>
        </div>
      </div>
             <div class="stat-card">
         <div class="stat-icon">💰</div>
         <div class="stat-content">
           <h3 class="stat-number">LKR 2,450</h3>
           <p class="stat-label">Total Spent</p>
         </div>
       </div>
    </div>
  </section>

  <!-- Main Dashboard Content -->
  <section class="dashboard-main">
    <div class="dashboard-container">
      
             <!-- Left Sidebar -->
       <div class="dashboard-sidebar">
                   <nav class="sidebar-nav">
            <a href="#overview" class="nav-item active">
              <span class="nav-icon">🏠</span>
              <span class="nav-text">Overview</span>
            </a>
            <a href="#bookings" class="nav-item">
              <span class="nav-icon">📅</span>
              <span class="nav-text">My Bookings</span>
            </a>
            <a href="#stadiums" class="nav-item">
              <span class="nav-icon">🏟️</span>
              <span class="nav-text">Stadiums</span>
            </a>
            <a href="#payments" class="nav-item">
              <span class="nav-icon">💳</span>
              <span class="nav-text">Payments</span>
            </a>
            <a href="#profile" class="nav-item">
              <span class="nav-icon">👤</span>
              <span class="nav-text">Profile</span>
            </a>
          </nav>
       </div>

      <!-- Main Content Area -->
      <div class="dashboard-content">
        
                 <!-- Recent Bookings -->
         <div class="content-section" id="overview">
           <h2 class="section-heading">Recent Bookings</h2>
          <div class="bookings-grid">
            <div class="booking-card">
              <div class="booking-header">
                <h3 class="stadium-name">Central Football Arena</h3>
                <span class="booking-status confirmed">Confirmed</span>
              </div>
                             <div class="booking-details">
                 <p><strong>Date:</strong> Dec 25, 2025</p>
                 <p><strong>Time:</strong> 6:00 PM - 8:00 PM</p>
                 <p><strong>Duration:</strong> 2 hours</p>
                 <p><strong>Amount:</strong> LKR 800</p>
               </div>
              <div class="booking-actions">
                <button class="action-btn view-btn">View Details</button>
                <button class="action-btn cancel-btn">Cancel</button>
              </div>
            </div>

            <div class="booking-card">
              <div class="booking-header">
                <h3 class="stadium-name">Badminton Court Pro</h3>
                <span class="booking-status pending">Pending</span>
              </div>
                             <div class="booking-details">
                 <p><strong>Date:</strong> Dec 28, 2025</p>
                 <p><strong>Time:</strong> 4:00 PM - 6:00 PM</p>
                 <p><strong>Duration:</strong> 2 hours</p>
                 <p><strong>Amount:</strong> LKR 600</p>
               </div>
              <div class="booking-actions">
                <button class="action-btn view-btn">View Details</button>
                <button class="action-btn cancel-btn">Cancel</button>
              </div>
            </div>

            <div class="booking-card">
              <div class="booking-header">
                <h3 class="stadium-name">Tennis Excellence Center</h3>
                <span class="booking-status completed">Completed</span>
              </div>
                             <div class="booking-details">
                 <p><strong>Date:</strong> Dec 20, 2024</p>
                 <p><strong>Time:</strong> 7:00 PM - 9:00 PM</p>
                 <p><strong>Duration:</strong> 2 hours</p>
                 <p><strong>Amount:</strong> LKR 1,200</p>
               </div>
              <div class="booking-actions">
                <button class="action-btn view-btn">View Details</button>
                <button class="action-btn rate-btn">Rate & Review</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="content-section">
          <h2 class="section-heading">Quick Actions</h2>
          <div class="quick-actions-grid">
            <a href="#book-now" class="quick-action-card">
              <div class="action-icon">📅</div>
              <h3>Book Stadium</h3>
              <p>Find and book available stadiums</p>
            </a>
            <a href="#rent-equipment" class="quick-action-card">
              <div class="action-icon">⚽</div>
              <h3>Rent Equipment</h3>
              <p>Get sports equipment on rent</p>
            </a>
            <a href="#find-coach" class="quick-action-card">
              <div class="action-icon">👨‍🏫</div>
              <h3>Find Coach</h3>
              <p>Book professional coaching sessions</p>
            </a>
            <a href="#invite-friends" class="quick-action-card">
              <div class="action-icon">👥</div>
              <h3>Invite Friends</h3>
              <p>Share and play together</p>
            </a>
          </div>
        </div>

        <!-- Upcoming Events -->
        <div class="content-section">
          <h2 class="section-heading">Upcoming Events</h2>
          <div class="events-list">
            <div class="event-item">
              <div class="event-date">
                <span class="day">25</span>
                <span class="month">DEC</span>
              </div>
              <div class="event-details">
                <h4>Football Match - Central Arena</h4>
                <p>6:00 PM - 8:00 PM • 2 hours</p>
                <span class="event-type">Personal Booking</span>
              </div>
              <div class="event-actions">
                <button class="event-btn">View</button>
              </div>
            </div>
            <div class="event-item">
              <div class="event-date">
                <span class="day">28</span>
                <span class="month">DEC</span>
              </div>
              <div class="event-details">
                <h4>Badminton Practice - Court Pro</h4>
                <p>4:00 PM - 6:00 PM • 2 hours</p>
                <span class="event-type">Personal Booking</span>
              </div>
              <div class="event-actions">
                <button class="event-btn">View</button>
              </div>
            </div>
          </div>
                 </div>

         <!-- My Bookings Section -->
         <div class="content-section" id="bookings">
           <h2 class="section-heading">All My Bookings</h2>
           <div class="bookings-grid">
             <div class="booking-card">
               <div class="booking-header">
                 <h3 class="stadium-name">Central Football Arena</h3>
                 <span class="booking-status confirmed">Confirmed</span>
               </div>
               <div class="booking-details">
                 <p><strong>Date:</strong> Dec 25, 2024</p>
                 <p><strong>Time:</strong> 6:00 PM - 8:00 PM</p>
                 <p><strong>Duration:</strong> 2 hours</p>
                 <p><strong>Amount:</strong> LKR 800</p>
               </div>
               <div class="booking-actions">
                 <button class="action-btn view-btn">View Details</button>
                 <button class="action-btn cancel-btn">Cancel</button>
               </div>
             </div>

             <div class="booking-card">
               <div class="booking-header">
                 <h3 class="stadium-name">Badminton Court Pro</h3>
                 <span class="booking-status pending">Pending</span>
               </div>
               <div class="booking-details">
                 <p><strong>Date:</strong> Dec 28, 2024</p>
                 <p><strong>Time:</strong> 4:00 PM - 6:00 PM</p>
                 <p><strong>Duration:</strong> 2 hours</p>
                 <p><strong>Amount:</strong> LKR 600</p>
               </div>
               <div class="booking-actions">
                 <button class="action-btn view-btn">View Details</button>
                 <button class="action-btn cancel-btn">Cancel</button>
               </div>
             </div>

             <div class="booking-card">
               <div class="booking-header">
                 <h3 class="stadium-name">Tennis Excellence Center</h3>
                 <span class="booking-status completed">Completed</span>
               </div>
               <div class="booking-details">
                 <p><strong>Date:</strong> Dec 20, 2024</p>
                 <p><strong>Time:</strong> 7:00 PM - 9:00 PM</p>
                 <p><strong>Duration:</strong> 2 hours</p>
                 <p><strong>Amount:</strong> LKR 1,200</p>
               </div>
               <div class="booking-actions">
                 <button class="action-btn view-btn">View Details</button>
                 <button class="action-btn rate-btn">Rate & Review</button>
               </div>
             </div>

             <div class="booking-card">
               <div class="booking-header">
                 <h3 class="stadium-name">Cricket Ground Elite</h3>
                 <span class="booking-status confirmed">Confirmed</span>
               </div>
               <div class="booking-details">
                 <p><strong>Date:</strong> Jan 5, 2025</p>
                 <p><strong>Time:</strong> 2:00 PM - 5:00 PM</p>
                 <p><strong>Duration:</strong> 3 hours</p>
                 <p><strong>Amount:</strong> LKR 1,500</p>
               </div>
               <div class="booking-actions">
                 <button class="action-btn view-btn">View Details</button>
                 <button class="action-btn cancel-btn">Cancel</button>
               </div>
             </div>
           </div>
         </div>

         <!-- Stadiums Section -->
         <div class="content-section" id="stadiums">
           <h2 class="section-heading">My Stadiums</h2>
           <div class="stadiums-grid">
             <div class="stadium-card">
               <div class="stadium-header">
                 <h3 class="stadium-name">Central Football Arena</h3>
                 <span class="stadium-rating">⭐ 4.8</span>
               </div>
               <div class="stadium-details">
                 <p><strong>Location:</strong> Colombo, Sri Lanka</p>
                 <p><strong>Last Visited:</strong> Dec 25, 2024</p>
                 <p><strong>Total Bookings:</strong> 5 times</p>
                 <p><strong>Favorite Sport:</strong> Football</p>
               </div>
               <div class="stadium-actions">
                 <button class="action-btn book-btn">Book Again</button>
                 <button class="action-btn view-btn">View Details</button>
               </div>
             </div>

             <div class="stadium-card">
               <div class="stadium-header">
                 <h3 class="stadium-name">Badminton Court Pro</h3>
                 <span class="stadium-rating">⭐ 4.6</span>
               </div>
               <div class="stadium-details">
                 <p><strong>Location:</strong> Kandy, Sri Lanka</p>
                 <p><strong>Last Visited:</strong> Dec 28, 2024</p>
                 <p><strong>Total Bookings:</strong> 3 times</p>
                 <p><strong>Favorite Sport:</strong> Basketball</p>
               </div>
               <div class="stadium-actions">
                 <button class="action-btn book-btn">Book Again</button>
                 <button class="action-btn view-btn">View Details</button>
               </div>
             </div>

             <div class="stadium-card">
               <div class="stadium-header">
                 <h3 class="stadium-name">Tennis Excellence Center</h3>
                 <span class="stadium-rating">⭐ 4.9</span>
               </div>
               <div class="stadium-details">
                 <p><strong>Location:</strong> Galle, Sri Lanka</p>
                 <p><strong>Last Visited:</strong> Dec 20, 2024</p>
                 <p><strong>Total Bookings:</strong> 2 times</p>
                 <p><strong>Favorite Sport:</strong> Tennis</p>
               </div>
               <div class="stadium-actions">
                 <button class="action-btn book-btn">Book Again</button>
                 <button class="action-btn view-btn">View Details</button>
               </div>
             </div>
           </div>
         </div>

         <!-- Payments Section -->
         <div class="content-section" id="payments">
           <h2 class="section-heading">Payment History</h2>
           <div class="payments-grid">
             <div class="payment-card">
               <div class="payment-header">
                 <h3 class="payment-id">#PAY-2024-001</h3>
                 <span class="payment-status completed">Completed</span>
               </div>
               <div class="payment-details">
                 <p><strong>Date:</strong> Dec 25, 2024</p>
                 <p><strong>Stadium:</strong> Central Football Arena</p>
                 <p><strong>Method:</strong> Credit Card</p>
                 <p><strong>Amount:</strong> LKR 800</p>
               </div>
               <div class="payment-actions">
                 <button class="action-btn view-btn">View Receipt</button>
                 <button class="action-btn download-btn">Download</button>
               </div>
             </div>

             <div class="payment-card">
               <div class="payment-header">
                 <h3 class="payment-id">#PAY-2024-002</h3>
                 <span class="payment-status pending">Pending</span>
               </div>
               <div class="payment-details">
                 <p><strong>Date:</strong> Dec 28, 2024</p>
                 <p><strong>Stadium:</strong> Badminton Court Pro</p>
                 <p><strong>Method:</strong> Debit Card</p>
                 <p><strong>Amount:</strong> LKR 600</p>
               </div>
               <div class="payment-actions">
                 <button class="action-btn pay-btn">Pay Now</button>
                 <button class="action-btn cancel-btn">Cancel</button>
               </div>
             </div>

             <div class="payment-card">
               <div class="payment-header">
                 <h3 class="payment-id">#PAY-2024-003</h3>
                 <span class="payment-status completed">Completed</span>
               </div>
               <div class="payment-details">
                 <p><strong>Date:</strong> Dec 20, 2024</p>
                 <p><strong>Stadium:</strong> Tennis Excellence Center</p>
                 <p><strong>Method:</strong> Debit Card</p>
                 <p><strong>Amount:</strong> LKR 1,200</p>
               </div>
               <div class="payment-actions">
                 <button class="action-btn view-btn">View Receipt</button>
                 <button class="action-btn download-btn">Download</button>
               </div>
             </div>
           </div>
         </div>

         <!-- Profile Section -->
         <div class="content-section" id="profile">
           <h2 class="section-heading">My Profile</h2>
           <div class="profile-container">
             <div class="profile-info">
               <div class="profile-avatar">
                 <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMjQgMjQiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzY2NiIgc3Ryb2tlLXdpZHRoPSIxLjUiPjxwYXRoIGQ9Ik0yMCAxOXYtMmE0IDQgMCAwMC00LTRIN2E0IDQgMCAwMC00IDR2MiIvPjxjaXJjbGUgY3g9IjEyIiBjeT0iNyIgcj0iNCIvPjwvc3ZnPg==" alt="Profile Picture" id="profile-avatar">
                 <button class="change-avatar-btn">Change Photo</button>
               </div>
                               <div class="profile-details">
                  <div class="profile-field">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter your full name" class="profile-input">
                  </div>
                  <div class="profile-field">
                    <label>Email</label>
                    <input type="email" placeholder="Enter your email address" class="profile-input">
                  </div>
                  <div class="profile-field">
                    <label>Phone</label>
                    <input type="tel" placeholder="Enter your phone number" class="profile-input">
                  </div>
                  <div class="profile-field">
                    <label>Location</label>
                    <input type="text" placeholder="Enter your location" class="profile-input">
                  </div>
                  <div class="profile-field">
                    <label>Favorite Sports</label>
                    <input type="text" placeholder="Enter your favorite sports" class="profile-input">
                  </div>
                  <div class="profile-field">
                    <label>Member Since</label>
                    <input type="text" value="January 2024" class="profile-input" readonly>
                  </div>
                </div>
             </div>
             <div class="profile-actions">
               <button class="action-btn save-btn">Save Changes</button>
               <button class="action-btn reset-btn">Reset</button>
             </div>
           </div>
         </div>

       </div>
     </div>
   </section>

   </body>

  <script>
    // Function to handle navbar highlighting based on scroll position
    function updateActiveNavItem() {
      const sections = document.querySelectorAll('.content-section');
      const navItems = document.querySelectorAll('.nav-item');
      
      let currentSection = '';
      
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 200; // Offset for better detection
        const sectionHeight = section.offsetHeight;
        const scrollPosition = window.scrollY;
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
          currentSection = section.id;
        }
      });
      
      // Update active nav item
      navItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('href') === `#${currentSection}`) {
          item.classList.add('active');
        }
      });
      
      // If no section is active, default to overview
      if (!currentSection) {
        navItems.forEach(item => {
          item.classList.remove('active');
          if (item.getAttribute('href') === '#overview') {
            item.classList.add('active');
          }
        });
      }
    }
    
    // Add smooth scrolling to nav items
    document.querySelectorAll('.nav-item').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);
        
        if (targetSection) {
          targetSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
    
    // Listen for scroll events
    window.addEventListener('scroll', updateActiveNavItem);
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', updateActiveNavItem);
  </script>
 </html>
