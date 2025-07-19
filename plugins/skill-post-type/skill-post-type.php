<?php
/*
Plugin Name: Skill Post Type
Description: Registers a custom post type for skills.
Version: 1.0
Author: Your Name
*/

function skillswap_register_skill_post_type() {
    register_post_type('skill', array(
    'labels' => array(
        'name' => __('Skills'),
        'singular_name' => __('Skill')
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
    'rewrite' => array('slug' => 'skills'),
    'show_in_rest' => true, // important for Gutenberg
));
}
add_action('init', 'skillswap_register_skill_post_type');
