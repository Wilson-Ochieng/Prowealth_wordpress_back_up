<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
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
class Saasland_c2a extends Widget_Base {

    public function get_name() {
        return 'saasland_c2a';
    }

    public function get_title() {
        return __( 'Call to Action', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Device friendly widget'
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
            'icon', [
                'label' => esc_html__( 'Title Icon', 'saasland-core' ),
                'description' => esc_html__( 'Thee title icon will display above the section title', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/home9/icon2.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_05']
                ]
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
                    '{{WRAPPER}} .f_p.f_size_40.l_height50.f_700' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .l_height45.t_color3.mb-0' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_size_30.l_height45.mb_40' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .w_color.f_p.mb-30' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_p.t_color.f_700' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .f_p.f_size_40.l_height50.f_700, 
                    {{WRAPPER}} .l_height45.t_color3.mb-0,
                    {{WRAPPER}} .f_size_30.l_height45.mb_40,
                    {{WRAPPER}} .w_color.f_p.mb-30,
                    {{WRAPPER}} .f_p.t_color.f_700
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_04', 'style_05'],
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
                    '{{WRAPPER}} .call_action_area .action_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_area_two p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .payment_action_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .call_action_area .action_content p, 
                    {{WRAPPER}} .software_featured_area_two p,
                    {{WRAPPER}} .payment_action_content p
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Featured Image ------------------------------
        $this->start_controls_section(
            'featured_img_sec', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_04'],
                ]
            ]
        );

        $this->add_control(
            'featured_image', [
                'label' => esc_html__( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/c2a_featured_image.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();



        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => esc_html__( 'Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
            );        

        //Normal Style
        $this->start_controls_tab(
            'style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_font_color', [
                'label' => esc_html__( 'Font color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_content .btn_four' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pay_btn.pay_btn_two' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content .gr_btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color', [
                'label' => esc_html__( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three:hover' => 'color: {{VALUE}}; background: transparent;',
                    '{{WRAPPER}} .action_area_three .action_content .white_btn:hover' => 'color: {{VALUE}}; background: transparent;',
                    '{{WRAPPER}} .software_featured_content .btn_four:hover' => 'color: {{VALUE}}; background: transparent;',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content .gr_btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

       /* $this->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.btn_three.btn_hover.wow.fadeInLeft' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        */

        $this->end_controls_tab();


        //Hover Color
        $this->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_02', 'style_05',]
                ]
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_02', 'style_05']
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn:before' => 'background-image: -webkit-linear-gradient(0deg, {{btn_bg_color.VALUE}} 0%, {{VALUE}} 100%);',
                    '{{WRAPPER}} .saas_subscribe_area .saas_action_content .gr_btn' => 'background-image: -webkit-linear-gradient(-48deg, {{btn_bg_color.VALUE}} 46%, {{VALUE}} 100%);',
                    '{{WRAPPER}} .btn_three:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .call_action_area .action_content .action_btn:hover' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_02', 'style_05', 'style_06']
                ]
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => ['style_02', 'style_05']
                ]

            ]
        );
        $this->end_controls_tab();

        $this->end_controls_section(); // End the Button


        // ------------------------------ Button 2 ------------------------------
        $this->start_controls_section(
            'button2_sec', [
                'label' => esc_html__( 'Button 02', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_03'
                ]
            ]
        );

        $this->add_control(
            'btn_label2', [
                'label' => esc_html__( 'Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn_url2', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'btn_text_color2', [
                'label' => esc_html__( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color2', [
                'label' => esc_html__( 'Background color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End the Button



        /**
         * Style Tab
        */
        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__('Style One', 'saasland-core'),
                    'style_02' => esc_html__('Style Two', 'saasland-core'),
                    'style_03' => esc_html__('Style Three', 'saasland-core'),
                    'style_04' => esc_html__('Style Four', 'saasland-core'),
                    'style_05' => esc_html__('Style Five (Title & Icon)', 'saasland-core'),
                    'style_06' => esc_html__('Style Six (Title & Gradient Button)', 'saasland-core'),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'bg_image', [
                'label' => esc_html__( 'Background Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/c2a_bg_shape.png', __FILE__)
                ],
                'condition' => [
                    'style' => ['style_01'],
                ]
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .action_area_two' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .payment_action_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color2', [
                'label' => __( 'Background Color 2', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04']
                ],
                'output' => [
                    '{{WRAPPER}} .call_action_area' => 'background-image: -webkit-linear-gradient(180deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%)',
                    '{{WRAPPER}} .action_area_three' => 'background-image: -webkit-linear-gradient(180deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%)',
                    '{{WRAPPER}} .software_featured_area_two' => 'background: -webkit-linear-gradient(40deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%)',
                    '{{WRAPPER}} .saas_subscribe_area' => 'background-image: -webkit-linear-gradient(180deg, {{VALUE}} 0%, {{bg_color.VALUE}} 100%)',
                ]
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .call_action_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .action_area_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .software_featured_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .payment_action_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .saas_subscribe_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04']
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if ($settings['style'] == 'style_01') : ?>
            <section class="call_action_area">
                <img class="leaf action_one" data-parallax='{"x": -50, "y": 0}'
                     src="<?php echo esc_url($settings['featured_image']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                <img class="leaf action_two" data-parallax='{"x": 40, "y": 0}' src="<?php echo esc_url($settings['bg_image']['url']) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                <div class="container">
                    <div class="action_content text-center">
                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo esc_html($title_tag) ?> class="f_p f_size_40 l_height50 f_700"> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </<?php echo esc_html($title_tag); ?>>
                        <?php endif; ?>
                        <?php echo wpautop($settings['subtitle']) ?>
                        <?php if (!empty($settings['btn_label'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                <?php saasland_is_external($settings['btn_url']) ?>
                                <?php echo saasland_is_external($settings['btn_url']); ?>
                               class="action_btn btn_hover mt_40">
                                <?php echo esc_html($settings['btn_label']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php

        elseif ($settings['style'] == 'style_02') :
            ?>
            <section class="action_area_two">
            <div class="container">
            <div class="row">
                <div class="col-lg-8 d-flex align-items-center">
                    <div class="action_content">
                        <?php if(!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_600 f_size_30 l_height45 t_color3 mb-0 wow fadeInLeft" data-wow-delay="0.3s">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($settings['btn_label'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                <?php saasland_is_external($settings['btn_url']) ?>
                                <?php echo saasland_is_external($settings['btn_url']); ?>
                               class="btn_three btn_hover wow fadeInLeft" data-wow-delay="0.5s">
                                <?php echo esc_html($settings['btn_label']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(!empty($settings['featured_image']['url'])) : ?>
                    <div class="col-lg-4">
                        <div class="action_img wow fadeInRight" data-wow-delay="0.5s">
                            <img src="<?php echo esc_url($settings['featured_image']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            </div>
            </section>
            <?php

        elseif($settings['style'] == 'style_03') :
            ?>
            <section class="action_area_three sec_pad">
                <div class="curved"></div>
                <div class="container">
                <div class="row">
                <div class="col-lg-12">
                    <div class="action_content text-center">
                        <?php if(!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_600 f_size_30 l_height45 mb_40">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if (!empty($settings['btn_label'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                <?php saasland_is_external($settings['btn_url']) ?>
                                <?php echo saasland_is_external($settings['btn_url']); ?>
                               class="about_btn white_btn wow fadeInLeft" data-wow-delay="0.3s">
                                <?php echo esc_html($settings['btn_label']); ?>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($settings['btn_label2'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url2']['url']); ?>"
                                <?php saasland_is_external($settings['btn_url2']) ?>
                                <?php echo saasland_is_external($settings['btn_url2']); ?>
                               class="about_btn wow fadeInRight" data-wow-delay="0.4s">
                                <?php echo esc_html($settings['btn_label2']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
                </div>
            </section>
            <?php

        elseif($settings['style'] == 'style_04') :
            ?>
            <section class="software_featured_area_two sec_pad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="software_featured_img wow fadeInLeft" data-wow-delay="0.2s">
                                <img src="<?php echo esc_url($settings['featured_image']['url']) ?>" class="img-fluid" alt="<?php echo esc_attr($settings['title']); ?>">
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1 d-flex align-items-center pl-0">
                            <div class="software_featured_content">
                                <?php if(!empty($settings['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_700 f_size30 l_height_40 w_color f_p mb-30 wow fadeInRight" data-wow-delay="0.2s">
                                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>
                                <?php if(!empty($settings['subtitle'])) : ?>
                                    <p class="w_color f_300 mb_50 wow fadeInRight" data-wow-delay="0.4s">
                                        <?php echo nl2br($settings['subtitle']) ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($settings['btn_label'])): ?>
                                    <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                        <?php saasland_is_external($settings['btn_url']) ?>
                                        <?php echo saasland_is_external($settings['btn_url']); ?>
                                       class="btn_hover btn_four wow fadeInRight" data-wow-delay="0.6s">
                                        <?php echo esc_html($settings['btn_label']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php

        elseif($settings['style'] == 'style_05') :
            ?>
            <section class="payment_action_area">
                <div class="clients_bg_shape_bottom"></div>
                <div class="container">
                    <div class="payment_action_content text-center wow fadeInUp" data-wow-delay="0.2s">
                        <div class="pay_icon">
                            <div class="icon_shape"></div>
                            <img class="icon_img" src="<?php echo esc_url($settings['icon']['url']) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                        </div>
                        <?php if(!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_p t_color f_700">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if(!empty($settings['subtitle'])) : ?>
                            <p> <?php echo nl2br($settings['subtitle']) ?> </p>
                        <?php endif; ?>
                        <?php if (!empty($settings['btn_label'])): ?>
                            <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                <?php saasland_is_external($settings['btn_url']) ?>
                               class="btn_hover agency_banner_btn pay_btn pay_btn_two">
                                <?php echo esc_html($settings['btn_label']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php

        elseif($settings['style'] == 'style_06') :
            ?>
            <section class="saas_subscribe_area">
                <div class="container">
                    <div class="row saas_action_content wow fadeInUp" data-wow-delay="0.2s">
                        <div class="col-lg-8">
                            <?php if(!empty($settings['title'])) : ?>
                                <h4 class="f_p f_size_30 l_height50 f_400 t_color mb-0">
                                    <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                </h4>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($settings['btn_label'])) : ?>
                            <div class="col-lg-4 d-flex justify-content-end">
                                <a href="<?php echo esc_url($settings['btn_url']['url']); ?>" class="gr_btn" <?php saasland_is_external($settings['btn_url']) ?>>
                                    <span class="text"> <?php echo esc_html($settings['btn_label']); ?> </span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    }
}