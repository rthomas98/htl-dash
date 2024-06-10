<?php

// Include the Stripe PHP library
require_once 'path/to/stripe-php/init.php';

add_action('wp_enqueue_scripts', 'htl_dash_plugin_enqueue_scripts');
function htl_dash_plugin_enqueue_scripts() {
    wp_enqueue_script('stripe-js', 'https://js.stripe.com/v3/');
    wp_enqueue_script('htl-dash-js', HTL_DASH_PLUGIN_URL . 'assets/js/script.js', array('jquery', 'stripe-js'), null, true);
}

// Create a checkout session
add_action('wp_ajax_create_checkout_session', 'htl_dash_plugin_create_checkout_session');
add_action('wp_ajax_nopriv_create_checkout_session', 'htl_dash_plugin_create_checkout_session');
function htl_dash_plugin_create_checkout_session() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'create_checkout_session')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
    }

    \Stripe\Stripe::setApiKey('your_stripe_secret_key');

    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Course or Workshop Name',
                    ],
                    'unit_amount' => 1000, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => site_url('/success'),
            'cancel_url' => site_url('/cancel'),
        ]);

        wp_send_json_success(['id' => $session->id]);
    } catch (Exception $e) {
        wp_send_json_error(['message' => $e->getMessage()]);
    }
}
