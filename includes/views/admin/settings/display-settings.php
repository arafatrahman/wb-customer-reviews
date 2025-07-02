<?php
/**
 * Display Settings Tab Content
 */

$displaySettings = get_option('ctrw_display_settings', array());

// Set default values
$defaults = array(
    'show_city' => 'off',
    'show_state' => 'off',
    'enable_titles' => 'on',       // Checked by default
    'show_time_with_date' => 'on', // Checked by default
    'name_font_weight' => 'normal',
    'comment_font_size' => 14,
    'comment_font_style' => 'normal',
    'comment_line_height' => 20,
    'star_color' => '#ffb100',
    'comment_box_color' => '#f5f5f5',
    'review_display_type' => 'list'
);

// Merge with defaults
$displaySettings = wp_parse_args($displaySettings, $defaults);

// Enqueue WordPress color picker
wp_enqueue_style('wp-color-picker');
wp_enqueue_script('wp-color-picker');
?>

<div id="display" class="tab-content" style="display: none;">
    <form id="display-settings" method="post" class="ctrw-settings-form">
        <h3>Display Settings</h3>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Review Display Options</th>
                    <td>
                        <label>
                            <input type="checkbox" name="show_city" <?php checked($displaySettings['show_city'], 'on'); ?>>
                            Show city in review list
                        </label><br>
                        <label>
                            <input type="checkbox" name="show_state" <?php checked($displaySettings['show_state'], 'on'); ?>>
                            Show state in review list
                        </label><br>
                        <label>
                            <input type="checkbox" name="enable_titles" <?php checked($displaySettings['enable_titles'], 'on'); ?>>
                            Enable review titles
                        </label><br>
                        <label>
                            <input type="checkbox" name="show_time_with_date" <?php checked($displaySettings['show_time_with_date'], 'on'); ?>>
                            Show time with review dates
                        </label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="name_font_weight">Name font weight</label></th>
                    <td>
                        <select id="name_font_weight" name="name_font_weight" class="regular-text">
                            <option value="normal" <?php selected($displaySettings['name_font_weight'], 'normal'); ?>>Normal</option>
                            <option value="bold" <?php selected($displaySettings['name_font_weight'], 'bold'); ?>>Bold</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="comment_font_size">Comment font size (px)</label></th>
                    <td>
                        <input type="number" id="comment_font_size" name="comment_font_size" min="10" max="24" 
                               value="<?php echo esc_attr($displaySettings['comment_font_size']); ?>" class="small-text">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="comment_font_style">Comment font style</label></th>
                    <td>
                        <select id="comment_font_style" name="comment_font_style" class="regular-text">
                            <option value="normal" <?php selected($displaySettings['comment_font_style'], 'normal'); ?>>Normal</option>
                            <option value="italic" <?php selected($displaySettings['comment_font_style'], 'italic'); ?>>Italic</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="comment_line_height">Comment line height (px)</label></th>
                    <td>
                        <input type="number" id="comment_line_height" name="comment_line_height" min="10" max="30" 
                               value="<?php echo esc_attr($displaySettings['comment_line_height']); ?>" class="small-text">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="star_color">Star Color</label></th>
                    <td>
                        <input type="text" name="star_color" id="star_color" 
                               value="<?php echo esc_attr($displaySettings['star_color']); ?>" 
                               data-default-color="#ffb100" class="color-picker">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="comment_box_color">Comment Box Fill Color</label></th>
                    <td>
                        <input type="text" name="comment_box_color" id="comment_box_color" 
                               value="<?php echo esc_attr($displaySettings['comment_box_color']); ?>" 
                               data-default-color="#f5f5f5" class="color-picker">
                    </td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="review_display_type">Reviews display style</label></th>
                    <td>
                        <select name="review_display_type" id="review_display_type" class="regular-text">
                            <option value="list" <?php selected($displaySettings['review_display_type'], 'list'); ?>>List Review</option>
                            <option value="slider" <?php selected($displaySettings['review_display_type'], 'slider'); ?>>Review Slider</option>
                            <option value="floating" <?php selected($displaySettings['review_display_type'], 'floating'); ?>>Review Widget</option>
                        </select>
                        <p id="review_display_info"></p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <p class="submit">
            <button type="submit" class="button-primary">Save Display Settings</button>
            <input type="hidden" name="action" value="ctrw_save_display_settings">
            <?php wp_nonce_field('ctrw_review_nonce', 'security'); ?>
        </p>
    </form>
</div>