<?php
// Booking form shortcode
function tt_booking_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'tour_id' => 0,
    ), $atts);

    $tour_id = intval($atts['tour_id']);
    ob_start();
    ?>
    <form method="post" action="">
        <input type="hidden" name="tour_id" value="<?php echo esc_attr($tour_id); ?>">
        <p>
            <label for="name">Full Name:</label>
            <input type="text" name="name" required>
        </p>
        <p>
            <label for="email">Email Address:</label>
            <input type="email" name="email" required>
        </p>
        <p>
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required>
        </p>
        <p>
            <label for="guests">Number of Guests:</label>
            <input type="number" name="guests" required min="1">
        </p>
        <p>
            <input type="submit" name="tt_booking_submit" value="Book Now">
        </p>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('tt_booking_form', 'tt_booking_form_shortcode');
