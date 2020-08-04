<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('gordon_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'gordon_customizer_theme_setup1', 1 );
	function gordon_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		gordon_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Source Sans Pro',
				'family' => 'sans-serif',
				'styles' => '400,600,700,900'		// Parameter 'style' used only for the Google fonts
				),

		));

		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		gordon_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		gordon_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'gordon'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.55em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '4.933rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '5.067rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-2px',
				'margin-top'		=> '1.368em',
				'margin-bottom'		=> '0.65em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '4.2rem',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '4.153rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-1.5px',
				'margin-top'		=> '1.62em',
				'margin-bottom'		=> '0.67em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '2.933rem',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '3.2rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-1.1px',
				'margin-top'		=> '2.34em',
				'margin-bottom'		=> '0.53em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '2.4em',
				'font-weight'		=> 'bold',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2043em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-0.85px',
				'margin-top'		=> '2.8565em',
				'margin-bottom'		=> '0.52em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '1.6em',
				'font-weight'		=> 'bold',
				'font-style'		=> 'normal',
				'line-height'		=> '1.21em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-0.65px',
				'margin-top'		=> '4.5em',
				'margin-bottom'		=> '0.84em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '1.067em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.24em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-0.55px',
				'margin-top'		=> '6.868em',
				'margin-bottom'		=> '0.7412em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'gordon'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.4px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'gordon'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'gordon'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'gordon'),
				'description'		=> esc_html__('Font settings of the main menu items', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'gordon'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'gordon'),
				'font-family'		=> 'Source Sans Pro, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		gordon_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'gordon'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff', // +
					'bd_color'				=> '#e5e5e5',
		
					// Text and links colors
					'text'					=> '#867f7f',
					'text_light'			=> '#9d9d9d',  //+
					'text_dark'				=> '#483939',  //+
					'text_link'				=> '#1ab7ea',  //blue +
					'text_hover'			=> '#e65740',  //red +
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#d9d9d9',  //table border +
					'alter_bg_hover'		=> '#e6e8eb',
					'alter_bd_color'		=> '#f7f7f7', //table bg +
					'alter_bd_hover'		=> '#dadada',
					'alter_text'			=> '#8a8a8a',  //+
					'alter_light'			=> '#b7b7b7',
					'alter_dark'			=> '#1d1d1d',
					'alter_link'			=> '#c8c6c4', //+
					'alter_hover'			=> '#72cfd5',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#edecec',	//+
					'input_bg_hover'		=> '#e7eaed',
					'input_bd_color'		=> '#f1eeec', //Sidebar +
					'input_bd_hover'		=> '#5f5252', //Search +
					'input_text'			=> '#848484',  //+
					'input_light'			=> '#8b8b8b', //Social +
					'input_dark'			=> '#1d1d1d',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',  //+
					'inverse_light'			=> '#333333',
					'inverse_dark'			=> '#000000',  //+
					'inverse_link'			=> '#ffffff',  //+
					'inverse_hover'			=> '#1d1d1d',
		
					// Additional accented colors (if used in the current theme)


                    'transparent'			=> 'transparent', //+
                    'text_blue'			=> '#1ab7ea', //+
                    'sub_menu'			=> '#f6f6f7', //+

				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'gordon'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#1ab7ea', //+
					'bd_color'				=> '#1c1b1f',
		
					// Text and links colors
					'text'					=> '#ffffff',  //+
					'text_light'			=> '#5f5f5f',
					'text_dark'				=> '#ffffff',
					'text_link'				=> '#1ab7ea',//+
					'text_hover'			=> '#e65740',//+
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#1e1d22',
					'alter_bg_hover'		=> '#28272e',
					'alter_bd_color'		=> '#313131',
					'alter_bd_hover'		=> '#3d3d3d',
					'alter_text'			=> '#a6a6a6',
					'alter_light'			=> '#5f5f5f',
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#ffaa5f',
					'alter_hover'			=> '#fe7259',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#2e2d32',	
					'input_bg_hover'		=> '#2e2d32',	
					'input_bd_color'		=> '#2e2d32',
					'input_bd_hover'		=> '#353535',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#5f5f5f',
					'input_dark'			=> '#ffffff',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#1d1d1d',
					'inverse_light'			=> '#5f5f5f',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',  //+
					'inverse_hover'			=> '#1d1d1d',
				
					// Additional accented colors (if used in the current theme)


                    'transparent'			=> 'transparent', //+
                    'text_blue'			=> '#ffffff', //+
                    'sub_menu'			=> '#f6f6f7', //+

		
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('gordon_customizer_add_theme_colors')) {
	function gordon_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = gordon_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = gordon_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = gordon_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = gordon_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = gordon_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = gordon_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = gordon_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = gordon_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = gordon_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['text_dark_07']  = gordon_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = gordon_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_08']  = gordon_hex2rgba( $colors['text_link'], 0.8 );  //+
			$colors['text_link_07']  = gordon_hex2rgba( $colors['text_link'], 0.7 );
			$colors['inverse_dark_02']  = gordon_hex2rgba( $colors['inverse_dark'], 0.2 ); //+
			$colors['input_bd_hover_02']  = gordon_hex2rgba( $colors['input_bd_hover'], 0.1 ); //+
			$colors['text_link_blend'] = gordon_hsb2hex(gordon_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = gordon_hsb2hex(gordon_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_08'] = '{{ data.text_link_08 }}'; //+
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['inverse_dark_02'] = '{{ data.inverse_dark_02 }}'; //+
			$colors['input_bd_hover_02'] = '{{ data.input_bd_hover_02 }}'; //+
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('gordon_customizer_add_theme_fonts')) {
	function gordon_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !gordon_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !gordon_is_inherit($font['font-size'])
														? 'font-size:' . gordon_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !gordon_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !gordon_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !gordon_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !gordon_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !gordon_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !gordon_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !gordon_is_inherit($font['margin-top'])
														? 'margin-top:' . gordon_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !gordon_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . gordon_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}
?>