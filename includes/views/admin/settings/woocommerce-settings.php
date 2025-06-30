<?php
$woocommerce_settings = get_option('ctrw_woocommerce_settings', array());
?>
<form id="woocommerce-settings" class="ctrw-settings-section" method="post">
    <h2>WooCommerce Integration</h2>
    
    <div class="toggle-group">
        <label class="toggle-switch">
            <input type="checkbox" name="replace_woo_reviews" <?php echo isset($woocommerce_settings['replace_woo_reviews']) && $woocommerce_settings['replace_woo_reviews'] ? 'checked' : ''; ?>>
            <span class="slider"></span>
            <span>Replace WooCommerce default review system</span>
        </label>
        
        <label class="toggle-switch">
            <input type="checkbox" name="show_on_product_pages" <?php echo isset($woocommerce_settings['show_on_product_pages']) && $woocommerce_settings['show_on_product_pages'] ? 'checked' : ''; ?>>
            <span class="slider"></span>
            <span>Show reviews on product pages</span>
        </label>
        
        <label class="toggle-switch">
            <input type="checkbox" name="verified_purchasers_only" <?php echo isset($woocommerce_settings['verified_purchasers_only']) && $woocommerce_settings['verified_purchasers_only'] ? 'checked' : ''; ?>>
            <span class="slider"></span>
            <span>Allow reviews only from verified purchasers</span>
        </label>
    </div>
    
    <div class="form-group">
        <label>Minimum rating to display on product page</label>
        <select class="ctrw-select" name="min_rating_display">
            <option value="0" <?php echo (isset($woocommerce_settings['min_rating_display']) && $woocommerce_settings['min_rating_display'] == '0') ? 'selected' : ''; ?>>No minimum</option>
            <option value="2" <?php echo (isset($woocommerce_settings['min_rating_display']) && $woocommerce_settings['min_rating_display'] == '2') ? 'selected' : ''; ?>>2 stars</option>
            <option value="3" <?php echo (!isset($woocommerce_settings['min_rating_display']) || $woocommerce_settings['min_rating_display'] == '3') ? 'selected' : ''; ?>>3 stars</option>
            <option value="4" <?php echo (isset($woocommerce_settings['min_rating_display']) && $woocommerce_settings['min_rating_display'] == '4') ? 'selected' : ''; ?>>4 stars</option>
        </select>
    </div>
    
    <div class="ctrw-settings-footer">
       
        <button type="submit" class="ctrw-save-btn">Save WooCommerce Settings</button>
    </div>
</form>
