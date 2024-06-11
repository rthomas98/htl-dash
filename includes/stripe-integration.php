<?php

add_action('wp_enqueue_scripts', 'htl_dash_plugin_enqueue_scripts');
function htl_dash_plugin_enqueue_scripts() {
    wp_enqueue_script('stripe-js', 'https://js.stripe.com/v3/');
}

// Helper function to get the appropriate Stripe API key
function htl_dash_get_stripe_api_key() {
    $mode = get_option('htl_dash_stripe_mode', 'test');
    if ($mode === 'live') {
        return get_option('htl_dash_stripe_secret_key_live');
    } else {
        return get_option('htl_dash_stripe_secret_key_test');
    }
}

// Function to check the connection to Stripe
function htl_dash_check_stripe_connection() {
    \Stripe\Stripe::setApiKey(htl_dash_get_stripe_api_key());

    try {
        \Stripe\Account::retrieve();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// AJAX handler to test the Stripe connection
add_action('wp_ajax_htl_dash_test_stripe_connection', 'htl_dash_test_stripe_connection');
function htl_dash_test_stripe_connection() {
    check_ajax_referer('htl_dash_test_connection', 'nonce');

    if (htl_dash_check_stripe_connection()) {
        update_option('htl_dash_stripe_connection_status', 'connected');
        wp_send_json_success(array('message' => __('Connected', 'htl-dash')));
    } else {
        update_option('htl_dash_stripe_connection_status', 'error');
        wp_send_json_error(array('message' => __('Error: Could not connect to Stripe', 'htl-dash')));
    }
}
