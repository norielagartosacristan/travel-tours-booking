<?php
// Function to register admin menu for Bookings
function tt_register_admin_menu() {
    add_menu_page(
        'Bookings',         // Page title
        'Bookings',         // Menu title
        'manage_options',   // Capability
        'tt-bookings',      // Menu slug
        'tt_display_bookings',// Callback function to display the bookings
        'dashicons-tickets',// Icon for the menu
        20                  // Position in the admin menu
    );
}
add_action('admin_menu', 'tt_register_admin_menu');

// Function to display bookings in the admin page
function tt_display_bookings() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tour_bookings';
    $bookings = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap"><h1>Tour Bookings</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Guests</th><th>Date</th></tr></thead>';
    echo '<tbody>';
    if ($bookings) {
        foreach ($bookings as $booking) {
            echo '<tr>';
            echo '<td>' . esc_html($booking->id) . '</td>';
            echo '<td>' . esc_html($booking->name) . '</td>';
            echo '<td>' . esc_html($booking->email) . '</td>';
            echo '<td>' . esc_html($booking->phone) . '</td>';
            echo '<td>' . esc_html($booking->guests) . '</td>';
            echo '<td>' . esc_html($booking->booking_date) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No bookings found.</td></tr>';
    }
    echo '</tbody></table></div>';
}
?>