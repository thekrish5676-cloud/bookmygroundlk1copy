<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Stadium Owner SignUp | BookMyGround.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Owner Sign Up Section -->
  <section class="user-signup-section">
    <div class="signup-container">
      <!-- Left Side - Welcome Text -->
      <div class="welcome-content">
        <h1 class="sign-in-dis">JOIN AS A <span class="green">VENUE OWNER</span></h1>
        <p class="description">
          List your sports facilities, manage bookings efficiently, and grow your business 
          with our platform — reach more athletes and simplify management.
        </p>
        
        <div class="features-list">
          <div class="feature-item">
            <span class="feature-icon">📊</span>
            <p>Manage multiple venues effortlessly</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">💰</span>
            <p>Secure online payments and bookings</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">📱</span>
            <p>Real-time availability updates</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">📈</span>
            <p>Analytics and business insights</p>
          </div>
        </div>

        <div class="auth-options">
          <p class="auth-text">Already have an account?</p>
          <div class="auth-buttons">
            <a href="login.html" class="hero-btn primary">Sign In</a>
            <a href="signup.html" class="hero-btn">Back to Options</a>
          </div>
        </div>
      </div>

      <!-- Right Side - Sign Up Form -->
      <div class="signup-form-container">
        <form class="signup-form">
          <h2 class="signup-heading">Create Venue Owner Account</h2>
          
          <div class="form-row">
            <div class="form-group">
              <label for="owner-name" class="signup-label">Owner Name</label>
              <input type="text" id="owner-name" name="owner-name" class="signup-input" placeholder="Full name" required>
            </div>
            <div class="form-group">
              <label for="business-name" class="signup-label">Business Name</label>
              <input type="text" id="business-name" name="business-name" class="signup-input" placeholder="Business name" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email" class="signup-label">Email</label>
              <input type="email" id="email" name="email" class="signup-input" placeholder="Business email" required>
            </div>
            <div class="form-group">
              <label for="phone" class="signup-label">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="signup-input" placeholder="Contact number" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="district" class="signup-label">District</label>
              <input type="text" id="district" name="district" class="signup-input" placeholder="District location" required>
            </div>
            <div class="form-group">
              <label for="venue-type" class="signup-label">Venue Type</label>
              <select id="venue-type" name="venue-type" class="signup-input" required>
                <option value="" disabled selected>Select venue type</option>
                <option value="stadium">Stadium</option>
                <option value="indoor-court">Indoor Court</option>
                <option value="outdoor-court">Outdoor Court</option>
                <option value="sports-complex">Sports Complex</option>
                <option value="practice-nets">Practice Nets</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="business-reg" class="signup-label">Business Registration Number</label>
              <input type="text" id="business-reg" name="business-reg" class="signup-input" placeholder="Registration number" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="password" class="signup-label">Password</label>
              <input type="password" id="password" name="password" class="signup-input" placeholder="Create password" required>
            </div>
            <div class="form-group">
              <label for="confirm-password" class="signup-label">Confirm Password</label>
              <input type="password" id="confirm-password" name="confirm-password" class="signup-input" placeholder="Confirm password" required>
            </div>
          </div>

          <button type="submit" class="signup-button">Create Owner Account</button>
        </form>
      </div>
    </div>
  </section>
      </form>
    </div>
  </section>
</body>
</html>
<?php require APPROOT.'/views/inc/components/footer.php'; ?>