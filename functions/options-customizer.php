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
 * Register Theme Customizer Custom Controls Function File
 * 
 * options-customizer-custom-controls.php includes the functions required to 
 * add custom controls for the WordPress Theme Customizer. This file MUST be
 * included before the file that registers the Theme options into the Custsomizer
 */
require( get_template_directory() . '/functions/options-customizer-custom-controls.php' );

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

	// Get list of panels
	$panels = oenology_get_customizer_panels();
	
	// Add Panels
	foreach ( $panels as $panel ) {
		// Add $panel panel
		$wp_customize->add_panel( 
			'oenology_' . $panel['name'], 
			array(
				'priority' 			=> 10,
				'capability' 		=> 'edit_theme_options',
				'theme_supports'	=> '',
				'title' 			=> $panel['title'],
				'description' 		=> __( '', 'oenology' ),
			) 
		);
		// Add Sections
		foreach ( $panel['sections'] as $section ) {
			// Add $section sections
			$wp_customize->add_section( 
				'oenology_' . $section['name'], 
				array(
					'title'			=> $section['title'],
					'description'	=> $section['description'],
					'panel'			=> 'oenology_' . $panel['name']
				) 
			);
		}
	}
	
	// Get the array of option parameters
	$option_parameters = oenology_get_option_parameters();

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
				'label'		=> $option_parameter['title'],
				'section'	=> 'oenology_' . $option_parameter['section'],
				'settings'	=> 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'		=> 'text',
				'label'		=> $option_parameter['title'],
				'description' => $option_parameter['description'],
			) );

		} else if ( 'checkbox' == $option_parameter['type'] ) {
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['section'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'checkbox',
				'label'		=> $option_parameter['title'],
				'description' => $option_parameter['description'],
			) );

		} else if ( 'radio' == $option_parameter['type'] ) {
			$valid_options = array();
			foreach ( $option_parameter['valid_options'] as $valid_option ) {
				$valid_options[$valid_option['name']] = $valid_option['title'];
			}
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['section'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'radio',
				'label'		=> $option_parameter['title'],
				'description' => $option_parameter['description'],
				'choices'    => $valid_options,
			) );

		} else if ( 'select' == $option_parameter['type'] ) {
			$valid_options = array();
			foreach ( $option_parameter['valid_options'] as $valid_option ) {
				$valid_options[$valid_option['name']] = $valid_option['title'];
			}
			$wp_customize->add_control( 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['section'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'select',
				'label'		=> $option_parameter['title'],
				'description' => $option_parameter['description'],
				'choices'    => $valid_options,
			) );
		} else if ( 'radio-image' == $option_parameter['type'] ) {
			$valid_options = array();
			foreach ( $option_parameter['valid_options'] as $valid_option ) {
				$valid_options[$valid_option['name']] = $valid_option['image'];
			}
			$wp_customize->add_control( new Oenology_Custom_Radio_Image_Control( $wp_customize, 'oenology_' . $option_parameter['name'], array(
				'label'   => $option_parameter['title'],
				'section' => 'oenology_' . $option_parameter['section'],
				'settings'   => 'theme_oenology_options['. $option_parameter['name'] . ']',
				'type'    => 'radio-image',
				'label'		=> $option_parameter['title'],
				'description' => $option_parameter['description'],
				'choices'    => $valid_options,
			) ) );

		} 
	}

}
// Settings API options initilization and validation
add_action( 'customize_register', 'oenology_register_theme_customizer' );