<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.10
 */

// Copyright area
$gordon_footer_scheme =  gordon_is_inherit(gordon_get_theme_option('footer_scheme')) ? gordon_get_theme_option('color_scheme') : gordon_get_theme_option('footer_scheme');
$gordon_copyright_scheme = gordon_is_inherit(gordon_get_theme_option('copyright_scheme')) ? $gordon_footer_scheme : gordon_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($gordon_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				$gordon_copyright = gordon_prepare_macros(gordon_get_theme_option('copyright'));
				if (!empty($gordon_copyright)) {
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $gordon_copyright, $gordon_matches)) {
						$gordon_copyright = str_replace($gordon_matches[1], date(str_replace(array('{', '}'), '', $gordon_matches[1])), $gordon_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($gordon_copyright));
				}
			?></div>
		</div>
	</div>
</div>
