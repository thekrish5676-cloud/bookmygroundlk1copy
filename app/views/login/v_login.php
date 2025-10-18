<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | BookMyGround.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Hero Section -->
  <section class="login-hero">
    <div class="hero-text">
      <p class="sign-in-dis">
        <span class="green">WELCOME BACK</span> TO THE GAME<br>
        <span class="description">
          Log in to access your bookings, rentals, coaching sessions,
          and more — your sports journey <span class="green">continues here!</span>
        </span>
      </p>
      <div class="hero-buttons">
        <a href="login.html" class="hero-btn primary">Sign In</a>
        <a href="signup-options.html" class="hero-btn">Sign Up</a>
      </div>
    </div>
    <div class="hero-image">
      <img src="<?php echo URLROOT; ?>/images/login/basketball_player.png" id="basketball" alt="Basketball Player">
    </div>
  </section>

  <!-- Login Content Section -->
  <section class="login-content-section">
    <div class="login-content-container">
      <!-- Left Side - Welcome Text -->
      <div class="welcome-content">
        <h2 class="welcome-heading">YOUR <span class="green">GAME</span>,<br>OUR <span class="green">PRIORITY</span></h2>
        
        <div class="features-list">
          <div class="feature-item">
            <span class="feature-icon">🎯</span>
            <p>Access your personalized dashboard</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">📅</span>
            <p>Track your upcoming bookings</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">⚡</span>
            <p>Quick access to recent venues</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">💬</span>
            <p>Connect with coaches & players</p>
          </div>
        </div>

        <div class="signin-quote">
          <p class="quote-text">"Success in sports requires practice, dedication, and the right facilities. 
          We're here to help you focus on what matters most – your game."</p>
        </div>
      </div>

      <!-- Right Side - Login Form -->
      <div class="login-form-container">
        <form class="login-form">
          <h2 class="login-heading">Welcome Back!</h2>
          
          <div class="form-group">
            <label for="email" class="login-label">Email</label>
            <input type="email" id="email" name="email" class="login-input" placeholder="Enter your email" required>
          </div>

          <div class="form-group">
            <label for="password" class="login-label">Password</label>
            <input type="password" id="password" name="password" class="login-input" placeholder="Enter your password" required>
          </div>

          <div class="remember-forgot">
            <label class="remember-me">
              <input type="checkbox" name="remember">
              Remember me
            </label>
            <a href="forgot-password.html" class="forgot-link">Forgot password?</a>
          </div>

          <button type="submit" class="login-button">Sign In</button>

          <p class="login-info">
            By continuing, you agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
          </p>

          <div class="signup-prompt">
            <p class="new-user-text">New to our community?</p>
            <div class="create-account-wrapper">
              <a href="signup-options.html" class="create-account-button">Create an account</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>