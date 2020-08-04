<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_blog_style = explode('_', gordon_get_theme_option('blog_style'));
$gordon_columns = empty($gordon_blog_style[1]) ? 2 : max(2, $gordon_blog_style[1]);
$gordon_post_format = get_post_format();
$gordon_post_format = empty($gordon_post_format) ? 'standard' : str_replace('post-format-', '', $gordon_post_format);
$gordon_animation = gordon_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($gordon_columns).' post_format_'.esc_attr($gordon_post_format) ); ?>
	<?php echo (!gordon_is_off($gordon_animation) ? ' data-animation="'.esc_attr(gordon_get_animation_classes($gordon_animation)).'"' : ''); ?>
	>

	<?php
	$gordon_image_hover = gordon_get_theme_option('image_hover');
	// Featured image
	gordon_show_post_featured(array(
		'thumb_size' => gordon_get_thumb_size(strpos(gordon_get_theme_option('body_style'), 'full')!==false || $gordon_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $gordon_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $gordon_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>