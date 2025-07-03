<?php
/*
 * Plugin Name:          Customer Reviews
 * Plugin URI:           http://wordpress.org/plugins/customer-reviews/
 * Description:          The Customer Review plugin allows you to manage and display customer-submitted reviews for products and services. A short code can be added to any page, post, or custom post type.
 * Version:              1.0.0
 * Author:               Artios Media
 * Author URI:           http://www.artiosmedia.com
 * Developer:            Arafat Rahman
 * Copyright:            © 2019-2025 Artios Media (email : contact@artiosmedia.com).
 * License: GNU          General Public License v3.0
 * License URI:          http://www.gnu.org/licenses/gpl-3.0.html
 * Tested up to:         6.8.1
 * PHP tested up to:     8.2.4
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin path
define('CTRW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CTRW_PLUGIN_ASSETS', plugin_dir_url(__FILE__) . 'assets/');
define('CTRW_BASE_NAME', plugin_basename(__FILE__));
define('CTRW_PLUGIN_FILE', __FILE__);

// Include the main controller
include_once CTRW_PLUGIN_PATH . 'includes/ctrw-view.php';
include_once CTRW_PLUGIN_PATH . 'includes/ctrw-model.php';
require_once CTRW_PLUGIN_PATH . 'includes/ctrw-controller.php';



add_action('load-toplevel_page_ctrw-customer-reviews', 'ctrw_add_screen_options');

function ctrw_add_screen_options() {
    // Add per-page setting
    $option = 'per_page';
    $args = [
        'label'   => 'Reviews per page',
        'default' => 10,
        'option'  => 'ctrw_reviews_per_page'
    ];
    add_screen_option($option, $args);

    // Add screen_settings filter
    add_filter('screen_settings', 'ctrw_screen_settings_html', 10, 2);
}

function ctrw_screen_settings_html($settings, $screen) {
    if ($screen->id !== 'toplevel_page_ctrw-customer-reviews') {
        return $settings;
    }

    $user_id = get_current_user_id();
    $saved = get_user_meta($user_id, 'ctrw_column_visibility', true);
    $defaults = [
        'review-title' => 1,
        'author' => 1,
        'rating' => 1,
        'review' => 1,
        'admin-reply' => 1,
        'status' => 1,
        'action' => 1,
    ];
    $columns = is_array($saved) ? array_merge($defaults, $saved) : $defaults;

    ob_start();
    ?>
    <fieldset class="options-group">
        <legend><?php esc_html_e('Show/Hide Columns', 'wp_cr'); ?></legend>
        <?php foreach ($defaults as $col => $def): ?>
            <label style="margin-right:10px;">
                <input type="checkbox" class="ctrw-toggle-col" data-col="<?php echo esc_attr($col); ?>" <?php checked($columns[$col]); ?>>
                <?php
                $labels = [
                    'review-title' => 'Review Title',
                    'author' => 'Author',
                    'rating' => 'Rating',
                    'review' => 'Review',
                    'admin-reply' => 'Admin Reply',
                    'status' => 'Status',
                    'action' => 'Action'
                ];
                echo esc_html($labels[$col]);
                ?>
            </label>
        <?php endforeach; ?>
    </fieldset>
    <script>
    (function($){
        function ctrw_toggle_columns() {
            $('.ctrw-toggle-col').each(function(){
                var col = $(this).data('col');
                var checked = $(this).is(':checked');
                var idx = {
                    'review-title': 2,
                    'author': 3,
                    'rating': 4,
                    'review': 5,
                    'admin-reply': 6,
                    'status': 7,
                    'action': 8
                }[col];
                if (idx) {
                    $('.wp-list-table th:nth-child(' + idx + '), .wp-list-table td:nth-child(' + idx + ')')
                        .toggle(checked);
                }
            });
        }

        $(document).ready(function(){
            $('.ctrw-toggle-col').on('change', function(){
                ctrw_toggle_columns();
                var data = {};
                $('.ctrw-toggle-col').each(function(){
                    data[$(this).data('col')] = $(this).is(':checked') ? 1 : 0;
                });
                $.post(ajaxurl, {
                    action: 'ctrw_save_column_visibility',
                    columns: data,
                    _wpnonce: '<?php echo wp_create_nonce('ctrw_save_cols'); ?>'
                });
            });

            // Initial run
            ctrw_toggle_columns();
        });
    })(jQuery);
    </script>
    <?php
    return $settings . ob_get_clean();
}

add_filter('set-screen-option', 'ctrw_save_screen_option', 10, 3);
function ctrw_save_screen_option($status, $option, $value) {
    if ($option === 'ctrw_reviews_per_page') {
        return $value;
    }
    return $status;
}

add_action('wp_ajax_ctrw_save_column_visibility', 'ctrw_save_column_visibility');
function ctrw_save_column_visibility() {
    check_ajax_referer('ctrw_save_cols');
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Permission denied');
    }
    $columns = isset($_POST['columns']) && is_array($_POST['columns']) ? $_POST['columns'] : [];
    $user_id = get_current_user_id();
    update_user_meta($user_id, 'ctrw_column_visibility', $columns);
    wp_send_json_success();
}



