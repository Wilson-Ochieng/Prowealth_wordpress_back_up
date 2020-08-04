<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('gordon_mailchimp_get_css')) {
	add_filter('gordon_filter_get_css', 'gordon_mailchimp_get_css', 10, 4);
	function gordon_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = gordon_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: {$colors['input_bd_hover_02']};
	border-color: {$colors['input_bd_hover_02']};
	color: {$colors['text']};
}
.mc4wp-form input[type="submit"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.mc4wp-form input[type="submit"]:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_link_blend']};
}

CSS;
		}

		return $css;
	}
}
?>