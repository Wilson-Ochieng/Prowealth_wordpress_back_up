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
class Saasland_two_column_features extends Widget_Base {

    public function get_name() {
        return 'saasland_features';
    }

    public function get_title() {
        return __( 'Two Column Features', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-column';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ----------------------------------------  Hero content ------------------------------
        $this->start_controls_section(
            'contents_sec',
            [
                'label' => __( 'Content', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Manage conversations with leads and customers at scale'
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
                'label' => esc_html__( 'Description text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );


        /// --------------- Images ----------------
        /// Image Fields
        $image_fields = new \Elementor\Repeater();

        $image_fields->add_control(
            'alt', [
                'label' => __( 'Image Alt Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Featured Image'
            ]
        );

        $image_fields->add_control(
            'image', [
                'label' => __( 'Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/featureimg1.png', __FILE__)
                ]
            ]
        );

        $image_fields->add_control(
            'delay', [
                'label' => __( 'Animation Delay', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's'],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'data-wow-delay: 0.{{SIZE}}s;',
                ],
            ]
        );

        $image_fields->add_control(
            'animation', [
                'label' => __( 'Animation', 'saasland-core' ),
                'type' => Controls_Manager::ANIMATION,
            ]
        );

        $image_fields->add_control(
            'position', [
                'label' => __( 'Position', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
            ]
        );

        $this->add_control(
            'images', [
                'label' => __( 'Featured Images', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ alt }}}',
                'fields' => $image_fields->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Hero content


        // ------------------------------ Icon ------------------------------
        $this->start_controls_section(
            'icon_sec', [
                'label' => __( 'Icon', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'ti',
                'options' => [
                    'ti' => __( 'Themify Icon', 'saasland-core' ),
                    'image_icon' => __( 'Image Icon', 'saasland-core' ),
                ],
            ]
        );

        $this->add_control(
            'ti',
            [
                'label' => __( 'Icon', 'saasland-core' ),
                'type' => Controls_Manager::ICON,
                'options' => saasland_themify_icons(),
                'include' => saasland_include_themify_icons(),
                'default' => 'ti-comments',
                'condition' => [
                    'icon_type' => 'ti'
                ]
            ]
        );

        $this->add_control(
            'image_icon',
            [
                'label' => __( 'Image Icon', 'saasland-core' ),
                'description' => 'This image will be used as the background image if you use font icon (Themify)',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/f_icon_shape1.png', __FILE__),
                ],
            ]
        );
        $this->end_controls_section(); // End Hero content


        $this->start_controls_section(
            'style_sec', [
                'label' => __( 'Section Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB
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
                'selectors' => [
                    '{{WRAPPER}} .features_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'is_row_reverse',
            [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section(); // End Hero content


        //------------------------------ Style Title ------------------------------
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
                    '{{WRAPPER}} .f_600.f_size_30.title_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .f_600.f_size_30.title_color',
            ]
        );

        $this->end_controls_section();


    }

    protected function render() {
        $settings = $this->get_settings();
        $features = isset($settings['features']) ? $settings['features'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        ?>
        <section class="features_area">
        <div class="container">
        <?php if($settings['is_row_reverse'] != 'yes') { ?>
            <div class="row feature_info">
                <div class="col-lg-7">
                    <div class="feature_img f_img_one">
                        <?php
                        if (!empty($settings['images'])) {
                        foreach ($settings['images'] as $i => $image) {
                            $anim_delay = !empty($image['delay']['size']) ? $image['delay']['size'] : '0.2';
                            $animation = !empty($image['animation']) ? $image['animation'] : 'fadeIn';
                            ?>
                            <style>
                                .feature_info .feature_img.f_img_two .elementor-repeater-item-<?php echo $image['_id'] ?> {
                                <?php echo !empty($image['position']['top']) ? "top: {$image['position']['top']}px;" : ''; ?>
                                <?php echo !empty($image['position']['right']) ? "right: {$image['position']['right']}px;" : ''; ?>
                                <?php echo !empty($image['position']['bottom']) ? "bottom: {$image['position']['bottom']}px;" : ''; ?>
                                <?php echo !empty($image['position']['left']) ? "left: {$image['position']['left']}px;" : ''; ?>
                                }
                            </style>
                            <?php
                            switch ($i) {
                                case 0:
                                    $index = 'one';
                                    break;
                                case 1:
                                    $index = 'two';
                                    break;
                                case 2:
                                    $index = 'three';
                                    break;
                                case 3:
                                    $index = 'four';
                                    break;
                                default:
                                    $index = 'one';
                            }
                            echo "<img data-wow-delay='$anim_delay' class='leaf $index wow $animation elementor-repeater-item-{$image['_id']}' 
                                   src='{$image['image']['url']}' alt='{$image['alt']}'>";
                        }}
                        ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="f_content">
                        <div class="icon">
                            <?php if (!empty($settings['image_icon']['url'])) : ?>
                                <img src="<?php echo esc_url($settings['image_icon']['url']) ?>" alt="">
                            <?php endif; ?>
                            <?php if (!empty($settings['icon_type'] == 'ti')) : ?>
                                <i class="<?php echo esc_attr($settings['ti']) ?>"></i>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_600 f_size_30 title_color"> <?php echo wp_kses_post($settings['title']) ?> </<?php echo $title_tag ?>>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle'])) : ?>
                            <p> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }

        elseif($settings['is_row_reverse'] == 'yes') {
            ?>
            <div class="row feature_info flex-row-reverse mt_130">
                <div class="col-lg-5 offset-lg-2">
                    <div class="feature_img f_img_two">
                        <?php
                        if (!empty($settings['images'])) {
                        foreach ($settings['images'] as $i => $image) {
                            ?>
                            <style>
                                .feature_info .feature_img.f_img_two .elementor-repeater-item-<?php echo $image['_id'] ?> {
                                    <?php echo !empty($image['position']['top']) ? "top: {$image['position']['top']}px;" : ''; ?>
                                    <?php echo !empty($image['position']['right']) ? "right: {$image['position']['right']}px;" : ''; ?>
                                    <?php echo !empty($image['position']['bottom']) ? "bottom: {$image['position']['bottom']}px;" : ''; ?>
                                    <?php echo !empty($image['position']['left']) ? "left: {$image['position']['left']}px;" : ''; ?>
                                }
                            </style>
                            <?php
                            $anim_delay = !empty($image['delay']['size']) ? $image['delay']['size'] : '0.2';
                            $animation = !empty($image['animation']) ? $image['animation'] : 'fadeIn';
                            switch ($i) {
                                case 0:
                                    $index = 'one';
                                    break;
                                case 1:
                                    $index = 'two';
                                    break;
                                case 2:
                                    $index = 'three';
                                    break;
                                case 3:
                                    $index = 'four';
                                    break;
                                default:
                                    $index = 'one';
                            }
                            echo "<img data-wow-delay='$anim_delay' class='leaf $index wow $animation elementor-repeater-item-{$image['_id']}' src='{$image['image']['url']}' alt='{$image['alt']}'>";
                        }}
                        ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="f_content">
                        <div class="icon">
                            <?php if (!empty($settings['image_icon']['url'])) : ?>
                                <img src="<?php echo esc_url($settings['image_icon']['url']) ?>" alt="">
                            <?php endif; ?>
                            <?php if (!empty($settings['icon_type'] == 'ti')) : ?>
                                <i class="<?php echo esc_attr($settings['ti']) ?>"></i>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_600 f_size_30 title_color"> <?php echo wp_kses_post($settings['title']) ?> </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if (!empty($settings['subtitle'])) : ?>
                            <p> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }
            ?>
        </div>
        </section>
        <?php
    }
}