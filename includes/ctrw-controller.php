<?php
if (!defined('ABSPATH')) {
    exit;
}

class CTRW_Review_Controller {
    public function __construct() {
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
