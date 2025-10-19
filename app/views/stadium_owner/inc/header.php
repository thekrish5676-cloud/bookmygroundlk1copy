<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?> - <?php echo SITENAME; ?> Owner Panel</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/stadium_owner.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin.css">
</head>
<body>
    <div class="owner-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>BookMyGround.lk</h2>
                <span class="owner-badge">Stadium Owner</span>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="<?php echo URLROOT; ?>/stadium_owner" class="nav-link">
                            <span class="nav-icon">📊</span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/stadium_owner/properties" class="nav-link">
                            <span class="nav-icon">🏟️</span>
                            <span class="nav-text">My Properties</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/stadium_owner/add_property" class="nav-link">
                            <span class="nav-icon">➕</span>
                            <span class="nav-text">Add Property</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/stadium_owner/bookings" class="nav-link">
                            <span class="nav-icon">📅</span>
                            <span class="nav-text">Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/stadium_owner/messages" class="nav-link">
                            <span class="nav-icon">💬</span>
                            <span class="nav-text">Messages</span>
                            <?php if(isset($data['unread_count']) && $data['unread_count'] > 0): ?>
                            <span class="badge"><?php echo $data['unread_count']; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/stadium_owner/revenue" class="nav-link">
                            <span class="nav-icon">💰</span>
                            <span class="nav-text">Revenue</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/stadium_owner/profile" class="nav-link">
                            <span class="nav-icon">👤</span>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <div class="owner-profile">
                    <div class="profile-info">
                        <h4><?php echo isset($data['user_first_name']) ? $data['user_first_name'] : 'Stadium Owner'; ?></h4>
                        <p>Standard Package</p>
                    </div>
                </div>
                <a href="<?php echo URLROOT; ?>/stadium_owner/logout" class="logout-btn">Logout</a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main-container">
            <!-- Top Navigation -->
            <header class="top-header">
                <div class="header-left">
                    <button class="sidebar-toggle">☰</button>
                    <div class="breadcrumb">
                        <a href="<?php echo URLROOT; ?>">Website</a> / Owner Panel / <?php echo $data['title']; ?>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="header-actions">
                        <a href="<?php echo URLROOT; ?>" class="btn-view-site" target="_blank">View Site</a>
                        <div class="package-info">
                            <span class="package-badge standard">Standard Plan</span>
                        </div>
                        <div class="notifications">
                            <span class="notification-icon">🔔</span>
                            <span class="notification-count">3</span>
                        </div>
                    </div>
                </div>
            </header>