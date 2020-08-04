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
class Saasland_pricing_table extends Widget_Base {

	public function get_name() {
		return 'saasland-pricing-table';
	}

	public function get_title() {
		return __( 'Pricing table', 'saasland-hero' );
	}

	public function get_icon() {
		return ' eicon-price-list';
	}

	public function get_categories() {
		return [ 'saasland-elements' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
            'section_design', [
                'label' => __( 'Section Style', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__('Style one ', 'saasland-core'),
                    'style_02' => esc_html__('Style two ', 'saasland-core'),
                ],
                'default' => 'style_01'
            ]
        );

        $this->end_controls_section();


		// ------------------------------  Title Section ------------------------------
		$this->start_controls_section(
			'title_sec', [
				'label' => __( 'Title section', 'saasland-core' ),
			]
		);

		$this->add_control(
			'title', [
				'label' => esc_html__( 'Title text', 'saasland-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Pricing Table'
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

        $this->end_controls_section(); // End Title Section

        // ------------------------------  Subtitle Section ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => __( 'Subtitle section', 'saasland-core' ),
            ]
        );

		$this->add_control(
			'subtitle', [
				'label' => esc_html__( 'Subtitle text', 'saasland-core' ),
                'description' => esc_html__( 'Use <br> tag for line breaking.', 'saasland-core' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->end_controls_section(); // End Subtitle section


		// ------------------------------ Table Lists ------------------------------
		$this->start_controls_section(
			'contents', [
				'label' => __( 'Table Lists', 'saasland-core' ),
			]
		);

        // ------------------------------ Tables 01 ------------------------------
		$this->add_control(
			'tables', [
				'label' => __( 'Pricing Tables', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'condition' => [
                    'style' => 'style_01'
                ],
				'fields' => [
					[
						'name' => 'title',
						'label' => __( 'Title', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Education'
					],
					[
						'name' => 'title_html_tag',
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
                        'default' => 'h5',
                        'separator' => 'before',
					],
					[
						'name' => 'subtitle',
						'label' => __( 'Subtitle', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Create your first online course'
					],
					[
						'name' => 'ribbon_label',
						'label' => __( 'Ribbon Label', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
                        'name'      => 'icon_type',
                        'label'     => esc_html__('Icon Type', 'saasland-core'),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => [
                            'flaticon'     => esc_html__('Flat Icon', 'saasland-core'),
                            'themify_icon'     => esc_html__('Themify Icon', 'saasland-core'),
                        ],
                        'default' => 'flaticon',
                    ],
                    [
                        'name'       => 'flaticon',
                        'label'      => esc_html__('Icon', 'saasland-core'),
                        'type'       => Controls_Manager::ICON,
                        'options'     => saasland_flaticons(),
                        'include'    => saasland_include_flaticons(),
                        'default'    => 'flaticon-mortarboard',
                        'condition'  => [
                             'icon_type' => 'flaticon',
                        ],
                    ],
                    [
                        'name'       => 'themify_icon',
                        'label'      => esc_html__('Icon', 'saasland-core'),
                        'type'       => Controls_Manager::ICON,
                        'options'    => saasland_themify_icons(),
                        'include'    => saasland_include_themify_icons(),
                        'default'    => 'ti-ruler-pencil',
                        'condition'  => [
                             'icon_type' => 'themify_icon',
                        ],
                    ],
                    [
                        'name'       => 'icon_color',
                        'label'      => esc_html__('Icon Color', 'saasland-core'),
                        'type'       => Controls_Manager::COLOR,
                    ],
                    [
                        'name'       => 'icon_bg',
                        'label'      => esc_html__('Icon Background Image', 'saasland-core'),
                        'type'       => Controls_Manager::MEDIA,
                        'default'    => [
                            'url' => plugins_url('images/price_line1.png', __FILE__)
                        ]
                    ],
                    [
                        'name'       => 'bg_color',
                        'label'      => esc_html__('Background Color', 'saasland-core'),
                        'type'       => Controls_Manager::COLOR,
                    ],
                    /*
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'condition' => [
                            'icon_type' => 'image_icon',
                            'price_style_type' => 'style_two',
                        ],
                    ],*/
					[
						'name' => 'price',
						'label' => __( 'Price', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => '$49.00',
					],
					[
						'name' => 'duration',
						'label' => __( 'Duration', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'mo',
					],
					[
						'name' => 'contents',
						'label' => __( 'List items', 'saasland-core' ),
						'description' => __( 'Wrap up every list item with li tag (<li>Item Name</li>).', 'saasland-core' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' =>'<li>Product Recommendations</li>
                                    <li>Abandoned Cart</li>
                                    <li>Facebook &amp; Instagram Ads</li>
                                    <li>Order Notifications</li>
                                    <li>Landing Pages</li>',
					],
					[
						'name' => 'btn_label',
						'label' => __( 'Button label', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Choose This Plan',
                        'label_block' => true
					],
					[
						'name' => 'btn_url',
						'label' => __( 'Button URL', 'saasland-core' ),
						'type' => Controls_Manager::URL,
						'default' => [
							'url' => '#',
							'is_external' => '',
						],
						'show_external' => true,
					],
				],
			]
		);

        // ------------------------------ Tables 02 ------------------------------
        $table2 = new \Elementor\Repeater();

        $table2->add_control(
            'title', [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '$29.00'
            ]
        );

        $table2->add_control(
            'subtitle', [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $table2->add_control(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );

        $table2->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Started'
            ]
        );

        $table2->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $table2->add_control(
            'is_highlighted',
            [
                'label' => __( 'Highlighted', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $table2->add_control(
            'font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $table2->add_control(
            'bg_color2', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $table2->add_control(
            'bg_color3', [
                'label' => __( 'Background Color 02', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}}:before' => '    background-image: -webkit-linear-gradient(-140deg, {{bg_color.VALUE}} 0%, {{bg_color2.VALUE}} 36%, {{VALUE}} 100%);',
                )
            ]
        );


        $table2->start_controls_tabs(
            'style_tabs'
        );

        /// Normal Button Style
        $table2->start_controls_tab(
            'style_normal_btn',
            [
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );

        $table2->add_control(
            'btn_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn' => 'color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'btn_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn' => 'border-color: {{VALUE}}',
                )
            ]
        );

        $table2->end_controls_tab();

        /// ----------------------------- Hover Button Style
        $table2->start_controls_tab(
            'style_hover_btn',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );

        $table2->add_control(
            'btn_hover_font_color', [
                'label' => __( 'Font Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn:hover' => 'color: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'btn_hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn:hover' => 'background: {{VALUE}}',
                )
            ]
        );

        $table2->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} {{CURRENT_ITEM}} .payment_price_btn:hover' => 'border-color: {{VALUE}}',
                )
            ]
        );

        $table2->end_controls_tab();

        $this->add_control(
            'table2', [
                'label' => __( 'Tables', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => $table2->get_controls(),
                'condition' => [
                    'style' => 'style_02'
                ]
            ]
        );

		$this->end_controls_section(); // End Buttons



		/**
		 * Style Tab
		 * ------------------------------ Style Title ------------------------------
		 *
		 */
		$this->start_controls_section(
			'style_title', [
				'label' => __( 'Style title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'color_prefix', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .f_p.f_size_30.l_height50.f_600.t_color' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_prefix',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .f_p.f_size_30.l_height50.f_600.t_color',
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
					'{{WRAPPER}} .sec_title  p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .sec_title  p',
			]
		);
		$this->end_controls_section();


		//------------------------------ Style Table List Title ------------------------------
		$this->start_controls_section(
			'style_table_title_sec', [
				'label' => __( 'Style Table Title', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'color_table_title', [
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .t_color.mb-0.mt_40' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_table_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .t_color.mb-0.mt_40',
			]
		);
		$this->end_controls_section();




		//------------------------------ Style 01 Button Color ------------------------------
		$this->start_controls_section(
			'style_btn1_sec', [
				'label' => __( 'Pricing Button Style', 'saasland-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'btn_style_tabs'
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
                    '{{WRAPPER}} .btn_three' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .btn_three:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_border_color', [
                'label' => __( 'Border Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_three:hover' => 'border-color: {{VALUE}}',
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
					'{{WRAPPER}} .s_pricing_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .payment_priceing_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$tables = isset($settings['tables']) ? $settings['tables'] : '';
		$table2 = isset($settings['table2']) ? $settings['table2'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

        if($settings['style'] == 'style_01') :
            ?>
            <section class="s_pricing_area sec_pad">
                <div class="container custom_container">
                    <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s">
                        <?php if(!empty($settings['title'])) : ?>
                            <<?php echo esc_html($title_tag); ?> class="f_p f_size_30 l_height50 f_600 t_color"> <?php echo wp_kses_post($settings['title']); ?> </<?php echo esc_html($title_tag); ?>>
                        <?php endif; ?>
                        <?php if(!empty($settings['subtitle'])) : ?>
                            <p class="f_300 f_size_18 l_height34"> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                        <?php endif; ?>
                    </div>
                    <div class="row mb_30">
                        <?php
                        foreach ($tables as $i => $table) {
                            $title_tag = !empty($table['title_html_tag']) ? $table['title_html_tag'] : 'h5';
                            $icon_color = !empty($table['icon_color']) ? "style='color:{$table['icon_color']};'" : '';
                            $icon = '';
                            if($table['icon_type'] == 'flaticon') {
                                $icon = !empty($table['flaticon']) ? $table['flaticon'] : '';
                            }elseif($table['icon_type'] == 'themify_icon') {
                                $icon = !empty($table['themify_icon']) ? $table['themify_icon'] : '';
                            }
                            $anim = 'fadeInLeft';
                            $anim_dur = '4';
                            switch ($i) {
                                case 0:
                                    $anim = 'fadeInLeft';
                                    $anim_dur = '4';
                                    break;
                                case 1:
                                    $anim = 'fadeInUp';
                                    $anim_dur = '6';
                                    break;
                                case 2:
                                    $anim = 'fadeInRight';
                                    $anim_dur = '8';
                                    break;
                            }

                            ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="s_pricing-item wow <?php echo esc_attr($anim) ?>" data-wow-delay="0.<?php echo esc_attr($anim_dur) ?>s" style="background: <?php echo $table['bg_color'] ?>;">
                                    <?php if(!empty($table['ribbon_label'])) : ?>
                                        <div class="tag_label blue_bg"> <?php echo esc_html($table['ribbon_label']) ?> </div>
                                    <?php endif; ?>
                                    <?php if(!empty($table['icon_bg']['url'])) : ?>
                                        <img class="shape_img" src="<?php echo esc_url($table['icon_bg']['url']) ?>" alt="<?php echo esc_attr($table['title']) ?>">
                                    <?php endif; ?>
                                    <div class="s_price_icon p_icon1">
                                        <i <?php echo $icon_color; ?> class="<?php echo $icon; ?>"></i>
                                    </div>
                                    <?php if(!empty($table['title'])) : ?>
                                        <<?php echo $title_tag; ?> class="f_p f_500 f_size_18 t_color mb-0 mt_40"> <?php echo esc_html($table['title']) ?> </<?php echo $title_tag; ?>>
                                    <?php endif; ?>
                                    <?php /*if(!empty($table['subtitle'])) : */?><!--
                                        <p class="f_p f_300"> <?php /*echo esc_html($table['subtitle']) */?> </p>
                                    --><?php /*endif; */?>
                                    <?php echo !empty($table['titles']) ? wp_kses_post($table['titles']) : ''; ?>
                                    <div class="price f_size_40 f_p f_600">
                                        <?php echo esc_html($table['price']) ?>
                                        <?php if(!empty($table['duration'])) : ?>
                                            <sub class="f_300 f_size_16"> / <?php echo esc_html($table['duration']) ?> </sub>
                                        <?php endif; ?>
                                    </div>
                                    <ul class="list-unstyled mt_30">
                                        <?php echo wp_kses_post($table['contents']) ?>
                                    </ul>
                                    <?php if(!empty($table['btn_label'])) :
                                        $target = $table['btn_url']['is_external'] ? ' target="_blank"' : '';
                                        $nofollow = $table['btn_url']['nofollow'] ? ' rel="nofollow"' : '';
                                        $url = !empty($table['btn_url']['url']) ? $table['btn_url']['url'] : '';
                                        ?>
                                        <a href="<?php echo esc_url($url) ?>" <?php echo $target . $nofollow ?> class="btn_three btn_hover">
                                            <?php echo esc_html($table['btn_label']) ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        <?php

        elseif($settings['style'] == 'style_02'):
            ?>
            <section class="payment_priceing_area">
                <div class="container">
                    <div class="sec_title mb_70 wow fadeInUp text-center" data-wow-delay="0.4s">
                        <?php if(!empty($settings['title'])) : ?>
                            <h2 class="f_p f_size_30 l_height40 f_700 t_color"> <?php echo wp_kses_post($settings['title']); ?> </h2>
                        <?php endif; ?>
                        <?php if(!empty($settings['subtitle'])) : ?>
                            <p class="f_400 f_size_18 l_height34"> <?php echo wp_kses_post($settings['subtitle']) ?> </p>
                        <?php endif; ?>
                    </div>
                    <div class="payment_price_info">
                        <?php
                        foreach ($table2 as $i => $table) {
                            ?>
                            <div class="payment_price_item <?php echo ($table['is_highlighted']) == 'yes' ? 'center' : ''; ?> elementor-repeater-item-<?php echo $table['_id']; ?>">
                                <?php if (!empty($table['title'])) : ?>
                                    <h2> <?php echo wp_kses_post(nl2br($table['title'])); ?> </h2>
                                <?php endif; ?>
                                <?php if (!empty($table['subtitle'])) : ?>
                                    <h6> <?php echo wp_kses_post(nl2br($table['subtitle'])); ?> </h6>
                                <?php endif; ?>
                                <?php echo (!empty($table['contents'])) ? wp_kses_post(wpautop($table['contents'])) : ''; ?>
                                <?php if(!empty($table['btn_title'])) : ?>
                                    <a href="<?php echo esc_url($table['btn_url']['url']) ?>" <?php saasland_is_external($table['btn_url']) ?> class="payment_price_btn">
                                        <?php echo esc_html($table['btn_title']) ?> <i class="ti-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <?php
	    endif;
	}
}