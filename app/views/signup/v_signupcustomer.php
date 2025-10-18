<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User SignUp | BookMyGround.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- User Sign Up Section -->
  <section class="user-signup-section">
    <div class="signup-container">
      <!-- Left Side - Welcome Text -->
      <div class="welcome-content">
        <h1 class="sign-in-dis">JOIN AS A <span class="green">USER</span></h1>
        <p class="description">
          Create your account to book stadiums, join practice sessions,
          and get coaching — start your sports journey today!
        </p>
        
        <div class="features-list">
          <div class="feature-item">
            <span class="feature-icon">🎯</span>
            <p>Quick and easy stadium booking</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">🤝</span>
            <p>Join practice sessions with other players</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">👨‍🏫</span>
            <p>Connect with professional coaches</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">📅</span>
            <p>Manage all your bookings in one place</p>
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
          <h2 class="signup-heading">Create User Account</h2>
          
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
              <label for="district" class="signup-label">District</label>
              <input type="text" id="district" name="district" class="signup-input" placeholder="Your district" required>
            </div>
            <div class="form-group">
              <label for="sports" class="signup-label">Preferred Sports</label>
              <select id="sports" name="sports" class="signup-input" required>
                <option value="" disabled selected>Select primary sport</option>
                <option value="football">Football</option>
                <option value="cricket">Cricket</option>
                <option value="basketball">Badminton</option>
                <option value="tennis">Tennis</option>
                <option value="swimming">Other</option>
              
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="age-group" class="signup-label">Age Group</label>
              <select id="age-group" name="age-group" class="signup-input" required>
                <option value="" disabled selected>Select age group</option>
                <option value="under-18">Under 18</option>
                <option value="18-25">18-25 years</option>
                <option value="26-35">26-35 years</option>
                <option value="above-35">Above 35</option>
              </select>
            </div>
            <div class="form-group">
              <label for="skill-level" class="signup-label">Skill Level</label>
              <select id="skill-level" name="skill-level" class="signup-input" required>
                <option value="" disabled selected>Select skill level</option>
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
                <option value="professional">Professional</option>
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

          <button type="submit" class="signup-button">Create Account</button>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
<?php require APPROOT.'/views/inc/components/footer.php'; ?>