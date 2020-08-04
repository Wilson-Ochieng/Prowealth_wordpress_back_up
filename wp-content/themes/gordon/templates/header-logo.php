<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

$gordon_args = get_query_var('gordon_logo_args');

// Site logo
$gordon_logo_image  = gordon_get_logo_image(isset($gordon_args['type']) ? $gordon_args['type'] : '');
$gordon_logo_text   = gordon_is_on(gordon_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$gordon_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($gordon_logo_image) || !empty($gordon_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url(home_url('/')); ?>"><?php
		if (!empty($gordon_logo_image)) {
			$gordon_attr = gordon_getimagesize($gordon_logo_image);
			echo '<img src="'.esc_url($gordon_logo_image).'" alt="'.esc_attr__( 'Site icon', 'gordon' ).'" '.(!empty($gordon_attr[3]) ? sprintf(' %s', $gordon_attr[3]) : '').'>' ;
		} else {
			gordon_show_layout(gordon_prepare_macros($gordon_logo_text), '<span class="logo_text">', '</span>');
			gordon_show_layout(gordon_prepare_macros($gordon_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>