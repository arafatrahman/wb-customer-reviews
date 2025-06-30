<?php
// Fetch settings from the database
$settings = get_option('ctrw_general_settings');
?>
<form id="general-settings" class="ctrw-settings-section active" method="post">
    <h2>General Settings</h2>
    
    <div class="form-group">
        <label>Reviews per page</label>
        <input type="number" name="reviews_per_page" min="1" max="50" value="<?php echo isset($settings['reviews_per_page']) && $settings['reviews_per_page'] !== '' ? esc_attr($settings['reviews_per_page']) : 12; ?>" class="ctrw-input">
    </div>
    
    <div class="form-group">
        <label>Date Format</label>
        <div class="radio-group">
            <label class="radio-option">
                <input type="radio" name="date_format" value="mm/dd/yyyy" <?php checked($settings['date_format'], 'mm/dd/yyyy'); ?>>
                <span>MM/DD/YYYY</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="date_format" value="dd/mm/yyyy" <?php checked($settings['date_format'], 'dd/mm/yyyy'); ?>>
                <span>DD/MM/YYYY</span>
            </label>
            <label class="radio-option">
                <input type="radio" name="date_format" value="yyyy/mm/dd" <?php checked($settings['date_format'], 'yyyy/mm/dd'); ?>>
                <span>YYYY/MM/DD</span>
            </label>
        </div>
    </div>
    
    <div class="toggle-group">
       
        <label class="toggle-switch">
            <input type="checkbox" name="admin_email_notifications" <?php checked(isset($settings['admin_email_notifications']) && $settings['admin_email_notifications'] === 'on'); ?>>
            <span class="slider"></span>
            <span>Enable admin email notifications</span>
        </label>
        
        <label class="toggle-switch">
            <input type="checkbox" name="customer_email_receipts" <?php checked(isset($settings['customer_email_receipts']) && $settings['customer_email_receipts'] === 'on'); ?>>
            <span class="slider"></span>
            <span>Enable customer email receipts</span>
        </label>
        
        <label class="toggle-switch">
            <input type="checkbox" name="auto_approval" <?php checked(isset($settings['auto_approval']) && $settings['auto_approval'] === 'on'); ?>>
            <span class="slider"></span>
            <span>Automatic review approval</span>
        </label>
    </div>
    
    <div class="ctrw-settings-footer">
       
        <button type="submit" class="ctrw-save-btn">Save General Settings</button>
    </div>
</form>