<?php
/*
Plugin Name: Skill Rating Plugin
Description: Allows users to rate Skills (1–5 stars).
Version: 1.0
Author: Your Name
*/

function srp_enqueue_scripts() {
    wp_enqueue_script('srp-rating', plugin_dir_url(__FILE__) . 'js/rating.js', ['jquery'], null, true);
    wp_localize_script('srp-rating', 'srp_ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('srp_rating_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'srp_enqueue_scripts');

// AJAX handler
function srp_handle_rating() {
    check_ajax_referer('srp_rating_nonce', 'nonce');

    $post_id = intval($_POST['post_id']);
    $rating = intval($_POST['rating']);

    if ($post_id && $rating >= 1 && $rating <= 5) {
        $old_ratings = get_post_meta($post_id, '_srp_ratings', true);
        if (!is_array($old_ratings)) $old_ratings = [];

        $old_ratings[] = $rating;
        update_post_meta($post_id, '_srp_ratings', $old_ratings);

        $average = array_sum($old_ratings) / count($old_ratings);
        wp_send_json_success(['average' => round($average, 2)]);
    }

    wp_send_json_error('Invalid data.');
}
add_action('wp_ajax_srp_submit_rating', 'srp_handle_rating');
add_action('wp_ajax_nopriv_srp_submit_rating', 'srp_handle_rating');

// Shortcode to display rating UI
function srp_rating_shortcode($atts) {
    global $post;

    $ratings = get_post_meta($post->ID, '_srp_ratings', true);
    $average = $ratings ? round(array_sum($ratings) / count($ratings), 2) : "No ratings yet";

    ob_start(); ?>
    <div id="srp-rating" data-postid="<?= $post->ID ?>">
        <p><strong>Average Rating:</strong> <?= $average ?> ⭐</p>
        <label>Rate this Skill:
            <select id="srp-rating-select">
                <option value="">--Select--</option>
                <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
            </select>
        </label>
        <button id="srp-submit-rating">Submit</button>
        <p id="srp-response"></p>
    </div>
    <?php return ob_get_clean();
}
add_shortcode('skill_rating', 'srp_rating_shortcode');
