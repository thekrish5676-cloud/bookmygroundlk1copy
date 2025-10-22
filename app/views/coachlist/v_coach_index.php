<?php require APPROOT.'/views/inc/components/header.php'; ?>
<!--coach page hero section-->
    <div class="coach-hero-section">
        <div class="coach-hero-container">
            <h1>Find Your Coach</h1>
            <p>Find the perfect coach to help you achieve your goals. Browse our network of experienced coaches and start your journey today.</p>
            <div class="coach-searchbar">
                <input type="text" placeholder="Search for coaches" >
                <button>Search</button>
            </div>
        </div>
    </div>
    <!--browns by sport-->
    <div class="browse-sport">
        <h1>Browse by sport</h1>
        
        <div class="browse-sport-types">
            <?php foreach (($data['sports'] ?? []) as $sport): ?>
                <!--This is how using single code travel through the sport base coaches-->
            <a class="browse-sport-card" href="<?php echo URLROOT . '/coach/sport/' . urlencode(strtolower($sport['title'])); ?>">  
                <img src="<?php echo htmlspecialchars($sport['image']);?>" alt="<?php echo htmlspecialchars($sport['title']);?>" />
                <p><?php echo htmlspecialchars($sport['title']);?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Featured coaches listing -->
    <div class="featured-coach">
        <h1>Featured Coaches</h1>
        <div class="featured-coach-list">
            <?php foreach (($data['featured'] ?? []) as $coach): ?>
            <div class="featured-coach-card">
                <div class="coach-feature-photo">
                    <span class="featured-coach-availability <?php echo htmlspecialchars($coach['availability'] ?? 'unavailable'); ?>"><?php echo htmlspecialchars(ucfirst($coach['availability'] ?? 'unavailable')); ?></span>
                    <img src="<?php echo htmlspecialchars($coach['image'] ?? (URLROOT . '/public/images/coaches/back.jpg')); ?>" alt="<?php echo htmlspecialchars($coach['name'] ?? 'Coach'); ?>">
                    <div class="featured-coach-ratings">
                        <span class="featured-coach-ratings-star">⭐</span>
                        <span class="featured-coach-ratings-number"><?php echo htmlspecialchars($coach['rating'] ?? '0.0'); ?></span>
                    </div>
                </div>
                <div class="coach-feature-details">
                    <h3><?php echo htmlspecialchars($coach['name'] ?? 'Unnamed'); ?></h3>
                    <div class="coach-feature-details-location">
                        <img src="<?php echo URLROOT; ?>/public/images/coaches/location.png" alt="location icon">
                        <h5><?php echo htmlspecialchars($coach['location'] ?? 'Unknown'); ?></h5>
                        <h3><?php echo htmlspecialchars($coach['sport'] ?? ''); ?></h3>
                    </div>
                    <div class="coach-feature-details-button">
                        <input type="button" value="View Profile" name="coach-feature-details-button">
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>