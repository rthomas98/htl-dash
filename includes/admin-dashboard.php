<?php

// Add admin menu
add_action('admin_menu', 'htl_dash_plugin_admin_menu');
function htl_dash_plugin_admin_menu() {
    add_menu_page(
        'Course Dashboard',
        'Courses',
        'manage_options',
        'course-dashboard',
        'htl_dash_plugin_dashboard_page',
        'dashicons-welcome-learn-more',
        6
    );

    add_submenu_page(
        'course-dashboard',
        'HTL Dash Settings',
        'Settings',
        'manage_options',
        'htl-dash-settings',
        'htl_dash_plugin_settings_page'
    );
}

// Admin dashboard page
function htl_dash_plugin_dashboard_page() {
    include HTL_DASH_PLUGIN_PATH . 'templates/admin/dashboard.php';
}

// Settings page
function htl_dash_plugin_settings_page() {
    include HTL_DASH_PLUGIN_PATH . 'templates/admin/settings.php';
}

// Register settings
add_action('admin_init', 'htl_dash_register_settings');
function htl_dash_register_settings() {
    register_setting('htl_dash_settings_group', 'htl_dash_stripe_secret_key_live');
    register_setting('htl_dash_settings_group', 'htl_dash_stripe_publishable_key_live');
    register_setting('htl_dash_settings_group', 'htl_dash_stripe_secret_key_test');
    register_setting('htl_dash_settings_group', 'htl_dash_stripe_publishable_key_test');
    register_setting('htl_dash_settings_group', 'htl_dash_stripe_mode');
}
