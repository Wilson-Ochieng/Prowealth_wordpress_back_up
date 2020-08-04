<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_link = get_permalink();
$gordon_post_format = get_post_format();
$gordon_post_format = empty($gordon_post_format) ? 'standard' : str_replace('post-format-', '', $gordon_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($gordon_post_format) ); ?>><?php
	gordon_show_post_featured(array(
		'thumb_size' => gordon_get_thumb_size( 'related' ),
		'show_no_image' => true,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . gordon_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($gordon_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($gordon_link) . '">' . gordon_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>