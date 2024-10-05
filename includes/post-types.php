<?php
// Register the custom post type for Tours
function tt_register_tour_post_type() {
    $labels = array(
        'name' => 'Tours',
        'singular_name' => 'Tour',
        'add_new' => 'Add New Tour',
        'add_new_item' => 'Add New Tour',
        'edit_item' => 'Edit Tour',
        'new_item' => 'New Tour',
        'all_items' => 'All Tours',
        'view_item' => 'View Tour',
        'search_items' => 'Search Tours',
        'not_found' => 'No tours found',
        'not_found_in_trash' => 'No tours found in trash',
        'menu_name' => 'Tours'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'tours'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-palmtree',
    );

    register_post_type('tour', $args);
}
add_action('init', 'tt_register_tour_post_type');
