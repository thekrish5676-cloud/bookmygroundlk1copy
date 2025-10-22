<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - <?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>BookMyGround</h1>
                <h2>Admin Panel</h2>
            </div>
            
            <?php if(isset($data['error'])): ?>
                <div class="error-message">
                    <?php echo $data['error']; ?>
                </div>
            <?php endif; ?>
            
            <form class="login-form" method="POST" action="<?php echo URLROOT; ?>/admin/login">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn-login">Login</button>
            </form>
            
            <div class="login-footer">
                <p>Demo Credentials: admin / admin123</p>
                <a href="<?php echo URLROOT; ?>">← Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>