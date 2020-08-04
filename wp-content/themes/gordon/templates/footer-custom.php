<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.10
 */

$gordon_footer_scheme =  gordon_is_inherit(gordon_get_theme_option('footer_scheme')) ? gordon_get_theme_option('color_scheme') : gordon_get_theme_option('footer_scheme');
$gordon_footer_id = str_replace('footer-custom-', '', gordon_get_theme_option("footer_style"));
if ((int) $gordon_footer_id == 0) {
    $gordon_footer_id = gordon_get_post_id(array(
        'name' => $gordon_footer_id,
        'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
        )
    );
} else {
    $gordon_footer_id = apply_filters('trx_addons_filter_get_translated_layout', $gordon_footer_id);
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($gordon_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($gordon_footer_id))); 
						?> scheme_<?php echo esc_attr($gordon_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('gordon_action_show_layout', $gordon_footer_id);
	?>
</footer><!-- /.footer_wrap -->
