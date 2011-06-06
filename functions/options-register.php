<?php
/**
 * Oenology Theme Options Settings API
 *
 * This file implements the WordPress Settings API for the 
 * Options for the Oenology Theme.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * Register Theme Settings
 * 
 * Register theme_oenology_options array to hold
 * all Theme options.
 */
register_setting( 'theme_oenology_options', 'theme_oenology_options', 'oenology_options_validate' );

/**
 * Validate/Whitelist User-Input Data Before Updating Theme Options
 * 
 * @link	http://codex.wordpress.org/Data_Validation	Codex Reference: Data Validation
 */
function oenology_options_validate( $input ) {

	$valid_input = get_option( 'theme_oenology_options' );
	$settingsbytab = oenology_get_settings_by_tab();
	$default_options = oenology_get_default_options();
	
	// Determine what type of submit was input
	$submittype = ( 
		(  ! empty( $input['submit-general'] ) 
		|| ! empty( $input['submit-varietals'] ) 
		) ? 'submit' : 'reset' );
	// Determine what tab was input
	$submittab = 'general';
	if ( ! empty( $input['submit-varietals'] ) || ! empty($input['reset-varietals'] ) ) {
		$submittab = 'varietals';
	}
	// Get settings by tab
	$tabsettings = $settingsbytab[$submittab];
	// Loop through each tab setting
	foreach ( $tabsettings as $setting ) {
		// If submit, validate/sanitize $input
		if ( 'submit' == $submittype ) {
			$optiondetails = false;
			foreach ( $default_options as $default_option ) {
				if ( $default_option['name'] == $setting ) {
					$optiondetails = $default_option;
				}
			}
			// Validate checkbox fields
			if ( 'checkbox' == $optiondetails['type'] ) {
				$valid_input[$setting] = ( ( isset( $input[$setting] ) && true == $input[$setting] ) ? true : false );
			}
			// Validate radio button fields
			else if ( 'radio' == $optiondetails['type'] ) {
				$valid_options = $optiondetails['valid_options'];
				$valid_input[$setting] = ( array_key_exists( $input[$setting], $valid_options ) ? $input[$setting] : $valid_input[$setting] );
			}
			// Validate select fields
			else if ( 'select' == $optiondetails['type'] ) {
				$valid_options = $optiondetails['valid_options'];
				$valid_input[$setting] = ( array_key_exists( $input[$setting], $valid_options ) ? $input[$setting] : $valid_input[$setting] );
			}
			// Validate text input and textarea fields
			else if ( ( 'text' == $optiondetails['type'] || 'textarea' == $optiondetails['type'] ) ) {
				// Validate no-HTML content
				if ( 'nohtml' == $optiondetails['sanitize'] ) {
					$valid_input[$setting] = wp_filter_nohtml_kses( $input[$setting] );
				}
				// Validate HTML content
				if ( 'html' == $optiondetails['sanitize'] ) {
					$valid_input[$setting] = wp_filter_kses( $input[$setting] );
				}
			}
			// Validate custom fields
			else if ( 'custom' == $optiondetails['type'] ) {
				if ( 'varietal' == $setting ) {
					$valid_options = $optiondetails['valid_options'];
					$valid_input[$setting] = ( array_key_exists( $input[$setting], $valid_options ) ? $input[$setting] : $valid_input[$setting] );
				}
			}
		} 
		// If reset, reset defaults
		elseif ( 'reset' == $submittype ) {
			$option = $default_options[$setting];
			$setting_default = $option['default'];
			$valid_input[$setting] = $setting_default;
		}
	}
	return $valid_input;		

}

/**
 * Globalize the variable that holds 
 * the Settings Page tab definitions
 * 
 * @global	array	Settings Page Tab definitions
 */
global $oenology_tabs;
$oenology_tabs = oenology_get_settings_page_tabs();
/**
 * Call add_settings_section() for each Settings Section
 */
foreach ( $oenology_tabs as $tab ) {
	$tabname = $tab['name'];
	$tabsections = $tab['sections'];
	foreach ( $tabsections as $section ) {
		$sectionname = $section['name'];
		$sectiontitle = $section['title'];
		// Add settings section
		add_settings_section(
			'oenology_' . $sectionname . '_section',
			$sectiontitle,
			'oenology_sections_callback', //'oenology_' . $sectionname . '_text',
			'oenology_' . $tabname . '_tab'
		);
	}
}

/**
 * Callback for add_settings_section()
 * 
 * Generic callback to output the section text
 * for each Plugin settings section. 
 * 
 * @param	array	$section_passed	Array passed from add_settings_section()
 */
function oenology_sections_callback( $section_passed ) {
	global $oenology_tabs;
	$oenology_hooks_tabs = oenology_get_settings_page_tabs();
	foreach ( $oenology_tabs as $tab ) {
		$tabname = $tab['name'];
		$tabsections = $tab['sections'];
		foreach ( $tabsections as $section ) {
			$sectionname = $section['name'];
			$sectiondescription = $section['description'];
			$section_callback_id = 'oenology_' . $sectionname . '_section';
			if ( $section_callback_id == $section_passed['id'] ) {
				?>
				<p><?php echo $sectiondescription; ?></p>
				<?php
			}
		}
	}
}

/**
 * Add Section Text for the Varietal Settings Section
 */
function oenology_get_varietal_text() {

	$oenology_options = get_option( 'theme_oenology_options' );
	$oenology_varietals = oenology_get_valid_varietals();
	$imgstyle = 'float:left;margin-right:20px;margin-bottom:20px;border: 1px solid #bbb;-moz-box-shadow: 2px 2px 2px #777;-webkit-box-shadow: 2px 2px 2px #777;box-shadow: 2px 2px 2px #777;';
	foreach ( $oenology_varietals as $varietal ) {
		if ( $varietal['name'] == $oenology_options['varietal'] ) {
		      $oenology_current_varietal = $varietal;
		}
	}
	$text = '';
	$text .= '<p>"Varietal" refers to wine made from exclusively or predominantly one variety of grape. Each varietal has unique flavor and aromatic characteristics. Refer to the contextual help screen for descriptions and help regarding each theme option.</p>';
	$text .= '<img style="' . $imgstyle . '" src="' . get_template_directory_uri() . '/varietals/' . $oenology_options['varietal'] . '.png' . '" width="150px" height="110px" alt="' . $oenology_options['varietal'] . '" />';
	$text .= '<h4>Current Varietal</h4>';
	$text .= '<dl><dt><strong>' . $oenology_current_varietal['title'] . '</strong></dt><dd>' . $oenology_current_varietal['description'] . '</dd></dl>';
	return $text;
}

/**
 * Globalize the variable that holds 
 * the Theme default settings definitions
 * 
 * @global	array	Theme settings definitions
 */
global $default_options;
$default_options = oenology_get_default_options();
/**
 * Call add_settings_field() for each Setting Field
 */
foreach ( $default_options as $option ) {
	$optionname = $option['name'];
	$optiontitle = $option['title'];
	$optiontab = $option['tab'];
	$optionsection = $option['section'];
	$optiontype = $option['type'];
	if ( 'internal' != $optiontype && 'custom' != $optiontype ) {
		add_settings_field(
			'oenology_setting_' . $optionname,
			$optiontitle,
			'oenology_setting_callback', //'oenology_setting_' . $optionname,
			'oenology_' . $optiontab . '_tab',
			'oenology_' . $optionsection . '_section',
			$option
		);
	} if ( 'custom' == $optiontype ) {
		add_settings_field(
			'oenology_setting_' . $optionname,
			$optiontitle,
			'oenology_setting_' . $optionname,
			'oenology_' . $optiontab . '_tab',
			'oenology_' . $optionsection . '_section'
		);
	}
}

/**
 * Callback for get_settings_field()
 */
function oenology_setting_callback( $option ) {
	$oenology_options = get_option( 'theme_oenology_options' );
	$default_options = oenology_get_default_options();
	$optionname = $option['name'];
	$optiontitle = $option['title'];
	$optiondescription = $option['description'];
	$fieldtype = $option['type'];
	$fieldname = 'theme_oenology_options[' . $optionname . ']';
	// Output checkbox form field markup
	if ( 'checkbox' == $fieldtype ) {
		?>
		<input type="checkbox" name="<?php echo $fieldname; ?>" <?php checked( $oenology_options[$optionname] ); ?> />
		<?php
	}
	// Output radio button form field markup
	else if ( 'radio' == $fieldtype ) {
		$valid_options = array();
		$valid_options = $option['valid_options'];
		foreach ( $valid_options as $valid_option ) {
			?>
			<input type="radio" name="<?php echo $fieldname; ?>" <?php checked( $valid_option['name'] == $oenology_options[$optionname] ); ?> value="<?php echo $valid_option['name']; ?>" />
			<?php
		}
	}
	// Output select form field markup
	else if ( 'select' == $fieldtype ) {
		$valid_options = array();
		$valid_options = $option['valid_options'];
		?>
		<select name="<?php echo $fieldname; ?>">
		<?php 
		foreach ( $valid_options as $valid_option ) {
			?>
			<option <?php selected( $valid_option['name'] == $oenology_options[$optionname] ); ?> value="<?php echo $valid_option['name']; ?>"><?php echo $valid_option['title']; ?></option>
			<?php
		}
		?>
		</select>
		<?php
	} 
	// Output text input form field markup
	else if ( 'text' == $fieldtype ) {
		?>
		<input type="text" name="<?php echo $fieldname; ?>" value="<?php echo wp_filter_nohtml_kses( $oenology_options[$optionname] ); ?>" />
		<?php
	} 
	// Output the setting description
	?>
	<span class="description"><?php echo $optiondescription; ?></span>
	<?php
}

/**
 * Callback for Varietal Setting Custom Form Field Markup
 */
function oenology_setting_varietal() {
	$oenology_varietals = oenology_get_valid_varietals();

	function oenology_output_varietal( $varietal ) {
		$oenology_options = get_option( 'theme_oenology_options' );
		$dlstylebase = 'border: 1px solid transparent;float:left;padding:5px;margin-top:5px;margin-bottom:5px;text-align:center;max-width:160px;';
		$dlstylecurrent = 'background-color:#eee;border: 1px solid #999;-moz-box-shadow: 2px 2px 2px #777;-webkit-box-shadow: 2px 2px 2px #777;box-shadow: 2px 2px 2px #777;';
		$currentvarietal = ( $varietal['name'] == $oenology_options['varietal'] ? true : false );
		$dlstyle = ( $currentvarietal ? $dlstylebase . $dlstylecurrent : $dlstylebase ); ?>
		<dl style="<?php echo $dlstyle; ?>">
		<dt><strong><?php echo $varietal['title']; ?></strong></dt>
		<dd><img style="border: 1px solid #bbb;" src="<?php echo get_template_directory_uri() . '/varietals/' . $varietal['name'] . '.png'; ?>" width="150px" height="110px" alt="<?php echo $varietal['title']; ?>" title="<?php echo $varietal['description']; ?>" /></dd>
		<dd><input type="radio" name="theme_oenology_options[varietal]" <?php checked( $currentvarietal ); ?> value="<?php echo $varietal['name']; ?>" /></dd>
		</dl>
	<?php } ?>
	<h4 style="display:block;clear:both;">White (Light)</h4>
	<?php foreach ( $oenology_varietals as $varietal ) {
		if ( 'light' == $varietal['scheme'] ) {
			oenology_output_varietal( $varietal );
		}
	} ?>
	<h4 style="display:block;clear:both;">Red (Dark)</h4>
	<?php foreach ( $oenology_varietals as $varietal ) {
		if ( 'dark' == $varietal['scheme'] ) {
			oenology_output_varietal( $varietal );
		}
	}
}

?>