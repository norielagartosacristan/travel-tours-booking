<?php
// Handle booking form submission
function tt_handle_booking_form_submission() {
    if (isset($_POST['tt_booking_submit'])) {
        // Sanitize user inputs
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $tour_id = intval($_POST['tour_id']);
        $guests = intval($_POST['guests']);

        // Insert booking into the database (custom table for bookings could be created)
        global $wpdb;
        $table_name = $wpdb->prefix . 'tour_bookings';
        $wpdb->insert(
            $table_name,
            array(
                'tour_id' => $tour_id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'guests' => $guests,
                'booking_date' => current_time('mysql'),
            )
        );

        // Send email notifications
        $admin_email = get_option('admin_email');
        $subject = 'New Tour Booking';
        $message = "You have a new booking for the tour. \nName: $name\nEmail: $email\nGuests: $guests";
        wp_mail($admin_email, $subject, $message);

        // Confirmation message
        echo '<div class="booking-confirmation">Thank you for your booking! We will contact you shortly.</div>';
    }
}
add_action('wp', 'tt_handle_booking_form_submission');
