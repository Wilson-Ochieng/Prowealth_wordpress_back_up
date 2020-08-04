<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.10
 */

// Footer sidebar
$gordon_footer_name = gordon_get_theme_option('footer_widgets');
$gordon_footer_present = !gordon_is_off($gordon_footer_name) && is_active_sidebar($gordon_footer_name);
if ($gordon_footer_present) { 
	gordon_storage_set('current_sidebar', 'footer');
	$gordon_footer_wide = gordon_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($gordon_footer_name) ) {
		dynamic_sidebar($gordon_footer_name);
	}
	$gordon_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($gordon_out)) {
		$gordon_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $gordon_out);
		$gordon_need_columns = true;
		if ($gordon_need_columns) {
			$gordon_columns = max(0, (int) gordon_get_theme_option('footer_columns'));
			if ($gordon_columns == 0) $gordon_columns = min(6, max(1, substr_count($gordon_out, '<aside ')));
			if ($gordon_columns > 1)
				$gordon_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($gordon_columns).' widget ', $gordon_out);
			else
				$gordon_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($gordon_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$gordon_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($gordon_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'gordon_action_before_sidebar' );
				gordon_show_layout($gordon_out);
				do_action( 'gordon_action_after_sidebar' );
				if ($gordon_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$gordon_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>