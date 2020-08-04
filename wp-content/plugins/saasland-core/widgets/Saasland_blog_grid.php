<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use WP_Query;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



/**
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Saasland_blog_grid extends Widget_Base {

    public function get_name() {
        return 'saasland_blog_grid';
    }

    public function get_title() {
        return __( 'Blog Grid', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-post';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ---------------------------------- Filter Options ------------------------
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Blog Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'show_posts_count', [
                'label' => esc_html__( 'Show Posts Count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 8
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'excerpt_limit_word', [
                'label' => esc_html__( 'Excerpt Limit Word', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 8
            ]
        );

        $this->add_control(
            'read_more', [
                'label' => esc_html__( 'Read More Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More'
            ]
        );

        $this->end_controls_section();

        // Layout
        $this->start_controls_section(
            'grid_opt', [
                'label' => esc_html__( 'Grid Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'grid' => [
                        'title' => __( 'Fixed Grid', 'saasland-core' ),
                        'icon' => 'eicon-gallery-grid',
                    ],
                    'masonry' => [
                        'title' => __( 'Masonry', 'saasland-core' ),
                        'icon' => 'eicon-gallery-masonry',
                    ],
                ],
                'default' => 'grid',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        global $wp_query;
        global $paged;
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query->query('showposts='.$settings['show_posts_count'].'&post_type=post'.'&paged='.$paged);
        $excerpt_limit_word = isset($settings['excerpt_limit_word']) ? $settings['excerpt_limit_word'] : 14;

        if( $settings['layout'] == 'grid' ) {
            include 'part-blog-grid.php';
        }

        if( $settings['layout'] == 'masonry' ) {
            include 'part-blog-masonry.php';
        }
    }
}