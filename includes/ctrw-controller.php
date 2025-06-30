<?php
if (!defined('ABSPATH')) {
    exit;
}

class CTRW_Review_Controller {
    public function __construct() {

        add_filter('plugin_action_links_' . CTRW_BASE_NAME, array($this, 'CTRW_plugin_action_links'));

        //Add plugin description link
        add_filter('plugin_row_meta', array($this, 'add_CTRW_description_link'), 10, 2);
        add_filter('plugin_row_meta', array($this, 'add_CTRW_details_link'), 10, 4);

        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_enqueue_scripts', [$this,'crtw_enqueue_scripts']);
        
        // SAVE GENERAL SETTINGS
        add_action('wp_ajax_ctrw_save_general_settings', [$this, 'ctrw_save_general_settings']);
        add_action('wp_ajax_nopriv_ctrw_save_general_settings', [$this, 'ctrw_save_general_settings']);
        // SAVE FORM FIELDS SETTINGS
        add_action('wp_ajax_ctrw_save_form_fields_settings', [$this, 'ctrw_save_form_fields_settings']);
        add_action('wp_ajax_nopriv_ctrw_save_form_fields_settings', [$this, 'ctrw_save_form_fields_settings']);

        // SAVE DISPLAY SETTINGS
        add_action('wp_ajax_ctrw_save_display_settings', [$this, 'ctrw_save_display_settings']);
        add_action('wp_ajax_nopriv_ctrw_save_display_settings', [$this, 'ctrw_save_display_settings']);

        // SAVE WOOCOMMERCE SETTINGS
        add_action('wp_ajax_ctrw_save_woocommerce_settings', [$this, 'ctrw_save_woocommerce_settings']);
        add_action('wp_ajax_nopriv_ctrw_save_woocommerce_settings', [$this, 'ctrw_save_woocommerce_settings']);
    
        // save schema settings
        add_action('wp_ajax_ctrw_save_schema_settings', [$this, 'ctrw_save_schema_settings']);
        add_action('wp_ajax_nopriv_ctrw_save_schema_settings', [$this, 'ctrw_save_schema_settings']);
      

        //SAVE ADVANCED SETTINGS
        add_action('wp_ajax_ctrw_save_advanced_settings', [$this, 'ctrw_save_advanced_settings']);
        add_action('wp_ajax_nopriv_ctrw_save_advanced_settings', [$this, 'ctrw_save_advanced_settings']);
      
      }


      // Add settings link to the plugin page
      public function CTRW_plugin_action_links($links) {
            // We shouldn't encourage editing our plugin directly.
            unset($links['edit']);

            // Add our custom links to the returned array value.
            return array_merge(array(
            '<a href="' . admin_url('admin.php?page=wp-review-settings') . '">' . __('Settings', 'wp_cr') . '</a>'
            ), $links);
      }

      // Add a donation link to the plugin row meta
      public function add_CTRW_description_link($links, $file)
      {

            
            
            if (CTRW_BASE_NAME == $file) {
            // Add a donation link to the plugin row meta
            $row_meta = array(
                  'donation' => '<a href="' . esc_url(' https://www.zeffy.com/en-US/donation-form/your-donation-makes-a-difference-6') . '" target="_blank">' . esc_html__('Donation for Homeless', 'wp_cr') . '</a>'
            );
            return array_merge($links, $row_meta);
            }
            return (array) $links;
      }

      public function add_CTRW_details_link($links, $plugin_file, $plugin_data)
      {

            if (isset($plugin_data['PluginURI']) && false !== strpos($plugin_data['PluginURI'], 'http://wordpress.org/plugins/customer-reviews/')) {
            $slug = basename($plugin_data['PluginURI']);
            unset($links[2]);
            $links[] = sprintf('<a href="%s" class="thickbox" title="%s">%s</a>', self_admin_url('plugin-install.php?tab=plugin-information&amp;plugin=' . $slug . '&amp;TB_iframe=true&amp;width=772&amp;height=563'), esc_attr(sprintf(__('More information about %s', 'ctyw'), $plugin_data['Name'])), __('View Details', 'wp_cr'));
            }
            return $links;
      }

    // Add menu pages
    public function add_admin_menu() {
        add_menu_page(
            'Reviews',
            'Reviews',
            'manage_options',
            'ctrw-customer-reviews',
            array($this, 'ctrw_display_datatable_page'),
            'dashicons-star-filled'
        );
        

        add_submenu_page(
            'ctrw-customer-reviews',
            'Review Settings',
            'Review Settings',
            'manage_options',
            'ctrw-settings',
            array($this, 'ctrw_display_settings_page')
        );
    }

     
      // Display Review Settings page
      public function ctrw_display_datatable_page() {
            echo " i am settings page";
      }

       // Display Review Settings page
      public function ctrw_display_settings_page() {
            // Check user capabilities for extra security
            if (!current_user_can('manage_options')) {
                  wp_die(__('You do not have sufficient permissions to access this page.'));
            }
            // Optionally verify nonce if processing form submissions here
            include CTRW_PLUGIN_PATH . 'includes/views/admin/settings/ctrw-settings-panel.php';
      }

      // Enqueue scripts and styles for the frontend
      public function crtw_enqueue_scripts() {


            $screen = get_current_screen();
            if ($screen && $screen->id !== 'reviews_page_ctrw-settings') {
                  return;
            }
            wp_enqueue_style('ctrw-review-style', CTRW_PLUGIN_ASSETS . 'css/ctrw-admin.css', array(), '1.0.0');
            wp_enqueue_script('ctrw-review-script', CTRW_PLUGIN_ASSETS . 'js/ctrw-admin.js', array('jquery'), '1.0.0', true);
            wp_localize_script('ctrw-review-script', 'ctrw_admin_ajax', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('ctrw_review_nonce')
            ));
      }

      // Save General Settings
      public function ctrw_save_general_settings() {
            // Check nonce for security
            check_ajax_referer('ctrw_review_nonce', 'security'); 
            // Remove security and action fields before saving
            $settings = $_POST;
            unset($settings['security'], $settings['action']);

            // Sanitize each setting value
            $sanitized_settings = $this->ctrw_sanitize_settings($settings);

            // Save settings as an option
            update_option('ctrw_general_settings', $sanitized_settings);            
      }

      // Save Form Fields Settings
      public function ctrw_save_form_fields_settings() {
            // Check nonce for security
            check_ajax_referer('ctrw_review_nonce', 'security'); 
            // Remove security and action fields before saving
            $settings = $_POST;
            unset($settings['security'], $settings['action']);          
            // Sanitize each setting value
            $sanitized_settings = $this->ctrw_sanitize_settings($settings);
            // Save settings as an option
            update_option('ctrw_form_fields_settings', $sanitized_settings);
      }

      // Save Display Settings
      public function ctrw_save_display_settings() {
            // Check nonce for security
            check_ajax_referer('ctrw_review_nonce', 'security');
            // Remove security and action fields before saving
            $settings = $_POST;
            unset($settings['security'], $settings['action']);
            // Sanitize each setting value
            $sanitized_settings = $this->ctrw_sanitize_settings($settings);
            // Save settings as an option
            update_option('ctrw_display_settings', $sanitized_settings);
      }

      // Save WooCommerce Settings
      public function ctrw_save_woocommerce_settings() {
            // Check nonce for security
            check_ajax_referer('ctrw_review_nonce', 'security');
            // Remove security and action fields before saving
            $settings = $_POST;
            unset($settings['security'], $settings['action']);
            // Sanitize each setting value
            $sanitized_settings = $this->ctrw_sanitize_settings($settings);
            // Save settings as an option
            update_option('ctrw_woocommerce_settings', $sanitized_settings);
      }

      // Save Schema Settings
      public function ctrw_save_schema_settings() {
            // Check nonce for security
            check_ajax_referer('ctrw_review_nonce', 'security');
            // Remove security and action fields before saving
            $settings = $_POST;
            unset($settings['security'], $settings['action']);
            // Sanitize each setting value
            $sanitized_settings = $this->ctrw_sanitize_settings($settings);
            // Save settings as an option
            update_option('ctrw_schema_settings', $sanitized_settings);
      }

      // Save Advanced Settings
      public function ctrw_save_advanced_settings() {
            // Check nonce for security
            check_ajax_referer('ctrw_review_nonce', 'security');
            // Remove security and action fields before saving
            $settings = $_POST;
            unset($settings['security'], $settings['action']);
            // Sanitize each setting value
            $sanitized_settings = $this->ctrw_sanitize_settings($settings);
            // Save settings as an option
            update_option('ctrw_advanced_settings', $sanitized_settings);
            
      }

      private function ctrw_sanitize_settings($settings) {
            $sanitized_settings = array();
            foreach ($settings as $key => $value) {
                  if (is_array($value)) {
                        $sanitized_settings[$key] = array_map('sanitize_text_field', $value);
                  } else {
                        $sanitized_settings[$key] = sanitize_text_field($value);
                  }
            }
            return $sanitized_settings;
      }
            


}


new CTRW_Review_Controller();
?>
