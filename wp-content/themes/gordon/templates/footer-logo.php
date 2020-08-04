<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.10
 */

// Logo
if (gordon_is_on(gordon_get_theme_option('logo_in_footer'))) {
	$gordon_logo_image = '';
	if (gordon_get_retina_multiplier(2) > 1)
		$gordon_logo_image = gordon_get_theme_option( 'logo_footer_retina' );
	if (empty($gordon_logo_image)) 
		$gordon_logo_image = gordon_get_theme_option( 'logo_footer' );
	$gordon_logo_text   = get_bloginfo( 'name' );
	if (!empty($gordon_logo_image) || !empty($gordon_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($gordon_logo_image)) {
					$gordon_attr = gordon_getimagesize($gordon_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($gordon_logo_image).'" class="logo_footer_image" alt=" '.esc_attr__( 'Site icon', 'gordon' ).' " '.(!empty($gordon_attr[3]) ? sprintf(' %s', $gordon_attr[3]) : '').'></a>' ;
				} else if (!empty($gordon_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($gordon_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>