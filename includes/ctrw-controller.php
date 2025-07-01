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
        
        // Enqueue scripts and styles for the frontend
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_enqueue_scripts', [$this,'crtw_enqueue_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'crtw_wp_enqueue_scripts']);

        
        // Register activation hook to create database table
        register_activation_hook(CTRW_PLUGIN_FILE, [$this, 'ctrw_create_reviews_table']);




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


       // Register [wp_ctrw_form] shortcode
       add_shortcode('wp_ctrw_form', [$this, 'ctrw_render_review_form']);
       // Register [wp_ctrw_summary] shortcode
       add_shortcode('wp_ctrw_summary', [$this, 'ctrw_render_review_summary']);
       // Register [wp_ctrw_lists] shortcode
       add_shortcode('wp_ctrw_lists', [$this, 'ctrw_render_review_list']);
       // Register [wp_ctrw_slider] shortcode
       add_shortcode('wp_ctrw_slider', [$this, 'ctrw_render_review_slider']);
       // Register [wp_ctrw_widget] shortcode
       add_shortcode('wp_ctrw_widget', [$this, 'ctrw_render_review_widget']);

      
      // Handle review submission via AJAX
      add_action('wp_ajax_ctrw_submit_review', [$this, 'ctrw_submit_review']);
      add_action('wp_ajax_nopriv_ctrw_submit_review', [$this, 'ctrw_submit_review']);
      
      
      }


      // Add settings link to the plugin page
      public function CTRW_plugin_action_links($links) {
            // We shouldn't encourage editing our plugin directly.
            unset($links['edit']);

            // Add our custom links to the returned array value.
            return array_merge(array(
            '<a href="' . admin_url('admin.php?page=ctrw-settings') . '">' . __('Settings', 'wp_cr') . '</a>'
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
            if ($screen && $screen->id == 'reviews_page_ctrw-settings') {
           
                  wp_enqueue_style('ctrw-review-style', CTRW_PLUGIN_ASSETS . 'css/ctrw-admin.css', array(), '1.0.0');
                  wp_enqueue_script('ctrw-review-script', CTRW_PLUGIN_ASSETS . 'js/ctrw-admin.js', array('jquery'), '1.0.0', true);
                  wp_localize_script('ctrw-review-script', 'ctrw_admin_ajax', array(
                  'ajax_url' => admin_url('admin-ajax.php'),
                  'nonce' => wp_create_nonce('ctrw_review_nonce')
                  ));
                  
            } 
            
      }

      // Enqueue scripts and styles for the frontend
      public function crtw_wp_enqueue_scripts() {
            wp_enqueue_style('ctrw-review-frontend-style', CTRW_PLUGIN_ASSETS . 'css/ctrw-style.css', array(), '1.0.0');
            wp_enqueue_style('ctrw-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
            wp_enqueue_script('ctrw-review-frontend-script', CTRW_PLUGIN_ASSETS . 'js/ctrw-frontend.js', array('jquery'), '1.0.0', true);
            
            // Localize script to pass AJAX URL and nonce
            wp_localize_script('crtw-review-ajax', 'ctrw_review_form_ajax', ['ajax_url' => admin_url('admin-ajax.php') , 'nonce' => wp_create_nonce('ctrw_review_form_nonce')]);
      }

      // Create the reviews table on plugin activation
      public function ctrw_create_reviews_table() {
            global $wpdb;
            $table_name = $wpdb->prefix . 'ctrw_reviews';
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                  id mediumint(9) NOT NULL AUTO_INCREMENT,
                  name tinytext NOT NULL,
                  email varchar(100) NOT NULL,
                  phone varchar(20) DEFAULT '' NOT NULL,
                  website varchar(255) DEFAULT '' NOT NULL,
                  city varchar(100) DEFAULT '' NOT NULL,
                  state varchar(100) DEFAULT '' NOT NULL,
                  title tinytext NOT NULL,
                  review text NOT NULL,
                  rating tinyint(1) NOT NULL,
                  page_id mediumint(9) DEFAULT 0 NOT NULL,
                  date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                  PRIMARY KEY  (id)
            ) $charset_collate;";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
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

      // Render the review form shortcode
      public function ctrw_render_review_form($atts) {
            // Check if the form is enabled
            $general_settings = get_option('ctrw_general_settings', array());
            if (isset($general_settings['enable_review_form']) && $general_settings['enable_review_form'] === 'on') {
                  // Include the form template
                  ob_start();
                  include CTRW_PLUGIN_PATH . 'includes/views/public/review-form.php';
                  return ob_get_clean();
            } else {
                  return '<p>' . __('The review form is currently disabled.', 'wp_cr') . '</p>';
            }     
      }

      // Render the review summary shortcode
      public function ctrw_render_review_summary($atts) {
            // Check if the summary is enabled
            $general_settings = get_option('ctrw_general_settings', array());
            if (isset($general_settings['enable_review_summary']) && $general_settings['enable_review_summary'] === 'on') {
                  // Include the summary template
                  ob_start();
                  include CTRW_PLUGIN_PATH . 'includes/views/public/review-summary.php';
                  return ob_get_clean();
            } else {
                  return '<p>' . __('The review summary is currently disabled.', 'wp_cr') . '</p>';
            }
      }

      // Render the review list shortcode
      public function ctrw_render_review_list($atts) {
            // Check if the review list is enabled
            $general_settings = get_option('ctrw_general_settings', array());
            if (isset($general_settings['enable_review_list']) && $general_settings['enable_review_list'] === 'on') {
                  // Include the review list template
                  ob_start();
                  include CTRW_PLUGIN_PATH . 'includes/views/public/review-list.php';
                  return ob_get_clean();              
            } else {
                  return '<p>' . __('The review list is currently disabled.', 'wp_cr') . '</p>';
            }     
      }

      // Render the review slider shortcode
      public function ctrw_render_review_slider($atts) {
            // Check if the slider is enabled
            $general_settings = get_option('ctrw_general_settings', array());
            if (isset($general_settings['enable_slider_reviews']) && $general_settings['enable_slider_reviews'] === 'on') {
                  // Include the review slider template
                  ob_start();
                  include CTRW_PLUGIN_PATH . 'includes/views/public/review-slider.php';
                  return ob_get_clean();
            } else {
                  return '<p>' . __('The review slider is currently disabled.', 'wp_cr') . '</p>';
            }
      }


      // Render the review widget shortcode
      public function ctrw_render_review_widget($atts) {
            // Check if the widget is enabled
            $general_settings = get_option('ctrw_general_settings', array());
            if (isset($general_settings['enable_floating_reviews']) && $general_settings['enable_floating_reviews'] === 'on') {
                  
                  // Include the review widget template
                  ob_start();
                  include CTRW_PLUGIN_PATH . 'includes/views/public/review-floating.php';
                  return ob_get_clean();
            } else {
                  return '<p>' . __('The review widget is currently disabled.', 'wp_cr') . '</p>';
            }
      }


      // Handle review submission via AJAX
      public function ctrw_submit_review() {
            // Check nonce for security
            check_ajax_referer('ctrw_review_form_nonce', 'security');   
            // Validate and sanitize form data
            $name = isset($_POST['ctrw_name']) ? sanitize_text_field($_POST['ctrw_name']) : '';
            $email = isset($_POST['ctrw_email']) ? sanitize_email($_POST['ctrw_email']) : '';
            $phone = isset($_POST['ctrw_phone']) ? sanitize_text_field($_POST['ctrw_phone']) : '';
            $website = isset($_POST['ctrw_website']) ? esc_url_raw($_POST['ctrw_website']) : '';
            $city = isset($_POST['ctrw_city']) ? sanitize_text_field($_POST['ctrw_city']) : '';
            $state = isset($_POST['ctrw_state']) ? sanitize_text_field($_POST['ctrw_state']) : '';
            $title = isset($_POST['ctrw_title']) ? sanitize_text_field($_POST['ctrw_title']) : '';
            $review = isset($_POST['ctrw_review']) ? sanitize_textarea_field($_POST['ctrw_review']) : '';
            $rating = isset($_POST['ctrw_rating']) ? intval($_POST['ctrw_rating']) : 0;
            $ctrw_page_id = isset($_POST['ctrw_page_id']) ? intval($_POST['ctrw_page_id']) : 0;
            
            // Validate required fields
            if (empty($name) || empty($email) || empty($review) || $rating <= 0) {
                  wp_send_json_error(array('message' => __('Please fill in all required fields.', 'wp_cr')));
            }     
            // Prepare the review data
            $review_data = array(
                  'name' => $name,
                  'email' => $email,
                  'phone' => $phone,
                  'website' => $website,  
                  'city' => $city,
                  'state' => $state,
                  'title' => $title,
                  'review' => $review,
                  'rating' => $rating,
                  'page_id' => $ctrw_page_id,
                  'date' => current_time('mysql'),
            );   

            // Insert the review into the database
            $result = $this->ctrw_save_review($review_data);
      }
      // Save the review to the database
      public function ctrw_save_review($review_data) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'ctrw_reviews';
            $result = $wpdb->insert($table_name, $review_data);
            return $result !== false;
      }

}


new CTRW_Review_Controller();
?>
