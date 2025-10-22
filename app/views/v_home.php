<?php require APPROOT.'/views/inc/components/header.php'; ?>

<!-- Hero Section -->
<section class="herohome">
        <div class="hero-container1">
            <div class="hero-content1">
                <div class="hero-text1">
                    <h1 class="hero-title1">
                        BOOK <span class="highlight">YOUR</span><br>
                        SPORT GROUND
                    </h1>
                    <p class="hero-description1">
                        Your All-in-One Solution for Finding and Booking Indoor & Outdoor 
                        Stadiums, Rent Sport Equipments, Attend Practise Sessions, Book 
                        Individual Coaching Sessions & Publish Your Advertisements
                    </p>
                    <div class="hero-buttons1">
                        <a href="http://localhost/bookmygroundlk/stadiums" class="btn btn-primary">BOOK STADIUM</a>
                        <a href="http://localhost/bookmygroundlk/rental" class="btn btn-secondary">RENT SPORT GEARS</a>
                    </div>
                </div>
                
                <div class="search-section1">
                    <h3 class="search-title1">Search and Book Stadiums That Fit Your Needs and Price</h3>
                    <div class="search-form1">
                        <div class="search-field1">
                            <div class="field-icon1">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <input type="text" placeholder="Location" class="search-input1">
                        </div>
                        
                        <div class="search-field1">
                            <div class="field-icon1">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M8 12l2 2 4-4"></path>
                                </svg>
                            </div>
                            <select class="search-select1">
                                <option>Sport Type</option>
                                <option>Basketball</option>
                                <option>Football</option>
                                <option>Tennis</option>
                                <option>Cricket</option>
                            </select>
                        </div>
                        
                        <div class="search-field price-field1">
                            <div class="field-icon1">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </div>
                            <div class="price-content1">
                                <span class="price-label1">Price Average</span>
                                <div class="price-range1">
                                    <input type="range" min="500" max="5000" value="2000" class="price-slider1">
                                    <div class="price-values1">
                                        <span>LKR 500</span>
                                        <span>LKR 5000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-find1">Find Now</button>
                    </div>
                </div>
                
                <div class="partners-section1">
                    <h4 class="partners-title1">Our Partners</h4>
                    <div class="partners-logos1">
                        <div class="partner-logo1">logoipsum</div>
                        <div class="partner-logo1">logoipsum</div>
                        <div class="partner-logo1">logoipsum</div>
                        <div class="partner-logo1">logoipsum</div>
                    </div>
                </div>
            </div>
            
            <div class="hero-image1">
                <img src="<?php echo URLROOT; ?>/images/home/basketball-player.jpg" alt="Basketball Player" class="player-image1">
            </div>
        </div>
</section>

<!-- Featured Stadiums Section -->
<section class="featured-stadiums-section">
    <div class="featured-container">
        <div class="section-header">
            <div class="section-title">
                <h2>FEATURED STADIUMS</h2>
                <p>Discover the most popular and highly rated stadiums hand picked for your next game or event.</p>
            </div>
            <a href="<?php echo URLROOT; ?>/stadiums" class="view-all-btn">
                VIEW ALL STADIUMS
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                </svg>
            </a>
        </div>

        <!-- Featured Stadiums Grid -->
        <div class="featured-stadiums-grid">
            <?php foreach($data['featured_stadiums'] as $stadium): ?>
            <div class="featured-stadium-card1">
                <!-- Stadium Image -->
                <div class="stadium-image">
                    <img src="<?php echo URLROOT; ?>/images/stadiums/<?php echo $stadium->image; ?>" 
                         alt="<?php echo $stadium->name; ?>"
                         onerror="this.src='<?php echo URLROOT; ?>/images/stadiums/default-stadium.jpg'">
                    
                    <!-- Status Badge -->
                    <div class="status-badge status-<?php echo strtolower($stadium->status); ?>">
                        <?php echo $stadium->status; ?>
                    </div>
                    
                    <!-- Category Badge -->
                    <div class="category-badge">
                        <?php echo $stadium->category; ?>
                    </div>
                    
                    <!-- Rating Badge -->
                    <div class="rating-badge">
                        <span class="star">⭐</span>
                        <span class="rating"><?php echo $stadium->rating; ?></span>
                    </div>
                </div>
                
                <!-- Stadium Info -->
                <div class="stadium-info">
                    <div class="stadium-header">
                        <h3 class="stadium-name">
                            <a href="<?php echo URLROOT; ?>/stadiums/single/<?php echo $stadium->id; ?>" 
                                style="color: black; text-decoration: none;">
                                <?php echo $stadium->name; ?>
                            </a>
                        </h3>
                        <div class="stadium-price">
                            <span class="currency">LKR</span>
                            <span class="amount"><?php echo number_format($stadium->price); ?></span>
                            <span class="period">per hour</span>
                        </div>
                    </div>
                    
                    <div class="stadium-location">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span><?php echo $stadium->location; ?></span>
                    </div>
                    
                    <!-- Stadium Features -->
                    <div class="stadium-features">
                        <?php foreach(array_slice($stadium->features, 0, 3) as $feature): ?>
                            <span class="feature-tag">
                                <?php 
                                // Add icons for features
                                $icon = '';
                                switch(strtolower($feature)) {
                                    case 'lighting': $icon = '💡'; break;
                                    case 'parking': $icon = '🚗'; break;
                                    case 'wifi': $icon = '📶'; break;
                                    case 'air conditioning': $icon = '❄️'; break;
                                    case 'professional turf': $icon = '🌱'; break;
                                    case 'equipment rental': $icon = '⚽'; break;
                                    case 'professional court': $icon = '🏀'; break;
                                    case 'professional courts': $icon = '🎾'; break;
                                    case 'multiple sports': $icon = '🏆'; break;
                                    default: $icon = '✓'; break;
                                }
                                echo $icon . ' ' . $feature;
                                ?>
                            </span>
                        <?php endforeach; ?>
                        
                        <?php if($stadium->more_features > 0): ?>
                            <span class="more-features">+<?php echo $stadium->more_features; ?> more</span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Stadium Owner -->
                    <div class="stadium-owner">
                        <div class="owner-avatar">
                            <?php echo substr($stadium->owner, 0, 1); ?>
                        </div>
                        <div class="owner-info">
                            <span class="owner-name"><?php echo $stadium->owner; ?></span>
                            <span class="owner-status status-<?php echo strtolower($stadium->owner_status); ?>">
                                <span class="status-dot"></span>
                                <?php echo $stadium->owner_status; ?>
                            </span>
                        </div>
                        <button class="info-btn" onclick="showStadiumInfo(<?php echo $stadium->id; ?>)">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="stadium-actions">
                        <button class="btn-contact" onclick="contactOwner(<?php echo $stadium->id; ?>)">
                            Contact
                        </button>
                        <button class="btn-book <?php echo $stadium->status === 'Booked' ? 'btn-booked' : ''; ?>" 
                                <?php echo $stadium->status === 'Booked' ? 'disabled' : ''; ?>
                                onclick="<?php echo $stadium->status === 'Booked' ? '' : 'bookStadium(' . $stadium->id . ')'; ?>">
                            <?php echo $stadium->status === 'Booked' ? 'Booked' : 'Book Now'; ?>
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Call-to-Action -->
        <div class="featured-cta">
            <div class="cta-content">
                <h3>Looking for More Options?</h3>
                <p>Explore our complete collection of stadiums across Sri Lanka</p>
                <a href="<?php echo URLROOT; ?>/stadiums" class="cta-button">
                    Browse All Stadiums
                    <span class="cta-count">(150+ venues available)</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services We Are Offering Section -->
<section class="services-section">
    <div class="services-container">
        <div class="services-header">
            <h2>SERVICES WE ARE OFFERING</h2>
            <p>Our basketball club is more than just a team; it's a community built on dedication, teamwork, and the love of the game.</p>
        </div>

        <div class="services-grid">
            <!-- Sports Stadium Listing Service -->
            <div class="service-card large-card top-left">
                <div class="service-image">
                    <img src="<?php echo URLROOT; ?>/images/services/stadium-listing.jpg" alt="Sports Stadium Listing Service">
                </div>
                <div class="service-content">
                    <h3>Sports Stadium Listing Service</h3>
                    <p>Sports Stadium Owners Can List their Stadiums In This Website And Get More Bookings</p>
                    <a href="<?php echo URLROOT; ?>/stadiums" class="service-btn">
                        List Stadium Now
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Book Your Sport Ground -->
            <div class="service-card green-card top-center">
                <div class="service-content">
                    <h3>Book Your Sport Ground</h3>
                    <p>Customers can List their Sports ground By Choosing Date & Time</p>
                    <a href="<?php echo URLROOT; ?>/stadiums" class="service-btn">
                        Book Stadium Now
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                        </svg>
                    </a>
                </div>
                <div class="service-decoration">
                    <div class="sport-icon">🏀</div>
                </div>
            </div>

            <!-- Rent Out Your Sports Gear -->
            <div class="service-card large-card top-right">
                <div class="service-image">
                    <img src="<?php echo URLROOT; ?>/images/services/sports-gear.jpg" alt="Rent Out Your Sports Gear">
                </div>
                <div class="service-content">
                    <h3>Rent Out Your Sports Gear</h3>
                    <p>Sport Equipments Rental Service Owners can Publish Their Listing In the website and list their Sports Gears.</p>
                    <a href="<?php echo URLROOT; ?>/rental" class="service-btn">
                        List Your Sport Gear Rental Service Listing
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Rent the Gear You Need to Play -->
            <div class="service-card green-card bottom-left">
                <div class="service-content">
                    <h3>Rent the Gear You Need to Play</h3>
                    <p>Sport Players Can Rent Sport Gears For Play, They will suggest near-by Sport Gear Rental Service Listings After they Successfully Book Sport Stadium.</p>
                    <a href="<?php echo URLROOT; ?>/rental" class="service-btn">
                        Rent Sport Gear
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                        </svg>
                    </a>
                </div>
                <div class="service-decoration">
                    <div class="sport-icon">🎾</div>
                </div>
            </div>

            <!-- Participate For Practice Sessions -->
            <div class="service-card center-card">
                <div class="service-image">
                    <img src="<?php echo URLROOT; ?>/images/services/practice-sessions.jpg" alt="Participate For Practice Sessions">
                </div>
                <div class="service-content">
                    <h3>Participate For Practice Sessions</h3>
                    <p>Sport Coaches can List their Practising Events And Players can Participate to the sport sessions by filling form.</p>
                    <a href="<?php echo URLROOT; ?>/coaches" class="service-btn1">
                        Publish Your Practice Sessions
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Publish Your Advertisement -->
            <div class="service-card green-card bottom-right">
                <div class="service-content">
                    <h3>Publish Your Advertisement</h3>
                    <p>if Someone need to publish advertisement To get more sales or people engagement, They can Publish Their Advertisement.</p>
                    <a href="<?php echo URLROOT; ?>/advertisements" class="service-btn">
                        Publish Your Advertisement Now
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                        </svg>
                    </a>
                </div>
                <div class="service-decoration">
                    <div class="sport-icon">📢</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Choose Your Play Style Section -->
<section class="play-style-section">
    <div class="play-style-container">
        <div class="play-style-header">
            <h2>CHOOSE <span class="highlight-green">YOUR</span> PLAY STYLE?</h2>
            <p>Our basketball club is more than just a team; it's a community built on dedication, teamwork, and the love of the game.</p>
        </div>

        <div class="play-style-grid">
            <!-- Single Play Style -->
            <div class="play-style-card">
                <div class="play-style-image">
                    <img src="<?php echo URLROOT; ?>/images/play-styles/single-player.jpg" alt="Single Player">
                    <div class="play-style-overlay">
                        <h3 class="play-style-title">Single</h3>
                        <div class="play-style-content">
                            <p>Perfect for individual training, skill development, and personal practice sessions. Book courts for solo workouts and improve your game at your own pace.</p>
                            <a href="<?php echo URLROOT; ?>/stadiums?style=single" class="play-style-btn">
                                Find Single Courts
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Double Play Style -->
            <div class="play-style-card">
                <div class="play-style-image">
                    <img src="<?php echo URLROOT; ?>/images/play-styles/double-players.jpg" alt="Double Players">
                    <div class="play-style-overlay">
                        <h3 class="play-style-title">Double</h3>
                        <div class="play-style-content">
                            <p>Ideal for playing with a partner, doubles matches, or small group sessions. Book courts perfect for two-player games and competitive matches.</p>
                            <a href="<?php echo URLROOT; ?>/stadiums?style=double" class="play-style-btn">
                                Find Double Courts
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Play Style -->
            <div class="play-style-card">
                <div class="play-style-image">
                    <img src="<?php echo URLROOT; ?>/images/play-styles/team-players.jpg" alt="Team Players">
                    <div class="play-style-overlay">
                        <h3 class="play-style-title">Team</h3>
                        <div class="play-style-content">
                            <p>Perfect for team sports, group training, and large gatherings. Book spacious venues that can accommodate full teams and organized tournaments.</p>
                            <a href="<?php echo URLROOT; ?>/stadiums?style=team" class="play-style-btn">
                                Find Team Venues
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="play-style-info">
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-icon">🏆</div>
                    <h4>Competition Ready</h4>
                    <p>All venues are equipped for competitive play</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">⚡</div>
                    <h4>Instant Booking</h4>
                    <p>Book your preferred time slot immediately</p>
                </div>
                <div class="info-card">
                    <div class="info-icon">🎯</div>
                    <h4>Perfect Match</h4>
                    <p>Find venues that match your play style</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Choose Your Daily Practice Session Section -->
<section class="practice-session-section">
    <div class="practice-session-container">
        <div class="practice-session-header">
            <h2>Choose Your Daily Practice Session</h2>
            <p>Our basketball club is more than just a team; it's a community built on dedication, teamwork, and the love of the game.</p>
        </div>

        <div class="practice-sessions-grid">
            <!-- Football Practice Session -->
            <div class="practice-session-card left-aligned">
                <div class="session-image">
                    <img src="<?php echo URLROOT; ?>/images/practice-sessions/football-session.jpg" alt="Football Practice Session">
                </div>
                <div class="session-content">
                    <h3>Football Practice Session</h3>
                    <div class="session-details">
                        <div class="session-detail">
                            <span class="detail-label">Venue:</span>
                            <span class="detail-value">University Of Colombo Grounds</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Date & Time:</span>
                            <span class="detail-value">15th Spetember - 5:00 PM Onwards</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Coach:</span>
                            <span class="detail-value">Mr. Ar. Rahuman</span>
                        </div>
                    </div>
                    <a href="<?php echo URLROOT; ?>/coaches/session/1" class="session-btn">
                        Fill The Form & Participate Now
                    </a>
                </div>
            </div>

            <!-- Rugby Practice Session -->
            <div class="practice-session-card right-aligned">
                <div class="session-content">
                    <h3>Rugby Practice Session</h3>
                    <div class="session-details">
                        <div class="session-detail">
                            <span class="detail-label">Venue:</span>
                            <span class="detail-value">Dehiwala Indoor Stadium</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Time:</span>
                            <span class="detail-value">17th Spetember - 5:00 AM Onwards</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Coach:</span>
                            <span class="detail-value">Mr. Ar. Virath Kholi</span>
                        </div>
                    </div>
                    <a href="<?php echo URLROOT; ?>/coaches/session/2" class="session-btn">
                        Fill The Form & Participate Now
                    </a>
                </div>
                <div class="session-image">
                    <img src="<?php echo URLROOT; ?>/images/practice-sessions/rugby-session.jpg" alt="Rugby Practice Session">
                </div>
            </div>

            <!-- Cricket Practice Session -->
            <div class="practice-session-card left-aligned">
                <div class="session-image">
                    <img src="<?php echo URLROOT; ?>/images/practice-sessions/cricket-session.jpg" alt="Cricket Practice Session">
                </div>
                <div class="session-content">
                    <h3>Cricket Practice Session</h3>
                    <div class="session-details">
                        <div class="session-detail">
                            <span class="detail-label">Venue:</span>
                            <span class="detail-value">University Of Colombo Ground</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Time:</span>
                            <span class="detail-value">20th Spetember - 6:00 PM Onwards</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Coach:</span>
                            <span class="detail-value">Mr. Ar. Kumar Sangakkara</span>
                        </div>
                    </div>
                    <a href="<?php echo URLROOT; ?>/coaches/session/3" class="session-btn">
                        Fill The Form & Participate Now
                    </a>
                </div>
            </div>

            <!-- Futsal Practice Session -->
            <div class="practice-session-card right-aligned">
                <div class="session-content">
                    <h3>Futsal Practice Session</h3>
                    <div class="session-details">
                        <div class="session-detail">
                            <span class="detail-label">Venue:</span>
                            <span class="detail-value">Arcade Indoor Stadium</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Time:</span>
                            <span class="detail-value">19th Spetember - 8:00 AM Onwards</span>
                        </div>
                        <div class="session-detail">
                            <span class="detail-label">Coach:</span>
                            <span class="detail-value">Mr. Ar. Kamal Perera</span>
                        </div>
                    </div>
                    <a href="<?php echo URLROOT; ?>/coaches/session/4" class="session-btn">
                        Fill The Form & Participate Now
                    </a>
                </div>
                <div class="session-image">
                    <img src="<?php echo URLROOT; ?>/images/practice-sessions/futsal-session.jpg" alt="Futsal Practice Session">
                </div>
            </div>
        </div>

        <!-- View All Sessions Button -->
        <div class="practice-sessions-cta">
            <a href="<?php echo URLROOT; ?>/coaches" class="view-all-sessions-btn">
                VIEW ALL PRACTISE SESSIONS
            </a>
        </div>
    </div>
</section>

<!-- Rent Your Sport Equipments Section -->
<section class="sport-equipments-section">
    <div class="equipments-container">
        <div class="equipments-header">
            <h2>RENT YOUR SPORT EQUIPMENTS</h2>
            <p>Discover the most popular and highly rated stadiums hand picked for your next game or event.</p>
        </div>

        <div class="equipment-stores-grid">
            <!-- Wellawatte Sports Centre -->
            <div class="equipment-store-card">
                <div class="store-image">
                    <img src="<?php echo URLROOT; ?>/images/equipment-stores/wellawatte-sports.jpg" alt="Wellawatte Sports Centre">
                </div>
                <div class="store-info">
                    <h3 class="store-name">WELLAWATTE SPORTS CENTRE</h3>
                    <p class="store-location">GALLE ROAD, WELLAWATTE</p>
                    <a href="<?php echo URLROOT; ?>/rental/store/1" class="store-contact-btn">
                        Contact Now
                    </a>
                </div>
            </div>

            <!-- Colombo Sports Corner -->
            <div class="equipment-store-card featured">
                <div class="store-image">
                    <img src="<?php echo URLROOT; ?>/images/equipment-stores/colombo-sports-corner.jpg" alt="Colombo Sports Corner">
                </div>
                <div class="store-info">
                    <h3 class="store-name">COLOMBO SPORTS CORNER</h3>
                    <p class="store-location">REID AVENUE, COLOMBO 07</p>
                    <a href="<?php echo URLROOT; ?>/rental/store/2" class="store-contact-btn">
                        Contact Now
                    </a>
                </div>
            </div>

            <!-- Kotte Brackets -->
            <div class="equipment-store-card">
                <div class="store-image">
                    <img src="<?php echo URLROOT; ?>/images/equipment-stores/kotte-brackets.jpg" alt="Kotte Brackets">
                </div>
                <div class="store-info">
                    <h3 class="store-name">KOTTE BRACKETS</h3>
                    <p class="store-location">HILL STREERT ROAD, DEHIWALA</p>
                    <a href="<?php echo URLROOT; ?>/rental/store/3" class="store-contact-btn">
                        Contact Now
                    </a>
                </div>
            </div>

            <!-- OGF Sports -->
            <div class="equipment-store-card">
                <div class="store-image">
                    <img src="<?php echo URLROOT; ?>/images/equipment-stores/ogf-sports.jpg" alt="OGF Sports">
                </div>
                <div class="store-info">
                    <h3 class="store-name">OGF SPORTS</h3>
                    <p class="store-location">One Galleface Mall</p>
                    <a href="<?php echo URLROOT; ?>/rental/store/4" class="store-contact-btn">
                        Contact Now
                    </a>
                </div>
            </div>
        </div>

        <!-- View More Button -->
        <div class="equipments-cta">
            <a href="<?php echo URLROOT; ?>/rental" class="view-more-equipments-btn">
                VIEW MORE
            </a>
        </div>
    </div>
</section>

<!-- Publish Your Ad Section -->
<section class="publish-ad-section">
    <div class="publish-ad-container">
        <div class="publish-ad-content">
            <!-- Left Column - Images -->
            <div class="ad-images-grid">
                <!-- Man with phone image -->
                <div class="ad-image-large">
                    <img src="<?php echo URLROOT; ?>/images/advertisements/man-phone.jpg" alt="Man using phone">
                </div>
                
                <!-- Top right - phone/app image -->
                <div class="ad-image-small top">
                    <img src="<?php echo URLROOT; ?>/images/advertisements/phone-app.jpg" alt="Mobile app">
                </div>
                
                <!-- Bottom right - done checkmark -->
                <div class="ad-image-small bottom">
                    <div class="done-badge">
                        <div class="checkmark-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12l2 2 4-4" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="done-text">DONE</span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Content -->
            <div class="ad-content">
                <h2>Publish Your Ad In BookMY Ground</h2>
                <p class="ad-description">
                    Reach Thousands of Sports Enthusiasts! Promote your brand on BookMY Ground the go-to platform for stadium bookings. Advertise directly to players, ground owners, and sports fans across the country.
                </p>

                <!-- Features List -->
                <div class="ad-features">
                    <div class="ad-feature">
                        <div class="feature-dot"></div>
                        <div class="feature-content">
                            <h3>Show On Top Of the website</h3>
                            <p>Your Advertisement will show on top of the website</p>
                        </div>
                    </div>

                    <div class="ad-feature">
                        <div class="feature-dot"></div>
                        <div class="feature-content">
                            <h3>Affordable Prices</h3>
                            <p>You Can Publish Your Advertisement At Affordable Price</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <a href="<?php echo URLROOT; ?>/advertisements" class="publish-ad-btn">
                    Publish Your Ad Now
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Subscription Section -->
<section class="newsletter-subscription-section">
    <div class="subscription-container">
        <div class="subscription-content">
            <!-- Left Column - Content -->
            <div class="subscription-text">
                <h2>Stay Updated with BookMyGround</h2>
                <p>Get the latest updates on new stadiums, exclusive deals, coaching sessions, and sports events delivered straight to your inbox.</p>
                
                <div class="subscription-benefits">
                    <div class="benefit-item">
                        <div class="benefit-icon">🏟️</div>
                        <span>New stadium listings</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">💰</div>
                        <span>Exclusive booking discounts</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">🏃‍♂️</div>
                        <span>Sports events & tournaments</span>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">👨‍🏫</div>
                        <span>Coaching session updates</span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Subscription Form -->
            <div class="subscription-form-container">
                <div class="subscription-form-wrapper">
                    <h3>Subscribe Now</h3>
                    <p class="form-subtitle">Join 10,000+ sports enthusiasts</p>
                    
                    <form class="subscription-form" id="subscriptionForm">
                        <div class="form-group">
                            <div class="input-wrapper">
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       placeholder="Your email address" 
                                       class="email-input"
                                       required>
                                <button type="submit" class="send-btn" id="subscribeBtn">
                                    <span class="btn-text">SEND</span>
                                    <svg class="btn-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-privacy">
                            <label class="privacy-checkbox">
                                <input type="checkbox" id="privacy" name="privacy" required>
                                <span class="checkmark"></span>
                                <span class="privacy-text">I agree to receive newsletters and promotional emails</span>
                            </label>
                        </div>
                        
                        <div class="success-message" id="successMessage" style="display: none;">
                            <div class="success-icon">✅</div>
                            <span>Successfully subscribed! Welcome to BookMyGround community.</span>
                        </div>
                    </form>
                    
                    <div class="subscription-stats">
                        <div class="stat-item">
                            <span class="stat-number">10K+</span>
                            <span class="stat-label">Subscribers</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">95%</span>
                            <span class="stat-label">Satisfaction</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">Weekly</span>
                            <span class="stat-label">Updates</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Reuse the same functions from stadiums page
function showStadiumInfo(id) {
    alert(`Stadium info for ID: ${id} - Full details modal would open here`);
}

function contactOwner(id) {
    alert(`Contact owner functionality for stadium ID: ${id}`);
}

function bookStadium(id) {
    if(confirm('Proceed to booking for this stadium?')) {
        window.location.href = `<?php echo URLROOT; ?>/booking/stadium/${id}`;
    }
}

// Newsletter subscription functionality
document.addEventListener('DOMContentLoaded', function() {
    const subscriptionForm = document.getElementById('subscriptionForm');
    const subscribeBtn = document.getElementById('subscribeBtn');
    const successMessage = document.getElementById('successMessage');
    
    if (subscriptionForm) {
        subscriptionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const privacy = document.getElementById('privacy').checked;
            
            if (!email || !privacy) {
                alert('Please fill in your email and accept the privacy policy');
                return;
            }
            
            // Simulate subscription process
            subscribeBtn.innerHTML = '<span class="btn-text">SENDING...</span>';
            subscribeBtn.disabled = true;
            
            setTimeout(() => {
                successMessage.style.display = 'flex';
                subscriptionForm.style.display = 'none';
                
                // Reset form after 3 seconds
                setTimeout(() => {
                    subscriptionForm.style.display = 'block';
                    successMessage.style.display = 'none';
                    subscriptionForm.reset();
                    subscribeBtn.innerHTML = '<span class="btn-text">SEND</span><svg class="btn-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>';
                    subscribeBtn.disabled = false;
                }, 3000);
            }, 2000);
        });
    }
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Animate stadium cards
    document.querySelectorAll('.featured-stadium-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Animate subscription section
    const subscriptionSection = document.querySelector('.newsletter-subscription-section');
    if (subscriptionSection) {
        subscriptionSection.style.opacity = '0';
        subscriptionSection.style.transform = 'translateY(30px)';
        subscriptionSection.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        observer.observe(subscriptionSection);
    }
});
</script>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>