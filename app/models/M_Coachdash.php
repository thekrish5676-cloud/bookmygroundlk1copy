<?php
class M_Coachdash {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Update coach profile by user id
     * $data may include first_name, last_name, email, phone, district, certification, experience, coaching_type, bio, specialization
     */
    public function updateCoachByUserId($user_id, $data)
    {
        // Update users table
        $this->db->query('UPDATE users SET first_name = :first, last_name = :last, email = :email, phone = :phone WHERE id = :id');
        $this->db->bind(':first', $data['first_name'] ?? '');
        $this->db->bind(':last', $data['last_name'] ?? '');
        $this->db->bind(':email', $data['email'] ?? '');
        $this->db->bind(':phone', $data['phone'] ?? '');
        $this->db->bind(':id', $user_id);
        $this->db->execute();

        // Ensure coach_profiles exists for this user
        $this->db->query('SELECT id FROM coach_profiles WHERE user_id = :id');
        $this->db->bind(':id', $user_id);
        $exists = $this->db->single();

        // Normalize specialization to comma separated string
        $spec = '';
        if (!empty($data['specialization'])) {
            if (is_array($data['specialization'])) {
                $spec = implode(', ', array_map('trim', $data['specialization']));
            } else {
                $spec = trim($data['specialization']);
            }
        }

        if ($exists) {
            $this->db->query('UPDATE coach_profiles SET specialization = :spec, experience = :exp, certification = :cert, coaching_type = :ctype, district = :district, availability = :avail WHERE user_id = :id');
            $this->db->bind(':spec', $spec);
            $this->db->bind(':exp', $data['experience'] ?? '');
            $this->db->bind(':cert', $data['certification'] ?? '');
            $this->db->bind(':ctype', $data['coaching_type'] ?? '');
            $this->db->bind(':district', $data['district'] ?? '');
            // preserve coach_profiles.availability (registration value) - only update if 'availability' provided
            $this->db->bind(':avail', $data['availability'] ?? ($data['current_status'] ?? 'available'));
            $this->db->bind(':id', $user_id);
            $res = $this->db->execute();
            // persist extended card details and free slots
            $this->upsertCoachCardDetails($user_id, $data);
            return $res;
        } else {
            $this->db->query('INSERT INTO coach_profiles (user_id, specialization, experience, certification, coaching_type, district, availability) VALUES (:id, :spec, :exp, :cert, :ctype, :district, :avail)');
            $this->db->bind(':id', $user_id);
            $this->db->bind(':spec', $spec);
            $this->db->bind(':exp', $data['experience'] ?? '');
            $this->db->bind(':cert', $data['certification'] ?? '');
            $this->db->bind(':ctype', $data['coaching_type'] ?? '');
            $this->db->bind(':district', $data['district'] ?? '');
            // preserve coach_profiles.availability (registration value) - only update if 'availability' provided
            $this->db->bind(':avail', $data['availability'] ?? ($data['current_status'] ?? 'available'));
            $res = $this->db->execute();
            $this->upsertCoachCardDetails($user_id, $data);
            return $res;
        }
    }

    /**
     * Persist extended coach card details and free slots
     */
    public function upsertCoachCardDetails($user_id, $data)
    {
        // Upsert coach_card_details
        $this->db->query('SELECT id FROM coach_card_details WHERE user_id = :id');
        $this->db->bind(':id', $user_id);
        $exists = $this->db->single();

        $langs = '';
        if (!empty($data['languages'])) {
            if (is_array($data['languages'])) {
                $langs = implode(', ', array_map('trim', $data['languages']));
            } else {
                $langs = trim($data['languages']);
            }
        }

        if ($exists) {
            $this->db->query('UPDATE coach_card_details SET bio = :bio, training_style = :ts, languages = :langs, achievements = :ach, awards = :aw, availability_text = :avail_text, hourly_rate = :hr WHERE user_id = :id');
            $this->db->bind(':bio', $data['bio'] ?? '');
            $this->db->bind(':ts', $data['training_style'] ?? '');
            $this->db->bind(':langs', $langs);
            $this->db->bind(':ach', is_array($data['achievements']) ? implode('|', $data['achievements']) : ($data['achievements'] ?? ''));
            $this->db->bind(':aw', '');
            // availability_text prefers current_status if provided (edit-time status), otherwise primary_availability
            $this->db->bind(':avail_text', $data['current_status'] ?? ($data['primary_availability'] ?? ($data['availability'] ?? '')));
            $this->db->bind(':hr', $data['hourly_rate'] ?? 0.00);
            $this->db->bind(':id', $user_id);
            $this->db->execute();
        } else {
            $this->db->query('INSERT INTO coach_card_details (user_id, bio, training_style, languages, achievements, awards, availability_text, hourly_rate) VALUES (:id, :bio, :ts, :langs, :ach, :aw, :avail_text, :hr)');
            $this->db->bind(':id', $user_id);
            $this->db->bind(':bio', $data['bio'] ?? '');
            $this->db->bind(':ts', $data['training_style'] ?? '');
            $this->db->bind(':langs', $langs);
            $this->db->bind(':ach', is_array($data['achievements']) ? implode('|', $data['achievements']) : ($data['achievements'] ?? ''));
            $this->db->bind(':aw', '');
            $this->db->bind(':avail_text', $data['current_status'] ?? ($data['primary_availability'] ?? ($data['availability'] ?? '')));
            $this->db->bind(':hr', $data['hourly_rate'] ?? 0.00);
            $this->db->execute();
        }

        // Replace free slots: delete existing then insert provided slots
        $this->db->query('DELETE FROM coach_free_training WHERE user_id = :id');
        $this->db->bind(':id', $user_id);
        $this->db->execute();

        if (!empty($data['free_slots']) && is_array($data['free_slots'])) {
            foreach ($data['free_slots'] as $slot) {
                $day = $slot['day'] ?? '';
                $time = $slot['time'] ?? $slot['time_slot'] ?? '';
                $type = $slot['type'] ?? $slot['session_type'] ?? '';
                if ($day && $time) {
                    $this->db->query('INSERT INTO coach_free_training (user_id, day, time_slot, session_type) VALUES (:id, :day, :time, :type)');
                    $this->db->bind(':id', $user_id);
                    $this->db->bind(':day', $day);
                    $this->db->bind(':time', $time);
                    $this->db->bind(':type', $type);
                    $this->db->execute();
                }
            }
        }
    }

    /**
     * Get coach profile data by user id
     * Returns an associative array shaped for the coach dashboard view
     */
    public function getCoachByUserId($user_id)
    {
    $this->db->query('SELECT u.id AS user_id, u.first_name, u.last_name, u.email, u.phone, cp.specialization, cp.experience, cp.certification, cp.coaching_type, cp.district, cp.availability,
              ccd.bio AS card_bio, ccd.training_style AS card_training_style, ccd.languages AS card_languages, ccd.achievements AS card_achievements, ccd.availability_text AS card_availability_text, ccd.hourly_rate AS card_hourly_rate
              FROM users u
              LEFT JOIN coach_profiles cp ON u.id = cp.user_id
              LEFT JOIN coach_card_details ccd ON u.id = ccd.user_id
              WHERE u.id = :id');
        $this->db->bind(':id', $user_id);
        $row = $this->db->single();

        if (!$row) {
            return null;
        }

        $fullName = trim(($row->first_name ?? '') . ' ' . ($row->last_name ?? '')) ?: null;

        $specialization = [];
        if (!empty($row->specialization)) {
            if (strpos($row->specialization, ',') !== false) {
                $specialization = array_map('trim', explode(',', $row->specialization));
            } else {
                $specialization = [trim($row->specialization)];
            }
        }

        // fetch free slots
        $this->db->query('SELECT day, time_slot, session_type FROM coach_free_training WHERE user_id = :id');
        $this->db->bind(':id', $user_id);
        $slots = $this->db->resultset();

        $languages = [];
        if (!empty($row->card_languages)) {
            $languages = array_map('trim', explode(',', $row->card_languages));
        }

        $achievements = [];
        if (!empty($row->card_achievements)) {
            $achievements = array_filter(array_map('trim', explode('|', $row->card_achievements)));
        }

        return [
            'id' => $row->user_id,
            'name' => $fullName,
            'first_name' => $row->first_name ?? '',
            'last_name' => $row->last_name ?? '',
            'image' => '',
            'availability' => $row->availability ?? '',
            'rating' => '',
            'location' => $row->district ?? '',
            'sport' => '',
            'featured' => false,
            'mobile' => $row->phone ?? '',
            'bio' => $row->card_bio ?? '',
            'rate' => '',
            'experience' => $row->experience ?? '',
            'certification' => $row->certification ?? '',
            'specialization' => $specialization,
            'free_slots' => $slots ?: [],
            'achievements' => $achievements,
            'languages' => $languages,
            'availability_text' => $row->card_availability_text ?? '',
            'hourly_rate' => $row->card_hourly_rate ?? 0.00,
            'email' => $row->email ?? '',
            'address' => '',
            'qualifications' => [],
            'training_style' => $row->card_training_style ?? '',
            'coaching_type' => $row->coaching_type ?? ''
        ];
    }
}
