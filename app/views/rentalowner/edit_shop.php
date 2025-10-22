<?php require APPROOT.'/views/rentalowner/inc/header.php'; ?>

<div class="kal-rental-dashboard-shop-container">        
    <!-- Main Content -->
    <div class="kal-rental-dashboard-shop-main">
        <header class="kal-rental-dashboard-shop-header">
            <h2>Edit Shop Details</h2>
            <a href="<?php echo URLROOT; ?>/rentalowner/shopManagement" class="kal-rental-dashboard-shop-btn kal-rental-dashboard-shop-btn-primary">Back to Shops</a>
        </header>
        
        <div class="kal-rental-dashboard-shop-edit-form">
            <form class="kal-rental-dashboard-shop-shop-form">
                <div class="kal-rental-dashboard-shop-form-group">
                    <label for="shop_name">Shop Name *</label>
                    <input type="text" id="shop_name" name="shop_name" value="<?php echo $data['shop']->shop_name; ?>" required>
                </div>
                
                <div class="kal-rental-dashboard-shop-form-group">
                    <label for="address">Address *</label>
                    <textarea id="address" name="address" required><?php echo $data['shop']->address; ?></textarea>
                </div>
                
                <div class="kal-rental-dashboard-shop-form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"><?php echo $data['shop']->description; ?></textarea>
                </div>
                
                <div class="kal-rental-dashboard-shop-form-row">
                    <div class="kal-rental-dashboard-shop-form-group">
                        <label for="number_of_fields">Number of Fields *</label>
                        <input type="number" id="number_of_fields" name="number_of_fields" value="<?php echo $data['shop']->number_of_fields; ?>" min="1" required>
                    </div>
                    
                    <div class="kal-rental-dashboard-shop-form-group">
                        <label for="hourly_rate">Hourly Rate (LKR) *</label>
                        <input type="number" id="hourly_rate" name="hourly_rate" value="<?php echo $data['shop']->hourly_rate; ?>" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="kal-rental-dashboard-shop-form-row">
                    <div class="kal-rental-dashboard-shop-form-group">
                        <label for="contact_email">Contact Email *</label>
                        <input type="email" id="contact_email" name="contact_email" value="<?php echo $data['shop']->contact_email; ?>" required>
                    </div>
                    
                    <div class="kal-rental-dashboard-shop-form-group">
                        <label for="contact_phone">Contact Phone *</label>
                        <input type="tel" id="contact_phone" name="contact_phone" value="<?php echo $data['shop']->contact_phone; ?>" required>
                    </div>
                </div>

                <div class="kal-rental-dashboard-shop-form-group">
                    <label for="operating_hours">Operating Hours</label>
                    <input type="text" id="operating_hours" name="operating_hours" value="<?php echo $data['shop']->operating_hours; ?>" placeholder="e.g., Mon-Sun: 6:00 AM - 10:00 PM">
                </div>
                
                <div class="kal-rental-dashboard-shop-form-actions">
                    <a href="<?php echo URLROOT; ?>/rentalowner/shopManagement" class="kal-rental-dashboard-shop-btn kal-rental-dashboard-shop-btn-cancel">Cancel</a>
                    <button type="submit" class="kal-rental-dashboard-shop-btn kal-rental-dashboard-shop-btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.kal-rental-dashboard-shop-shop-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Shop details would be saved in a real application.');
        // In real app, this would submit the form to the server
    });
});
</script>

<?php require APPROOT.'/views/rentalowner/inc/footer.php'; ?>