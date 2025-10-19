<?php require APPROOT.'/views/inc/components/header.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/single-stadium.css">

<!-- Stadium Detail Section -->
<section class="stadium-detail-section">
    <div class="detail-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="<?php echo URLROOT; ?>">Home</a>
            <span>/</span>
            <a href="<?php echo URLROOT; ?>/stadiums">Stadiums</a>
            <span>/</span>
            <span><?php echo $data['stadium']->name; ?></span>
        </div>

        <!-- Stadium Header -->
        <div class="stadium-header">
            <div class="stadium-title">
                <h1><?php echo $data['stadium']->name; ?></h1>
                <div class="stadium-meta">
                    <div class="location">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span><?php echo $data['stadium']->location; ?></span>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <?php 
                            $rating = $data['stadium']->rating;
                            for($i = 1; $i <= 5; $i++): 
                            ?>
                                <span class="star <?php echo $i <= floor($rating) ? 'filled' : ''; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        <span class="rating-number"><?php echo $data['stadium']->rating; ?></span>
                        <span class="review-count">(24 reviews)</span>
                    </div>
                    <div class="stadium-type">
                        <span class="type-badge"><?php echo $data['stadium']->type; ?></span>
                        <span class="category-badge"><?php echo $data['stadium']->category; ?></span>
                    </div>
                </div>
            </div>
            <div class="stadium-price">
                <div class="price-info">
                    <span class="price-amount">LKR <?php echo number_format($data['stadium']->price); ?></span>
                    <span class="price-period">per hour</span>
                </div>
                <div class="status-badge status-<?php echo strtolower($data['stadium']->status); ?>">
                    <?php echo $data['stadium']->status; ?>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="stadium-main-content">
            <!-- Left Column -->
            <div class="stadium-content">
                <!-- Image Gallery -->
                <div class="image-gallery">
                    <div class="main-image">
                        <img id="mainImage" src="<?php echo URLROOT; ?>/images/stadiums/<?php echo $data['stadium']->image; ?>" alt="<?php echo $data['stadium']->name; ?>">
                        <button class="fullscreen-btn" onclick="openGalleryModal()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="gallery-thumbnails">
                        <?php foreach(array_slice($data['gallery_images'], 0, 4) as $index => $image): ?>
                        <div class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" onclick="changeMainImage('<?php echo URLROOT; ?>/images/stadiums/<?php echo $image; ?>')">
                            <img src="<?php echo URLROOT; ?>/images/stadiums/<?php echo $image; ?>" alt="Gallery Image <?php echo $index + 1; ?>">
                        </div>
                        <?php endforeach; ?>
                        <?php if(count($data['gallery_images']) > 4): ?>
                        <div class="thumbnail more-images" onclick="openGalleryModal()">
                            <div class="more-overlay">
                                <span>+<?php echo count($data['gallery_images']) - 4; ?></span>
                            </div>
                            <img src="<?php echo URLROOT; ?>/images/stadiums/<?php echo $data['gallery_images'][4]; ?>" alt="More Images">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Stadium Description -->
                <div class="stadium-description">
                    <h2>About This Stadium</h2>
                    <p>Experience world-class sports facilities at <?php echo $data['stadium']->name; ?>. Our premium <?php echo strtolower($data['stadium']->type); ?> stadium offers professional-grade playing surfaces and top-notch amenities for players of all skill levels. Whether you're planning a competitive match or casual practice session, our facility provides the perfect environment for your sporting needs.</p>
                    
                    <p>Located in the heart of <?php echo $data['stadium']->location; ?>, we've been serving the local sports community with excellence and dedication. Our commitment to maintaining the highest standards ensures every game is played on a surface that meets professional requirements.</p>
                </div>

                <!-- Features & Amenities -->
                <div class="stadium-features-section">
                    <h2>Features & Amenities</h2>
                    <div class="features-grid">
                        <?php foreach($data['stadium']->features as $feature): ?>
                        <div class="feature-item">
                            <div class="feature-icon">
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
                                    case 'changing rooms': $icon = '🚿'; break;
                                    case 'seating': $icon = '💺'; break;
                                    case 'sound system': $icon = '🔊'; break;
                                    case 'cafeteria': $icon = '🍕'; break;
                                    default: $icon = '✓'; break;
                                }
                                echo $icon;
                                ?>
                            </div>
                            <span class="feature-name"><?php echo $feature; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Videos Section -->
                <div class="videos-section">
                    <h2>Stadium Videos</h2>
                    <div class="videos-grid">
                        <?php foreach($data['videos'] as $video): ?>
                        <div class="video-item">
                            <div class="video-thumbnail">
                                <img src="<?php echo URLROOT; ?>/images/videos/<?php echo $video['thumbnail']; ?>" alt="<?php echo $video['title']; ?>">
                                <div class="play-button" onclick="playVideo('<?php echo $video['url']; ?>')">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4><?php echo $video['title']; ?></h4>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Location & Map -->
                <div class="location-section">
                    <h2>Location</h2>
                    <div class="location-info">
                        <div class="address">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            <span><?php echo $data['stadium']->location; ?>, Sri Lanka</span>
                        </div>
                    </div>
                    <div class="map-container">
                        <div id="map" class="stadium-map">
                            <!-- Google Map will be embedded here -->
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63371.8174852742!2d79.82132259999999!3d6.921837400000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1642678901234!5m2!1sen!2slk"
                                width="100%" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="reviews-section">
                    <div class="reviews-header">
                        <h2>Customer Reviews</h2>
                        <div class="review-summary">
                            <div class="average-rating">
                                <span class="rating-big"><?php echo $data['stadium']->rating; ?></span>
                                <div class="rating-stars">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <span class="star <?php echo $i <= floor($data['stadium']->rating) ? 'filled' : ''; ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                                <span class="total-reviews">Based on 24 reviews</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="reviews-list">
                        <?php foreach($data['reviews'] as $review): ?>
                        <div class="review-item">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">
                                    <?php echo substr($review['customer_name'], 0, 1); ?>
                                </div>
                                <div class="reviewer-details">
                                    <h4><?php echo $review['customer_name']; ?></h4>
                                    <div class="review-meta">
                                        <div class="review-rating">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <span class="star <?php echo $i <= $review['rating'] ? 'filled' : ''; ?>">★</span>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="review-date"><?php echo date('M j, Y', strtotime($review['date'])); ?></span>
                                        <?php if($review['verified']): ?>
                                        <span class="verified-badge">Verified</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <p class="review-comment"><?php echo $review['comment']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <button class="btn-load-more-reviews">Load More Reviews</button>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="stadium-sidebar">
                <!-- Booking Card -->
                <div class="booking-card">
                    <div class="booking-header">
                        <h3>Book This Stadium</h3>
                        <div class="price-display">
                            <span class="price">LKR <?php echo number_format($data['stadium']->price); ?></span>
                            <span class="period">per hour</span>
                        </div>
                    </div>
                    
                    <form class="booking-form" id="bookingForm">
                        <div class="form-group">
                            <label for="booking-date">Date</label>
                            <input type="date" id="booking-date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="start-time">Start Time</label>
                                <select id="start-time" name="start_time" required>
                                    <option value="">Select Time</option>
                                    <option value="06:00">6:00 AM</option>
                                    <option value="07:00">7:00 AM</option>
                                    <option value="08:00">8:00 AM</option>
                                    <option value="09:00">9:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="13:00">1:00 PM</option>
                                    <option value="14:00">2:00 PM</option>
                                    <option value="15:00">3:00 PM</option>
                                    <option value="16:00">4:00 PM</option>
                                    <option value="17:00">5:00 PM</option>
                                    <option value="18:00">6:00 PM</option>
                                    <option value="19:00">7:00 PM</option>
                                    <option value="20:00">8:00 PM</option>
                                    <option value="21:00">9:00 PM</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <select id="duration" name="duration" required>
                                    <option value="">Hours</option>
                                    <option value="1">1 Hour</option>
                                    <option value="2">2 Hours</option>
                                    <option value="3">3 Hours</option>
                                    <option value="4">4 Hours</option>
                                    <option value="5">5 Hours</option>
                                    <option value="6">6 Hours</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="booking-summary">
                            <div class="summary-row">
                                <span>Subtotal:</span>
                                <span id="subtotal">LKR 0</span>
                            </div>
                            <div class="summary-row">
                                <span>Service Fee:</span>
                                <span id="service-fee">LKR 0</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total:</span>
                                <span id="total-amount">LKR 0</span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-book-now">Book Now</button>
                    </form>
                    
                    <div class="booking-info">
                        <p><strong>Free cancellation</strong> up to 12 hours before booking</p>
                        <p><strong>Instant confirmation</strong> - You'll receive confirmation immediately</p>
                    </div>
                </div>

                <!-- Owner Info Card -->
                <div class="owner-info-card">
                    <div class="owner-header">
                        <div class="owner-avatar">
                            <?php echo substr($data['stadium']->owner, 0, 1); ?>
                        </div>
                        <div class="owner-details">
                            <h4><?php echo $data['stadium']->owner; ?></h4>
                            <div class="owner-status">
                                <span class="status-dot status-<?php echo strtolower($data['stadium']->owner_status); ?>"></span>
                                <span><?php echo $data['stadium']->owner_status; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="owner-stats">
                        <div class="stat-item">
                            <span class="stat-number">4.8</span>
                            <span class="stat-label">Rating</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">127</span>
                            <span class="stat-label">Reviews</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">3</span>
                            <span class="stat-label">Properties</span>
                        </div>
                    </div>
                    
                    <div class="owner-actions">
                        <button class="btn-contact-owner">Contact Owner</button>
                        <button class="btn-view-profile">View Profile</button>
                    </div>
                </div>

                <!-- Quick Info Card -->
                <div class="quick-info-card">
                    <h4>Quick Information</h4>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Sport Type:</span>
                            <span class="info-value"><?php echo $data['stadium']->type; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Category:</span>
                            <span class="info-value"><?php echo $data['stadium']->category; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Capacity:</span>
                            <span class="info-value">22 Players</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Surface:</span>
                            <span class="info-value">Natural Grass</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Parking:</span>
                            <span class="info-value">Available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nearby Stadiums Section -->
<section class="nearby-stadiums-section">
    <div class="nearby-container">
        <div class="section-header">
            <h2>Nearby Stadiums</h2>
            <p>Other great options in <?php echo $data['stadium']->location; ?></p>
        </div>
        
        <div class="nearby-stadiums-grid">
            <?php foreach($data['nearby_stadiums'] as $stadium): ?>
            <div class="nearby-stadium-card">
                <div class="stadium-image">
                    <img src="<?php echo URLROOT; ?>/images/stadiums/<?php echo $stadium->image; ?>" 
                         alt="<?php echo $stadium->name; ?>">
                    <div class="rating-badge">
                        <span class="star">⭐</span>
                        <span class="rating"><?php echo $stadium->rating; ?></span>
                    </div>
                </div>
                <div class="stadium-meta">
                    <h3><a href="<?php echo URLROOT; ?>/stadiums/single/<?php echo $stadium->id; ?>"><?php echo $stadium->name; ?></a></h3>
                    <div class="location">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span><?php echo $stadium->location; ?></span>
                    </div>
                    <div class="price">
                        <span class="amount">LKR <?php echo number_format($stadium->price); ?></span>
                        <span class="period">per hour</span>
                    </div>
                    <div class="features">
                        <?php foreach(array_slice($stadium->features, 0, 2) as $feature): ?>
                            <span class="feature-tag"><?php echo $feature; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="view-more-nearby">
            <a href="<?php echo URLROOT; ?>/stadiums" class="btn-view-more">View All Stadiums</a>
        </div>
    </div>
</section>

<!-- Gallery Modal -->
<div id="galleryModal" class="modal">
    <div class="modal-content gallery-modal">
        <div class="modal-header">
            <h3><?php echo $data['stadium']->name; ?> - Gallery</h3>
            <span class="close" onclick="closeGalleryModal()">&times;</span>
        </div>
        <div class="gallery-modal-content">
            <div class="gallery-main-image">
                <img id="modalMainImage" src="" alt="Gallery Image">
                <button class="prev-btn" onclick="previousImage()">❮</button>
                <button class="next-btn" onclick="nextImage()">❯</button>
            </div>
            <div class="gallery-thumbnails-modal">
                <?php foreach($data['gallery_images'] as $index => $image): ?>
                <div class="thumbnail-modal" onclick="selectModalImage(<?php echo $index; ?>)">
                    <img src="<?php echo URLROOT; ?>/images/stadiums/<?php echo $image; ?>" alt="Gallery Image <?php echo $index + 1; ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Video Modal -->
<div id="videoModal" class="modal">
    <div class="modal-content video-modal">
        <div class="modal-header">
            <h3>Stadium Video</h3>
            <span class="close" onclick="closeVideoModal()">&times;</span>
        </div>
        <div class="video-modal-content">
            <iframe id="videoFrame" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
// Gallery functionality
let currentImageIndex = 0;
const galleryImages = <?php echo json_encode($data['gallery_images']); ?>;

function changeMainImage(imageSrc) {
    document.getElementById('mainImage').src = imageSrc;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    event.target.closest('.thumbnail').classList.add('active');
}

function openGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.style.display = 'block';
    
    if (galleryImages.length > 0) {
        currentImageIndex = 0;
        document.getElementById('modalMainImage').src = '<?php echo URLROOT; ?>/images/stadiums/' + galleryImages[currentImageIndex];
        updateModalThumbnails();
    }
}

function closeGalleryModal() {
    document.getElementById('galleryModal').style.display = 'none';
}

function selectModalImage(index) {
    currentImageIndex = index;
    document.getElementById('modalMainImage').src = '<?php echo URLROOT; ?>/images/stadiums/' + galleryImages[currentImageIndex];
    updateModalThumbnails();
}

function previousImage() {
    currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : galleryImages.length - 1;
    document.getElementById('modalMainImage').src = '<?php echo URLROOT; ?>/images/stadiums/' + galleryImages[currentImageIndex];
    updateModalThumbnails();
}

function nextImage() {
    currentImageIndex = currentImageIndex < galleryImages.length - 1 ? currentImageIndex + 1 : 0;
    document.getElementById('modalMainImage').src = '<?php echo URLROOT; ?>/images/stadiums/' + galleryImages[currentImageIndex];
    updateModalThumbnails();
}

function updateModalThumbnails() {
    document.querySelectorAll('.thumbnail-modal').forEach((thumb, index) => {
        thumb.classList.toggle('active', index === currentImageIndex);
    });
}

// Video functionality
function playVideo(videoUrl) {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoFrame');
    frame.src = videoUrl;
    modal.style.display = 'block';
}

function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const frame = document.getElementById('videoFrame');
    frame.src = '';
    modal.style.display = 'none';
}

// Booking form functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookingForm');
    const startTime = document.getElementById('start-time');
    const duration = document.getElementById('duration');
    const pricePerHour = <?php echo $data['stadium']->price; ?>;
    
    function updateBookingSummary() {
        const hours = parseInt(duration.value) || 0;
        const subtotal = pricePerHour * hours;
        const serviceFee = Math.round(subtotal * 0.05); // 5% service fee
        const total = subtotal + serviceFee;
        
        document.getElementById('subtotal').textContent = 'LKR ' + subtotal.toLocaleString();
        document.getElementById('service-fee').textContent = 'LKR ' + serviceFee.toLocaleString();
        document.getElementById('total-amount').textContent = 'LKR ' + total.toLocaleString();
    }
    
    duration.addEventListener('change', updateBookingSummary);
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const date = formData.get('date');
        const startTimeValue = formData.get('start_time');
        const durationValue = formData.get('duration');
        
        if (!date || !startTimeValue || !durationValue) {
            alert('Please fill in all required fields');
            return;
        }
        
        // Simulate booking process
        alert('Booking request submitted! You will be redirected to payment page.');
        // In real implementation, this would redirect to booking/payment page
        // window.location.href = '<?php echo URLROOT; ?>/booking/confirm';
    });
});

// Contact owner functionality
document.querySelector('.btn-contact-owner').addEventListener('click', function() {
    alert('Contact owner functionality will be implemented');
});

// Load more reviews functionality
document.querySelector('.btn-load-more-reviews').addEventListener('click', function() {
    alert('Load more reviews functionality will be implemented');
});

// Close modal when clicking outside
window.onclick = function(event) {
    const galleryModal = document.getElementById('galleryModal');
    const videoModal = document.getElementById('videoModal');
    
    if (event.target == galleryModal) {
        closeGalleryModal();
    }
    if (event.target == videoModal) {
        closeVideoModal();
    }
}

// Keyboard navigation for gallery
document.addEventListener('keydown', function(event) {
    const galleryModal = document.getElementById('galleryModal');
    if (galleryModal.style.display === 'block') {
        if (event.key === 'ArrowLeft') {
            previousImage();
        } else if (event.key === 'ArrowRight') {
            nextImage();
        } else if (event.key === 'Escape') {
            closeGalleryModal();
        }
    }
});
</script>

<?php require APPROOT.'/views/inc/components/footer.php'; ?>