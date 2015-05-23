<?php
/**
 * Oenology Theme Options
 *
 * This file defines the Options for the Oenology Theme.
 * 
 * Theme Options Functions
 * 
 *  - Define Default Theme Options
 *  - Register/Initialize Theme Options
 *  - Integrate Options into Theme Customizer
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * Globalize the variable that holds the Theme Options
 * 
 * @global	array	$oenology_options	holds Theme options
 */
global $oenology_options;

/**
 * Oenology Theme Options API Implementation
 *
 * Implement the WordPress Options API for the 
 * Oenology Theme Settings.
 * 
 * @link	http://codex.wordpress.org/Options_API	Codex Reference: Options API
 * @link	http://ottopress.com/2009/wordpress-settings-api-tutorial/	Otto
 * @link	http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/	Ozh
 */
function oenology_register_options(){

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
}
// Options API options initialization and validation
add_action( 'admin_init', 'oenology_register_options' );

/**
 * Include the Theme Options Configuration Function File
 * 
 * options-config.php includes the functions that return
 * the parameters for Theme options and Customizer Panels.
 */
require( get_template_directory() . '/functions/options-config.php' );

/**
 * Include the Theme Options Theme Customizer Function File
 * 
 * options-customizer.php includes the functions required to 
 * integrate the Theme options into the WordPress Theme
 * Customizer.
 */
require( get_template_directory() . '/functions/options-customizer.php' );


/**
 * Get Oenology Theme Options
 * 
 * Array that holds all of the defined values
 * for Oenology Theme options. If the user 
 * has not specified a value for a given Theme 
 * option, then the option's default value is
 * used instead.
 *
 * @uses	oenology_get_option_defaults()	defined in \functions\options.php
 * 
 * @uses	get_option()
 * @uses	wp_parse_args()
 * 
 * @return	array	$oenology_options	current values for all Theme options
 */
function oenology_get_options() {
	// Return the array of stored options parsed with the defaults
	return wp_parse_args( get_option( 'theme_oenology_options', array() ), oenology_get_option_defaults() );
}

/**
 * Return list of settings
 * 
 * Returns an array of settings.
 *
 * @uses	oenology_get_option_parameters()	defined in \functions\options.php
 * 
 * @return	array	$settings	array of arrays of settings
 */
function oenology_get_settings() {
	// Initialize an array to hold
	// a list of settings
	$settings = array();
	// Loop through the option parameters array
	foreach ( oenology_get_option_parameters() as $option_parameter ) {
		// Add each setting to the array
		$settings[] = $option_parameter['name'];
	}
	// Return the settings array
	return $settings;
}

/**
 * Oenology Theme Option Defaults
 * 
 * Returns an associative array that holds 
 * all of the default values for all Theme 
 * options.
 * 
 * @uses	oenology_get_option_parameters()	defined in \functions\options.php
 * 
 * @return	array	$defaults	associative array of option defaults
 */
function oenology_get_option_defaults() {
	// Initialize the array to hold
	// the default values for all
	// Theme options
	$option_defaults = array();
	// Loop through the option parameters array
	foreach ( oenology_get_option_parameters() as $option_parameter ) {
		$name = $option_parameter['name'];
		// Add an associative array key
		// to the defaults array for each
		// option in the parameters array
		$option_defaults[$option_parameter['name']] = $option_parameter['default'];
	}
	// Return the defaults array
	return apply_filters( 'oenology_option_defaults', $option_defaults );
}


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
	// Get the array of Theme settings
	$settings = oenology_get_settings();
	// Get the array of option parameters
	$option_parameters = oenology_get_option_parameters();
	// Get the array of option defaults
	$option_defaults = oenology_get_option_defaults();
	
	// Determine what type of submit was input
	$submittype = ( ! empty( $input['reset'] ) ? 'reset' : 'submit' );
	
	// Loop through each setting
	foreach ( $settings as $setting ) {
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
			// Validate radio button and radio image fields
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