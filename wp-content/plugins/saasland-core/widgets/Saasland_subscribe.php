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
class Saasland_subscribe extends Widget_Base {

    public function get_name() {
        return 'saasland_subsciribe';
    }

    public function get_title() {
        return __( 'Subscribe form', 'saasland-core' );
    }

    public function get_icon() {
        return '  eicon-mailchimp';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'ajax-chimp' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title Section ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Increase team productivity  with this powerful Project Management Tool'
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'saasland-core' ),
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

        $this->end_controls_section(); //End Title Section


        // ------------------------------  Subtitle Section ------------------------------ //
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle Section', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_05', 'style_06', 'style_07']
                ]
            ]
        );

        $this->end_controls_section(); // End subtitle section


        // ------------------------------ MailChimp form ------------------------------
        $this->start_controls_section(
            'form_settings', [
                'label' => __( 'Form settings', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'email_placeholder', [
                'label' => esc_html__( 'Email Filed Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Type your email...',
            ]
        );

        $this->add_control(
            'name_placeholder', [
                'label' => esc_html__( 'Name Filed Placeholder', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Name',
                'condition' => [
                    'style' => ['style_05']
                ]
            ]
        );

        $this->add_control(
            'action_url', [
                'label' => esc_html__( 'Action URL', 'saasland-core' ),
                'description' => __( 'Enter here your MailChimp action URL. <a href="https://goo.gl/k5a2tA" target="_blank"> How to </a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Submit Button Label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Subscribe',
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04', 'style_05', 'style_06', 'style_07']
                ]
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_tabs'
            );
        
        /************************** Normal Color *****************************/
        $this->start_controls_tab(
            'btn_style_normal',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'normal_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .subcribes .btn_submit' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .subcribes .btn_submit' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'style' =>  'style_04'
                ]
            ]
        );

        $this->end_controls_tab();
        

        //**************************** Hover Color *****************************//
        $this->start_controls_tab(
            'btn_style_hover',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .subcribes .btn_submit:hover' => 'color: {{VALUE}}',
                ]
            ]
        );
        
        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .saas_banner_btn:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .subcribes .btn_submit:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_four:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'style' =>  'style_04'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();


        // ----------------------- The Featured Image ----------------------
        $this->start_controls_section(
            'featured_image_sec', [
                'label' => esc_html__( 'Featured Image', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_06']
                ]
            ]
        );

        $this->add_control(
            'featured_img', [
                'label' => esc_html__( 'The Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();



        /**
         * Style Tab
         * ------------------------------ Style Title ------------------------------
         */
        $this->start_controls_section(
            'style_title', [
                'label' => __( 'Style title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .f_p.f_size_40.l_height60' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .t_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .t_color3.l_height50.pr_70.mb_20' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mb_50' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_600.w_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_700.f_size_50.w_color.f_p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .f_p.f_size_40.l_height60,
                    {{WRAPPER}} .t_color,
                    {{WRAPPER}} .f_600.w_color, 
                    {{WRAPPER}} .mb_50, 
                    {{WRAPPER}} .t_color3.l_height50.pr_70.mb_20,
                    {{WRAPPER}} .f_700.f_size_50.w_color.f_p
                    ',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_subtitle',
            [
                'label' => __( 'Style subtitle', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_01', 'style_02', 'style_03', 'style_05', 'style_06']
                ],
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner_top p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_300.f_size_18.l_height34.subtitle_color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .section_container .intro_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .prototype_content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sec_title.text-center p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .banner_top p, 
                    {{WRAPPER}} .f_300.f_size_18.l_height34.subtitle_color, 
                    {{WRAPPER}} .section_container .intro_content p, 
                    {{WRAPPER}} .prototype_content p,       
                    {{WRAPPER}} .sec_title.text-center p       
                    ',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_bg_color_sec',
            [
                'label' => __( 'Background Color', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' =>  ['style_01', 'style_02', 'style_03', 'style_04'],
                ],
            ]
        );

        $this->add_control(
            'background_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_home_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .s_subscribe_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .prototype_banner_area' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .subscribe_form_info' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        
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
                    'style_01' => esc_html__('Style One (with featured image)', 'saasland-core'),
                    'style_02' => esc_html__('Style Two', 'saasland-core'),
                    'style_03' => esc_html__('Style Three (with featured image)', 'saasland-core'),
                    'style_04' => esc_html__('Style Four', 'saasland-core'),
                    'style_05' => esc_html__('Style Five', 'saasland-core'),
                    'style_06' => esc_html__('Style Six (with featured image)', 'saasland-core'),
                    'style_07' => esc_html__('Style Seven', 'saasland-core'),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'sec_bg_image', [
                'label' => esc_html__( 'Background image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'style_02'
                ],
                'default' => [
                    'url' => plugins_url('images/map.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'section_color_left', [
                'label'     => esc_html__('Background Color', 'saasland-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas_signup_area' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'style' => ['style_05', 'style_06', 'style_07'],
                ]
            ]
        );

        $this->add_control(
            'section_color_right', [
                'label'     => esc_html__('Background Color 02', 'saasland-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '.saas_banner_area_two .section_intro' => 'background-image: -webkit-linear-gradient(-50deg, {{section_color_left.VALUE}} 0%, {{VALUE}} 46%, {{VALUE}} 100%)',
                ),
                'condition' => [
                    'style' => ['style_06', 'style_07'],
                ]
            ]
        );

        $this->add_control(
            'sec_bg_color3', [
                'label' => esc_html__( 'Background Color 03', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'style' => 'style_07'
                ],
                'selectors' => [
                    '{{WRAPPER}} .payment_subscribe_info' => 'background-image: -webkit-linear-gradient(50deg, {{section_color_left.VALUE}} 0%, {{section_color_right.VALUE}} 64%, {{VALUE}} 100%);'
                ]
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .banner_top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .s_subscribe_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .subscribe_form_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .saas_signup_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .saas_banner_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .prototype_banner_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .payment_subscribe_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $bg_img = !empty($settings['sec_bg_image']['url']) ? 'style="background: url('.esc_url($settings['sec_bg_image']['url']).') no-repeat scroll center 0/cover;"' : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if($settings['style'] == 'style_01') {
            ?>
            <section class="saas_home_area">
            <div class="banner_top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_p f_size_40 l_height60">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle'])) : ?>
                            <p class="f_size_18 l_height30"> <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?> </p>
                        <?php endif; ?>
                        <form class="mailchimp" method="post" action="#">
                            <div class="input-group subcribes">
                                <input type="text" name="EMAIL" class="form-control memail"
                                       placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                                <?php if (!empty($settings['btn_label'])) : ?>
                                    <button class="btn btn_submit f_size_15 f_500" type="submit">
                                        <?php echo esc_html($settings['btn_label']); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                            <p class="mchimp-errmessage" style="display: none;"></p>
                            <p class="mchimp-sucmessage" style="display: none;"></p>
                        </form>
                    </div>
                </div>
                <?php if (!empty($settings['featured_img']['id'])) : ?>
                    <div class="saas_home_img">
                        <?php echo wp_get_attachment_image($settings['featured_img']['id'], 'full') ?>
                    </div>
                <?php endif; ?>
            </div>
            </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_02') {
            ?>
            <section class="s_subscribe_area">
                <div class="s_shap">
                    <svg class="right_shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <linearGradient id="PSgrad_5">
                                <stop offset="0%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                                <stop offset="100%" stop-color="rgb(25,204,230)" stop-opacity="0.95" />
                            </linearGradient>
                        </defs>
                        <path fill="url(#PSgrad_5)"
                              d="M543.941,156.289 L227.889,41.364 C184.251,25.497 136.000,47.975 120.118,91.571 L5.084,407.325 C-10.799,450.921 11.701,499.127 55.339,514.995 L371.391,629.920 C415.029,645.788 463.280,623.309 479.162,579.713 L594.196,263.959 C610.079,220.362 587.579,172.157 543.941,156.289 Z"/>
                        <path fill="url(#PSgrad_5)"
                              d="M625.661,120.004 L309.609,5.079 C265.971,-10.790 217.720,11.689 201.838,55.286 L86.804,371.039 C70.921,414.636 93.421,462.842 137.059,478.709 L453.111,593.634 C496.749,609.502 545.000,587.024 560.882,543.427 L675.916,227.673 C691.799,184.077 669.299,135.872 625.661,120.004 Z"/>
                    </svg>
                    <svg class="bottom_shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <linearGradient id="PSgrad_6" x1="76.604%" x2="0%" y1="0%" y2="64.279%">
                                <stop offset="0%" stop-color="rgb(103,84,226)" stop-opacity="0.95" />
                                <stop offset="100%" stop-color="rgb(25,204,230)" stop-opacity="0.95" />
                            </linearGradient>
                        </defs>
                        <path fill="url(#PSgrad_6)"
                              d="M543.941,156.289 L227.889,41.365 C184.251,25.496 136.000,47.975 120.118,91.572 L5.084,407.325 C-10.799,450.922 11.701,499.127 55.339,514.995 L371.391,629.920 C415.029,645.788 463.280,623.310 479.162,579.713 L594.196,263.959 C610.079,220.362 587.579,172.157 543.941,156.289 Z"/>
                        <path fill="url(#PSgrad_6)"
                              d="M625.661,120.004 L309.609,5.078 C265.971,-10.789 217.720,11.689 201.838,55.286 L86.804,371.040 C70.921,414.636 93.421,462.842 137.059,478.709 L453.111,593.634 C496.749,609.502 545.000,587.023 560.882,543.427 L675.916,227.673 C691.799,184.077 669.299,135.871 625.661,120.004 Z"/>
                    </svg>
                </div>
                <div class="container">
                    <div class="sec_title text-center mb_50 wow fadeInUp" data-wow-delay="0.4s">
                        <?php if(!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 t_color"> <?php echo esc_html($settings['title']); ?> </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if(!empty($settings['subtitle'])) : ?>
                            <p class="f_300 f_size_18 l_height34 subtitle_color"><?php echo nl2br($settings['subtitle']); ?></p>
                        <?php endif; ?>
                    </div>
                    <form class="mailchimp wow fadeInUp" data-wow-delay="0.6s" method="post" action="#" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
                        <div class="input-group s_subcribes">
                            <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                            <button class="btn btn-submit" type="submit"><i class="ti-arrow-right"></i></button>
                        </div>
                        <p class="mchimp-errmessage" style="display: none;"></p>
                        <p class="mchimp-sucmessage" style="display: none;"></p>
                    </form>
                </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_03') {
            ?>
            <section class="prototype_banner_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 d-flex align-items-center">
                            <div class="prototype_content">

                                <?php if (!empty($settings['title'])) : ?>
                                    <<?php echo esc_html($title_tag) ?> class="f_size_40 f_700 t_color3 l_height50 pr_70 mb_20 wow fadeInLeft" data-wow-delay="0.3s">
                                        <?php echo wp_kses_post($settings['title']) ?>
                                    </<?php echo esc_html($title_tag) ?>>
                                <?php endif; ?>

                                <?php if (!empty($settings['subtitle'])) : ?>
                                    <p class="f_300 l_height28 mb_40 wow fadeInLeft" data-wow-delay="0.5s"> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                                <?php endif; ?>

                                <form action="#" class="mailchimp banner_subscribe" method="post">
                                    <div class="input-group subcribes wow fadeInLeft" data-wow-delay="0.6s">
                                        <input type="text" name="EMAIL" class="form-control memail" placeholder="Email">
                                        <button class="btn btn_three btn_hover f_size_15 f_500 wow fadeInLeft" data-wow-delay="0.8s" type="submit">
                                            <?php echo esc_html($settings['btn_label']) ?>
                                        </button>
                                    </div>
                                    <p class="mchimp-errmessage" style="display: none;"></p>
                                    <p class="mchimp-sucmessage" style="display: none;"></p>
                                </form>
                            </div>
                        </div>
                        <?php if (!empty($settings['featured_img']['id'])) : ?>
                            <div class="col-lg-7">
                                <?php echo wp_get_attachment_image($settings['featured_img']['id'], 'full', '', array('class' => 'protype_img wow fadeInRight', 'data-wow-delay' => '0.4s')) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_04') {
            ?>
            <div class="subscribe_form_info text-center">
                <?php if (!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_600 f_size_30 l_height30 t_color3 mb_50">
                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                    </<?php echo $title_tag; ?>>
                <?php endif; ?>
                <form class="mailchimp subscribe-form" method="post">
                    <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                    <?php if (!empty($settings['btn_label'])) : ?>
                        <button class="btn_hover btn_four mt_40" type="submit">
                            <?php echo esc_html($settings['btn_label']); ?>
                        </button>
                    <?php endif; ?>
                    <p class="mchimp-errmessage" style="display: none;"></p>
                    <p class="mchimp-sucmessage" style="display: none;"></p>
                </form>
            </div>
            <?php
        }

        elseif($settings['style'] == 'style_05') {
            ?>
            <section class="saas_signup_area sec_pad dk_bg_two">
                <div class="container">
                    <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 w_color">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle'])) : ?>
                            <p class="d_p_color f_300 f_size_15">
                                <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <form action="" class="saas_signup_form row">
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group wow fadeInLeft" data-wow-delay="0.3s">
                                <input type="text" class="form-control" placeholder="<?php echo esc_attr($settings['name_placeholder']) ?>">
                                <label></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group wow fadeInLeft" data-wow-delay="0.5s">
                                <input type="text" class="form-control" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                                <label></label>
                            </div>
                        </div>
                        <?php if (!empty($settings['btn_label'])) : ?>
                            <div class="col-lg-12 text-center wow fadeInUp" data-wow-delay="0.8s">
                                <button class="signup_btn btn_hover saas_banner_btn mt_60" type="submit">
                                    <?php echo esc_html($settings['btn_label']); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_06') {
            ?>
            <section class="saas_banner_area_two">
                <div class="section_intro">
                    <div class="section_container">
                        <div class="intro">
                            <div class="intro_content">
                                <?php if (!empty($settings['title'])) : ?>
                                    <<?php echo $title_tag; ?> class="f_700 f_size_50 w_color f_p">
                                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>
                                <?php if (!empty($settings['subtitle'])) : ?>
                                    <p class="w_color f_size_18">
                                        <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                                    </p>
                                <?php endif; ?>
                                <form class="mailchimp" method="post">
                                    <div class="input-group subcribes">
                                        <input type="text" name="EMAIL" class="form-control memail" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                                        <?php if (!empty($settings['btn_label'])) : ?>
                                            <button class="btn btn_submit f_size_15 f_500" type="submit">
                                                <?php echo esc_html($settings['btn_label']); ?>
                                            </button>
                                        <?php endif ?>
                                    </div>
                                    <p class="mchimp-errmessage" style="display: none;"></p>
                                    <p class="mchimp-sucmessage" style="display: none;"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="shap_img" src="<?php echo plugins_url('images/home10/shape.png', __FILE__) ?>" alt="<?php echo esc_attr($settings['title']) ?>">
                <?php if (!empty($settings['featured_img']['id'])) : ?>
                    <div class="animation_img wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo wp_get_attachment_image($settings['featured_img']['id'], 'full') ?>
                    </div>
                <?php endif; ?>
            </section>
            <?php
        }

        elseif($settings['style'] == 'style_07') {
            ?>
            <section class="payment_subscribe_area">
                <div class="container">
                    <div class="payment_subscribe_info">
                        <div class="payment_subscribe_content">
                            <?php if (!empty($settings['title'])) : ?>
                                <h2> <?php echo wp_kses_post(nl2br($settings['title'])) ?> </h2>
                            <?php endif; ?>
                            <?php if (!empty($settings['subtitle'])) : ?>
                                <p> <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?> </p>
                            <?php endif; ?>
                        </div>
                        <form action="#" class="subscribe-form" method="post">
                            <input type="text" name="EMAIL" class="form-control" placeholder="<?php echo esc_attr($settings['email_placeholder']) ?>">
                            <?php if (!empty($settings['btn_label'])) : ?>
                                <button class="btn_hover btn_four" type="submit">
                                    <?php echo esc_html($settings['btn_label']); ?>
                                </button>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </section>
            <?php
        }
        ?>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    // MAILCHIMP
                    if ($(".mailchimp").length > 0) {
                        $(".mailchimp").ajaxChimp({
                            callback: mailchimpCallback,
                            url: "<?php echo esc_url($settings['action_url']) ?>"
                        });
                    }
                    $(".memail").on("focus", function () {
                        $(".mchimp-errmessage").fadeOut();
                        $(".mchimp-sucmessage").fadeOut();
                    });
                    $(".memail").on("keydown", function () {
                        $(".mchimp-errmessage").fadeOut();
                        $(".mchimp-sucmessage").fadeOut();
                    });
                    $(".memail").on("click", function () {
                        $(".memail").val("");
                    });

                    function mailchimpCallback(resp) {
                        if (resp.result === "success") {
                            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                            $(".mchimp-sucmessage").fadeOut(500);
                        } else if (resp.result === "error") {
                            $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                        }
                    }
                });
            })(jQuery)
        </script>

        <?php

    }

}