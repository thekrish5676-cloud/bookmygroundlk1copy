<?php require APPROOT . '/views/coachdash/inc/header.php'; ?>
<div class="kal-coach-profile-manager">
    <!-- Profile Header -->
    <div class="kal-coach-profile-header">
        <h1><?php echo $data['title'] ?? 'Coach Profile Management'; ?></h1>
        <button type="submit" form="profileForm" class="kal-profile-save-btn">Save Changes</button>
    </div>

    <form id="profileForm" action="<?php echo URLROOT; ?>/coachdash/updateProfile" method="POST">
        <div class="kal-profile-layout">
            <!-- Sidebar -->
            <div class="kal-profile-sidebar">
                <!-- Profile Photo Card -->
                <div class="kal-profile-card">
                    <h3>Profile Photo</h3>
                    <div class="kal-profile-photo">
                        <div class="kal-profile-photo-img">
                            <?php if(!empty($data['coach']['image'])): ?>
                                <img src="<?php echo $data['coach']['image']; ?>" alt="<?php echo htmlspecialchars($data['coach']['name']); ?>">
                            <?php else: ?>
                                <span>No Photo</span>
                            <?php endif; ?>
                        </div>
                        <div class="kal-photo-upload">
                            <input type="file" id="profilePhoto" accept="image/*" style="display: none;">
                            <button type="button" class="kal-upload-btn" onclick="document.getElementById('profilePhoto').click()">
                                Upload New Photo
                            </button>
                            <small style="color: #888; text-align: center;">JPG, PNG max 5MB</small>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Card -->
                <div class="kal-profile-card">
                    <h3>Profile Stats</h3>
                    <div class="kal-quick-stats">
                        <div class="kal-stat-item">
                            <span class="kal-stat-label">Rating</span>
                            <span class="kal-stat-value"><?php echo $data['coach']['rating']; ?>/5</span>
                        </div>
                        <div class="kal-stat-item">
                            <span class="kal-stat-label">Experience</span>
                            <span class="kal-stat-value"><?php echo $data['coach']['experience']; ?></span>
                        </div>
                        <div class="kal-stat-item">
                            <span class="kal-stat-label">Response Rate</span>
                            <span class="kal-stat-value">95%</span>
                        </div>
                        <div class="kal-stat-item">
                            <span class="kal-stat-label">Students Trained</span>
                            <span class="kal-stat-value">150+</span>
                        </div>
                    </div>
                </div>

                <!-- Availability Card -->
                <div class="kal-profile-card">
                    <h3>Availability</h3>
                    <div class="kal-form-group">
                        <label for="availability">Current Status</label>
                        <select class="kal-form-control" id="availability" name="availability">
                            <option value="available" <?php echo $data['coach']['availability'] === 'available' ? 'selected' : ''; ?>>Available</option>
                            <option value="unavailable" <?php echo $data['coach']['availability'] === 'unavailable' ? 'selected' : ''; ?>>Unavailable</option>
                            <option value="limited" <?php echo $data['coach']['availability'] === 'limited' ? 'selected' : ''; ?>>Limited Availability</option>
                        </select>
                    </div>
                    <div class="kal-form-group">
                        <label for="hourly_rate">Hourly Rate (LKR)</label>
                        <input type="number" class="kal-form-control" id="hourly_rate" name="hourly_rate" 
                               value="<?php echo str_replace(',', '', $data['coach']['rate']); ?>" min="0">
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="kal-main-content">
                <!-- Basic Information Section -->
                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Basic Information</h3>
                        <button type="button" class="kal-edit-btn" onclick="toggleEdit('basicInfo')">Edit</button>
                    </div>
                    <div class="kal-form-grid">
                        <div class="kal-form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="kal-form-control" id="full_name" name="full_name" 
                                   value="<?php echo htmlspecialchars($data['coach']['name']); ?>" readonly>
                        </div>
                        <div class="kal-form-group">
                            <label for="sport">Sport</label>
                            <select class="kal-form-control" id="sport" name="sport" readonly>
                                <option value="<?php echo $data['coach']['sport']; ?>" selected><?php echo $data['coach']['sport']; ?></option>
                            </select>
                        </div>
                        <div class="kal-form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="tel" class="kal-form-control" id="mobile" name="mobile" 
                                   value="<?php echo htmlspecialchars($data['coach']['mobile']); ?>">
                        </div>
                        <div class="kal-form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="kal-form-control" id="email" name="email" 
                                   value="<?php echo htmlspecialchars($data['coach']['email'] ?? ''); ?>">
                        </div>
                        <div class="kal-form-group">
                            <label for="location">Location</label>
                            <input type="text" class="kal-form-control" id="location" name="location" 
                                   value="<?php echo htmlspecialchars($data['coach']['location']); ?>">
                        </div>
                        <div class="kal-form-group">
                            <label for="certification">Certification</label>
                            <input type="text" class="kal-form-control" id="certification" name="certification" 
                                   value="<?php echo htmlspecialchars($data['coach']['certification']); ?>">
                        </div>
                    </div>
                </div>

                <!-- About Me Section -->
                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>About Me</h3>
                        <button type="button" class="kal-edit-btn" onclick="toggleEdit('aboutMe')">Edit</button>
                    </div>
                    <div class="kal-form-group full-width">
                        <label for="bio">Bio/Description</label>
                        <textarea class="kal-form-control" id="bio" name="bio" rows="5"><?php echo htmlspecialchars($data['coach']['bio']); ?></textarea>
                    </div>
                    <div class="kal-form-group full-width">
                        <label for="training_style">Training Style & Philosophy</label>
                        <textarea class="kal-form-control" id="training_style" name="training_style" rows="3"><?php echo htmlspecialchars($data['coach']['training_style'] ?? ''); ?></textarea>
                    </div>
                </div>

                <!-- Specializations Section -->
                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Specializations</h3>
                        <button type="button" class="kal-edit-btn" onclick="toggleEdit('specializations')">Edit</button>
                    </div>
                    <div class="kal-tags-container" id="specializationsContainer">
                        <?php foreach($data['coach']['specialization'] as $spec): ?>
                            <div class="kal-tag">
                                <?php echo htmlspecialchars($spec); ?>
                                <button type="button" class="kal-tag-remove" onclick="removeTag(this)">×</button>
                                <input type="hidden" name="specializations[]" value="<?php echo htmlspecialchars($spec); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="kal-add-tag">
                        <input type="text" class="kal-form-control" id="newSpecialization" placeholder="Add new specialization">
                        <button type="button" class="kal-edit-btn" onclick="addSpecialization()">Add</button>
                    </div>
                </div>

                <!-- Languages Section -->
                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Languages Spoken</h3>
                        <button type="button" class="kal-edit-btn" onclick="toggleEdit('languages')">Edit</button>
                    </div>
                    <div class="kal-tags-container" id="languagesContainer">
                        <?php foreach($data['coach']['languages'] as $lang): ?>
                            <div class="kal-tag">
                                <?php echo htmlspecialchars($lang); ?>
                                <button type="button" class="kal-tag-remove" onclick="removeTag(this)">×</button>
                                <input type="hidden" name="languages[]" value="<?php echo htmlspecialchars($lang); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="kal-add-tag">
                        <input type="text" class="kal-form-control" id="newLanguage" placeholder="Add new language">
                        <button type="button" class="kal-edit-btn" onclick="addLanguage()">Add</button>
                    </div>
                </div>

                <!-- Free Training Slots Section -->
                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Free Training Sessions</h3>
                        <button type="button" class="kal-edit-btn" onclick="toggleEdit('freeSlots')">Edit</button>
                    </div>
                    <div class="kal-slot-grid" id="freeSlotsContainer">
                        <?php foreach($data['coach']['free_slots'] as $index => $slot): ?>
                            <div class="kal-slot-card">
                                <button type="button" class="kal-slot-remove" onclick="removeSlot(this)">×</button>
                                <div class="kal-slot-day"><?php echo htmlspecialchars($slot['day']); ?></div>
                                <div class="kal-slot-time"><?php echo htmlspecialchars($slot['time']); ?></div>
                                <div class="kal-slot-type"><?php echo htmlspecialchars($slot['type']); ?></div>
                                <input type="hidden" name="free_slots[<?php echo $index; ?>][day]" value="<?php echo htmlspecialchars($slot['day']); ?>">
                                <input type="hidden" name="free_slots[<?php echo $index; ?>][time]" value="<?php echo htmlspecialchars($slot['time']); ?>">
                                <input type="hidden" name="free_slots[<?php echo $index; ?>][type]" value="<?php echo htmlspecialchars($slot['type']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="kal-add-slot-form">
                        <div class="kal-form-grid">
                            <div class="kal-form-group">
                                <label for="newSlotDay">Day</label>
                                <select class="kal-form-control" id="newSlotDay">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="kal-form-group">
                                <label for="newSlotTime">Time Slot</label>
                                <input type="text" class="kal-form-control" id="newSlotTime" placeholder="e.g., 4:00 PM - 5:00 PM">
                            </div>
                            <div class="kal-form-group">
                                <label for="newSlotType">Session Type</label>
                                <input type="text" class="kal-form-control" id="newSlotType" placeholder="e.g., Group Session">
                            </div>
                        </div>
                        <button type="button" class="kal-edit-btn" onclick="addFreeSlot()" style="margin-top: 10px;">Add Slot</button>
                    </div>
                </div>

                <!-- Achievements Section -->
                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Achievements & Awards</h3>
                        <button type="button" class="kal-edit-btn" onclick="toggleEdit('achievements')">Edit</button>
                    </div>
                    <ul class="kal-achievement-list" id="achievementsList">
                        <?php foreach($data['coach']['achievements'] as $index => $achievement): ?>
                            <li class="kal-achievement-item">
                                <span class="kal-achievement-text"><?php echo htmlspecialchars($achievement); ?></span>
                                <button type="button" class="kal-remove-btn" onclick="removeAchievement(this)">Remove</button>
                                <input type="hidden" name="achievements[]" value="<?php echo htmlspecialchars($achievement); ?>">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="kal-add-achievement">
                        <input type="text" class="kal-form-control" id="newAchievement" placeholder="Add new achievement">
                        <button type="button" class="kal-edit-btn" onclick="addAchievement()">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// Toggle edit mode for sections
function toggleEdit(section) {
    const inputs = document.querySelectorAll(`#${section} input, #${section} select, #${section} textarea`);
    inputs.forEach(input => {
        input.readOnly = !input.readOnly;
        input.disabled = !input.disabled;
    });
}

// Tag management functions
function removeTag(button) {
    button.parentElement.remove();
}

function addSpecialization() {
    const input = document.getElementById('newSpecialization');
    const value = input.value.trim();
    if (value) {
        const container = document.getElementById('specializationsContainer');
        const tag = document.createElement('div');
        tag.className = 'kal-tag';
        tag.innerHTML = `
            ${value}
            <button type="button" class="kal-tag-remove" onclick="removeTag(this)">×</button>
            <input type="hidden" name="specializations[]" value="${value}">
        `;
        container.appendChild(tag);
        input.value = '';
    }
}

function addLanguage() {
    const input = document.getElementById('newLanguage');
    const value = input.value.trim();
    if (value) {
        const container = document.getElementById('languagesContainer');
        const tag = document.createElement('div');
        tag.className = 'kal-tag';
        tag.innerHTML = `
            ${value}
            <button type="button" class="kal-tag-remove" onclick="removeTag(this)">×</button>
            <input type="hidden" name="languages[]" value="${value}">
        `;
        container.appendChild(tag);
        input.value = '';
    }
}

// Free slots management
function removeSlot(button) {
    button.parentElement.remove();
}

function addFreeSlot() {
    const day = document.getElementById('newSlotDay').value;
    const time = document.getElementById('newSlotTime').value.trim();
    const type = document.getElementById('newSlotType').value.trim();
    
    if (day && time && type) {
        const container = document.getElementById('freeSlotsContainer');
        const index = container.children.length;
        
        const slotCard = document.createElement('div');
        slotCard.className = 'kal-slot-card';
        slotCard.innerHTML = `
            <button type="button" class="kal-slot-remove" onclick="removeSlot(this)">×</button>
            <div class="kal-slot-day">${day}</div>
            <div class="kal-slot-time">${time}</div>
            <div class="kal-slot-type">${type}</div>
            <input type="hidden" name="free_slots[${index}][day]" value="${day}">
            <input type="hidden" name="free_slots[${index}][time]" value="${time}">
            <input type="hidden" name="free_slots[${index}][type]" value="${type}">
        `;
        container.appendChild(slotCard);
        
        // Clear form
        document.getElementById('newSlotTime').value = '';
        document.getElementById('newSlotType').value = '';
    }
}

// Achievements management
function removeAchievement(button) {
    button.parentElement.remove();
}

function addAchievement() {
    const input = document.getElementById('newAchievement');
    const value = input.value.trim();
    if (value) {
        const list = document.getElementById('achievementsList');
        const item = document.createElement('li');
        item.className = 'kal-achievement-item';
        item.innerHTML = `
            <span class="kal-achievement-text">${value}</span>
            <button type="button" class="kal-remove-btn" onclick="removeAchievement(this)">Remove</button>
            <input type="hidden" name="achievements[]" value="${value}">
        `;
        list.appendChild(item);
        input.value = '';
    }
}

// Image upload preview
document.getElementById('profilePhoto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.querySelector('.kal-profile-photo-img');
            img.innerHTML = `<img src="${e.target.result}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php require APPROOT . '/views/coachdash/inc/footer.php'; ?>