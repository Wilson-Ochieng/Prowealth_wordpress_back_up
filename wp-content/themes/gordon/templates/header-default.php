<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_header_css = $gordon_header_image = '';
$gordon_header_video = gordon_get_header_video();
if (true || empty($gordon_header_video)) {
	$gordon_header_image = get_header_image();
	if (gordon_is_on(gordon_get_theme_option('header_image_override')) && apply_filters('gordon_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($gordon_cat_img = gordon_get_category_image()) != '')
				$gordon_header_image = $gordon_cat_img;
		} else if (is_singular() || gordon_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$gordon_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($gordon_header_image)) $gordon_header_image = $gordon_header_image[0];
			} else
				$gordon_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($gordon_header_image) || !empty($gordon_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($gordon_header_video!='') echo ' with_bg_video';
					if ($gordon_header_image!='') echo ' '.esc_attr(gordon_add_inline_css_class('background-image: url('.esc_url($gordon_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (gordon_is_on(gordon_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(gordon_is_inherit(gordon_get_theme_option('header_scheme')) 
													? gordon_get_theme_option('color_scheme') 
													: gordon_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($gordon_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (gordon_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>