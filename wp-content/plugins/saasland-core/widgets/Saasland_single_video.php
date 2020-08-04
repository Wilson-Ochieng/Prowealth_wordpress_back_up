<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



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
class Saasland_single_video extends Widget_Base {

    public function get_name() {
        return 'saasland_single_video';
    }

    public function get_title() {
        return __( 'Featured Video', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {


        // -------------------- Featured Video ------------------------------
        $this->start_controls_section(
            'video_sec', [
                'label' => esc_html__( 'Featured Video', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'video_url', [
                'label' => esc_html__( 'Video URL', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $this->add_control(
            'bg_title', [
                'label' => esc_html__( 'Video Background Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'SaasLand'
            ]
        );

        $this->add_control(
            'video_overlay', [
                'label' => esc_html__( 'Overlay Color 01', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'video_overlay2', [
                'label' => esc_html__( 'Overlay Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'video_image', [
                'label' => esc_html__( 'Video Poster Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'top_ornament', [
                'label' => esc_html__( 'Top Ornament', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/leaf.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'btm_ornament', [
                'label' => esc_html__( 'Bottom Ornament', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/cup.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $video_image = '';
        if(!empty($settings['video_image']['url'] && !empty($settings['video_overlay']))) {
            $video_image = "style='background: linear-gradient(50deg, {$settings['video_overlay']} 0%, {$settings['video_overlay2']} 100%), url({$settings['video_image']['url']}) no-repeat; background-size: cover;'";
        }
        ?>
        <section class="video_area">
            <div class="container">
                <div class="video_content">
                    <div class="video_info" <?php echo $video_image; ?>>
                        <div class="ovarlay_color"></div>
                        <a class="popup-youtube video_icon" href="<?php echo esc_url($settings['video_url']) ?>"><i class="arrow_triangle-right"></i></a>
                        <?php echo (!empty($settings['bg_title'])) ? '<h2>'.$settings['bg_title'].'</h2>' : ''; ?>
                    </div>
                    <?php if(!empty($settings['top_ornament']['url'])) : ?>
                        <img class="video_leaf" src="<?php echo esc_url($settings['top_ornament']['url']) ?>" alt="<?php echo esc_attr($settings['bg_title']); ?>">
                    <?php endif; ?>
                    <?php if(!empty($settings['btm_ornament']['url'])) : ?>
                        <img class="cup" src="<?php echo esc_url($settings['btm_ornament']['url']) ?>" alt="<?php echo esc_attr($settings['bg_title']) ?>">
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}