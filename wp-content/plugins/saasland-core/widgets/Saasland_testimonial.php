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
class Saasland_testimonial extends \Elementor\Widget_Base {

    public function get_name() {
        return 'saasland_testimonial';
    }

    public function get_title() {
        return __( 'Saasland Testimonials', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }
     public function get_script_depends() {
        return [ 'slick', 'imagesloaded', 'isotope' ];
    }

     protected function render() {
        $settings = $this->get_settings();
        $testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : '';
        $testimonials2 = isset($settings['testimonials2']) ? $settings['testimonials2'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';


        if($settings['style'] == 'style_01') : ?>
            <section class="agency_testimonial_area sec_pad">
                <div class="container">
                    <?php if( !empty($settings['title']) ) : ?>
                        <<?php echo $title_tag; ?> class="f_size_30 f_600 t_color3 l_height40 text-center mb_60">
                            <?php echo wp_kses_post($settings['title']) ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif ?>
                    <div class="agency_testimonial_info">
                        <div class="testimonial_slider owl-carousel">
                            <?php
                            foreach ($testimonials as $index => $testimonial) :
                                switch ($index) {
                                    case 0:
                                        $align_class = 'left';
                                        break;
                                    case 1:
                                        $align_class = 'center';
                                        break;
                                    case 2:
                                        $align_class = 'right';
                                        break;
                                    default:
                                        $align_class = 'left';
                                }
                                ?>
                                <div class="testimonial_item text-center <?php echo esc_attr($align_class) ?>">
                                    <?php if(!empty($testimonial['testimonial_image']['id'])): ?>
                                        <div class="author_img">
                                            <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_70x70') ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($testimonial['name'])): ?>
                                        <div class="author_description">
                                            <h4 class="f_500 t_color3 f_size_18"> <?php echo esc_html($testimonial['name']); ?> </h4>
                                            <?php echo !empty($testimonial['designation']) ? '<h6>'.esc_html($testimonial['designation']).'</h6>' : ''; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php echo wpautop($testimonial['content']) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php

        elseif($settings['style'] == 'style_02') :
            ?>
            <section class="feedback_area dk_bg_one sec_pad">
                <div class="container custom_container">
                    <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.4s">
                        <?php if(!empty($settings['title'])) : ?>
                            <<?php echo $title_tag; ?> class="f_p f_size_30 l_height50 f_600 w_color">
                                <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                            </<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <?php if(!empty($settings['desc'])) : ?>
                            <p class="f_300 f_size_16 mb-0 d_p_color">
                                <?php echo wp_kses_post(nl2br($settings['desc'])) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="feedback_slider owl-carousel">
                        <?php
                        if(!empty($testimonials2)) {
                        unset($testimonial);
                        foreach ($testimonials2 as $testimonial) {
                            ?>
                            <div class="item">
                            <div class="feedback_item">
                                <div class="feed_back_author">
                                    <div class="media">
                                        <div class="img">
                                            <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_85x90') ?>
                                        </div>
                                        <div class="media-body">
                                            <?php if(!empty($testimonial['name'])) : ?>
                                                <h5 class="w_color f_size_15 f_p f_500"> <?php echo esc_html($testimonial['name']); ?> </h5>
                                            <?php endif; ?>
                                            <?php echo !empty($testimonial['designation']) ? '<h6 class="f_p f_300">'.esc_html($testimonial['designation']).'</h6>' : ''; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($testimonial['content'])) : ?>
                                    <p class="d_p_color f_size_15">
                                        <?php echo wp_kses_post($testimonial['content']) ?>
                                    </p>
                                <?php endif; ?>
                                <a href="#" class="post_date"> <?php echo $testimonial['date'] ?> </a>
                                <div class="shap_one"></div>
                                <div class="shap_two"></div>
                            </div>
                            </div>
                            <?php
                        }}
                        ?>
                    </div>
                </div>
            </section>
            <?php

        elseif($settings['style'] == 'style_03') :
            ?>
            <section class="app_testimonial_area">
                <div class="text_shadow" <?php  echo (!empty($settings['bg_title'])) ? 'data-line="'.esc_attr($settings['bg_title']).'"></div>' : ''; ?>
                <div class="container nav_container">
                    <div class="shap one"></div>
                    <div class="shap two"></div>
                    <div class="app_testimonial_slider owl-carousel">
                        <?php
                        if(!empty($testimonials)) {
                        unset($testimonial);
                        foreach ($testimonials as $testimonial) {
                            ?>
                            <div class="app_testimonial_item text-center">
                                <div class="author-img">
                                    <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_100x100') ?>
                                </div>
                                <div class="author_info">
                                    <?php if(!empty($testimonial['name'])) : ?>
                                        <h6 class="f_p f_500 f_size_18 t_color3 mb-0"> <?php echo esc_html($testimonial['name']); ?> </h6>
                                    <?php endif; ?>
                                    <?php echo !empty($testimonial['designation']) ? wpautop($testimonial['designation']) : ''; ?>
                                </div>
                                <p class="f_300"> <?php echo wp_kses_post($testimonial['content']) ?> </p>
                            </div>
                            <?php
                        }}
                        ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    }


    protected function _register_controls() {

        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => "We've heard things like"
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
                    '{{WRAPPER}} .text-center.mb_60' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sec_title .f_600.w_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .text-center.mb_60,
                    {{WRAPPER}} .sec_title .f_600.w_color
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Description  ------------------------------
        $this->start_controls_section(
            'desc_sec', [
                'label' => __( 'Description', 'saasland-core' ),
                'condition' => [
                    'style' => 'style_01',
                ]
            ]
        );

        $this->add_control(
            'desc', [
                'label' => esc_html__( 'Description Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_desc', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .sec_title p',
            ]
        );

        $this->end_controls_section(); // End description section



        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
			'testimonials', [
				'label' => __( 'Testimonials', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ name }}}',
                'condition' => [
                    'style' => ['style_01', 'style_03']
                ],
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
						'default' => 'Minus minim! Corporis exercitation earum interdum molestiae consequat, beatae odio fringilla penatibus perferendis voluptas accusamus eiusmod dapibus elit quasi mollit, id illo convallis nam suscipit aperiam, ullam consequatur laborum.'
					],
					[
						'name' => 'testimonial_image',
						'label' => __( 'Author Image', 'saasland-core' ),
						'type' => Controls_Manager::MEDIA,
					],
				],
			]
		);


        $this->add_control(
			'testimonials2', [
				'label' => __( 'Testimonials', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ name }}}',
                'condition' => [
                    'style' => ['style_02']
                ],
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
						'default' => 'Driver'
					],
					[
						'name' => 'date',
						'label' => __( 'Date', 'saasland-core' ),
						'type' => Controls_Manager::DATE_TIME,
                        'picker_options' => [
                            'enableTime' => false,
                            'dateFormat' => 'M d, Y'
                        ]
					],
					[
						'name' => 'content',
						'label' => __( 'Testimonial Text', 'saasland-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' => 'Minus minim! Corporis exercitation earum interdum molestiae consequat, beatae odio fringilla penatibus perferendis voluptas accusamus eiusmod dapibus elit quasi mollit, id illo convallis nam suscipit aperiam, ullam consequatur laborum.'
					],
					[
						'name' => 'testimonial_image',
						'label' => __( 'Author Image', 'saasland-core' ),
						'type' => Controls_Manager::MEDIA,
					],
				],
			]
		);

        $this->end_controls_section();


        
        //------------------------------ Style Title Content ------------------------------
        $this->start_controls_section(
            'style_counter_sec', [
                'label' => __( 'Style Title Content', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .media-body h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .author_info h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .author_description h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_counter_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .media-body h5,
                    {{WRAPPER}} .app_testimonial_item .author_info h6,
                    {{WRAPPER}} .agency_testimonial_info .author_description h4
                    ',
            ]
        );

        $this->end_controls_section();

        
        //------------------------------ Style Designation ------------------------------
        $this->start_controls_section(
            'style_designation_sec', [
                'label' => __( 'Style Designation', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'designation_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .media-body h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .author_info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .author_description h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_designation',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .media-body h6,
                    {{WRAPPER}} .app_testimonial_item .author_info p,
                    {{WRAPPER}} .agency_testimonial_info .author_description h6
                ',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_content_sec', [
                'label' => __( 'Style Content', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .feedback_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .f_300' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .testimonial_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_contents',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .feedback_item p,
                    {{WRAPPER}} .app_testimonial_item .f_300,
                    {{WRAPPER}} .agency_testimonial_info .testimonial_item p
                ',
            ]
        );

        $this->end_controls_section();

        
        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_bg_title', [
                'label' => __( 'Style Background Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );

        $this->add_control(
            'bg_title', [
                'label' => esc_html__( 'Background Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Feedback"
            ]
        );

        $this->add_control(
            'color_bg_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .app_testimonial_area .text_shadow:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_bg_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .app_testimonial_area .text_shadow:before',
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
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__('Style One', 'saasland-core'),
                    'style_02' => esc_html__('Style Two (Dark Background)', 'saasland-core'),
                    'style_03' => esc_html__('Style Three', 'saasland-core'),
                ],
                'default' => 'style_01'
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
                    '{{WRAPPER}} .agency_testimonial_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .feedback_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .feedback_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .app_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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