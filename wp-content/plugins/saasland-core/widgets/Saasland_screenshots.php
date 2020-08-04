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
class Saasland_screenshots extends Widget_Base {

	public function get_name() {
		return 'saasland-screenshots';
	}

	public function get_title() {
		return __( 'Screenshots Carousel', 'saasland-core' );
	}

	public function get_icon() {
		return ' eicon-post-slider';
	}

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	protected function _register_controls() {

		// ------------------------------  Title Section ------------------------------
		$this->start_controls_section(
			'title_sec', [
				'label' => __( 'Title section', 'saasland-core' ),
			]
		);

		$this->add_control(
			'title_text', [
				'label' => esc_html__( 'Title text', 'saasland-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Awesome app Screenshots'
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
			'subtitle_text', [
				'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$this->end_controls_section(); // End title section


		// ------------------------------  Featured images ------------------------------
		$this->start_controls_section(
			'images_sec', [
				'label' => __( 'Images', 'saasland-core' ),
			]
		);
		$this->add_control(
			'images', [
				'label' => esc_html__( 'Add images', 'saasland-core' ),
				'type' => Controls_Manager::GALLERY,
			]
		);
		$this->end_controls_section(); // End title section


		/**
		 * Style Tab
		 * ------------------------------ Style Title ------------------------------
		 *
		 */
		$this->start_controls_section(
			'style_title', [
				'label' => __( 'Style section title', 'saasland-core' ),
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
					'{{WRAPPER}} .t_color3.mb_20' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .t_color3.mb_20',
			]
		);
		$this->end_controls_section();


		//------------------------------ Style subtitle ------------------------------
		$this->start_controls_section(
			'style_subtitle', [
				'label' => __( 'Style subtitle', 'saasland-core' ),
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
					'{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .sec_title p',
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
                'selectors' => [
                    '{{WRAPPER}} .app_screenshot_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .app_screenshot_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$images = isset($settings['images']) ? $settings['images'] : '';
		$title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        ?>
        <section class="app_screenshot_area sec_pad">
            <div class="container custom_container p0">
                <div class="sec_title text-center mb_70">
                    <?php if(!empty($settings['title_text'])) : ?>
                        <<?php echo $title_tag; ?> class="f_p f_size_30 l_height30 f_700 t_color3 mb_20 wow fadeInUp" data-wow-delay="0.2s">
                            <?php echo $settings['title_text']; ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if(!empty($settings['subtitle_text'])) : ?>
                        <?php echo '<p class="f_300 f_size_16 wow fadeInUp" data-wow-delay="0.4s">'.nl2br(wp_kses_post($settings['subtitle_text'])).'</p>';
                    endif; ?>
                </div>
                <div class="app_screen_info">
                    <div class="app_screenshot_slider owl-carousel">
                        <?php
                        if(is_array($images)) {
                            foreach ($images as $image) {
                                echo '<div class="item">
                                        <div class="screenshot_img">
                                            <a href="'.$image['url'].'" class="image-link">
                                                '.wp_get_attachment_image($image['id'], 'full').'
                                            </a>
                                         </div>
                                      </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
	}

}