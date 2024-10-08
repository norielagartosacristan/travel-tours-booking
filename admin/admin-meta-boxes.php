<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Meta Boxes for Tour Post Type
 */
function tt_register_custom_meta_boxes() {
    add_meta_box(
        'tt_tour_details_meta_box',        // Unique ID
        __('Tour Details', 'tt-plugin'),   // Box title
        'tt_tour_details_meta_box_html',   // Content callback, must be of type callable
        'tour',                            // Post type
        'normal',                          // Context
        'high'                             // Priority
    );
}
add_action('add_meta_boxes', 'tt_register_custom_meta_boxes');

/**
 * HTML for Tour Details Meta Box
 */
function tt_tour_details_meta_box_html($post) {
    // Add a nonce field for security
    wp_nonce_field('tt_save_tour_details', 'tt_tour_details_nonce');

    // Retrieve existing values from the database
    $tour_price = get_post_meta($post->ID, '_tt_tour_price', true);
    $tour_duration = get_post_meta($post->ID, '_tt_tour_duration', true);
    $tour_location = get_post_meta($post->ID, '_tt_tour_location', true);
    ?>

    <p>
        <label for="tt_tour_price"><?php _e('Tour Price', 'tt-plugin'); ?></label><br>
        <input type="text" name="tt_tour_price" id="tt_tour_price" value="<?php echo esc_attr($tour_price); ?>" class="widefat" />
    </p>
    <p>
        <label for="tt_tour_duration"><?php _e('Duration (Days)', 'tt-plugin'); ?></label><br>
        <input type="number" name="tt_tour_duration" id="tt_tour_duration" value="<?php echo esc_attr($tour_duration); ?>" class="widefat" min="1" />
    </p>
    <p>
        <label for="tt_tour_location"><?php _e('Location', 'tt-plugin'); ?></label><br>
        <input type="text" name="tt_tour_location" id="tt_tour_location" value="<?php echo esc_attr($tour_location); ?>" class="widefat" />
    </p>

    <?php
}

/**
 * Save Tour Details Meta Box Data
 */
function tt_save_tour_details_meta_box_data($post_id) {
    // Check if our nonce is set.
    if (!isset($_POST['tt_tour_details_nonce'])) {
        return;
    }

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($_POST['tt_tour_details_nonce'], 'tt_save_tour_details')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (isset($_POST['post_type']) && 'tour' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    } else {
        return;
    }

    // Sanitize and save Tour Price
    if (isset($_POST['tt_tour_price'])) {
        $tour_price = sanitize_text_field($_POST['tt_tour_price']);
        update_post_meta($post_id, '_tt_tour_price', $tour_price);
    }

    // Sanitize and save Tour Duration
    if (isset($_POST['tt_tour_duration'])) {
        $tour_duration = intval($_POST['tt_tour_duration']);
        update_post_meta($post_id, '_tt_tour_duration', $tour_duration);
    }

    // Sanitize and save Tour Location
    if (isset($_POST['tt_tour_location'])) {
        $tour_location = sanitize_text_field($_POST['tt_tour_location']);
        update_post_meta($post_id, '_tt_tour_location', $tour_location);
    }
}
add_action('save_post', 'tt_save_tour_details_meta_box_data');
