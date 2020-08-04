<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use WP_Query;



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
class Saasland_blog extends Widget_Base {

    public function get_name() {
        return 'saasland_blog';
    }

    public function get_title() {
        return __( 'Blog posts', 'saasland-core' );
    }

    public function get_icon() {
        return ' eicon-post';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        //----------------------------------------------------- Featured Post ID ---------------------------------------------------------//
        $this->start_controls_section(
            'featured_post_sec', [
                'label' => __( 'Featured Post', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'featured_post', [
                'label' => esc_html__( 'Featured Post ID', 'saasland-core' ),
                'description' => __( '<a href="https://pagely.com/blog/find-post-id-wordpress/" target="_blank">How to Find the Post ID?</a>', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();


        //--------------------------------------------------- Buttons Section ---------------------------------------------------------------//
        $this->start_controls_section(
            'button_sec', [
                'label' => __( 'Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_title', [
                'label' => __( 'Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Meet Your Team'
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => __( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
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
                    '{{WRAPPER}} .about_btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn' => 'background: {{VALUE}}',
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
                    '{{WRAPPER}} .about_btn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );
        
        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_section();


        // ----------------------------- Posts Carousel ----------------------
        $this->start_controls_section(
            'posts_carousel', [
                'label' => __( 'Posts Carousel', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'slide_cats', [
                'label' => __( 'Slide Category', 'saasland-core' ),
                'description' => __( 'The slide items are category based. You have to choose a post category to show a slide item and make sure it contains at least 3 posts.', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ cat }}}',
                'fields' => [
                    [
                        'name' => 'cat',
                        'label' => __( 'Category Name', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => saasland_cat_array(),
                        'default' => 'all'
                    ]
                ],
            ]
        );

        $this->end_controls_section();



        // ---------------------------------- Filter Options ------------------------
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        /*$this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show Posts Count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
            ]
        );*/

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->end_controls_section();


        //----------------------------- Style Title Section --------------------------------//
        $this->start_controls_section(
            'style_title_sec', [
                'label' => __( 'Title Section', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .f_size_30.f_700.l_height45.mb_20' => 'color: {{VALUE}}',
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'saasland-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .f_size_30.f_700.l_height45.mb_20',
			]
		);

        $this->end_controls_section();


        //----------------------------- Style Subtitle Section --------------------------------//
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => __( 'Subtitle Section', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Text Color', 'saasland-core' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} p.f_size_15.f_300.mb_40' => 'color: {{VALUE}}',
				],
			]
        );
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Typography', 'saasland-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} p.f_size_15.f_300.mb_40',
			]
		);

        $this->end_controls_section();

        
        //----------------------------- Style Background Gradient --------------------------------//
        $this->start_controls_section(
            'style_sec', [
                'label' => __( 'Left Gradient Color', 'saasland-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'fpb_color_left', [
                'label'     => esc_html__('Color One', 'saasland-core'),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'fpb_color_right', [
                'label'     => esc_html__('Color Two', 'saasland-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [ 
                    '.about_content' => 'background-image: -webkit-linear-gradient(40deg, {{fpb_color_left.VALUE}} 0%, {{VALUE}} 100%)'
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        $featured_post = new WP_Query(array(
            'post_type'     => 'post',
            'posts_per_page'=> -1,
            'p' => $settings['featured_post'],
        ));
        ?>


            <section class="agency_about_area d-flex">
                <?php
                while($featured_post->have_posts()) : $featured_post->the_post();
                    $excerpt = get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30, '');
                    ?>
                    <div class="col-lg-6 about_content_left ">
                        <div class="about_content mb_30">
                            <h2 class="f_size_30 f_700 l_height45 mb_20"> <?php the_title() ?> </h2>
                            <p class="f_size_15 f_300 mb_40"> <?php echo wp_kses_post($excerpt) ?> </p>
                            <?php if(!empty($settings['btn_title'])) : ?>
                                <a href="<?php the_permalink() ?>" class="about_btn">
                                    <?php echo esc_html($settings['btn_title']) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
                <div class="col-lg-6 about_img">
                    <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="pluse_icon"><i class="ti-link"></i></a>
                    <div class="about_img_slider owl-carousel">

                        <?php
                        if(!empty($settings['slide_cats'])) {
                        foreach ($settings['slide_cats'] as $cat) {
                            echo '<div class="item">';

                                if($cat['cat'] == 'all') {
                                    $cat_posts = new WP_Query(array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 3,
                                    ));
                                }else {
                                    $cat_posts = new WP_Query(array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 3,
                                        'category_name' => $cat['cat'],
                                    ));
                                }

                                $cat_i = 0;
                                while($cat_posts->have_posts()) : $cat_posts->the_post();
                                    ?>
                                    <div class="about_item <?php echo ($cat_i == 0) ? 'w45' : 'w55'; ?>">
                                        <?php
                                        $image_size = ($cat_i == 0) ? 'saasland_455x600' : 'saasland_520x300';
                                        the_post_thumbnail($image_size);
                                        ?>
                                        <div class="about_text">
                                            <span class="br"></span>
                                            <a href="<?php the_permalink() ?>">
                                                <h5 class="f_size_18 l_height28 mb-0"> <?php the_title() ?> </h5>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                    ++$cat_i;
                                endwhile;
                                wp_reset_postdata();
                            echo '</div>';
                        }}
                        ?>
                    </div>
                </div>
            </section>
        <?php
    }
}