<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle booking form submission
 */
function tt_handle_booking_form_submission() {
    if (isset($_POST['tt_booking_submit'])) {
        // Verify nonce for security
        if (!isset($_POST['tt_booking_nonce']) || !wp_verify_nonce($_POST['tt_booking_nonce'], 'tt_booking_form')) {
            return;
        }

        // Sanitize user inputs
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $tour_id = intval($_POST['tour_id']);
        $guests = intval($_POST['guests']);

        // Validate required fields
        if (empty($name) || empty($email) || empty($phone) || empty($tour_id) || empty($guests)) {
            echo '<div class="booking-error">' . __('Please fill in all required fields.', 'tt-plugin') . '</div>';
            return;
        }

        // Insert booking into the database
        global $wpdb;
        $table_name = $wpdb->prefix . 'tour_bookings';
        $wpdb->insert(
            $table_name,
            array(
                'tour_id'      => $tour_id,
                'name'         => $name,
                'email'        => $email,
                'phone'        => $phone,
                'guests'       => $guests,
                'booking_date' => current_time('mysql'),
                'status'       => 'Pending', // Default status
            ),
            array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
                '%s',
            )
        );

        // Send email notifications
        $admin_email = get_option('admin_email');
        $subject = __('New Tour Booking', 'tt-plugin');
        $message = sprintf(
            __('You have a new booking for the tour "%s".\nName: %s\nEmail: %s\nPhone: %s\nGuests: %d', 'tt-plugin'),
            get_the_title($tour_id),
            $name,
            $email,
            $phone,
            $guests
        );
        wp_mail($admin_email, $subject, $message);

        // Optionally, send confirmation email to the user
        $user_subject = __('Booking Confirmation', 'tt-plugin');
        $user_message = sprintf(
            __('Thank you, %s, for booking the tour "%s". We will contact you shortly.', 'tt-plugin'),
            $name,
            get_the_title($tour_id)
        );
        wp_mail($email, $user_subject, $user_message);

        // Confirmation message
        echo '<div class="booking-confirmation">' . __('Thank you for your booking! We will contact you shortly.', 'tt-plugin') . '</div>';
    }
}
add_action('wp', 'tt_handle_booking_form_submission');
