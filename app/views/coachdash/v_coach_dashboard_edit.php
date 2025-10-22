<?php require APPROOT . '/views/coachdash/inc/header.php'; ?>
<div class="kal-coach-profile-manager">
    <div class="kal-coach-profile-header">
        <h1>Edit Profile</h1>
        <button form="editProfileForm" class="kal-profile-save-btn">Save Changes</button>
    </div>

    <form id="editProfileForm" action="<?php echo URLROOT; ?>/coachdash/updateProfile" method="POST">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($data['coach']['id']); ?>">
        <div class="kal-profile-layout">
            <div class="kal-profile-sidebar">
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
            </div>

            <div class="kal-main-content">
                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Basic Information</h3>
                    </div>
                    <div class="kal-form-grid">
                        <div class="kal-form-group">
                                <label style="display:block; font-size:13px; color:#ccc; margin:12px 0 6px;">Current Status</label>
                                <select class="kal-form-control" id="current_status" name="current_status">
                                    <option value="available" <?php echo ($data['coach']['availability_text'] ?? '') === 'available' ? 'selected' : ''; ?>>Available</option>
                                    <option value="unavailable" <?php echo ($data['coach']['availability_text'] ?? '') === 'unavailable' ? 'selected' : ''; ?>>Unavailable</option>
                                    <option value="flexibility" <?php echo ($data['coach']['availability_text'] ?? '') === 'flexibility' ? 'selected' : ''; ?>>Flexibility</option>
                                </select>
                        <div class="kal-form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="kal-form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($data['coach']['first_name'] ?? (explode(' ', $data['coach']['name'] ?? '')[0] ?? '')); ?>">
                        </div>
                        <div class="kal-form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="kal-form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($data['coach']['last_name'] ?? (explode(' ', $data['coach']['name'] ?? '')[1] ?? '')); ?>">
                        </div>
                        <div class="kal-form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="tel" class="kal-form-control" id="mobile" name="mobile" value="<?php echo htmlspecialchars($data['coach']['mobile'] ?? ''); ?>">
                        </div>
                        <div class="kal-form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="kal-form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['coach']['email'] ?? ''); ?>">
                        </div>
                        <!-- Primary sport selection left in form (handled elsewhere) -->
                        <div class="kal-form-group">
                            <label for="district">District</label>
                            <select class="kal-form-control" id="district" name="district">
                                <?php
                                $districts = ['Colombo','Gampaha','Kandy','Galle','Matara','Jaffna','Kegalle','Kurunegala'];
                                foreach($districts as $dist){
                                    $sel = ($data['coach']['location'] ?? $data['coach']['district'] ?? '') === $dist ? 'selected' : '';
                                    echo "<option value=\"".htmlspecialchars($dist)."\" $sel>".htmlspecialchars($dist)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                            <div class="kal-form-group">
                                <label for="availability">Primary Availability</label>
                                <select class="kal-form-control" id="availability" name="availability">
                                    <option value="full_time" <?php echo ($data['coach']['availability'] ?? '') === 'full_time' ? 'selected' : ''; ?>>Full Time</option>
                                    <option value="part_time" <?php echo ($data['coach']['availability'] ?? '') === 'part_time' ? 'selected' : ''; ?>>Part Time</option>
                                    <option value="weekdays" <?php echo ($data['coach']['availability'] ?? '') === 'weekdays' ? 'selected' : ''; ?>>Weekdays</option>
                                    <option value="weekends" <?php echo ($data['coach']['availability'] ?? '') === 'weekends' ? 'selected' : ''; ?>>Weekends</option>
                                    <option value="flexible" <?php echo ($data['coach']['availability'] ?? '') === 'flexible' ? 'selected' : ''; ?>>Flexible</option>
                                </select>
                            </div>
                            <div class="kal-form-group">
                                <label for="hourly_rate">Hourly Rate (LKR)</label>
                                <input type="number" class="kal-form-control" id="hourly_rate" name="hourly_rate" value="<?php echo htmlspecialchars($data['coach']['hourly_rate'] ?? ''); ?>" min="0">
                            </div>
                        <div class="kal-form-group">
                            <label for="specialization">Sports Specialization</label>
                            <select class="kal-form-control" id="specialization" name="specialization">
                                <option value="">-- Select Primary Sport --</option>
                                <?php
                                // $data['sports'] expected to be an array like ['Football','Cricket',...]
                                $currentPrimary = '';
                                if (!empty($data['coach']['specialization'])) {
                                    if (is_array($data['coach']['specialization'])) {
                                        $currentPrimary = $data['coach']['specialization'][0] ?? '';
                                    } else {
                                        $currentPrimary = (string)$data['coach']['specialization'];
                                    }
                                }
                                foreach ($data['sports'] as $s) {
                                    $sel = ($currentPrimary === $s) ? 'selected' : '';
                                    echo "<option value=\"".htmlspecialchars($s)."\" $sel>".htmlspecialchars($s)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="kal-form-group">
                            <label for="certification">Certification</label>
                            <select class="kal-form-control" id="certification" name="certification">
                                <?php
                                $certs = ['none','basic','intermediate','advanced','professional','international'];
                                foreach($certs as $c){
                                    $sel = ($data['coach']['certification'] ?? '') === $c ? 'selected' : '';
                                    echo "<option value=\"".htmlspecialchars($c)."\" $sel>".htmlspecialchars(ucfirst($c))."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="kal-form-group">
                            <label for="experience">Experience</label>
                            <select class="kal-form-control" id="experience" name="experience">
                                <?php
                                $exps = ['1_3','4_6','7_10','11_15','15_plus'];
                                foreach($exps as $e){
                                    $label = $e === '15_plus' ? '15+ years' : str_replace('_','-',$e) . ' years';
                                    $sel = ($data['coach']['experience'] ?? '') === $e ? 'selected' : '';
                                    echo "<option value=\"".htmlspecialchars($e)."\" $sel>".htmlspecialchars($label)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="kal-form-group">
                            <label for="coaching_type">Coaching Type</label>
                            <select class="kal-form-control" id="coaching_type" name="coaching_type">
                                <?php
                                $types = ['individual','group','team','both','all'];
                                foreach($types as $t){
                                    $sel = ($data['coach']['coaching_type'] ?? '') === $t ? 'selected' : '';
                                    echo "<option value=\"".htmlspecialchars($t)."\" $sel>".htmlspecialchars(ucfirst($t))."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>About Me</h3>
                    </div>
                    <div class="kal-form-group full-width">
                        <label for="bio">Bio / Description</label>
                        <textarea class="kal-form-control" id="bio" name="bio" rows="5"><?php echo htmlspecialchars($data['coach']['bio'] ?? ''); ?></textarea>
                    </div>
                    <div class="kal-form-group full-width">
                        <label for="training_style">Training Style & Philosophy</label>
                        <textarea class="kal-form-control" id="training_style" name="training_style" rows="4"><?php echo htmlspecialchars($data['coach']['training_style'] ?? $data['coach']['training_style'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Languages Spoken</h3>
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

                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Free Training Sessions</h3>
                    </div>
                    <div class="kal-slot-grid" id="freeSlotsContainer">
                        <?php foreach($data['coach']['free_slots'] as $index => $slot): ?>
                            <div class="kal-slot-card">
                                <button type="button" class="kal-slot-remove" onclick="removeSlot(this)">×</button>
                                <div class="kal-slot-day"><?php echo htmlspecialchars($slot['day']); ?></div>
                                <div class="kal-slot-time"><?php echo htmlspecialchars($slot['time_slot'] ?? $slot['time']); ?></div>
                                <div class="kal-slot-type"><?php echo htmlspecialchars($slot['session_type'] ?? $slot['type']); ?></div>
                                <input type="hidden" name="free_slots[<?php echo $index; ?>][day]" value="<?php echo htmlspecialchars($slot['day']); ?>">
                                <input type="hidden" name="free_slots[<?php echo $index; ?>][time]" value="<?php echo htmlspecialchars($slot['time_slot'] ?? $slot['time']); ?>">
                                <input type="hidden" name="free_slots[<?php echo $index; ?>][type]" value="<?php echo htmlspecialchars($slot['session_type'] ?? $slot['type']); ?>">
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

                <div class="kal-profile-section">
                    <div class="kal-section-header">
                        <h3>Achievements & Awards</h3>
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

<?php require APPROOT . '/views/coachdash/inc/footer.php'; ?>
<script>
// Languages tag helper for edit page
function removeTag(button) {
    // remove the tag element
    const el = button.closest('.kal-tag');
    if (el) el.remove();
}

function addLanguage() {
    const input = document.getElementById('newLanguage');
    const value = (input.value || '').trim();
    if (!value) return;

    // prevent duplicates
    const existing = Array.from(document.querySelectorAll('#languagesContainer .kal-tag input[name="languages[]"]'))
        .map(i => i.value.toLowerCase());
    if (existing.includes(value.toLowerCase())) {
        input.value = '';
        return;
    }

    const container = document.getElementById('languagesContainer');
    const div = document.createElement('div');
    div.className = 'kal-tag';
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'kal-tag-remove';
    btn.textContent = '×';
    btn.onclick = function() { removeTag(this); };

    const text = document.createTextNode(value);
    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'languages[]';
    hidden.value = value;

    div.appendChild(text);
    div.appendChild(btn);
    div.appendChild(hidden);
    container.appendChild(div);

    input.value = '';
    input.focus();
}
</script>