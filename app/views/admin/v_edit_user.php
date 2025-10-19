<div class="form-group">
                            <label for="customer_district">District</label>
                            <select id="customer_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo" <?php echo ($data['user']->customer_district ?? '') == 'Colombo' ? 'selected' : ''; ?>>Colombo</option>
                                <option value="Kandy" <?php echo ($data['user']->customer_district ?? '') == 'Kandy' ? 'selected' : ''; ?>>Kandy</option>
                                <option value="Galle" <?php echo ($data['user']->customer_district ?? '') == 'Galle' ? 'selected' : ''; ?>>Galle</option>
                                <option value="Jaffna" <?php echo ($data['user']->customer_district ?? '') == 'Jaffna' ? 'selected' : ''; ?>>Jaffna</option>
                                <option value="Negombo" <?php echo ($data['user']->customer_district ?? '') == 'Negombo' ? 'selected' : ''; ?>>Negombo</option>
                                <option value="Anuradhapura" <?php echo ($data['user']->customer_district ?? '') == 'Anuradhapura' ? 'selected' : ''; ?>>Anuradhapura</option>
                                <option value="Polonnaruwa" <?php echo ($data['user']->customer_district ?? '') == 'Polonnaruwa' ? 'selected' : ''; ?>>Polonnaruwa</option>
                                <option value="Kurunegala" <?php echo ($data['user']->customer_district ?? '') == 'Kurunegala' ? 'selected' : ''; ?>>Kurunegala</option>
                                <option value="Ratnapura" <?php echo ($data['user']->customer_district ?? '') == 'Ratnapura' ? 'selected' : ''; ?>>Ratnapura</option>
                                <option value="Batticaloa" <?php echo ($data['user']->customer_district ?? '') == 'Batticaloa' ? 'selected' : ''; ?>>Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer_sports">Preferred Sports</label>
                            <select id="customer_sports" name="profile_data[sports]" class="form-control">
                                <option value="">Select Sport</option>
                                <option value="football" <?php echo ($data['user']->sports ?? '') == 'football' ? 'selected' : ''; ?>>Football</option>
                                <option value="cricket" <?php echo ($data['user']->sports ?? '') == 'cricket' ? 'selected' : ''; ?>>Cricket</option>
                                <option value="basketball" <?php echo ($data['user']->sports ?? '') == 'basketball' ? 'selected' : ''; ?>>Basketball</option>
                                <option value="tennis" <?php echo ($data['user']->sports ?? '') == 'tennis' ? 'selected' : ''; ?>>Tennis</option>
                                <option value="badminton" <?php echo ($data['user']->sports ?? '') == 'badminton' ? 'selected' : ''; ?>>Badminton</option>
                                <option value="swimming" <?php echo ($data['user']->sports ?? '') == 'swimming' ? 'selected' : ''; ?>>Swimming</option>
                                <option value="volleyball" <?php echo ($data['user']->sports ?? '') == 'volleyball' ? 'selected' : ''; ?>>Volleyball</option>
                                <option value="rugby" <?php echo ($data['user']->sports ?? '') == 'rugby' ? 'selected' : ''; ?>>Rugby</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer_age_group">Age Group</label>
                            <select id="customer_age_group" name="profile_data[age_group]" class="form-control">
                                <option value="">Select Age Group</option>
                                <option value="under_18" <?php echo ($data['user']->age_group ?? '') == 'under_18' ? 'selected' : ''; ?>>Under 18</option>
                                <option value="18_25" <?php echo ($data['user']->age_group ?? '') == '18_25' ? 'selected' : ''; ?>>18-25 years</option>
                                <option value="26_35" <?php echo ($data['user']->age_group ?? '') == '26_35' ? 'selected' : ''; ?>>26-35 years</option>
                                <option value="above_35" <?php echo ($data['user']->age_group ?? '') == 'above_35' ? 'selected' : ''; ?>>Above 35</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer_skill_level">Skill Level</label>
                            <select id="customer_skill_level" name="profile_data[skill_level]" class="form-control">
                                <option value="">Select Skill Level</option>
                                <option value="beginner" <?php echo ($data['user']->skill_level ?? '') == 'beginner' ? 'selected' : ''; ?>>Beginner</option>
                                <option value="intermediate" <?php echo ($data['user']->skill_level ?? '') == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                <option value="advanced" <?php echo ($data['user']->skill_level ?? '') == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                                <option value="professional" <?php echo ($data['user']->skill_level ?? '') == 'professional' ? 'selected' : ''; ?>>Professional</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Stadium Owner Profile Fields -->
                <div id="stadiumOwnerFields" class="role-fields" style="display: none;">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="owner_name">Owner Name</label>
                            <input type="text" 
                                   id="owner_name" 
                                   name="profile_data[owner_name]" 
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($data['user']->stadium_owner_name ?? ''); ?>"
                                   placeholder="Enter owner full name">
                        </div>

                        <div class="form-group">
                            <label for="business_name">Business Name</label>
                            <input type="text" 
                                   id="business_name" 
                                   name="profile_data[business_name]" 
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($data['user']->stadium_business_name ?? ''); ?>"
                                   placeholder="Enter business/stadium name">
                        </div>

                        <div class="form-group">
                            <label for="stadium_district">District</label>
                            <select id="stadium_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo" <?php echo ($data['user']->stadium_district ?? '') == 'Colombo' ? 'selected' : ''; ?>>Colombo</option>
                                <option value="Kandy" <?php echo ($data['user']->stadium_district ?? '') == 'Kandy' ? 'selected' : ''; ?>>Kandy</option>
                                <option value="Galle" <?php echo ($data['user']->stadium_district ?? '') == 'Galle' ? 'selected' : ''; ?>>Galle</option>
                                <option value="Jaffna" <?php echo ($data['user']->stadium_district ?? '') == 'Jaffna' ? 'selected' : ''; ?>>Jaffna</option>
                                <option value="Negombo" <?php echo ($data['user']->stadium_district ?? '') == 'Negombo' ? 'selected' : ''; ?>>Negombo</option>
                                <option value="Anuradhapura" <?php echo ($data['user']->stadium_district ?? '') == 'Anuradhapura' ? 'selected' : ''; ?>>Anuradhapura</option>
                                <option value="Polonnaruwa" <?php echo ($data['user']->stadium_district ?? '') == 'Polonnaruwa' ? 'selected' : ''; ?>>Polonnaruwa</option>
                                <option value="Kurunegala" <?php echo ($data['user']->stadium_district ?? '') == 'Kurunegala' ? 'selected' : ''; ?>>Kurunegala</option>
                                <option value="Ratnapura" <?php echo ($data['user']->stadium_district ?? '') == 'Ratnapura' ? 'selected' : ''; ?>>Ratnapura</option>
                                <option value="Batticaloa" <?php echo ($data['user']->stadium_district ?? '') == 'Batticaloa' ? 'selected' : ''; ?>>Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="venue_type">Venue Type</label>
                            <select id="venue_type" name="profile_data[venue_type]" class="form-control">
                                <option value="">Select Venue Type</option>
                                <option value="stadium" <?php echo ($data['user']->venue_type ?? '') == 'stadium' ? 'selected' : ''; ?>>Stadium</option>
                                <option value="indoor_court" <?php echo ($data['user']->venue_type ?? '') == 'indoor_court' ? 'selected' : ''; ?>>Indoor Court</option>
                                <option value="outdoor_court" <?php echo ($data['user']->venue_type ?? '') == 'outdoor_court' ? 'selected' : ''; ?>>Outdoor Court</option>
                                <option value="sports_complex" <?php echo ($data['user']->venue_type ?? '') == 'sports_complex' ? 'selected' : ''; ?>>Sports Complex</option>
                                <option value="practice_nets" <?php echo ($data['user']->venue_type ?? '') == 'practice_nets' ? 'selected' : ''; ?>>Practice Nets</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="business_registration">Business Registration</label>
                            <input type="text" 
                                   id="business_registration" 
                                   name="profile_data[business_registration]" 
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($data['user']->business_registration ?? ''); ?>"
                                   placeholder="Enter business registration number">
                        </div>
                    </div>
                </div>

                <!-- Coach Profile Fields -->
                <div id="coachFields" class="role-fields" style="display: none;">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="specialization">Specialization</label>
                            <select id="specialization" name="profile_data[specialization]" class="form-control">
                                <option value="">Select Specialization</option>
                                <option value="football" <?php echo ($data['user']->specialization ?? '') == 'football' ? 'selected' : ''; ?>>Football</option>
                                <option value="cricket" <?php echo ($data['user']->specialization ?? '') == 'cricket' ? 'selected' : ''; ?>>Cricket</option>
                                <option value="basketball" <?php echo ($data['user']->specialization ?? '') == 'basketball' ? 'selected' : ''; ?>>Basketball</option>
                                <option value="tennis" <?php echo ($data['user']->specialization ?? '') == 'tennis' ? 'selected' : ''; ?>>Tennis</option>
                                <option value="badminton" <?php echo ($data['user']->specialization ?? '') == 'badminton' ? 'selected' : ''; ?>>Badminton</option>
                                <option value="swimming" <?php echo ($data['user']->specialization ?? '') == 'swimming' ? 'selected' : ''; ?>>Swimming</option>
                                <option value="volleyball" <?php echo ($data['user']->specialization ?? '') == 'volleyball' ? 'selected' : ''; ?>>Volleyball</option>
                                <option value="rugby" <?php echo ($data['user']->specialization ?? '') == 'rugby' ? 'selected' : ''; ?>>Rugby</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <select id="experience" name="profile_data[experience]" class="form-control">
                                <option value="">Select Experience</option>
                                <option value="1_3" <?php echo ($data['user']->experience ?? '') == '1_3' ? 'selected' : ''; ?>>1-3 years</option>
                                <option value="4_6" <?php echo ($data['user']->experience ?? '') == '4_6' ? 'selected' : ''; ?>>4-6 years</option>
                                <option value="7_10" <?php echo ($data['user']->experience ?? '') == '7_10' ? 'selected' : ''; ?>>7-10 years</option>
                                <option value="10_plus" <?php echo ($data['user']->experience ?? '') == '10_plus' ? 'selected' : ''; ?>>10+ years</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="certification">Certification</label>
                            <select id="certification" name="profile_data[certification]" class="form-control">
                                <option value="">Select Certification</option>
                                <option value="basic" <?php echo ($data['user']->certification ?? '') == 'basic' ? 'selected' : ''; ?>>Basic</option>
                                <option value="intermediate" <?php echo ($data['user']->certification ?? '') == 'intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                                <option value="advanced" <?php echo ($data['user']->certification ?? '') == 'advanced' ? 'selected' : ''; ?>>Advanced</option>
                                <option value="professional" <?php echo ($data['user']->certification ?? '') == 'professional' ? 'selected' : ''; ?>>Professional</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coaching_type">Coaching Type</label>
                            <select id="coaching_type" name="profile_data[coaching_type]" class="form-control">
                                <option value="">Select Coaching Type</option>
                                <option value="individual" <?php echo ($data['user']->coaching_type ?? '') == 'individual' ? 'selected' : ''; ?>>Individual</option>
                                <option value="group" <?php echo ($data['user']->coaching_type ?? '') == 'group' ? 'selected' : ''; ?>>Group</option>
                                <option value="both" <?php echo ($data['user']->coaching_type ?? '') == 'both' ? 'selected' : ''; ?>>Both</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coach_district">District</label>
                            <select id="coach_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo" <?php echo ($data['user']->coach_district ?? '') == 'Colombo' ? 'selected' : ''; ?>>Colombo</option>
                                <option value="Kandy" <?php echo ($data['user']->coach_district ?? '') == 'Kandy' ? 'selected' : ''; ?>>Kandy</option>
                                <option value="Galle" <?php echo ($data['user']->coach_district ?? '') == 'Galle' ? 'selected' : ''; ?>>Galle</option>
                                <option value="Jaffna" <?php echo ($data['user']->coach_district ?? '') == 'Jaffna' ? 'selected' : ''; ?>>Jaffna</option>
                                <option value="Negombo" <?php echo ($data['user']->coach_district ?? '') == 'Negombo' ? 'selected' : ''; ?>>Negombo</option>
                                <option value="Anuradhapura" <?php echo ($data['user']->coach_district ?? '') == 'Anuradhapura' ? 'selected' : ''; ?>>Anuradhapura</option>
                                <option value="Polonnaruwa" <?php echo ($data['user']->coach_district ?? '') == 'Polonnaruwa' ? 'selected' : ''; ?>>Polonnaruwa</option>
                                <option value="Kurunegala" <?php echo ($data['user']->coach_district ?? '') == 'Kurunegala' ? 'selected' : ''; ?>>Kurunegala</option>
                                <option value="Ratnapura" <?php echo ($data['user']->coach_district ?? '') == 'Ratnapura' ? 'selected' : ''; ?>>Ratnapura</option>
                                <option value="Batticaloa" <?php echo ($data['user']->coach_district ?? '') == 'Batticaloa' ? 'selected' : ''; ?>>Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="availability">Availability</label>
                            <select id="availability" name="profile_data[availability]" class="form-control">
                                <option value="">Select Availability</option>
                                <option value="full_time" <?php echo ($data['user']->availability ?? '') == 'full_time' ? 'selected' : ''; ?>>Full Time</option>
                                <option value="part_time" <?php echo ($data['user']->availability ?? '') == 'part_time' ? 'selected' : ''; ?>>Part Time</option>
                                <option value="weekends" <?php echo ($data['user']->availability ?? '') == 'weekends' ? 'selected' : ''; ?>>Weekends</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Rental Owner Profile Fields -->
                <div id="rentalOwnerFields" class="role-fields" style="display: none;">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="rental_owner_name">Owner Name</label>
                            <input type="text" 
                                   id="rental_owner_name" 
                                   name="profile_data[owner_name]" 
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($data['user']->rental_owner_name ?? ''); ?>"
                                   placeholder="Enter owner full name">
                        </div>

                        <div class="form-group">
                            <label for="rental_business_name">Business Name</label>
                            <input type="text" 
                                   id="rental_business_name" 
                                   name="profile_data[business_name]" 
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($data['user']->rental_business_name ?? ''); ?>"
                                   placeholder="Enter business/shop name">
                        </div>

                        <div class="form-group">
                            <label for="rental_district">District</label>
                            <select id="rental_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo" <?php echo ($data['user']->rental_district ?? '') == 'Colombo' ? 'selected' : ''; ?>>Colombo</option>
                                <option value="Kandy" <?php echo ($data['user']->rental_district ?? '') == 'Kandy' ? 'selected' : ''; ?>>Kandy</option>
                                <option value="Galle" <?php echo ($data['user']->rental_district ?? '') == 'Galle' ? 'selected' : ''; ?>>Galle</option>
                                <option value="Jaffna" <?php echo ($data['user']->rental_district ?? '') == 'Jaffna' ? 'selected' : ''; ?>>Jaffna</option>
                                <option value="Negombo" <?php echo ($data['user']->rental_district ?? '') == 'Negombo' ? 'selected' : ''; ?>>Negombo</option>
                                <option value="Anuradhapura" <?php echo ($data['user']->rental_district ?? '') == 'Anuradhapura' ? 'selected' : ''; ?>>Anuradhapura</option>
                                <option value="Polonnaruwa" <?php echo ($data['user']->rental_district ?? '') == 'Polonnaruwa' ? 'selected' : ''; ?>>Polonnaruwa</option>
                                <option value="Kurunegala" <?php echo ($data['user']->rental_district ?? '') == 'Kurunegala' ? 'selected' : ''; ?>>Kurunegala</option>
                                <option value="Ratnapura" <?php echo ($data['user']->rental_district ?? '') == 'Ratnapura' ? 'selected' : ''; ?>>Ratnapura</option>
                                <option value="Batticaloa" <?php echo ($data['user']->rental_district ?? '') == 'Batticaloa' ? 'selected' : ''; ?>>Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="business_type">Business Type</label>
                            <select id="business_type" name="profile_data[business_type]" class="form-control">
                                <option value="">Select Business Type</option>
                                <option value="retail_chain" <?php echo ($data['user']->business_type ?? '') == 'retail_chain' ? 'selected' : ''; ?>>Retail Chain</option>
                                <option value="independent" <?php echo ($data['user']->business_type ?? '') == 'independent' ? 'selected' : ''; ?>>Independent Store</option>
                                <option value="sports_shop" <?php echo ($data['user']->business_type ?? '') == 'sports_shop' ? 'selected' : ''; ?>>Sports Shop</option>
                                <option value="equipment_specialist" <?php echo ($data['user']->business_type ?? '') == 'equipment_specialist' ? 'selected' : ''; ?>>Equipment Specialist</option>
                                <option value="franchise" <?php echo ($data['user']->business_type ?? '') == 'franchise' ? 'selected' : ''; ?>>Franchise</option>
                                <option value="other" <?php echo ($data['user']->business_type ?? '') == 'other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="equipment_categories">Equipment Categories</label>
                            <select id="equipment_categories" name="profile_data[equipment_categories]" class="form-control">
                                <option value="">Select Equipment Category</option>
                                <option value="football_equipment" <?php echo ($data['user']->equipment_categories ?? '') == 'football_equipment' ? 'selected' : ''; ?>>Football Equipment</option>
                                <option value="cricket_equipment" <?php echo ($data['user']->equipment_categories ?? '') == 'cricket_equipment' ? 'selected' : ''; ?>>Cricket Equipment</option>
                                <option value="basketball_equipment" <?php echo ($data['user']->equipment_categories ?? '') == 'basketball_equipment' ? 'selected' : ''; ?>>Basketball Equipment</option>
                                <option value="tennis_equipment" <?php echo ($data['user']->equipment_categories ?? '') == 'tennis_equipment' ? 'selected' : ''; ?>>Tennis Equipment</option>
                                <option value="badminton_equipment" <?php echo ($data['user']->equipment_categories ?? '') == 'badminton_equipment' ? 'selected' : ''; ?>>Badminton Equipment</option>
                                <option value="multi_sport" <?php echo ($data['user']->equipment_categories ?? '') == 'multi_sport' ? 'selected' : ''; ?>>Multi-Sport Equipment</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="delivery_service">Delivery Service</label>
                            <select id="delivery_service" name="profile_data[delivery_service]" class="form-control">
                                <option value="">Select Delivery Option</option>
                                <option value="yes" <?php echo ($data['user']->delivery_service ?? '') == 'yes' ? 'selected' : ''; ?>>Yes, We Deliver</option>
                                <option value="no" <?php echo ($data['user']->delivery_service ?? '') == 'no' ? 'selected' : ''; ?>>Pickup Only</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="window.location.href='<?php echo URLROOT; ?>/admin/users'">
                    <span class="icon">✖️</span> Cancel
                </button>
                <button type="button" class="btn-reset" onclick="resetChanges()">
                    <span class="icon">🔄</span> Reset Changes
                </button>
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="icon">💾</span> Update User
                    <div class="btn-loading" style="display: none;">
                        <span class="loading-spinner"></span> Updating...
                    </div>
                </button>
            </div>
        </form>
    </div>

    <!-- Quick Actions Panel -->
    <div class="quick-actions-panel">
        <h3>Quick Actions</h3>
        <div class="quick-actions-grid">
            <button class="quick-action-btn" onclick="quickStatusChange()">
                <span class="icon">⚡</span>
                <span class="text">Change Status</span>
            </button>
            <button class="quick-action-btn" onclick="resetPassword()">
                <span class="icon">🔑</span>
                <span class="text">Reset Password</span>
            </button>
            <button class="quick-action-btn" onclick="sendWelcomeEmail()">
                <span class="icon">📧</span>
                <span class="text">Send Welcome Email</span>
            </button>
            <button class="quick-action-btn danger" onclick="deleteUserConfirm()">
                <span class="icon">🗑️</span>
                <span class="text">Delete User</span>
            </button>
        </div>
    </div>
</div>

<script>
// Edit User Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form
    setupFormValidation();
    setupPasswordStrength();
    toggleRoleFields(); // Show current role fields
    
    // Track form changes
    const form = document.getElementById('editUserForm');
    const originalData = new FormData(form);
    let hasChanges = false;
    
    // Monitor form changes
    form.addEventListener('input', function() {
        hasChanges = true;
        checkFormChanges();
    });
    
    form.addEventListener('change', function() {
        hasChanges = true;
        checkFormChanges();
    });
});

// Check if form has changes
function checkFormChanges() {
    const submitBtn = document.getElementById('submitBtn');
    if (hasChanges) {
        submitBtn.classList.add('has-changes');
    } else {
        submitBtn.classList.remove('has-changes');
    }
}

// Toggle role-specific fields based on selected role
function toggleRoleFields() {
    const role = document.getElementById('role').value;
    const roleSection = document.getElementById('roleSpecificSection');
    const roleTitle = document.getElementById('roleSpecificTitle');
    const roleDescription = document.getElementById('roleSpecificDescription');
    
    // Hide all role fields
    document.querySelectorAll('.role-fields').forEach(field => {
        field.style.display = 'none';
    });
    
    if (role) {
        roleSection.style.display = 'block';
        
        // Show specific role fields
        switch(role) {
            case 'customer':
                document.getElementById('customerFields').style.display = 'block';
                roleTitle.textContent = 'Customer Information';
                roleDescription.textContent = 'Sports preferences and personal details';
                break;
            case 'stadium_owner':
                document.getElementById('stadiumOwnerFields').style.display = 'block';
                roleTitle.textContent = 'Stadium Owner Information';
                roleDescription.textContent = 'Business and venue details';
                break;
            case 'coach':
                document.getElementById('coachFields').style.display = 'block';
                roleTitle.textContent = 'Coach Information';
                roleDescription.textContent = 'Professional qualifications and expertise';
                break;
            case 'rental_owner':
                document.getElementById('rentalOwnerFields').style.display = 'block';
                roleTitle.textContent = 'Rental Owner Information';
                roleDescription.textContent = 'Equipment business details';
                break;
        }
    } else {
        roleSection.style.display = 'none';
    }
}

// Password toggle functionality
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.nextElementSibling.querySelector('.icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.textContent = '🙈';
    } else {
        field.type = 'password';
        icon.textContent = '👁️';
    }
}

// Form validation setup (reuse from add user form)
function setupFormValidation() {
    const form = document.getElementById('editUserForm');
    
    form.addEventListener('input', function(e) {
        validateField(e.target);
    });
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateForm()) {
            submitForm();
        }
    });
}

// Password strength checker (reuse from add user form)
function setupPasswordStrength() {
    const passwordField = document.getElementById('new_password');
    const strengthIndicator = document.getElementById('password_strength');
    
    if (passwordField && strengthIndicator) {
        passwordField.addEventListener('input', function() {
            const password = this.value;
            if (password) {
                const strength = checkPasswordStrength(password);
                strengthIndicator.className = 'password-strength';
                strengthIndicator.textContent = '';
            }
        });
    }
}

// Validation functions (reuse from add user form)
function validateField(field) {
    const fieldName = field.name;
    const value = field.value.trim();
    const errorElement = document.getElementById(fieldName + '_error');
    
    if (!errorElement) return true;
    
    let isValid = true;
    let errorMessage = '';
    
    switch(fieldName) {
        case 'first_name':
        case 'last_name':
            if (!value) {
                isValid = false;
                errorMessage = 'This field is required';
            } else if (value.length < 2) {
                isValid = false;
                errorMessage = 'Must be at least 2 characters';
            }
            break;
            
        case 'email':
            if (!value) {
                isValid = false;
                errorMessage = 'Email is required';
            } else if (!isValidEmail(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            }
            break;
            
        case 'phone':
            if (!value) {
                isValid = false;
                errorMessage = 'Phone number is required';
            } else if (!isValidPhone(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid phone number';
            }
            break;
            
        case 'new_password':
            if (value && value.length < 6) {
                isValid = false;
                errorMessage = 'Password must be at least 6 characters';
            }
            break;
            
        case 'confirm_new_password':
            const newPassword = document.getElementById('new_password').value;
            if (newPassword && !value) {
                isValid = false;
                errorMessage = 'Please confirm your new password';
            } else if (value && value !== newPassword) {
                isValid = false;
                errorMessage = 'Passwords do not match';
            }
            break;
            
        case 'role':
            if (!value) {
                isValid = false;
                errorMessage = 'Please select a user role';
            }
            break;
    }
    
    // Update field appearance
    if (isValid) {
        field.classList.remove('error');
        field.classList.add('valid');
        errorElement.textContent = '';
    } else {
        field.classList.remove('valid');
        field.classList.add('error');
        errorElement.textContent = errorMessage;
    }
    
    return isValid;
}

function validateForm() {
    const requiredFields = ['first_name', 'last_name', 'email', 'phone', 'role'];
    let isValid = true;
    
    requiredFields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field && !validateField(field)) {
            isValid = false;
        }
    });
    
    return isValid;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
    return phoneRegex.test(phone);
}

function checkPasswordStrength(password) {
    if (password.length === 0) {
        return { class: '', text: '' };
    }
    
    let score = 0;
    if (password.length >= 6) score++;
    if (password.length >= 8) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[a-z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[^A-Za-z0-9]/.test(password)) score++;
    
    if (score < 3) {
        return { class: 'weak', text: 'Weak password' };
    } else if (score < 5) {
        return { class: 'medium', text: 'Medium password' };
    } else {
        return { class: 'strong', text: 'Strong password' };
    }
}

// Submit form
function submitForm() {
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.icon').parentNode;
    const btnLoading = submitBtn.querySelector('.btn-loading');
    
    // Show loading state
    btnText.style.display = 'none';
    btnLoading.style.display = 'flex';
    submitBtn.disabled = true;
    
    // Submit the form
    document.getElementById('editUserForm').submit();
}

// Reset changes
function resetChanges() {
    if (confirm('Are you sure you want to reset all changes? This will revert to the original values.')) {
        location.reload();
    }
}

// Quick Actions
function quickStatusChange() {
    const currentStatus = '<?php echo $data['user']->status; ?>';
    const statusOptions = {
        'active': 'Active',
        'inactive': 'Inactive', 
        'suspended': 'Suspended',
        'pending': 'Pending'
    };
    
    let optionsHtml = '';
    Object.keys(statusOptions).forEach(status => {
        const selected = status === currentStatus ? 'selected' : '';
        optionsHtml += `<option value="${status}" ${selected}>${statusOptions[status]}</option>`;
    });
    
    const newStatus = prompt(`Current status: ${statusOptions[currentStatus]}\n\nSelect new status:`, currentStatus);
    
    if (newStatus && newStatus !== currentStatus && statusOptions[newStatus]) {
        if (confirm(`Change user status from "${statusOptions[currentStatus]}" to "${statusOptions[newStatus]}"?`)) {
            // Update status via AJAX
            updateUserStatus(<?php echo $data['user']->id; ?>, newStatus);
        }
    }
}

function resetPassword() {
    if (confirm('This will generate a new temporary password and send it to the user via email. Continue?')) {
        // Implement password reset via AJAX
        fetch('<?php echo URLROOT; ?>/admin/ajax_reset_password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                user_id: <?php echo $data['user']->id; ?>
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Password reset successfully. New temporary password sent to user via email.');
            } else {
                alert('Failed to reset password: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error resetting password. Please try again.');
        });
    }
}

function sendWelcomeEmail() {
    if (confirm('Send a welcome email to this user?')) {
        // Implement welcome email via AJAX
        fetch('<?php echo URLROOT; ?>/admin/ajax_send_welcome', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                user_id: <?php echo $data['user']->id; ?>
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Welcome email sent successfully.');
            } else {
                alert('Failed to send welcome email: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error sending welcome email. Please try again.');
        });
    }
}

function deleteUserConfirm() {
    const userName = '<?php echo htmlspecialchars($data['user']->first_name . ' ' . $data['user']->last_name); ?>';
    
    if (confirm(`Are you sure you want to delete "${userName}"?\n\nThis action cannot be undone and will remove:\n- User account and login access\n- All associated data\n- Booking history\n- Role-specific information\n\nType "DELETE" to confirm.`)) {
        const confirmation = prompt('Type "DELETE" to confirm deletion:');
        
        if (confirmation === 'DELETE') {
            window.location.href = '<?php echo URLROOT; ?>/admin/delete_user/<?php echo $data['user']->id; ?>';
        } else {
            alert('Deletion cancelled - confirmation text did not match.');
        }
    }
}

function updateUserStatus(userId, newStatus) {
    fetch('<?php echo URLROOT; ?>/admin/ajax_update_status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${userId}&status=${newStatus}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the status badge in the header
            const statusBadge = document.querySelector('.user-header-info .status-badge');
            const statusDot = statusBadge.querySelector('.status-dot');
            
            statusBadge.className = `status-badge ${newStatus}`;
            statusBadge.innerHTML = `<span class="status-dot"></span>${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}`;
            
            // Update the form select
            document.getElementById('status').value = newStatus;
            
            alert('User status updated successfully.');
        } else {
            alert('Failed to update status: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error updating status. Please try again.');
    });
}

// Warn user about unsaved changes
window.addEventListener('beforeunload', function(e) {
    if (hasChanges) {
        e.preventDefault();
        e.returnValue = '';
        return 'You have unsaved changes. Are you sure you want to leave?';
    }
});
</script>

<style>
/* Edit User Specific Styles */
.user-header {
    background: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 24px;
}

.user-avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #03B200, #029800);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 36px;
    box-shadow: 0 4px 16px rgba(3, 178, 0, 0.3);
}

.user-header-info h2 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 28px;
    font-weight: 700;
}

.user-email {
    margin: 0 0 16px 0;
    color: #666;
    font-size: 16px;
}

.user-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.join-date {
    color: #666;
    font-size: 14px;
}

.readonly-field {
    padding: 12px 16px;
    background: #f8f9fa;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    color: #666;
    font-style: italic;
}

.btn-view {
    padding: 10px 16px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-view:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.btn-submit.has-changes {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2); }
    50% { box-shadow: 0 0 0 6px rgba(40, 167, 69, 0.1); }
    100% { box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2); }
}

.quick-actions-panel {
    background: white;
    padding: 24px;
    border-radius: 12px;
    margin-top: 30px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.quick-actions-panel h3 {
    margin: 0 0 20px 0;
    color: #333;
    font-size: 18px;
    font-weight: 600;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.quick-action-btn {
    padding: 16px 20px;
    border: 2px solid #e1e5e9;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    font-weight: 600;
}

.quick-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-color: #03B200;
}

.quick-action-btn.danger {
    border-color: #dc3545;
    color: #dc3545;
}

.quick-action-btn.danger:hover {
    background: rgba(220, 53, 69, 0.1);
    border-color: #dc3545;
}

.quick-action-btn .icon {
    font-size: 20px;
}

.quick-action-btn .text {
    font-size: 14px;
}

/* Role field styling enhancements */
.role-fields {
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design for Edit User */
@media (max-width: 768px) {
    .user-header {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }
    
    .user-header-info h2 {
        font-size: 24px;
    }
    
    .user-meta {
        justify-content: center;
    }
    
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-action-btn {
        justify-content: center;
    }
    
    .dashboard-header {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    
    .header-actions {
        flex-direction: column;
        width: 100%;
        gap: 12px;
    }
    
    .btn-view, .btn-back {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .user-avatar-large {
        width: 60px;
        height: 60px;
        font-size: 28px;
    }
    
    .user-header-info h2 {
        font-size: 20px;
    }
    
    .user-email {
        font-size: 14px;
    }
    
    .user-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .quick-actions-panel {
        padding: 16px;
    }
    
    .quick-action-btn {
        padding: 12px 16px;
    }
}

/* Form styles inheritance from add user form */
.form-container {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.user-form {
    padding: 0;
}

.form-section {
    padding: 30px;
    border-bottom: 1px solid #e1e5e9;
}

.form-section:last-child {
    border-bottom: none;
}

.section-header {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f8f9fa;
}

.section-header h3 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 20px;
    font-weight: 600;
}

.section-header p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-weight: 600;
    color: #333;
    font-size: 14px;
}

.form-group label.required::after {
    content: ' *';
    color: #dc3545;
}

.form-control {
    padding: 12px 16px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #03B200;
    box-shadow: 0 0 0 3px rgba(3, 178, 0, 0.1);
}

.form-control.error {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.form-control.valid {
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
}

.form-error {
    color: #dc3545;
    font-size: 12px;
    font-weight: 500;
    min-height: 18px;
}

.form-help {
    color: #666;
    font-size: 12px;
    font-style: italic;
}

.password-field {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    color: #666;
    font-size: 16px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #333;
}

.password-strength {
    font-size: 12px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 4px;
    text-align: center;
}

.password-strength.weak {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.password-strength.medium {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.password-strength.strong {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.form-actions {
    padding: 30px;
    background: #f8f9fa;
    display: flex;
    justify-content: flex-end;
    gap: 16px;
    border-top: 1px solid #e1e5e9;
}

.btn-cancel, .btn-reset, .btn-submit {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-cancel {
    background: #f8f9fa;
    color: #6c757d;
    border: 1px solid #dee2e6;
}

.btn-cancel:hover {
    background: #e2e6ea;
    transform: translateY(-1px);
}

.btn-reset {
    background: #ffc107;
    color: #212529;
}

.btn-reset:hover {
    background: #e0a800;
    transform: translateY(-1px);
}

.btn-submit {
    background: linear-gradient(135deg, #03B200, #029800);
    color: white;
    position: relative;
}

.btn-submit:hover:not(:disabled) {
    background: linear-gradient(135deg, #029800, #026b00);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(3, 178, 0, 0.3);
}

.btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-loading {
    display: none;
    align-items: center;
    gap: 8px;
}

.loading-spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.alert {
    padding: 16px 20px;
    margin-bottom: 24px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 500;
}

.alert-error {
    background: rgba(220, 53, 69, 0.1);
    border: 1px solid #dc3545;
    color: #721c24;
}

.alert-success {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid #28a745;
    color: #155724;
}

/* Role badge and status badge styles */
.role-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.role-badge.customer {
    background: rgba(0, 123, 255, 0.1);
    color: #007bff;
}

.role-badge.stadium-owner {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.role-badge.coach {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.role-badge.rental-owner {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.status-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
}

.status-badge.active {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.status-badge.active .status-dot {
    background: #28a745;
}

.status-badge.suspended {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.status-badge.suspended .status-dot {
    background: #ffc107;
}

.status-badge.inactive, .status-badge.pending {
    background: rgba(108, 117, 125, 0.1);
    color: #6c757d;
}

.status-badge.inactive .status-dot, .status-badge.pending .status-dot {
    background: #6c757d;
}
</style>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>password-strength ' + strength.class;
                strengthIndicator.textContent = strength.text;
            } else {
                strengthIndicator.className = '<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <div class="header-left">
            <h1>Edit User</h1>
            <p>Update user information and settings</p>
        </div>
        <div class="header-actions">
            <a href="<?php echo URLROOT; ?>/admin/view_user/<?php echo $data['user']->id; ?>" class="btn-view">
                <span class="icon">👁️</span> View Details
            </a>
            <a href="<?php echo URLROOT; ?>/admin/users" class="btn-back">
                <span class="icon">←</span> Back to Users
            </a>
        </div>
    </div>

    <!-- Error/Success Messages -->
    <?php if(!empty($data['error'])): ?>
        <div class="alert alert-error">
            <span class="icon">❌</span>
            <?php echo $data['error']; ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($data['success'])): ?>
        <div class="alert alert-success">
            <span class="icon">✅</span>
            <?php echo $data['success']; ?>
        </div>
    <?php endif; ?>

    <!-- User Info Header -->
    <div class="user-header">
        <div class="user-avatar-large">
            <?php echo strtoupper(substr($data['user']->first_name, 0, 1)); ?>
        </div>
        <div class="user-header-info">
            <h2><?php echo htmlspecialchars($data['user']->first_name . ' ' . $data['user']->last_name); ?></h2>
            <p class="user-email"><?php echo htmlspecialchars($data['user']->email); ?></p>
            <div class="user-meta">
                <span class="role-badge <?php echo strtolower(str_replace('_', '-', $data['user']->role)); ?>">
                    <?php 
                    $roleNames = [
                        'customer' => 'Customer',
                        'stadium_owner' => 'Stadium Owner',
                        'coach' => 'Coach',
                        'rental_owner' => 'Rental Owner'
                    ];
                    echo $roleNames[$data['user']->role] ?? ucfirst($data['user']->role);
                    ?>
                </span>
                <span class="status-badge <?php echo strtolower($data['user']->status); ?>">
                    <span class="status-dot"></span>
                    <?php echo ucfirst($data['user']->status); ?>
                </span>
                <span class="join-date">
                    Joined <?php echo date('M j, Y', strtotime($data['user']->created_at)); ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Edit User Form -->
    <div class="form-container">
        <form method="POST" action="<?php echo URLROOT; ?>/admin/edit_user/<?php echo $data['user']->id; ?>" class="user-form" id="editUserForm">
            
            <!-- Basic Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Basic Information</h3>
                    <p>Update the user's basic details</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="first_name" class="required">First Name</label>
                        <input type="text" 
                               id="first_name" 
                               name="first_name" 
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['user']->first_name); ?>"
                               placeholder="Enter first name"
                               required>
                        <div class="form-error" id="first_name_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="required">Last Name</label>
                        <input type="text" 
                               id="last_name" 
                               name="last_name" 
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['user']->last_name); ?>"
                               placeholder="Enter last name"
                               required>
                        <div class="form-error" id="last_name_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="required">Email Address</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['user']->email); ?>"
                               placeholder="Enter email address"
                               required>
                        <div class="form-error" id="email_error"></div>
                        <div class="form-help">User will use this email to login</div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="required">Phone Number</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['user']->phone); ?>"
                               placeholder="+94 71 234 5678"
                               required>
                        <div class="form-error" id="phone_error"></div>
                    </div>
                </div>
            </div>

            <!-- Account Settings Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Account Settings</h3>
                    <p>Manage account status and role settings</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="role" class="required">User Role</label>
                        <select id="role" 
                                name="role" 
                                class="form-control"
                                onchange="toggleRoleFields()"
                                required>
                            <option value="">Select User Role</option>
                            <option value="customer" <?php echo $data['user']->role == 'customer' ? 'selected' : ''; ?>>
                                Customer - Sports Player
                            </option>
                            <option value="stadium_owner" <?php echo $data['user']->role == 'stadium_owner' ? 'selected' : ''; ?>>
                                Stadium Owner - Facility Provider
                            </option>
                            <option value="coach" <?php echo $data['user']->role == 'coach' ? 'selected' : ''; ?>>
                                Coach - Sports Trainer
                            </option>
                            <option value="rental_owner" <?php echo $data['user']->role == 'rental_owner' ? 'selected' : ''; ?>>
                                Rental Owner - Equipment Provider
                            </option>
                        </select>
                        <div class="form-error" id="role_error"></div>
                        <div class="form-help">⚠️ Changing role will affect user permissions and data access</div>
                    </div>

                    <div class="form-group">
                        <label for="status">Account Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="active" <?php echo $data['user']->status == 'active' ? 'selected' : ''; ?>>
                                Active - User can login
                            </option>
                            <option value="inactive" <?php echo $data['user']->status == 'inactive' ? 'selected' : ''; ?>>
                                Inactive - User cannot login
                            </option>
                            <option value="suspended" <?php echo $data['user']->status == 'suspended' ? 'selected' : ''; ?>>
                                Suspended - Account suspended
                            </option>
                            <option value="pending" <?php echo $data['user']->status == 'pending' ? 'selected' : ''; ?>>
                                Pending - Awaiting approval
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Account Created</label>
                        <div class="readonly-field">
                            <?php echo date('F j, Y \a\t g:i A', strtotime($data['user']->created_at)); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Last Updated</label>
                        <div class="readonly-field">
                            <?php echo $data['user']->updated_at ? date('F j, Y \a\t g:i A', strtotime($data['user']->updated_at)) : 'Never'; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Change Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Change Password</h3>
                    <p>Leave blank to keep current password</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="password-field">
                            <input type="password" 
                                   id="new_password" 
                                   name="new_password" 
                                   class="form-control"
                                   placeholder="Enter new password (min 6 characters)"
                                   minlength="6">
                            <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
                                <span class="icon">👁️</span>
                            </button>
                        </div>
                        <div class="form-error" id="new_password_error"></div>
                        <div class="password-strength" id="password_strength"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_new_password">Confirm New Password</label>
                        <div class="password-field">
                            <input type="password" 
                                   id="confirm_new_password" 
                                   name="confirm_new_password" 
                                   class="form-control"
                                   placeholder="Confirm new password">
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm_new_password')">
                                <span class="icon">👁️</span>
                            </button>
                        </div>
                        <div class="form-error" id="confirm_new_password_error"></div>
                    </div>
                </div>
            </div>

            <!-- Role-Specific Information Section -->
            <div class="form-section" id="roleSpecificSection">
                <div class="section-header">
                    <h3 id="roleSpecificTitle">Role-Specific Information</h3>
                    <p id="roleSpecificDescription">Update role-specific details</p>
                </div>

                <!-- Customer Profile Fields -->
                <div id="customerFields" class="role-fields" style="display: none;">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="customer_