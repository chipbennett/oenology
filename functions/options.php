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
 * Include the Theme Options Configuration Function File
 * 
 * File options-config.php includes the functions that return
 * the parameters for Theme options and Customizer Panels.
 */
require( get_template_directory() . '/functions/options-config.php' );

/**
 * Include the Theme Options Theme Customizer Function File
 * 
 * File options-customizer.php includes the functions required to 
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
	// Return the array of stored options parsed with the defaults.
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
	// Initialize an array to hold a list of settings.
	$settings = array();
	// Loop through the option parameters array.
	foreach ( oenology_get_option_parameters() as $option_parameter ) {
		// Add each setting to the array.
		$settings[] = $option_parameter['name'];
	}
	// Return the settings array.
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
	// Initialize the array to hold the default values for all Theme options.
	$option_defaults = array();
	// Loop through the option parameters array.
	foreach ( oenology_get_option_parameters() as $option_parameter ) {
		$name = $option_parameter['name'];
		// Add an associative array key to the defaults array for each option in the parameters array.
		$option_defaults[$option_parameter['name']] = $option_parameter['default'];
	}
	// Return the defaults array.
	return apply_filters( 'oenology_option_defaults', $option_defaults );
}


/**
 * Sanitize Checkbox (True/False) Settings
 * 
 * @param bool $input	Input true/false.
 */
function oenology_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}


/**
 * Sanitize HTML Text Settings
 * 
 * @param string $input	Input arbitrary text string with HTML.
 */
function oenology_sanitize_html( $input ) {
	return wp_filter_kses( $input );
}


/**
 * Sanitize No-HTML Text Settings
 * 
 * @param string $input	Input arbitrary text string with no HTML.
 */
function oenology_sanitize_nohtml( $input ) {
	return wp_filter_nohtml_kses( $input );
}


/**
 * Sanitize: Select
 * 
 * @param string $input	    Input select value.
 * @param string $setting	Current setting value for select option.
 */
function oenology_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}