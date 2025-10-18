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
            <a href="<?php echo URLROOT; ?>/auth/login" class="hero-btn primary">Sign In</a>
            <a href="<?php echo URLROOT; ?>/auth/register" class="hero-btn">Back to Options</a>
          </div>
        </div>
      </div>

      <!-- Right Side - Sign Up Form -->
      <div class="signup-form-container">
        <!-- Display General Error -->
        <?php if(!empty($data['error'])): ?>
          <div class="alert alert-error" style="background: #fee; border: 1px solid #fcc; padding: 15px; margin-bottom: 20px; border-radius: 5px; color: #c33;">
            <?php echo $data['error']; ?>
          </div>
        <?php endif; ?>

        <form class="signup-form" action="<?php echo URLROOT; ?>/auth/register/customer" method="POST">
          <h2 class="signup-heading">Create User Account</h2>
          
          <div class="form-row">
            <div class="form-group">
              <label for="first-name" class="signup-label">First Name</label>
              <input type="text" id="first-name" name="first-name" class="signup-input" 
                     placeholder="First name" 
                     value="<?php echo $data['first_name']; ?>" 
                     required>
              <?php if(!empty($data['error_first_name'])): ?>
                <span class="error-text" style="color: #c33; font-size: 12px;"><?php echo $data['error_first_name']; ?></span>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="last-name" class="signup-label">Last Name</label>
              <input type="text" id="last-name" name="last-name" class="signup-input" 
                     placeholder="Last name" 
                     value="<?php echo $data['last_name']; ?>" 
                     required>
              <?php if(!empty($data['error_last_name'])): ?>
                <span class="error-text" style="color: #c33; font-size: 12px;"><?php echo $data['error_last_name']; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email" class="signup-label">Email</label>
              <input type="email" id="email" name="email" class="signup-input" 
                     placeholder="Your email" 
                     value="<?php echo $data['email']; ?>" 
                     required>
              <?php if(!empty($data['error_email'])): ?>
                <span class="error-text" style="color: #c33; font-size: 12px;"><?php echo $data['error_email']; ?></span>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="phone" class="signup-label">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="signup-input" 
                     placeholder="Contact number" 
                     value="<?php echo $data['phone']; ?>" 
                     required>
              <?php if(!empty($data['error_phone'])): ?>
                <span class="error-text" style="color: #c33; font-size: 12px;"><?php echo $data['error_phone']; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="password" class="signup-label">Password</label>
              <input type="password" id="password" name="password" class="signup-input" 
                     placeholder="Create password (min 8 characters)" 
                     required>
              <?php if(!empty($data['error_password'])): ?>
                <span class="error-text" style="color: #c33; font-size: 12px;"><?php echo $data['error_password']; ?></span>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="confirm-password" class="signup-label">Confirm Password</label>
              <input type="password" id="confirm-password" name="confirm-password" class="signup-input" 
                     placeholder="Confirm password" 
                     required>
              <?php if(!empty($data['error_confirm_password'])): ?>
                <span class="error-text" style="color: #c33; font-size: 12px;"><?php echo $data['error_confirm_password']; ?></span>
              <?php endif; ?>
            </div>
          </div>

          <button type="submit" class="signup-button">Create Account</button>

          <p class="signup-info">
            By creating an account, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
          </p>
        </form>
      </div>
    </div>
  </section>
</body>
</html>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>