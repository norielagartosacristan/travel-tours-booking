<?php
/*
Plugin Name: Travel & Tours Booking Plugin
Description: A comprehensive booking plugin for Travel and Tours websites.
Version: 1.1
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) exit;

// Include essential files
include_once plugin_dir_path(__FILE__) . 'includes/post-types.php';           // Register post types (tours)
include_once plugin_dir_path(__FILE__) . 'includes/booking-form.php';         // Booking form functions
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';           // Shortcodes
include_once plugin_dir_path(__FILE__) . 'includes/elementor-widgets.php';    // Elementor integration
include_once plugin_dir_path(__FILE__) . 'admin/admin-bookings.php';          // Admin page for managing bookings
include_once plugin_dir_path(__FILE__) . 'admin/admin-meta-boxes.php';        // Admin meta boxes for custom fields

// Register activation hook
register_activation_hook(__FILE__, 'tt_booking_activate_plugin');

// Activation function
function tt_booking_activate_plugin() {
    // Register custom post types
    tt_register_tour_post_type();
    
    // Create booking table
    tt_create_booking_table();
    
    // Flush rewrite rules after registering custom post types
    flush_rewrite_rules();
}
