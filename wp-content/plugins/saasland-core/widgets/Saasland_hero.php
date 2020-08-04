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
class Saasland_hero extends Widget_Base {

    public function get_name() {
        return 'saasland-hero';
    }

    public function get_title() {
        return __( 'Hero Section', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'hero_content',
            [
                'label' => __( 'Hero content', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Background Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__('Style One (Mail)', 'saasland-core'),
                    'style_02' => esc_html__('Style Two (Digital Marketing)', 'saasland-core'),
                    'style_03' => esc_html__('Style Three (Cloud)', 'saasland-core'),
                    'style_04' => esc_html__('Style Four (Dark)', 'saasland-core'),
                    'style_05' => esc_html__('Style Five (Startup)', 'saasland-core'),
                    'style_06' => esc_html__('Style Six (Payment processing)', 'saasland-core'),
                    'style_07' => esc_html__('Style Seven (HR Management)', 'saasland-core'),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Best way to chat to your customers using slack.'
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End Hero content


        // -------------------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage1_sec', [
                'label' => __( 'Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_07']
                ]
            ]
        );

        $this->add_control(
            'fimage1', [
                'label' => esc_html__( 'Upload the featured image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/women.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'fimage1_size', [
                'label' => __( 'Image max width', 'saasland-core' ),
                'description' => esc_html__('Default image width is 100% and height is auto. Input the size in pixel unit.', ''),
                'type' => Controls_Manager::NUMBER,
                'size_units' => [ 'px', '%', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mobile_img .women_img' => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .stratup_app_screen .phone' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fimage1_position', [
                'label' => __( 'Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mobile_img .women_img' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
                'condition' => [
                    'style' => ['style_01']
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image



        /// Second Featured image
        ///
        $this->start_controls_section(
            'fimage2_sec', [
                'label' => __( 'Second Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_07']
                ]
            ]
        );

        $this->add_control(
            'fimage2', [
                'label' => esc_html__( 'Upload the image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/mobile.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image



        // -------------------------------------------------- Featured image 1 ------------------------------
        $this->start_controls_section(
            'fimage3_sec', [
                'label' => __( 'Featured image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03', 'style_04', 'style_05', 'style_06']
                ]
            ]
        );

        $this->add_control(
            'fimage3', [
                'label' => esc_html__( 'The Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/banner_img.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section(); // End Featured image


        /// ------------------------------ Logos ------------------------------
        $this->start_controls_section(
            'btm_logos', [
                'label' => __( 'Bottom Logos', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02']
                ]
            ]
        );

        $this->add_control(
            'logos', [
                'label' => esc_html__( 'Upload Logos', 'saasland-core' ),
                'type' => Controls_Manager::GALLERY,
            ]
        );

        $this->end_controls_section(); // End Featured image


        /// --------------------  Buttons ----------------------------------
        $this->start_controls_section(
            'buttons_sec',
            [
                'label' => __( 'Buttons', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $repeater->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $repeater->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $repeater->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );

        $repeater->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        /// Hover Button Style
        $repeater->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );

        $repeater->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $repeater->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '.header_area.navbar_fixed {{WRAPPER}} .nav_right_btn {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}}',
                )
            ]
        );

        $repeater->end_controls_tab();

        // Buttons repeater field
        $this->add_control(
            'buttons', [
                'label' => __( 'Create buttons', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ btn_title }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'is_play_btn',
            [
                'label' => __( 'Play Button', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => ['style_03', 'style_07']
                ]
            ]
        );

        $this->add_control(
            'play_btn_title', [
                'label' => __( 'Play Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Watch Video',
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_url', [
                'label' => __( 'Video URL', 'saasland-core' ),
                'description' => __( 'Enter here a YouTube video URL', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'play_btn_color', [
                'label' => __( 'Play Button Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .video_btn .icon, {{WRAPPER}} .video_btn span:before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .video_btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} a.popup-youtube.btn_six.slider_btn:hover' => 'background-color: {{VALUE}}; color: #fff;',
                    '{{WRAPPER}} a.popup-youtube.btn_six.slider_btn' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                ),
                'condition' => [
                    'is_play_btn' => 'yes'
                ]
            ]
        );


        $this->end_controls_section(); // End Buttons



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .l_height60' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_700.t_color3.mb_40' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_500.f_size_50.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_size_40.w_color.mb-0' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .l_height50.w_color.mb_20' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_700.f_size_50.w_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_prefix',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .l_height50.w_color.mb_20,
                {{WRAPPER}} .l_height60,
                {{WRAPPER}} .f_700.t_color3.mb_40,
                {{WRAPPER}} .f_500.f_size_50.w_color,
                {{WRAPPER}} .f_size_40.w_color.mb-0,
                {{WRAPPER}} .f_700.f_size_50.w_color
                ',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(), [
                'name' => 'text_shadow_prefix',
                'selector' => '
                    {{WRAPPER}} .l_height60,
                    {{WRAPPER}} .l_height50.w_color.mb_20,
                    {{WRAPPER}} .f_700.t_color3.mb_40,
                    {{WRAPPER}} .f_500.f_size_50.w_color,
                    {{WRAPPER}} .f_size_40.w_color.mb-0,
                    {{WRAPPER}} .f_700.f_size_50.w_color
                    ',
            ]
        );

        $this->end_controls_section();



        //------------------------------ Style Subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Style Subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .startup_content_three p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_300.l_height28' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_banner_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saas_banner_content.text-center p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .payment_banner_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                {{WRAPPER}} .slider_content p,
                {{WRAPPER}} .startup_content_three p,
                {{WRAPPER}} .f_300.l_height28,
                {{WRAPPER}} .software_banner_content p,
                {{WRAPPER}} .saas_banner_content.text-center p,
                {{WRAPPER}} .payment_banner_content p
                ',
            ]
        );

        $this->end_controls_section();



        //------------------------------ Style Gradient Background Section ------------------------------
        $this->start_controls_section(
            'background_style',
            [
                'label' => esc_html__( 'Background Gradient Color', 'rogan-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_image_stl2', [
                'label' => esc_html__( 'Background Shape Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/banner_bg_stl2.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_02'],
                ]
            ]
        );

        $this->add_control(
            'section_color_left', [
                'label'     => esc_html__('Background Color', 'saasland-core'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07'],
                ]
            ]
        );

        $this->add_control(
            'section_color_right', [
                'label'     => esc_html__('Background Color 02', 'saasland-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '.slider_area'      => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '.saas_banner_area' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '.agency_banner_area_two' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '.payment_banner_area' => 'background-image: -webkit-linear-gradient(40deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                    '.software_banner_area' => 'background: -webkit-linear-gradient( 140deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07'],
                ]
            ]
        );

        $this->end_controls_section();

         //------------------------------ Style Subtitle ------------------------------
         $this->start_controls_section(
            'style_bg_shape_sec', [
                'label' => __( 'Background Right Corner Shape', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_05',
                ]
            ]
        );

        $this->add_control(
            'shape_color', [
                'label' => __( 'Shape Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dot_shap' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shape1_position', [
                'label' => __( 'Shape One Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => 'px', 
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.one' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->add_control(
            'shape2_position', [
                'label' => __( 'Shape Two Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => 'px', 
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.two' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->add_control(
            'shape3_position', [
                'label' => __( 'Shape Three Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dot_shap.three' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'isLinked' => false
                ],
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Shape one gradient ------------------------------
        $this->start_controls_section(
            'style_bg_gradient_sec', [
                'label' => __( 'Background Gradient Shape One', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06',
                ]
            ]
        );

        $this->add_control(
            'shape_bg_color', [
                'label' => esc_html__( 'Color One', 'rogan-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );
    
        $this->add_control(
            'shape_bg_color2', [
                'label' => esc_html__( 'Color Two', 'rogan-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .payment_banner_area .shape' => 'background-image: -webkit-linear-gradient(-57deg, {{shape_bg_color2.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_section();

        //------------------------------ Style Shape Two gradient ------------------------------
        $this->start_controls_section(
            'style_bg_gradient_sec2', [
                'label' => __( 'Background Gradient Shape Two', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_06',
                ]
            ]
        );

        $this->add_control(
            'shape2_bg_color', [
                'label' => esc_html__( 'Color One', 'rogan-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );
    
        $this->add_control(
            'shape2_bg_color2', [
                'label' => esc_html__( 'Color Two', 'rogan-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .payment_banner_area .shape.two' => 'background-image: -webkit-linear-gradient(-75deg, {{shape2_bg_color2.VALUE}} 0%, {{VALUE}} 100%);',
                ],
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {

        $settings = $this->get_settings();
        $buttons = $settings['buttons'];
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        if($settings['style'] == 'style_01') {
            ?>
            <section class="slider_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 d-flex align-items-center">
                            <div class="slider_content">
                                <?php if(!empty($settings['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_p f_700 f_size_40 l_height60"> <?php echo wp_kses_post($settings['title']); ?> </<?php echo $title_tag;  ?>>
                                <?php endif; ?>
                                <?php if(!empty($settings['subtitle'])) : ?>
                                    <p class="f_300 l_height28 mt_30"> <?php echo wp_kses_post(wpautop($settings['subtitle'])); ?> </p>
                                <?php endif; ?>
                                <?php
                                foreach ($buttons as $button) {
                                    echo "<a href='{$button['btn_url']['url']}' class='slider_btn btn_hover mt_30 elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mobile_img">
                                <?php if(!empty($settings['fimage1']['url'])) : ?>
                                    <div class="img">
                                        <img class="women_img leaf wow fadeInDown" data-wow-delay="0.4s" src="<?php echo esc_url($settings['fimage1']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['fimage2']['url'])) : ?>
                                    <img class="mobile wow fadeInRight" data-wow-delay="0.1s" src="<?php echo esc_url($settings['fimage2']['url']) ?>" alt="<?php echo esc_attr($settings['subtitle']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="leaf l_left" src="<?php echo plugins_url('images/shape_02.png', __FILE__) ?>" alt="">
                <img class="leaf l_right" src="<?php echo plugins_url('images/shape_03.png', __FILE__) ?>" alt="">
                <img class="middle_shape" src="<?php echo plugins_url('images/shape_01.png', __FILE__) ?>" alt="">
                <img class="bottom_shoape" src="<?php echo plugins_url('images/shape.png', __FILE__) ?>" alt="">
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_02') {
            ?>
            <section class="agency_banner_area bg_color">
                <img class="banner_shap" src="<?php echo esc_url($settings['bg_image_stl2']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                <div class="container custom_container">
                    <div class="row">
                        <div class="col-lg-5 d-flex align-items-center">
                            <div class="agency_content">

                                <?php if(!empty($settings['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_700 t_color3 mb_40 wow fadeInLeft" data-wow-delay="0.3s">
                                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>

                                <?php if(!empty($settings['subtitle'])) : ?>
                                    <p class="f_300 l_height28 wow fadeInLeft" data-wow-delay="0.4s">
                                        <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                                    </p>
                                <?php endif; ?>

                                <div class="action_btn d-flex align-items-center mt_60">
                                    <?php
                                    $i = 0;
                                    foreach ($buttons as $button) {
                                        ++$i;
                                        $strip_class = ($i % 2 == 1) ? 'btn_hover agency_banner_btn' : 'agency_banner_btn_two';
                                        $strip_anim = ($i % 2 == 1) ? '0.5' : '0.7';
                                        echo "<a " .
                                                "href='{$button['btn_url']['url']}' " .
                                                "data-wow-delay='".$strip_anim."s'" .
                                                "class='$strip_class wow fadeInLeft elementor-repeater-item-{$button['_id']}'> " .
                                                "{$button['btn_title']} " .
                                            "</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 text-right">
                            <?php echo wp_get_attachment_image($settings['fimage1']['id'], 'full', array('class' => 'protype_img wow fadeInRight', 'data-wow-delay' => '0.3s')) ?>
                        </div>
                    </div>
                    <div class="partner_logo">
                        <?php
                        if(!empty($settings['logos'])) :
                        $i = 0.2;
                        foreach ($settings['logos'] as $icon) {
                            ?> <div class="p_logo_item wow fadeInLeft" data-wow-delay="<?php echo esc_attr($i) ?>s"> <?php
                                echo '<a href="#"> '.wp_get_attachment_image($icon['id'], 'full').' </a>';
                            ?> </div> <?php
                            $i = $i + 0.1;
                        }
                        endif;
                        ?>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_03') {
            ?>
            <section class="software_banner_area d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="software_banner_content">
                                <?php if(!empty($settings['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_500 f_size_50 w_color wow fadeInLeft" data-wow-delay="0.2s">
                                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>
                                <?php if(!empty($settings['subtitle'])) : ?>
                                    <p class="w_color f_size_18 l_height30 mt_30 wow fadeInLeft" data-wow-delay="0.4s">
                                        <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                                    </p>
                                <?php endif; ?>
                                <div class="action_btn d-flex align-items-center mt_40 wow fadeInLeft" data-wow-delay="0.6s">
                                    <?php
                                    foreach ($buttons as $button) {
                                        echo "<a href='{$button['btn_url']['url']}' class='software_banner_btn elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                                    }
                                    ?>
                                    <?php
                                    if(!empty($settings['is_play_btn'] == 'yes')) : ?>
                                        <a href="https://www.youtube.com/watch?v=sU3FkzUKHXU" class="video_btn popup-youtube">
                                            <div class="icon"><i class="ti-control-play"></i></div><span> <?php echo esc_html($settings['play_btn_title']) ?> </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($settings['fimage3']['url'])) : ?>
                            <div class="col-lg-6">
                                <div class="software_img wow fadeInRight" data-wow-delay="0.2s">
                                    <img src="<?php echo esc_url($settings['fimage3']['url']); ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_04') {
            ?>
            <section class="saas_banner_area d-flex align-items-center">
                <img class="saas_shap" src="<?php echo plugins_url('images/shape-1.png', __FILE__) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                <img class="saas_shap" src="<?php echo plugins_url('images/shape2.png', __FILE__) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="saas_banner_content text-center">
                                <?php if(!empty($settings['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_700 f_size_40 w_color mb-0 wow fadeInUp" data-wow-delay="0.3s">
                                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                    </<?php echo $title_tag ?>>
                                <?php endif; ?>
                                <?php if(!empty($settings['subtitle'])) : ?>
                                    <p class="w_color f_300 f_size_18 l_height30 mt_30 wow fadeInUp" data-wow-delay="0.4s">
                                        <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                                    </p>
                                <?php endif; ?>
                                <?php
                                foreach ($buttons as $button) {
                                    echo '<div class="action_btn d-flex align-items-center mt_40 justify-content-center wow fadeInUp" data-wow-delay="0.5s">';
                                    echo "<a href='{$button['btn_url']['url']}' class='btn_hover saas_banner_btn elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <?php
                            if($settings['fimage3']['url']) : ?>
                                <div class="dasboard_img mt_60 wow fadeInUp" data-wow-delay="0.7s">
                                    <img class="img-fluid" src="<?php echo esc_url($settings['fimage3']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_05') {
            ?>
            <section class="agency_banner_area_two">
                <div class="dot_shap one"></div>
                <div class="dot_shap two"></div>
                <div class="dot_shap three"></div>
                <div class="container">
                    <div class="row">
                        <?php
                        if($settings['fimage3']['url']) : ?>
                            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.4s">
                                <img class="agency_banner_img" src="<?php echo esc_url($settings['fimage3']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-5 offset-lg-1 d-flex align-items-center">
                            <div class="agency_content_two">
                                <?php if(!empty($settings['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_700 f_size_40 l_height50 w_color mb_20 wow fadeInRight" data-wow-delay="0.3s">
                                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>
                                <?php if(!empty($settings['subtitle'])) : ?>
                                    <p class="f_300 w_color l_height28 wow fadeInRight" data-wow-delay="0.4s">
                                        <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                                    </p>
                                <?php endif; ?>
                                <div class="action_btn d-flex align-items-center mt_40 wow fadeInRight" data-wow-delay="0.6s">
                                    <?php
                                    foreach ($buttons as $button) {
                                        echo "<a href='{$button['btn_url']['url']}' class='btn_hover agency_banner_btn elementor-repeater-item-{$button['_id']}'> {$button['btn_title']} </a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_06') {
            ?>
            <section class="payment_banner_area">
                <div class="shape one"></div>
                <div class="shape two"></div>
                <div class="container">
                    <div class="payment_banner_content wow fadeInLeft" data-wow-delay="0.4s">
                        <?php if(!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_p f_700 f_size_50 w_color">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>

                        <?php if(!empty($settings['subtitle'])) : ?>
                            <p class="w_color f_p f_size_18">
                                <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                            </p>
                        <?php endif; ?>
                        <div class="action_btn d-flex align-items-center mt_60">
                            <?php
                            $i = 0;
                            foreach ($buttons as $button) {
                                ++$i;
                                $strip_class = ($i % 2 == 1) ? 'btn_hover agency_banner_btn' : 'agency_banner_btn_two';
                                echo "<a " .
                                    "href='{$button['btn_url']['url']}' " .
                                    "class='$strip_class elementor-repeater-item-{$button['_id']}'> " .
                                    "{$button['btn_title']} " .
                                    "</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="animation_img_two wow fadeInRight" data-wow-delay="0.5s">
                    <?php echo wp_get_attachment_image($settings['fimage3']['id'], 'full') ?>
                </div>
                <img class="svg_intro_bottom" src="<?php echo plugins_url('images/shape_home9.png', __FILE__) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_07') {
            ?>
            <section class="startup_banner_area_three">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="startup_content_three">
                                <?php if(!empty($settings['title'])) : ?>
                                    <h2> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </h2>
                                <?php endif; ?>
                                <?php if(!empty($settings['subtitle'])) : ?>
                                    <p> <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?> </p>
                                <?php endif; ?>
                                <?php
                                $i = 0;
                                foreach ($buttons as $button) {
                                    ++$i;
                                    echo "<a " .
                                        "href='{$button['btn_url']['url']}' " .
                                        "class='btn_six slider_btn elementor-repeater-item-{$button['_id']}'> " .
                                        "{$button['btn_title']} " .
                                        "</a>";
                                }
                                if($settings['is_play_btn'] == 'yes') : ?>
                                    <a href="<?php echo esc_url($settings['play_url']) ?>" class="popup-youtube btn_six slider_btn">
                                        <i class="fa fa-play-circle"></i> <?php echo esc_html($settings['play_btn_title']) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stratup_app_screen">
                    <?php if(!empty($settings['fimage1'] ['url'])) : ?>
                        <img class="phone wow slideInnew" data-wow-delay="0.8s" src="<?php echo esc_url($settings['fimage1']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                    <?php endif; ?>
                    <?php if(!empty($settings['fimage2']['url'])) : ?>
                        <img class="laptop wow slideInnew" data-wow-delay="0.3s" src="<?php echo esc_url($settings['fimage2']['url']) ?>" alt="<?php echo esc_attr($settings['subtitle']); ?>">
                    <?php endif; ?>
                </div>
            </section>
            <?php
        }
    }
}
