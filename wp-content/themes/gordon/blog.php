<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$gordon_content = '';
$gordon_blog_archive_mask = '%%CONTENT%%';
$gordon_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $gordon_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($gordon_content = apply_filters('the_content', get_the_content())) != '') {
		if (($gordon_pos = strpos($gordon_content, $gordon_blog_archive_mask)) !== false) {
			$gordon_content = preg_replace('/(\<p\>\s*)?'.$gordon_blog_archive_mask.'(\s*\<\/p\>)/i', $gordon_blog_archive_subst, $gordon_content);
		} else
			$gordon_content .= $gordon_blog_archive_subst;
		$gordon_content = explode($gordon_blog_archive_mask, $gordon_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) gordon_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$gordon_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$gordon_args = gordon_query_add_posts_and_cats($gordon_args, '', gordon_get_theme_option('post_type'), gordon_get_theme_option('parent_cat'));
$gordon_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($gordon_page_number > 1) {
	$gordon_args['paged'] = $gordon_page_number;
	$gordon_args['ignore_sticky_posts'] = true;
}
$gordon_ppp = gordon_get_theme_option('posts_per_page');
if ((int) $gordon_ppp != 0)
	$gordon_args['posts_per_page'] = (int) $gordon_ppp;
// Make a new query
query_posts( $gordon_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($gordon_content) && count($gordon_content) == 2) {
	set_query_var('blog_archive_start', $gordon_content[0]);
	set_query_var('blog_archive_end', $gordon_content[1]);
}

get_template_part('index');
?>