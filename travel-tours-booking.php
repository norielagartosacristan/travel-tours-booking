<?php
/*
Plugin Name: Travel & Tours Booking Plugin
Description: A simple booking plugin for Travel and Tours websites.
Version: 1.0
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) exit;

// Include essential files
include_once plugin_dir_path(__FILE__) . 'includes/post-types.php';  // Register post types (tours)
include_once plugin_dir_path(__FILE__) . 'includes/booking-form.php'; // Booking form functions
include_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';   // Shortcodes for displaying forms

// Register activation hook
register_activation_hook(__FILE__, 'tt_booking_activate_plugin');

// Activation function
function tt_booking_activate_plugin() {
    // Flush rewrite rules after registering custom post types
    tt_register_tour_post_type();
    flush_rewrite_rules();
}

