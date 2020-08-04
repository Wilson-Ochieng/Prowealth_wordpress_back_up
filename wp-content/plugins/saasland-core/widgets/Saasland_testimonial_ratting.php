<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;



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
class Saasland_testimonial_ratting extends \Elementor\Widget_Base {

    public function get_name() {
        return 'saasland_testimonial_ratting';
    }

    public function get_title() {
        return __( 'Testimonials with Ratting', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }
    public function get_script_depends() {
        return [ '' ];
    }

    protected function render() {
        $settings = $this->get_settings();
        $testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : '';

        if ($settings['style'] == 'style_01') : ?>
            <section class="feedback_area_two sec_pad">
            <div class="container custom_container">
                <div class="sec_title mb_70 wow fadeInUp" data-wow-delay="0.4s">
                    <?php if(!empty($settings['title'])) : ?>
                        <h2 class="f_p f_size_40 l_height50 f_500 w_color"> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </h2>
                    <?php endif; ?>
                    <?php if(!empty($settings['subtitle'])) : ?>
                        <p class="f_400 f_size_18 mb-0"> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </p>
                    <?php endif; ?>
                </div>
                <div id="fslider_three" class="feedback_slider_two owl-carousel">
                    <?php
                    foreach ($testimonials as $testimonial) {
                        ?>
                        <div class="item">
                            <div class="feedback_item feedback_item_two">
                                <div class="feed_back_author">
                                    <div class="media">
                                        <div class="img">
                                            <?php echo wp_get_attachment_image($testimonial['author_image']['id'], 'saasland_83x88') ?>
                                        </div>
                                        <div class="media-body">
                                            <?php echo (!empty($testimonial['name'])) ? '<h5 class="t_color f_size_15 f_p f_500">'.$testimonial['name'].'</h5>' : ''; ?>
                                            <?php echo (!empty($testimonial['designation'])) ? '<h6 class="f_p f_400">'.$testimonial['designation'].'</h6>' : ''; ?>
                                        </div>
                                    </div>
                                    <div class="ratting">
                                        <?php
                                        switch ($testimonial['ratting']) {
                                            case '1': ?>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                            <?php break;
                                            case '2': ?>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                            <?php break;
                                            case '3': ?>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                            <?php break;
                                            case '4': ?>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                            <?php break;
                                            case '5': ?>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                            <?php break;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <p class="f_size_15"> <?php echo wp_kses_post($testimonial['content']) ?> </p>
                                <div class="shap_one"></div>
                                <div class="shap_two"></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        var feedback_sliders_three = $("#fslider_three");
                        if( feedback_sliders_three.length ){
                            feedback_sliders_three.owlCarousel({
                                loop:<?php echo esc_js($settings['loop']) ?>,
                                margin:0,
                                items: 2,
                                nav:true,
                                autoplay: false,
                                <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                                smartSpeed: <?php echo esc_js($settings['slide_speed']) ?>,
                                stagePadding: 0,
                                responsiveClass:true,
                                navText: ['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                                responsive:{
                                    0:{
                                        items:1,
                                    },
                                    776:{
                                        items:2,
                                    },
                                    1199:{
                                        items:3,
                                    }
                                },
                            })
                        }
                    })
                })(jQuery)
            </script>
        <?php

        elseif ($settings['style'] == 'style_02') :
            ?>
            <section class="feedback_area_three bg_color sec_pad">
                <div class="container">
                    <div class="sec_title mb_70 wow fadeInUp" data-wow-delay="0.4s">
                        <?php if(!empty($settings['title'])) : ?>
                            <h2 class="f_p f_size_40 l_height50 f_500 t_color"><?php echo wp_kses_post(nl2br($settings['title'])) ?></h2>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div id="fslider_two" class="feedback_slider_two owl-carousel">
                            <?php
                            foreach ($testimonials as $testimonial) {
                                ?>
                                <div class="item">
                                    <div class="feedback_item">
                                        <div class="feed_back_author">
                                            <div class="media">
                                                <div class="img">
                                                    <?php echo wp_get_attachment_image($testimonial['author_image']['id'], 'saasland_83x88') ?>
                                                </div>
                                                <div class="media-body">
                                                    <?php echo (!empty($testimonial['name'])) ? '<h5 class="t_color f_size_15 f_p f_500">'.$testimonial['name'].'</h5>' : ''; ?>
                                                    <?php echo (!empty($testimonial['designation'])) ? '<h6 class="f_p f_400">'.$testimonial['designation'].'</h6>' : ''; ?>
                                                </div>
                                            </div>
                                            <div class="ratting">
                                                <?php
                                                switch ($testimonial['ratting']) {
                                                    case '1': ?>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                    <?php break;
                                                    case '2': ?>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                    <?php break;
                                                    case '3': ?>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                    <?php break;
                                                    case '4': ?>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="gray_star"><i class="ti-star"></i></a>
                                                    <?php break;
                                                    case '5': ?>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                        <a href="#" class="yellow_star"><i class="ti-star"></i></a>
                                                    <?php break;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <p class="f_size_16"><?php echo wp_kses_post($testimonial['content']) ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                ;(function($){
                    "use strict";
                    $(document).ready(function () {
                        var feedback_sliders = $("#fslider_two");
                        if( feedback_sliders.length ){
                            feedback_sliders.owlCarousel({
                                loop:<?php echo esc_js($settings['loop']) ?>,
                                margin:0,
                                items: 2,
                                nav:true,
                                <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                                autoplay: false,
                                smartSpeed: <?php echo esc_js($settings['slide_speed']) ?>,
                                stagePadding: 0,
                                responsiveClass:true,
                                navText: [,'<i class="ti-angle-left"></i><i class="ti-angle-right"></i>'],
                                responsive:{
                                    0:{
                                        items:1,
                                    },
                                    776:{
                                        items:2,
                                    },
                                    1199:{
                                        items:2,
                                    }
                                },
                            })
                        }
                    })
                })(jQuery)
            </script>
        <?php endif; ?>
        <?php
    }


    protected function _register_controls() {

        // ----------------------------------------  Select Style  ------------------------------
        $this->start_controls_section(
            'style_sec',
            [
                'label' => __( 'Select Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Testimonials Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_01' => esc_html__('Style One', 'saasland-core'),
                    'style_02' => esc_html__('Style Two', 'saasland-core'),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => "Satisfied Users"
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
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} h2',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01',
                ]

            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
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
                    '{{WRAPPER}}>p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Testimonials Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'testimonials', [
                'label' => __( 'Testimonials', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ name }}}',
                'fields' => [
                    [
                        'name' => 'name',
                        'label' => __( 'Name', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Mark Tony'
                    ],
                    [
                        'name' => 'designation',
                        'label' => __( 'Designation', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Software Developer'
                    ],
                    [
                        'name' => 'content',
                        'label' => __( 'Testimonial Text', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'author_image',
                        'label' => __( 'Author Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'ratting',
                        'label' => __( 'Star Ratting', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '1' => 'One',
                            '2' => 'Two',
                            '3' => 'Three',
                            '4' => 'Four',
                            '5' => 'Five',
                            'no' => 'None',
                        ]
                    ],
                ],
            ]
        );

        $this->add_control(
            'testimonial_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .feedback_slider_two .feedback_item' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .feedback_slider_three .feedback_item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Owl Carousel Slider Settings
        $this->start_controls_section(
            'slider_settings', [
                'label' => __( 'Slider Settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__('True', 'saasland-core'),
                    'false' => esc_html__('False', 'saasland-core'),
                ],
                'default' => 'true'
            ]
        );

        $this->add_control(
            'slide_speed',
            [
                'label' => __( 'Slide Speed', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000
            ]
        );


        $this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'condition' => [
                    'style' => 'style_01',
                ]
            ]
        );

        $this->add_control(
            'bg_color2', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .feedback_area_two' => 'background-image: -webkit-linear-gradient(30deg, {{bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                ],
                'condition' => [
                    'style' => 'style_01',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bg_color' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'style' => 'style_02',
                ]
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .feedback_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} feedback_area_three ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();
    }



}