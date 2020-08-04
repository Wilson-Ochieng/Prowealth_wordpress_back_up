<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */

if (!function_exists('gordon_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'gordon_trx_addons_theme_specific_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'gordon_trx_addons_theme_specific_setup1', 8 );
	function gordon_trx_addons_theme_specific_setup1() {
		if (gordon_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',				'gordon_trx_addons_cv_enable');
			add_filter( 'trx_addons_cpt_list',				'gordon_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',				'gordon_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',			'gordon_trx_addons_widgets_list');
		}
	}
}

// CV
if ( !function_exists( 'gordon_trx_addons_cv_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_cv_enable', 'gordon_trx_addons_cv_enable');
	function gordon_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return false;
	}
}

// CPT
if ( !function_exists( 'gordon_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'gordon_trx_addons_cpt_list');
	function gordon_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list
        unset($list['portfolio']);
        unset($list['resume']);
        unset($list['courses']);
        unset($list['certificates']);
        unset($list['sport']);
        unset($list['dishes']);
        unset($list['agents']);
        unset($list['properties']);

		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'gordon_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'gordon_trx_addons_sc_list');
	function gordon_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php
		return $list;
	}
}

// Widgets
if ( !function_exists( 'gordon_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'gordon_trx_addons_widgets_list');
	function gordon_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php
        unset($list['twitter']);
        unset($list['banner']);
        unset($list['socials']);
        unset($list['aboutme']);
        unset($list['flickr']);
        unset($list['recent_news']);
        unset($list['popular_posts']);

		return $list;
	}
}

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'gordon_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'gordon_trx_addons_menu_cache');
	function gordon_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		$list[] = '.menu_mobile_inner > nav > ul';
		return $list;
	}
}

// Add theme-specific vars into localize array
if (!function_exists('gordon_trx_addons_localize_script')) {
	add_filter( 'gordon_filter_localize_script', 'gordon_trx_addons_localize_script' );
	function gordon_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = gordon_get_scheme_color('alter_link');
		return $arr;
	}
}


// Shortcodes support
//------------------------------------------------------------------------

// Add new output types (layouts) in the shortcodes
if ( !function_exists( 'gordon_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'gordon_trx_addons_sc_type', 10, 2);
	function gordon_trx_addons_sc_type($list, $sc) {
		// To do: check shortcode slug and if correct - add new 'key' => 'title' to the list
        if($sc == 'trx_sc_button') {
            $list[esc_html__('Red', 'gordon')] = 'red';
            $list[esc_html__('Dark', 'gordon')] = 'dark';
        }
		return $list;
	}
}

// Add params to the default shortcode's atts
if ( !function_exists( 'gordon_trx_addons_sc_atts' ) ) {
	add_filter( 'trx_addons_sc_atts', 'gordon_trx_addons_sc_atts', 10, 2);
	function gordon_trx_addons_sc_atts($atts, $sc) {
		
		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_events', 'trx_sc_form',
								'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo', 'trx_sc_services', 'trx_sc_team',
								'trx_sc_testimonials', 'trx_sc_title', 'trx_widget_audio', 'trx_widget_twitter')))
			$atts['scheme'] = 'inherit';
		return $atts;
	}
}

// Add params into shortcodes VC map
if ( !function_exists( 'gordon_trx_addons_sc_map' ) ) {
	add_filter( 'trx_addons_sc_map', 'gordon_trx_addons_sc_map', 10, 2);
	function gordon_trx_addons_sc_map($params, $sc) {

		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action', 'trx_sc_blogger', 'trx_sc_courses', 'trx_sc_content', 'trx_sc_events', 'trx_sc_form',
								'trx_sc_googlemap', 'trx_sc_portfolio', 'trx_sc_price', 'trx_sc_promo', 'trx_sc_services', 'trx_sc_team',
								'trx_sc_testimonials', 'trx_sc_title', 'trx_widget_audio', 'trx_widget_twitter'))) {
			$params['params'][] = array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'gordon'),
					"description" => wp_kses_data( __("Select color scheme to decorate this block", 'gordon') ),
					"group" => esc_html__('Colors', 'gordon'),
					"admin_label" => true,
					"value" => array_flip(gordon_get_list_schemes(true)),
					"type" => "dropdown"
				);
		}
		return $params;
	}
}

// Add params into shortcode's output
if ( !function_exists( 'gordon_trx_addons_sc_output' ) ) {
	add_filter( 'trx_addons_sc_output', 'gordon_trx_addons_sc_output', 10, 4);
	function gordon_trx_addons_sc_output($output, $sc, $atts, $content) {
		
		// Param 'scheme'
		if (in_array($sc, array('trx_sc_action'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_action ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_action ', $output);
		} else if (in_array($sc, array('trx_sc_blogger'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_blogger ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_blogger ', $output);
		} else if (in_array($sc, array('trx_sc_courses'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_courses ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_courses ', $output);
		} else if (in_array($sc, array('trx_sc_content'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_content ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_content ', $output);
		} else if (in_array($sc, array('trx_sc_form'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_form ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_form ', $output);
		} else if (in_array($sc, array('trx_sc_googlemap'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_googlemap_content', 'class="scheme_'.esc_attr($atts['scheme']).' sc_googlemap_content', $output);
		} else if (in_array($sc, array('trx_sc_portfolio'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_portfolio ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_portfolio ', $output);
		} else if (in_array($sc, array('trx_sc_price'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_price ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_price ', $output);
		} else if (in_array($sc, array('trx_sc_promo'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_promo ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_promo ', $output);
		} else if (in_array($sc, array('trx_sc_services'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_services ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_services ', $output);
		} else if (in_array($sc, array('trx_sc_team'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_team ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_team ', $output);
		} else if (in_array($sc, array('trx_sc_testimonials'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_testimonials ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_testimonials ', $output);
		} else if (in_array($sc, array('trx_sc_title'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_title ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_title ', $output);
		} else if (in_array($sc, array('trx_sc_events'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('class="sc_events ', 'class="scheme_'.esc_attr($atts['scheme']).' sc_events ', $output);
		} else if (in_array($sc, array('trx_widget_audio'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_audio', 'scheme_'.esc_attr($atts['scheme']).' sc_widget_audio', $output);
		} else if (in_array($sc, array('trx_widget_twitter'))) {
			if (!empty($atts['scheme']) && !gordon_is_inherit($atts['scheme']))
				$output = str_replace('sc_widget_twitter', 'scheme_'.esc_attr($atts['scheme']).' sc_widget_twitter', $output);
		}
		
		return $output;
	}
}

// Return tag for the item's title
if ( !function_exists( 'gordon_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'gordon_trx_addons_sc_item_title_tag');
	function gordon_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'gordon_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'gordon_trx_addons_sc_item_button_args');
	function gordon_trx_addons_sc_item_button_args($args, $sc='') {
		if (false && $sc != 'sc_button') {
			$args['type'] = 'simple';
			$args['icon_type'] = 'fontawesome';
			$args['icon_fontawesome'] = 'icon-down-big';
			$args['icon_position'] = 'top';
		}
		return $args;
	}
}

// Return theme specific title layout for the slider
if ( !function_exists( 'gordon_trx_addons_slider_title' ) ) {
	add_filter( 'trx_addons_filter_slider_title',	'gordon_trx_addons_slider_title', 10, 2 );
	function gordon_trx_addons_slider_title($title, $data) {
		$title = '';
		if (!empty($data['title'])) 
			$title .= '<h3 class="slide_title">'
						. (!empty($data['link']) ? '<a href="'.esc_url($data['link']).'">' : '')
						. esc_html($data['title'])
						. (!empty($data['link']) ? '</a>' : '')
						. '</h3>';
		if (!empty($data['cats']))
			$title .= sprintf('<div class="slide_cats">%s</div>', $data['cats']);
		return $title;
	}
}

// Add new styles to the Google map
if ( !function_exists( 'gordon_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'gordon_trx_addons_sc_googlemap_styles');
	function gordon_trx_addons_sc_googlemap_styles($list) {
		$list[esc_html__('Dark', 'gordon')] = 'dark';
		return $list;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'gordon_trx_addons_editor_init' ) ) {
	if (is_admin()) add_filter( 'tiny_mce_before_init', 'gordon_trx_addons_editor_init', 11);
	function gordon_trx_addons_editor_init($opt) {
		if (gordon_exists_trx_addons()) {
			// Add style 'Arrow' to the 'List styles'
			// Remove 'false &&' from condition below to add new style to the list
			if (false && !empty($opt['style_formats'])) {
				$style_formats = json_decode($opt['style_formats'], true);
				if (is_array($style_formats) && count($style_formats)>0 ) {
					foreach ($style_formats as $k=>$v) {
						if ( $v['title'] == esc_html__('List styles', 'gordon') ) {
							$style_formats[$k]['items'][] = array(
										'title' => esc_html__('Arrow', 'gordon'),
										'selector' => 'ul',
										'classes' => 'trx_addons_list trx_addons_list_arrow'
									);
						}
					}
					$opt['style_formats'] = json_encode( $style_formats );		
				}
			}
		}
		return $opt;
	}
}


// Setup team and portflio pages
//------------------------------------------------------------------------

// Disable override header image on team and portfolio pages
if ( !function_exists( 'gordon_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'gordon_filter_allow_override_header_image', 'gordon_trx_addons_allow_override_header_image' );
	function gordon_trx_addons_allow_override_header_image($allow) {
		return gordon_is_team_page() || gordon_is_portfolio_page() ? false : $allow;
	}
}

// Hide sidebar on the team and portfolio pages
if ( !function_exists( 'gordon_trx_addons_sidebar_present' ) ) {
	add_filter( 'gordon_filter_sidebar_present', 'gordon_trx_addons_sidebar_present' );
	function gordon_trx_addons_sidebar_present($present) {
		return !is_single() && (gordon_is_team_page() || gordon_is_portfolio_page()) ? false : $present;
	}
}

// Get thumb size for the team items
if ( !function_exists( 'gordon_trx_addons_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_thumb_size',	'gordon_trx_addons_thumb_size', 10, 2);
	function gordon_trx_addons_thumb_size($thumb_size='', $type='') {
		if ($type == 'team-default')
			$thumb_size = gordon_get_thumb_size('med');
		return $thumb_size;
	}
}

// Add fields to the override options for the team members
// All other CPT override optionses may be modified in the same method
if (!function_exists('gordon_trx_addons_override_options_fields')) {
	add_filter( 'trx_addons_filter_override_options_fields', 'gordon_trx_addons_override_options_fields', 10, 2);
	function gordon_trx_addons_override_options_fields($mb, $post_type) {
		if (defined('TRX_ADDONS_CPT_TEAM_PT') && $post_type==TRX_ADDONS_CPT_TEAM_PT) {
			$mb['email'] = array(
				"title" => esc_html__("E-mail",  'gordon'),
				"desc" => wp_kses_data( __("Team member's email", 'gordon') ),
				"std" => "",
				"details" => true,
				"type" => "text"
			);

		}
		return $mb;
	}
}
?>