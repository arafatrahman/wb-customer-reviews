<?php
$schemaSettings = get_option('ctrw_schema_settings');
?>
  
  
  
  <div id="schema" class="tab-content" style="display: none;">
        <h3>Schema Settings</h3>
        <form id="schema-settings" method="post">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="business_name">Local Business Name</label></th>
                        <td>
                            <input type="text" id="business_name" name="business_name" class="regular-text" placeholder="Your Business Name" value="<?php echo isset($schemaSettings['business_name']) ? esc_attr($schemaSettings['business_name']) : ''; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="default_description">Default Description</label></th>
                        <td>
                            <select id="default_description" name="default_description" class="regular-text">
                                <option value="page_excerpt" <?php selected(isset($schemaSettings['default_description']) ? $schemaSettings['default_description'] : '', 'page_excerpt'); ?>>Use the assigned or current page excerpt</option>
                                <option value="custom" <?php selected(isset($schemaSettings['default_description']) ? $schemaSettings['default_description'] : '', 'custom'); ?>>Use custom description</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="default_url">Default URL</label></th>
                        <td>
                            <select id="default_url" name="default_url" class="regular-text">
                                <option value="page_url" <?php selected(isset($schemaSettings['default_url']) ? $schemaSettings['default_url'] : '', 'page_url'); ?>>Use the assigned or current page URL</option>
                                <option value="custom" <?php selected(isset($schemaSettings['default_url']) ? $schemaSettings['default_url'] : '', 'custom'); ?>>Use custom URL</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="default_image">Default Image</label></th>
                        <td>
                            <select id="default_image" name="default_image" class="regular-text">
                                <option value="featured_image" <?php selected(isset($schemaSettings['default_image']) ? $schemaSettings['default_image'] : '', 'featured_image'); ?>>Use featured image of the assigned or current page</option>
                                <option value="custom" <?php selected(isset($schemaSettings['default_image']) ? $schemaSettings['default_image'] : '', 'custom'); ?>>Use custom image</option>
                            </select>
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