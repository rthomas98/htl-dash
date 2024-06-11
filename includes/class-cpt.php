<?php

class HTL_Dash_CPT {

    public function __construct() {
        add_action('init', array($this, 'register_cpt'));
    }

    public function register_cpt() {
        $labels = array(
            'name' => _x('Courses', 'Post Type General Name', 'htl-dash'),
            'singular_name' => _x('Course', 'Post Type Singular Name', 'htl-dash'),
            // Other labels...
        );

        $args = array(
            'label' => __('Course', 'htl-dash'),
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
            'public' => true,
            'show_in_menu' => true,
            'capability_type' => 'post',
            'rewrite' => array('slug' => 'courses'),
            'show_in_rest' => true,
            'labels' => $labels,
        );

        register_post_type('course', $args);

        // Register Workshops similarly...
    }
}

new HTL_Dash_CPT();
