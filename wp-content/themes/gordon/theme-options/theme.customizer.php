<?php
/**
 * Theme customizer
 *
 * @package WordPress
 * @subpackage GORDON
 * @since GORDON 1.0
 */

//--------------------------------------------------------------
//-- Register Customizer Controls
//--------------------------------------------------------------

define('CUSTOMIZE_PRIORITY', 200);		// Start priority for the new controls

if (!function_exists('gordon_customizer_register_controls')) {
	add_action( 'customize_register', 'gordon_customizer_register_controls', 11 );
	function gordon_customizer_register_controls( $wp_customize ) {

		// Setup standard WP Controls
		// ---------------------------------
		
		// Remove unused sections
		$wp_customize->remove_section( 'colors');
		$wp_customize->remove_section( 'static_front_page');

		// Reorder standard WP sections
		$sec = $wp_customize->get_panel( 'nav_menus' );
		if (is_object($sec)) $sec->priority = 30;
		$sec = $wp_customize->get_panel( 'widgets' );
		if (is_object($sec)) $sec->priority = 40;
		$sec = $wp_customize->get_section( 'title_tagline' );
		if (is_object($sec)) $sec->priority = 50;
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) $sec->priority = 60;
		$sec = $wp_customize->get_section( 'header_image' );
		if (is_object($sec)) $sec->priority = 80;
		$sec = $wp_customize->get_section( 'custom_css' );
		if (is_object($sec)) {
			$sec->title = '* ' . $sec->title;
			$sec->priority = 2000;
		}
		
		// Modify standard WP controls
		$sec = $wp_customize->get_control( 'blogname' );
		if (is_object($sec))
			$sec->description = esc_html__('Use "[[" and "]]" to modify style and color of parts of the text, "||" to break current line',
											'gordon');
		$sec = $wp_customize->get_setting( 'blogname' );
		if (is_object($sec)) $sec->transport = 'postMessage';

		$sec = $wp_customize->get_setting( 'blogdescription' );
		if (is_object($sec)) $sec->transport = 'postMessage';
		
		$sec = $wp_customize->get_section( 'background_image' );
		if (is_object($sec)) {
			$sec->title = esc_html__('Background', 'gordon');
			$sec->description = esc_html__('Used only if "Content - Body style" equal to "boxed"', 'gordon');
		}
		
		// Move standard option 'Background Color' to the section 'Background Image'
		$wp_customize->add_setting( 'background_color', array(
			'default'        => get_theme_support( 'custom-background', 'default-color' ),
			'theme_supports' => 'custom-background',
			'transport'		 => 'postMessage',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
			'label'   => esc_html__( 'Background color', 'gordon' ),
			'section' => 'background_image',
		) ) );
		

		// Add Theme specific controls
		// ---------------------------------
		
		$panels = array('');
		$p = 0;
		$sections = array('');
		$s = 0;
		$i = 0;

		// Reload Theme Options before create controls
		if (is_admin()) {
			gordon_storage_set('options_reloaded', true);
			gordon_load_theme_options();
		}
		$options = gordon_storage_get('options');
		
		foreach ($options as $id=>$opt) {
			
			$i++;
			
			if (!empty($opt['hidden'])) continue;
			
			if ($opt['type'] == 'panel') {

				$sec = $wp_customize->get_panel( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_panel( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($panels, $id);
				$p++;

			} else if ($opt['type'] == 'panel_end') {

				array_pop($panels);
				$p--;

			} else if ($opt['type'] == 'section') {

				$sec = $wp_customize->get_section( $id );
				if ( is_object($sec) && !empty($sec->title) ) {
					$sec->title      = $opt['title'];
					$sec->description= $opt['desc'];
					if ( !empty($opt['priority']) )	$sec->priority = $opt['priority'];
				} else {
					$wp_customize->add_section( esc_attr($id) , array(
						'title'      => $opt['title'],
						'description'=> $opt['desc'],
						'panel'  => esc_attr($panels[$p]),
						'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i
					) );
				}
				array_push($sections, $id);
				$s++;

			} else if ($opt['type'] == 'section_end') {

				array_pop($sections);
				$s--;

			} else if ($opt['type'] == 'select') {

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'select',
					'choices'  => apply_filters('gordon_filter_options_get_list_choises', $opt['options'], $id)
				) );

			} else if ($opt['type'] == 'radio') {

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'radio',
					'choices'  => apply_filters('gordon_filter_options_get_list_choises', $opt['options'], $id)
				) );

			} else if ($opt['type'] == 'switch') {

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Gordon_Customize_Switch_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'choices'  => apply_filters('gordon_filter_options_get_list_choises', $opt['options'], $id)
				) ) );

			} else if ($opt['type'] == 'checkbox') {

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => 'checkbox'
				) );

			} else if ($opt['type'] == 'color') {

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'image') {

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if (in_array($opt['type'], array('media', 'audio', 'video'))) {
				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'icon') {

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( new Gordon_Customize_Icon_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'input_attrs' => array(
						'value' => gordon_get_theme_option($id),
					)
				) ) );

			} else if ($opt['type'] == 'button') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );

				$wp_customize->add_control( new Gordon_Customize_Button_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'input_attrs' => array(
						'caption' => $opt['caption'],
						'action' => $opt['action']
					),
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'info') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => '',
					'sanitize_callback' => 'gordon_sanitize_value',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Gordon_Customize_Info_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else if ($opt['type'] == 'hidden') {
			
				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_html',
					'transport'         => 'postMessage'
				) );

				$wp_customize->add_control( new Gordon_Customize_Hidden_Control( $wp_customize, $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority' => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
				) ) );

			} else {	

				$wp_customize->add_setting( $id, array(
					'default'           => gordon_get_theme_option($id),
					'sanitize_callback' => 'gordon_sanitize_html',
					'transport'         => !isset($opt['refresh']) || $opt['refresh'] ? 'refresh' : 'postMessage'
				) );
			
				$wp_customize->add_control( $id, array(
					'label'    => $opt['title'],
					'description' => $opt['desc'],
					'section'  => esc_attr($sections[$s]),
					'priority'	 => !empty($opt['priority']) ? $opt['priority'] : CUSTOMIZE_PRIORITY+$i,
					'type'     => $opt['type']
				) );
			}

		}
	}
}


// Create custom controls for customizer
if (!function_exists('gordon_customizer_custom_controls')) {
	add_action( 'customize_register', 'gordon_customizer_custom_controls' );
	function gordon_customizer_custom_controls( $wp_customize ) {
	
		class Gordon_Customize_Info_Control extends WP_Customize_Control {
			public $type = 'info';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span><?php
				}
				?></label><?php
			}
		}
	
		class Gordon_Customize_Switch_Control extends WP_Customize_Control {
			public $type = 'switch';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span><?php
				}
				if (is_array($this->choices) && count($this->choices)>0) {
					foreach ($this->choices as $k=>$v) {
						?><label><input type="radio" name="_customize-radio-<?php echo esc_attr($this->id); ?>" <?php
										$this->link();
										?> value="<?php echo esc_attr($k); ?>">
						<?php echo esc_html($v); ?></label><?php
					}
				}
				?></label><?php
			}
		}
	
		class Gordon_Customize_Icon_Control extends WP_Customize_Control {
			public $type = 'icon';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span><?php
				}
				?><span class="customize-control-field-wrap"><input type="text" <?php $this->link(); ?> /><?php
				gordon_show_layout(gordon_show_custom_field('_customize-icon-selector-'.esc_attr($this->id),
															array(
																'type'	 => 'icons',
																'button' => true,
																'icons'	 => true
															),
															$this->input_attrs['value']
															)
									);
				?></span></label><?php
			}
		}
	
		class Gordon_Customize_Button_Control extends WP_Customize_Control {
			public $type = 'button';

			public function render_content() {
				?><label><?php
				if (!empty($this->label)) {
					?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
				}
				if (!empty($this->description)) {
					?><span class="customize-control-description desctiption"><?php echo esc_html( $this->description ); ?></span><?php
				}
				?>
				<input type="button" 
						name="_customize-button-<?php echo esc_attr($this->id); ?>" 
						value="<?php echo esc_attr($this->input_attrs['caption']); ?>"
						data-action="<?php echo esc_attr($this->input_attrs['action']); ?>">
				</label>
				<?php
			}
		}

		class Gordon_Customize_Hidden_Control extends WP_Customize_Control {
			public $type = 'info';

			public function render_content() {
				?><input type="hidden" name="_customize-hidden-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?> value=""><?php
			}
		}
	
	}
}


// Sanitize plain value
if (!function_exists('gordon_sanitize_value')) {
	function gordon_sanitize_value($value) {
		return empty($value) ? $value : trim(strip_tags($value));
	}
}


// Sanitize html value
if (!function_exists('gordon_sanitize_html')) {
	function gordon_sanitize_html($value) {
		return empty($value) ? $value : wp_kses_post($value);
	}
}


//--------------------------------------------------------------
// Save custom settings in CSS file
//--------------------------------------------------------------

// Save CSS with custom colors and fonts after save custom options
if (!function_exists('gordon_customizer_action_save_after')) {
	add_action('customize_save_after', 'gordon_customizer_action_save_after');
	function gordon_customizer_action_save_after($api=false) {

		// Get saved settings
		$settings = $api->settings();

		// Store new schemes colors
		$schemes = gordon_unserialize($settings['scheme_storage']->value());
		if (is_array($schemes) && count($schemes) > 0) 
			gordon_storage_set('schemes', $schemes);

		// Store new fonts parameters
		$fonts = gordon_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = $settings["{$tag}_{$css_prop}"]->value();
			}
		}
		gordon_storage_set('theme_fonts', $fonts);

		// Regenerate CSS with new colors
		gordon_customizer_save_css();
	}
}

// Save CSS with custom colors and fonts after switch theme
if (!function_exists('gordon_customizer_action_switch_theme')) {
	add_action('after_switch_theme', 'gordon_customizer_action_switch_theme');
	function gordon_customizer_action_switch_theme() {
		// Remove condition if you want regenerate css after switch to this theme
		if (false) gordon_customizer_save_css();
	}
}

// Save CSS with custom colors and fonts into custom.css
if (!function_exists('gordon_customizer_save_css')) {
	add_action('trx_addons_action_save_options', 'gordon_customizer_save_css');
	function gordon_customizer_save_css() {
		$msg = 	'/* ' . esc_html__("ATTENTION! This file was generated automatically! Don't change it!!!", 'gordon') 
				. "\n----------------------------------------------------------------------- */\n";

		// Save CSS with custom colors and fonts into custom.css
		$css = gordon_customizer_get_css();
		$file = gordon_get_file_dir('css/__colors.css');
		if (file_exists($file)) gordon_fpc($file, $msg . $css );

		// Merge stylesheets
		$list = apply_filters( 'gordon_filter_merge_styles', array() );
		$css = '';
		foreach ($list as $f) {
			$css .= gordon_fgc(gordon_get_file_dir($f));
		}
		if ( $css != '') {
			gordon_fpc( gordon_get_file_dir('css/__styles.css'), $msg . apply_filters( 'gordon_filter_prepare_css', $css, true ) );
		}

		// Merge scripts
		$list = apply_filters( 'gordon_filter_merge_scripts', array(
																	'js/skip-link-focus.js',
																	'js/bideo.js',
																	'js/jquery.tubular.js',
																	'js/_utils.js',
																	'js/_init.js'
																	)
							);
		$js = '';
		foreach ($list as $f) {
			$js .= gordon_fgc(gordon_get_file_dir($f));
		}
		if ( $js != '') {
			gordon_fpc( gordon_get_file_dir('js/__scripts.js'), $msg . apply_filters( 'gordon_filter_prepare_js', $js, true ) );
		}
	}
}


//--------------------------------------------------------------
// Border radius settings
//--------------------------------------------------------------

// Return current theme-specific border radius for form's fields and buttons
if ( !function_exists( 'gordon_get_border_radius' ) ) {
	function gordon_get_border_radius() {
		$rad = str_replace(' ', '', gordon_get_theme_option('border_radius'));
		if (empty($rad)) $rad = 0;
		return gordon_prepare_css_value($rad); 
	}
}


//--------------------------------------------------------------
// Color schemes manipulations
//--------------------------------------------------------------

// Load saved values into color schemes
if (!function_exists('gordon_load_schemes')) {
	add_action('gordon_action_load_options', 'gordon_load_schemes');
	function gordon_load_schemes() {
		$schemes = gordon_storage_get('schemes');
		$storage = gordon_unserialize(gordon_get_theme_option('scheme_storage'));
		if (is_array($storage) && count($storage) > 0)  {
			foreach ($storage as $k=>$v) {
				if (isset($schemes[$k])) {
					$schemes[$k] = $v;
				}
			}
			gordon_storage_set('schemes', $schemes);
		}
	}
}

// Return specified color from current (or specified) color scheme
if ( !function_exists( 'gordon_get_scheme_color' ) ) {
	function gordon_get_scheme_color($color_name, $scheme = '') {
		if (empty($scheme)) $scheme = gordon_get_theme_option( 'color_scheme' );
		if (empty($scheme) || gordon_storage_empty('schemes', $scheme)) $scheme = 'default';
		$colors = gordon_storage_get_array('schemes', $scheme, 'colors');
		return $colors[$color_name];
	}
}

// Return colors from current color scheme
if ( !function_exists( 'gordon_get_scheme_colors' ) ) {
	function gordon_get_scheme_colors($scheme = '') {
		if (empty($scheme)) $scheme = gordon_get_theme_option( 'color_scheme' );
		if (empty($scheme) || gordon_storage_empty('schemes', $scheme)) $scheme = 'default';
		return gordon_storage_get_array('schemes', $scheme, 'colors');
	}
}


// Return schemes list
if ( !function_exists( 'gordon_get_list_schemes' ) ) {
	function gordon_get_list_schemes($prepend_inherit=false) {
		$list = array();
		$schemes = gordon_storage_get('schemes');
		if (is_array($schemes) && count($schemes) > 0) {
			foreach ($schemes as $slug => $scheme) {
				$list[$slug] = $scheme['title'];
			}
		}
		return $prepend_inherit ? gordon_array_merge(array('inherit' => esc_html__("Inherit", 'gordon')), $list) : $list;
	}
}


//--------------------------------------------------------------
// Theme fonts
//--------------------------------------------------------------

// Load saved values into fonts list
if (!function_exists('gordon_load_fonts')) {
	add_action('gordon_action_load_options', 'gordon_load_fonts');
	function gordon_load_fonts() {
		// Fonts to load when theme starts
		$fonts = array();
		for ($i=1; $i<=gordon_get_theme_setting('max_load_fonts'); $i++) {
			if (($name = gordon_get_theme_option("load_fonts-{$i}-name")) != '') {
				$fonts[] = array(
					'name'	 => $name,
					'family' => gordon_get_theme_option("load_fonts-{$i}-family"),
					'styles' => gordon_get_theme_option("load_fonts-{$i}-styles")
				);
			}
		}
		gordon_storage_set('load_fonts', $fonts);
		gordon_storage_set('load_fonts_subset', gordon_get_theme_option("load_fonts_subset"));
		
		// Font parameters of the main theme's elements
		$fonts = gordon_get_theme_fonts();
		foreach ($fonts as $tag=>$v) {
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$fonts[$tag][$css_prop] = gordon_get_theme_option("{$tag}_{$css_prop}");
			}
		}
		gordon_storage_set('theme_fonts', $fonts);
	}
}

// Return slug of the loaded font
if (!function_exists('gordon_get_load_fonts_slug')) {
	function gordon_get_load_fonts_slug($name) {
		return str_replace(' ', '-', $name);
	}
}

// Return load fonts parameter's default value
if (!function_exists('gordon_get_load_fonts_option')) {
	function gordon_get_load_fonts_option($option_name) {
		$rez = '';
		$parts = explode('-', $option_name);
		$load_fonts = gordon_storage_get('load_fonts');
		if ($parts[0] == 'load_fonts' && count($load_fonts) > $parts[1]-1 && isset($load_fonts[$parts[1]-1][$parts[2]])) {
			$rez = $load_fonts[$parts[1]-1][$parts[2]];
		}
		return $rez;
	}
}

// Return load fonts subset's default value
if (!function_exists('gordon_get_load_fonts_subset')) {
	function gordon_get_load_fonts_subset($option_name) {
		return gordon_storage_get('load_fonts_subset');
	}
}

// Return load fonts list
if (!function_exists('gordon_get_list_load_fonts')) {
	function gordon_get_list_load_fonts($prepend_inherit=false) {
		$list = array();
		$load_fonts = gordon_storage_get('load_fonts');
		if (is_array($load_fonts) && count($load_fonts) > 0) {
			foreach ($load_fonts as $font) {
				$list[sprintf('%s%s', 
								strpos($font['name'], ' ')!==false ? sprintf('"%s"', $font['name']) : $font['name'],
								!empty($font['family']) ? ', '.trim($font['family']): '')] = $font['name'];
			}
		}
		return $prepend_inherit ? gordon_array_merge(array('inherit' => esc_html__("Inherit", 'gordon')), $list) : $list;
	}
}

// Return font settings of the theme specific elements
if ( !function_exists( 'gordon_get_theme_fonts' ) ) {
	function gordon_get_theme_fonts() {
		return gordon_storage_get('theme_fonts');
	}
}

// Return theme fonts parameter's default value
if (!function_exists('gordon_get_theme_fonts_option')) {
	function gordon_get_theme_fonts_option($option_name) {
		$rez = '';
		$parts = explode('_', $option_name);
		$theme_fonts = gordon_storage_get('theme_fonts');
		if (!empty($theme_fonts[$parts[0]][$parts[1]])) {
			$rez = $theme_fonts[$parts[0]][$parts[1]];
		}
		// For the font-families update options list also
		if ($parts[1] == 'font-family') {
			gordon_storage_set_array2('options', $option_name, 'options', gordon_get_list_load_fonts(true));
		}
		return $rez;
	}
}


//--------------------------------------------------------------
// Customizer JS and CSS
//--------------------------------------------------------------

// Binds JS listener to make Customizer color_scheme control.
// Passes color scheme data as colorScheme global.
if ( !function_exists( 'gordon_customizer_control_js' ) ) {
	add_action( 'customize_controls_enqueue_scripts', 'gordon_customizer_control_js' );
	function gordon_customizer_control_js() {
		wp_enqueue_style( 'gordon-customizer', gordon_get_file_url('theme-options/theme.customizer.css') );
		wp_enqueue_script( 'gordon-customizer-color-scheme-control',
									gordon_get_file_url('theme-options/theme.customizer.color-scheme.js'),
									array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), null, true );
		wp_localize_script( 'gordon-customizer-color-scheme-control', 'gordon_color_schemes', gordon_storage_get('schemes') );
		wp_localize_script( 'gordon-customizer-color-scheme-control', 'gordon_theme_fonts', gordon_storage_get('theme_fonts') );
		wp_localize_script( 'gordon-customizer-color-scheme-control', 'gordon_customizer_vars', array(
			'max_load_fonts' => gordon_get_theme_setting('max_load_fonts'),
			'msg_refresh' => esc_html__('Refresh', 'gordon'),
			'msg_reset' => esc_html__('Reset', 'gordon'),
			'msg_reset_confirm' => esc_html__('Are you sure you want to reset all Theme Options?', 'gordon'),
			) );
		wp_localize_script( 'gordon-customizer-color-scheme-control', 'gordon_dependencies', gordon_get_theme_dependencies() );
	}
}

// Binds JS handlers to make the Customizer preview reload changes asynchronously.
if ( !function_exists( 'gordon_customizer_preview_js' ) ) {
	add_action( 'customize_preview_init', 'gordon_customizer_preview_js' );
	function gordon_customizer_preview_js() {
		wp_enqueue_script( 'gordon-customize-preview',
							gordon_get_file_url('theme-options/theme.customizer.preview.js'), 
							array( 'customize-preview' ), null, true );
	}
}

// Output an Underscore template for generating CSS for the color scheme.
// The template generates the css dynamically for instant display in the Customizer preview.
if ( !function_exists( 'gordon_customizer_css_template' ) ) {
	add_action( 'customize_controls_print_footer_scripts', 'gordon_customizer_css_template' );
	function gordon_customizer_css_template() {
		$colors = array(
			
			// Whole block border and background
			'bg_color'				=> '{{ data.bg_color }}',
			'bd_color'				=> '{{ data.bd_color }}',
			
			// Text and links colors
			'text'					=> '{{ data.text }}',
			'text_light'			=> '{{ data.text_light }}',
			'text_dark'				=> '{{ data.text_dark }}',
			'text_link'				=> '{{ data.text_link }}',
			'text_hover'			=> '{{ data.text_hover }}',
		
			// Alternative blocks (submenu, buttons, tabs, etc.)
			'alter_bg_color'		=> '{{ data.alter_bg_color }}',
			'alter_bg_hover'		=> '{{ data.alter_bg_hover }}',
			'alter_bd_color'		=> '{{ data.alter_bd_color }}',
			'alter_bd_hover'		=> '{{ data.alter_bd_hover }}',
			'alter_text'			=> '{{ data.alter_text }}',
			'alter_light'			=> '{{ data.alter_light }}',
			'alter_dark'			=> '{{ data.alter_dark }}',
			'alter_link'			=> '{{ data.alter_link }}',
			'alter_hover'			=> '{{ data.alter_hover }}',
		
			// Input fields (form's fields and textarea)
			'input_bg_color'		=> '{{ data.input_bg_color }}',
			'input_bg_hover'		=> '{{ data.input_bg_hover }}',
			'input_bd_color'		=> '{{ data.input_bd_color }}',
			'input_bd_hover'		=> '{{ data.input_bd_hover }}',
			'input_text'			=> '{{ data.input_text }}',
			'input_light'			=> '{{ data.input_light }}',
			'input_dark'			=> '{{ data.input_dark }}',

			// Inverse blocks (with background equal to the links color or one of accented colors)
			'inverse_text'			=> '{{ data.inverse_text }}',
			'inverse_light'			=> '{{ data.inverse_light }}',
			'inverse_dark'			=> '{{ data.inverse_dark }}',
			'inverse_link'			=> '{{ data.inverse_link }}',
			'inverse_hover'			=> '{{ data.inverse_hover }}',

			// Additional accented colors (if used in the current theme)

		);

		$tmpl_holder = 'script';

		$schemes = array_keys(gordon_get_list_schemes());
		if (count($schemes) > 0) {
			foreach ($schemes as $scheme) {
				echo '<' . esc_html($tmpl_holder) . ' type="text/html" id="tmpl-gordon-color-scheme-'.esc_attr($scheme).'">'
						. gordon_customizer_get_css( $colors, false, false, $scheme )
					. '</' . esc_html($tmpl_holder) . '>';
			}
		}


		// Fonts
		$fonts = gordon_get_theme_fonts();
		if (is_array($fonts) && count($fonts) > 0) {
			foreach ($fonts as $tag => $font) {
				$fonts[$tag]['font-family']		= '{{ data["'.$tag.'"]["font-family"] }}';
				$fonts[$tag]['font-size']		= '{{ data["'.$tag.'"]["font-size"] }}';
				$fonts[$tag]['line-height']		= '{{ data["'.$tag.'"]["line-height"] }}';
				$fonts[$tag]['font-weight']		= '{{ data["'.$tag.'"]["font-weight"] }}';
				$fonts[$tag]['font-style']		= '{{ data["'.$tag.'"]["font-style"] }}';
				$fonts[$tag]['text-decoration']	= '{{ data["'.$tag.'"]["text-decoration"] }}';
				$fonts[$tag]['text-transform']	= '{{ data["'.$tag.'"]["text-transform"] }}';
				$fonts[$tag]['letter-spacing']	= '{{ data["'.$tag.'"]["letter-spacing"] }}';
				$fonts[$tag]['margin-top']		= '{{ data["'.$tag.'"]["margin-top"] }}';
				$fonts[$tag]['margin-bottom']	= '{{ data["'.$tag.'"]["margin-bottom"] }}';
			}
			echo '<'.trim($tmpl_holder).' type="text/html" id="tmpl-gordon-fonts">'
					. trim(gordon_customizer_get_css( false, $fonts, false, false ))
				. '</'.trim($tmpl_holder).'>';
		}

	}
}


// Add scheme name in each selector in the CSS (priority 100 - after complete css)
if (!function_exists('gordon_customizer_add_scheme_in_css')) {
	add_action( 'gordon_filter_get_css', 'gordon_customizer_add_scheme_in_css', 100, 4 );
	function gordon_customizer_add_scheme_in_css($css, $colors, $fonts, $scheme) {
		if ($colors && !empty($css['colors'])) {
			$rez = '';
			$in_comment = $in_rule = false;
			$allow = true;
			$scheme_class = sprintf('.scheme_%s ', $scheme);
			$self_class = '.scheme_self';
			$self_class_len = strlen($self_class);
			$css_str = str_replace(array('{{', '}}'), array('[[',']]'), $css['colors']);
			for ($i=0; $i<strlen($css_str); $i++) {
				$ch = $css_str[$i];
				if ($in_comment) {
					$rez .= $ch;
					if ($ch=='/' && $css_str[$i-1]=='*') {
						$in_comment = false;
						$allow = !$in_rule;
					}
				} else if ($in_rule) {
					$rez .= $ch;
					if ($ch=='}') {
						$in_rule = false;
						$allow = !$in_comment;
					}
				} else {
					if ($ch=='/' && $css_str[$i+1]=='*') {
						$rez .= $ch;
						$in_comment = true;
					} else if ($ch=='{') {
						$rez .= $ch;
						$in_rule = true;
					} else if ($ch==',') {
						$rez .= $ch;
						$allow = true;
					} else if (strpos(" \t\r\n", $ch)===false) {
						if ($allow) {
							$pos_comma = strpos($css_str, ',', $i+1);
							$pos_bracket = strpos($css_str, '{', $i+1);
							$pos = $pos_comma === false
										? $pos_bracket
										: ($pos_bracket === false
												? $pos_comma
												: min($pos_comma, $pos_bracket)
											);
							$selector = $pos > 0 ? substr($css_str, $i, $pos-$i) : '';
							if (strpos($selector, $self_class) !== false) {
								$rez .= str_replace($self_class, trim($scheme_class), $selector);
								$i += strlen($selector) - 1;
							} else {
								$rez .= $scheme_class . trim($ch);
							}
							$allow = false;
						} else
							$rez .= $ch;
					} else {
						$rez .= $ch;
					}
				}
			}
			$rez = str_replace(array('[[',']]'), array('{{', '}}'), $rez);
			$css['colors'] = $rez;
		}
		return $css;
	}
}
	



// -----------------------------------------------------------------
// -- Page Options section
// -----------------------------------------------------------------

if ( !function_exists('gordon_options_override_init') ) {
	add_action( 'after_setup_theme', 'gordon_options_override_init' );
	function gordon_options_override_init() {
		if ( is_admin() ) {
			add_action("admin_enqueue_scripts", 'gordon_options_override_add_scripts');
			add_action('save_post',			'gordon_options_override_save_options');
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'gordon_options_override_add_scripts' ) ) {
	add_action("admin_enqueue_scripts", 'gordon_options_override_add_scripts');
	function gordon_options_override_add_scripts() {
		// If current screen is 'Edit Page' - load fontello
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && gordon_options_allow_override(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
			wp_enqueue_style( 'fontello-icons',  gordon_get_file_url('css/fontello/fontello-embedded.css') );
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui'), null, true);
			wp_enqueue_script( 'gordon-override-options', gordon_get_file_url('theme-options/theme-options.js'), array('jquery'), null, true );
			wp_localize_script( 'gordon-override-options', 'gordon_dependencies', gordon_get_theme_dependencies() );
		}
	}
}


// Check if override options is allow
if (!function_exists('gordon_options_allow_override')) {
	function gordon_options_allow_override($post_type) {
		return apply_filters('gordon_filter_allow_override', in_array($post_type, array('page', 'post')), $post_type);
	}
}

// Add overriden options
if (!function_exists('gordon_options_override_add_options')) {
    add_filter('gordon_filter_override_options', 'gordon_options_override_add_options');
    function gordon_options_override_add_options($list) {
   	 global $post_type;
   	 if (gordon_options_allow_override($post_type)) {
   		 $list[] = array(sprintf('gordon_override_options_%s', $post_type),
   						 esc_html__('Theme Options', 'gordon'),
   						 'gordon_options_override_show',
   						 $post_type,
   						 $post_type=='post' ? 'side' : 'advanced',
   						 'default'
   						 );
   	 }
   	 return $list;
    }
}

// Callback function to show fields in override options
if (!function_exists('gordon_options_override_show')) {
	function gordon_options_override_show() {
		global $post, $post_type;
		if (gordon_options_allow_override($post_type)) {
			// Load saved options 
			$meta = get_post_meta($post->ID, 'gordon_options', true);
			$tabs_titles = $tabs_content = array();
			global $GORDON_STORAGE;
			// Refresh linked data if this field is controller for the another (linked) field
			// Do this before show fields to refresh data in the $GORDON_STORAGE
			foreach ($GORDON_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (!empty($v['linked'])) {
					$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
					if (!empty($v['val']) && !gordon_is_inherit($v['val']))
						gordon_refresh_linked_data($v['val'], $v['linked']);
				}
			}
			// Show fields
			foreach ($GORDON_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (empty($v['override']['section']))
					$v['override']['section'] = esc_html__('General', 'gordon');
				if (!isset($tabs_titles[$v['override']['section']])) {
					$tabs_titles[$v['override']['section']] = $v['override']['section'];
					$tabs_content[$v['override']['section']] = '';
				}
				$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
				$tabs_content[$v['override']['section']] .= gordon_options_override_show_field($k, $v);
			}
			if (count($tabs_titles) > 0) {
				?>
				<div class="gordon_override_options">
					<input type="hidden" name="override_options_post_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
					<input type="hidden" name="override_options_post_type" value="<?php echo esc_attr($post_type); ?>" />
					<div id="gordon_override_options_tabs">
						<ul><?php
							$cnt = 0;
							foreach ($tabs_titles as $k=>$v) {
								$cnt++;
								?><li><a href="#gordon_override_options_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
							}
						?></ul>
						<?php
							$cnt = 0;
							foreach ($tabs_content as $k=>$v) {
								$cnt++;
								?>
								<div id="gordon_override_options_<?php echo esc_attr($cnt); ?>" class="gordon_override_options_section">
									<?php gordon_show_layout($v); ?>
								</div>
								<?php
							}
						?>
					</div>
				</div>
				<?php		
			}
		}
	}
}

// Display single option's field
if ( !function_exists('gordon_options_override_show_field') ) {
	function gordon_options_override_show_field($name, $field) {

		if ($field['type'] == 'hidden') return '';

		$inherit_state = gordon_is_inherit($field['val']);
		$output = '<div class="gordon_override_options_item gordon_override_options_item_'.esc_attr($field['type'])
								. ' gordon_override_options_inherit_'.($inherit_state ? 'on' : 'off' )
								. '">'
						. '<h4 class="gordon_override_options_item_title">'
							. esc_html($field['title'])
							. '<span class="gordon_override_options_inherit_lock" id="gordon_override_options_inherit_'.esc_attr($name).'"></span>'
						. '</h4>'
						. '<div class="gordon_override_options_item_data">'
							. '<div class="gordon_override_options_item_field" data-param="'.esc_attr($name).'"'
									. (!empty($field['linked']) ? ' data-linked="'.esc_attr($field['linked']).'"' : '')
									. '>';
	
		// Type 'checkbox'
		if ($field['type']=='checkbox') {
			$output .= '<label class="gordon_override_options_item_label">'
						. '<input type="checkbox" name="gordon_override_options_field_'.esc_attr($name).'" value="1"'
								.($field['val']==1 ? ' checked="checked"' : '')
								.' />'
						. esc_html($field['title'])
					. '</label>';
		
		// Type 'switch' (2 choises) or 'radio' (3+ choises)
		} else if (in_array($field['type'], array('switch', 'radio'))) {
			$field['options'] = apply_filters('gordon_filter_options_get_list_choises', $field['options'], $name);
			foreach ($field['options'] as $k=>$v) {
				$output .= '<label class="gordon_override_options_item_label">'
							. '<input type="radio" name="gordon_override_options_field_'.esc_attr($name).'"'
									. ' value="'.esc_attr($k).'"'.($field['val']==$k ? ' checked="checked"' : '')
									. ' />'
							. esc_html($v)
						. '</label>';
			}

		// Type 'text' or 'time' or 'date'
		} else if (in_array($field['type'], array('text', 'time', 'date'))) {
			$output .= '<input type="text" name="gordon_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(gordon_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />';
		
		// Type 'textarea'
		} else if ($field['type']=='textarea') {
			$output .= '<textarea name="gordon_override_options_field_'.esc_attr($name).'">'
							. esc_html(gordon_is_inherit($field['val']) ? '' : $field['val'])
						. '</textarea>';
			
		// Type 'select'
		} else if ($field['type']=='select') {
			$field['options'] = apply_filters('gordon_filter_options_get_list_choises', $field['options'], $name);
			$output .= '<select size="1" name="gordon_override_options_field_'.esc_attr($name).'">';
			foreach ($field['options'] as $k=>$v) {
				$output .= '<option value="'.esc_attr($k).'"'.($field['val']==$k ? ' selected="selected"' : '').'>'.esc_html($v).'</option>';
			}
			$output .= '</select>';

		// Type 'image', 'media', 'video' or 'audio'
		} else if (in_array($field['type'], array('image', 'media', 'video', 'audio'))) {
			$output .= '<input type="text" id="gordon_override_options_field_'.esc_attr($name).'"'
							. ' name="gordon_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(gordon_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
					. gordon_show_custom_field('gordon_override_options_field_'.esc_attr($name).'_button',
												array(
													'type'			 => 'mediamanager',
													'data_type'		 => $field['type'],
													'linked_field_id'=> 'gordon_override_options_field_'.esc_attr($name)
												),
												null)
					. '<div class="gordon_override_options_field_preview">'
						. (gordon_is_inherit($field['val']) 
								? '' 
								: ($field['val'] && $field['type']=='image' 
										? '<img src="' . esc_url($field['val']) . '" alt=" '.esc_attr($name).' ">' 
										: basename($field['val'])
									)
							)
					. '</div>';
		
		// Type 'icon'
		} else if ($field['type']=='icon') {
			$output .= '<input type="text" id="gordon_override_options_field_'.esc_attr($name).'"'
							. ' name="gordon_override_options_field_'.esc_attr($name).'"'
							. ' value="'.esc_attr(gordon_is_inherit($field['val']) ? '' : $field['val']).'"'
							. ' />'
						. gordon_show_custom_field('gordon_override_options_field_'.esc_attr($name).'_button',
													array(
														'type'	 => 'icons',
														'button' => true,
														'icons'	 => true
													),
													$field['val']);
		}
		$output .= '<div class="gordon_override_options_inherit_cover'.(!$inherit_state ? ' gordon_hidden' : '').'">'
							. '<span class="gordon_override_options_inherit_label">' . esc_html__('Inherit', 'gordon') . '</span>'
							. '<input type="hidden" name="gordon_override_options_inherit_'.esc_attr($name).'"'
									. ' value="'.esc_attr($inherit_state ? 'inherit' : '').'"'
									. ' />'
						. '</div>'
					. '</div>'
					. '<div class="gordon_override_options_item_description">'
						. (!empty($field['override']['desc']) 	// param 'desc' already processed with wp_kses()!
								? $field['override']['desc'] 
								: $field['desc'])
					. '</div>'
				. '</div>'
			. '</div>';
		return $output;
	}
}

// Save data from override options
if (!function_exists('gordon_options_override_save_options')) {
	//Handler of the add_action('save_post', 'gordon_options_override_save_options');
	function gordon_options_override_save_options($post_id) {

		// verify nonce
		if ( !wp_verify_nonce( gordon_get_value_gp('override_options_post_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$post_type = isset($_POST['override_options_post_type']) ? sanitize_text_field($_POST['override_options_post_type']) : sanitize_text_field($_POST['post_type']);

		// check permissions
		$capability = 'page';
		$post_types = get_post_types( array( 'name' => $post_type), 'objects' );
		if (!empty($post_types) && is_array($post_types)) {
			foreach ($post_types  as $type) {
				$capability = $type->capability_type;
				break;
			}
		}
		if (!current_user_can('edit_'.($capability), $post_id)) {
			return $post_id;
		}

		// Save meta
		$meta = array();
		$options = gordon_storage_get('options');
		foreach ($options as $k=>$v) {
			// Skip not overriden options
			if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
			// Skip inherited options
			if (!empty($_POST['gordon_override_options_inherit_' . $k])) continue;
			// Get option value from POST
			$meta[$k] = isset($_POST['gordon_override_options_field_' . $k])
							? sanitize_text_field($_POST['gordon_override_options_field_' . $k])
							: ($v['type']=='checkbox' ? 0 : '');
		}
		update_post_meta($post_id, 'gordon_options', $meta);
		
		// Save separate meta options to search template pages
		if ($post_type=='page' && !empty($_POST['page_template']) && $_POST['page_template']=='blog.php') {
			update_post_meta($post_id, 'gordon_options_post_type', isset($meta['post_type']) ? $meta['post_type'] : 'post');
			update_post_meta($post_id, 'gordon_options_parent_cat', isset($meta['parent_cat']) ? $meta['parent_cat'] : 0);
		}
	}
}

// Refresh data in the linked field
// according the main field value
if (!function_exists('gordon_refresh_linked_data')) {
	function gordon_refresh_linked_data($value, $linked_name) {
		if ($linked_name == 'parent_cat') {
			$tax = gordon_get_post_type_taxonomy($value);
			$terms = !empty($tax) ? gordon_get_list_terms(false, $tax) : array();
			$terms = gordon_array_merge(array(0 => esc_html__('- Select category -', 'gordon')), $terms);
			gordon_storage_set_array2('options', $linked_name, 'options', $terms);
		}
	}
}

// AJAX: Refresh data in the linked fields
if (!function_exists('gordon_callback_get_linked_data')) {
	add_action('wp_ajax_gordon_get_linked_data', 		'gordon_callback_get_linked_data');
	add_action('wp_ajax_nopriv_gordon_get_linked_data','gordon_callback_get_linked_data');
	function gordon_callback_get_linked_data() {
		if ( !wp_verify_nonce( gordon_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			wp_die();
		$chg_name = sanitize_text_field($_REQUEST['chg_name']);
		$chg_value = sanitize_text_field($_REQUEST['chg_value']);
		$response = array('error' => '');
		if ($chg_name == 'post_type') {
			$tax = gordon_get_post_type_taxonomy($chg_value);
			$terms = !empty($tax) ? gordon_get_list_terms(false, $tax) : array();
			$response['list'] = gordon_array_merge(array(0 => esc_html__('- Select category -', 'gordon')), $terms);
		}
		echo json_encode($response);
		wp_die();
	}
}

// Show theme specific fields in the override options
function gordon_show_custom_field($id, $field, $value) {
	$output = '';
	switch ($field['type']) {
		
		case 'mediamanager':
			wp_enqueue_media( );
			$title = empty($field['data_type']) || $field['data_type']=='image'
							? esc_html__( 'Choose Image', 'gordon')
							: esc_html__( 'Choose Media', 'gordon');
			$output .= '<a id="'.esc_attr($id).'" class="button mediamanager gordon_media_selector"
				data-param="' . esc_attr($id) . '"
				data-choose="'.esc_attr(isset($field['multiple']) && $field['multiple'] 
					? esc_html__( 'Choose Images', 'gordon') 
					: $title
					).'"
				data-update="'.esc_attr(isset($field['multiple']) && $field['multiple'] 
					? esc_html__( 'Add to Gallery', 'gordon') 
					: $title
					).'"
				data-multiple="'.esc_attr(isset($field['multiple']) && $field['multiple'] ? 'true' : 'false').'"
				data-type="'.esc_attr(!empty($field['data_type']) ? $field['data_type'] : 'image').'"
				data-linked-field="'.esc_attr($field['linked_field_id']).'"
				>' . (isset($field['multiple']) && $field['multiple'] 
					? esc_html__( 'Add Images', 'gordon') 
					: esc_html($title)
				) . '</a>';
			break;

		case 'icons':
			if (!empty($field['button']))
				$output .= '<span id="'.esc_attr($id).'"'
								. ' class="gordon_list_icons_selector'
										. (!empty($value) ? ' '.esc_attr($value) : '')
										.'"'
								. ' title="'.esc_attr__('Select icon', 'gordon').'"'
							. '></span>';
			if (!empty($field['icons'])) {
				$gordon_icons = gordon_get_list_icons();
				if (is_array($gordon_icons)) {
					$output .= '<div class="gordon_list_icons">';
					foreach($gordon_icons as $icon)
						$output .= '<span class="'.esc_attr($icon).'" title="'.esc_attr($icon).'"></span>';
					$output .= '</div>';
				}
			}
			break;
	}
	return apply_filters('gordon_filter_show_custom_field', $output, $id, $field, $value);
}



//--------------------------------------------------------------
//-- Load Options list and styles
//--------------------------------------------------------------
require_once GORDON_THEME_DIR . 'theme-specific/theme.setup.php';
require_once GORDON_THEME_DIR . 'theme-options/theme.options.php';
require_once GORDON_THEME_DIR . 'theme-specific/theme.styles.php';
?>