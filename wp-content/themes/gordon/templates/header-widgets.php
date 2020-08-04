<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

// Header sidebar
$gordon_header_name = gordon_get_theme_option('header_widgets');
$gordon_header_present = !gordon_is_off($gordon_header_name) && is_active_sidebar($gordon_header_name);
if ($gordon_header_present) { 
	gordon_storage_set('current_sidebar', 'header');
	$gordon_header_wide = gordon_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($gordon_header_name) ) {
		dynamic_sidebar($gordon_header_name);
	}
	$gordon_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($gordon_widgets_output)) {
		$gordon_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $gordon_widgets_output);
		$gordon_need_columns = strpos($gordon_widgets_output, 'columns_wrap')===false;
		if ($gordon_need_columns) {
			$gordon_columns = max(0, (int) gordon_get_theme_option('header_columns'));
			if ($gordon_columns == 0) $gordon_columns = min(6, max(1, substr_count($gordon_widgets_output, '<aside ')));
			if ($gordon_columns > 1)
				$gordon_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($gordon_columns).' widget ', $gordon_widgets_output);
			else
				$gordon_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($gordon_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$gordon_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($gordon_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'gordon_action_before_sidebar' );
				gordon_show_layout($gordon_widgets_output);
				do_action( 'gordon_action_after_sidebar' );
				if ($gordon_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$gordon_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>