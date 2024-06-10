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
}

// Admin dashboard page
function htl_dash_plugin_dashboard_page() {
    include HTL_DASH_PLUGIN_PATH . 'templates/admin/dashboard.php';
}
