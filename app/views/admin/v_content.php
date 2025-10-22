<?php require APPROOT.'/views/admin/inc/header.php'; ?>

<div class="main-content">
    <div class="dashboard-header">
        <h1>Home Page Management</h1>
        <div class="content-actions">
            <button class="btn-save">Save Changes</button>
        </div>
    </div>

    <div class="content-grid">
        <!-- Hero Section Management -->
        <div class="content-card">
            <div class="card-header">
                <h3>Hero Section</h3>
            </div>
            <div class="content-form">
                <div class="form-group">
                    <label for="hero-title">Hero Title</label>
                    <input type="text" id="hero-title" value="<?php echo $data['hero_title']; ?>" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="hero-description">Hero Description</label>
                    <textarea id="hero-description" rows="4" class="form-control"><?php echo $data['hero_description']; ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="hero-bg">Background Image</label>
                    <div class="image-upload">
                        <input type="file" id="hero-bg" accept="image/*" class="file-input">
                        <div class="image-preview">
                            <img src="<?php echo URLROOT; ?>/images/<?php echo $data['hero_bg_image']; ?>" alt="Current Hero Image">
                        </div>
                        <button type="button" class="btn-upload">Change Image</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Content Management -->
        <div class="content-card">
            <div class="card-header">
                <h3>Footer Content</h3>
            </div>
            <div class="content-form">
                <div class="form-group">
                    <label for="company-name">Company Name</label>
                    <input type="text" id="company-name" value="BookMyGround" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="tagline">Tagline</label>
                    <input type="text" id="tagline" value="Defend, take care of the ball, rebound, and play hard." class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" rows="3" class="form-control">4200 Reid Avenue, Colombo 07</textarea>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" value="(071) 111 1111" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="support@bookmyground.lk" class="form-control">
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="content-card">
            <div class="card-header">
                <h3>Social Media Links</h3>
            </div>
            <div class="content-form">
                <div class="form-group">
                    <label for="facebook">Facebook URL</label>
                    <input type="url" id="facebook" placeholder="https://facebook.com/bookmyground" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="instagram">Instagram URL</label>
                    <input type="url" id="instagram" placeholder="https://instagram.com/bookmyground" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="twitter">Twitter URL</label>
                    <input type="url" id="twitter" placeholder="https://twitter.com/bookmyground" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="linkedin">LinkedIn URL</label>
                    <input type="url" id="linkedin" placeholder="https://linkedin.com/company/bookmyground" class="form-control">
                </div>
            </div>
        </div>

        <!-- Navigation Menu Management -->
        <div class="content-card">
            <div class="card-header">
                <h3>Navigation Menu</h3>
            </div>
            <div class="menu-items">
                <div class="menu-item">
                    <input type="text" value="Home" class="form-control">
                    <input type="text" value="/" class="form-control">
                    <button class="btn-remove">Remove</button>
                </div>
                <div class="menu-item">
                    <input type="text" value="Stadiums" class="form-control">
                    <input type="text" value="/stadiums" class="form-control">
                    <button class="btn-remove">Remove</button>
                </div>
                <div class="menu-item">
                    <input type="text" value="Coaches" class="form-control">
                    <input type="text" value="/coaches" class="form-control">
                    <button class="btn-remove">Remove</button>
                </div>
                <button class="btn-add-menu">+ Add Menu Item</button>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT.'/views/admin/inc/footer.php'; ?>