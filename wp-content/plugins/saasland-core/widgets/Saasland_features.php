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
class Saasland_features extends Widget_Base {

    public function get_name() {
        return 'saasland_main_features';
    }

    public function get_title() {
        return __( 'Features', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    /*public function get_script_depends() {
        return [ 'circle-progress' ];
    }*/

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
                'default' => 'Awesome Features'
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
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .prototype_service_info h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .text-center.mb_90' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_area h2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_600.f_size_30.t_color3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .text-center.mb_90, 
                    {{WRAPPER}} .prototype_service_info h2, 
                    {{WRAPPER}} .software_featured_area h2,
                    {{WRAPPER}} .f_600.f_size_30.t_color3
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .software_featured_area .container > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .software_featured_area .container > p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'features', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_01']
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __( 'Subtitle', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => __( 'Icon Type', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'ti',
                        'options' => [
                            'ti' => __( 'Themify Icon', 'saasland-core' ),
                            'image_icon' => __( 'Image icon', 'saasland-core' ),
                        ],
                    ],
                    [
                        'name' => 'ti',
                        'label' => __( 'Themify Icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'include' => saasland_include_themify_icons(),
                        'default' => 'ti-panel',
                        'condition' => [
                            'icon_type' => 'ti'
                        ]
                    ],
                    [
                        'name' => 'bg_color',
                        'label' => __( 'Icon Background Color', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .p_service_item {{CURRENT_ITEM}}.icon, {{WRAPPER}} .p_service_item {{CURRENT_ITEM}}.icon:before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'icon_type' => 'ti'
                        ]
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'condition' => [
                            'icon_type' => 'image_icon'
                        ]
                    ],
                ],
            ]
        );

        // Features for Style Two
        $this->add_control(
            'features2', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_02']
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __( 'Description', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'ti',
                        'label' => __( 'Icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'include' => saasland_include_themify_icons(),
                        'default' => 'ti-panel',
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Icon Background Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url('images/icon_shape1.png', __FILE__)
                        ]
                    ],
                    [
                        'name' => 'link_title',
                        'label' => __( 'Link Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Read More'
                    ],
                    [
                        'name' => 'link_url',
                        'label' => __( 'Link URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#'
                        ]
                    ],
                ],
            ]
        );


        // Features for Style Three
        $this->add_control(
            'features3', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'style' => ['style_03']
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'subtitle',
                        'label' => __( 'Description', 'saasland-core' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url('images/icon1.png', __FILE__)
                        ]
                    ],
                    [
                        'name' => 'icon_bg',
                        'label' => __( 'Icon Background Image', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => plugins_url('images/icon_shape.png', __FILE__)
                        ]
                    ],
                    [
                        'name' => 'link_title',
                        'label' => __( 'Link Title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Read More'
                    ],
                    [
                        'name' => 'link_url',
                        'label' => __( 'Link URL', 'saasland-core' ),
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '#'
                        ]
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    

        // ---------------- Style Title
        $this->start_controls_section(
            'style_feature_item_title', [
                'label' => __( 'Feature Item Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_feature_item_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .p_service_item h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .f_600.t_color3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .p_service_item h5,
                    {{WRAPPER}} .f_600.t_color3
                    ',
            ]
        );

        $this->end_controls_section();



        // ----------- Style subtitle
        $this->start_controls_section(
            'style_feature_item_subtitle', [
                'label' => __( 'Feature Item Description', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_feature_item_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .p_service_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .software_featured_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_feature_item_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .p_service_item p, {{WRAPPER}} .software_featured_item p',
            ]
        );
        $this->end_controls_section();



        //------------------------------ Style subtitle ------------------------------
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
                    'style_01' => esc_html__('One (Icon with Background Color)', 'saasland-core'),
                    'style_02' => esc_html__('Two (Font Icon with Background Image)', 'saasland-core'),
                    'style_03' => esc_html__('Three (Image Icon with Image Background)', 'saasland-core'),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .agency_service_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .prototype_service_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .software_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__('Two', 'saasland-core'),
                    '4' => esc_html__('Three', 'saasland-core'),
                    '3' => esc_html__('Four', 'saasland-core'),
                ],
                'default' => '4'
            ]
        );

        $this->add_control(
            'col_padding', [
                'label' => __( 'Column Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .software_featured_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                    'isLinked' => false,
                ],
                'condition' => [
                    "style" => ['style_03']
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $features = isset($settings['features']) ? $settings['features'] : '';
        $features2 = isset($settings['features2']) ? $settings['features2'] : '';
        $features3 = isset($settings['features3']) ? $settings['features3'] : '';
        $column = isset($settings['column']) ? $settings['column'] : '3';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';


        if($settings['style'] == 'style_01') : ?>
            <section class="prototype_service_area_three">
            <div class="container">
                <div class="prototype_service_info">
                    <div class="symbols-pulse active">
                        <div class="pulse-1"></div>
                        <div class="pulse-2"></div>
                        <div class="pulse-3"></div>
                        <div class="pulse-4"></div>
                        <div class="pulse-x"></div>
                    </div>

                    <?php if(!empty($settings['title'])) : ?>
                        <h2 class="f_size_30 f_600 t_color3 l_height45 text-center mb_90 wow fadeInUp" data-wow-delay="0.3s">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </h2>
                    <?php endif; ?>

                    <div class="row p_service_info">
                        <?php
                        if(is_array($features)) {
                        $i = 0.2;
                        foreach ($features as $feature) {
                            ?>
                            <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6">
                                <div class="p_service_item pr_70 wow fadeInLeft" data-wow-delay="<?php echo esc_attr($i); ?>s">
                                    <div class="icon icon_one elementor-repeater-item-<?php echo $feature['_id'] ?>">
                                        <?php
                                        if($feature['icon_type'] == 'ti') { ?>
                                            <i class="<?php echo esc_attr($feature['ti']) ?>"></i>
                                            <?php
                                        }elseif($feature['icon_type'] == 'image_icon') {
                                            echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                                        }
                                        ?>
                                    </div>
                                    <h5 class="f_600 f_p t_color3"> <?php echo esc_html($feature['title']) ?> </h5>
                                    <?php if(!empty($feature['subtitle'])) : ?>
                                        <p class="f_300"> <?php echo $feature['subtitle']; ?> </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                            $i = $i + 0.2;
                        }}
                        ?>
                    </div>
                </div>
            </div>
            </section>
        <?php

        elseif($settings['style'] == 'style_02') : ?>
            <section class="agency_service_area">
            <div class="container custom_container">
                <?php if(!empty($settings['title'])) : ?>
                    <<?php echo $title_tag; ?> class="f_size_30 f_600 t_color3 l_height40 text-center mb_90 wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                    </<?php echo $title_tag; ?>>
                <?php endif; ?>
                <div class="row mb_30">
                    <?php
                    unset($i, $feature);
                    if(is_array($features2)) {
                    $i = 0.3;
                    foreach ($features2 as $feature) {
                        ?>
                        <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6">
                            <div class="p_service_item agency_service_item pr_70 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                                <div class="icon">
                                    <?php if(!empty($feature['image_icon']['url'])) : ?>
                                        <img src="<?php echo esc_url($feature['image_icon']['url']); ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                    <?php endif; ?>
                                    <i class="<?php echo esc_attr($feature['ti']) ?>"></i>
                                </div>
                                <?php if(!empty($feature['title'])) : ?>
                                    <h5 class="f_600 f_p t_color3"> <?php echo esc_html($feature['title']) ?> </h5>
                                <?php endif; ?>
                                <?php echo wpautop($feature['subtitle']); ?>
                                <?php if(!empty($feature['link_title'])) : ?>
                                    <p class="mb-0">
                                        <a href="<?php echo esc_url($feature['link_url']['url']) ?>" <?php saasland_is_external($feature['link_url']) ?>>
                                            <?php echo esc_html($feature['link_title']) ?>
                                        </a>
                                        <i class="ti-arrow-right"></i>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    $i = $i + 0.2;
                    }}
                    ?>
                </div>
            </div>
            </section>
            <?php

        elseif($settings['style'] == 'style_03') :
            ?>
            <section class="software_featured_area <?php echo !empty($settings['subtitle']) ? 'has_subtitle' : ''; ?>">
                <div class="container">
                    <?php if(!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="f_600 f_size_30 t_color3 text-center l_height40 mb_70 wow fadeInUp" data-wow-delay="0.3s">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if(!empty($settings['subtitle'])) : ?>
                        <p class="f_300 f_size_16 wow fadeInUp" data-wow-delay="0.4s">
                            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                        </p>
                    <?php endif; ?>
                    <div class="row software_featured_info">
                        <?php
                        unset($i, $feature);
                        if(is_array($features3)) {
                        $i = 0.3;
                        foreach ($features3 as $feature) {
                            ?>
                            <div class="col-lg-<?php echo esc_attr($column); ?> col-sm-6 wow fadeInUp" data-wow-delay="<?php echo esc_attr($i) ?>s">
                                <div class="software_featured_item text-center mb_20">
                                    <div class="s_icon">
                                        <?php if(!empty($feature['icon_bg']['url'])) : ?>
                                            <img src="<?php echo esc_url($feature['icon_bg']['url']) ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                        <?php endif; ?>
                                        <?php if(!empty($feature['image_icon']['url'])) : ?>
                                            <img class="icon" src="<?php echo esc_url($feature['image_icon']['url']); ?>" alt="<?php echo esc_attr($feature['title']) ?>">
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($feature['title'])) : ?>
                                        <h3 class="f_600 t_color3"><?php echo esc_html($feature['title']) ?></h3>
                                    <?php endif; ?>
                                    <?php if(!empty($feature['subtitle'])) : ?>
                                        <p class="f_size_15 mb-30"> <?php echo wp_kses_post(nl2br($feature['subtitle'])); ?> </p>
                                    <?php endif; ?>
                                    <?php if(!empty($feature['link_title'])) : ?>
                                        <a href="<?php echo esc_url($feature['link_url']['url']) ?>" class="learn_btn">
                                            <?php echo esc_html($feature['link_title']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                            $i = $i + 0.2;
                        }}
                        ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    }
}