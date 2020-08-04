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
class Saasland_processes extends Widget_Base {

    public function get_name() {
        return 'Saasland_processes';
    }

    public function get_title() {
        return __( 'Processes', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-product-related';
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
            ]
        );

        /// --------------- Images ----------------
        /// Image Fields
        $repeater_fields = new \Elementor\Repeater();

        $repeater_fields->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_fields->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Description text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_fields->add_control(
            'btn_type', [
                'label' => __( 'Button Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => 'Icon',
                    'button' => 'Button'
                ]
            ]
        );

        $repeater_fields->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater_fields->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Get in Touch',
                'condition' => [
                    'btn_type' => ['button']
                ]
            ]
        );

        $repeater_fields->add_control(
            'image', [
                'label' => __( 'Featured Image', 'saasland-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater_fields->add_control(
            'is_row_reverse',
            [
                'label' => __( 'Row Reverse', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'rows', [
                'label' => __( 'Processes', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater_fields->get_controls(),
            ]
        );

        $this->end_controls_section(); // End Hero content


        //------------------------------ Style Button Section ------------------------------
        $this->start_controls_section(
            'style_btn_sec', [
                'label' => __( 'Processes Button Style', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

         //---------------------------- Normal and Hover Style ---------------------------//
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
                    '{{WRAPPER}} .agency_banner_btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_banner_btn' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'normal_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_banner_btn' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .agency_banner_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );
        
        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_banner_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_banner_btn:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();

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
                    '{{WRAPPER}} .agency_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $rows = isset($settings['rows']) ? $settings['rows'] : '';
        ?>
        <section class="agency_featured_area">
            <div class="container">
                <?php if(!empty($settings['title'])) : ?>
                    <h2 class="f_size_30 f_600 t_color3 l_height40 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                    </h2>
                <?php endif; ?>
                <div class="features_info">
                    <?php
                    if(count($rows) == 2) { ?>
                        <img class="dot_img" src="<?php echo plugins_url('images/dot_2_items.png', __FILE__) ?>" alt="">
                        <?php
                    }elseif(count($rows) == 3) { ?>
                        <img class="dot_img" src="<?php echo plugins_url('images/dot_3_items.png', __FILE__) ?>" alt="">
                        <?php
                    }elseif(count($rows) == 5) { ?>
                        <img class="dot_img" src="<?php echo plugins_url('images/dot_5_items.png', __FILE__) ?>" alt="">
                        <?php
                    }
                    ?>
                    <?php
                    if(!empty($rows)) {
                        $i = 1;
                        foreach ($rows as $row) {
                            ?>
                            <div class="row agency_featured_item <?php echo $row['is_row_reverse'] == 'yes' ? 'flex-row-reverse' : 'agency_featured_item_two'; ?>">
                                <div class="col-lg-6">
                                    <div class="agency_featured_img text-right wow fadeInRight" data-wow-delay="0.4s">
                                        <?php echo wp_get_attachment_image($row['image']['id'], 'full') ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="agency_featured_content pr_70 pl_<?php echo $row['is_row_reverse'] == 'yes' ? '70' : '100'; ?> wow fadeInLeft" data-wow-delay="0.6s">
                                        <div class="dot"><span class="dot1"></span><span class="dot2"></span></div>
                                        <img class="number" src="<?php echo plugins_url('images/numbers/'.$i.'.png', __FILE__) ?>" alt="<?php echo esc_attr($row['title']) ?>">
                                        <?php if(!empty($row['title'])) : ?>
                                            <h3> <?php echo esc_html($row['title']) ?> </h3>
                                        <?php endif; ?>
                                        <?php echo wpautop($row['subtitle']) ?>
                                        <?php
                                        if($row['btn_type'] == 'icon') { ?>
                                            <a href="<?php echo esc_url($row['btn_url']['url']) ?>" <?php saasland_is_external($row['btn_url']) ?>
                                               class="icon mt_30"><i class="ti-arrow-right"></i></a>
                                            <?php
                                        }
                                        elseif($row['btn_type'] == 'button') {
                                            if(!empty($row['btn_title'])) {
                                                ?>
                                                <a href="<?php echo esc_url($row['btn_url']['url']) ?>" <?php saasland_is_external($row['btn_url']) ?>
                                                   class="btn_hover agency_banner_btn mt_30">
                                                    <?php echo esc_html($row['btn_title']) ?>
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            ++$i;
                        }
                    }
                    ?>
                    <div class="dot middle_dot <?php echo 'middle_dot'.$i; ?>"><span class="dot1"></span><span class="dot2"></span></div>
                </div>
            </div>
        </section>
        <?php
    }
}