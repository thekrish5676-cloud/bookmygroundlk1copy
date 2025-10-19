<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <div class="header-left">
            <h1>Add New User</h1>
            <p>Create a new user account with role-specific information</p>
        </div>
        <div class="header-actions">
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

    <!-- Add User Form -->
    <div class="form-container">
        <form method="POST" action="<?php echo URLROOT; ?>/admin/add_user" class="user-form" id="addUserForm">
            
            <!-- Basic Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Basic Information</h3>
                    <p>Enter the user's basic details</p>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="first_name" class="required">First Name</label>
                        <input type="text" 
                               id="first_name" 
                               name="first_name" 
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['form_data']['first_name'] ?? ''); ?>"
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
                               value="<?php echo htmlspecialchars($data['form_data']['last_name'] ?? ''); ?>"
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
                               value="<?php echo htmlspecialchars($data['form_data']['email'] ?? ''); ?>"
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
                               value="<?php echo htmlspecialchars($data['form_data']['phone'] ?? ''); ?>"
                               placeholder="+94 71 234 5678"
                               required>
                        <div class="form-error" id="phone_error"></div>
                    </div>
                </div>
            </div>

            <!-- Account Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Account Information</h3>
                    <p>Set up login credentials and account settings</p>
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
                            <option value="customer" <?php echo ($data['form_data']['role'] ?? '') == 'customer' ? 'selected' : ''; ?>>
                                Customer - Sports Player
                            </option>
                            <option value="stadium_owner" <?php echo ($data['form_data']['role'] ?? '') == 'stadium_owner' ? 'selected' : ''; ?>>
                                Stadium Owner - Facility Provider
                            </option>
                            <option value="coach" <?php echo ($data['form_data']['role'] ?? '') == 'coach' ? 'selected' : ''; ?>>
                                Coach - Sports Trainer
                            </option>
                            <option value="rental_owner" <?php echo ($data['form_data']['role'] ?? '') == 'rental_owner' ? 'selected' : ''; ?>>
                                Rental Owner - Equipment Provider
                            </option>
                        </select>
                        <div class="form-error" id="role_error"></div>
                    </div>

                    <div class="form-group">
                        <label for="status">Account Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="active" <?php echo ($data['form_data']['status'] ?? 'active') == 'active' ? 'selected' : ''; ?>>
                                Active - User can login
                            </option>
                            <option value="inactive" <?php echo ($data['form_data']['status'] ?? '') == 'inactive' ? 'selected' : ''; ?>>
                                Inactive - User cannot login
                            </option>
                            <option value="pending" <?php echo ($data['form_data']['status'] ?? '') == 'pending' ? 'selected' : ''; ?>>
                                Pending - Awaiting approval
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password" class="required">Password</label>
                        <div class="password-field">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control"
                                   placeholder="Enter password (min 6 characters)"
                                   minlength="6"
                                   required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <span class="icon">👁️</span>
                            </button>
                        </div>
                        <div class="form-error" id="password_error"></div>
                        <div class="password-strength" id="password_strength"></div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password" class="required">Confirm Password</label>
                        <div class="password-field">
                            <input type="password" 
                                   id="confirm_password" 
                                   name="confirm_password" 
                                   class="form-control"
                                   placeholder="Confirm password"
                                   required>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                                <span class="icon">👁️</span>
                            </button>
                        </div>
                        <div class="form-error" id="confirm_password_error"></div>
                    </div>
                </div>
            </div>

            <!-- Role-Specific Information Section -->
            <div class="form-section" id="roleSpecificSection" style="display: none;">
                <div class="section-header">
                    <h3 id="roleSpecificTitle">Role-Specific Information</h3>
                    <p id="roleSpecificDescription">Additional information based on selected role</p>
                </div>

                <!-- Customer Profile Fields -->
                <div id="customerFields" class="role-fields" style="display: none;">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="customer_district">District</label>
                            <select id="customer_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Galle">Galle</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Negombo">Negombo</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Batticaloa">Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer_sports">Preferred Sports</label>
                            <select id="customer_sports" name="profile_data[sports]" class="form-control">
                                <option value="">Select Sport</option>
                                <option value="football">Football</option>
                                <option value="cricket">Cricket</option>
                                <option value="basketball">Basketball</option>
                                <option value="tennis">Tennis</option>
                                <option value="badminton">Badminton</option>
                                <option value="swimming">Swimming</option>
                                <option value="volleyball">Volleyball</option>
                                <option value="rugby">Rugby</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer_age_group">Age Group</label>
                            <select id="customer_age_group" name="profile_data[age_group]" class="form-control">
                                <option value="">Select Age Group</option>
                                <option value="under_18">Under 18</option>
                                <option value="18_25">18-25 years</option>
                                <option value="26_35">26-35 years</option>
                                <option value="above_35">Above 35</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer_skill_level">Skill Level</label>
                            <select id="customer_skill_level" name="profile_data[skill_level]" class="form-control">
                                <option value="">Select Skill Level</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="professional">Professional</option>
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
                                   placeholder="Enter owner full name">
                        </div>

                        <div class="form-group">
                            <label for="business_name">Business Name</label>
                            <input type="text" 
                                   id="business_name" 
                                   name="profile_data[business_name]" 
                                   class="form-control"
                                   placeholder="Enter business/stadium name">
                        </div>

                        <div class="form-group">
                            <label for="stadium_district">District</label>
                            <select id="stadium_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Galle">Galle</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Negombo">Negombo</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Batticaloa">Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="venue_type">Venue Type</label>
                            <select id="venue_type" name="profile_data[venue_type]" class="form-control">
                                <option value="">Select Venue Type</option>
                                <option value="stadium">Stadium</option>
                                <option value="indoor_court">Indoor Court</option>
                                <option value="outdoor_court">Outdoor Court</option>
                                <option value="sports_complex">Sports Complex</option>
                                <option value="practice_nets">Practice Nets</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="business_registration">Business Registration</label>
                            <input type="text" 
                                   id="business_registration" 
                                   name="profile_data[business_registration]" 
                                   class="form-control"
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
                                <option value="football">Football</option>
                                <option value="cricket">Cricket</option>
                                <option value="basketball">Basketball</option>
                                <option value="tennis">Tennis</option>
                                <option value="badminton">Badminton</option>
                                <option value="swimming">Swimming</option>
                                <option value="volleyball">Volleyball</option>
                                <option value="rugby">Rugby</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <select id="experience" name="profile_data[experience]" class="form-control">
                                <option value="">Select Experience</option>
                                <option value="1_3">1-3 years</option>
                                <option value="4_6">4-6 years</option>
                                <option value="7_10">7-10 years</option>
                                <option value="10_plus">10+ years</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="certification">Certification</label>
                            <select id="certification" name="profile_data[certification]" class="form-control">
                                <option value="">Select Certification</option>
                                <option value="basic">Basic</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="professional">Professional</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coaching_type">Coaching Type</label>
                            <select id="coaching_type" name="profile_data[coaching_type]" class="form-control">
                                <option value="">Select Coaching Type</option>
                                <option value="individual">Individual</option>
                                <option value="group">Group</option>
                                <option value="both">Both</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="coach_district">District</label>
                            <select id="coach_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Galle">Galle</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Negombo">Negombo</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Batticaloa">Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="availability">Availability</label>
                            <select id="availability" name="profile_data[availability]" class="form-control">
                                <option value="">Select Availability</option>
                                <option value="full_time">Full Time</option>
                                <option value="part_time">Part Time</option>
                                <option value="weekends">Weekends</option>
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
                                   placeholder="Enter owner full name">
                        </div>

                        <div class="form-group">
                            <label for="rental_business_name">Business Name</label>
                            <input type="text" 
                                   id="rental_business_name" 
                                   name="profile_data[business_name]" 
                                   class="form-control"
                                   placeholder="Enter business/shop name">
                        </div>

                        <div class="form-group">
                            <label for="rental_district">District</label>
                            <select id="rental_district" name="profile_data[district]" class="form-control">
                                <option value="">Select District</option>
                                <option value="Colombo">Colombo</option>
                                <option value="Kandy">Kandy</option>
                                <option value="Galle">Galle</option>
                                <option value="Jaffna">Jaffna</option>
                                <option value="Negombo">Negombo</option>
                                <option value="Anuradhapura">Anuradhapura</option>
                                <option value="Polonnaruwa">Polonnaruwa</option>
                                <option value="Kurunegala">Kurunegala</option>
                                <option value="Ratnapura">Ratnapura</option>
                                <option value="Batticaloa">Batticaloa</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="business_type">Business Type</label>
                            <select id="business_type" name="profile_data[business_type]" class="form-control">
                                <option value="">Select Business Type</option>
                                <option value="retail_chain">Retail Chain</option>
                                <option value="independent">Independent Store</option>
                                <option value="sports_shop">Sports Shop</option>
                                <option value="equipment_specialist">Equipment Specialist</option>
                                <option value="franchise">Franchise</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="equipment_categories">Equipment Categories</label>
                            <select id="equipment_categories" name="profile_data[equipment_categories]" class="form-control">
                                <option value="">Select Equipment Category</option>
                                <option value="football_equipment">Football Equipment</option>
                                <option value="cricket_equipment">Cricket Equipment</option>
                                <option value="basketball_equipment">Basketball Equipment</option>
                                <option value="tennis_equipment">Tennis Equipment</option>
                                <option value="badminton_equipment">Badminton Equipment</option>
                                <option value="multi_sport">Multi-Sport Equipment</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="delivery_service">Delivery Service</label>
                            <select id="delivery_service" name="profile_data[delivery_service]" class="form-control">
                                <option value="">Select Delivery Option</option>
                                <option value="yes">Yes, We Deliver</option>
                                <option value="no">Pickup Only</option>
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
                <button type="button" class="btn-reset" onclick="resetForm()">
                    <span class="icon">🔄</span> Reset Form
                </button>
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span class="icon">✅</span> Create User
                    <div class="btn-loading" style="display: none;">
                        <span class="loading-spinner"></span> Creating...
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Form validation and dynamic behavior
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form
    const form = document.getElementById('addUserForm');
    const roleSelect = document.getElementById('role');
    
    // Set up form validation
    setupFormValidation();
    
    // Set up password strength checker
    setupPasswordStrength();
    
    // Set up phone number formatting
    setupPhoneFormatting();
    
    // If role is already selected, show fields
    if (roleSelect.value) {
        toggleRoleFields();
    }
});

// Toggle role-specific fields
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

// Form validation setup
function setupFormValidation() {
    const form = document.getElementById('addUserForm');
    
    // Real-time validation
    form.addEventListener('input', function(e) {
        validateField(e.target);
    });
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitForm();
        }
    });
}

// Validate individual field
function validateField(field) {
    const fieldName = field.name;
    const value = field.value.trim();
    const errorElement = document.getElementById(fieldName + '_error');
    
    if (!errorElement) return;
    
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
            
        case 'password':
            if (!value) {
                isValid = false;
                errorMessage = 'Password is required';
            } else if (value.length < 6) {
                isValid = false;
                errorMessage = 'Password must be at least 6 characters';
            }
            break;
            
        case 'confirm_password':
            const password = document.getElementById('password').value;
            if (!value) {
                isValid = false;
                errorMessage = 'Please confirm your password';
            } else if (value !== password) {
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

// Validate entire form
function validateForm() {
    const requiredFields = ['first_name', 'last_name', 'email', 'phone', 'password', 'confirm_password', 'role'];
    let isValid = true;
    
    requiredFields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        if (field && !validateField(field)) {
            isValid = false;
        }
    });
    
    return isValid;
}

// Email validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Phone validation
function isValidPhone(phone) {
    const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
    return phoneRegex.test(phone);
}

// Password strength checker
function setupPasswordStrength() {
    const passwordField = document.getElementById('password');
    const strengthIndicator = document.getElementById('password_strength');
    
    passwordField.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        
        strengthIndicator.className = 'password-strength ' + strength.class;
        strengthIndicator.textContent = strength.text;
    });
}

// Check password strength
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

// Phone number formatting
function setupPhoneFormatting() {
    const phoneField = document.getElementById('phone');
    
    phoneField.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        
        if (value.startsWith('94')) {
            value = '+' + value;
        } else if (value.startsWith('0')) {
            value = '+94 ' + value.substring(1);
        }
        
        this.value = value;
    });
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
    document.getElementById('addUserForm').submit();
}

// Reset form
function resetForm() {
    if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
        document.getElementById('addUserForm').reset();
        document.getElementById('roleSpecificSection').style.display = 'none';
        
        // Clear all error messages
        document.querySelectorAll('.form-error').forEach(error => {
            error.textContent = '';
        });
        
        // Reset field classes
        document.querySelectorAll('.form-control').forEach(field => {
            field.classList.remove('error', 'valid');
        });
        
        // Clear password strength
        document.getElementById('password_strength').textContent = '';
        document.getElementById('password_strength').className = 'password-strength';
    }
}

// Auto-save form data to localStorage (optional)
function autoSaveForm() {
    const formData = new FormData(document.getElementById('addUserForm'));
    const data = {};
    
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    localStorage.setItem('add_user_form_data', JSON.stringify(data));
}

// Load saved form data (optional)
function loadSavedFormData() {
    const savedData = localStorage.getItem('add_user_form_data');
    
    if (savedData) {
        try {
            const data = JSON.parse(savedData);
            
            Object.keys(data).forEach(key => {
                const field = document.querySelector(`[name="${key}"]`);
                if (field) {
                    field.value = data[key];
                }
            });
            
            // Trigger role fields if role was saved
            if (data.role) {
                toggleRoleFields();
            }
        } catch (e) {
            console.error('Error loading saved form data:', e);
        }
    }
}

// Clear saved form data when form is successfully submitted
window.addEventListener('beforeunload', function() {
    // Only auto-save if form has been modified
    const form = document.getElementById('addUserForm');
    const formData = new FormData(form);
    let hasData = false;
    
    for (let [key, value] of formData.entries()) {
        if (value.trim()) {
            hasData = true;
            break;
        }
    }
    
    if (hasData) {
        autoSaveForm();
    }
});
</script>

<style>
/* Add User Form Styles */
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

.role-fields {
    margin-top: 16px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #03B200;
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

.alert .icon {
    font-size: 18px;
}

.header-left h1 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 28px;
    font-weight: 700;
}

.header-left p {
    margin: 0;
    color: #666;
    font-size: 16px;
}

.btn-back {
    padding: 10px 16px;
    background: #f8f9fa;
    color: #6c757d;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: 1px solid #dee2e6;
}

.btn-back:hover {
    background: #e2e6ea;
    transform: translateY(-1px);
    color: #495057;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .btn-back {
        width: 100%;
        justify-content: center;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .form-section {
        padding: 20px;
    }
    
    .form-actions {
        padding: 20px;
        flex-direction: column;
    }
    
    .btn-cancel, .btn-reset, .btn-submit {
        width: 100%;
        justify-content: center;
    }
    
    .section-header h3 {
        font-size: 18px;
    }
    
    .header-left h1 {
        font-size: 24px;
    }
    
    .header-left p {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .form-container {
        margin: 10px;
        border-radius: 8px;
    }
    
    .form-section {
        padding: 16px;
    }
    
    .form-actions {
        padding: 16px;
    }
    
    .section-header {
        margin-bottom: 20px;
        padding-bottom: 12px;
    }
    
    .form-grid {
        gap: 12px;
    }
    
    .form-control {
        padding: 10px 12px;
    }
    
    .btn-cancel, .btn-reset, .btn-submit {
        padding: 10px 16px;
        font-size: 13px;
    }
}
</style>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>