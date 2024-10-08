<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register the custom post type for Tours
 */
function tt_register_tour_post_type() {
    $labels = array(
        'name'                  => _x('Tours', 'Post Type General Name', 'tt-plugin'),
        'singular_name'         => _x('Tour', 'Post Type Singular Name', 'tt-plugin'),
        'menu_name'             => __('Tours', 'tt-plugin'),
        'name_admin_bar'        => __('Tour', 'tt-plugin'),
        'archives'              => __('Tour Archives', 'tt-plugin'),
        'attributes'            => __('Tour Attributes', 'tt-plugin'),
        'parent_item_colon'     => __('Parent Tour:', 'tt-plugin'),
        'all_items'             => __('All Tours', 'tt-plugin'),
        'add_new_item'          => __('Add New Tour', 'tt-plugin'),
        'add_new'               => __('Add New', 'tt-plugin'),
        'new_item'              => __('New Tour', 'tt-plugin'),
        'edit_item'             => __('Edit Tour', 'tt-plugin'),
        'update_item'           => __('Update Tour', 'tt-plugin'),
        'view_item'             => __('View Tour', 'tt-plugin'),
        'view_items'            => __('View Tours', 'tt-plugin'),
        'search_items'          => __('Search Tour', 'tt-plugin'),
        'not_found'             => __('Not found', 'tt-plugin'),
        'not_found_in_trash'    => __('Not found in Trash', 'tt-plugin'),
        'featured_image'        => __('Featured Image', 'tt-plugin'),
        'set_featured_image'    => __('Set featured image', 'tt-plugin'),
        'remove_featured_image' => __('Remove featured image', 'tt-plugin'),
        'use_featured_image'    => __('Use as featured image', 'tt-plugin'),
        'insert_into_item'      => __('Insert into tour', 'tt-plugin'),
        'uploaded_to_this_item' => __('Uploaded to this tour', 'tt-plugin'),
        'items_list'            => __('Tours list', 'tt-plugin'),
        'items_list_navigation' => __('Tours list navigation', 'tt-plugin'),
        'filter_items_list'     => __('Filter tours list', 'tt-plugin'),
    );

    $args = array(
        'label'                 => __('Tour', 'tt-plugin'),
        'description'           => __('Post Type for Tours', 'tt-plugin'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'excerpt', 'thumbnail'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-palmtree',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('tour', $args);
}
add_action('init', 'tt_register_tour_post_type', 0);
