<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

gordon_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', gordon_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', gordon_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', gordon_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'gordon-gallery-script', gordon_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$gordon_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$gordon_sticky_out = is_array($gordon_stickies) && count($gordon_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$gordon_cat = gordon_get_theme_option('parent_cat');
	$gordon_post_type = gordon_get_theme_option('post_type');
	$gordon_taxonomy = gordon_get_post_type_taxonomy($gordon_post_type);
	$gordon_show_filters = gordon_get_theme_option('show_filters');
	$gordon_tabs = array();
	if (!gordon_is_off($gordon_show_filters)) {
		$gordon_args = array(
			'type'			=> $gordon_post_type,
			'child_of'		=> $gordon_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $gordon_taxonomy,
			'pad_counts'	=> false
		);
		$gordon_portfolio_list = get_terms($gordon_args);
		if (is_array($gordon_portfolio_list) && count($gordon_portfolio_list) > 0) {
			$gordon_tabs[$gordon_cat] = esc_html__('All', 'gordon');
			foreach ($gordon_portfolio_list as $gordon_term) {
				if (isset($gordon_term->term_id)) $gordon_tabs[$gordon_term->term_id] = $gordon_term->name;
			}
		}
	}
	if (count($gordon_tabs) > 0) {
		$gordon_portfolio_filters_ajax = true;
		$gordon_portfolio_filters_active = $gordon_cat;
		$gordon_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters gordon_tabs gordon_tabs_ajax">
			<ul class="portfolio_titles gordon_tabs_titles">
				<?php
				foreach ($gordon_tabs as $gordon_id=>$gordon_title) {
					?><li><a href="<?php echo esc_url(gordon_get_hash_link(sprintf('#%s_%s_content', $gordon_portfolio_filters_id, $gordon_id))); ?>" data-tab="<?php echo esc_attr($gordon_id); ?>"><?php echo esc_html($gordon_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$gordon_ppp = gordon_get_theme_option('posts_per_page');
			if (gordon_is_inherit($gordon_ppp)) $gordon_ppp = '';
			foreach ($gordon_tabs as $gordon_id=>$gordon_title) {
				$gordon_portfolio_need_content = $gordon_id==$gordon_portfolio_filters_active || !$gordon_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $gordon_portfolio_filters_id, $gordon_id)); ?>"
					class="portfolio_content gordon_tabs_content"
					data-blog-template="<?php echo esc_attr(gordon_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(gordon_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($gordon_ppp); ?>"
					data-post-type="<?php echo esc_attr($gordon_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($gordon_taxonomy); ?>"
					data-cat="<?php echo esc_attr($gordon_id); ?>"
					data-parent-cat="<?php echo esc_attr($gordon_cat); ?>"
					data-need-content="<?php echo (false===$gordon_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($gordon_portfolio_need_content) 
						gordon_show_portfolio_posts(array(
							'cat' => $gordon_id,
							'parent_cat' => $gordon_cat,
							'taxonomy' => $gordon_taxonomy,
							'post_type' => $gordon_post_type,
							'page' => 1,
							'sticky' => $gordon_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		gordon_show_portfolio_posts(array(
			'cat' => $gordon_cat,
			'parent_cat' => $gordon_cat,
			'taxonomy' => $gordon_taxonomy,
			'post_type' => $gordon_post_type,
			'page' => 1,
			'sticky' => $gordon_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>