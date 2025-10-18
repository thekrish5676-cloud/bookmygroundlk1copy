<?php require APPROOT.'/views/inc/components/header.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up as Coach - BookMyGround</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Coach Sign Up Section -->
  <section class="user-signup-section">
    <div class="signup-container">
      <!-- Left Side - Welcome Text -->
      <div class="welcome-content">
        <h1 class="sign-in-dis">JOIN AS A <span class="green">COACH</span></h1>
        <p class="description">
          Share your expertise, connect with athletes, and grow your coaching career 
          — become part of our thriving sports community.
        </p>
        
        <div class="features-list">
          <div class="feature-item">
            <span class="feature-icon">📅</span>
            <p>Flexible scheduling system</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">👥</span>
            <p>Manage multiple students</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">🏆</span>
            <p>Showcase your achievements</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">💰</span>
            <p>Secure payment system</p>
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
          <h2 class="signup-heading">Create Coach Account</h2>
          
          <div class="form-row">
            <div class="form-group">
              <label for="first-name" class="signup-label">First Name</label>
              <input type="text" id="first-name" name="first-name" class="signup-input" placeholder="First name" required>
            </div>
            <div class="form-group">
              <label for="last-name" class="signup-label">Last Name</label>
              <input type="text" id="last-name" name="last-name" class="signup-input" placeholder="Last name" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email" class="signup-label">Email</label>
              <input type="email" id="email" name="email" class="signup-input" placeholder="Your email" required>
            </div>
            <div class="form-group">
              <label for="phone" class="signup-label">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="signup-input" placeholder="Contact number" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="specialization" class="signup-label">Sports Specialization</label>
              <select id="specialization" name="specialization" class="signup-input" required>
                <option value="" disabled selected>Select primary sport</option>
                <option value="football">Football</option>
                <option value="cricket">Cricket</option>
                <option value="basketball">Badminton</option>
                <option value="tennis">Tennis</option>
                <option value="swimming">Swimming</option>
                <option value="other">Other</option>

              </select>
            </div>
            <div class="form-group">
              <label for="experience" class="signup-label">Years of Experience</label>
              <select id="experience" name="experience" class="signup-input" required>
                <option value="" disabled selected>Select experience</option>
                <option value="1-3">1-3 years</option>
                <option value="4-6">4-6 years</option>
                <option value="7-10">7-10 years</option>
                <option value="10+">10+ years</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="certification" class="signup-label">Certification Level</label>
              <select id="certification" name="certification" class="signup-input" required>
                <option value="" disabled selected>Select certification</option>
                <option value="basic">Basic Certification</option>
                <option value="intermediate">Intermediate Level</option>
                <option value="advanced">Advanced Level</option>
                <option value="professional">Professional License</option>
              </select>
            </div>
            <div class="form-group">
              <label for="coaching-type" class="signup-label">Coaching Type</label>
              <select id="coaching-type" name="coaching-type" class="signup-input" required>
                <option value="" disabled selected>Select type</option>
                <option value="individual">Individual Training</option>
                <option value="group">Group Sessions</option>
                <option value="both">Both Individual & Group</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="district" class="signup-label">District</label>
              <input type="text" id="district" name="district" class="signup-input" placeholder="Your district" required>
            </div>
            <div class="form-group">
              <label for="availability" class="signup-label">Availability</label>
              <select id="availability" name="availability" class="signup-input" required>
                <option value="" disabled selected>Select availability</option>
                <option value="full-time">Full Time</option>
                <option value="part-time">Part Time</option>
                <option value="weekends">Weekends Only</option>
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

          <button type="submit" class="signup-button">Create Coach Account</button>
      </form>
    </div>
  </section>
</body>
</html>
<?php require APPROOT.'/views/inc/components/footer.php'; ?>