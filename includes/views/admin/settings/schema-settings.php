<?php
$schemaSettings = get_option('ctrw_schema_settings');
// Set default values
$defaults = array(
    'enabled_schema' => 'off',
);

// Merge with defaults
$schemaSettings = wp_parse_args($schemaSettings, $defaults);
?>
  
<div id="schema" class="tab-content" style="display: none;">
    <h3>Schema Settings</h3>
    <form id="schema-settings" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="business_name">Enabled Schema markup</label></th>
                    <td>
                        <input type="checkbox" name="enabled_schema" <?php checked($schemaSettings['enabled_schema'], 'on'); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="business_name">Local Business Name</label></th>
                    <td>
                        <input type="text" id="business_name" name="business_name" class="regular-text" placeholder="Your Business Name" value="<?php echo isset($schemaSettings['business_name']) ? esc_attr($schemaSettings['business_name']) : esc_attr(get_bloginfo('name')); ?>">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="default_description">Default Description</label></th>
                    <td>
                        <input type="text" id="default_description" name="default_description" class="regular-text" placeholder="Enter default description" value="<?php echo isset($schemaSettings['default_description']) ? esc_attr($schemaSettings['default_description']) : esc_attr(get_bloginfo('description')); ?>">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="default_url">Default URL</label></th>
                    <td>
                        <input type="text" id="default_url" name="default_url" class="regular-text" placeholder="Enter default URL" value="<?php echo isset($schemaSettings['default_url']) ? esc_attr($schemaSettings['default_url']) : esc_url(home_url('/')); ?>">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="default_image">Default Image</label></th>
                    <td>
                            <div class="image-upload-wrapper">
                                <div class="image-preview-wrapper">
                                    <?php 
                                    $fallback_image = '';
                                    if (!empty($schemaSettings['custom_image_url'])) {
                                        $image_url = esc_url($schemaSettings['custom_image_url']);
                                    } else {
                                        $site_icon_id = get_option('site_icon');
                                        if ($site_icon_id) {
                                            $image_url = esc_url(wp_get_attachment_image_url($site_icon_id, 'thumbnail'));
                                            $fallback_image = $image_url;
                                        } else {
                                            $image_url = '';
                                        }
                                    }
                                    ?>
                                    <img id="image-preview" src="<?php echo $image_url; ?>" height="100" <?php echo empty($image_url) ? 'style="display: none;"' : ''; ?>>
                                </div>
                                <input id="upload_image_button" type="button" class="button" value="Upload Image" />
                                <input type="hidden" name="custom_image_url" id="custom_image_url" value="<?php echo isset($schemaSettings['custom_image_url']) ? esc_attr($schemaSettings['custom_image_url']) : esc_attr($fallback_image); ?>">
                                <p class="description">Upload an image or it will use the site icon by default</p>
                            </div>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="business_address">Address</label></th>
                    <td>
                        <textarea id="business_address" name="business_address" class="regular-text" style="height: 80px;"><?php echo isset($schemaSettings['business_address']) ? esc_textarea($schemaSettings['business_address']) : ''; ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="business_phone">Telephone Number</label></th>
                    <td>
                        <input type="text" id="business_phone" name="business_phone" class="regular-text" value="<?php echo isset($schemaSettings['business_phone']) ? esc_attr($schemaSettings['business_phone']) : ''; ?>">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="price_range">Price Range</label></th>
                    <td>
                        <select id="price_range" name="price_range" class="regular-text">
                            <option value="$" <?php selected(isset($schemaSettings['price_range']) ? $schemaSettings['price_range'] : '', '$'); ?>>$</option>
                            <option value="$$" <?php selected(isset($schemaSettings['price_range']) ? $schemaSettings['price_range'] : '', '$$'); ?>>$$</option>
                            <option value="$$$" <?php selected(isset($schemaSettings['price_range']) ? $schemaSettings['price_range'] : '', '$$$'); ?>>$$$</option>
                            <option value="$$$$" <?php selected(isset($schemaSettings['price_range']) ? $schemaSettings['price_range'] : '', '$$$$'); ?>>$$$$</option>
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

<script>
jQuery(document).ready(function($){
    // Image upload functionality
    $('#upload_image_button').on('click', function(e) {
        e.preventDefault();
        
        var custom_uploader = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Use This Image'
            },
            multiple: false
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#custom_image_url').val(attachment.url);
            $('#image-preview').attr('src', attachment.url).show();
        })
        .open();
    });
});
</script>