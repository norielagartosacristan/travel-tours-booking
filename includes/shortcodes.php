<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Booking Form Shortcode
 */
function tt_booking_form_shortcode($atts) {
    $atts = shortcode_atts(array(
        'tour_id' => 0,
    ), $atts, 'tt_booking_form');

    $tour_id = intval($atts['tour_id']);
    if ($tour_id <= 0) {
        return '<p>' . __('Invalid tour selected.', 'tt-plugin') . '</p>';
    }

    ob_start();
    ?>
    <form method="post" action="">
        <?php wp_nonce_field('tt_booking_form', 'tt_booking_nonce'); ?>
        <input type="hidden" name="tour_id" value="<?php echo esc_attr($tour_id); ?>">
        <p>
            <label for="name"><?php _e('Full Name:', 'tt-plugin'); ?></label><br>
            <input type="text" name="name" id="name" required class="widefat" />
        </p>
        <p>
            <label for="email"><?php _e('Email Address:', 'tt-plugin'); ?></label><br>
            <input type="email" name="email" id="email" required class="widefat" />
        </p>
        <p>
            <label for="phone"><?php _e('Phone Number:', 'tt-plugin'); ?></label><br>
            <input type="text" name="phone" id="phone" required class="widefat" />
        </p>
        <p>
            <label for="guests"><?php _e('Number of Guests:', 'tt-plugin'); ?></label><br>
            <input type="number" name="guests" id="guests" required min="1" class="widefat" />
        </p>
        <p>
            <input type="submit" name="tt_booking_submit" value="<?php _e('Book Now', 'tt-plugin'); ?>" class="button button-primary" />
        </p>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('tt_booking_form', 'tt_booking_form_shortcode');
