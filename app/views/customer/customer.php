<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - <?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/styledinesh.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="customer-admin-layout">
        <!-- Sidebar -->
        <aside class="customer-sidebar">
            <div class="customer-sidebar-header">
                <h2>BookMyGround.lk</h2>
                <span class="customer-badge">Customer Panel</span>
            </div>
            
            <nav class="customer-sidebar-nav">
                <ul>
                    <li>
                        <a href="#overview" class="customer-nav-link active">
                            <span class="customer-nav-icon">🏠</span>
                            <span class="customer-nav-text">Overview</span>
                        </a>
                    </li>
                    <li>
                        <a href="#bookings" class="customer-nav-link">
                            <span class="customer-nav-icon">📅</span>
                            <span class="customer-nav-text">My Bookings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#profile" class="customer-nav-link">
                            <span class="customer-nav-icon">👤</span>
                            <span class="customer-nav-text">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#emergency-contacts" class="customer-nav-link">
                            <span class="customer-nav-icon">📞</span>
                            <span class="customer-nav-text">Emergency Contacts</span>
                        </a>
                    </li>
                    <li>
                        <a href="#stadiums" class="customer-nav-link">
                            <span class="customer-nav-icon">🏟️</span>
                            <span class="customer-nav-text">Stadiums</span>
                        </a>
                    </li>
                    <li>
                        <a href="#payments" class="customer-nav-link">
                            <span class="customer-nav-icon">💳</span>
                            <span class="customer-nav-text">Payments</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="customer-sidebar-footer">
                <div class="customer-profile-info">
                    <h4><?php echo $_SESSION['customer_name'] ?? 'Customer'; ?></h4>
                    <p><?php echo $_SESSION['customer_email'] ?? ''; ?></p>
                </div>
                <a href="<?php echo URLROOT; ?>/customer/logout" class="customer-logout-btn">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="customer-main-content">
            <!-- Top Header -->
            <div class="customer-top-header">
                <div class="customer-header-title">
                    <h1>Customer Dashboard</h1>
                    <p>Manage your bookings, profile, and sports journey</p>
                </div>
                <div class="customer-header-actions">
                    <a href="<?php echo URLROOT; ?>" class="customer-view-site-btn">
                        <span>🌐</span> View Site
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="customer-stats-grid">
                <div class="customer-stat-card">
                    <div class="customer-stat-icon">📅</div>
                    <div class="customer-stat-info">
                        <h3><?php echo $data['stats']['active_bookings'] ?? 12; ?></h3>
                        <p>Active Bookings</p>
                    </div>
                </div>
                
                <div class="customer-stat-card">
                    <div class="customer-stat-icon">🏟️</div>
                    <div class="customer-stat-info">
                        <h3><?php echo $data['stats']['stadiums_visited'] ?? 8; ?></h3>
                        <p>Stadiums Visited</p>
                    </div>
                </div>
                
                <div class="customer-stat-card">
                    <div class="customer-stat-icon">⭐</div>
                    <div class="customer-stat-info">
                        <h3><?php echo $data['stats']['rating_given'] ?? 4.8; ?></h3>
                        <p>Rating Given</p>
                    </div>
                </div>
                
                <div class="customer-stat-card">
                    <div class="customer-stat-icon">💰</div>
                    <div class="customer-stat-info">
                        <h3>LKR <?php echo number_format($data['stats']['total_spent'] ?? 2450); ?></h3>
                        <p>Total Spent</p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="customer-dashboard-content">
                
                <!-- Recent Bookings Section -->
                <div class="customer-content-section" id="bookings">
                    <h2 class="customer-section-heading">Recent Bookings</h2>
                    <div class="customer-bookings-grid">
                        <?php if(isset($data['recent_bookings']) && count($data['recent_bookings']) > 0): ?>
                            <?php foreach($data['recent_bookings'] as $booking): ?>
                                <div class="customer-booking-card">
                                    <div class="customer-booking-header">
                                        <h3 class="customer-stadium-name"><?php echo $booking['stadium']; ?></h3>
                                        <span class="customer-booking-status <?php echo strtolower($booking['status']); ?>">
                                            <?php echo $booking['status']; ?>
                                        </span>
                                    </div>
                                    <div class="customer-booking-details">
                                        <p><strong>Date:</strong> <?php echo $booking['date']; ?></p>
                                        <p><strong>Time:</strong> <?php echo $booking['time']; ?></p>
                                        <p><strong>Duration:</strong> <?php echo $booking['duration']; ?></p>
                                        <p><strong>Amount:</strong> LKR <?php echo number_format($booking['amount']); ?></p>
                                    </div>
                                    <div class="customer-booking-actions">
                                        <button class="customer-action-btn customer-view-btn">View Details</button>
                                        <button class="customer-action-btn customer-cancel-btn">Cancel</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="color: #888;">No bookings found.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Profile Section -->
                <div class="customer-content-section" id="profile">
                    <h2 class="customer-section-heading">My Profile</h2>
                    
                    <?php if(isset($_SESSION['success'])): ?>
                        <div style="background: rgba(3, 178, 0, 0.1); border: 1px solid #03B200; color: #03B200; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(isset($_SESSION['error'])): ?>
                        <div style="background: rgba(255, 0, 0, 0.1); border: 1px solid #ff4444; color: #ff6666; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo URLROOT; ?>/customer/updateProfile" method="POST" enctype="multipart/form-data">
                        <div class="customer-profile-container">
                            <div class="customer-profile-avatar-section">
                                <img src="<?php echo URLROOT; ?>/images/profiles/<?php echo $_SESSION['profile_picture'] ?? 'default-avatar.png'; ?>" alt="Profile Picture" id="profile-avatar">
                                <input type="file" name="profile_picture" id="profile-picture-input" accept="image/*" style="display: none;">
                                <button type="button" class="customer-change-avatar-btn" onclick="document.getElementById('profile-picture-input').click();">Change Photo</button>
                            </div>
                            
                            <div class="customer-profile-details">
                                <div class="customer-profile-field">
                                    <label>First Name *</label>
                                    <input type="text" name="first_name" value="<?php echo $_SESSION['customer_first_name'] ?? ''; ?>" placeholder="Enter your first name" class="customer-profile-input" required>
                                </div>
                                <div class="customer-profile-field">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" value="<?php echo $_SESSION['customer_last_name'] ?? ''; ?>" placeholder="Enter your last name" class="customer-profile-input" required>
                                </div>
                                <div class="customer-profile-field">
                                    <label>Email (Read Only)</label>
                                    <input type="email" value="<?php echo $_SESSION['customer_email'] ?? ''; ?>" class="customer-profile-input" readonly>
                                </div>
                                <div class="customer-profile-field">
                                    <label>Phone *</label>
                                    <input type="tel" name="phone" value="<?php echo $_SESSION['customer_phone'] ?? ''; ?>" placeholder="Enter your phone number" class="customer-profile-input" required>
                                </div>
                                <div class="customer-profile-field">
                                    <label>District *</label>
                                    <input type="text" name="district" value="<?php echo $_SESSION['customer_district'] ?? ''; ?>" placeholder="Enter your district" class="customer-profile-input" required>
                                </div>
                                <div class="customer-profile-field">
                                    <label>Preferred Sports *</label>
                                    <select name="preferred_sports" class="customer-profile-select" required>
                                        <option value="">Select primary sport</option>
                                        <option value="football" <?php echo ($_SESSION['customer_sports'] ?? '') == 'football' ? 'selected' : ''; ?>>Football</option>
                                        <option value="cricket" <?php echo ($_SESSION['customer_sports'] ?? '') == 'cricket' ? 'selected' : ''; ?>>Cricket</option>
                                        <option value="badminton" <?php echo ($_SESSION['customer_sports'] ?? '') == 'badminton' ? 'selected' : ''; ?>>Badminton</option>
                                        <option value="tennis" <?php echo ($_SESSION['customer_sports'] ?? '') == 'tennis' ? 'selected' : ''; ?>>Tennis</option>
                                        <option value="other" <?php echo ($_SESSION['customer_sports'] ?? '') == 'other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                                <div class="customer-profile-field">
                                    <label>Age Group *</label>
                                    <select name="age_group" class="customer-profile-select" required>
                                        <option value="">Select age group</option>
                                        <option value="under-18" <?php echo ($_SESSION['customer_age_group'] ?? '') == 'under-18' ? 'selected' : ''; ?>>Under 18</option>
                                        <option value="18-25" <?php echo ($_SESSION['customer_age_group'] ?? '') == '18-25' ? 'selected' : ''; ?>>18-25 years</option>
                                        <option value="26-35" <?php echo ($_SESSION['customer_age_group'] ?? '') == '26-35' ? 'selected' : ''; ?>>26-35 years</option>
                                        <option value="above-35" <?php echo ($_SESSION['customer_age_group'] ?? '') == 'above-35' ? 'selected' : ''; ?>>Above 35</option>
                                    </select>
                                </div>
                                <div class="customer-profile-field">
                                    <label>Skill Level *</label>
                                    <select name="skill_level" class="customer-profile-select" required>
                                        <option value="">Select skill level</option>
                                        <option value="beginner" <?php echo ($_SESSION['customer_skill_level'] ?? '') == 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                                        <option value="intermediate" <?php echo ($_SESSION['customer_skill_level'] ?? '') == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                        <option value="advanced" <?php echo ($_SESSION['customer_skill_level'] ?? '') == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                                        <option value="professional" <?php echo ($_SESSION['customer_skill_level'] ?? '') == 'professional' ? 'selected' : ''; ?>>Professional</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="customer-profile-actions">
                            <button type="submit" class="customer-save-btn">💾 Save Changes</button>
                            <button type="reset" class="customer-reset-btn">🔄 Reset</button>
                        </div>
                    </form>
                </div>

                <!-- Emergency Contacts Section -->
                <div class="customer-content-section" id="emergency-contacts">
                    <h2 class="customer-section-heading">Emergency Contacts</h2>
                    
                    <div class="customer-emergency-form">
                        <h3>➕ Add New Emergency Contact</h3>
                        <form action="<?php echo URLROOT; ?>/customer/addEmergencyContact" method="POST">
                            <div class="customer-form-grid">
                                <div class="customer-form-field">
                                    <label>Contact Name *</label>
                                    <input type="text" name="contact_name" placeholder="John Doe" required>
                                </div>
                                <div class="customer-form-field">
                                    <label>Relationship *</label>
                                    <input type="text" name="relationship" placeholder="Father, Sister, etc." required>
                                </div>
                                <div class="customer-form-field">
                                    <label>Phone *</label>
                                    <input type="tel" name="phone" placeholder="+94771234567" required>
                                </div>
                                <div class="customer-form-field">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="contact@email.com">
                                </div>
                            </div>
                            <button type="submit" class="customer-add-contact-btn">➕ Add Contact</button>
                        </form>
                    </div>

                    <div class="customer-contacts-list">
                        <h3>📋 My Emergency Contacts</h3>
                        <div class="customer-bookings-grid">
                            <?php
                            $customerModel = new M_Customer();
                            $emergency_contacts = $customerModel->getEmergencyContacts($_SESSION['customer_id']);
                            
                            if($emergency_contacts && count($emergency_contacts) > 0):
                                foreach($emergency_contacts as $contact):
                            ?>
                                <div class="customer-contact-card">
                                    <div class="customer-contact-header">
                                        <h3 class="customer-contact-name">👤 <?php echo $contact->contact_name; ?></h3>
                                        <span class="customer-contact-relationship"><?php echo $contact->relationship; ?></span>
                                    </div>
                                    <div class="customer-contact-details">
                                        <p><strong>📞 Phone:</strong> <?php echo $contact->phone; ?></p>
                                        <p><strong>📧 Email:</strong> <?php echo $contact->email ?? 'N/A'; ?></p>
                                        <p><strong>📅 Added:</strong> <?php echo date('M d, Y', strtotime($contact->created_at)); ?></p>
                                    </div>
                                    <a href="<?php echo URLROOT; ?>/customer/deleteEmergencyContact/<?php echo $contact->id; ?>" 
                                       class="customer-delete-contact-btn" 
                                       onclick="return confirm('Are you sure you want to delete this contact?');">
                                        🗑️ Delete Contact
                                    </a>
                                </div>
                            <?php 
                                endforeach;
                            else:
                            ?>
                                <p style="color: #888;">No emergency contacts added yet. Add your first contact above!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Favorite Stadiums Section -->
                <div class="customer-content-section" id="stadiums">
                    <h2 class="customer-section-heading">Favorite Stadiums</h2>
                    <div class="customer-bookings-grid">
                        <?php 
                        $favorite_stadiums = [
                            [
                                'name' => 'Central Football Arena',
                                'location' => 'Colombo, Sri Lanka',
                                'sport' => 'Football',
                                'rating' => 4.8,
                                'total_bookings' => 5,
                                'last_visited' => 'Jan 25, 2025'
                            ],
                            [
                                'name' => 'Badminton Court Pro',
                                'location' => 'Kandy, Sri Lanka',
                                'sport' => 'Badminton',
                                'rating' => 4.6,
                                'total_bookings' => 3,
                                'last_visited' => 'Jan 28, 2025'
                            ],
                            [
                                'name' => 'Tennis Excellence Center',
                                'location' => 'Galle, Sri Lanka',
                                'sport' => 'Tennis',
                                'rating' => 4.9,
                                'total_bookings' => 8,
                                'last_visited' => 'Jan 20, 2025'
                            ]
                        ];
                        
                        foreach($favorite_stadiums as $stadium):
                        ?>
                            <div class="customer-booking-card">
                                <div class="customer-booking-header">
                                    <h3 class="customer-stadium-name">🏟️ <?php echo $stadium['name']; ?></h3>
                                    <span class="customer-booking-status confirmed">⭐ <?php echo $stadium['rating']; ?></span>
                                </div>
                                <div class="customer-booking-details">
                                    <p><strong>📍 Location:</strong> <?php echo $stadium['location']; ?></p>
                                    <p><strong>⚽ Sport:</strong> <?php echo $stadium['sport']; ?></p>
                                    <p><strong>📅 Last Visited:</strong> <?php echo $stadium['last_visited']; ?></p>
                                    <p><strong>🎫 Total Bookings:</strong> <?php echo $stadium['total_bookings']; ?> times</p>
                                </div>
                                <div class="customer-booking-actions">
                                    <button class="customer-action-btn customer-view-btn">View Details</button>
                                    <button class="customer-action-btn customer-view-btn">Book Again</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Payment History Section -->
                <div class="customer-content-section" id="payments">
                    <h2 class="customer-section-heading">Payment History</h2>
                    <div class="customer-payment-table">
                        <table class="customer-data-table">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>Stadium</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $payments = [
                                    [
                                        'id' => 'TXN12345',
                                        'date' => '2025-01-25',
                                        'stadium' => 'Central Football Arena',
                                        'method' => 'Credit Card',
                                        'amount' => 800,
                                        'status' => 'Completed'
                                    ],
                                    [
                                        'id' => 'TXN12346',
                                        'date' => '2025-01-28',
                                        'stadium' => 'Badminton Court Pro',
                                        'method' => 'Debit Card',
                                        'amount' => 600,
                                        'status' => 'Completed'
                                    ],
                                    [
                                        'id' => 'TXN12347',
                                        'date' => '2025-01-20',
                                        'stadium' => 'Tennis Excellence Center',
                                        'method' => 'Online Banking',
                                        'amount' => 1200,
                                        'status' => 'Completed'
                                    ],
                                    [
                                        'id' => 'TXN12348',
                                        'date' => '2025-01-15',
                                        'stadium' => 'Swimming Pool Complex',
                                        'method' => 'Credit Card',
                                        'amount' => 450,
                                        'status' => 'Completed'
                                    ]
                                ];
                                
                                foreach($payments as $payment):
                                ?>
                                    <tr>
                                        <td><span class="payment-id">#<?php echo $payment['id']; ?></span></td>
                                        <td><?php echo date('M d, Y', strtotime($payment['date'])); ?></td>
                                        <td><?php echo $payment['stadium']; ?></td>
                                        <td><?php echo $payment['method']; ?></td>
                                        <td><strong style="color: #03B200;">LKR <?php echo number_format($payment['amount']); ?></strong></td>
                                        <td><span class="payment-status-completed">✓ <?php echo $payment['status']; ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="margin-top: 20px; padding: 20px; background: #1a1a1a; border-radius: 10px; border: 1px solid #333;">
                        <h3 style="color: #03B200; margin-bottom: 15px;">💳 Payment Summary</h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                            <div>
                                <p style="color: #888; font-size: 14px;">Total Transactions</p>
                                <h3 style="color: #fff; font-size: 24px;">4</h3>
                            </div>
                            <div>
                                <p style="color: #888; font-size: 14px;">Total Amount Paid</p>
                                <h3 style="color: #03B200; font-size: 24px;">LKR 3,050</h3>
                            </div>
                            <div>
                                <p style="color: #888; font-size: 14px;">Last Payment</p>
                                <h3 style="color: #fff; font-size: 24px;">Jan 28, 2025</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Smooth scroll for navigation links
        document.querySelectorAll('.customer-nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
                
                // Update active state
                document.querySelectorAll('.customer-nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
