<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

gordon_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$gordon_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$gordon_sticky_out = is_array($gordon_stickies) && count($gordon_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($gordon_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($gordon_sticky_out && !is_sticky()) {
			$gordon_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $gordon_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($gordon_sticky_out) {
		$gordon_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	gordon_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>