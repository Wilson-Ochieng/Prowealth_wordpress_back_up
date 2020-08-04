<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.10
 */

// Footer menu
$gordon_menu_footer = gordon_get_nav_menu('menu_footer');
if (!empty($gordon_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php gordon_show_layout($gordon_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>