<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TT_Tour_Listing_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tt_tour_listing';
    }

    public function get_title() {
        return __( 'Tour Listing', 'tt-plugin' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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

        // Number of Tours to Display
        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Number of Tours to Display', 'tt-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        // Add more controls as needed

        $this->end_controls_section();

        // Style Controls
        // You can add style controls here to allow customization of the appearance
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['posts_per_page'];

        // Query the tours
        $args = [
            'post_type' => 'tour',
            'posts_per_page' => $posts_per_page,
        ];

        $tours = new \WP_Query( $args );

        if ( $tours->have_posts() ) {
            echo '<div class="tt-tour-listing">';
            while ( $tours->have_posts() ) {
                $tours->the_post();
                ?>
                <div class="tt-tour-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'medium' );
                        } ?>
                        <h3><?php the_title(); ?></h3>
                    </a>
                    <?php the_excerpt(); ?>
                    <p><?php echo __('Price:', 'tt-plugin') . ' ' . get_post_meta(get_the_ID(), '_tt_tour_price', true); ?></p>
                    <p><?php echo __('Duration:', 'tt-plugin') . ' ' . get_post_meta(get_the_ID(), '_tt_tour_duration', true) . ' ' . __('Days', 'tt-plugin'); ?></p>
                    <p><?php echo __('Location:', 'tt-plugin') . ' ' . get_post_meta(get_the_ID(), '_tt_tour_location', true); ?></p>
                </div>
                <?php
            }
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>' . __( 'No tours found.', 'tt-plugin' ) . '</p>';
        }
    }

    protected function _content_template() {
        // Optional: For live editing preview (using JS)
    }
}
