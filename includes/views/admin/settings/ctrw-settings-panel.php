<?php

?>

<div class="wrap ctrw-setting-panel">
    <h1>Customer Review Settings</h1>
    
    <!-- Success message -->
    <div id="ctrw-success-msg" class="notice notice-success is-dismissible" style="display: none;">
        <p>Settings saved successfully.</p>
    </div>
    
    <!-- Navigation tabs -->
    <h2 class="nav-tab-wrapper">
        <a href="#general" class="nav-tab nav-tab-active">General</a>
        <a href="#form-fields" class="nav-tab">Form Fields</a>
        <a href="#display" class="nav-tab">Display</a>
        <a href="#woocommerce" class="nav-tab">WooCommerce</a>
        <a href="#schema" class="nav-tab">Schema</a>
        <a href="#shortcodes" class="nav-tab">Shortcodes</a>
        <a href="#advanced" class="nav-tab">Advanced</a>
    </h2>
    
    <!-- GENERAL SETTINGS -->
    <div id="general" class="tab-content ctrw-setting" style="display: block;">
        <form id="general-settings" method="post" class="form-table">
            <h3>General Settings</h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="reviews_per_page">Reviews per page</label></th>
                        <td>
                            <input type="number" id="reviews_per_page" name="reviews_per_page" min="1" max="50" value="12" class="regular-text">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Date Format</th>
                        <td>
                            <fieldset>
                                <label><input type="radio" name="date_format" value="mm/dd/yyyy" checked> MM/DD/YYYY</label><br>
                                <label><input type="radio" name="date_format" value="dd/mm/yyyy"> DD/MM/YYYY</label><br>
                                <label><input type="radio" name="date_format" value="yyyy/mm/dd"> YYYY/MM/DD</label>
                            </fieldset>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Email Settings</th>
                        <td>
                            <label><input type="checkbox" name="admin_email_notifications" checked> Enable admin email notifications</label><br>
                            <label><input type="checkbox" name="customer_email_receipts"> Enable customer email receipts</label>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Review Approval</th>
                        <td>
                            <label><input type="checkbox" name="auto_approval" checked> Automatic review approval</label>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save General Settings</button>
            </p>
        </form>
    </div>
    
    <!-- FORM FIELDS -->
    <div id="form-fields" class="tab-content" style="display: none;">
        <?php
        $form_fields_settings = get_option('ctrw_form_fields_settings');
        ?>
        <form id="form-fields-settings" method="post">
            <h3>Form Fields Settings</h3>
            
            <div class="form-fields-grid" style="display: grid; grid-template-columns: .2fr .2fr; gap: 30px;">
                <!-- First Column: Custom Fields -->
                <div>
                    
                    <?php
                    // Prepare saved data
                    $field_names = isset($form_fields_settings['field_names']) ? $form_fields_settings['field_names'] : array_fill(0, 5, '');
                    $field_required = isset($form_fields_settings['field_required']) ? $form_fields_settings['field_required'] : array();
                    $field_visible = isset($form_fields_settings['field_visible']) ? $form_fields_settings['field_visible'] : array();

                    for ($i = 0; $i < 5; $i++) {
                        $name = isset($field_names[$i]) ? esc_attr($field_names[$i]) : '';
                        $required = isset($field_required[$i]) && $field_required[$i] === 'on';
                        $visible = isset($field_visible[$i]) && $field_visible[$i] === 'on';
                        ?>
                        <div class="form-field-row" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 15px;">
                            <input type="text" name="field_names[]" value="<?php echo $name; ?>" class="regular-text" placeholder="Field label" style="flex: 1;">
                            <div style="display: flex; gap: 15px; white-space: nowrap;">
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_required[<?php echo $i; ?>]" <?php checked($required); ?>>
                                    Required
                                </label>
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_visible[<?php echo $i; ?>]" <?php checked($visible, true); ?>>
                                    Visible
                                </label>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Second Column: Review Fields -->
                <div>
                   
                    <?php
                    $special_fields = [
                        ['label' => 'Review Title', 'index' => 5],
                        ['label' => 'Comment', 'index' => 6],
                        ['label' => 'Rating', 'index' => 7],
                    ];
                    
                    foreach ($special_fields as $field) {
                        $required = isset($form_fields_settings['field_required'][$field['index']]) && $form_fields_settings['field_required'][$field['index']] === 'on';
                        $visible = isset($form_fields_settings['field_visible'][$field['index']]) && $form_fields_settings['field_visible'][$field['index']] === 'on';
                        ?>
                        <div class="form-field-row" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 15px;">
                            <input type="text" name="field_names[]" value="<?php echo esc_attr($field['label']); ?>" class="regular-text" readonly style="flex: 1;">
                            <div style="display: flex; gap: 15px; white-space: nowrap;">
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_required[<?php echo $field['index']; ?>]" <?php checked($required, true); ?>>
                                    Required
                                </label>
                                <label style="display: flex; align-items: center; gap: 5px;">
                                    <input type="checkbox" name="field_visible[<?php echo $field['index']; ?>]" <?php checked($visible, true); ?>>
                                    Visible
                                </label>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save Form Fields</button>
            </p>
        </form>
    </div>
    
    <!-- DISPLAY SETTINGS -->
    <div id="display" class="tab-content" style="display: none;">
        <form id="display-settings" method="post">
               <h3>Display Settings</h3>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">Display Options</th>
                        <td>
                            <label><input type="checkbox" name="show_city"> Show city in review list</label><br>
                            <label><input type="checkbox" name="show_state"> Show state in review list</label><br>
                            <label><input type="checkbox" name="enable_titles" checked> Enable review titles</label><br>
                            <label><input type="checkbox" name="show_time_with_date"> Show time with review dates</label>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="name_font_weight">Name font weight</label></th>
                        <td>
                            <select id="name_font_weight" name="name_font_weight" class="regular-text">
                                <option value="normal">Normal</option>
                                <option value="bold" selected>Bold</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="comment_font_size">Comment font size (px)</label></th>
                        <td>
                            <input type="number" id="comment_font_size" name="comment_font_size" min="10" max="24" value="14" class="small-text">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="comment_font_style">Comment font style</label></th>
                        <td>
                            <select id="comment_font_style" name="comment_font_style" class="regular-text">
                                <option value="normal" selected>Normal</option>
                                <option value="italic">Italic</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="comment_line_height">Comment line height (px)</label></th>
                        <td>
                            <input type="number" id="comment_line_height" name="comment_line_height" min="10" max="30" value="20" class="small-text">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="star_color">Star Color</label></th>
                        <td>
                            <input type="text" name="star_color" id="star_color" value="#ffb100" data-default-color="#ffb100" class="color-picker">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="comment_box_color">Comment Box Fill Color</label></th>
                        <td>
                            <input type="text" name="comment_box_color" id="comment_box_color" value="#f5f5f5" data-default-color="#f5f5f5" class="color-picker">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="review_display_type">Reviews display style</label></th>
                        <td>
                            <select name="review_display_type" id="review_display_type" class="regular-text">
                                <option value="list" selected>List Review</option>
                                <option value="slider">Review Slider</option>
                                <option value="floating">Review Widget</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save Display Settings</button>
            </p>
        </form>
    </div>
    
    <!-- WOOCOMMERCE SETTINGS -->
    <div id="woocommerce" class="tab-content" style="display: none;">
        <h3>WooCommerce Settings</h3>
        <form id="woocommerce-settings" method="post">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">WooCommerce Integration</th>
                        <td>
                            <label><input type="checkbox" name="replace_woo_reviews"> Replace WooCommerce default review system</label><br>
                            <label><input type="checkbox" name="show_on_product_pages" checked> Show reviews on product pages</label><br>
                            <label><input type="checkbox" name="verified_purchasers_only"> Allow reviews only from verified purchasers</label>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="min_rating_display">Minimum rating to display on product page</label></th>
                        <td>
                            <select id="min_rating_display" name="min_rating_display" class="regular-text">
                                <option value="0">No minimum</option>
                                <option value="2">2 stars</option>
                                <option value="3" selected>3 stars</option>
                                <option value="4">4 stars</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save WooCommerce Settings</button>
            </p>
        </form>
    </div>
    
    <!-- SCHEMA SETTINGS -->
    <div id="schema" class="tab-content" style="display: none;">
        <h3>Schema Settings</h3>
        <form id="schema-settings" method="post">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="business_name">Local Business Name</label></th>
                        <td>
                            <input type="text" id="business_name" name="business_name" class="regular-text" placeholder="Your Business Name" value="">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="default_description">Default Description</label></th>
                        <td>
                            <select id="default_description" name="default_description" class="regular-text">
                                <option value="page_excerpt" selected>Use the assigned or current page excerpt</option>
                                <option value="custom">Use custom description</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="default_url">Default URL</label></th>
                        <td>
                            <select id="default_url" name="default_url" class="regular-text">
                                <option value="page_url" selected>Use the assigned or current page URL</option>
                                <option value="custom">Use custom URL</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="default_image">Default Image</label></th>
                        <td>
                            <select id="default_image" name="default_image" class="regular-text">
                                <option value="featured_image" selected>Use featured image of the assigned or current page</option>
                                <option value="custom">Use custom image</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="business_address">Address</label></th>
                        <td>
                            <textarea id="business_address" name="business_address" class="regular-text" style="height: 80px;"></textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="business_phone">Telephone Number</label></th>
                        <td>
                            <input type="text" id="business_phone" name="business_phone" class="regular-text" value="">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="price_range">Price Range</label></th>
                        <td>
                            <select id="price_range" name="price_range" class="regular-text">
                                <option value="$">$</option>
                                <option value="$$" selected>$$</option>
                                <option value="$$$">$$$</option>
                                <option value="$$$$">$$$$</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save Schema Settings</button>
            </p>
        </form>
    </div>
    
    <!-- SHORTCODES -->
    <div id="shortcodes" class="tab-content" style="display: none;">
        <h3>Get Shortcodes</h3>
        
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label>Review Form</label></th>
                    <td>
                        <input type="text" value="[wp_ctrw_form]" readonly class="regular-text">
                        <button class="button">Copy</button>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label>Review List</label></th>
                    <td>
                        <input type="text" value="[wp_ctrw_lists]" readonly class="regular-text">
                        <button class="button">Copy</button>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label>Review Slider</label></th>
                    <td>
                        <input type="text" value="[wp_ctrw_slider]" readonly class="regular-text">
                        <button class="button">Copy</button>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label>Review Floating widget</label></th>
                    <td>
                        <input type="text" value="[wp_ctrw_widget]" readonly class="regular-text">
                        <button class="button">Copy</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- ADVANCED SETTINGS -->
    <div id="advanced" class="tab-content" style="display: none;">
        <h3>Advanced Settings</h3>
        <form id="advanced-settings" method="post">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="admin_emails">Admin notification emails</label></th>
                        <td>
                            <input type="text" id="admin_emails" name="admin_emails" value="" class="regular-text">
                            <p class="description">Comma separate multiple emails</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="custom_message">Custom Messages</label></th>
                        <td>
                            <textarea id="custom_message" name="custom_message" class="regular-text" style="height: 120px; font-family: monospace;" placeholder="Enter your custom CSS here"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <button type="submit" class="button-primary">Save Advanced Settings</button>
            </p>
        </form>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Tab functionality
    $('.nav-tab-wrapper a').click(function(e) {
        e.preventDefault();
        
        // Hide all tab content
        $('.tab-content').hide();
        
        // Remove active class from all tabs
        $('.nav-tab-wrapper a').removeClass('nav-tab-active');
        
        // Add active class to clicked tab
        $(this).addClass('nav-tab-active');
        
        // Show the corresponding tab content
        $($(this).attr('href')).show();
    });
    
    // Color picker
    $('.color-picker').wpColorPicker();
    
    // Copy button functionality
    $('button:contains("Copy")').click(function() {
        var input = $(this).prev('input');
        input.select();
        document.execCommand('copy');
        
        // Show copied feedback
        var originalText = $(this).text();
        $(this).text('Copied!');
        setTimeout(function() {
            $(this).text(originalText);
        }.bind(this), 2000);
    });
});
</script>