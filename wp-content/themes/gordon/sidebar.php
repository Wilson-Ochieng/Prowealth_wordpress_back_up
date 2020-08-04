<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_sidebar_position = gordon_get_theme_option('sidebar_position');
if (gordon_sidebar_present()) {
	ob_start();
	$gordon_sidebar_name = gordon_get_theme_option('sidebar_widgets');
	gordon_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($gordon_sidebar_name) ) {
		dynamic_sidebar($gordon_sidebar_name);
	}
	$gordon_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($gordon_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($gordon_sidebar_position); ?> widget_area<?php if (!gordon_is_inherit(gordon_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(gordon_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'gordon_action_before_sidebar' );
				gordon_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $gordon_out));
				do_action( 'gordon_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>