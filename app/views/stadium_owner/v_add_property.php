<?php require APPROOT.'/views/stadium_owner/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Add New Property</h1>
        <div class="header-actions">
            <a href="<?php echo URLROOT; ?>/stadium_owner/properties" class="btn-back">← Back to Properties</a>
        </div>
    </div>

    <!-- Package Limits Check -->
    <?php if(!$data['package_limits']['can_add_property']): ?>
    <div class="alert alert-warning">
        <div class="alert-icon">⚠️</div>
        <div class="alert-content">
            <h4>Property Limit Reached</h4>
            <p>You've reached the maximum number of properties for your current package. Upgrade your package to add more properties.</p>
            <a href="<?php echo URLROOT; ?>/pricing" class="btn-upgrade">Upgrade Package</a>
        </div>
    </div>
    <?php else: ?>

    <!-- Add Property Form -->
    <div class="add-property-container">
        <div class="property-form-wrapper">
            <?php if(isset($data['error']) && !empty($data['error'])): ?>
                <div class="error-message">
                    <?php echo $data['error']; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($data['success']) && !empty($data['success'])): ?>
                <div class="success-message">
                    <?php echo $data['success']; ?>
                </div>
            <?php endif; ?>

            <form class="add-property-form" method="POST" action="<?php echo URLROOT; ?>/stadium_owner/add_property" enctype="multipart/form-data">
                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="section-title">Basic Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="property-name">Property Name *</label>
                            <input type="text" 
                                   id="property-name" 
                                   name="name" 
                                   placeholder="e.g., Central Cricket Ground"
                                   value="<?php echo isset($data['form_data']['name']) ? $data['form_data']['name'] : ''; ?>"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="property-type">Sports Type *</label>
                            <select id="property-type" name="type" required>
                                <option value="">Select sports type</option>
                                <option value="Cricket" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Cricket' ? 'selected' : ''; ?>>Cricket</option>
                                <option value="Football" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Football' ? 'selected' : ''; ?>>Football</option>
                                <option value="Tennis" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Tennis' ? 'selected' : ''; ?>>Tennis</option>
                                <option value="Basketball" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Basketball' ? 'selected' : ''; ?>>Basketball</option>
                                <option value="Badminton" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Badminton' ? 'selected' : ''; ?>>Badminton</option>
                                <option value="Swimming" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Swimming' ? 'selected' : ''; ?>>Swimming</option>
                                <option value="Volleyball" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Volleyball' ? 'selected' : ''; ?>>Volleyball</option>
                                <option value="Multi-Sport" <?php echo isset($data['form_data']['type']) && $data['form_data']['type'] == 'Multi-Sport' ? 'selected' : ''; ?>>Multi-Sport</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="property-category">Category *</label>
                            <select id="property-category" name="category" required>
                                <option value="">Select category</option>
                                <option value="Indoor" <?php echo isset($data['form_data']['category']) && $data['form_data']['category'] == 'Indoor' ? 'selected' : ''; ?>>Indoor</option>
                                <option value="Outdoor" <?php echo isset($data['form_data']['category']) && $data['form_data']['category'] == 'Outdoor' ? 'selected' : ''; ?>>Outdoor</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="property-price">Price per Hour (LKR) *</label>
                            <input type="number" 
                                   id="property-price" 
                                   name="price" 
                                   placeholder="e.g., 5000"
                                   min="100"
                                   step="100"
                                   value="<?php echo isset($data['form_data']['price']) ? $data['form_data']['price'] : ''; ?>"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="form-section">
                    <h3 class="section-title">Location Information</h3>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label for="property-location">Full Address *</label>
                            <input type="text" 
                                   id="property-location" 
                                   name="location" 
                                   placeholder="e.g., 123 Galle Road, Colombo 03"
                                   value="<?php echo isset($data['form_data']['location']) ? $data['form_data']['location'] : ''; ?>"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="property-district">District *</label>
                            <select id="property-district" name="district" required>
                                <option value="">Select district</option>
                                <option value="Colombo" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Colombo' ? 'selected' : ''; ?>>Colombo</option>
                                <option value="Kandy" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Kandy' ? 'selected' : ''; ?>>Kandy</option>
                                <option value="Galle" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Galle' ? 'selected' : ''; ?>>Galle</option>
                                <option value="Jaffna" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Jaffna' ? 'selected' : ''; ?>>Jaffna</option>
                                <option value="Negombo" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Negombo' ? 'selected' : ''; ?>>Negombo</option>
                                <option value="Anuradhapura" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Anuradhapura' ? 'selected' : ''; ?>>Anuradhapura</option>
                                <option value="Kurunegala" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Kurunegala' ? 'selected' : ''; ?>>Kurunegala</option>
                                <option value="Matara" <?php echo isset($data['form_data']['district']) && $data['form_data']['district'] == 'Matara' ? 'selected' : ''; ?>>Matara</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="property-postal">Postal Code</label>
                            <input type="text" 
                                   id="property-postal" 
                                   name="postal_code" 
                                   placeholder="e.g., 00300"
                                   value="<?php echo isset($data['form_data']['postal_code']) ? $data['form_data']['postal_code'] : ''; ?>">
                        </div>
                    </div>
                </div>

                <!-- Property Description -->
                <div class="form-section">
                    <h3 class="section-title">Property Description</h3>
                    <div class="form-group full-width">
                        <label for="property-description">Description *</label>
                        <textarea id="property-description" 
                                  name="description" 
                                  rows="5" 
                                  placeholder="Describe your property, facilities, and what makes it special..."
                                  required><?php echo isset($data['form_data']['description']) ? $data['form_data']['description'] : ''; ?></textarea>
                        <small class="form-help">Minimum 50 characters. Be detailed about your facilities and amenities.</small>
                    </div>
                </div>

                <!-- Features & Amenities -->
                <div class="form-section">
                    <h3 class="section-title">Features & Amenities</h3>
                    <div class="features-grid">
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Lighting" <?php echo isset($data['form_data']['features']) && in_array('Lighting', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">💡</span>
                            <span class="feature-text">Lighting</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Parking" <?php echo isset($data['form_data']['features']) && in_array('Parking', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">🚗</span>
                            <span class="feature-text">Parking</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="WiFi" <?php echo isset($data['form_data']['features']) && in_array('WiFi', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">📶</span>
                            <span class="feature-text">WiFi</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Air Conditioning" <?php echo isset($data['form_data']['features']) && in_array('Air Conditioning', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">❄️</span>
                            <span class="feature-text">Air Conditioning</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Changing Rooms" <?php echo isset($data['form_data']['features']) && in_array('Changing Rooms', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">🚿</span>
                            <span class="feature-text">Changing Rooms</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Equipment Rental" <?php echo isset($data['form_data']['features']) && in_array('Equipment Rental', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">⚽</span>
                            <span class="feature-text">Equipment Rental</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Seating" <?php echo isset($data['form_data']['features']) && in_array('Seating', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">💺</span>
                            <span class="feature-text">Seating</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Sound System" <?php echo isset($data['form_data']['features']) && in_array('Sound System', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">🔊</span>
                            <span class="feature-text">Sound System</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Cafeteria" <?php echo isset($data['form_data']['features']) && in_array('Cafeteria', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">🍕</span>
                            <span class="feature-text">Cafeteria</span>
                        </label>
                        
                        <label class="feature-checkbox">
                            <input type="checkbox" name="features[]" value="Professional Turf" <?php echo isset($data['form_data']['features']) && in_array('Professional Turf', $data['form_data']['features']) ? 'checked' : ''; ?>>
                            <span class="checkmark">🌱</span>
                            <span class="feature-text">Professional Turf</span>
                        </label>
                    </div>
                </div>

                <!-- Images Upload -->
                <div class="form-section">
                    <h3 class="section-title">Property Images</h3>
                    <div class="upload-section">
                        <div class="upload-info">
                            <p>You can upload up to <?php echo $data['package_limits']['photos_limit']; ?> photos (your current package limit).</p>
                            <small>Recommended size: 1200x800px. Supported formats: JPG, PNG (Max 5MB each)</small>
                        </div>
                        
                        <div class="file-upload-area" id="imageUploadArea">
                            <div class="upload-placeholder">
                                <div class="upload-icon">📷</div>
                                <h4>Upload Property Images</h4>
                                <p>Drag and drop images here or click to browse</p>
                                <input type="file" 
                                       id="property-images" 
                                       name="images[]" 
                                       multiple 
                                       accept="image/*"
                                       max="<?php echo $data['package_limits']['photos_limit']; ?>">
                            </div>
                            <div class="uploaded-images" id="uploadedImages"></div>
                        </div>
                    </div>
                </div>

                <!-- Availability Settings -->
                <div class="form-section">
                    <h3 class="section-title">Availability Settings</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="opening-hours">Opening Hours</label>
                            <select id="opening-hours" name="opening_hours">
                                <option value="24/7">24/7 Available</option>
                                <option value="6:00 AM - 10:00 PM">6:00 AM - 10:00 PM</option>
                                <option value="7:00 AM - 9:00 PM">7:00 AM - 9:00 PM</option>
                                <option value="8:00 AM - 8:00 PM">8:00 AM - 8:00 PM</option>
                                <option value="Custom">Custom Hours</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="advance-booking">Advance Booking</label>
                            <select id="advance-booking" name="advance_booking">
                                <option value="1">1 day in advance</option>
                                <option value="3">3 days in advance</option>
                                <option value="7" selected>1 week in advance</option>
                                <option value="14">2 weeks in advance</option>
                                <option value="30">1 month in advance</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="minimum-duration">Minimum Booking Duration</label>
                            <select id="minimum-duration" name="minimum_duration">
                                <option value="1" selected>1 hour</option>
                                <option value="2">2 hours</option>
                                <option value="3">3 hours</option>
                                <option value="4">4 hours</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="cancellation-policy">Cancellation Policy</label>
                            <select id="cancellation-policy" name="cancellation_policy">
                                <option value="6">6 hours before</option>
                                <option value="12" selected>12 hours before</option>
                                <option value="24">24 hours before</option>
                                <option value="48">48 hours before</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section">
                    <h3 class="section-title">Contact Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="contact-person">Contact Person</label>
                            <input type="text" 
                                   id="contact-person" 
                                   name="contact_person" 
                                   placeholder="Name of contact person"
                                   value="<?php echo isset($data['form_data']['contact_person']) ? $data['form_data']['contact_person'] : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-phone">Contact Phone *</label>
                            <input type="tel" 
                                   id="contact-phone" 
                                   name="contact_phone" 
                                   placeholder="+94 71 234 5678"
                                   value="<?php echo isset($data['form_data']['contact_phone']) ? $data['form_data']['contact_phone'] : ''; ?>"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-email">Contact Email</label>
                            <input type="email" 
                                   id="contact-email" 
                                   name="contact_email" 
                                   placeholder="property@example.com"
                                   value="<?php echo isset($data['form_data']['contact_email']) ? $data['form_data']['contact_email'] : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="whatsapp-number">WhatsApp Number</label>
                            <input type="tel" 
                                   id="whatsapp-number" 
                                   name="whatsapp_number" 
                                   placeholder="+94 71 234 5678"
                                   value="<?php echo isset($data['form_data']['whatsapp_number']) ? $data['form_data']['whatsapp_number'] : ''; ?>">
                        </div>
                    </div>
                </div>

                <!-- Special Instructions -->
                <div class="form-section">
                    <h3 class="section-title">Additional Information</h3>
                    <div class="form-group full-width">
                        <label for="special-instructions">Special Instructions / Rules</label>
                        <textarea id="special-instructions" 
                                  name="special_instructions" 
                                  rows="4" 
                                  placeholder="Any special rules, instructions, or additional information customers should know..."><?php echo isset($data['form_data']['special_instructions']) ? $data['form_data']['special_instructions'] : ''; ?></textarea>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="window.history.back()">Cancel</button>
                    <button type="button" class="btn-save-draft">Save as Draft</button>
                    <button type="submit" class="btn-add-property">Add Property</button>
                </div>
            </form>
        </div>

        <!-- Package Limits Sidebar -->
        <div class="package-limits-sidebar">
            <div class="limits-card">
                <h4>Your Package Limits</h4>
                <div class="limit-item">
                    <span class="limit-label">Properties:</span>
                    <span class="limit-value"><?php echo $data['package_limits']['current_properties']; ?>/<?php echo $data['package_limits']['properties_limit']; ?></span>
                    <div class="limit-bar">
                        <div class="limit-fill" style="width: <?php echo ($data['package_limits']['current_properties'] / $data['package_limits']['properties_limit']) * 100; ?>%"></div>
                    </div>
                </div>
                
                <div class="limit-item">
                    <span class="limit-label">Photos per property:</span>
                    <span class="limit-value"><?php echo $data['package_limits']['photos_limit']; ?></span>
                </div>
                
                <div class="limit-item">
                    <span class="limit-label">Videos per property:</span>
                    <span class="limit-value"><?php echo $data['package_limits']['videos_limit']; ?></span>
                </div>
                
                <div class="limit-item">
                    <span class="limit-label">Featured listings:</span>
                    <span class="limit-value"><?php echo $data['package_limits']['featured_listings']; ?></span>
                </div>
                
                <a href="<?php echo URLROOT; ?>/pricing" class="btn-upgrade-sidebar">Upgrade Package</a>
            </div>
            
            <div class="tips-card">
                <h4>💡 Tips for Success</h4>
                <ul class="tips-list">
                    <li>Use high-quality images to attract more bookings</li>
                    <li>Write detailed descriptions highlighting unique features</li>
                    <li>Set competitive pricing for your area</li>
                    <li>Respond quickly to customer inquiries</li>
                    <li>Maintain your property in excellent condition</li>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// Image Upload Functionality
document.getElementById('property-images').addEventListener('change', function(e) {
    const files = e.target.files;
    const uploadedImages = document.getElementById('uploadedImages');
    const maxFiles = <?php echo $data['package_limits']['photos_limit']; ?>;
    
    if (files.length > maxFiles) {
        alert(`You can only upload ${maxFiles} images with your current package.`);
        return;
    }
    
    uploadedImages.innerHTML = '';
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const imagePreview = document.createElement('div');
            imagePreview.className = 'image-preview';
            imagePreview.innerHTML = `
                <img src="${e.target.result}" alt="Property Image">
                <button type="button" class="remove-image" onclick="removeImage(this)">×</button>
                <div class="image-name">${file.name}</div>
            `;
            uploadedImages.appendChild(imagePreview);
        };
        
        reader.readAsDataURL(file);
    }
});

// Drag and Drop Functionality
const uploadArea = document.getElementById('imageUploadArea');

uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    document.getElementById('property-images').files = files;
    document.getElementById('property-images').dispatchEvent(new Event('change'));
});

// Remove Image Function
function removeImage(button) {
    button.parentElement.remove();
}

// Form Validation
document.querySelector('.add-property-form').addEventListener('submit', function(e) {
    const name = document.getElementById('property-name').value;
    const description = document.getElementById('property-description').value;
    const price = document.getElementById('property-price').value;
    
    if (name.length < 3) {
        e.preventDefault();
        alert('Property name must be at least 3 characters long.');
        return;
    }
    
    if (description.length < 50) {
        e.preventDefault();
        alert('Description must be at least 50 characters long.');
        return;
    }
    
    if (price < 100) {
        e.preventDefault();
        alert('Price must be at least LKR 100 per hour.');
        return;
    }
});

// Save as Draft Functionality
document.querySelector('.btn-save-draft').addEventListener('click', function() {
    const form = document.querySelector('.add-property-form');
    const formData = new FormData(form);
    formData.append('save_as_draft', '1');
    
    // Here you would make an AJAX call to save as draft
    alert('Property saved as draft!');
});

// Character Counter for Description
const descriptionTextarea = document.getElementById('property-description');
const charCounter = document.createElement('div');
charCounter.className = 'char-counter';
descriptionTextarea.parentNode.appendChild(charCounter);

descriptionTextarea.addEventListener('input', function() {
    const length = this.value.length;
    charCounter.textContent = `${length}/50 minimum characters`;
    charCounter.style.color = length >= 50 ? '#28a745' : '#dc3545';
});

// Initial character count
descriptionTextarea.dispatchEvent(new Event('input'));
</script>

<style>
.add-property-container {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 30px;
    margin-bottom: 40px;
}

.property-form-wrapper {
    background: white;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid #e9ecef;
}

.form-section:last-of-type {
    border-bottom: none;
    margin-bottom: 30px;
}

.section-title {
    color: #212529;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-group label {
    font-weight: 500;
    margin-bottom: 8px;
    color: #495057;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #28a745;
}

.form-help {
    font-size: 12px;
    color: #6c757d;
    margin-top: 4px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.feature-checkbox {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.feature-checkbox:hover {
    background: #e9ecef;
}

.feature-checkbox input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: all 0.3s ease;
}

.feature-checkbox input[type="checkbox"]:checked + .checkmark {
    background: #28a745;
    color: white;
}

.feature-text {
    font-weight: 500;
    color: #495057;
}

.file-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    transition: all 0.3s ease;
}

.file-upload-area.dragover {
    border-color: #28a745;
    background: #f8fff8;
}

.upload-placeholder {
    cursor: pointer;
}

.upload-icon {
    font-size: 48px;
    margin-bottom: 16px;
}

.upload-placeholder h4 {
    margin: 0 0 8px 0;
    color: #495057;
}

.upload-placeholder p {
    margin: 0;
    color: #6c757d;
}

.upload-placeholder input[type="file"] {
    display: none;
}

.uploaded-images {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 16px;
    margin-top: 20px;
}

.image-preview {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
}

.image-preview img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}

.remove-image {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: rgba(220, 53, 69, 0.8);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-name {
    padding: 8px;
    font-size: 12px;
    color: #6c757d;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}

.form-actions {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    padding-top: 30px;
    border-top: 1px solid #e9ecef;
}

.form-actions button {
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-cancel {
    background: #f8f9fa;
    color: #495057;
    border: 2px solid #dee2e6;
}

.btn-cancel:hover {
    background: #e9ecef;
}

.btn-save-draft {
    background: #ffc107;
    color: #212529;
    border: 2px solid #ffc107;
}

.btn-save-draft:hover {
    background: #e0a800;
    border-color: #e0a800;
}

.btn-add-property {
    background: #28a745;
    color: white;
    border: 2px solid #28a745;
}

.btn-add-property:hover {
    background: #218838;
    border-color: #218838;
}

.package-limits-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.limits-card,
.tips-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.limits-card h4,
.tips-card h4 {
    margin: 0 0 16px 0;
    color: #212529;
    font-size: 16px;
}

.limit-item {
    margin-bottom: 16px;
}

.limit-item:last-child {
    margin-bottom: 20px;
}

.limit-label {
    font-size: 13px;
    color: #6c757d;
    display: block;
    margin-bottom: 4px;
}

.limit-value {
    font-weight: 600;
    color: #212529;
    margin-bottom: 8px;
    display: block;
}

.limit-bar {
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    overflow: hidden;
}

.limit-fill {
    height: 100%;
    background: linear-gradient(135deg, #28a745, #20c997);
    transition: width 0.3s ease;
}

.btn-upgrade-sidebar {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    color: white;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    text-align: center;
    display: block;
    transition: all 0.3s ease;
}

.btn-upgrade-sidebar:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tips-list li {
    padding: 8px 0;
    color: #495057;
    font-size: 13px;
    border-bottom: 1px solid #f8f9fa;
    position: relative;
    padding-left: 20px;
}

.tips-list li:before {
    content: "•";
    color: #28a745;
    font-weight: bold;
    position: absolute;
    left: 0;
}

.tips-list li:last-child {
    border-bottom: none;
}

.char-counter {
    font-size: 12px;
    margin-top: 4px;
    text-align: right;
}

.alert {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 30px;
}

.alert-warning {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    color: #856404;
}

.alert-icon {
    font-size: 24px;
}

.alert-content h4 {
    margin: 0 0 8px 0;
    color: #856404;
}

.alert-content p {
    margin: 0 0 16px 0;
}

.btn-back {
    background: #f8f9fa;
    color: #495057;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #e9ecef;
}

@media (max-width: 768px) {
    .add-property-container {
        grid-template-columns: 1fr;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .uploaded-images {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
}
</style>

<?php require APPROOT.'/views/stadium_owner/inc/footer.php'; ?>