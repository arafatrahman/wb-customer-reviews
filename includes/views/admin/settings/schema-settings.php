<?php
$schema_settings = get_option('ctrw_schema_settings');
?>
<?php

// Use existing values or defaults
$business_name = isset($schema_settings['business_name']) ? esc_attr($schema_settings['business_name']) : '';
$default_description = isset($schema_settings['default_description']) ? $schema_settings['default_description'] : 'page_excerpt';
$default_url = isset($schema_settings['default_url']) ? $schema_settings['default_url'] : 'page_url';
$default_image = isset($schema_settings['default_image']) ? $schema_settings['default_image'] : 'featured_image';
$business_address = isset($schema_settings['business_address']) ? esc_textarea($schema_settings['business_address']) : '';
$business_phone = isset($schema_settings['business_phone']) ? esc_attr($schema_settings['business_phone']) : '';
$price_range = isset($schema_settings['price_range']) ? $schema_settings['price_range'] : '';
?>

<?php if (!empty($error)): ?>
    <div class="notice notice-error"><p><?php echo esc_html($error); ?></p></div>
<?php endif; ?>

<form id="schema-settings" class="ctrw-settings-section" method="post">
    <h2>Schema Markup</h2>
    
    <div class="form-group">
        <label>Local Business Name</label>
        <input type="text" name="business_name" class="ctrw-input" placeholder="Your Business Name" value="<?php echo $business_name; ?>">
    </div>
    
    <div class="form-group">
        <label>Default Description</label>
        <select class="ctrw-select" name="default_description">
            <option value="page_excerpt" <?php selected($default_description, 'page_excerpt'); ?>>Use the assigned or current page excerpt</option>
            <option value="custom" <?php selected($default_description, 'custom'); ?>>Use custom description</option>
        </select>
    </div>
    
    <div class="form-group">
        <label>Default URL</label>
        <select class="ctrw-select" name="default_url">
            <option value="page_url" <?php selected($default_url, 'page_url'); ?>>Use the assigned or current page URL</option>
            <option value="custom" <?php selected($default_url, 'custom'); ?>>Use custom URL</option>
        </select>
    </div>
    
    <div class="form-group">
        <label>Default Image</label>
        <select class="ctrw-select" name="default_image">
            <option value="featured_image" <?php selected($default_image, 'featured_image'); ?>>Use featured image of the assigned or current page</option>
            <option value="custom" <?php selected($default_image, 'custom'); ?>>Use custom image</option>
        </select>
    </div>
    
    <div class="form-group">
        <label>Address</label>
        <textarea name="business_address" class="ctrw-input" style="height: 80px;"><?php echo $business_address; ?></textarea>
    </div>
    
    <div class="form-group">
        <label>Telephone Number</label>
        <input type="text" name="business_phone" class="ctrw-input" value="<?php echo $business_phone; ?>">
    </div>
    
    <div class="form-group">
        <label>Price Range</label>
        <select class="ctrw-select" name="price_range">
            <option value="$" <?php selected($price_range, '$'); ?>>$</option>
            <option value="$$" <?php selected($price_range, '$$'); ?>>$$</option>
            <option value="$$$" <?php selected($price_range, '$$$'); ?>>$$$</option>
            <option value="$$$$" <?php selected($price_range, '$$$$'); ?>>$$$$</option>
        </select>
    </div>
    
    <div class="ctrw-settings-footer">
       
        <button type="submit" class="ctrw-save-btn">Save Schema Settings</button>
    </div>
</form>