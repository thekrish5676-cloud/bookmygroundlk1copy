<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rental Service SignUp | BookMyGround.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Rental Service Sign Up Section -->
  <section class="user-signup-section">
    <div class="signup-container">
      <!-- Left Side - Welcome Text -->
      <div class="welcome-content">
        <h1 class="sign-in-dis">JOIN AS A <span class="green">RENTAL SERVICE</span></h1>
        <p class="description">
          List your sports equipment, manage rentals efficiently, and expand your business reach 
          — be part of the ultimate sports equipment marketplace.
        </p>
        
        <div class="features-list">
          <div class="feature-item">
            <span class="feature-icon">🏷️</span>
            <p>List multiple equipment categories</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">📦</span>
            <p>Easy inventory management</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">💳</span>
            <p>Secure rental payments</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">📊</span>
            <p>Track rentals and returns</p>
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
          <h2 class="signup-heading">Create Rental Service Account</h2>
          
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
              <label for="business-type" class="signup-label">Business Type</label>
              <select id="business-type" name="business-type" class="signup-input" required>
                <option value="" disabled selected>Select business type</option>
                <option value="retail-chain">Retail Chain</option>
                <option value="independent">Independent Store</option>
                <option value="sports-shop">Sports Shop</option>
                <option value="equipment-specialist">Equipment Specialist</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="equipment-categories" class="signup-label">Equipment Categories</label>
              <select id="equipment-categories" name="equipment-categories" class="signup-input" required>
                <option value="" disabled selected>Select main category</option>
                <option value="team-sports">Team Sports Equipment</option>
                <option value="fitness">Fitness Equipment</option>
                <option value="outdoor">Outdoor Sports Gear</option>
                <option value="protective">Protective Equipment</option>
              </select>
            </div>
            <div class="form-group">
              <label for="delivery-service" class="signup-label">Delivery Service</label>
              <select id="delivery-service" name="delivery-service" class="signup-input" required>
                <option value="" disabled selected>Select delivery option</option>
                <option value="yes">Yes, We Deliver</option>
                <option value="no">Pickup Only</option>
              </select>
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

          <button type="submit" class="signup-button">Create Rental Account</button>
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