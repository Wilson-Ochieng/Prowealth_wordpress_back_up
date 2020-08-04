<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_post_id    = get_the_ID();
$gordon_post_date  = gordon_get_date();
$gordon_post_title = get_the_title();
$gordon_post_link  = get_permalink();
$gordon_post_author_id   = get_the_author_meta('ID');
$gordon_post_author_name = get_the_author_meta('display_name');
$gordon_post_author_url  = get_author_posts_url($gordon_post_author_id, '');

$gordon_args = get_query_var('gordon_args_widgets_posts');
$gordon_show_date = isset($gordon_args['show_date']) ? (int) $gordon_args['show_date'] : 1;
$gordon_show_image = isset($gordon_args['show_image']) ? (int) $gordon_args['show_image'] : 1;
$gordon_show_author = isset($gordon_args['show_author']) ? (int) $gordon_args['show_author'] : 1;
$gordon_show_counters = isset($gordon_args['show_counters']) ? (int) $gordon_args['show_counters'] : 1;
$gordon_show_categories = isset($gordon_args['show_categories']) ? (int) $gordon_args['show_categories'] : 1;

$gordon_output = gordon_storage_get('gordon_output_widgets_posts');

$gordon_post_counters_output = '';
if ( $gordon_show_counters ) {
	$gordon_post_counters_output = '<span class="post_info_item post_info_counters">'
								. gordon_get_post_counters('comments')
							. '</span>';
}


$gordon_output .= '<article class="post_item with_thumb">';

if ($gordon_show_image) {
	$gordon_post_thumb = get_the_post_thumbnail($gordon_post_id, gordon_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($gordon_post_thumb) $gordon_output .= '<div class="post_thumb">' . ($gordon_post_link ? '<a href="' . esc_url($gordon_post_link) . '">' : '') . ($gordon_post_thumb) . ($gordon_post_link ? '</a>' : '') . '</div>';
}

$gordon_output .= '<div class="post_content">'
			. ($gordon_show_categories 
					? '<div class="post_categories">'
						. gordon_get_post_categories()
						. $gordon_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($gordon_post_link ? '<a href="' . esc_url($gordon_post_link) . '">' : '') . ($gordon_post_title) . ($gordon_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('gordon_filter_get_post_info', 
								'<div class="post_info">'
									. ($gordon_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($gordon_post_link ? '<a href="' . esc_url($gordon_post_link) . '" class="post_info_date">' : '') 
											. esc_html($gordon_post_date) 
											. ($gordon_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($gordon_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'gordon') . ' ' 
											. ($gordon_post_link ? '<a href="' . esc_url($gordon_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($gordon_post_author_name) 
											. ($gordon_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$gordon_show_categories && $gordon_post_counters_output
										? $gordon_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
gordon_storage_set('gordon_output_widgets_posts', $gordon_output);
?>