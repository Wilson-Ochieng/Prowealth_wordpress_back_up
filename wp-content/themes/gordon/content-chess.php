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
$gordon_columns = empty($gordon_blog_style[1]) ? 1 : max(1, $gordon_blog_style[1]);
$gordon_expanded = !gordon_sidebar_present() && gordon_is_on(gordon_get_theme_option('expand_content'));
$gordon_post_format = get_post_format();
$gordon_post_format = empty($gordon_post_format) ? 'standard' : str_replace('post-format-', '', $gordon_post_format);
$gordon_animation = gordon_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($gordon_columns).' post_format_'.esc_attr($gordon_post_format) ); ?>
	<?php echo (!gordon_is_off($gordon_animation) ? ' data-animation="'.esc_attr(gordon_get_animation_classes($gordon_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($gordon_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	gordon_show_post_featured( array(
											'class' => $gordon_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => gordon_get_thumb_size(
																	strpos(gordon_get_theme_option('body_style'), 'full')!==false
																		? ( $gordon_columns > 1 ? 'huge' : 'original' )
																		: (	$gordon_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('gordon_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			
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

		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$gordon_show_learn_more = !in_array($gordon_post_format, array('link', 'aside', 'status', 'quote'));
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
				gordon_show_layout($gordon_post_meta);
			}
			// More button
			if ( $gordon_show_learn_more ) {
				?><p><a class="sc_item_button sc_button_simple" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'gordon'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>