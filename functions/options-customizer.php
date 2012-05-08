<?php
/**
 * Oenology Options Theme Customizer Integration
 *
 * This file integrates the Theme Customizer
 * for the Oenology Theme.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2012, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.6
 */

/**
 * Oenology Theme Settings Theme Customizer Implementation
 *
 * Implement the Theme Customizer for the 
 * Oenology Theme Settings.
 * 
 * @param 	object	$wp_customize	Object that holds the customizer data
 * 
 * @link	http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/	Otto
 */
function oenology_register_theme_customizer( $wp_customize ){

	// Failsafe is safe
	if ( ! isset( $wp_customize ) ) {
		return;
	}

	global $oenology_options;
	$oenology_options = oenology_get_options();

	// Get the array of option parameters
	$option_parameters = oenology_get_option_parameters();
	// Get list of tabs
	$tabs = oenology_get_settings_page_tabs();

	// Add Sections
	foreach ( $tabs as $tab ) {
		// Add $tab section
		$wp_customize->add_section( 'oenology_' . $tab['name'], array(
			'title'		=> 'Oenology ' . $tab['title'] . ' Settings',
		) );
	}

	// Add Settings
	foreach ( $option_parameters as $option_parameter ) {
		// Add $option_parameter setting
		$wp_customize->add_setting( 'theme_oenology_options[' . $option_parameter['name'] . ']', array(
			'default'        => $option_parameter['default'],
			'type'           => 'option',
		) );

		// Add $option_parameter control
		if ( 'text' == $option_parameter['type'] ) {
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['tab'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'text',
			) );

		} else if ( 'checkbox' == $option_parameter['type'] ) {
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['tab'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'checkbox',
			) );

		} else if ( 'radio' == $option_parameter['type'] ) {
			$valid_options = array();
			foreach ( $option_parameter['valid_options'] as $valid_option ) {
				$valid_options[$valid_option['name']] = $valid_option['title'];
			}
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['tab'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'radio',
				'choices'    => $valid_options,
			) );

		} else if ( 'select' == $option_parameter['type'] ) {
			$valid_options = array();
			foreach ( $option_parameter['valid_options'] as $valid_option ) {
				$valid_options[$valid_option['name']] = $valid_option['title'];
			}
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['tab'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'select',
				'choices'    => $valid_options,
			) );
		} else if ( 'custom' == $option_parameter['type'] ) {
			$valid_options = array();
			foreach ( $option_parameter['valid_options'] as $valid_option ) {
				$valid_options[$valid_option['name']] = $valid_option['title'];
			}
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['tab'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'select',
				'choices'    => $valid_options,
			) );
		}
	}

}
// Settings API options initilization and validation
add_action( 'customize_register', 'oenology_register_theme_customizer' );


?>