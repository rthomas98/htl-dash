<?php

// Shortcode for buyer dashboard
add_shortcode('buyer_dashboard', 'htl_dash_plugin_buyer_dashboard');
function htl_dash_plugin_buyer_dashboard() {
    if (!is_user_logged_in()) {
        return '<p>Please <a href="' . wp_login_url() . '">log in</a> to view your dashboard.</p>';
    }

    $current_user = wp_get_current_user();
    ob_start();
    include HTL_DASH_PLUGIN_PATH . 'templates/buyer/dashboard.php';
    return ob_get_clean();
}
