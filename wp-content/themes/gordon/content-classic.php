<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_blog_style = explode('_', gordon_get_theme_option('blog_style'));
$gordon_columns = empty($gordon_blog_style[1]) ? 2 : max(2, $gordon_blog_style[1]);
$gordon_expanded = !gordon_sidebar_present() && gordon_is_on(gordon_get_theme_option('expand_content'));
$gordon_post_format = get_post_format();
$gordon_post_format = empty($gordon_post_format) ? 'standard' : str_replace('post-format-', '', $gordon_post_format);
$gordon_animation = gordon_get_theme_option('blog_animation');

?><div class="<?php echo 'classic' == $gordon_blog_style[0] ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($gordon_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($gordon_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($gordon_columns)
					. ' post_layout_'.esc_attr($gordon_blog_style[0]) 
					. ' post_layout_'.esc_attr($gordon_blog_style[0]).'_'.esc_attr($gordon_columns)
					); ?>
	<?php echo (!gordon_is_off($gordon_animation) ? ' data-animation="'.esc_attr(gordon_get_animation_classes($gordon_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	gordon_show_post_featured( array( 'thumb_size' => gordon_get_thumb_size($gordon_blog_style[0] == 'classic'
													? (strpos(gordon_get_theme_option('body_style'), 'full')!==false 
															? ( $gordon_columns > 2 ? 'big' : 'huge' )
															: (	$gordon_columns > 2
																? ($gordon_expanded ? 'med' : 'small')
																: ($gordon_expanded ? 'big' : 'med')
																)
														)
													: (strpos(gordon_get_theme_option('body_style'), 'full')!==false 
															? ( $gordon_columns > 2 ? 'masonry-big' : 'full' )
															: (	$gordon_columns <= 2 && $gordon_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($gordon_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('gordon_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('gordon_action_before_post_meta');

            // Post meta
            if (!gordon_sc_layouts_showed('postmeta')) {
                gordon_show_post_meta(array(
                        'categories' => false,
                        'date' => true,
                        'edit' => false,
                        'seo' => false,
                        'share' => false,
                        'author' => true,
                        'counters' => 'views,comments'	//comments,likes,views - comma separated in any combination
                    )
                );
            }
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$gordon_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($gordon_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($gordon_post_format, array('link', 'aside', 'status', 'quote'))) {
			gordon_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $gordon_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'gordon'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>