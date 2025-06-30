<?php
$ctrw_display_settings = get_option('ctrw_display_settings', array());
?>

<form id="display-settings" class="ctrw-settings-section" method="post">
    <h2>Review Display Settings</h2>
    <div class="form-row">
        <div class="form-group">
            <div class="toggle-group">
                <label class="toggle-switch">
                    <input type="checkbox" name="show_city" <?php checked( !empty($ctrw_display_settings['show_city']) ); ?>>
                    <span class="slider"></span>
                    <span>Show city in review list</span>
                </label>
                <label class="toggle-switch">
                    <input type="checkbox" name="show_state" <?php checked( !empty($ctrw_display_settings['show_state']) ); ?>>
                    <span class="slider"></span>
                    <span>Show state in review list</span>
                </label>
                <label class="toggle-switch">
                    <input type="checkbox" name="enable_titles" <?php checked( !empty($ctrw_display_settings['enable_titles']), 1, true ); ?>>
                    <span class="slider"></span>
                    <span>Enable review titles</span>
                </label>
                <label class="toggle-switch">
                    <input type="checkbox" name="show_time_with_date" <?php checked( !empty($ctrw_display_settings['show_time_with_date']) ); ?>>
                    <span class="slider"></span>
                    <span>Show time with review dates</span>
                </label>
            </div>
            <div class="form-row" style="margin-top: 20px;">
                <select class="ctrw-select" name="name_font_weight">
                    <option value="normal" <?php selected( isset($ctrw_display_settings['name_font_weight']) && $ctrw_display_settings['name_font_weight'] === 'normal' ); ?>>Normal</option>
                    <option value="bold" <?php selected( !isset($ctrw_display_settings['name_font_weight']) || $ctrw_display_settings['name_font_weight'] === 'bold' ); ?>>Bold</option>
                </select>
                <label>Name font weight</label>
            </div>
            <div class="form-row" style="margin-top: 20px;">
                <input type="number" name="comment_font_size" min="10" max="24" value="<?php echo isset($ctrw_display_settings['comment_font_size']) ? esc_attr($ctrw_display_settings['comment_font_size']) : 14; ?>" class="ctrw-input">
                <label>Comment font size (px)</label>
            </div>
            <div class="form-row" style="margin-top: 20px;">
                <select class="ctrw-select" name="comment_font_style">
                    <option value="normal" <?php selected( !isset($ctrw_display_settings['comment_font_style']) || $ctrw_display_settings['comment_font_style'] === 'normal' ); ?>>Normal</option>
                    <option value="italic" <?php selected( isset($ctrw_display_settings['comment_font_style']) && $ctrw_display_settings['comment_font_style'] === 'italic' ); ?>>Italic</option>
                </select>
                <label>Comment font style</label>
            </div>
            <div class="form-row" style="margin-top: 20px;">
                <input type="number" name="comment_line_height" min="10" max="30" value="<?php echo isset($ctrw_display_settings['comment_line_height']) ? esc_attr($ctrw_display_settings['comment_line_height']) : 20; ?>" class="ctrw-input">
                <label>Comment line height (px)</label>
            </div>
        </div>
        <div class="form-group">
            <?php
            if (function_exists('wp_enqueue_style')) {
                wp_enqueue_style('wp-color-picker');
                wp_enqueue_script('wp-color-picker');
            }
            ?>
            <label><?php esc_html_e('Star Color:', 'wp_cr'); ?></label>
            <input type="text" name="star_color" id="star_color"
                value="<?php echo isset($ctrw_display_settings['star_color']) ? esc_attr($ctrw_display_settings['star_color']) : '#ffb100'; ?>"
                data-default-color="#ffb100">
            <label><?php esc_html_e('Comment Box Fill Color:', 'wp_cr'); ?></label>
            <input type="text" name="comment_box_color" id="comment_box_color"
                value="<?php echo isset($ctrw_display_settings['comment_box_color']) ? esc_attr($ctrw_display_settings['comment_box_color']) : '#f5f5f5'; ?>"
                data-default-color="#f5f5f5">
            <script>
            jQuery(document).ready(function($){
                $('#star_color').wpColorPicker();
                $('#comment_box_color').wpColorPicker();
            });
            </script>
            <label>Reviews display style</label>
            <select name="review_display_type" id="review_display_type">
                <option value="list" <?php selected( !isset($ctrw_display_settings['review_display_type']) || $ctrw_display_settings['review_display_type'] === 'list' ); ?>>List Review</option>
                <option value="slider" <?php selected( isset($ctrw_display_settings['review_display_type']) && $ctrw_display_settings['review_display_type'] === 'slider' ); ?>>Review Slider</option>
                <option value="floating" <?php selected( isset($ctrw_display_settings['review_display_type']) && $ctrw_display_settings['review_display_type'] === 'floating' ); ?>>Review Widget</option>
            </select>
            
        </div>
    </div>
    <div class="ctrw-settings-footer">
       
        <button type="submit" class="ctrw-save-btn">Save Display Settings</button>
    </div>
</form>
