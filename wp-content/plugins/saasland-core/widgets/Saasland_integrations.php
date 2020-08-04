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
class Saasland_integrations extends Widget_Base {

    public function get_name() {
        return 'Saasland_integrations';
    }

    public function get_title() {
        return __( 'Integrations <br> with Call to Action', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-thumbnails-half';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // --------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec',
            [
                'label' => __( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Quick & Easy Process'
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
            'title_icon', [
                'label' => esc_html__( 'Title Icon', 'saasland-core' ),
                'description' => esc_html__( 'Thee title icon will display above the section title', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/home9/icon2.png', __FILE__)
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
                    '{{WRAPPER}} .payment_features_content .title_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .payment_features_content .title_color',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Subtitle ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
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
                    '{{WRAPPER}} .payment_features_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .payment_features_content p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'integrations_sec', [
                'label' => __( 'Integrations', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'integrations_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .payment_clients_area .clients_bg_shape_right' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'integrations', [
                'label' => __( 'Integration Items', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Text'
                    ],
                    [
                        'name' => 'logo',
                        'label' => __( 'Logo', 'karpartz-core' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'dimension',
                        'label' => __( 'Dimension', 'saasland-core' ),
                        'type' => Controls_Manager::IMAGE_DIMENSIONS,
                    ],
                    [
                        'name' => 'position',
                        'label' => __( 'Position', 'saasland-core' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'default' => [
                            'isLinked' => false
                        ]
                    ],
                    [
                        'name'      => 'bg_color',
                        'label'     => esc_html__('Background Color', 'saasland-core'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}'
                        )
                    ],
                    [
                        'name'      => 'border_color',
                        'label'     => esc_html__('Border Color', 'saasland-core'),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-color: {{VALUE}}'
                        )
                    ],
                ],
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

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_btn_tabs'
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
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn' => 'background: {{VALUE}}',
                ],
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
                    '{{WRAPPER}} .pay_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pay_btn:hover:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section(); // End the Button


        // ------------------------------ Button 2 ------------------------------
        $this->start_controls_section(
            'button2_sec', [
                'label' => esc_html__( 'Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn2_label', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started',
            ]
        );

        $this->add_control(
            'btn2_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'btn2_text_color', [
                'label' => esc_html__( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .call_action_area .action_content .action_btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .action_content .btn_three' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn2_bg_color', [
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
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .payment_clients_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $planets = isset($settings['integrations']) ? $settings['integrations'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        ?>
        <section class="payment_clients_area">
            <div class="clients_bg_shape_top"></div>
            <div class="clients_bg_shape_right"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="payment_features_content pr_70 wow fadeInLeft" data-wow-delay="0.2s">

                            <div class="icon">
                                <img class="img_shape" src="<?php echo plugins_url('images/home9/icon_shape.png', __FILE__) ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                                <img class="icon_img" src="<?php echo esc_url($settings['title_icon']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
                            </div>

                            <?php if(!empty($settings['title'])) : ?>
                                <<?php echo $title_tag; ?> class="title_color"> <?php echo nl2br($settings['title']) ?> </<?php echo $title_tag; ?>>
                            <?php endif; ?>
                            <?php if(!empty($settings['subtitle'])) : ?>
                                <p> <?php echo nl2br($settings['subtitle']) ?> </p>
                            <?php endif; ?>
                            
                            <?php if (!empty($settings['btn_label'])): ?>
                                <a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
                                    <?php saasland_is_external($settings['btn_url']) ?>
                                    <?php echo saasland_is_external($settings['btn_url']); ?>
                                   class="btn_hover agency_banner_btn pay_btn pay_btn_one">
                                    <?php echo esc_html($settings['btn_label']); ?>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($settings['btn2_label'])): ?>
                                <a href="<?php echo esc_url($settings['btn2_url']['url']); ?>"
                                    <?php saasland_is_external($settings['btn2_url']) ?>
                                    <?php echo saasland_is_external($settings['btn2_url']); ?>
                                   class="btn_hover agency_banner_btn pay_btn pay_btn_two">
                                    <?php echo esc_html($settings['btn2_label']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="payment_clients_inner">
                            <?php
                            if(!empty($planets)) {
                                $delay = 0.2;
                                foreach ($planets as $i => $planet) {
                                    $width = !empty($planet['dimension']['width']) ? "width: {$planet['dimension']['width']}px; " : '';
                                    $height = !empty($planet['dimension']['height']) ? "height: {$planet['dimension']['height']}px; " : '';
                                    $top = !empty($planet['position']['top']) ? "top: {$planet['position']['top']}px; " : '';
                                    $right = !empty($planet['position']['right']) ? "right: {$planet['position']['right']}px; " : '';
                                    $bottom = !empty($planet['position']['bottom']) ? "bottom: {$planet['position']['bottom']}px; " : '';
                                    $left = !empty($planet['position']['left']) ? "left:{$planet['position']['left']}px; " : '';
                                    $index = 'one';
                                    switch ($i) {
                                        case 0;
                                            $index = 'one';
                                            break;
                                        case 1;
                                            $index = 'two';
                                            break;
                                        case 2;
                                            $index = 'three';
                                            break;
                                        case 3;
                                            $index = 'four';
                                            break;
                                        case 4;
                                            $index = 'five';
                                            break;
                                        case 5;
                                            $index = 'six';
                                            break;
                                        case 6;
                                            $index = 'seven';
                                            break;
                                        case 7;
                                            $index = 'eight';
                                            break;
                                        case 8;
                                            $index = 'nine';
                                            break;
                                    }
                                    ?>
                                    <div class="clients_item <?php echo esc_attr($index).' elementor-repeater-item-' . $planet['_id'] . '' ?> wow fadeInLeft"
                                         data-wow-delay="<?php echo esc_attr($delay) ?>s"
                                         style="<?php echo $width.$height.$top.$right.$bottom.$left; ?>">
                                        <?php echo wp_get_attachment_image($planet['logo']['id'], 'full') ?>
                                    </div>
                                    <?php
                                    $delay = $delay + 0.1;
                                }}
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}