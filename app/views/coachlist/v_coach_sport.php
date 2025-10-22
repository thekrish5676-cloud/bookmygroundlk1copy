<?php require APPROOT.'/views/inc/components/header.php'; ?>

<div class="coach-hero-section">
    <div class="coach-hero-container">
        <?php $sportName = strtolower($data['sport'] ?? ''); ?>
        <?php if ($sportName === 'football' || $sportName === 'soccer'): ?>
            <h1>Find Top Football Coaches</h1>
            <p>Browse experienced football coaches near you — from youth development to advanced tactics and fitness training.</p>
        <?php else: ?>
            <h1><?php echo htmlspecialchars(ucwords($data['sport'] ?? 'Sport')); ?> Coaches</h1>
            <p>Explore experienced coaches for <?php echo htmlspecialchars(ucwords($data['sport'] ?? 'this sport')); ?>. Compare ratings, view locations, and contact coaches directly to book sessions.</p>
        <?php endif; ?>
    </div>
</div>

<div class="featured-coach">
    <h1><?php echo htmlspecialchars(ucwords($data['sport'] ?? 'Sport')); ?> Coaches</h1>
    <div class="featured-coach-list">
        <?php if (empty($data['coaches'])): ?>
            <p>No coaches found for <?php echo htmlspecialchars(ucwords($data['sport'] ?? 'this sport')); ?>.</p>
        <?php else: ?>
            <?php foreach (($data['coaches'] ?? []) as $coach): ?>
            <div class="featured-coach-card">
                <div class="coach-feature-photo">
                    <span class="featured-coach-availability <?php echo htmlspecialchars($coach['availability'] ?? 'unavailable'); ?>"><?php echo htmlspecialchars(ucfirst($coach['availability'] ?? 'unavailable')); ?></span>
                    <?php
                        $img = trim($coach['image'] ?? '');
                        $useDefault = false;
                        if (!empty($img)) {
                            if (preg_match('#^https?://#i', $img)) {
                                $useDefault = false;
                            } else {
                                $projectRoot = dirname(__DIR__, 3);
                                if (strpos($img, URLROOT) === 0) {
                                    $relative = substr($img, strlen(URLROOT));
                                } else {
                                    $relative = $img;
                                }
                                $fsPath = $projectRoot . $relative;
                                if (!file_exists($fsPath)) {
                                    $useDefault = true;
                                }
                            }
                        } else {
                            $useDefault = true;
                        }

                        if ($useDefault) {
                            $gender = strtolower($coach['gender'] ?? 'male');
                            if ($gender === 'female' || $gender === 'f') {
                                $img = URLROOT . '/public/images/coaches/defultgirl.jpg';
                            } else {
                                $img = URLROOT . '/public/images/coaches/defultboy.jpg';
                            }
                        }
                    ?>
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($coach['name'] ?? 'Coach'); ?>">
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
                        <a class="coach-feature-details-btn" href="<?php echo URLROOT; ?>/coach/show/<?php echo (int)($coach['id'] ?? 0); ?>">View Profile</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>
