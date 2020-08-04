<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

if (!defined("GORDON_THEME_DIR")) define("GORDON_THEME_DIR", trailingslashit( get_template_directory() ));
if (!defined("GORDON_CHILD_DIR")) define("GORDON_CHILD_DIR", trailingslashit( get_stylesheet_directory() ));

// Theme storage
$GORDON_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'contact-form-7',
		'essential-grid',
		'instagram-feed',
		'js_composer',
		'mailchimp-for-wp',
		'revslider',
		'vc-extensions-bundle'
		)
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('gordon_theme_setup1') ) {
	add_action( 'after_setup_theme', 'gordon_theme_setup1', 1 );
	function gordon_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'gordon', gordon_get_folder_dir('languages') );

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'gordon_filter_content_width', 1170 );
	}
}

if ( !function_exists('gordon_theme_setup') ) {
	add_action( 'after_setup_theme', 'gordon_theme_setup' );
	function gordon_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				gordon_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			gordon_theme_fonts_for_editor()
			)
		);	
		
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('gordon_filter_add_thumb_sizes', array(
			'gordon-thumb-huge'		=> array(1170, 658, true),
			'gordon-thumb-big' 		=> array( 760, 428, true),
			'gordon-thumb-med' 		=> array( 740, 462, true),
			'gordon-thumb-tiny' 		=> array(  200,  200, true),
			'gordon-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'gordon-thumb-masonry'		=> array( 740,   0, false),		// Only downscale, not crop
			'gordon-thumb-related'		=> array( 474,   320, true),
			'gordon-thumb-team'		=> array( 352,   352, true),
			)
		);
		$mult = gordon_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'gordon_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'gordon'),
			'menu_mobile' => esc_html__('Mobile Menu', 'gordon'),
			'menu_footer' => esc_html__('Footer Menu', 'gordon')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'gordon_excerpt_length' );
		add_filter( 'excerpt_more',							'gordon_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'gordon_wp_head', 0);
		
		// Add custom inline styles
		add_action('wp_footer',		 						'gordon_wp_footer');
		add_action('admin_footer',	 						'gordon_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'gordon_wp_scripts', 1000);			// priority 1000 - load styles
																									// before the plugin's support custom styles
																						
		add_action('wp_footer',		 						'gordon_localize_scripts');
		add_action('wp_enqueue_scripts', 					'gordon_wp_scripts_responsive', 2000);	// priority 2000 - load responsive
																									// after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'gordon_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'gordon_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'gordon_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------
if ( !function_exists('gordon_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'gordon_image_sizes' );
	function gordon_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('gordon_filter_add_thumb_sizes', array(
			'gordon-thumb-huge'		=> esc_html__( 'Fullsize image', 'gordon' ),
			'gordon-thumb-big'			=> esc_html__( 'Large image', 'gordon' ),
			'gordon-thumb-med'			=> esc_html__( 'Medium image', 'gordon' ),
			'gordon-thumb-tiny'		=> esc_html__( 'Small square avatar', 'gordon' ),
			'gordon-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'gordon' ),
			'gordon-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'gordon' ),
			)
		);
		$mult = gordon_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'gordon' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'gordon_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'gordon_trx_addons_add_thumb_sizes');
	function gordon_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'gordon_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'gordon_trx_addons_get_thumb_size');
	function gordon_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							'trx_addons-thumb-related',
							'trx_addons-thumb-related-@retina',
							'trx_addons-thumb-team',
							'trx_addons-thumb-team-@retina',
							),
							array(
							'gordon-thumb-huge',
							'gordon-thumb-huge-@retina',
							'gordon-thumb-big',
							'gordon-thumb-big-@retina',
							'gordon-thumb-med',
							'gordon-thumb-med-@retina',
							'gordon-thumb-tiny',
							'gordon-thumb-tiny-@retina',
							'gordon-thumb-masonry-big',
							'gordon-thumb-masonry-big-@retina',
							'gordon-thumb-masonry',
							'gordon-thumb-masonry-@retina',
							'gordon-thumb-related',
							'gordon-thumb-related-@retina',
							'gordon-thumb-team',
							'gordon-thumb-team-@retina',
							),
							$thumb_size);
	}
}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'gordon_wp_scripts' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'gordon_wp_scripts', 1000);
	function gordon_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = gordon_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('gordon-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello-icons',  gordon_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'gordon-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'gordon-child', $child_stylesheet, array('gordon-main'), null );
		}

		// Add custom bg image for the body_style == 'boxed'
		if ( gordon_get_theme_option('body_style') == 'boxed' && ($bg_image = gordon_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'gordon-main', '.body_style_boxed { background-image:url('.esc_url($bg_image).') }' );

		// Merged styles
		if ( gordon_is_off(gordon_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'gordon-styles', gordon_get_file_url('css/__styles.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && gordon_is_off(gordon_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'gordon-colors', gordon_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'gordon-main', gordon_customizer_get_css() );

		// Add post nav background
		gordon_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( in_array(substr(gordon_get_theme_option('blog_style'), 0, 7), array('gallery', 'portfol', 'masonry')) )
			wp_enqueue_script( 'modernizr', gordon_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', gordon_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if (false )
			wp_enqueue_script( 'gordon-init', gordon_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', gordon_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = gordon_get_header_video();
			if (!empty($header_video) && !gordon_is_inherit($header_video)) {
				if (gordon_is_youtube_url($header_video))
					wp_enqueue_script( 'tubular', gordon_get_file_url('js/jquery.tubular.js'), array('jquery'), null, true );
				else
					wp_enqueue_script( 'bideo', gordon_get_file_url('js/bideo.js'), array(), null, true );
			}
			// Theme scripts
			wp_enqueue_script( 'gordon-utils', gordon_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'gordon-init', gordon_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (gordon_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'gordon_localize_scripts' ) ) {
	//Handler of the add_action('wp_footer', 'gordon_localize_scripts');
	function gordon_localize_scripts() {

		$video = gordon_get_header_video();

		wp_localize_script( 'gordon-init', 'GORDON_STORAGE', apply_filters( 'gordon_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', gordon_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
			'mobile_device' => wp_is_mobile(),
						
			// Sidemenu options
			'menu_side_stretch' => gordon_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => gordon_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => gordon_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => gordon_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'comment_maxlength'	=> intval(gordon_get_theme_setting('comment_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'gordon'),
					'error_global'		=> esc_html__('Error data validation!', 'gordon'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'gordon'),
					'name_long'			=> esc_html__('Too long name', 'gordon'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'gordon'),
					'email_long'		=> esc_html__('Too long email address', 'gordon'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'gordon'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'gordon'),
					'text_long'			=> esc_html__('Too long message text', 'gordon')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'gordon_wp_scripts_responsive' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'gordon_wp_scripts_responsive', 2000);
	function gordon_wp_scripts_responsive() {
		wp_enqueue_style( 'gordon-responsive', gordon_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('gordon_wp_head')) {
	//Handler of the add_action('wp_head',	'gordon_wp_head', 1);
	function gordon_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('gordon_add_body_classes') ) {
	//Handler of the add_filter( 'body_class', 'gordon_add_body_classes' );
	function gordon_add_body_classes( $classes ) {
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr(gordon_get_theme_option('color_scheme'));

		$blog_mode = gordon_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(gordon_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(gordon_get_theme_option('blog_style'));
			if (gordon_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
		
		if (gordon_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(gordon_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (gordon_is_on(gordon_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (gordon_is_on(gordon_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(gordon_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(gordon_get_theme_option("header_position"));

		$menu_style= gordon_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load inline styles
if ( !function_exists( 'gordon_wp_footer' ) ) {
	//Handler of the add_action('wp_footer', 'gordon_wp_footer');
	function gordon_wp_footer() {
		// Get inline styles
		if (($css = gordon_get_inline_css()) != '') {
			wp_enqueue_style(  'gordon-inline-styles',  gordon_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'gordon-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('gordon_register_sidebars') ) {
	// Handler of the add_action('widgets_init', 'gordon_register_sidebars');
	function gordon_register_sidebars() {
		$sidebars = gordon_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => $sb['name'],
										'description'   => $sb['description'],
										'id'            => $id,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('gordon_get_sidebars') ) {
	function gordon_get_sidebars() {
		$list = apply_filters('gordon_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'gordon'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'gordon')
											),
			'header_widgets'		=> array(
											'name' => esc_html__('Header Widgets', 'gordon'),
											'description' => esc_html__('Widgets to be shown at the top of the page (in the page header area)', 'gordon')
											),
			'above_page_widgets'	=> array(
											'name' => esc_html__('Above Page Widgets', 'gordon'),
											'description' => esc_html__('Widgets to be shown below the header, but above the content and sidebar', 'gordon')
											),
			'above_content_widgets' => array(
											'name' => esc_html__('Above Content Widgets', 'gordon'),
											'description' => esc_html__('Widgets to be shown above the content, near the sidebar', 'gordon')
											),
			'below_content_widgets' => array(
											'name' => esc_html__('Below Content Widgets', 'gordon'),
											'description' => esc_html__('Widgets to be shown below the content, near the sidebar', 'gordon')
											),
			'below_page_widgets' 	=> array(
											'name' => esc_html__('Below Page Widgets', 'gordon'),
											'description' => esc_html__('Widgets to be shown below the content and sidebar, but above the footer', 'gordon')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'gordon'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'gordon')
											)
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('gordon_theme_fonts_links') ) {
	function gordon_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Google fonts: on or off', 'gordon' ) );
		$custom_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Custom fonts (included in the theme): on or off', 'gordon' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !gordon_storage_empty('load_fonts') ) {
			$load_fonts = gordon_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = gordon_get_load_fonts_slug($font['name']);
					$url  = gordon_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', gordon_get_protocol(), $google_fonts, gordon_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('gordon_theme_fonts_for_editor') ) {
	function gordon_theme_fonts_for_editor() {
		$links = array_values(gordon_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('gordon_excerpt_length') ) {
	function gordon_excerpt_length( $length ) {
		return max(1, gordon_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('gordon_excerpt_more') ) {
	function gordon_excerpt_more( $more ) {
		return '&hellip;';
	}
}

// Add checkbox with "I agree ..."
if ( ! function_exists( 'gordon_comment_form_agree' ) ) {
    add_filter('comment_form_fields', 'gordon_comment_form_agree', 11);
    function gordon_comment_form_agree( $comment_fields ) {
        $privacy_text = gordon_get_privacy_text();
        if ( ! empty( $privacy_text ) ) {
            $comment_fields['i_agree_privacy_policy'] = gordon_single_comments_field(
                array(
                    'form_style'        => 'default',
                    'field_type'        => 'checkbox',
                    'field_req'         => '',
                    'field_icon'        => '',
                    'field_value'       => '1',
                    'field_name'        => 'i_agree_privacy_policy',
                    'field_title'       => $privacy_text,
                )
            );
        }
        return $comment_fields;
    }
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'gordon_importer_set_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_importer_options',	'gordon_importer_set_options', 9 );
	function gordon_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(gordon_get_protocol() . '://demofiles.ancorathemes.com/gordon/');
			// Required plugins
			$options['required_plugins'] = gordon_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('Gordon Demo', 'gordon');
			$options['files']['default']['domain_dev'] = esc_url(gordon_get_protocol().'://gordon.dv.ancorathemes.com/');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(gordon_get_protocol().'://gordon.ancorathemes.com');		// Demo-site domain
		}
		return $options;
	}
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once GORDON_THEME_DIR . 'includes/utils.php';
require_once GORDON_THEME_DIR . 'includes/storage.php';
require_once GORDON_THEME_DIR . 'includes/lists.php';
require_once GORDON_THEME_DIR . 'includes/wp.php';

if (is_admin()) {
	require_once GORDON_THEME_DIR . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once GORDON_THEME_DIR . 'includes/admin.php';
}

require_once GORDON_THEME_DIR . 'theme-options/theme.customizer.php';

require_once GORDON_THEME_DIR . 'includes/theme.tags.php';
require_once GORDON_THEME_DIR . 'includes/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($GORDON_STORAGE['required_plugins']) && count($GORDON_STORAGE['required_plugins']) > 0) {
	foreach ($GORDON_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = gordon_esc($plugin_slug);
		$plugin_path = GORDON_THEME_DIR . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>