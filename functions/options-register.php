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
 * 
 * @link	http://codex.wordpress.org/Function_Reference/register_setting	Codex Reference: register_setting()
 * 
 * @param	string		$option_group		Unique Settings API identifier; passed to settings_fields() call
 * @param	string		$option_name		Name of the wp_options database table entry
 * @param	callback	$sanitize_callback	Name of the callback function in which user input data are sanitized
 */
register_setting( 
	// $option_group
	'theme_oenology_options', 
	// $option_name
	'theme_oenology_options', 
	// $sanitize_callback
	'oenology_options_validate' 
);


/**
 * Theme register_setting() sanitize callback
 * 
 * Validate and whitelist user-input data before updating Theme 
 * Options in the database. Only whitelisted options are passed
 * back to the database, and user-input data for all whitelisted
 * options are sanitized.
 * 
 * @link	http://codex.wordpress.org/Data_Validation	Codex Reference: Data Validation
 * 
 * @param	array	$input	Raw user-input data submitted via the Theme Settings page
 * @return	array	$input	Sanitized user-input data passed to the database
 */
function oenology_options_validate( $input ) {
	// This is the "whitelist": current settings
	$valid_input = oenology_get_options();
	// Get the array of Theme settings, by Settings Page tab
	$settingsbytab = oenology_get_settings_by_tab();
	// Get the array of option parameters
	$option_parameters = oenology_get_option_parameters();
	// Get the array of option defaults
	$option_defaults = oenology_get_option_defaults();
	// Get list of tabs
	$tabs = oenology_get_settings_page_tabs();
	
	// Determine what type of submit was input
	$submittype = 'submit';	
	foreach ( $tabs as $tab ) {
		$resetname = 'reset-' . $tab['name'];
		if ( ! empty( $input[$resetname] ) ) {
			$submittype = 'reset';
		}
	}
	
	// Determine what tab was input
	$submittab = 'varietals';	
	foreach ( $tabs as $tab ) {
		$submitname = 'submit-' . $tab['name'];
		$resetname = 'reset-' . $tab['name'];
		if ( ! empty( $input[$submitname] ) || ! empty($input[$resetname] ) ) {
			$submittab = $tab['name'];
		}
	}
	global $wp_customize;
	// Get settings by tab
	$tabsettings = ( isset ( $wp_customize ) ? $settingsbytab['all'] : $settingsbytab[$submittab] );
	// Loop through each tab setting
	foreach ( $tabsettings as $setting ) {
		// If no option is selected, set the default
		$valid_input[$setting] = ( ! isset( $input[$setting] ) ? $option_defaults[$setting] : $input[$setting] );
		
		// If submit, validate/sanitize $input
		if ( 'submit' == $submittype ) {
		
			// Get the setting details from the defaults array
			$optiondetails = $option_parameters[$setting];
			// Get the array of valid options, if applicable
			$valid_options = ( isset( $optiondetails['valid_options'] ) ? $optiondetails['valid_options'] : false );
			
			// Validate checkbox fields
			if ( 'checkbox' == $optiondetails['type'] ) {
				// If input value is set and is true, return true; otherwise return false
				$valid_input[$setting] = ( ( isset( $input[$setting] ) && true == $input[$setting] ) ? true : false );
			}
			// Validate radio button fields
			else if ( 'radio' == $optiondetails['type'] || 'radio-image' == $optiondetails['type'] ) {
				// Only update setting if input value is in the list of valid options
				$valid_input[$setting] = ( array_key_exists( $input[$setting], $valid_options ) ? $input[$setting] : $valid_input[$setting] );
			}
			// Validate select fields
			else if ( 'select' == $optiondetails['type'] ) {
				// Only update setting if input value is in the list of valid options
				$valid_input[$setting] = ( array_key_exists( $input[$setting], $valid_options ) ? $input[$setting] : $valid_input[$setting] );
			}
			// Validate text input and textarea fields
			else if ( ( 'text' == $optiondetails['type'] || 'textarea' == $optiondetails['type'] ) ) {
				// Validate no-HTML content
				if ( 'nohtml' == $optiondetails['sanitize'] ) {
					// Pass input data through the wp_filter_nohtml_kses filter
					$valid_input[$setting] = wp_filter_nohtml_kses( $input[$setting] );
				}
				// Validate HTML content
				if ( 'html' == $optiondetails['sanitize'] ) {
					// Pass input data through the wp_filter_kses filter
					$valid_input[$setting] = wp_filter_kses( $input[$setting] );
				}
			}
		} 
		// If reset, reset defaults
		elseif ( 'reset' == $submittype ) {
			// Set $setting to the default value
			$valid_input[$setting] = $option_defaults[$setting];
		}
	}
	return $valid_input;		

}