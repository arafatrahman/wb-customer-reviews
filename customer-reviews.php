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

