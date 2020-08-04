<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

// Page (category, tag, archive, author) title

if ( gordon_need_page_title() ) {
	gordon_sc_layouts_showed('title', true);
	gordon_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_left">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								gordon_show_post_meta(array(
									'date' => true,
									'categories' => true,
									'seo' => true,
									'share' => false,
									'counters' => 'views,comments,likes'
									)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$gordon_blog_title = gordon_get_blog_title();
							$gordon_blog_title_text = $gordon_blog_title_class = $gordon_blog_title_link = $gordon_blog_title_link_text = '';
							if (is_array($gordon_blog_title)) {
								$gordon_blog_title_text = $gordon_blog_title['text'];
								$gordon_blog_title_class = !empty($gordon_blog_title['class']) ? ' '.$gordon_blog_title['class'] : '';
								$gordon_blog_title_link = !empty($gordon_blog_title['link']) ? $gordon_blog_title['link'] : '';
								$gordon_blog_title_link_text = !empty($gordon_blog_title['link_text']) ? $gordon_blog_title['link_text'] : '';
							} else
								$gordon_blog_title_text = $gordon_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($gordon_blog_title_class); ?>"><?php
								$gordon_top_icon = gordon_get_category_icon();
								if (!empty($gordon_top_icon)) {
									$gordon_attr = gordon_getimagesize($gordon_top_icon);
									?><img src="<?php echo esc_url($gordon_top_icon); ?>" alt="<?php esc_attr__( 'Site icon', 'gordon' ); ?>" <?php if (!empty($gordon_attr[3])) gordon_show_layout($gordon_attr[3]);?>><?php
								}
								echo wp_kses_post($gordon_blog_title_text);
							?></h1>
							<?php
							if (!empty($gordon_blog_title_link) && !empty($gordon_blog_title_link_text)) {
								?><a href="<?php echo esc_url($gordon_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($gordon_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'gordon_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>