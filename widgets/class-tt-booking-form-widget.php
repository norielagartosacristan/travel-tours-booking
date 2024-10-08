<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TT_Booking_Form_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tt_booking_form';
    }

    public function get_title() {
        return __( 'Booking Form', 'tt-plugin' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        // Content Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'tt-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Tour Selection
        $this->add_control(
            'tour_id',
            [
                'label' => __( 'Tour', 'tt-plugin' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_tour_options(),
                'default' => get_the_ID(),
            ]
        );

        $this->end_controls_section();

        // Style Controls
        // Add style controls as needed
    }

    private function get_tour_options() {
        $tours = get_posts( [
            'post_type' => 'tour',
            'posts_per_page' => -1,
        ] );

        $options = [];
        foreach ( $tours as $tour ) {
            $options[ $tour->ID ] = $tour->post_title;
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tour_id = $settings['tour_id'];

        // Optionally, you can pass additional data to the form based on custom fields
        echo do_shortcode( '[tt_booking_form tour_id="' . $tour_id . '"]' );
    }

    protected function _content_template() {
        // Optional: For live editing preview (using JS)
    }
}
