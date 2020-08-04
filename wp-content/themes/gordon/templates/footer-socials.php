<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.10
 */


// Socials
if ( gordon_is_on(gordon_get_theme_option('socials_in_footer')) && ($gordon_output = gordon_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php gordon_show_layout($gordon_output); ?>
		</div>
	</div>
	<?php
}
?>