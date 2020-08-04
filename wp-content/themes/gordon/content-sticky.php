<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$gordon_post_format = get_post_format();
$gordon_post_format = empty($gordon_post_format) ? 'standard' : str_replace('post-format-', '', $gordon_post_format);
$gordon_full_content = gordon_get_theme_option('blog_content') != 'excerpt' || in_array($gordon_post_format, array('link', 'aside', 'status', 'quote'));
$gordon_animation = gordon_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($gordon_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($gordon_post_format) ); ?>
	<?php echo (!gordon_is_off($gordon_animation) ? ' data-animation="'.esc_attr(gordon_get_animation_classes($gordon_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	gordon_show_post_featured(array(
		'thumb_size' => gordon_get_thumb_size($gordon_columns==1 ? 'big' : ($gordon_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($gordon_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			// Post meta
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
			?>
		</div><!-- .entry-header -->
		<?php
	}
	// Post content
	?><div class="post_content entry-content"><?php
			if ($gordon_full_content) {
				// Post content area
				?><div class="post_content_inner"><?php
				the_content( '' );
				?></div><?php
				// Inner pages
				wp_link_pages( array(
					'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'gordon' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'gordon' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

			} else {

				$gordon_show_learn_more = !in_array($gordon_post_format, array('link', 'aside', 'status', 'quote'));

				// Post content area
				?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($gordon_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
				?></div><?php
				// More button
				if ( $gordon_show_learn_more ) {
					?><p><a class="sc_item_button sc_button_simple" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'gordon'); ?></a></p><?php
				}

			}
			?></div><!-- .entry-content -->
</article></div>