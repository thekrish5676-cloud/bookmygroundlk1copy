<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Successful | BookMyGround.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Success Hero Section -->
  <section class="login-hero">
    <div class="hero-text">
      <p class="sign-in-dis">
        <span class="green">WELCOME</span> TO THE TEAM<br>
        <span class="description">
          Your registration was successful! Get ready to take your sports 
          journey to the next level with <span class="green">BookMyGround!</span>
        </span>
      </p>
      <div class="hero-buttons">
        <a href="<?php echo URLROOT; ?>/login" class="hero-btn primary">Sign In Now</a>
        <a href="<?php echo URLROOT; ?>" class="hero-btn">Explore Platform</a>
      </div>
    </div>
    <div class="hero-image">
      <img src="<?php echo URLROOT; ?>/images/login/basketball_player.png" id="basketball" alt="Basketball Player">
    </div>
  </section>

  <!-- Success Content Section -->
  <section class="login-content-section">
    <div class="login-content-container">
      <!-- Left Side - Success Message -->
      <div class="welcome-content">
        <h2 class="welcome-heading">YOU'RE <span class="green">IN</span>!<br>WHAT'S <span class="green">NEXT</span>?</h2>
        
        <div class="features-list">
          <div class="feature-item">
            <span class="feature-icon">✅</span>
            <p>Account successfully created and pending verification</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">📧</span>
            <p>Check your email for verification instructions</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">🚀</span>
            <p>Once verified, you can access all platform features</p>
          </div>
          <div class="feature-item">
            <span class="feature-icon">💬</span>
            <p>Our support team is here if you need any help</p>
          </div>
        </div>

        <div class="signin-quote">
          <p class="quote-text">"Every champion was once a beginner. Every pro was once an amateur. 
          Welcome to your sports journey with BookMyGround!"</p>
        </div>
      </div>

      <!-- Right Side - Next Steps -->
      <div class="login-form-container">
        <div class="success-content">
          <h2 class="login-heading">🎉 Registration Complete!</h2>
          
          <div class="success-steps">
            <div class="step-item">
              <div class="step-number">1</div>
              <div class="step-content">
                <h3>Verify Your Email</h3>
                <p>Check your inbox and click the verification link we sent you.</p>
              </div>
            </div>
            
            <div class="step-item">
              <div class="step-number">2</div>
              <div class="step-content">
                <h3>Complete Your Profile</h3>
                <p>Add more details to help others connect with you.</p>
              </div>
            </div>
            
            <div class="step-item">
              <div class="step-number">3</div>
              <div class="step-content">
                <h3>Start Exploring</h3>
                <p>Browse stadiums, find coaches, or list your services.</p>
              </div>
            </div>
          </div>

          <div class="quick-actions">
            <h3>Quick Actions</h3>
            <div class="action-buttons">
              <a href="<?php echo URLROOT; ?>/stadiums" class="action-btn">
                🏟️ Browse Stadiums
              </a>
              <a href="<?php echo URLROOT; ?>/coaches" class="action-btn">
                👨‍🏫 Find Coaches
              </a>
              <a href="<?php echo URLROOT; ?>/rental" class="action-btn">
                ⚽ Rent Equipment
              </a>
            </div>
          </div>

          <div class="login-info">
            <p>Need help getting started? Contact our support team at 
            <a href="mailto:support@bookmyground.lk">support@bookmyground.lk</a></p>
          </div>

          <div class="signup-prompt">
            <p class="new-user-text">Ready to dive in?</p>
            <div class="create-account-wrapper">
              <a href="<?php echo URLROOT; ?>/login" class="create-account-button">Sign In to Your Account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    .success-content {
      text-align: center;
    }
    
    .success-steps {
      margin: 30px 0;
    }
    
    .step-item {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 25px;
      padding: 15px;
      background: #f8f9fa;
      border-radius: 10px;
      text-align: left;
    }
    
    .step-number {
      width: 40px;
      height: 40px;
      background: #03B200;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 18px;
      flex-shrink: 0;
    }
    
    .step-content h3 {
      margin: 0 0 5px 0;
      color: #282222;
      font-size: 16px;
    }
    
    .step-content p {
      margin: 0;
      color: #666;
      font-size: 14px;
    }
    
    .quick-actions {
      margin: 30px 0;
    }
    
    .quick-actions h3 {
      color: #282222;
      margin-bottom: 20px;
    }
    
    .action-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    
    .action-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px 20px;
      background: #f8f9fa;
      color: #282222;
      text-decoration: none;
      border-radius: 8px;
      transition: all 0.3s ease;
      border: 2px solid #e9ecef;
    }
    
    .action-btn:hover {
      background: #03B200;
      color: white;
      border-color: #03B200;
      transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
      .step-item {
        flex-direction: column;
        text-align: center;
        gap: 15px;
      }
      
      .step-content {
        text-align: center;
      }
    }
  </style>
</body>
</html>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>