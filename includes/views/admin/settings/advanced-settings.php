<?php
$advanced_settings = get_option('ctrw_advanced_settings');
?>

<form id="advanced-settings" class="ctrw-settings-section" method="post">
    <h2>Advanced Settings</h2>
    
    <div class="form-group">
        <label>Admin notification emails</label>
        <input type="text" name="admin_emails" value="<?php echo isset($advanced_settings['admin_emails']) ? esc_attr($advanced_settings['admin_emails']) : ''; ?>" class="ctrw-input">
        <p class="ctrw-description">Comma separate multiple emails</p>
    </div>
    
    <div class="form-group">
        <label>Custom Messages</label>
        <textarea name="custom_message" class="ctrw-input" style="height: 120px; font-family: monospace;" placeholder="Enter your custom CSS here"><?php echo isset($advanced_settings['custom_message']) ? esc_textarea($advanced_settings['custom_message']) : ''; ?></textarea>
    </div>
    
    <div class="ctrw-settings-footer">
       
        <button type="submit" class="ctrw-save-btn">Save Advanced Settings</button>
    </div>
</form>