<?php
function skillswap_enqueue_styles() {
    wp_enqueue_style('skillswap-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'skillswap_enqueue_styles');

function skillswap_register_menu() {
    register_nav_menu('primary', 'Primary Menu');
}
add_action('after_setup_theme', 'skillswap_register_menu');
