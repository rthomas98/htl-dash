<?php
/*
Plugin Name: HTL Dash
Description: A plugin to sell courses and workshops via Stripe.
Version: 1.0
Author: Your Name
Text Domain: htl-dash
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('HTL_DASH_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('HTL_DASH_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load the Composer autoloader
require_once HTL_DASH_PLUGIN_PATH . 'vendor/autoload.php';

// Include necessary files
require_once HTL_DASH_PLUGIN_PATH . 'includes/admin-dashboard.php';
require_once HTL_DASH_PLUGIN_PATH . 'includes/buyer-dashboard.php';
require_once HTL_DASH_PLUGIN_PATH . 'includes/stripe-integration.php';
require_once HTL_DASH_PLUGIN_PATH . 'includes/class-cpt.php';
require_once HTL_DASH_PLUGIN_PATH . 'includes/class-user-manager.php';

// Load the .env file
if (file_exists(HTL_DASH_PLUGIN_PATH . '.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(HTL_DASH_PLUGIN_PATH);
    $dotenv->load();
}

// Enqueue scripts
add_action('admin_enqueue_scripts', 'htl_dash_admin_enqueue_scripts');
function htl_dash_admin_enqueue_scripts() {
    wp_enqueue_script('htl-dash-js', HTL_DASH_PLUGIN_URL . 'assets/js/script.js', array('jquery'), null, true);
    wp_localize_script('htl-dash-js', 'htlDash', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('htl_dash_test_connection')
    ));
}

// Activation hook
register_activation_hook(__FILE__, 'htl_dash_plugin_activate');
function htl_dash_plugin_activate() {
    // Run code on activation
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'htl_dash_plugin_deactivate');
function htl_dash_plugin_deactivate() {
    // Run code on deactivation
}

// Load text domain for translations
add_action('plugins_loaded', 'htl_dash_plugin_load_textdomain');
function htl_dash_plugin_load_textdomain() {
    load_plugin_textdomain('htl-dash', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
