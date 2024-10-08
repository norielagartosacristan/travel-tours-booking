<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Plugin;

/**
 * Check if Elementor is active and register widgets
 */
function tt_register_elementor_widgets() {
    // Check if Elementor is active
    if (did_action('elementor/loaded')) {
        // Include the widget files
        require_once plugin_dir_path(__FILE__) . '../widgets/class-tt-tour-listing-widget.php';
        require_once plugin_dir_path(__FILE__) . '../widgets/class-tt-booking-form-widget.php';

        // Register the widgets
        Plugin::instance()->widgets_manager->register_widget_type(new TT_Tour_Listing_Widget());
        Plugin::instance()->widgets_manager->register_widget_type(new TT_Booking_Form_Widget());
    }
}
add_action('elementor/widgets/widgets_registered', 'tt_register_elementor_widgets');
