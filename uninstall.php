<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}

// Clean up plugin data
// Example: Delete custom post types and their meta
$custom_post_types = array('course', 'workshop');

foreach ($custom_post_types as $post_type) {
    $posts = get_posts(array('post_type' => $post_type, 'numberposts' => -1));

    foreach ($posts as $post) {
        wp_delete_post($post->ID, true);
    }
}

// Example: Delete user meta data
global $wpdb;
$wpdb->query("DELETE FROM $wpdb->usermeta WHERE meta_key = 'favorite_course'");
